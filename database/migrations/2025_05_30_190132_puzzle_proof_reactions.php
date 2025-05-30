<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('puzzle_proof_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('puzzle_proof_id');
            $table->foreignId('user_id');
            $table->string('emoji'); // e.g., 'like', 'love', 'laugh', 'surprise' or the emoji itself
            $table->timestamps();

            $table->unique(['puzzle_proof_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('puzzle_proof_reactions');
    }
};

