<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\Cliente;
use App\Models\Servico;
use App\Enums\Complementos;
use App\Enums\Tipos;

class EventoController extends Controller {
    private function adicionarDetalhes($eventos): void {
        foreach ($eventos as $evento) {
            $evento->formatarData();
            $evento->cliente;
        }
    }

    public function index($id = null) {
        $evento = Evento::find($id);

        // Checar se evento existe antes de entregar a rota de detalhes
        if($evento) {
            $evento->cliente;
            $evento->servicos;
            $evento->valor;
            $evento->formatarData('d/m/Y à\s H:i');

            return Inertia::render('Admin/EventoUnico', [
                'evento' => $evento,
                'servicos' => Servico::all(),
                'tipo' => Tipos::all()
            ]);
        }
        /******* amo o matheus <3 *********/

        // Sem paramêtros ou se rota não existe redirecionar a geral
        $eventos = Evento::orderBy('data', 'desc')->get();
        $this->adicionarDetalhes($eventos);
        return Inertia::render('Admin/Evento', [
            'eventos' => $eventos,
            'tipo' => Tipos::all()
        ]);
    }

    public function cadastro(): Response {
        return Inertia::render('Admin/EventoCadastro', [
            'complementos' => Complementos::all(),
            'clientes' => Cliente::all(),
            'tipos' => Tipos::all()
        ]);
    }

    public function create(Request $request): RedirectResponse {
        $request->validate([
            'local' => 'required',
            'tipo' => 'required',
            'duracao' => 'required',
            'dia' => 'required',
            'numero_convidados' => 'required',
            'observacao' => 'nullable',
        ],
        [
            'local.required' => 'O local é obrigatório',
            'tipo.required' => 'O tipo é obrigatório',
            'duracao.required' => 'A duração é obrigatório',
            'dia.required' => 'A data é obrigatório',
            'numero_convidados.required' => 'O número de convidados é obrigatório',
        ]
        );
        $cliente = Cliente::where('cpf', $request->input('cpf_cliente'))->first()->id;

        $evento = new Evento;
        $evento->local = $request->input('local');
        $evento->data = $request->input('dia');
        $evento->duracao = $request->input('duracao');
        $evento->tipo = $request->input('tipo');
        $evento->numero_convidados = $request->input('numero_convidados');
        $evento->observacao = $request->input('observacao');
        $evento->cliente_id = $cliente;

        $evento->save();

        return redirect()->route('admin.evento.unico', $evento->id);
    }

    public function editar(int $id): Response {
        $evento = Evento::find($id);
        $evento->cliente;
        $evento->servicos;

        return Inertia::render('Admin/EventoEditar', [
            'evento' => $evento,
            'servicos' => Servico::all(),
            'tipo' => Tipos::all()
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse {
        $request->validate([
                'local' => 'required',
                'duracao' => 'required',
                'dia' => 'required',
                'numero_convidados' => 'required',
                'observacao' => 'nullable',
            ],
            [
                'local.required' => 'O local é obrigatório',
                'duracao.required' => 'A duração é obrigatório',
                'dia.required' => 'A data é obrigatório',
                'numero_convidados.required' => 'O número de convidados é obrigatório',
            ]
        );

        $evento = Evento::find($id);
        $evento->local = $request->input('local');
        $evento->data = $request->input('dia');
        $evento->duracao = $request->input('duracao');
        $evento->numero_convidados = $request->input('numero_convidados');
        $evento->observacao = $request->input('observacao');

        $evento->save();

        return back();
    }
}
