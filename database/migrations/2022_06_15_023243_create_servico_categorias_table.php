<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicoCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servico_categorias', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->foreignId('icone_id')->constrained('icones');
            $table->foreignId('prefeitura_id')->constrained('prefeituras');
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
        Schema::dropIfExists('servico_categorias');
    }
}
