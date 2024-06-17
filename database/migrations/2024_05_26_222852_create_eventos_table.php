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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();

            $table->string('local', length: 150);
            $table->datetime('data');
            $table->unsignedSmallInteger('duracao');
            $table->enum('tipo', ['FESTA_INFANTIL',
                                '15_ANOS',
                                'FESTA_ADULTO',
                                'CASAMENTO',
                                'FORMATURA',
                                'CONFRATERNIZACAO',
                                'CHURRASCO']);
            $table->unsignedSmallInteger('numero_convidados');
            $table->text('observacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
