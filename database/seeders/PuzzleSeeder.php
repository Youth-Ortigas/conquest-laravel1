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
            'unlock_puzzle' => '2nd-stage-1'
        ]);

        Puzzle::create([
            'puzzle_key' => json_encode(['shoes', 'sword', 'waist', 'truth', 'peace']),
            'puzzle_num' => 2.1,
            'unlock_puzzle' => '2nd-stage-2'
        ]);

        Puzzle::create([
            'puzzle_key' => json_encode(['shoes', 'sword', 'waist', 'truth', 'peace']),
            'puzzle_num' => 2.2,
            'unlock_puzzle' => '2nd-stage-3'
        ]);

        Puzzle::create([
            'puzzle_key' => json_encode(['shoes', 'sword', 'waist', 'truth', 'peace']),
            'puzzle_num' => 2.3,
            'unlock_puzzle' => '2nd-stage-3'
        ]);

        Puzzle::create([
            'puzzle_key' => 'puzzle-3',
            'puzzle_num' => 3,
            'unlock_puzzle' => '3rd'
        ]);
    }
}
