<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Complemento;

class ComplementoController extends Controller
{
    public function index(): Response {
        return Inertia::render('Teste', [
            'v1' => Complemento::all(),

            'v2' => Complemento::find(1)->evento->find(1)->cliente,
        ]);
    }

    public function create(Request $request): RedirectResponse {
        Complemento::create($request->validate([
            'cascata' => 'required',
            'salgado' => 'required',
            'buffet' => 'required',
            'maitre' => 'required',
            'porteiro' => 'required',
            'montagem' => 'required',
            'taca' => 'required',
            'cumbuca' => 'required',
            'prataria' => 'required',
            'louca_sobremesa' => 'required',
            'cestinha' => 'required',
            'garcom' => 'required',
            'cozinheiro' => 'required',
            'bar' => 'required',
            'ajudante_cozinha' => 'required',
            'entradas' => 'required',
            'cardapio' => 'required',

            // FK
            'evento_id' => 'required'
        ]));

        return redirect()->route('welcome');
    }
}
