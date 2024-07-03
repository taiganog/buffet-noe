<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Cliente;

use App\Http\Controllers\Controller;

class ClienteController extends Controller {

    public function index(): Response {
        return Inertia::render('Teste', [
            'v1' => Cliente::find(1)->evento
        ]);
    }

    public function create(Request $request): RedirectResponse {
        Cliente::create($request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'rg' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
            'telefone_2' => 'required'
        ],
        [
            'nome.required' => 'O nome é obrigatório',
            'cpf.required' => 'O CPF é obrigatório',
            'rg.required' => 'O RG é obrigatório',
            'endereco.required' => 'O endereço é obrigatório',
            'telefone.required' => 'O telefone é obrigatório',
            'telefone_2.required' => 'O telefone secundário é obrigatório',
        ]
    ));

        return back();
    }
}
