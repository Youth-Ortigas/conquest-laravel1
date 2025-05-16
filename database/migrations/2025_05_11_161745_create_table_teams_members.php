<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class DB Migration (Teams Members)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 11, 2025
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('teams_members')) {
            Schema::create('teams_members', function (Blueprint $table) {
                $table->id();
                $table->integer('teams_id');
                $table->integer('teams_user_id');
                $table->integer('cabin_name');
                $table->timestamps();
                $table->dateTime('deleted_at')->nullable();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams_members');
    }
};
