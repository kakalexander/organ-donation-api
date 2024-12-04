<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacoesTable extends Migration
{
    public function up(): void
    {
        Schema::create('solicitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orgao_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nome');
            $table->string('prazo');
            $table->string('blood_type');
            $table->string('mensagem', 500)->nullable();
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('orgao_id')->references('id')->on('orgaos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitations');
    }
}
