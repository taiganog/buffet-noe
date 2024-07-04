<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoEvento extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'servico_id',
        'evento_id',
        'quantidade',
        'total',
    ];
}
