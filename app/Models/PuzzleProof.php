<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PuzzleProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'puzzle_id',
        'user_id',
        'team_id',
        'photo_path',
        'description',
    ];

    public function reactions()
    {
        return $this->hasMany(PuzzleProofReaction::class);
    }

}

