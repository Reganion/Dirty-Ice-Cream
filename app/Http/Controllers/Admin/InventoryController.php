<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    // Display inventory list
    public function index()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }

        $inventoryItems = Inventory::all();
        $flavors = Inventory::where('item_type', 'flavor')->get(); // Add this line
        
        return view('admin.inventory', compact('inventoryItems', 'flavors')); // Add $flavors to compact
    }
// In InventoryController.php

public function store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'item_name' => 'required|string|max:255',
        'item_type' => 'required|in:ingredient,flavor',
        'quantity' => 'required|numeric|min:0',
        'unit' => 'required|string|max:50',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle file upload if present
    if ($request->hasFile('image_url')) {
        $imagePath = $request->file('image_url')->store('flavors', 'public');
        $validated['image_url'] = basename($imagePath);
    } else {
        $validated['image_url'] = null;
    }

    // Create the inventory item
    $inventory = Inventory::create($validated);

    return redirect()->route('admin.inventory.index')
        ->with('success', 'Item added successfully!');
}
    public function deduct(Request $request)
    {
        $validated = $request->validate([
            'sugar_type' => 'required|in:White Sugar,Brown Sugar',
            'flavor' => 'required|exists:inventory,item_name',
            'multiplier' => 'required|in:1,2' // 1 for normal, 2 for double
        ]);
    
        // Base deduction amounts
        $baseSugarDeduction = 1000; // grams (or 1 if using kg)
        $baseCassavaDeduction = 250; // grams (or 0.25 if using kg)
        $baseSkimMilkDeduction = 250; // grams (or 0.25 if using kg)
        $baseFlavorDeduction = 250; // grams (or 0.25 if using kg)
    
        // Apply multiplier to all except flavor
        $multiplier = (int)$validated['multiplier'];
        $sugarDeduction = $baseSugarDeduction * $multiplier;
        $cassavaDeduction = $baseCassavaDeduction * $multiplier;
        $skimMilkDeduction = $baseSkimMilkDeduction * $multiplier;
        $flavorDeduction = $baseFlavorDeduction; // No multiplier for flavor
    
        DB::beginTransaction();
    
        try {
            // Deduct sugar (with multiplier)
            $sugar = Inventory::where('item_name', $validated['sugar_type'])->firstOrFail();
            $deduction = ($sugar->unit == 'gram') ? $sugarDeduction : ($sugarDeduction / 1000);
            if ($sugar->quantity < $deduction) {
                throw new \Exception("Insufficient {$validated['sugar_type']} quantity");
            }
            $sugar->quantity -= $deduction;
            $sugar->save();
    
            // Deduct cassava (with multiplier)
            $cassava = Inventory::where('item_name', 'Cassava')->firstOrFail();
            $deduction = ($cassava->unit == 'gram') ? $cassavaDeduction : ($cassavaDeduction / 1000);
            if ($cassava->quantity < $deduction) {
                throw new \Exception("Insufficient Cassava quantity");
            }
            $cassava->quantity -= $deduction;
            $cassava->save();
    
            // Deduct skim milk (with multiplier)
            $skimMilk = Inventory::where('item_name', 'Skim Milk')->firstOrFail();
            $deduction = ($skimMilk->unit == 'gram') ? $skimMilkDeduction : ($skimMilkDeduction / 1000);
            if ($skimMilk->quantity < $deduction) {
                throw new \Exception("Insufficient Skim Milk quantity");
            }
            $skimMilk->quantity -= $deduction;
            $skimMilk->save();
    
            // Deduct flavor (without multiplier)
            $flavor = Inventory::where('item_name', $validated['flavor'])->firstOrFail();
            $deduction = ($flavor->unit == 'gram') ? $baseFlavorDeduction : ($baseFlavorDeduction / 1000);
            if ($flavor->quantity < $deduction) {
                throw new \Exception("Insufficient {$validated['flavor']} quantity");
            }
            $flavor->quantity -= $deduction;
            $flavor->save();
    
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Ingredients deducted successfully',
                'multiplier' => $multiplier,
                'flavor_multiplied' => false // Indicate flavor wasn't multiplied
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    // Show the form for editing an item
    public function edit($id)
    {
        $item = Inventory::findOrFail($id);
        return response()->json($item);
    }

    // Update the specified item
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name'   => 'required|string|max:255',
            'item_type'   => 'required|string|in:ingredient,flavor',
            'quantity'    => 'required|numeric',
            'unit'        => 'required|string|max:50',
            'image_url'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $item = Inventory::findOrFail($id);

        $item->item_name = $request->input('item_name');
        $item->item_type = $request->input('item_type');
        $item->quantity = $request->input('quantity');
        $item->unit = $request->input('unit');

        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($item->image_url) {
                Storage::disk('public')->delete('flavors/' . $item->image_url);
            }

            // Upload new image to 'flavors' folder
            $path = $request->file('image_url')->store('flavors', 'public');
            $item->image_url = basename($path);
        }

        $item->save();

        return redirect()->route('admin.inventory.index')->with('success', 'Item updated successfully.');
    }

    // Delete item
    public function destroy($id)
    {
        $item = Inventory::findOrFail($id);

        if ($item->image_url) {
            Storage::disk('public')->delete('flavors/' . $item->image_url);
        }

        $item->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Item deleted successfully.');
    }
}
