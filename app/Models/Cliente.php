<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    use HasFactory;
    protected $fillable = [
        'id_usuario',
        'nome_completo',
        'numero',
        'estado',
    ];
    
}
