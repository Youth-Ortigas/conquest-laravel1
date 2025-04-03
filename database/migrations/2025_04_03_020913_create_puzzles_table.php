<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('puzzles', function (Blueprint $table) {
            $table->id();
            $table->json('puzzle_key'); // This will store an array of keys for each puzzle
            $table->integer('puzzle_num');
            $table->integer('unlock_puzzle');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('puzzles');
    }
};

