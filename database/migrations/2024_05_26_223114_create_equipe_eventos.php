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
        Schema::create('equipe_eventos', function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('evento_id');
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->unsignedBigInteger('funcionario_id');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');

            $table->enum('funcao', ['GARCOM',
                                    'COZINHEIRO',
                                    'AJUDANTE_COZINHA',
                                    'PORTEIRO',
                                    'MAITRE',
                                    'MONTAGEM',
                                    'FRITADOR',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipe_eventos', function(Blueprint $table){
            $table->dropForeign('equipe_eventos_evento_id_foreign');
            $table->dropForeign('equipe_eventos_funcionario_id_foreign');

            $table->dropColumn('evento_id');
            $table->dropColumn('funcionario_id');
        });

        Schema::dropIfExists('equipe_eventos');
    }
};
