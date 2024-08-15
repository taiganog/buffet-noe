<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\RedirectResponse;

class ServicoController extends Controller
{
    public function index(): Response {
        $servicos = Servico::all();
        return Inertia::render('Admin/Servico', [
            'servicos' => $servicos
        ]);
    }

    public function create(Request $request): RedirectResponse {
        Servico::create($request->validate([
            'nome' => 'required',
            'valor' => 'required'
        ],
        [
            'nome.required' => 'O campo nome e obrigatório',
            'valor.required' => 'O campo valor e obrigatório'
        ]
        ));

        return back();
    }

    public function update(Request $request, int $id): RedirectResponse {
        $servico = Servico::find($id);

        $servico->nome = $request->input('nome');
        $servico->valor = $request->input('valor');

        $servico->save();

        return back();
    }
}
