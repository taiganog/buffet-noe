<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Carbon\Carbon;

use App\Models\Equipe;
use App\Models\Cliente;
use App\Models\Valor;

class Evento extends Model {
    use HasFactory;

    protected $fillable = [
        'local',
        'data',
        'duracao',
        'tipo',
        'numero_convidados',
        'observacao',
        'cliente_id'
    ];

    public function formatarData($formato = 'd/m/Y'): void {
        $this->data = Carbon::parse($this->data)->format($formato);
    }

    public function equipes(): HasMany {
        return $this->hasMany(Equipe::class);
    }

    public function cliente(): BelongsTo {
        return $this->belongsTo(Cliente::class);
    }

    public function valor(): HasOne {
        return $this->hasOne(Valor::class);
    }

    public function servicos(): HasMany {
        return $this->hasMany(ServicoEvento::class);
    }
}
