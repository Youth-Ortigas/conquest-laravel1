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
            'unlock_puzzle' => '2nd',
            'date_unlocked' => '2025-05-15 06:00:00'
        ]);

        Puzzle::create([
            'puzzle_key' => json_encode(['shoes', 'sword', 'waist', 'truth', 'peace']),
            'puzzle_num' => 2,
            'unlock_puzzle' => '3rd',
            'date_unlocked' => '2025-05-15 07:00:00'
        ]);

        Puzzle::create([
            'puzzle_key' => json_encode(['strength', 'armor', 'authorities', 'powers', 'withstand', 'fastened', 'righteousness', 'readiness', 'extinguish', 'salvation', 'perseverance', 'mouth', 'ambassador']),
            'puzzle_num' => 3,
            'unlock_puzzle' => '4th',
            'date_unlocked' => '2025-05-15 08:00:00'
        ]);

        Puzzle::create([
            'puzzle_key' => json_encode([]),
            'puzzle_num' => 4,
            'unlock_puzzle' => '4th',
            'date_unlocked' => '2025-05-15 09:00:00'
        ]);
    }
}
