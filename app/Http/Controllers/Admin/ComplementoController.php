<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\ServicoEvento;

class ComplementoController extends Controller {
    public function create(Request $request): RedirectResponse {
        $servicos = $request->input('servicosEscolhidos');
        foreach($servicos as $servico) {
            $servicoEscolhido = new ServicoEvento();
            $servicoEscolhido->servico_id = $servico['id'];
            $servicoEscolhido->evento_id = $request->input('evento_id');
            $servicoEscolhido->quantidade = $servico['quantidade'];
            $servicoEscolhido->valor = $servico['valor'];
            $servicoEscolhido->save();
        }

        return redirect()->route('admin.evento.unico', $request->input('evento_id'));
    }

    public function update(Request $request): RedirectResponse {
        ServicoEvento::where('evento_id', $request->input('evento_id'))->delete();

        $servicos = $request->input('servicosEscolhidos');
        foreach($servicos as $servico) {
            $servicoEscolhido = new ServicoEvento();
            $servicoEscolhido->servico_id = $servico['id'];
            $servicoEscolhido->evento_id = $request->input('evento_id');
            $servicoEscolhido->quantidade = $servico['quantidade'];
            $servicoEscolhido->valor = $servico['valor'];
            $servicoEscolhido->save();
        }

        return back();
    }
}
