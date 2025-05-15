<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Feedback;
use Illuminate\Http\Request;

class IceCreamController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function flavor()
    {
        // Get average ratings per flavor
        $averageRatings = Feedback::select(
                'flavor_name',
                \DB::raw('AVG(rating) as average_rating'),
                \DB::raw('COUNT(id) as rating_count')
            )
            ->groupBy('flavor_name');
        
        // Join with items
        $items = Item::leftJoinSub($averageRatings, 'ratings', function($join) {
                $join->on('items.flavor_name', '=', 'ratings.flavor_name');
            })
            ->select('items.*', 'ratings.average_rating', 'ratings.rating_count')
            ->get();
            
        return view('welcomeflavor', compact('items'));
    }
    
    public function feedback()
    {
        $feedbacks = Feedback::with('customer')->latest()->get();
        return view('welcomefeedback', compact('feedbacks'));
    }
    
    public function about()
    {
        return view('welcomeabout');
    }
}