<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('title');
            $table->string('poster');
            $table->string('producer')->nullable();
            $table->string('director')->nullable();
            $table->text('overview');
            $table->integer('runtime')->unsigned()->nullable();
            $table->string('trailer')->nullable();
            $table->float('imdb_score')->nullable();
            $table->date('realease_date')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
