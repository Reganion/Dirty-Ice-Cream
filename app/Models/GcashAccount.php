<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GcashAccount extends Model
{
    use HasFactory;

    protected $table = 'gcash_accounts';

    protected $fillable = [
        'gcash_number',
        'gcash_name',
    ];
    public $timestamps = false;
}
