<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razao_social', 200);
            $table->string('nome_fantasia', 50);
            $table->string('cnpj', 20);
            $table->string('endereco', 200);
            $table->string('email', 200);
            $table->string('telefone', 20);
            $table->string('nome_responsavel', 100);
            $table->string('cpf', 12);
            $table->string('celular', 20);
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
        Schema::dropIfExists('clientes');
    }
}
