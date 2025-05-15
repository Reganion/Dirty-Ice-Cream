<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GcashAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GcashAccountController extends Controller
{
    // Display all GCash accounts
    public function index()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }

        $gcashAccounts = GcashAccount::all();
        return view('admin.gcash', compact('gcashAccounts'));
    }

    // Store a new GCash account
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'gcash_number' => 'required|unique:gcash_accounts',
            'gcash_name' => 'required|string|max:255',
        ]);

        // Create the new GCash account
        GcashAccount::create([
            'gcash_number' => $request->gcash_number,
            'gcash_name' => $request->gcash_name,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.gcash')->with('success', 'GCash Account added successfully!');
    }

    // Update an existing GCash account
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'gcash_number' => 'required',
            'gcash_name' => 'required|string|max:255',
        ]);

        // Find the GCash account by ID and update
        $gcashAccount = GcashAccount::findOrFail($id);
        $gcashAccount->update([
            'gcash_number' => $request->gcash_number,
            'gcash_name' => $request->gcash_name,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.gcash')->with('success', 'GCash Account updated successfully!');
    }

    // Delete a GCash account
    public function destroy($id)
    {
        // Find and delete the GCash account by ID
        $gcashAccount = GcashAccount::findOrFail($id);
        $gcashAccount->delete();

        // Redirect back with success message
        return redirect()->route('admin.gcash')->with('success', 'GCash Account deleted successfully!');
    }
}
