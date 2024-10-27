<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatusColumnInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Change the status column to ENUM
            $table->enum('status', ['active', 'inactive'])->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert back to original type (adjust if needed)
            // If the original type was an integer, use this
            $table->integer('status')->change();
            // Alternatively, if you are unsure, you might remove this line 
            // if it's not necessary to change back.
        });
    }
}
