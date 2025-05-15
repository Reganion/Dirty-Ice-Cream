<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Table name (optional if it matches convention)
    protected $table = 'inventory';

    // Primary key (optional if it matches convention)
    protected $primaryKey = 'id';

    // Specify which fields are mass assignable
    protected $fillable = [
        'item_name',
        'item_type',
        'quantity',
        'unit',
        'image_url',  // Add image_url to the mass-assignable fields
        'last_updated'
    ];

    // If you're not using timestamps, you can disable it like this:
    public $timestamps = false;
}
