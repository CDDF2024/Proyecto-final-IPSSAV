<?php

namespace App\Http\Controllers;
use App\Models\Biologico;
use Illuminate\Http\Request;

class BiologicosController extends Controller
{
    public function index()
    {
        $biologicos = Biologico::all();
        return view('biologicos.index', compact('biologicos'));
    }

    public function create()
    {
        return view('biologicos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'cantidad' => 'nullable|integer|min:0',
            'precio' => 'required|numeric',
            'presentacion' => 'required|string|max:50',
            'marca' => 'required|string|max:40',
            'laboratorio' => 'required|string|max:100',
            'lote' => 'required|string|max:50',
        ]);

        Biologico::create($request->all());
        return redirect()->route('biologicos.index')->with('success', 'Biológico creado con éxito.');
    }

    public function show(Biologico $biologico)
    {
        return view('biologicos.show', compact('biologico'));
    }

    public function edit(Biologico $biologico)
    {
        return view('biologicos.edit', compact('biologico'));
    }

    public function update(Request $request, Biologico $biologico)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric',
            'presentacion' => 'required|string|max:50',
            'marca' => 'required|string|max:40',
            'laboratorio' => 'required|string|max:100',
            'lote' => 'required|string|max:50',
        ]);

        $biologico->update($request->all());
        return redirect()->route('biologicos.index')->with('success', 'Biológico actualizado con éxito.');
    }
    public function buscar(Request $request)
    {
        $query = $request->input('query');

        // Verifica si el término de búsqueda no está vacío
        if ($query) {
            $biologicos = Biologico::where('nombre', 'LIKE', "%{$query}%")
                ->orWhere('marca', 'LIKE', "%{$query}%")
                ->orWhere('laboratorio', 'LIKE', "%{$query}%")
                ->get();
        } else {
            // Si no hay término de búsqueda, devuelve todos los biológicos
            $biologicos = Biologico::all();
        }

        return response()->json($biologicos);
    }
    public function destroy(Biologico $biologico)
    {
        $biologico->delete();
        return redirect()->route('biologicos.index')->with('success', 'Biológico eliminado con éxito.');
    }
}
