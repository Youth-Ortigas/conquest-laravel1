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
        Schema::table('puzzle_attempts', function (Blueprint $table) {
            DB::statement("ALTER TABLE puzzle_attempts ALTER COLUMN user_id DROP DEFAULT");
            $table->integer('puzzle_num')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('puzzle_attempts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->default(1);
            $table->float('puzzle_num')->change();
        });
    }
};
