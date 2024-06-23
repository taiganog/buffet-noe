<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\Evento;

use App\Managers\FormatarManager;

class EventoController extends Controller {
    public function index($id = null): Response {
        $evento = Evento::find($id);
        $formatarManager = new FormatarManager;

        // Checar se evento existe antes de entregar a rota de detalhes
        if($evento) {
            $evento->cliente;
            $evento->complemento;
            $evento->valor;

            $formatarManager->formatarTipo($evento);
            $formatarManager->formatarData($evento, 'd/m/Y H:i');

            return Inertia::render('Admin/Evento', [
                'evento' => $evento
            ]);
        }

        // Sem paramêtros ou se rota não existe redirecionar a geral
        return Inertia::render('Admin/Evento');
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
