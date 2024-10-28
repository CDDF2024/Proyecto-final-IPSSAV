<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Biologico; // Asegúrate de importar el modelo Biologico
use Illuminate\Http\Request;
use Carbon\Carbon;

class InventariosController extends Controller
{
    // Mostrar todos los inventarios
    public function index()
    {
        $inventarios = Inventario::with('biologico')->get();
        return view('inventarios.index', compact('inventarios'));
    }

    // Mostrar un inventario específico
    public function show($id)
    {
        $inventario = Inventario::with('biologico')->findOrFail($id);
        return view('inventarios.show', compact('inventario'));
    }

    // Crear un nuevo inventario
    public function create()
    {
        $biologicos = Biologico::all(); // Obtener todos los biológicos
        return view('inventarios.create', compact('biologicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_biologico' => 'required|exists:biologicos,id_biologico',
            'cantidad_disponible' => 'required|integer',
            'fecha_vencimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
            'fecha_actualizacion' => 'nullable|date',
        ]);

        $biologico = Biologico::find($request->id_biologico);
        $biologico->cantidad += $request->cantidad_disponible; // Aumentar la cantidad disponible
        $biologico->save();
        
        Inventario::create($request->all());
        return redirect('inventarios')->with('type','success')
                                ->with('msn','Registro creado exitosamente');
    }

    // Actualizar un inventario existente
    public function edit($id)
    {
        $inventario = Inventario::findOrFail($id);
        $biologicos = Biologico::all(); // Obtener todos los biológicos
        return view('inventarios.edit', compact('inventario', 'biologicos'));
    }

    public function update(Request $request, $id)
    {
        $inventario = Inventario::findOrFail($id);

        $request->validate([
            'id_biologico' => 'sometimes|required|exists:biologicos,id_biologico',
            'cantidad_disponible' => 'sometimes|required|integer',
            'fecha_vencimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
            'fecha_actualizacion' => 'nullable|date',
        ]);

        $inventario->update($request->all());
        return redirect('inventarios')->with('type','success')
                                ->with('msn','Registro actualizado exitosamente');

    }

    public function buscar(Request $request)
    {
        $query = $request->get('query');

        $inventarios = Inventario::with(['biologico'])
            ->whereHas('biologico', function($q) use ($query) {
                $q->where('nombre', 'LIKE', "%{$query}%");
            })
            ->get();

        return response()->json($inventarios);
    }
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
        return redirect('inventarios')->with('type','danger')
                                        ->with('msn','Registro eliminado exitosamente');
    }
}
