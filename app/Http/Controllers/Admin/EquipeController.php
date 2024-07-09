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
        Equipe::find($request->id)->update($request->all());

        return back();
    }
}
