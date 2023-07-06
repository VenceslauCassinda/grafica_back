<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model{
    use HasFactory;
    protected $table = "items_pedido";
    protected $fillable = [
        "estado",
        "id_produto",
        "id_pedido",
        "total",
        "desconto",
        "quantidade",
    ];
}