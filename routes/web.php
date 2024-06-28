<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\Admin\ComplementoController;
use App\Http\Controllers\ValorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FuncionarioController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\PDFController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

// Rotas de teste para Postman
Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/complemento', [ComplementoController::class, 'index']);
Route::get('/valor', [ValorController::class, 'index']);
Route::post('/valor', [ValorController::class, 'create']);
Route::post('/evento', [EventoController::class, 'create']);
Route::post('/feedback', [FeedbackController::class, 'create']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Rotas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas administrativas
    //  - Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //  - Eventos
    Route::get('/evento', [EventoController::class, 'index'])->name('admin.evento');
    Route::get('/evento/{id}', [EventoController::class, 'index'])->name('admin.evento.unico');
    Route::get('/evento/{id}/contrato', [PDFController::class, 'index'])->name('admin.evento.contrato');
    Route::get('/evento/cadastro/novo', [EventoController::class, 'cadastro'])->name('admin.evento.cadastro');

    //  - Cliente
    Route::post('/cliente', [ClienteController::class, 'create'])->name('admin.cliente.create');
    Route::post('/evento', [EventoController::class, 'create'])->name('admin.evento.create');

    //  - Complementos
    Route::post('/complemento', [ComplementoController::class, 'create'])->name('admin.complemento.create');

    //  - Funcionários
    Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('admin.funcionario');
    Route::post('/funcionario', [FuncionarioController::class, 'create'])->name('admin.funcionario.create');
    Route::delete('/funcionario/d/{id}', [FuncionarioController::class, 'destroy'])->name('admin.funcionario.destroy');

    //  - Feedback
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
    Route::post('/feedback', [FeedbackController::class, 'create'])->name('admin.feedback.create');
    Route::delete('/feedback', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');
});

require __DIR__.'/auth.php';
