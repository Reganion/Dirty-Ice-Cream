<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Dirty Ice Cream Shop</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
        margin-bottom: 80px;
        padding: 15px;
      }

      h1 {
        font-size: 2.5em;
      }

      p {
        font-size: 1.2em;
      }
    }

    .logout-form {
      background: none;
      border: none;
      padding: 0;
      margin: 0;
    }

    .logout-form .nav-item {
      cursor: pointer;
    }
   #image-preview {
      display: none;
      margin-top: 15px;
      border: 1px solid #ccc;
      max-width: 50%;
      height: auto;
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
  <h1>GCash Payment Information</h1>
    <p>You can pay using the following GCash accounts:</p>
    
    <table style="width: 80%; margin: 30px auto; border-collapse: collapse; background: rgba(0,0,0,0.6); color: #fff; border-radius: 10px; overflow: hidden;">
      <thead style="background: #ffd166; color: #000;">
        <tr>
          <th style="padding: 12px;">GCash Name</th>
          <th style="padding: 12px;">GCash Number</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($gcashAccounts as $account)
          <tr style="border-top: 1px solid #fff;">
            <td style="padding: 12px;">{{ $account->gcash_name }}</td>
            <td style="padding: 12px;">{{ $account->gcash_number }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    
    <h2 style="margin-top: 40px; font-size: 24px; color: #333; font-weight: bold;">Submit Advance Payment</h2>
    <form action="{{ route('customer.advance_payment.store') }}" method="POST" enctype="multipart/form-data" style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 500px; margin: 0 auto;">
      @csrf
      <div style="margin-bottom: 15px;">
        <label for="amount" style="display: block; font-size: 14px; color: #555;">Amount (₱):</label>
        <input type="number" step="0.01" name="amount" id="amount" required style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px; margin-top: 5px;">
      </div>
      
      <div style="margin-bottom: 15px;">
        <label for="image" style="display: block; font-size: 14px; color: #555;">Upload GCash Proof of Payment:</label>
        <input type="file" name="image" id="image" accept="image/*" required onchange="previewImage(event)" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px; margin-top: 5px;">
      </div>
      
      <!-- Image Preview -->
      <div id="image-preview-container" style="margin-top: 15px;">
        <img id="image-preview" src="" alt="Image Preview" style="max-width: 100%; max-height: 200px; border-radius: 4px; object-fit: cover;">
      </div>
      
      <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}"> <!-- assuming you use auth for user session -->
      
      <button type="submit" style="width: 100%; padding: 12px; background-color: #007bff; color: white; font-size: 16px; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px;">Submit Payment</button>
    </form>
    
  </div>

  <script>
    function previewImage(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
      
      reader.onload = function() {
        const imagePreview = document.getElementById('image-preview');
        imagePreview.src = reader.result;
        imagePreview.style.display = 'block';
      };
      
      if (file) {
        reader.readAsDataURL(file);
      }
    }
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
