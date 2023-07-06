<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model{
    use HasFactory;
    protected $table = "pedidos";
    protected $fillable = [
        "estado",
        "id_funcionario",
        "id_cliente",
        "total",
        "dias",
        "servico",
        "evento",
        "tema",
        "parcela",
        "data_levantamento",
    ];
}