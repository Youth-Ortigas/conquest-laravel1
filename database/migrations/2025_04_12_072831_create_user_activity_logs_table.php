<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class DB Migration (User Activity Logs)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since Apr 12, 2025
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_activity_logs', function (Blueprint $table) {
            $table->increments('ual_id');
            $table->integer('ual_user_id')->nullable()->default(0);
            $table->string('ual_footprint',1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_activity_logs');
    }
};
