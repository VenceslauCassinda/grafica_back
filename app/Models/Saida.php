<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $table = "saidas";
    use HasFactory;

    protected $fillable = [
        'id_produto',
        'id_funcionario',
        'motivo',
        'quantidade',
    ];
}
