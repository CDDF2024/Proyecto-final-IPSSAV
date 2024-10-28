<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with('rol')->get(); 
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'tipo_doc' => 'required|string|max:20',
            'num_doc' => 'required|string|max:10',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|max:150',
            'id_rol' => 'required|exists:roles,id_rol',
        ]);
        $user = new Usuario();
        $user->nombre = $validatedData['nombre'];
        $user->apellido = $validatedData['apellido'];
        $user->tipo_doc = $validatedData['tipo_doc'];
        $user->num_doc = $validatedData['num_doc'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->id_rol = $validatedData['id_rol'];
        $user->save();
    
        return redirect('usuarios')->with('type','success')
                                    ->with('msn','Registro creado exitosamente');
    
    }

    public function edit(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all(); 
        return view('usuarios.edit', compact('usuario', 'roles'));
        return redirect('usuarios')->with('type','success')
                                    ->with('msn','Registro creado exitosamente');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'tipo_doc' => 'required|string|max:20',
            'num_doc' => 'required|string|max:10',
            'email' => 'required|string|email|max:100|unique:users,email,' . $id,
            'pass' => 'nullable|string|min:8|max:150',
            'id_rol' => 'required|exists:roles,id_rol',
        ]);
    
        $user = Usuario::findOrFail($id);
        $user->fill($validatedData);
        if (!empty($validatedData['pass'])) {
            $user->password = bcrypt($validatedData['pass']);
        }
        $user->save();
    
        return redirect('usuarios')->with('type','success')
                                    ->with('msn','Registro actualizado exitosamente');
    }
    
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        $resultados = Usuario::with('rol')
            ->where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('apellido', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();
    
        return response()->json($resultados);
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::find($id);
        $usuario->delete();
        return redirect('usuarios')->with('type','danger')
                                    ->with('msn','Registro eliminado exitosamente');
    }
}