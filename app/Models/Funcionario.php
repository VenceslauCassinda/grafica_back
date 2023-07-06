<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionarios";
    use HasFactory;
    protected $fillable = [
        'id_usuario',
        'nome_completo',
        'estado',
    ];
}
