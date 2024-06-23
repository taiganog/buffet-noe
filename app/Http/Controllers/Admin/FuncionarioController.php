<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;

use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index(): Response {
        return Inertia::render('Admin/Funcionario', [
            'funcionarios' => Funcionario::orderBy('nome')->get(),
        ]);
    }

    public function create(Request $request): Response {
        Funcionario::create($request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'chave_pix' => 'nullable'
        ]));

        return Inertia::render('Admin/Funcionario');
    }

    public function destroy(int $id): RedirectResponse {
        $funcionario = Funcionario::find($id);

        $funcionario->delete();

        return to_route('admin.funcionario');
    }
}
