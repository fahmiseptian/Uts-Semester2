<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Kolom id
            $table->string('username')->unique(); // Kolom username
            $table->string('email')->unique(); // Kolom email
            $table->string('password'); // Kolom password
            $table->string('name'); // Kolom name
            $table->enum('access', ['admin', 'user'])->default('user'); // Kolom access (admin/user)
            $table->boolean('status')->default(true); // Kolom status (aktif/tidak aktif)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
