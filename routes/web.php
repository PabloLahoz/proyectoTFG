<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\NoAdminAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view("/contacto","contacto")->middleware(NoAdminAccess::class)->name("contacto");
Route::get('/', [\App\Http\Controllers\ProductoController::class, 'index']);
Route::view("/", "home")->middleware(NoAdminAccess::class)->name("home");
Route::get('/', [HomeController::class, 'index'])->middleware(NoAdminAccess::class)->name("home");
Route::view('/catalogo', "catalogo")->middleware(NoAdminAccess::class)->name("catalogo");
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para CLIENTE autenticado
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [UserController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/editar', [UserController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [UserController::class, 'update'])->name('perfil.update');
    Route::patch('/cuenta/cerrar', [UserController::class, 'cerrarCuenta'])->name('cuenta.cerrar');
});

Route::middleware(['auth', AdminMiddleware::class])
    ->get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');


// Rutas para ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/clientes', [UserController::class, 'index'])->name('admin.clientes.index');
    Route::get('/admin/clientes/{id}', [UserController::class, 'showCliente'])->name('admin.clientes.show');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('pedidos', PedidoController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('productos', ProductoController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('proveedores', ProveedorController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('compras', CompraController::class);
});

Route::resource('productos', ProductoController::class);

require __DIR__ . '/auth.php';
