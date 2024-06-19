<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;

use App\Models\Evento;

class DashboardController extends Controller
{
    // Retorna todos os eventos do mês
    private function pegarEventosDoMes(): object {
        $eventos = Evento::whereBetween('data', [
            Carbon::now()->startOfMonth()->format('Y-m-d'),
            Carbon::now()->endOfMonth()->format('Y-m-d'),
        ])->get();

        return $eventos;
    }

    // Retorna valor do mês somado
    private function pegarValorDoMes(): int {
        $valorDoMes = 0;
        $eventos = $this->pegarEventosDoMes();

        foreach ($eventos as $evento) {
            $valorDoMes += $evento->valor->total;
        }

        return $valorDoMes;
    }

    // Retorna proximos 3 eventos
    private function pegarProximosEventos(): object {
        $eventos = Evento::where('data', '>=', Carbon::now()->format('Y-m-d'))
                        ->orderBy('data')
                        ->limit(3)
                        ->get();

        return $eventos;
    }

    // Retorna os clientes dos eventos no objeto evento
    private function pegarClientes($eventos): void {
        foreach($eventos as $evento) {
            $evento->cliente;
        }
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

    // Formata a data dos eventos
    private function formatarData($eventos): void {
        foreach($eventos as $evento) {
            $evento->data = Carbon::parse($evento->data)->format('d/m/Y');
        }
    }

    // Formata o tipo dos eventos
    private function formatarTipo($eventos): void {
        foreach($eventos as $evento) {
            switch($evento->tipo) {
                case 'FESTA_INFANTIL': $evento->tipo = 'Festa Infantil'; break;
                case '15_ANOS': $evento->tipo = 'Festa 15 anos'; break;
                case 'FESTA_ADULTO': $evento->tipo = 'Festa Adulto'; break;
                case 'CASAMENTO': $evento->tipo = 'Casamento'; break;
                case 'FORMATURA': $evento->tipo = 'Formatura'; break;
                case 'CONFRATERNIZACAO': $evento->tipo = 'Confraternização'; break;
                case 'CHURRASCO': $evento->tipo = 'Churrasco'; break;
            }
        }
    }

    public function index(): Response {
        $eventos = $this->pegarProximosEventos();
        $this->pegarClientes($eventos);
        $this->formatarData($eventos);
        $this->formatarTipo($eventos);

        $valorDoMes = $this->pegarValorDoMes();
        $numeroEventosTotal = $this->pegarEventosDoMes()->count();
        $valorRecebido = $this->pegarValorRecebido();

        return Inertia::render('Admin/Dashboard', [
            'valorDoMes' => $valorDoMes,
            'numeroEventosTotal' => $numeroEventosTotal,
            'eventos' => $eventos,
            'valorRecebido' => $valorRecebido,
        ]);
    }
}
