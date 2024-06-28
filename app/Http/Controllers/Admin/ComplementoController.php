<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;

use App\Models\Complemento;
use App\Models\Valor;

class ComplementoController extends Controller {
    public function create(Request $request): RedirectResponse {
        $request->validate([
            'cascata' => 'nullable|numeric',
            'cascata_valor' => 'nullable|numeric',
            'salgado' => 'nullable|numeric',
            'salgado_valor' => 'nullable|numeric',
            'buffet' => 'nullable|numeric',
            'buffet_valor' => 'nullable|numeric',
            'maitre' => 'nullable|numeric',
            'maitre_valor' => 'nullable|numeric',
            'porteiro' => 'nullable|numeric',
            'porteiro_valor' => 'nullable|numeric',
            'montagem' => 'nullable|numeric',
            'montagem_valor' => 'nullable|numeric',
            'taca' => 'nullable|numeric',
            'taca_valor' => 'nullable|numeric',
            'cumbuca' => 'nullable|numeric',
            'cumbuca_valor' => 'nullable|numeric',
            'prataria' => 'nullable|numeric',
            'prataria_valor' => 'nullable|numeric',
            'louca_sobremesa' => 'nullable|numeric',
            'louca_sobremesa_valor' => 'nullable|numeric',
            'cestinha' => 'nullable|numeric',
            'cestinha_valor' => 'nullable|numeric',
            'garcom' => 'nullable|numeric',
            'garcom_valor' => 'nullable|numeric',
            'cozinheiro' => 'nullable|numeric',
            'cozinheiro_valor' => 'nullable|numeric',
            'bar' => 'nullable|numeric',
            'bar_valor' => 'nullable|numeric',
            'ajudante_cozinha' => 'nullable|numeric',
            'ajudante_cozinha_valor' => 'nullable|numeric',

            'entradas' => 'required',
            'cardapio' => 'required',
        ]);

        Complemento::create([
            'cascata' => $request->input('cascata'),
            'salgado' => $request->input('salgado'),
            'buffet' => $request->input('buffet'),
            'maitre' => $request->input('maitre'),
            'porteiro' => $request->input('porteiro'),
            'montagem' => $request->input('montagem'),
            'taca' => $request->input('taca'),
            'cumbuca' => $request->input('cumbuca'),
            'prataria' => $request->input('prataria'),
            'louca_sobremesa' => $request->input('louca_sobremesa'),
            'cestinha' => $request->input('cestinha'),
            'garcom' => $request->input('garcom'),
            'cozinheiro' => $request->input('cozinheiro'),
            'bar' => $request->input('bar'),
            'ajudante_cozinha' => $request->input('ajudante_cozinha'),

            'entradas' => $request->input('entrada'),
            'cardapio' => $request->input('cardapio'),
        ]);

        Valor::create([
            'cascata' => $request->input('cascata_valor'),
            'salgado' => $request->input('salgado_valor'),
            'buffet' => $request->input('buffet_valor'),
            'maitre' => $request->input('maitre_valor'),
            'porteiro' => $request->input('porteiro_valor'),
            'montagem' => $request->input('montagem_valor'),
            'taca' => $request->input('taca_valor'),
            'cumbuca' => $request->input('cumbuca_valor'),
            'prataria' => $request->input('prataria_valor'),
            'louca_sobremesa' => $request->input('louca_sobremesa_valor'),
            'cestinha' => $request->input('cestinha_valor'),
            'garcom' => $request->input('garcom_valor'),
            'cozinheiro' => $request->input('cozinheiro_valor'),
            'bar' => $request->input('bar_valor'),
            'ajudante_cozinha' => $request->input('ajudante_cozinha_valor'),
        ]);

        return redirect()->route('admin.evento.unico', $request->input('evento_id'));
    }
}
