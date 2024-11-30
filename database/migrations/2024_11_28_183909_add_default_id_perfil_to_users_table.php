<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultIdPerfilToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_perfil')->default(2)->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_perfil')->default(null)->change();
        });
    }
}
