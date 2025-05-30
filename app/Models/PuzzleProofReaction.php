<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuzzleProofReaction extends Model
{
    protected $fillable = ['puzzle_proof_id', 'user_id', 'emoji'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proof()
    {
        return $this->belongsTo(PuzzleProof::class, 'puzzle_proof_id');
    }
}

