<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('valor_eventos', function (Blueprint $table) {
            $table->id();

            $table->unsignedSmallInteger('cascata');
            $table->unsignedSmallInteger('salgado');
            $table->unsignedSmallInteger('buffet');
            $table->unsignedSmallInteger('maitre');
            $table->unsignedSmallInteger('porteiro');
            $table->unsignedSmallInteger('montagem');
            $table->unsignedSmallInteger('taca');
            $table->unsignedSmallInteger('cumbuca');
            $table->unsignedSmallInteger('prataria');
            $table->unsignedSmallInteger('louca_sobremesa');
            $table->unsignedSmallInteger('cestinha');
            $table->unsignedSmallInteger('garcom');
            $table->unsignedSmallInteger('cozinheiro');
            $table->unsignedSmallInteger('bar');
            $table->unsignedSmallInteger('ajudante_cozinha');

            // FK
            $table->unsignedBigInteger('evento_id');
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->unique('evento_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valor_eventos', function(Blueprint $table) {
            $table->dropForeign('valor_eventos_evento_id_foreign');
            $table->dropColumn('evento_id');
        });

        Schema::dropIfExists('valor_eventos');
    }
};
