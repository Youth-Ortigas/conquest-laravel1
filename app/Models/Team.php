<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PuzzleAttempt;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'team_name',
        'team_banner_file_path',
        'team_description',
        'team_leader_user_id',
        'team_points',
    ];

    public function members() {
        return $this->hasMany(User::class, 'team_id', 'id');
    }

    public function puzzleAttempts() {
        return $this->hasMany(PuzzleAttempt::class, 'team_id', 'id');
    }
}
