<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancePayment extends Model
{
    use HasFactory;

    // Disable timestamps if you're not using created_at and updated_at
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'amount',
        'image_path',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
