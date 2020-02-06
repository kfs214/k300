<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aname');  //animal_name
            $table->string('t12aname');  //animal_name(12types)
            $table->string('t3aname');   //animal_name(3types)
            $table->integer('t4code');  //animal_code(4types)
            $table->string('rhythm');   //rhythm
            $table->integer('wangel');  //white_angel
            $table->integer('bdebil');  //black_debil
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
