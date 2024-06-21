<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;

use App\Models\Orcamento;
use App\Models\Promocao;

use App\Managers\FormatarManager;

class FeedbackController extends Controller {
    // Formatar o tipo de orçamentos
    private function formatar($orcamentos): void {
        $formatarManager = new FormatarManager;
        foreach($orcamentos as $orcamento) {
            $formatarManager->formatarTipo($orcamento);
        }
    }

    public function index(): Response {
        // Pegar orcamento e formatar o tipo para apresentação
        $orcamentos = Orcamento::all();
        $this->formatar($orcamentos);

        return Inertia::render('Admin/Feedback', [
            'feedbacks' => $orcamentos
        ]);
    }

    public function create(Request $request): Response {
        Promocao::create($request->validate([
            'data_inicial' => 'required',
            'data_final' => 'required',
            'mensagem' => 'required',
        ]));

        return Inertia::render('Admin/Feedback');
    }

    public function destroy(Request $request): RedirectResponse {
        $promocao = Promocao::find($request->input('id'));

        $promocao->delete();

        return to_route('admin.feedback');
    }
}
