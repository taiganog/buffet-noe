<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Models\Cliente;

class ClienteController extends Controller {
   public function create(Request $request): RedirectResponse {
        Cliente::create($request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'rg' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
            'telefone_2' => 'required'
        ]));

        return redirect()->route('welcome');
    }
}
