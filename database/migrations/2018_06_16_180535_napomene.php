<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Napomene extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('napomene', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naslov');
            $table->string('sadrzaj');
            //$table->datetime('datum');
            //koji korisnik je stvorio napomenu
            $table->integer('id_korisnika')->unsigned()->index()->nullable();
            $table->foreign('id_korisnika')->references('id')->on('users');
            $table->boolean('procitana');
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
        //
    }
}
