<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('obra_endereco', 200);
            $table->double('valor_total');
            $table->double('sinal');
            $table->integer('parcela_qtd');
            $table->double('parcela_valor')->nullable();
            $table->string('parcela_data')->nullable();
            $table->date('pagamento_data_inicio');
            $table->string('arquivo')->nullable();
            $table->enum('status',['Aberto','Fechado'])->default('Aberto');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');;
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
        Schema::dropIfExists('propostas');
    }
}
