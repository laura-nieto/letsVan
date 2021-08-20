<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorridasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corridas', function (Blueprint $table) {
            $table->id();

            $table->string('origen');
            $table->string('destino');
            $table->boolean('redondo')->default('0');
            
            $table->date('dia_salida');
            $table->time('hora_salida');
            $table->date('dia_llegada');
            $table->time('hora_llegada');


            $table->foreignId('unidad_id')->constrained('unidades')->onDelete('cascade');
            $table->foreignId('chofer_id')->constrained('choferes')->onDelete('cascade');
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
        Schema::dropIfExists('corridas');
    }
}
