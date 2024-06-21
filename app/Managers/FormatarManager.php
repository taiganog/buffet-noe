<?php

namespace App\Managers;

use Carbon\Carbon;

class FormatarManager {
    /*
    / Formata a data dos obj
    / -----------------------
    / Default= formata para d/m/Y o atributo 'data' do obj
    / caso seja passado uma variavel data é possível formatar
    / created_at e updated_at
    */
    public function formatarData($obj, $formato = 'd/m/Y'): void {
        $obj->data = Carbon::parse($obj->data)->format($formato);
    }

    // Formata o tipo dos obj
    public function formatarTipo($obj): void {
        switch($obj->tipo) {
            case 'FESTA_INFANTIL':   $obj->tipo = 'Festa Infantil';   break;
            case '15_ANOS':          $obj->tipo = 'Festa 15 anos';    break;
            case 'FESTA_ADULTO':     $obj->tipo = 'Festa Adulto';     break;
            case 'CASAMENTO':        $obj->tipo = 'Casamento';        break;
            case 'FORMATURA':        $obj->tipo = 'Formatura';        break;
            case 'CONFRATERNIZACAO': $obj->tipo = 'Confraternização'; break;
            case 'CHURRASCO':        $obj->tipo = 'Churrasco';        break;
        }
    }
}
