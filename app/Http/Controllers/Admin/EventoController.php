<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\Cliente;

use App\Enums\Complementos;
use App\Enums\Tipos;

class EventoController extends Controller {
    private function adicionarDetalhes($eventos): void {
        foreach ($eventos as $evento) {
            $evento->formatarData();
            $evento->cliente;
            $evento->complemento;
            $evento->valor;
        }
    }

    public function index($id = null) {
        $evento = Evento::find($id);

        // Checar se evento existe antes de entregar a rota de detalhes
        if($evento) {
            $evento->cliente;
            $evento->complemento;
            $evento->valor;
            $evento->formatarData();

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
        ]);

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
}
