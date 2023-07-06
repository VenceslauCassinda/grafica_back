<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;
    protected $table = "pagamentos";
    protected $fillable = [
        'id_forma_pagamento',
        'id_pedido',
        'estado',
        'valor',
    ];
}
