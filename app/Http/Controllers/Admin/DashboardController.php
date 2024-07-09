<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\FormatoEvento;

use Inertia\Inertia;
use Inertia\Response;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

use App\Models\Evento;
use App\Models\Promocao;
use App\Enums\Tipos;

class DashboardController extends Controller {
    // Verificar se há promoção ativa
    private function verificarPromocaoAtiva(): string {
        $programada = 0;

        // Pegar todas as promoções
        $promocoes = Promocao::all();
        // Checar se existem promoções
        if($promocoes->isNotEmpty()) {
            foreach($promocoes as $promocao) {
                // Checar se há uma promoção ativa no dia de hoje
                if(Carbon::now()->between($promocao->data_inicial, $promocao->data_final)) {
                    // Se houver, retorne 'Ativa'
                    return 'Ativa';
                // Checar se há uma promoção por vir ou não
                } else if($promocao->data_inicial > Carbon::now()) {
                    $programada = $promocao->id;
                }
            }
        }

        // Se houver promoção programada retornar a data
        return $programada ? 'Programada para ' . Carbon::parse($promocoes->find($programada)->data_inicial)->format('d/m/Y') : 'Não';
    }

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
            foreach($evento->servicos as $servico) {
                $valorDoMes += $servico->valor;
            }
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

        foreach ($eventos as $evento) {
            foreach($evento->servicos as $servico) {
                $valorRecebido += $servico->valor;
            }
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
            'tipo' => Tipos::all(),
            'promocao' => $this->verificarPromocaoAtiva()
        ]);
    }
}
