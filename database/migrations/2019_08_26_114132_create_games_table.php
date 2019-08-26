<?php

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
            $table->bigIncrements('id');

            $table->unsignedBigInteger('home_team_id')->nullable()->index();
            $table->unsignedBigInteger('away_team_id')->nullable()->index();
            $table->foreign('home_team_id')->references('id')->on('teams')->onDelete('set null');
            $table->foreign('away_team_id')->references('id')->on('teams')->onDelete('set null');

            $table->unsignedBigInteger('season_id')->nullable()->index();
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('set null');

            $table->unsignedBigInteger('competition_id')->nullable()->index();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('set null');

            $table->integer('round')->nullable();

            $table->dateTime('datetime')->nullable();

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
