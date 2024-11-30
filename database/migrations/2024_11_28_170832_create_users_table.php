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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_endereco')->nullable();
            $table->unsignedBigInteger('id_perfil')->default(1);
            $table->timestamps();
        
            $table->foreign('id_endereco')->references('id')->on('enderecos')->onDelete('set null');
            $table->foreign('id_perfil')->references('id')->on('perfis');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
