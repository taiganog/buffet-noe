<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Complemento extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $table = 'complemento_eventos';
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
        'entradas',
        'cardapio',

        // FK
        'evento_id',
    ];

    public function evento(): BelongsTo {
        return $this->belongsTo(Evento::class);
    }
}
