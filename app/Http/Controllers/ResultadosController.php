<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resultado;
use App\Models\Paciente;
use App\Models\Muestra;
use Illuminate\Support\Facades\Validator;

class ResultadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Resultado::with(['pacientes', 'muestras'])->get();
        return view('resultados.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pacientes = Paciente::with(['muestras' => function($query) {
        $query->select('id', 'id_paciente', 'tipo_muestra'); // Asegúrate de incluir 'tipo_muestra'
        }])->get();

        return view('resultados.create', compact('pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'id_muestra' => 'required|exists:muestras,id',
            'resultado' => 'required|max:500',
            'fecha_resultado' => 'required|date',
            'interpretacion' => 'nullable|max:500'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        
        Resultado::create($request->all());
        return redirect('resultados')->with('type', 'success')
                                     ->with('msn', 'Registro creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resultado = Resultado::with(['paciente', 'muestra'])->find($id);
        if (!$resultado) {
            return redirect('resultados')->with('type', 'error')->with('msn', 'Resultado no encontrado');
        }
        return view('resultados.show', compact('resultado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resultado = Resultado::find($id);
        if (!$resultado) {
            return redirect('resultados')->with('type', 'error')->with('msn', 'Resultado no encontrado');
        }

        $pacientes = Paciente::all();
        $muestras = Muestra::all();
        return view('resultados.edit', compact('resultado', 'pacientes', 'muestras'));
        return redirect('resultados')->with('type','success')
                                ->with('msn','Registro actualizado exitosamente');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_paciente' => 'required|exists:pacientes,id',
            'id_muestra' => 'required|exists:muestras,id',
            'resultado' => 'required|max:500',
            'fecha_resultado' => 'required|date',
            'interpretacion' => 'nullable|max:500'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $resultado = Resultado::find($id);
        if (!$resultado) {
            return redirect('resultados')->with('type', 'error')->with('msn', 'Resultado no encontrado');
        }

        $resultado->update($request->all());
        return redirect('resultados')->with('type', 'success')
                                     ->with('msn', 'Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resultado = Resultado::find($id);
        if (!$resultado) {
            return redirect('resultados')->with('type', 'error')->with('msn', 'Resultado no encontrado');
        }

        $resultado->delete();
        return redirect('resultados')->with('type', 'danger')
                                     ->with('msn', 'Registro eliminado exitosamente');
    }
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $resultados = Resultado::whereHas('pacientes', function($q) use ($query) {
            $q->where('nombre', 'LIKE', "%{$query}%");
        })->orWhere('resultado', 'LIKE', "%{$query}%")
        ->orWhere('interpretacion', 'LIKE', "%{$query}%")
        ->get();

        return view('resultados.resultados', compact('resultados'));
    }
    public function buscarP(Request $request)
    {
        $request->validate([
            'num_doc' => 'required|string',
        ]);
        $paciente = Paciente::where('num_doc', $request->num_doc)->first();

        if (!$paciente) {
            return view('resultados.buscar', ['resultados' => null, 'mensaje' => 'No se encontró el paciente.']);
        }
        $resultados = Resultado::where('id_paciente', $paciente->id_paciente)->get();

        return view('resultados.resultados', compact('resultados'));
    }
    public function mostrarResultados()
    {
        $resultados = Resultado::with(['pacientes', 'muestras'])->get();
        dd($resultados);
        return view('resultados', compact('resultados'));
    }

}
