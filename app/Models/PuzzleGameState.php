<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PuzzleGameState extends Model
{
    use HasFactory;

    protected $table = 'puzzle_game_state';

    protected $fillable = [
        'team_id',
        'puzzle_num',
        'game_state'
    ];
}
