<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerLoginController;
use App\Http\Controllers\Customer\FeedbackController;
use App\Http\Controllers\Customer\FlavorController;
use App\Http\Controllers\Customer\CustomerBookingController;

use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\GallonController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\Admin\GcashAccountController;
use App\Http\Controllers\Admin\AdvancePaymentController;
use App\Http\Controllers\IceCreamController;

Route::get('/', [IceCreamController::class, 'index']);
Route::get('/home/feedback', [IceCreamController::class, 'feedback']);
Route::get('/home/aboutus', [IceCreamController::class, 'about']);
Route::get('/home/flavor', [IceCreamController::class, 'flavor']);

    Route::get('/customer/book', [CustomerBookingController::class, 'create'])->name('customer.book.form');
    Route::post('/customer/book', [CustomerBookingController::class, 'store'])->name('customer.book');

    Route::put('/customer/update-status/{id}', [CustomerBookingController::class, 'updateStatus'])->name('customer.updateStatus');
    Route::delete('/customer/bookings/{id}', [CustomerBookingController::class, 'destroy'])->name('customer.deleteBooking');
    Route::put('/customer/bookings/{booking}', [CustomerBookingController::class, 'update'])->name('customer.bookings.update');

    Route::get('/customer/trackorder', [CustomerBookingController::class, 'trackOrder'])->name('customer.trackorder');

    // Route to handle the submission of the advance payment
    Route::post('/customer/advance_payment/store', [PaymentController::class, 'storeAdvancePayment'])->name('customer.advance_payment.store');
    
    Route::get('/customer/advancepaymet/{booking_id}', [PaymentController::class, 'welcomePage'])->name('customer.advance');
    Route::get('/verify-otp', [CustomerLoginController::class, 'showOtpForm'])->name('customer.otp.verify.form');
    Route::post('/verify-otp', [CustomerLoginController::class, 'verifyOtp'])->name('customer.otp.verify');
    Route::post('/customer/otp/resend', [CustomerLoginController::class, 'resendOtp'])->name('customer.otp.resend');

    
// Customer login/logout
Route::get('/customer/login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerLoginController::class, 'login'])->name('customer.login.submit');
Route::post('/customer/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');

// Customer registration
Route::get('/customer/register', [CustomerLoginController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customer/register', [CustomerLoginController::class, 'register'])->name('customer.register.submit');

// Customer dashboard (with chat)

    Route::get('/customer/dashboard', [CustomerLoginController::class, 'showDashboard'])->name('customer.dashboard');
    Route::post('/chat', [CustomerLoginController::class, 'sendMessage'])->name('chat.sendMessage');


Route::get('/customer/feedback', [FeedbackController::class, 'showFeedbackForm'])->name('feedback.show');
Route::post('/customer/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('customer/flavor', [FlavorController::class, 'index'])->name('customer.flavor');


    // Show login form
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.adminlogin');
    // Handle login POST request
    Route::post('/admin/login', [AdminController::class, 'login'])->name('login.submit');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/booking', [BookingController::class, 'index'])->name('admin.booking');
    Route::get('/admin/welcome', [AdminController::class, 'homeIndex'])->name('admin.home.index');

    Route::get('/admin/inventory', [InventoryController::class, 'index'])->name('admin.inventory.index');
    Route::post('/admin/inventory', [InventoryController::class, 'store'])->name('admin.inventory.store');
 // Show the edit form for an item
    Route::get('admin/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('admin.inventory.edit');
// Update the item
    Route::put('/admin/inventory/{id}', [InventoryController::class, 'update'])->name('admin.inventory.update');
    Route::delete('/admin/inventory/{id}', [InventoryController::class, 'destroy'])->name('admin.inventory.destroy');
    Route::post('/admin/inventory/deduct', [InventoryController::class, 'deduct'])->name('admin.inventory.deduct');
    
        // Display all items (index page)
        Route::get('/admin/items', [ItemController::class, 'index'])->name('admin.item.index');
        // Show the form to add a new item (create page)
        Route::get('/admin/items/create', [ItemController::class, 'create'])->name('admin.item.create');
        // Handle the form submission for creating a new item
        Route::post('/admin/items', [ItemController::class, 'store'])->name('admin.item.store');
        // Show the form to edit an existing item
        Route::get('/admin/items/{id}/edit', [ItemController::class, 'edit'])->name('admin.item.edit');
        // Handle the form submission for updating an existing item
        Route::put('/admin/items/{id}', [ItemController::class, 'update'])->name('admin.item.update');
        // Handle the deletion of an item
        Route::delete('/admin/items/{id}', [ItemController::class, 'destroy'])->name('admin.item.destroy');


    Route::get('/admin/gallon', [GallonController::class, 'index'])->name('admin.gallon.index');
    Route::post('/admin/store', [GallonController::class, 'store'])->name('admin.gallon.store');
    Route::put('/admin/gallon/{id}', [GallonController::class, 'update'])->name('admin.gallon.update');
    Route::delete('/admin/delete/{id}', [GallonController::class, 'destroy'])->name('admin.gallon.destroy');
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers');
        // Route to display all feedback (admin only)
        Route::get('/admin/feedback', [AdminFeedbackController::class, 'index'])->name('admin.feedback.index');

        // Route to delete a feedback item
        Route::delete('/admin/feedback/{id}', [AdminFeedbackController::class, 'destroy'])->name('admin.feedback.destroy');
        Route::post('/admin/chat/send', [AdminController::class, 'sendMessage'])->name('admin.chat.send');



    // Display all GCash accounts
    Route::get('/admin/gcash', [GcashAccountController::class, 'index'])->name('admin.gcash');
    
    // Store a new GCash account
    Route::post('/admin/gcash', [GcashAccountController::class, 'store'])->name('admin.gcash.store');
    
    // Update an existing GCash account
    Route::put('/admin/gcash/{id}', [GcashAccountController::class, 'update'])->name('admin.gcash.update');
    
    // Delete a GCash account
    Route::delete('/admin/gcash/{id}', [GcashAccountController::class, 'destroy'])->name('admin.gcash.destroy');
    Route::post('/admin/booking/{id}/update-status', [BookingController::class, 'updateStatus'])->name('admin.booking.updateStatus');



Route::get('/admin/advance-payments', [AdvancePaymentController::class, 'index'])->name('advance-payments.index');
Route::post('/admin/advance-payments/{id}/update', [AdvancePaymentController::class, 'updateStatus'])->name('advance-payments.update');
