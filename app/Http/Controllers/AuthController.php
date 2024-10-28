<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $roles = Rol::all();
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'tipo_doc' => 'required|max:50',
            'num_doc' => 'required|max:50',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6|confirmed',
            'id_rol' => 'required|exists:roles,id_rol'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $registro = $request->all();
        $registro['password'] = Hash::make($registro['password']);

        Usuario::create($registro);

        return redirect('/')->with('type', 'success')
                            ->with('msn', 'Usuario creado exitosamente');
    }
    public function check(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            switch ($user->id_rol) {
                case 1:
                    return redirect()->intended('home');
                case 2:
                    return redirect()->intended('home');
                case 4:
                    return redirect()->intended('inicio');
                case 5: 
                    return redirect()->intended('home');
                default:
                    return redirect()->intended('home');
            }
        }
    
        return redirect('/')->with('type', 'danger')
                            ->with('message', 'Usuario o contraseña incorrectos');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('index')->with('message', 'Has cerrado sesión correctamente.');
    }
}
