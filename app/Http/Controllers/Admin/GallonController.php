<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallon;
use Illuminate\Support\Facades\Session;

class GallonController extends Controller
{
    public function index()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }

        $gallons = Gallon::all();
        return view('admin.gallon', compact('gallons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'addon_price' => 'required|numeric|min:0',
        ]);

        Gallon::create($request->only(['size', 'stock', 'addon_price']));

        return redirect()->back()->with('success', 'Gallon added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'addon_price' => 'required|numeric|min:0',
        ]);

        $gallon = Gallon::findOrFail($id);
        $gallon->update($request->only(['size', 'stock', 'addon_price']));

        return redirect()->back()->with('success', 'Gallon updated successfully!');
    }

    public function destroy($id)
    {
        $gallon = Gallon::findOrFail($id);
        $gallon->delete();

        return redirect()->back()->with('success', 'Gallon deleted successfully!');
    }
}
