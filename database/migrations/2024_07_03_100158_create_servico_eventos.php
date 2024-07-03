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
        Schema::create('servico_eventos', function (Blueprint $table) {
            // FK
            $table->unsignedBigInteger('evento_id');
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->unsignedBigInteger('servico_id');
            $table->foreign('servico_id')->references('id')->on('servicos');

            $table->unsignedSmallInteger('quantidade');
            $table->unsignedSmallInteger('valor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servico_eventos', function(Blueprint $table) {
            $table->dropForeign('servico_eventos_evento_id_foreign');
            $table->dropColumn('evento_id');

            $table->dropForeign('servico_eventos_servico_id_foreign');
            $table->dropColumn('servico_id');
        });

        Schema::dropIfExists('servico_eventos');
    }
};
