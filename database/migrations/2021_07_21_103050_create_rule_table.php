<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gejala_id');
            $table->foreign('gejala_id')->references('id')->on('gejala')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('penyakit_id');
            $table->foreign('penyakit_id')->references('id')->on('penyakit')->onDelete('cascade')->onUpdate('cascade');
            $table->double('bobot',2,1);
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
        Schema::dropIfExists('rule');
    }
}
