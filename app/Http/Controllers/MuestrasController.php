<?php

namespace App\Http\Controllers;

use App\Models\Muestra;
use App\Models\Paciente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MuestrasController extends Controller
{
    public function index()
    {
        // Carga las muestras junto con los pacientes y usuarios
        $muestras = Muestra::with(['paciente', 'usuario.rol'])->get(); // Cargar el rol del usuario
        return view('muestras.index', compact('muestras'));
    }

    public function create()
    {
        $usuarios = Usuario::where('id_rol', 3)->get(); // Obtener todos los usuarios con su rol
        $pacientes = Paciente::all(); // Obtener todos los pacientes

        return view('muestras.create', compact('usuarios', 'pacientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'tipo_muestra' => 'required|string|max:255',
            'aseguradora' => 'required|string|max:255',
            'fecha_resultado' => 'required|date',
            'id_profesional' => 'required|exists:usuarios,id',
        ]);
        // dd($request->all());
        // Crear la muestra, incluyendo el id del profesional
        Muestra::create($request->all());
        return redirect('muestras')->with('type','success')
                                ->with('msn','Registro creado exitosamente');
    }

    public function edit(Muestra $muestra)
    {
        $usuarios = Usuario::where('id_rol', 3)->get(); // Obtener todos los usuarios con su rol
        $pacientes = Paciente::all(); // Obtener todos los pacientes
        $muestra->fecha_resultado = Carbon::parse($muestra->fecha_resultado);

        return view('muestras.edit', compact('muestra', 'usuarios', 'pacientes'));
    }

    public function update(Request $request, Muestra $muestra)
    {
        $request->validate([
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'tipo_muestra' => 'required|string|max:255',
            'aseguradora' => 'required|string|max:255',
            'fecha_resultado' => 'required|date',
            'id_profesional' => 'required|exists:usuarios,id',
        ]);

        $muestra->update($request->all());
        return redirect('muestras')->with('type','success')
                                ->with('msn','Registro actualizado exitosamente');
    }
    public function buscar(Request $request)
    {
        $query = $request->get('query');

        // Buscar muestras donde el nombre o apellido del paciente coincida con la consulta
        $muestras = Muestra::with(['paciente', 'usuario'])
            ->whereHas('paciente', function($q) use ($query) {
                $q->where('nombre', 'LIKE', "%{$query}%")
                ->orWhere('apellido', 'LIKE', "%{$query}%");
            })
            ->get();

        return response()->json($muestras);
    }
    public function destroy(Muestra $muestra)
    {
        $muestra->delete();
        return redirect('muestras')->with('type','danger')
                                ->with('msn','Registro eliminado exitosamente');
    }
}
