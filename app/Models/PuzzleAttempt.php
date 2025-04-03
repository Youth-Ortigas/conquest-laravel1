<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuzzleAttempt extends Model
{
    use HasFactory;

    protected $table = 'puzzle_attempts';

    protected $fillable = ['user_id', 'puzzle_num', 'entered_key', 'is_correct'];
}
