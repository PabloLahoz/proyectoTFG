<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Cliente: ver su perfil
    public function show()
    {
        $cliente = Auth::user();
        return view('cliente.perfil.show', compact('cliente'));
    }

    // Cliente: editar su perfil
    public function edit()
    {
        $cliente = Auth::user();
        return view('cliente.perfil.edit', compact('cliente'));
    }

    // Cliente: actualizar su perfil
    public function update(Request $request)
    {
        $cliente = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $cliente->id,
        ]);

        $cliente->update($request->only(['name', 'empresa', 'email']));

        return redirect()->route('perfil.show')->with('status', 'Tu perfil ha sido actualizado correctamente.');
    }

    // Cliente: cerrar su cuenta
    public function cerrarCuenta(Request $request)
    {
        $user = Auth::user();
        $user->activo = false;
        $user->save();

        Auth::logout();

        return redirect('/')->with('status', 'Tu cuenta ha sido desactivada.');
    }

    // Admin: ver listado de clientes
    public function index()
    {
        $clientes = User::where('rol', 'cliente')->get();
        return view('admin.usuarios.index', compact('clientes'));
    }

    // Admin: ver un cliente específico
    public function showCliente($id)
    {
        $cliente = User::findOrFail($id);
        return view('admin.usuarios.show', compact('cliente'));
    }
}
