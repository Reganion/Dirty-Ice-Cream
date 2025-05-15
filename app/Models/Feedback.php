<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

protected $fillable = [
    'customer_id',
    'rating',
    'comments',
    'flavor_name',
    'image_path',
    'video_path',
    'media_type'
];

    // Disable timestamps if you're not using them
    public $timestamps = false;

    // Relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relationship with FeedbackMedia (if using separate table)
    public function media()
    {
        return $this->hasMany(FeedbackMedia::class);
    }

    // Accessor for easy retrieval of first media item
    public function getFirstMediaAttribute()
    {
        return $this->media->first();
    }

    // Helper method to attach media
    public function attachMedia($file, $type)
    {
        $uploadPath = 'feedback/' . date('Y/m');
        $path = $file->store($uploadPath, 'public');
        
        return $this->media()->create([
            'file_path' => $path,
            'media_type' => $type
        ]);
    }
}