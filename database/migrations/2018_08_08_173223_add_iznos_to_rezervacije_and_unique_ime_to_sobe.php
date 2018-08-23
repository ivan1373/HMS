<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIznosToRezervacijeAndUniqueImeToSobe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('sobe', function (Blueprint $table) {
            $table->string('naziv')->unique();
        });
        Schema::table('rezervacija', function (Blueprint $table) {
            $table->double('iznos', 6, 2);
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
