<?php

namespace App\Enums;

enum Complementos: string {
    case cascata = 'Cascata';
    case salgado = 'Salgado';
    case buffet = 'Buffet';
    case maitre = 'Maitre';
    case crepe = 'Crepe';
    case porteiro = 'Porteiro';
    case montagem = 'Montagem';
    case taca = 'Taca';
    case cumbuca = 'Cumbuca';
    case prataria = 'Prataria';
    case louca_sobremesa = 'Louca/Sobremesa';
    case cestinha = 'Cestinha';
    case garcom = 'Garcom';
    case cozinheiro = 'Cozinheiro';
    case bar = 'Bar';
    case ajudante_cozinha = 'Ajudante Cozinha';

    public static function all(): array {
        return [
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
    }
}
