<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Dirty Ice Cream Shop</title>
  <!-- Font Awesome CSS (Updated to the latest version) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #fff;
      background: url('{{ asset('storage/images/dirty-icecream.jpeg') }}') no-repeat center center fixed;
      background-size: cover;
      text-align: center;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(0, 0, 0, 0.7);
      padding: 15px 40px;
      width: 100%;
      position: fixed;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .brand {
      color: #fff;
      font-size: 1.8em;
      font-weight: bold;
      text-decoration: none;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 25px;
    }

    .nav-item {
      position: relative;
      transition: transform 0.2s;
    }

    .nav-item:hover {
      transform: translateY(-3px);
    }

    .nav-icon {
      font-size: 1.6em;
      color: #fff;
      transition: color 0.3s ease;
    }

    .nav-icon:hover {
      color: #ffd166;
    }

    .nav-item span {
      position: absolute;
      bottom: -30px;
      left: 50%;
      transform: translateX(-50%);
      background-color: rgba(0, 0, 0, 0.8);
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 0.8em;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .nav-item:hover span {
      opacity: 1;
      visibility: visible;
    }

    /* Profile and Account Management Styling */
    .profile {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 10px;
      padding-right: 40px;
    }

    .profile-info {
      font-size: 1.2em;
      color: #ffd166;
      cursor: pointer;
    }

    .profile-info:hover {
      text-decoration: underline;
    }

    .content {
      margin-top: 70px;
      padding: 20px;

    }

    h1 {
      font-size: 3.5em;
      color: #fff;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    p {
      font-size: 1.4em;
      margin-top: 15px;
      color: #fdfdfd;
      text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.4);
    }
 /* Modern alert styles */
 .alert {
  padding: 15px;
  color: white;
  margin-bottom: 20px;
  border-radius: 10px;
  position: fixed;
  top: 20px;
  left: 50%;
  transform: translateX(-50%); /* Center the alert horizontally */
  width: 50%; /* Adjust width for responsiveness */
  text-align: center;
  z-index: 9999; /* Increased z-index to bring alert in front of the navbar */
  font-size: 16px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  animation: slideIn 0.5s ease-in-out;
}

.alert-success {
  background-color: #28a745; /* Green */
}

.alert-error {
  background-color: #dc3545; /* Red */
}
    /* Mobile-specific styling */
    @media (max-width: 768px) {
      .alert {
    width: 90%; /* Make alert width smaller on mobile */
    font-size: 14px; /* Slightly smaller font for mobile */
    padding: 12px; /* Reduce padding */
  }
      .navbar {
        flex-direction: column;
        padding: 10px 0;
      }

      .brand {
        margin-bottom: 10px;
      }

      .nav-links {
        flex-direction: row;
        justify-content: space-around;
        width: 100%;
        padding: 10px 0;
        background-color: rgba(0, 0, 0, 0.9);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 999;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
      }

      .nav-item {
        flex: 1;
        text-align: center;
      }

      .nav-item span {
        display: none;
      }

      .content {
        margin-top: 70px;
        padding: 15px;
        margin-bottom: 80px; /* Space for bottom navbar */
      }

      h1 {
        font-size: 2.5em;
      }

      p {
        font-size: 1.2em;
      }
    }
  </style>
</head>
<body>
      <!-- Success and error alerts -->
      @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
      @endif
      @if ($errors->any())
      <div class="alert alert-error">
          {{ $errors->first() }}
      </div>
      @endif
      <nav class="navbar">
        <a href="/customer/dashboard" class="brand"><img src="{{ asset('storage/images/logo.png') }}" alt="Logo" style="height: 40px; width: 40px; border-radius: 50%; vertical-align: middle; margin-right: 10px;">
          Dirty Ice Cream</a>
        <div class="nav-links">
          <div class="nav-item">
            <a href="/customer/dashboard" class="nav-icon"><i class="fas fa-home"></i></a>
            <span>Home</span>
          </div>
          <div class="nav-item">
            <a href="/customer/book" class="nav-icon"><i class="fas fa-users"></i></a>
            <span>Book now</span>
          </div>
          <div class="nav-item">
            <a href="/customer/feedback" class="nav-icon"><i class="fas fa-comments"></i></a>
            <span>Send Feedback</span>
          </div>
          <div class="nav-item">
            <a href="/customer/flavor" class="nav-icon"><i class="fas fa-ice-cream"></i></a>
            <span>Flavors</span>
          </div>
          <div class="nav-item">
            <a href="/customer/advancepaymet/{booking_id}" class="nav-icon"><i class="fas fa-credit-card"></i></a>
            <span>Advance Payment</span>
          </div>
          <div class="nav-item">
            <a href="/customer/trackorder" class="nav-icon"><i class="fas fa-truck"></i></a>
            <span>Track Order</span>
          </div>
          <form action="{{ route('customer.logout') }}" method="POST">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; font: inherit; cursor: pointer;">
                <div class="nav-item">
                    <a href="#" class="nav-icon"><i class="fas fa-sign-out-alt"></i></a>
                    <span>Logout</span>
                </div>
            </button>
        </form>
      </div>
    </nav>
    

    <div class="content">
      <h1>Book Your Ice Cream Now!</h1>
      <p>Fill out the form below to schedule your ice cream delivery 🍨</p>
      
      <form action="{{ route('customer.book') }}" method="POST" style="background: rgba(0, 0, 0, 0.6); padding: 25px; max-width: 600px; margin: 30px auto; border-radius: 15px;">
        @csrf
        <div style="display: flex; flex-wrap: wrap; gap: 15px;">
            <!-- Flavor Selection Dropdown -->
            <select name="flavor" id="flavor" required style="flex: 1 1 48%; padding: 12px; border-radius: 8px; border: none;">
                <option value="" disabled selected>-- Select Flavor --</option>
                @foreach($items as $item)
                    <option value="{{ $item->flavor_name }}" data-price="{{ $item->price }}">{{ $item->flavor_name }}</option>
                @endforeach
            </select>
            
            <!-- Size of Gallon Dropdown -->
            <select name="size_of_gallon" id="size_of_gallon" required style="flex: 1 1 48%; padding: 12px; border-radius: 8px; border: none;">
                <option value="" disabled selected>-- Select Size of Gallon --</option>
                @foreach($gallons as $gallon)
                    <option value="{{ $gallon->size }}" data-addon-price="{{ $gallon->addon_price }}">{{ $gallon->size }}</option>
                @endforeach
            </select>
            
            <!-- Other Inputs -->
            <input type="text" name="firstname" placeholder="First Name" required style="flex: 1 1 48%; padding: 12px; border-radius: 8px; border: none;">
            <input type="text" name="lastname" placeholder="Last Name" required style="flex: 1 1 48%; padding: 12px; border-radius: 8px; border: none;">
                        <!-- Total Price Input (Automatically Calculated) -->
                        <input type="number" step="0.01" name="price_total" id="price_total" placeholder="Total Price (₱)" value="{{ old('price_total', $price ?? '') }}" required style="flex: 1 1 48%; padding: 12px; border-radius: 8px; border: none;" readonly>
            <input type="text" name="contact_no" placeholder="Contact Number" required style="flex: 1 1 100%; padding: 12px; border-radius: 8px; border: none;">
            <input type="text" name="location" placeholder="Delivery Location" required style="flex: 1 1 100%; padding: 12px; border-radius: 8px; border: none;">
            <input type="date" name="booking_date" required style="flex: 1 1 48%; padding: 12px; border-radius: 8px; border: none;">
            <input type="time" name="delivery_time" required style="flex: 1 1 48%; padding: 12px; border-radius: 8px; border: none;">
            <select name="payment_method" required style="flex: 1 1 48%; padding: 12px; border-radius: 8px; border: none;">
                <option value="" disabled selected>Payment Method</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="Gcash">Gcash</option>
            </select>
            <input type="hidden" name="status" value="scheduled">
        </div>
        <button type="submit" style="margin-top: 20px; background-color: #ffd166; color: #000; border: none; padding: 15px 30px; font-size: 1em; border-radius: 10px; cursor: pointer;">
            Submit Booking
        </button>
    </form>
    
    </div>
    <script>
      // Get references to the select elements and price_total input
      const flavorSelect = document.getElementById('flavor');
      const sizeSelect = document.getElementById('size_of_gallon');
      const priceTotalInput = document.getElementById('price_total');
  
      // Function to update the total price
      function updatePrice() {
          const flavorOption = flavorSelect.options[flavorSelect.selectedIndex];
          const sizeOption = sizeSelect.options[sizeSelect.selectedIndex];
          
          if (flavorOption && sizeOption) {
              const flavorPrice = parseFloat(flavorOption.getAttribute('data-price'));
              const sizeAddonPrice = parseFloat(sizeOption.getAttribute('data-addon-price'));
              const totalPrice = flavorPrice + sizeAddonPrice;
  
              // Update the price_total field
              priceTotalInput.value = totalPrice.toFixed(2);
          }
      }
  
      // Event listeners for when flavor or size is selected
      flavorSelect.addEventListener('change', updatePrice);
      sizeSelect.addEventListener('change', updatePrice);
  </script>
    <script>
      // Set min date to today
      document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.querySelector('input[name="booking_date"]');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
      });
    </script>
      <script>
        // Display alert if session success or error exists
        window.onload = function() {
          var alert = document.querySelector('.alert');
          if (alert) {
            alert.style.display = 'block';
            setTimeout(function() {
              alert.style.display = 'none';
            }, 5000); // Hide the alert after 5 seconds
          }
        };
      </script>
</body>
</html>
