<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'items';

    // The attributes that are mass assignable.
    protected $fillable = [
        'flavor_name', 
        'flavor_type', // Added flavor_type here
        'price', 
        'image_path', 
        'special',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Set the default value for the `special` attribute
    protected $attributes = [
        'special' => false, // default value for special
    ];

    // Automatically manage the created_at and updated_at columns
    public $timestamps = true;
}
