<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Esquema;
use App\Models\Biologico;
use App\Models\Usuario;
use App\Models\Paciente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EsquemasController extends Controller
{
    public function index()
    {
        $esquemas = Esquema::with(['biologico', 'usuario', 'paciente'])->get();
        return view('esquemas.index', compact('esquemas'));
    }

    public function create()
    {
        $biologicos = Biologico::all();
        $usuarios = Usuario::where('id_rol', 3)->get(); // Suponiendo que el rol 3 es el correcto
        $pacientes = Paciente::all();

        return view('esquemas.create', compact('biologicos', 'usuarios', 'pacientes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_paciente' => 'required|integer|exists:pacientes,id_paciente',
            'id_biologico' => 'required|integer|exists:biologicos,id_biologico',
            'dosis_administrada' => 'required|integer|min:1',
            'fecha_administracion' => 'required|date',
            'edad_paciente' => 'required|integer',
            'lugar_aplicacion' => 'required|string',
            'id_usuario' => 'required|integer|exists:usuarios,id',
            'efectos_secundarios' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Obtener el biológico
        $biologico = Biologico::find($request->id_biologico);

        // Validar que la dosis administrada no exceda la cantidad disponible
        if ($request->dosis_administrada > $biologico->cantidad) {
            return back()->withErrors(['dosis_administrada' => 'La dosis administrada no puede ser mayor que la cantidad disponible.'])->withInput();
        }

        // Crear el esquema
        $esquema = Esquema::create($request->only([
            'id_paciente',
            'id_biologico',
            'dosis_administrada',
            'fecha_administracion',
            'edad_paciente',
            'lugar_aplicacion',
            'id_usuario',
            'efectos_secundarios',
        ]));

        // Descontar la dosis administrada del biológico
        $biologico->cantidad -= $request->dosis_administrada; // Descontar la dosis
        $biologico->save();

        Log::info('Cantidad después de guardar: ' . $biologico->cantidad); // Registro para depuración

        return redirect()->route('esquemas.index')->with('type', 'success')
                             ->with('msn', 'Esquema creado exitosamente');
    }

    public function show($id)
    {
        $esquema = Esquema::with(['biologico', 'usuario', 'paciente'])->findOrFail($id);
        return view('esquemas.show', compact('esquema'));
    }

    public function edit($id)
    {
        $esquema = Esquema::findOrFail($id);
        $biologicos = Biologico::all();
        $usuarios = Usuario::where('id_rol', 3)->get();
        $pacientes = Paciente::all();

        return view('esquemas.edit', compact('esquema', 'biologicos', 'usuarios', 'pacientes'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_paciente' => 'required|integer|exists:pacientes,id_paciente',
            'id_biologico' => 'required|integer|exists:biologicos,id_biologico',
            'dosis_administrada' => 'required|integer|min:1',
            'fecha_administracion' => 'required|date',
            'edad_paciente' => 'required|integer',
            'lugar_aplicacion' => 'required|string',
            'id_usuario' => 'required|integer|exists:usuarios,id',
            'efectos_secundarios' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $esquema = Esquema::findOrFail($id);
        $biologico = Biologico::find($request->id_biologico);

        // Ajustar la cantidad del biológico
        $dosisAnterior = $esquema->dosis_administrada; // Guardar la dosis anterior
        $biologico->cantidad += $dosisAnterior; // Revertir la dosis anterior
        $biologico->cantidad -= $request->dosis_administrada; // Descontar la nueva dosis
        $biologico->save();

        $esquema->update($request->only([
            'id_paciente',
            'id_biologico',
            'dosis_administrada',
            'fecha_administracion',
            'edad_paciente',
            'lugar_aplicacion',
            'id_usuario',
            'efectos_secundarios',
        ]));

        return redirect()->route('esquemas.index')->with('type', 'success')
                             ->with('msn', 'Esquema actualizado exitosamente');
    }
    public function buscar(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos
        $esquemas = Esquema::whereHas('paciente', function ($q) use ($query) {
            $q->where('nombre', 'LIKE', "%{$query}%");
        })->orWhereHas('biologico', function ($q) use ($query) {
            $q->where('nombre', 'LIKE', "%{$query}%");
        })->get();

        // Devuelve los resultados como JSON
        return response()->json($esquemas);
    }
    public function destroy($id)
    {
        $esquema = Esquema::findOrFail($id);
        $biologico = Biologico::find($esquema->id_biologico);

        // Ajustar la cantidad al eliminar
        $biologico->cantidad += $esquema->dosis_administrada; // Revertir la dosis administrada
        $biologico->save();

        $esquema->delete();

        return redirect()->route('esquemas.index')->with('type', 'success')
                             ->with('msn', 'Esquema eliminado exitosamente');
    }
}
