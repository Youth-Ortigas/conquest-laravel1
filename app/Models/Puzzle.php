<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    use HasFactory;

    protected $table = 'puzzles';

    protected $fillable = ['puzzle_key', 'puzzle_num', 'unlock_puzzle'];

    protected $casts = [
        'puzzle_key' => 'array',
    ];

    public const REQUIRED_WORDLE_WORD_COUNT = 3;

}
