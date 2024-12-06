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
            $table->unsignedBigInteger('user_id');
            $table->string('nome_doador')->nullable(); 
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->enum('tipo', ['Vital', 'Não Vital']);
            $table->string('blood_type');
            $table->enum('sexo', ['M', 'F', 'Outro']);
            $table->timestamps();

            // Configurar a chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
