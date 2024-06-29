<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

use Spatie\LaravelPdf\Facades\Pdf;

use Carbon\Carbon;

use App\Enums\Complementos;
use App\Models\Evento;
use App\Managers\FormatarManager;
use App\Models\Complemento;

use App\Enums\Tipos;

class PDFController extends Controller {
    public function index($id, $desconto = 0) {
        $evento = Evento::find($id);

        $evento->formatarData('d/m/Y');
        $evento->cliente;
        $evento->complemento;
        $evento->valor;
        $evento->tipo = Tipos::all()[$evento->tipo];

        $complementos = Complementos::all();

        return view('contrato', [
            'data' => Carbon::now(),
            'evento' => $evento,
            'complementos' => $complementos,
            'desconto' => $desconto,
        ]);
    }
}
