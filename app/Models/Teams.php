<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Teams
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 11, 2025
 */
class Teams extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'team_name',
        'team_code',
        'team_leader_user_id_primary',
        'team_leader_user_id_secondary'
    ];

    public function teamsMembers()
    {
        return $this->hasOne(TeamsMembers::class, 'teams_id', 'id');
    }
}
