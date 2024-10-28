<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Servicio;
use Illuminate\Http\Request;
use PDF;
class FacturasController extends Controller
{
    // Mostrar la lista de facturas
    public function index()
    {
        $facturas = Factura::with(['cliente', 'usuario', 'servicio'])->get();
        return view('facturas.index', compact('facturas'));
    }

    // Mostrar el formulario para crear una nueva factura
    public function create()
    {
        $clientes = Cliente::all();
        $usuarios = Usuario::where('id_rol', 2)->get();
        $servicios = Servicio::all();
        
        return view('facturas.create', compact('clientes', 'usuarios', 'servicios'));
    }

    // Almacenar una nueva factura
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_usuario' => 'required|exists:usuarios,id',
            'fecha' => 'required|date',
            'id_servicio' => 'required|exists:servicios,id',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric',
            'total' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:100',
            'observaciones' => 'nullable|string|max:100',
        ]);

        // Depurar los datos de la solicitud
        
        // Crear la factura
        Factura::create($request->all());
        dump($request->all());

        // Redireccionar con mensaje de éxito
        return redirect('facturas')->with('type','success')
                                ->with('msn','Registro creado exitosamente');
    }

    // Mostrar una factura específica
    public function show(Factura $factura)
    {
        return view('facturas.show', compact('factura'));
    }

    // Mostrar el formulario para editar una factura
    public function edit(Factura $factura)
    {
        $clientes = cliente::all();
        $usuarios = Usuario::all();
        $servicios = Servicio::all();
        
        return view('facturas.edit', compact('factura', 'clientes', 'usuarios', 'servicios'));
    }

    // Actualizar una factura existente
    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_usuario' => 'required|exists:usuarios,id',
            'fecha' => 'required|date',
            'id_servicio' => 'required|exists:servicios,id',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric',
            'total' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:100',
            'observaciones'=>'nullable|string|max:100',
        ]);

        $factura->update($request->all());

        return redirect('facturas')->with('type','success')
                                ->with('msn','Registro actualizado exitosamente');
    }

    public function buscar(Request $request)
    {
        $query = $request->get('query');

        $facturas = Factura::with(['cliente', 'usuario'])
            ->whereHas('cliente', function($q) use ($query) {
                $q->where('nombre', 'LIKE', "%{$query}%");
            })
            ->get();

        return response()->json($facturas);
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect('facturas')->with('type','danger')
                                ->with('msn','Registro eliminado exitosamente');
    }
        public function exportar($id)
    {
        $factura = Factura::with(['cliente', 'usuario', 'servicio'])->findOrFail($id);
        $pdf = PDF::loadView('facturas.factura', compact('factura'));
        return $pdf->download('factura_' . $factura->id . '.pdf');
    }
}
