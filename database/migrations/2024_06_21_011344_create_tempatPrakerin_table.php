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
        Schema::create('tempatPrakerin', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dudi');
            $table->string('nama_pimpinan');
            $table->string('alamat_dudi');
            $table->integer('jmlh_kuota');
            $table->integer('kuota_terisi');
            $table->integer('sisa_kuota');
            $table->string('jurusan');
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
        Schema::dropIfExists('tempatPrakerin');
    }
};
