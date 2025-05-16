<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TeamsMembers
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 11, 2025
 */
class TeamsMembers extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'team_id',
        'teams_user_id',
        'cabin_name'
    ];
}
