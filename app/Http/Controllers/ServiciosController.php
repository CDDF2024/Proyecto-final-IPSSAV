<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Biologico;
use App\Models\Muestra;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::with(['biologico', 'muestra'])->get();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $biologicos = Biologico::all();
        $muestras = Muestra::all();
        return view('servicios.create', compact('biologicos', 'muestras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|max:100',
            'nombre' => 'required|max:100',
            'detalles' => 'required|max:300',
            'id_biologico' => 'nullable|exists:biologicos,id_biologico',
            'id_muestra' => 'nullable|exists:muestras,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['id_biologico'] = $request->input('id_biologico') ?: null;
        $data['id_muestra'] = $request->input('id_muestra') ?: null;

        Servicio::create($data);

        return redirect('servicios')->with('type', 'success')
                                     ->with('msn', 'Registro creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $servicio = Servicio::with(['biologico', 'muestra'])->findOrFail($id);
        return view('servicios.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        $biologicos = Biologico::all();
        $muestras = Muestra::all();
        return view('servicios.edit', compact('servicio', 'biologicos', 'muestras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|max:100',
            'nombre' => 'required|max:100',
            'detalles' => 'required|max:300',
            'id_biologico' => 'nullable|exists:biologicos,id_biologico',
            'id_muestra' => 'nullable|exists:muestras,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $servicio = Servicio::findOrFail($id);
        $data = $request->all();
        $data['id_biologico'] = $request->input('id_biologico') ?: null;
        $data['id_muestra'] = $request->input('id_muestra') ?: null;

        $servicio->update($data);

        return redirect('servicios')->with('type', 'success')
                                     ->with('msn', 'Registro actualizado exitosamente');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        
        // Realiza la búsqueda en la base de datos
        $servicios = Servicio::where('nombre', 'LIKE', "%{$query}%")
                             ->orWhere('tipo', 'LIKE', "%{$query}%")
                             ->get();
        
        return response()->json($servicios);
    }
    public function destroy(string $id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return redirect('servicios')->with('type', 'success')
                                     ->with('msn', 'Registro eliminado exitosamente');
    }


}
