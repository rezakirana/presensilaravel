<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id');
            $table->foreign('dokter_id')->references('id')->on('dokter')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('hari',['senin','selasa','rabu','kamis','jumat','sabtu','minggu']);
            $table->string('jam_praktik');
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
        Schema::dropIfExists('jadwal');
    }
}
