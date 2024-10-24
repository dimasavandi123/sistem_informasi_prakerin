<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswaUser', function (Blueprint $table) {
            $table->id();
            $table->string('name_siswa');
            $table->string('username_siswa')->unique();
            $table->string('email_siswa')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password_siswa');
            $table->enum('role',['0','1','2'])->default(2);
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswaUser');
    }
};
