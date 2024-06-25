<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Spatie\LaravelPdf\Facades\Pdf;

use App\Models\Evento;
use App\Managers\FormatarManager;

class PDFController extends Controller {
    public function index() {
        $formatarManager = new FormatarManager;
        $evento = Evento::find(2);

        $formatarManager->formatarData($evento, 'd/m/Y à\s H:i');
        $formatarManager->formatarTipo($evento);
        $evento->cliente;
        $evento->complemento;
        $evento->valor;

        $complementos = [
            'cascata' => 'Cascata',
            'crepe' => 'Crepe',
            'salgado' => 'Salgado',
            'buffet' => 'Buffet',
            'maitre' => 'Maitre',
            'porteiro' => 'Porteiro',
            'montagem' => 'Montagem',
            'taca' => 'Taças',
            'cumbuca' => 'Cumbuca',
            'prataria' => 'Kit Prataria (Talheres e pratos)',
            'louca_sobremesa' => 'Louça de Sobremesa',
            'cestinha' => 'Cestinha',
            'garcom' => 'Garcom',
            'cozinheiro' => 'Cozinheiro',
            'bar' => 'Bar',
            'ajudante_cozinha' => 'Ajudante de Cozinha',
        ];

        return Pdf::view('contrato', [
            'data' => Carbon::now(),
            'evento' => $evento,
            'complementos' => $complementos
        ]);
    }
/*
    public function download() {
        $formatarManager = new FormatarManager;
        $evento = Evento::find(1);

        $formatarManager->formatarData($evento, 'd/m/Y à\s H:i');
        $formatarManager->formatarTipo($evento);
        $evento->cliente;
        $evento->complemento;
        $evento->valor;

        Pdf::view('contrato', [
            'data' => Carbon::now(),
            'evento' => $evento,
        ]);
        return $pdf->stream('contrato.pdf');
    }
        */
}
