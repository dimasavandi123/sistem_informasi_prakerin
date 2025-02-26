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
        Schema::create('prakerin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('gurumapel_id');
            $table->unsignedBigInteger('tempatPrakerin_id');
            $table->integer('nis_siswa');
            $table->string('nama_pimpinan');
            $table->string('alamat_dudi');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('gurumapel_id')->references('id')->on('gurumapel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tempatPrakerin_id')->references('id')->on('tempatPrakerin')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('prakerin');
    }
};
