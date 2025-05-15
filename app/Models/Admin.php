<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Specify the table if it's not the plural of the model name
    protected $table = 'admin';

    // Mass assignable fields
    protected $fillable = [
        'username',
        'email',
        'password',
        'profile_pic',
    ];

    // Hidden fields for arrays
    protected $hidden = [
        'password',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Disable Laravel's timestamps if your table doesn't have them
    public $timestamps = false;
}
