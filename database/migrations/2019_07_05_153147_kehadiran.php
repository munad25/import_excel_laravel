<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kehadiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadiran', function(Blueprint $table){
            $table->increments('kehadiran_id');
            $table->integer('nim');
            $table->integer('ket_id');
            $table->integer('smt_id');
            $table->integer('kelas_id');
            $table->date('tanggal');
            $table->string('waktu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
