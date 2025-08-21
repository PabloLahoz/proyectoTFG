<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ClientePedidoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view("/contacto","contacto")->middleware('noAdmin')->name("contacto");
Route::get('/', [ProductoController::class, 'index']);
Route::view("/", "home")->middleware('noAdmin')->name("home");
Route::get('/', [HomeController::class, 'index'])->middleware('noAdmin')->name("home");
Route::get('/catalogo', [ProductoController::class, 'catalogo'])->middleware('noAdmin')->name("catalogo");
Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');
Route::delete('/carrito/{id}', [CartController::class, 'eliminar'])->name('carrito.eliminar');
Route::delete('/carrito', [CartController::class, 'vaciar'])->name('carrito.vaciar');
Route::put('/carrito/{id}', [CartController::class, 'actualizar'])->name('carrito.actualizar');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'admin'])->get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


// Rutas para ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/clientes', [UserController::class, 'index'])->name('admin.clientes.index');
    Route::get('/admin/clientes/{id}', [UserController::class, 'showCliente'])->name('admin.clientes.show');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('clientes', UserController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('pedidos', PedidoController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('productos', ProductoController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('proveedores', ProveedorController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('compras', CompraController::class);
});

Route::middleware(['auth'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('mispedidos', [ClientePedidoController::class, 'index'])->name('pedidos.index');
    Route::get('mispedidos/{pedido}', [ClientePedidoController::class, 'show'])->name('pedidos.show');
});


Route::resource('productos', ProductoController::class);

// Rutas para CLIENTE no autenticado
Route::post('/carrito/anadir/{producto}', [CartController::class, 'add'])->name('carrito.añadir');
Route::get('/catalogo/{producto}', [ProductoController::class, 'mostrar'])->name('catalogo.show');

// Rutas para CLIENTE autenticado
Route::middleware(['auth', 'esCliente'])->group(function () {
    Route::get('/cliente/perfil', [UserController::class, 'show'])->name('cliente.perfil.show');
    Route::get('/cliente/perfil/editar', [UserController::class, 'edit'])->name('cliente.perfil.edit');
    Route::put('/cliente/perfil/actualizar', [UserController::class, 'update'])->name('cliente.perfil.update');
    Route::get('/cliente/perfil/password', [UserController::class, 'editPassword'])->name('cliente.perfil.password.edit');
    Route::put('/cliente/perfil/password', [UserController::class, 'updatePassword'])->name('cliente.perfil.password.update');
    Route::delete('/cliente/perfil/cerrar', [UserController::class, 'cerrarCuenta'])->name('cliente.perfil.cerrar');
    Route::get('/cliente/pedidos', [ClientePedidoController::class, 'index'])->name('cliente.pedidos.index');
    Route::get('/cliente/pedidos/{pedido}', [ClientePedidoController::class, 'show'])->name('cliente.pedidos.show');
    Route::put('/cliente/pedidos/{pedido}/entregar', [ClientePedidoController::class, 'entregar'])->name('cliente.pedidos.entregar');
    Route::put('/cliente/pedidos/{pedido}/cancelar', [ClientePedidoController::class, 'cancelar'])->name('cliente.pedidos.cancelar');
    Route::get('/checkout', [PedidoController::class, 'checkout'])->name('checkout-wizard');
});

require __DIR__ . '/auth.php';
