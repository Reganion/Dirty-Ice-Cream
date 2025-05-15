<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvancePayment;  // Import the AdvancePayment model
use Illuminate\Support\Facades\Storage;
use App\Models\GcashAccount;
use App\Models\Customer;  // Assuming you have a Customer model
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function welcomePage()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('customer.login')->withErrors(['error' => 'Please login first.']);
        }
        // Fetch all GCash accounts
        $gcashAccounts = GcashAccount::all();  
        return view('customer.advancepayment', compact('gcashAccounts'));
    }
    public function storeAdvancePayment(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'amount' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation with mime type and size
        ]);
    
        // Store the image in the appropriate directory
        $imagePath = $request->file('image')->store('advanceproof', 'public');
    
        try {
            // Get the logged-in user's customer_id
            $customerId = auth()->user()->id; // Assumes the authenticated user is the customer
    
            // Create a new advance payment record
            $advancePayment = AdvancePayment::create([
                'customer_id' => $customerId,
                'amount' => $request->amount,
                'image_path' => $imagePath,
                'status' => 'Pending', // Default status can be Pending
            ]);
    
            // Redirect to the customer dashboard with a success message
            return redirect()->route('customer.advance')->with('success', 'Payment submitted successfully!');
        } catch (\Exception $e) {
            // Handle exception and show error message if the insert fails
            return back()->with('error', 'An error occurred while processing your payment. Please try again.');
        }
    }
    
}
