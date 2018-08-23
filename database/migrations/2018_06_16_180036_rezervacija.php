<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rezervacija extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rezervacija', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ime');
            $table->string('prezime');
            //soba
            $table->integer('id_sobe')->unsigned()->index()->nullable();
            $table->foreign('id_sobe')->references('id')->on('sobe');
            //koji je korisnik stvorio rezervaciju
            $table->integer('id_korisnika')->unsigned()->index()->nullable();
            $table->foreign('id_korisnika')->references('id')->on('users');
            $table->boolean('dorucak');
            $table->datetime('datum_od');
            $table->datetime('datum_do');
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
