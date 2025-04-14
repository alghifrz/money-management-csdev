<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'first_time_login',
        'avatar',
    ];

    protected $casts = [
        'first_time_login' => 'boolean',
    ];

    /**
     * Get the active user profile.
     */
    public static function getActive()
    {
        return static::first();
    }
}
