<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }

        // Fetch all customer data
        $customers = Customer::all();
        
        return view('admin.customerinfo', compact('customers'));
    }
}
