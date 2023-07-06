<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalheItem extends Model{
    use HasFactory;
    protected $table = "detalhes_item";
    protected $fillable = [
        "id_item",
        "detalhe",
        "nome_cor",
        "id_tipo",
        "dizeres",
        "link",
    ];
}