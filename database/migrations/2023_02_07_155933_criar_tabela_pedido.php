<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('estado');
            $table->integer('dias');
            $table->integer('id_cliente');
            $table->integer('id_funcionario');
            $table->double('dias');
            $table->string('servico');
            $table->string('evento');
            $table->string('tema');
            $table->double('parcela');
            $table->datetime('data_levantamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
