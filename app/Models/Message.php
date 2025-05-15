<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'sender_id',
        'sender_type',
        'sender_name',   // Added the sender_name column to the fillable array
        'receiver_id',
        'receiver_type',
        'message',
        'sent_at',
    ];

    public $timestamps = false;

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    // Optional: Polymorphic sender relationship
    public function sender()
    {
        return $this->morphTo(null, 'sender_type', 'sender_id');
    }

    // Optional: Polymorphic receiver relationship
    public function receiver()
    {
        return $this->morphTo(null, 'receiver_type', 'receiver_id');
    }
}
