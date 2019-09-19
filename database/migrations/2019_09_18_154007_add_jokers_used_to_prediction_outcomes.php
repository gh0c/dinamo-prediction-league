<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJokersUsedToPredictionOutcomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prediction_outcomes', function (Blueprint $table) {
            $table->integer('jokers_used')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prediction_outcomes', function (Blueprint $table) {
            $table->dropColumn('jokers_used');
        });
    }
}
