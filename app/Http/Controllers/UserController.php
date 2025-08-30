<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

        return redirect()->route('cliente.perfil.show')->with('status', 'Tu perfil ha sido actualizado correctamente.');
    }

    public function editPassword(){
        $cliente = Auth::user();
        return view('cliente.perfil.password', compact('cliente'));
    }

    public function updatePassword(Request $request)
    {
        $cliente = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $cliente->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'La contraseña actual no es correcta.',
            ]);
        }

        $cliente->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('cliente.perfil.show')->with('status', 'Tu contraseña ha sido actualizada correctamente.');
    }

    // Cliente: cerrar su cuenta
    public function cerrarCuenta(Request $request)
    {
        $user = Auth::user();
        Auth::logout();

        $user->delete();

        return redirect('/')->with('status', 'Tu cuenta ha sido desactivada.');
    }

    public function direcciones()
    {
        return view('cliente.direcciones.index');
    }

    // Admin: ver listado de clientes
    public function index()
    {
        $clientes = User::withTrashed()->where('rol', 'cliente')->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    // Admin: ver un cliente específico
    public function showCliente($id)
    {
        $cliente = User::findOrFail($id);
        return view('admin.usuarios.show', compact('cliente'));
    }
}
