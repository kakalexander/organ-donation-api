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
        Schema::create('orgaos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao');
            $table->enum('tipo', [ 'Vital', 'Não Vital'])->nullable();
            $table->string('tipo_sanguineo')->nullable(); 
            $table->enum('sexo', ['M', 'F', 'Outro'])->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgaos');
    }
};
