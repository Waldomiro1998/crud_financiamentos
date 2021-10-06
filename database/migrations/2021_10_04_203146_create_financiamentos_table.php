<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanciamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('financiamentos');
        Schema::create('financiamentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned()->index()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->decimal('valor_total', 65, 2);
            $table->integer('total_parcelas');
            $table->dateTime('data_financiamento');
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
        Schema::dropIfExists('financiamentos');
    }
}
