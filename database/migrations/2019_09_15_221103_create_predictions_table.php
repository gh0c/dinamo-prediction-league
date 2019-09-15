<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('game_id')->index();
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');

            $table->unsignedBigInteger('first_scorer_id')->index()->nullable();
            $table->foreign('first_scorer_id')->references('id')->on('players')->onDelete('set null');

            $table->boolean('joker_used');

            $table->integer('home_team_score')->nullable();
            $table->integer('away_team_score')->nullable();

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
        Schema::dropIfExists('predictions');
    }
}
