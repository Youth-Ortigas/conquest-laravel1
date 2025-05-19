<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Team;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'reg_code',
        'first_name',
        'last_name',
        'type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    public function puzzleAttempts()
    {
        return $this->hasMany(PuzzleAttempt::class);
    }

    public function teamMember()
    {
        return $this->hasOne(TeamsMembers::class, 'teams_user_id');
    }

    public function team()
    {
        return $this->hasOneThrough(
            Teams::class,
            TeamsMembers::class,
            'teams_user_id',
            'id',
            'id',
            'teams_id'
        );
    }

}
