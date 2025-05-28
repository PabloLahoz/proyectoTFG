<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        $clientes = User::where('rol', 'cliente')->get();
        return view('clientes.index', compact('clientes'));
    }
}
