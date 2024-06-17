<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Evento;
use App\Models\Cliente;

class EventoController extends Controller
{
    public function index(): Response {
        return Inertia::render('Teste', [
            'v1' => Evento::all(),
            'v2' => Cliente::all(),

            'v3' => Cliente::find(1)->evento,
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

        return redirect()->route('welcome');
    }
}
