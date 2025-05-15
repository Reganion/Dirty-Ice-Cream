<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;
use App\Models\AdvancePayment;
use App\Mail\CustomerOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;


class CustomerLoginController extends Controller
{
    public function showLoginForm()
    {
        if (!request()->expectsJson()) {
            return view('Customer.login'); // Or your appropriate login view
        }
    }
    

    public function showDashboard()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('customer.login')->withErrors(['error' => 'Please login first.']);
        }
    
        $customer = Auth::guard('web')->user();
    
        $messages = Message::where(function ($query) use ($customer) {
            $query->where('sender_id', $customer->id)
                  ->where('sender_type', 'customer');
        })->orWhere(function ($query) use ($customer) {
            $query->where('receiver_id', $customer->id)
                  ->where('receiver_type', 'customer');
        })
        ->orderBy('sent_at', 'asc')
        ->get();
    
        return view('Customer.dashboard', compact('messages', 'customer'));
    }
    

public function sendMessage(Request $request)
{
    // Validate the message input
    $request->validate([
        'message' => 'required|string|max:1000',
    ]);

    // Get the currently authenticated customer
    $customer = Auth::guard('web')->user();

    // Get the customer's full name using the accessor
    $senderName = $customer->full_name;

    // Assume admin ID is 1; adjust if you need a dynamic way to fetch the admin's ID
    $receiverId = 1;

    // Save the message to the database
    try {
        Message::create([
            'sender_id' => $customer->id,
            'sender_type' => 'customer',  // Use 'customer' to indicate the sender's role
            'sender_name' => $senderName,  // Store the full name in a separate field
            'receiver_id' => $receiverId,
            'receiver_type' => 'admin',  // Receiver is admin
            'message' => $request->message,
        ]);

        // Return a simple response (e.g., bot reply)
        return response()->json([
            'reply' => 'Thanks for your message! Our admin will reply soon.'
        ]);
    } catch (\Exception $e) {
        // Handle the error and return a response if saving the message fails
        return response()->json([
            'error' => 'Failed to send message. Please try again later.'
        ], 500);
    }
}



    public function login(Request $request)
    {
        // Validate input manually
        if (!$request->has('email') || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->withErrors(['error' => 'Please enter a valid email address.'])->withInput();
        }

        if (!$request->has('password') || strlen($request->password) < 6) {
            return back()->withErrors(['error' => 'Password must be at least 6 characters.'])->withInput();
        }

        // Find customer by email
        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            if (!$customer->otp_code && !$customer->otp_expires_at) {
                // OTP already verified
                if (Hash::check($request->password, $customer->password)) {
                    Auth::guard('web')->login($customer);
                    return redirect()->route('customer.dashboard');
                }
            } else {
                // OTP not verified
                Auth::guard('web')->login($customer); // Temporarily login to show OTP form
                return redirect()->route('customer.otp.verify.form')
                    ->with('success', 'Please verify your email. An OTP has been sent.');
            }
        }
        

        // Invalid credentials
        return back()->withErrors(['error' => 'Invalid email or password'])->withInput();
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('customer.login');
    }

    public function showRegisterForm()
    {
        return view('Customer.register');
    }

public function register(Request $request)
{
    // Validate email
    if (!$request->has('email') || !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
        return back()->withErrors(['error' => 'Please enter a valid email address.'])->withInput();
    }

    // Check if the email already exists
    $existingCustomer = Customer::where('email', $request->email)->first();

    if ($existingCustomer) {
        // If already verified, block registration
        if (is_null($existingCustomer->otp_code)) {
            return back()->withErrors(['error' => 'The email address is already taken.'])->withInput();
        }

        // If not verified, resend OTP and redirect to OTP verification
        Auth::guard('web')->login($existingCustomer);

        $otp = rand(100000, 999999);
        $existingCustomer->otp_code = $otp;
        $existingCustomer->otp_expires_at = Carbon::now()->addMinutes(5);
        $existingCustomer->save();

        Mail::to($existingCustomer->email)->send(new CustomerOtpMail($otp));

        return redirect()->route('customer.otp.verify.form')->with('success', 'An OTP has been sent to your email. Please verify.');
    }

    // Check if the username is already taken
    if (Customer::where('username', $request->username)->exists()) {
        return back()->withErrors(['error' => 'The username is already taken.'])->withInput();
    }

    // Create customer
    $customer = Customer::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'gender' => $request->gender,
        'username' => $request->username,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'otp_code' => null,
        'otp_expires_at' => null,
    ]);

    Auth::guard('web')->login($customer);

    // Generate and send OTP
    $otp = rand(100000, 999999);
    $customer->otp_code = $otp;
    $customer->otp_expires_at = Carbon::now()->addMinutes(5);
    $customer->save();

    Mail::to($customer->email)->send(new CustomerOtpMail($otp));

    return redirect()->route('customer.otp.verify.form')->with('success', 'An OTP has been sent to your email. Please verify.');
}

    
    public function showOtpForm()
{
    return view('Customer.verify_otp');
}



public function verifyOtp(Request $request)
{
    $request->validate([
        'otp_code' => 'required|digits:6',
    ]);

    $customer = Auth::guard('web')->user();

    if (!$customer) {
        return redirect()->route('customer.login')->withErrors(['error' => 'Please log in first.']);
    }

    // Ensure otp_expires_at is a Carbon instance
    $otpExpiresAt = Carbon::parse($customer->otp_expires_at);

    if (
        $customer->otp_code === $request->otp_code &&
        $otpExpiresAt->isFuture()
    ) {
        // Valid OTP
        $customer->otp_code = null;
        $customer->otp_expires_at = null;
        $customer->save();

        return redirect()->route('customer.dashboard')->with('success', 'OTP verified successfully!');
    }

    return back()->withErrors(['error' => 'Invalid or expired OTP.']);
}
public function resendOtp(Request $request)
{
    $customer = Auth::guard('web')->user();

    if (!$customer) {
        return redirect()->route('customer.login')->withErrors(['error' => 'Please log in first.']);
    }

    // Generate new OTP
    $otp = rand(100000, 999999);
    $customer->otp_code = $otp;
    $customer->otp_expires_at = Carbon::now()->addMinutes(5);
    $customer->save();

    // Send OTP to email
    Mail::to($customer->email)->send(new CustomerOtpMail($otp));

    return back()->with('success', 'A new OTP has been sent to your email.');
}

}
