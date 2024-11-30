<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBloodTypeToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'NAO SEI'])->nullable()->after('id_perfil');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('blood_type');
        });
    }
}
