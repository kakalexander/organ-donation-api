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
        Schema::create('hospitais_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hospital');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
        
            $table->foreign('id_hospital')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitais_usuarios');
    }
};
