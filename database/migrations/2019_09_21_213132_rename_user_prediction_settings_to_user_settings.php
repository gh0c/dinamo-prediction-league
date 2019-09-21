<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameUserPredictionSettingsToUserSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_prediction_settings', function (Blueprint $table) {
            $table->renameColumn('is_prediction_league_super_admin', 'is_super_admin');
            $table->renameColumn('is_prediction_league_admin', 'is_admin');
            $table->renameColumn('is_prediction_league_moderator', 'is_moderator');

        });
        Schema::rename('user_prediction_settings', 'user_settings');

    }

    /**
     * Reverse the migrations.php artisan ide-helper:models- -write
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('user_settings', 'user_prediction_settings');

        Schema::table('user_prediction_settings', function (Blueprint $table) {
            $table->renameColumn('is_super_admin', 'is_prediction_league_super_admin');
            $table->renameColumn('is_admin', 'is_prediction_league_admin');
            $table->renameColumn('is_moderator', 'is_prediction_league_moderator');
        });
    }
}
