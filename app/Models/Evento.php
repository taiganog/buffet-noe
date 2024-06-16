<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Equipe;
use App\Models\Cliente;
use App\Models\Orcamento;

class Evento extends Model {
    use HasFactory;

    protected $fillable = [
        'nome',
        'local',
        'data',
        'duracao',
        'tipo',
        'numero_convidados',
        'valor',
        'observacao'
    ];

    public function equipe(): HasMany {
        return $this->hasMany(Equipe::class);
    }

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class);
    }

    public function valor(): HasOne {
        return $this->hasOne(Orcamento::class);
    }
}
