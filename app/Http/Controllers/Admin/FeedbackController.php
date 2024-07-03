<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

use App\Http\Controllers\Controller;

use App\Enums\Tipos;
use App\Models\Orcamento;
use App\Models\Promocao;

class FeedbackController extends Controller {
    // Verificar se há promoção ativa
    private function verificarPromocaoAtiva(): string {
        $programada = 0;

        // Pegar todas as promoções
        $promocoes = Promocao::all();
        // Checar se existem promoções
        if($promocoes->isNotEmpty()) {
            foreach($promocoes as $promocao) {
                // Checar se há uma promoção ativa no dia de hoje
                if(Carbon::now()->between($promocao->data_inicial, $promocao->data_final)) {
                    // Se houver, retorne 'Ativa'
                    return 'Ativa';
                // Checar se há uma promoção por vir ou não
                } else if($promocao->data_inicial > Carbon::now()) {
                    $programada = $promocao->id;
                }
            }
        }

        // Se houver promoção programada retornar a data
        return $programada ? 'Programada para ' . Carbon::parse($promocoes->find($programada)->data_inicial)->format('d/m/Y') : 'Não';
    }

    public function index(): Response {
        // Pegar orcamento e formatar o tipo para apresentação
        $orcamentos = Orcamento::orderBy('created_at', 'desc')->get();

        // Vereficar se há promoção ativa ou por vir
        $promocaoAtiva = $this->verificarPromocaoAtiva();

        return Inertia::render('Admin/Feedback', [
            'feedbacks' => $orcamentos,
            'promocaoAtiva' => $promocaoAtiva,
            'tipo' => Tipos::all()
        ]);
    }

    public function create(Request $request): RedirectResponse {
        Promocao::create($request->validate([
            'data_inicial' => 'required',
            'data_final' => 'required',
            'mensagem' => 'required',
        ],
        [
            'data_inicial.required' => 'A data inicial é obrigatória',
            'data_final.required' => 'A data final é obrigatória',
            'mensagem.required' => 'A mensagem é obrigatória',
        ]
    ));

        return back();
    }

    public function destroy(int $id): RedirectResponse {
        $promocao = Promocao::find($id);

        $promocao->delete();

        return to_route('admin.feedback');
    }
}
