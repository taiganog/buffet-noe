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

            $table->unsignedSmallInteger('cascata')->nullable();
            $table->unsignedSmallInteger('crepe')->nullable();
            $table->unsignedSmallInteger('salgado')->nullable();
            $table->unsignedSmallInteger('buffet')->nullable();
            $table->unsignedSmallInteger('maitre')->nullable();
            $table->unsignedSmallInteger('porteiro')->nullable();
            $table->unsignedSmallInteger('montagem')->nullable();
            $table->unsignedSmallInteger('taca')->nullable();
            $table->unsignedSmallInteger('cumbuca')->nullable();
            $table->unsignedSmallInteger('prataria')->nullable();
            $table->unsignedSmallInteger('louca_sobremesa')->nullable();
            $table->unsignedSmallInteger('cestinha')->nullable();
            $table->unsignedSmallInteger('garcom')->nullable();
            $table->unsignedSmallInteger('cozinheiro')->nullable();
            $table->unsignedSmallInteger('bar')->nullable();
            $table->unsignedSmallInteger('ajudante_cozinha')->nullable();

            $table->unsignedSmallInteger('total');

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
