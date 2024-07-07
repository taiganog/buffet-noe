<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;

use App\Models\Evento;
use App\Models\Servico;

class Teste extends Controller
{
    public function index(): Response {
        $evento = Evento::find(1);
        $servico = Servico::all();
        $evento->servicos;
        $evento->cliente;

        return Inertia::render('Admin/Teste', [
            'evento' => $evento,
            'servicos' => $servico
        ]);
    }
}
