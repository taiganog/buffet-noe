<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'equipe_eventos';

    protected $fillable = [
        'evento_id',
        'funcionario_id',
        'funcao'
    ];
}
