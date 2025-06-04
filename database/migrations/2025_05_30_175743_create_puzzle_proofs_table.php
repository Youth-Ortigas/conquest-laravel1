<?php
// database/migrations/xxxx_xx_xx_create_puzzle_proofs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puzzle_proofs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('puzzle_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('team_id');
            $table->string('photo_path');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puzzle_proofs');
    }
};
