<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Spatie\LaravelPdf\Facades\Pdf;

use Carbon\Carbon;

use App\Enums\Complementos;
use App\Models\Evento;
use App\Managers\FormatarManager;
use App\Models\Complemento;

class PDFController extends Controller {
    public function index($id, $desconto = 0) {
        $formatarManager = new FormatarManager;
        $evento = Evento::find($id);

        $formatarManager->formatarData($evento, 'd/m/Y à\s H:i');
        $formatarManager->formatarTipo($evento);
        $evento->cliente;
        $evento->complemento;
        $evento->valor;

        $complementos = Complementos::all();

        return view('contrato', [
            'data' => Carbon::now(),
            'evento' => $evento,
            'complementos' => $complementos,
            'desconto' => $desconto,
        ]);
    }
}
