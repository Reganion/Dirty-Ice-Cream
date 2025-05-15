<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminFeedbackController extends Controller
{
    // Display a listing of the feedback
    public function index()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }
        // Retrieve feedback with the related customer information
        $feedbacks = Feedback::with('customer')->get();  // Eager load the customer relationship
        
        return view('admin.feedback', compact('feedbacks'));  // Pass feedback to the view
    }
public function destroy($id)
{
    $feedback = Feedback::findOrFail($id);
    
    // Get paths relative to storage disk root
    $imagePath = str_replace('public/storage/', '', $feedback->image_path);
    $videoPath = str_replace('public/storage/', '', $feedback->video_path);
    
    // Delete files
    if ($feedback->image_path && Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
    }
    
    if ($feedback->video_path && Storage::disk('public')->exists($videoPath)) {
        Storage::disk('public')->delete($videoPath);
    }
    
    $feedback->delete();

    return redirect()->route('admin.feedback.index')->with('success', 'Feedback deleted successfully!');
}
}
