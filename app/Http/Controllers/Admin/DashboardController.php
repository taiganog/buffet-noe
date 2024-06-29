<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\FormatoEvento;

use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

use App\Models\Evento;
use App\Enums\Tipos;

class DashboardController extends Controller {
    // Retorna os clientes dos eventos no objeto evento
    public function pegarClientes($eventos): void {
        foreach($eventos as $evento) {
            $evento->cliente;
        }
    }

    // Retorna todos os eventos do mês
    private function pegarEventosDoMes(): object {
        $eventos = Evento::whereBetween('data', [
            Carbon::now()->startOfMonth()->format('Y-m-d'),
            Carbon::now()->endOfMonth()->format('Y-m-d'),
        ])->get();

        return $eventos;
    }

    // Retorna valor do mês somado
    public function pegarValorDoMes(): int {
        $valorDoMes = 0;
        $eventos = $this->pegarEventosDoMes();

        foreach ($eventos as $evento) {
            $valorDoMes += $evento->valor->total;
        }

        return $valorDoMes;
    }

    // Formata data e tipo dos eventos
    public function formatar($eventos): void {
        foreach($eventos as $evento) {
            $evento->formatarData();
        }
    }

    // Retorna proximos 3 eventos
    private function pegarProximosEventos(): object {
        $eventos = Evento::where('data', '>=', Carbon::now()->format('Y-m-d'))
                        ->orderBy('data')
                        ->limit(3)
                        ->get();

        return $eventos;
    }

    // Retorna o valor dos eventos do mês que já foram realizados
    private function pegarValorRecebido(): int {
        $valorRecebido = 0;
        $eventos = Evento::whereBetween('data', [
            Carbon::now()->startOfMonth()->format('Y-m-d'),
            Carbon::now()->format('Y-m-d'),
        ])->get();

        foreach($eventos as $evento) {
            $valorRecebido += $evento->valor->total;
        }

        return $valorRecebido;
    }

    public function index(): Response {
        $eventos = $this->pegarProximosEventos();
        $this->pegarClientes($eventos);
        $this->formatar($eventos);

        $valorDoMes = $this->pegarValorDoMes();
        $numeroEventosTotal = $this->pegarEventosDoMes()->count();
        $valorRecebido = $this->pegarValorRecebido();

        return Inertia::render('Admin/Dashboard', [
            'valorDoMes' => $valorDoMes,
            'numeroEventosTotal' => $numeroEventosTotal,
            'eventos' => $eventos,
            'valorRecebido' => $valorRecebido,
            'tipo' => Tipos::all()
        ]);
    }
}
