<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('contato');
            $table->string('endereco');
            $table->double('latitude');
            $table->double('longitude');
            $table->foreignId('prefeitura_id')->constrained('prefeituras');
            $table->foreignId('subcategoria_id')->constrained('subcategorias');
            $table->foreignId('user_id')->constrained('users');
            $table->uuid('uuid')->unique();
            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });

        Schema::create('servico_tag', function (Blueprint $table) {

            $table->foreignId('servico_id')->constrained('servicos');
            $table->foreignId('tag_id')->constrained('tags');

            $table->timestamps();
        });

        Schema::create('servico_rede', function (Blueprint $table) {

            $table->foreignId('servico_id')->constrained('servicos');
            $table->foreignId('rede_id')->constrained('redes');
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
        Schema::dropIfExists('servicos');
        Schema::dropIfExists('servico_tag');
        Schema::dropIfExists('servico_rede');
    }
}
