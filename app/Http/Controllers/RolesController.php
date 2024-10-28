<?php

namespace App\Http\Controllers;

use App\Models\Rol; // Importa el modelo Rol
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rol' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Rol::create($request->all());

        return redirect('roles')->with('type','success')
                                ->with('msn','Registro creado exitosamente');
    }

    public function show($id_rol)
    {
        //
    }

    public function edit($id_rol)
    {
        $rol = Rol::findOrFail($id_rol);
        return view('roles.edit', compact('rol'));
    }

    public function update(Request $request, $id_rol)
    {
        $request->validate([
            'rol' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ]);
        $rol = Rol::findOrFail($id_rol);
        $rol->update($request->all());
        return redirect('roles')->with('type','success')
                                ->with('msn','Registro actualizado exitosamente');
    }
    public function buscarRoles(Request $request)
    {
        $query = $request->input('query');
        $resultados = Rol::where('rol', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($resultados);
    }
    public function destroy($id_rol)
    {
        $rol = Rol::findOrFail($id_rol);
        $rol->delete();
        return redirect('roles')->with('type','danger')
                                    ->with('msn','Registro eliminado exitosamente');
    }
}
