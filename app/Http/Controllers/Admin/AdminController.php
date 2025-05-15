<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Gallon;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('Admin.adminlogin');
    }

    public function homeIndex()
    {
        // Check if the admin is logged in by checking session
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }

        return view('Admin.index');
    }

    public function dashboard()
    {
        // Authentication check
        if (!Session::has('id')) {
            return redirect()->route('admin.adminlogin')->withErrors(['error' => 'You need to log in first.']);
        }
    
        // Initialize empty arrays for sales data
        $months = [];
        $sales = [];
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeklySales = array_fill_keys($daysOfWeek, 0);
    
        // Get monthly sales data (only if needed)
        $salesData = DB::table('bookings')
            ->select(DB::raw('MONTH(booking_date) as month'), DB::raw('SUM(price_total) as total_sales'))
            ->where('status', 'completed')
            ->groupBy(DB::raw('MONTH(booking_date)'))
            ->orderBy(DB::raw('MONTH(booking_date)'))
            ->get();
    
        // Prepare monthly data
        if ($salesData->isNotEmpty()) {
            $months = $salesData->pluck('month')->toArray();
            $sales = $salesData->pluck('total_sales')->toArray();
        }
    
        // Get weekly sales data
        $weeklySalesData = DB::table('bookings')
            ->select(
                DB::raw('DAYNAME(booking_date) as day'),
                DB::raw('SUM(price_total) as total_sales')
            )
            ->where('status', 'completed')
            ->whereBetween('booking_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy(DB::raw('DAYNAME(booking_date)'))
            ->get();
    
        // Populate weekly sales
        foreach ($weeklySalesData as $sale) {
            if (array_key_exists($sale->day, $weeklySales)) {
                $weeklySales[$sale->day] = $sale->total_sales;
            }
        }
    
        // Gender statistics
        $maleCount = Customer::where('gender', 'male')->count();
        $femaleCount = Customer::where('gender', 'female')->count();
        $otherCount = Customer::where('gender', 'others')->count();
    
        $totalUsers = $maleCount + $femaleCount + $otherCount;
        $malePercentage = $totalUsers > 0 ? round(($maleCount / $totalUsers) * 100, 1) : 0;
        $femalePercentage = $totalUsers > 0 ? round(($femaleCount / $totalUsers) * 100, 1) : 0;
        $otherPercentage = $totalUsers > 0 ? round(($otherCount / $totalUsers) * 100, 1) : 0;
    
        // Business metrics
        $totalOrders = Booking::count();
        $totalSales = Booking::where('status', 'completed')->sum('price_total');
        $totalBookings = Booking::where('status', 'Scheduled')->count();
        $totalCustomers = Customer::distinct('id')->count('id');
        $totalCancelled = Booking::where('status', 'Cancelled')->count();
        $totalFlavors = Item::distinct('id')->count('id');
        $totalGallons = Gallon::distinct('id')->count('id');
        $mostPopularFlavor = Booking::select('flavor', DB::raw('COUNT(flavor) as flavor_count'))
            ->groupBy('flavor')
            ->orderByDesc('flavor_count')
            ->first();
    
        return view('admin.dashboard', [
            'totalOrders' => $totalOrders,
            'totalSales' => $totalSales,
            'totalBookings' => $totalBookings,
            'mostPopularFlavor' => $mostPopularFlavor,
            'totalCustomers' => $totalCustomers,
            'totalCancelled' => $totalCancelled,
            'totalFlavors' => $totalFlavors,
            'malePercentage' => $malePercentage,
            'femalePercentage' => $femalePercentage,
            'otherPercentage' => $otherPercentage,
            'months' => $months, // Now properly defined
            'sales' => $sales,   // Now properly defined
            'totalGallons' => $totalGallons,
            'daysOfWeek' => $daysOfWeek,
            'weeklySales' => array_values($weeklySales) // Convert to indexed array
        ]);
    }

    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Use Eloquent to retrieve the admin
        $admin = Admin::where('email', $request->email)->first();

        // Check if the admin exists and the password matches (using md5)
        if ($admin && md5($request->password) === $admin->password) {
            // Store session variables if the password is correct
            Session::put('id', $admin->id);
            Session::put('username', $admin->username);
            Session::put('email', $admin->email);
            Session::put('profile_pic', $admin->profile_pic);

            // Redirect to the admin dashboard or home page
            return redirect()->route('admin.dashboard');
        }

        // Return back with an error message if login fails
        return back()->withErrors(['error' => 'Invalid email or password.']);
    }

    public function logout()
    {
        // Clear all session data to log the admin out
        Session::flush();

        // Redirect to the admin login page
        return redirect()->route('admin.adminlogin');
    }
}
