<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Enums\Complementos;
use App\Managers\FormatarManager;

class EventoController extends Controller {
    private function adicionarDetalhes($eventos): void {
        $formatarManager = new FormatarManager;

        foreach ($eventos as $evento) {
            $formatarManager->formatarData($evento, 'd/m/Y H:i');
            $formatarManager->formatarTipo($evento);

            $evento->cliente;
            $evento->complemento;
            $evento->valor;
        }
    }

    public function index($id = null) {
        $evento = Evento::find($id);
        $formatarManager = new FormatarManager;

        // Checar se evento existe antes de entregar a rota de detalhes
        if($evento) {
            $evento->cliente;
            $evento->complemento;
            $evento->valor;

            $formatarManager->formatarTipo($evento);
            $formatarManager->formatarData($evento, 'd/m/Y H:i');

            return Inertia::render('Admin/EventoUnico', [
                'evento' => $evento,
                'complementos' => Complementos::all(),
            ]);
        }

        // Sem paramêtros ou se rota não existe redirecionar a geral
        $eventos = Evento::orderBy('data', 'desc')->get();
        $this->adicionarDetalhes($eventos);
        return Inertia::render('Admin/Evento', [
            'eventos' => $eventos,
        ]);
    }

    public function cadastroCliente(): Response {
        return Inertia::render('Admin/EventoCadastroCliente');
    }

    public function cadastroEvento(): Response {
        return Inertia::render('Admin/EventoCadastroEvento');
    }

    public function cadastroComplemento(): Response {
        return Inertia::render('Admin/EventoCadastroComplemento', [
            'complementos' => Complementos::all()
        ]);
    }

    public function create(Request $request): RedirectResponse {
        Evento::create($request->validate([
            'local' => 'required',
            'data' => 'required',
            'duracao' => 'required',
            'tipo' => 'required',
            'numero_convidados' => 'required',
            'observacao' => 'required',

            // FK
            'cliente_id' => 'required'
        ]));

        return redirect()->route('admin.dashboard');
    }
}
