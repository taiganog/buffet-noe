<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\ComplementoController;
use App\Http\Controllers\ValorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FuncionarioController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/cliente', [ClienteController::class, 'index']);
Route::post('/cliente', [ClienteController::class, 'create']);

Route::get('/complemento', [ComplementoController::class, 'index']);
Route::post('/complemento', [ComplementoController::class, 'create']);

Route::get('/valor', [ValorController::class, 'index']);
Route::post('/valor', [ValorController::class, 'create']);

Route::post('/evento', [EventoController::class, 'create']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas administrativas
    //  - Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //  - Eventos
    Route::get('/evento/{id?}', [EventoController::class, 'index'])->name('admin.evento');

    //  - Funcionários
    Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('admin.funcionario');
});

require __DIR__.'/auth.php';
