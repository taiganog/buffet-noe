<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

use Spatie\LaravelPdf\Facades\Pdf;
use function Spatie\LaravelPdf\Support\pdf;
use Spatie\Browsershot\Browsershot;

use Carbon\Carbon;

use App\Enums\Complementos;
use App\Models\Evento;
use App\Managers\FormatarManager;
use App\Models\Servico;

use App\Enums\Tipos;

class PDFController extends Controller {
    private function calcularTotal($servicos): int {
        $total = 0;

        foreach($servicos as $servico) {
            $total += $servico->valor;
        }

        return $total;
    }

    public function index(int $id, Request $request) {
        $evento = Evento::find($id);
        $evento->formatarData('d/m/Y');
        $evento->cliente;
        $evento->servicos;
        $evento->tipo = Tipos::all()[$evento->tipo];

        $servicos = Servico::all();

        $total = $this->calcularTotal($evento->servicos);

        return view('contrato', [
            'data' => Carbon::now(),
            'evento' => $evento,
            'servicos' => $servicos,
            'desconto' => $request->input('valorDesconto'),
            'total' => $total
            ]);
    }
}
