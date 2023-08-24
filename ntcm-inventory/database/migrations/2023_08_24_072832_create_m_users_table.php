<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('m-users', function (Blueprint $table) {
            $table->id();
            $table->string('userID')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('user-created');
            $table->string('user-change');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m-users');
    }
};
