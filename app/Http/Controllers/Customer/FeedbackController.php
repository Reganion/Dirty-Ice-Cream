<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function showFeedbackForm()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('customer.login')->withErrors(['error' => 'Please login first.']);
        }

        $flavors = DB::table('items')->pluck('flavor_name');
    
        return view('Customer.feedback', compact('flavors'));
    }
    
   public function store(Request $request)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comments' => 'nullable|string|max:500',
        'flavor_name' => 'required|string|max:255',
        'media' => 'nullable|array|max:1', // Only allow 1 file
        'media.*' => 'file|mimetypes:image/jpeg,image/png,image/gif,video/mp4,video/quicktime|max:20480',
    ]);

    $imagePath = null;
    $videoPath = null;
    $mediaType = 'none';

    // Handle media upload
    if ($request->hasFile('media')) {
        $file = $request->file('media')[0];
        $path = $file->store('feedback', 'public'); // Changed to 'feedback' directory
        
        if (str_starts_with($file->getMimeType(), 'image/')) {
            $imagePath = 'storage/feedback/' . basename($path); // Updated path format
            $mediaType = 'image';
        } else {
            $videoPath = 'storage/feedback/' . basename($path); // Updated path format
            $mediaType = 'video';
        }
    }

    // Store the feedback
    Feedback::create([
        'customer_id' => auth()->id(),
        'rating' => $request->rating,
        'comments' => $request->comments,
        'flavor_name' => $request->flavor_name,
        'image_path' => $imagePath,
        'video_path' => $videoPath,
        'media_type' => $mediaType
    ]);

    return redirect()->route('feedback.show')->with('success', 'Your feedback has been submitted successfully!');
}
}