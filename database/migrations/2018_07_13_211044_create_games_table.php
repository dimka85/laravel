<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('game_name', 30);
            $table->unsignedInteger('game_type_id');
            $table->foreign('game_type_id')->references('id')->on('game_types');
            $table->tinyInteger('game_players');
            $table->tinyInteger('game_mafia');
            $table->boolean('with_don')->default(false);
            $table->boolean('with_sheriff')->default(false);
            $table->boolean('with_doctor')->default(false);
            $table->boolean('with_putana')->default(false);
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
        Schema::dropIfExists('games');
    }
}
