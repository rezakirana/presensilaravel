<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSubKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kriteria', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kriteria')->unsigned();
            $table->string('nama', 50);
            $table->string('keterangan', 100);
            $table->integer('bobot');
            $table->timestamps();

            $table->foreign('id_kriteria')->references('id')->on('kriteria')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_kriteria');
    }
}
