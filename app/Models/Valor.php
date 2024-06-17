<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'valor_eventos';
    protected $fillable = [
        'cascata',
        'salgado',
        'buffet',
        'maitre',
        'porteiro',
        'montagem',
        'taca',
        'cumbuca',
        'prataria',
        'louca_sobremesa',
        'cestinha',
        'garcom',
        'cozinheiro',
        'bar',
        'ajudante_cozinha',

        'evento_id'
    ];
}
