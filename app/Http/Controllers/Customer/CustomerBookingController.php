<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Gallon;
use App\Models\Inventory;
use App\Models\Item; // Make sure to include this at the top


class CustomerBookingController extends Controller
{
    public function updateStatus($id, Request $request)
    {
        $booking = Booking::findOrFail($id);
    
        // Update the status
        $booking->status = $request->status;
        $booking->save();
    
        return redirect()->route('customer.trackorder')->with('success', 'Booking status updated successfully!');
    }
    public function update(Request $request, Booking $booking)
{
    // Validate and update the booking
    $validated = $request->validate([
        'flavor' => 'required',
        'size_of_gallon' => 'required',
        'payment_method' => 'required',
        'booking_date' => 'required|date',
        'delivery_time' => 'required',
        'price_total' => 'required|numeric'
    ]);
    
    $booking->update($validated);
    
    return redirect()->route('customer.trackorder')->with('success', 'Booking updated successfully');
}


    public function trackOrder()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('customer.login')->withErrors(['error' => 'Please login first.']);
        }
        
        $customer_id = Auth::id(); // Get the logged-in customer's ID
        $bookings = Booking::where('customer_id', $customer_id)->orderBy('booking_date', 'desc')->get(); // Fetch bookings for the logged-in user
        $items = Item::all(); // Fetch all items (flavors)
        $gallons = Gallon::all(); // Fetch all gallon sizes
    
        return view('customer.trackorder', compact('bookings', 'items', 'gallons'));
    }
    

    public function create()
    {
                $gallons = Gallon::all(); // fetch all sizes
                $items = Item::all(); // Fetch all items (flavors)
                return view('customer.booknow', compact('gallons', 'items'));
    }

    /**
     * Store new booking.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'contact_no' => 'required|string|max:15',
            'location' => 'required|string|max:255',
            'booking_date' => 'required|date|after_or_equal:today',
            'delivery_time' => 'required',
            'flavor' => 'required|string|max:100',
            'size_of_gallon' => 'required|string|max:50',
            'price_total' => 'required|numeric',
            'payment_method' => 'required|string|max:50',
        ]);
        
        // Check inventory for the selected flavor
        $inventory = Inventory::where('item_name', $validated['flavor'])->where('item_type', 'flavor')->first();
    
        // If the inventory quantity is 0, return an error message
        if ($inventory && $inventory->quantity <= 0) {
            // Use 'withErrors' to send custom error
            return redirect()->back()->withErrors(['flavor' => 'Sorry, the selected flavor is out of stock.']);
        }
    
        // Create the booking record
        $booking = Booking::create([
            'customer_id' => Auth::id(),
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'contact_no' => $validated['contact_no'],
            'location' => $validated['location'],
            'booking_date' => $validated['booking_date'],
            'delivery_time' => $validated['delivery_time'],
            'flavor' => $validated['flavor'],
            'size_of_gallon' => $validated['size_of_gallon'],
            'price_total' => $validated['price_total'],
            'payment_method' => $validated['payment_method'],
            'status' => 'scheduled',
        ]);
    
        // Check the payment method and redirect accordingly
        if ($validated['payment_method'] == 'Gcash') {
            return redirect()->route('customer.advance', ['booking_id' => $booking->id]);
        }
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Booking created successfully!');
    }
    
    
}
