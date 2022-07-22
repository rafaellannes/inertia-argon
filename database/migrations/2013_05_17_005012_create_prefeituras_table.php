<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefeiturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefeituras', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->unique();
            $table->string('dominio')->unique();
            $table->uuid('uuid')->unique();
            $table->string('logo')->nullable();
            $table->enum('ativo', ['Y', 'N'])->default('Y');
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
        Schema::dropIfExists('prefeituras');
    }
}
