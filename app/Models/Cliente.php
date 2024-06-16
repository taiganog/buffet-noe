<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model {
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'endereco',
        'telefone',
        'telefone_2',
        'email'
    ];

    public function evento(): HasMany {
        return $this->hasMany(Evento::class);
    }
}
