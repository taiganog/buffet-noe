<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

use App\Models\Equipe;

class EquipeController extends Controller
{
    public function create(Request $request): RedirectResponse {
        $funcionarios = $request->input('funcionariosEscolhidos');
        foreach($funcionarios as $funcionario) {
            $equipe = new Equipe();
            $equipe->funcionario_id = $funcionario['id'];
            $equipe->evento_id = $request->input('evento_id');
            $equipe->funcao = $funcionario['funcao'];
            $equipe->save();
        }

        return back();
    }

    public function update(Request $request): RedirectResponse {
        // dd($request);
        Equipe::where('evento_id', $request->input('evento_id'))->delete();

        $funcionarios = $request->input('equipeEscolhida');
        foreach($funcionarios as $funcionario) {
            $funcionarioEscolhido = new Equipe();
            $funcionarioEscolhido->funcionario_id = $funcionario['funcionario_id'];
            $funcionarioEscolhido->evento_id = $request->input('evento_id');
            $funcionarioEscolhido->funcao = $funcionario['funcao'];
            $funcionarioEscolhido->save();
        }

        return back();
    }
}
