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
        // Validar request antes de continuar
        $request->validate([
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
        ]);

        // Pegar valor total
        $valorTotal = 0;
        $valorTotal += $request->input('cascata');
        $valorTotal += $request->input('salgado');
        $valorTotal += $request->input('buffet');
        $valorTotal += $request->input('maitre');
        $valorTotal += $request->input('porteiro');
        $valorTotal += $request->input('montagem');
        $valorTotal += $request->input('taca');
        $valorTotal += $request->input('cumbuca');
        $valorTotal += $request->input('prataria');
        $valorTotal += $request->input('louca_sobremesa');
        $valorTotal += $request->input('cestinha');
        $valorTotal += $request->input('garcom');
        $valorTotal += $request->input('cozinheiro');
        $valorTotal += $request->input('bar');
        $valorTotal += $request->input('ajudante_cozinha');

        // Inserir dados no banco
        $valor = new Valor;
        $valor->cascata = $request->input('cascata');
        $valor->salgado = $request->input('salgado');
        $valor->buffet = $request->input('buffet');
        $valor->maitre = $request->input('maitre');
        $valor->porteiro = $request->input('porteiro');
        $valor->montagem = $request->input('montagem');
        $valor->taca = $request->input('taca');
        $valor->cumbuca = $request->input('cumbuca');
        $valor->prataria = $request->input('prataria');
        $valor->louca_sobremesa = $request->input('louca_sobremesa');
        $valor->cestinha = $request->input('cestinha');
        $valor->garcom = $request->input('garcom');
        $valor->cozinheiro = $request->input('cozinheiro');
        $valor->bar = $request->input('bar');
        $valor->ajudante_cozinha = $request->input('ajudante_cozinha');
        $valor->evento_id = $request->input('evento_id');
        $valor->total = $valorTotal;
        $valor->save();

        // Redirect
        return redirect()->route('welcome');
    }
}
