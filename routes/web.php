<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Rotas Administrativas
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\Admin\ComplementoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FuncionarioController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\ServicoController;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\Admin\Teste;

// Rotas Públicas


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

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
    Route::post('/evento', [EventoController::class, 'create'])->name('admin.evento.create');
    Route::get('/evento/{id}/editar', [EventoController::class, 'editar'])->name('admin.evento.editar');
    Route::put('/evento/{id}/editar', [EventoController::class, 'update'])->name('admin.evento.update');

    //  - Cliente
    Route::post('/cliente', [ClienteController::class, 'create'])->name('admin.cliente.create');

    //  - Complementos
    Route::post('/complemento', [ComplementoController::class, 'create'])->name('admin.complemento.create');
    Route::put('/complemento', [ComplementoController::class, 'update'])->name('admin.complemento.update');

    //  - Funcionários
    Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('admin.funcionario');
    Route::post('/funcionario', [FuncionarioController::class, 'create'])->name('admin.funcionario.create');
    Route::delete('/funcionario/d/{id}', [FuncionarioController::class, 'destroy'])->name('admin.funcionario.destroy');

    //  - Equipe
    Route::post('/equipe', [EquipeController::class, 'create'])->name('admin.equipe.create');
    Route::put('/equipe', [EquipeController::class, 'update'])->name('admin.equipe.update');

    //  - Feedback
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('admin.feedback');
    Route::post('/feedback', [FeedbackController::class, 'create'])->name('admin.feedback.create');
    Route::delete('/feedback', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');

    //  - Servicos
    Route::get('/servico', [ServicoController::class, 'index'])->name('admin.servico');
    Route::post('/servico', [ServicoController::class, 'create'])->name('admin.servico.create');

    //  - Teste
    Route::get('/teste', [Teste::class, 'index'])->name('admin.teste');
});

require __DIR__.'/auth.php';
