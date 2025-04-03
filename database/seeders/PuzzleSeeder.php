<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Puzzle;

class PuzzleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Puzzle::create([
            'puzzle_key' => json_encode('cfzelejfqcuv'),
            'puzzle_num' => 1,
            'unlock_puzzle' => 2
        ]);

        Puzzle::create([
            'puzzle_key' => json_encode(['bible', 'shoes', 'prays', 'quiet']),
            'puzzle_num' => 2,
            'unlock_puzzle' => 3
        ]);
    }
}
