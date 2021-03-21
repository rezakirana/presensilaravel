<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBobotKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bobot_kriteria', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kriteria')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->integer('bobot');

            $table->foreign('id_kriteria')->references('id')->on('kriteria')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')
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
        Schema::dropIfExists('bobot_kriteria');
    }
}
