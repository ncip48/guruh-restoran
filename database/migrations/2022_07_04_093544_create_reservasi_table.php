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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->integer('id_user')->nullable()->default(0);
            $table->integer('id_meja');
            $table->string('harga')->nullable()->default("50000");
            $table->date('tanggal');
            $table->integer('orang');
            $table->dateTime('waktu_awal');
            $table->dateTime('waktu_akhir');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('reservasi');
    }
};
