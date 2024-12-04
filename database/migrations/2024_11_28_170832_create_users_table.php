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
            $table->date('birth_date')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_endereco')->nullable();
            $table->unsignedBigInteger('id_perfil')->default(1);
            $table->enum('tipo_cadastro', ['doador', 'receptor', 'admin']);
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'NAO SEI'])->nullable();
            $table->timestamp('last_login')->nullable();
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
