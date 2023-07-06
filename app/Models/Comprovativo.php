<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprovativo extends Model
{
    use HasFactory;
    protected $table = "comprovativos";
    protected $fillable = [
        'id_pagamento',
        'link',
        'descricao',
    ];
}
