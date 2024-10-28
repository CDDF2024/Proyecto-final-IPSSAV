<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PacientesController extends Controller
{
    // Mostrar todos los pacientes
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    // Mostrar un paciente específico
    public function show($id_paciente)
    {
        $paciente = Paciente::find($id_paciente);
        if (!$paciente) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado');
        }
        return view('pacientes.show', compact('paciente'));
    }

    // Mostrar el formulario para crear un nuevo paciente
    public function create()
    {
        return view('pacientes.create');
    }

    // Almacenar un nuevo paciente
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'tipo_doc' => 'required|string|max:50',
            'num_doc' => 'required|string|max:50',
            'genero' => 'required|string|max:10',
            'tipo_sangre' => 'required|string|max:10',
            'fecha_nacimiento' => 'required|date',
            'fecha_expedicion_doc' => 'required|date',
            'telefono' => 'required|string|max:15',
            'correo_electronico' => 'required|email|max:255',
            'alergias' => 'nullable|string|max:255',
        ]);

        Paciente::create($request->all());
        return redirect('pacientes')->with('type','success')
                                    ->with('msn','Registro creado exitosamente');
    }

    // Mostrar el formulario para editar un paciente existente
    public function edit($id_paciente)
    {
        $paciente = Paciente::find($id_paciente);

        if (!$paciente) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado');
        }
        return view('pacientes.edit', compact('paciente'));
    }

    // Actualizar un paciente existente
    public function update(Request $request, $id_paciente)
    {
        $paciente = Paciente::find($id_paciente);
        if (!$paciente) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado');
        }

        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'tipo_doc' => 'sometimes|required|string|max:50',
            'num_doc' => 'sometimes|required|string|max:50',
            'genero' => 'sometimes|required|string|max:10',
            'tipo_sangre' => 'sometimes|required|string|max:10',
            'fecha_nacimiento' => 'sometimes|required|date',
            'fecha_expedicion_doc' => 'sometimes|required|date',
            'telefono' => 'sometimes|required|string|max:15',
            'correo_electronico' => 'sometimes|required|email|max:255',
            'alergias' => 'sometimes|nullable|string|max:255',
        ]);

        $paciente->update($request->all());
        return redirect('pacientes')->with('type','success')
                                    ->with('msn','Registro actualizado exitosamente');
    }

    public function buscar(Request $request)
    {
        $query = $request->get('query');
        $pacientes = Paciente::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('apellido', 'LIKE', "%{$query}%")
            ->get();
    
        return response()->json($pacientes);
    }

    public function destroy($id_paciente)
    {
        $paciente = Paciente::find($id_paciente);
        if (!$paciente) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado');
        }

        $paciente->delete();
        return redirect('pacientes')->with('type','danger')
                                ->with('msn','Registro eliminado exitosamente');

    }
}
