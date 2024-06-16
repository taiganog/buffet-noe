<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    use HasFactory;
    const UPDATED_AT = null;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'tipo',
        'mensagem'
    ];
}
