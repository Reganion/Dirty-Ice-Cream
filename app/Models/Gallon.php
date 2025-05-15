<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallon extends Model
{
    use HasFactory;

    protected $table = 'gallons';

    protected $fillable = [
        'size',
        'stock',
        'addon_price',
    ];
}
