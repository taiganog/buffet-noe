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
        Schema::create('complemento_eventos', function(Blueprint $table) {
            $table->id();

            $table->boolean('cascata');
            $table->boolean('salgado');
            $table->boolean('buffet');
            $table->boolean('maitre');
            $table->boolean('crepe');

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

            $table->text('entradas')->nullable();
            $table->text('cardapio')->nullable();

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
        Schema::table('complemento_eventos', function(Blueprint $table) {
            $table->dropForeign('complemento_eventos_evento_id_foreign');
            $table->dropColumn('evento_id');
        });

        Schema::dropIfExists('complemento_eventos');
    }
};
