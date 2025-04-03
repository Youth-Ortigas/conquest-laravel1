<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('puzzle_attempts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1); // Testing, later replace with auth user
            $table->unsignedInteger('puzzle_num');
            $table->string('entered_key');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puzzle_attempts');
    }
};

