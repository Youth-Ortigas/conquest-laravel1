<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'reg_code',
        'email',
        'first_name',
        'last_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];
}
