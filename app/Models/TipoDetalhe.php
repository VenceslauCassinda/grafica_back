<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDetalhe extends Model
{
    use HasFactory;
    protected $table = "tipos_detalhe";
    protected $fillable = [
        'tipo',
        'tipo_produto',
        'detalhe',
    ];
}
