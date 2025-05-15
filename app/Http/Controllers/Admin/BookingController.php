<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function index()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }

        $bookings = Booking::orderBy('id', 'desc')->get();

        return view('Admin.booking', compact('bookings'));
    }

    // Method to update booking status
    public function updateStatus(Request $request, $id)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:scheduled,on the way,completed,cancelled', // Ensure valid status
        ]);

        // Find the booking by ID
        $booking = Booking::find($id);

        // Check if the booking exists
        if (!$booking) {
            return redirect()->route('admin.booking.index')->with('error', 'Booking not found.');
        }

        // Update the booking status
        $booking->status = $request->status;
        $booking->save();

        // Redirect back to the bookings page with success message
        return redirect()->route('admin.booking')->with('success', 'Booking status updated successfully.');
    }
}
