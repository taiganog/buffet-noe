<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'promocoes';
    protected $fillable = ['data_inicial', 'data_final', 'mensagem'];
}
