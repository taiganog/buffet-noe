<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\Cliente;

class EventoController extends Controller
{
    public function index($id = null): Response {
        if($id) {
            $evento = Evento::find($id);
            $evento->cliente;
            $evento->complemento;
            $evento->valor;

            return Inertia::render('Admin/Evento', [
                'evento' => $evento
            ]);
        }

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

        return redirect()->route('welcome');
    }
}
