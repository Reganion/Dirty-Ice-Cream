<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{

    public function index()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }

        $items = Item::all();
        $flavorTypes = Inventory::where('item_type', 'flavor')->pluck('item_name');
        return view('admin.item', compact('items', 'flavorTypes'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'flavor_name' => 'required|string|max:255',
            'flavor_type' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'special' => 'nullable|boolean', // Added validation for special field
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('flavors', 'public');
        }

        Item::create([
            'flavor_name' => $request->flavor_name,
            'flavor_type' => $request->flavor_type,
            'price' => $request->price,
            'image_path' => $imagePath ?? '',
            'special' => $request->has('special') ? 1 : 0, // Handle special field
        ]);

        return redirect()->route('admin.item.index')->with('success', 'Item added successfully!');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.editItem', compact('item'));
    }

    public function update(Request $request, $id)
    {
        // Handle form submission for updating an item
        $validated = $request->validate([
            'flavor_name' => 'required|string|max:255',
            'flavor_type' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'special' => 'nullable|boolean', // Added validation for special field
        ]);

        $item = Item::findOrFail($id);

        $item->flavor_name = $validated['flavor_name'];
        $item->flavor_type = $validated['flavor_type'];
        $item->price = $validated['price'];
        $item->special = $request->has('special') ? 1 : 0; // Update the special field

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $item->image_path = $imagePath;
        }

        $item->save();

        return redirect()->route('admin.item.index')->with('success', 'Item updated successfully!');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.item.index')->with('success', 'Item deleted successfully!');
    }
}
