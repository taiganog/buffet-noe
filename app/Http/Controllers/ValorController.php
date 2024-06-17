<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Valor;

class ValorController extends Controller
{
    public function index(): Response {
        return Inertia::render('Teste', [
            'v1' => Valor::all(),
            'v2' => Valor::find(1)->evento
        ]);
    }

    public function create(Request $request): RedirectResponse {
        Valor::create($request->validate([
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

            'evento_id' => 'required'
        ]));

        return redirect()->route('welcome');
    }
}
