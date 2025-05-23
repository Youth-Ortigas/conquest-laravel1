<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('puzzle_game_state', function (Blueprint $table) {
            $table->renameColumn('user_id', 'team_id');
            $table->integer('puzzle_num')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('puzzle_game_state', function (Blueprint $table) {
            $table->renameColumn('team_id', 'user_id');
            $table->float('puzzle_num')->change();
        });
    }
};
