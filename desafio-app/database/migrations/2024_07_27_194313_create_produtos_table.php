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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50)->nullable();
            $table->string('unidadeMedida')->nullable();
            $table->integer('quantidade')->nullable();
            $table->float('preco')->nullable();
            $table->boolean('perecivel')->nullable();
            $table->date('validade')->nullable();
            $table->date('fabricacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listagem');
    }
};
