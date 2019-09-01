<?php

use App\Helpers\DB\ExtendedSchema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsModApprovedToPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->boolean('is_mod_approved')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ExtendedSchema::dropDefaultMsSqlConstraint('players', 'is_mod_approved');
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('is_mod_approved');
        });
    }
}
