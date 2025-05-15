<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FlavorController extends Controller
{
    public function index()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('customer.login')->withErrors(['error' => 'Please login first.']);
        }
        $feedbacks = Feedback::all(); // Or use where() clauses as needed
        // Join items with inventory to get stock quantity for each flavor
        $items = DB::table('items')
            ->leftJoin('inventory', function ($join) {
                $join->on('items.flavor_type', '=', 'inventory.item_name')
                     ->where('inventory.item_type', '=', 'flavor');
            })
            ->select(
                'items.*',
                'inventory.quantity as stock_quantity'
            )
            ->get();

        return view('customer.flavor', compact('items', 'feedbacks'));
    }
}
