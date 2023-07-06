<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "stocks";
    use HasFactory;

    protected $fillable = [
        'id_produto',
        'quantidade',
    ];
}
