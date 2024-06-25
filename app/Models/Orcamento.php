<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
    ];

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'tipo',
        'mensagem'
    ];
}
