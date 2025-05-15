<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvancePayment;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class AdvancePaymentController extends Controller
{
    // Show all advance payments
    public function index()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }
        $advancePayments = AdvancePayment::with('customer')->orderBy('created_at', 'desc')->get();
        return view('Admin.advance', compact('advancePayments'));
    }

    public function updateStatus(Request $request, $id)
    {
        $payment = AdvancePayment::findOrFail($id);
        $payment->status = $request->status;
        $payment->save();
    
        return redirect()->route('advance-payments.index')->with('success', 'Payment status updated successfully.');
    }
    
    
}