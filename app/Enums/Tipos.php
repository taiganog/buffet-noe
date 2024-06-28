<?php

namespace App\Enums;

enum Tipos: string {
    case FESTA_INFANTIL = 'Festa Infantil';
    case FESTA_15_ANOS = '15 Anos';
    case FESTA_ADULTO = 'Festa Adulto';
    case CASAMENTO = 'Casamento';
    case FORMATURA = 'Formatura';
    case CHURRASCO = 'Churrasco';
    case CONFRATERNIZACAO = 'Confraternização';

    public static function all(): array {
        return [
            'FESTA_INFANTIL' => 'Festa Infantil',
            'FESTA_15_ANOS' => '15 Anos',
            'FESTA_ADULTO' => 'Festa Adulto',
            'CASAMENTO' => 'Casamento',
            'FORMATURA' => 'Formatura',
            'CHURRASCO' => 'Churrasco',
            'CONFRATERNIZACAO' => 'Confraternização'
        ];
    }
}
