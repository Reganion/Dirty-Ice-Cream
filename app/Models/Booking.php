<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'bookings';

    // The primary key for the model.
    protected $primaryKey = 'id';

    // The attributes that are mass assignable.
    protected $fillable = [
        'customer_id',
        'firstname',
        'lastname',
        'contact_no',
        'location',
        'booking_date',
        'delivery_time',
        'flavor',
        'size_of_gallon',
        'price_total',
        'payment_method',
        'status',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [];

    // The attributes that should be cast to native types.
    protected $casts = [
        'booking_date' => 'date',
        'price_total' => 'decimal:2',
    ];

    /**
     * Get the customer associated with the booking.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Accessor to get delivery_time as Carbon instance.
     */
    public function getDeliveryTimeAttribute($value)
    {
        return Carbon::createFromFormat('H:i:s', $value);
    }
}
