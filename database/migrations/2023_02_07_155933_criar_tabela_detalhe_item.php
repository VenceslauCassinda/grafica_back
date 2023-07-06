<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaDetalheItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalhes_item', function (Blueprint $table) {
            $table->id();
            $table->integer('id_item');
            $table->integer('id_tipo');
            $table->string('detalhe');
            $table->string('nome_cor');
            $table->string('dizeres');
            $table->string('link');
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
        Schema::dropIfExists('detalhes_item');
    }
}
