<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;

use App\Models\Valor;
use App\Models\Evento;

class DashboardController extends Controller
{
    // Retorna valor do mês somado
    private function pegarValorDoMes(): int {
        $valorDoMes = 0;
        $eventos = Evento::whereBetween('data', [
            Carbon::now()->startOfMonth()->format('Y-m-d'),
            Carbon::now()->endOfMonth()->format('Y-m-d'),
        ])->get();

        foreach ($eventos as $evento) {
            $valorDoMes += $evento->valor->cascata;
            $valorDoMes += $evento->valor->salgado;
            $valorDoMes += $evento->valor->buffet;
            $valorDoMes += $evento->valor->maitre;
            $valorDoMes += $evento->valor->porteiro;
            $valorDoMes += $evento->valor->montagem;
            $valorDoMes += $evento->valor->taca;
            $valorDoMes += $evento->valor->cumbuca;
            $valorDoMes += $evento->valor->prataria;
            $valorDoMes += $evento->valor->louca_sobremesa;
            $valorDoMes += $evento->valor->cestinha;
            $valorDoMes += $evento->valor->garcom;
            $valorDoMes += $evento->valor->cozinheiro;
            $valorDoMes += $evento->valor->bar;
            $valorDoMes += $evento->valor->ajudante_cozinha;
        }

        return $valorDoMes;
    }

    public function index(): Response {
        $valorDoMes = $this->pegarValorDoMes();

        return Inertia::render('Teste', [
            'valorDoMes' => $valorDoMes,
        ]);
    }
}
