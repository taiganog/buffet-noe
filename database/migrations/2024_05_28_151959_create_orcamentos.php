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
        Schema::create('orcamentos', function(Blueprint $table) {
            $table->id();

            $table->string('nome', length: 100);
            $table->string('telefone', length: 15);
            $table->string('email', length: 100);
            $table->enum('tipo', [
                            'FESTA_INFANTIL',
                            '15_ANOS',
                            'FESTA_ADULTO',
                            'CASAMENTO',
                            'FORMATURA',
                            'CONFRATERNIZACAO',
            ]);
            $table->text('mensagem');

            $table->timestamp('created_at');
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};
