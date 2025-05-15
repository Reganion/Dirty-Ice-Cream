<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders | Dirty Ice Cream Shop</title>
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

    .container {
      max-width: 1200px;
      margin: 160px auto 60px auto;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.7);
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.4);
    }

    h2 {
      font-size: 2.5em;
      margin-bottom: 20px;
      color: #ffd166;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      color: #fff;
    }

    th, td {
      padding: 12px 15px;
      border: 1px solid #fff;
    }

    th {
      background-color: rgba(255, 255, 255, 0.1);
    }

    tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.05);
    }

    .badge {
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 0.9em;
    }

    .badge-warning {
      background-color: #f0ad4e;
      color: #000;
    }

    .badge-success {
      background-color: #5cb85c;
      color: #fff;
    }

    .badge-danger {
      background-color: #d9534f;
      color: #fff;
    }

    .btn-info {
      background-color: #17a2b8;
      color: white;
      padding: 6px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-size: 0.9em;
      transition: background 0.3s ease;
    }

    .btn-info:hover {
      background-color: #138496;
    }
    .table-wrapper {
      overflow-x: auto;
      width: 100%;
    }

    .status-select {
      padding: 10px 15px;
      border-radius: 6px;
      border: 2px solid #ffd166;
      background-color: #ffffff60;
      color: #333;
      font-size: 1em;
      cursor: pointer;
      transition: background-color 0.3s, border-color 0.3s;
    }

    .status-select option {
      background-color: #fff;
      color: #333;
    }

    .status-select:hover {
      background-color: #f7f7f7;
    }

    .status-select:focus {
      outline: none;
      border-color: #ffd166;
      background-color: #e0e0e0;
    }
     /* Add these new styles for the modal and edit button */
     .btn-edit {
      background-color: #ffc107;
      color: #212529;
      padding: 6px 12px;
      border-radius: 4px;
      border: none;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-edit:hover {
      background-color: #e0a800;
      transform: translateY(-2px);
    }

    .btn-edit:disabled {
      background-color: #6c757d;
      cursor: not-allowed;
    }

     /* Updated modal styles for perfect centering */
     .modal {
      display: none;
      position: fixed;
      z-index: 1050;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
      background-color: rgba(241, 237, 237, 0.9);
      margin: auto;
      padding: 25px;
      border: 1px solid #ffd166;
      border-radius: 8px;
      width: 80%;
      max-width: 600px;
      position: relative;
      top: 50%;
      transform: translateY(-50%);
      animation: modalFadeIn 0.3s;
      color: rgb(12, 12, 12);
    }

    @keyframes modalFadeIn {
      from {opacity: 0; transform: translateY(-50px) translateY(-50%);}
      to {opacity: 1; transform: translateY(0) translateY(-50%);}
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ffd166;
    }

    .modal-title {
      font-size: 1.5rem;
      color: #3a3936;
    }

    .close {
      color: #aaa;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover {
      color: white;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #595753;
      background-color: rgba(255, 255, 255, 0.1);
      color: rgb(0, 0, 0);
    }

    .form-control:focus {
      outline: none;
      border-color: #a8a7a3;
      box-shadow: 0 0 5px rgba(255, 209, 102, 0.5);
    }

    .btn-submit {
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1rem;
      transition: background-color 0.3s;
    }

    .btn-submit:hover {
      background-color: #218838;
    }
    .price-calculation {
    background-color: rgba(255, 255, 255, 0.1);
    padding: 15px;
    border-radius: 5px;
    margin-top: 10px;
  }
  
  .price-calculation div {
    margin-bottom: 8px;
  }
  
  .total-price {
    font-weight: bold;
    font-size: 1.1em;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid #ffd166;
  }
    /* Responsive adjustments for modal */
    @media (max-width: 768px) {
      .modal-content {
        width: 95%;
        margin: 20% auto;
      }
    }
@media (max-width: 768px) {
  .table-wrapper {
    -webkit-overflow-scrolling: touch;
    overflow-x: auto;
  }

  table {
    width: 1000px;
  }
}


    @media (max-width: 768px) {
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

      .nav-item span {
        display: none;
      }

      .container {
        margin: 120px 15px 100px 15px;
        padding: 15px;
      }

      h2 {
        font-size: 2em;
      }

      table {
        font-size: 0.85em;
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
    
  </style>
</head>
<body>

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


<div class="container">
  <h2>Your Orders</h2>

  @if($bookings->isEmpty())
    <p>You have no orders yet.</p>
  @else
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Booking ID</th>
            <th>Flavor</th>
            <th>Size of Gallon</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Status</th>
            <th>Booking Date</th>
            <th>Delivery Time</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bookings as $booking)
            <tr>
              <td>{{ $booking->id }}</td>
              <td>{{ $booking->flavor }}</td>
              <td>{{ $booking->size_of_gallon }}</td>
              <td>₱{{ number_format($booking->price_total, 2) }}</td>
              <td>{{ $booking->payment_method }}</td>
              <td>
                @if($booking->status == 'cancelled')
                  <span class="badge badge-danger">{{ ucfirst($booking->status) }}</span>
                @elseif(in_array($booking->status, ['on the way', 'completed']))
                  <span class="badge badge-success">{{ ucfirst($booking->status) }}</span>
                @else
                  <form action="{{ route('customer.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="status" class="status-select" onchange="this.form.submit()">
                      <option value="scheduled" {{ $booking->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                      <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                  </form>
                @endif
              </td>
              <td>
                @if(in_array($booking->status, ['cancelled', 'on the way', 'completed']))
                  <span class="text-muted">{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</span>
                @else
                  {{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}
                @endif
              </td>
              <td>
                @if(in_array($booking->status, ['cancelled', 'on the way', 'completed']))
                  <span class="text-muted">{{ \Carbon\Carbon::parse($booking->delivery_time)->format('h:iA') }}</span>
                @else
                  {{ \Carbon\Carbon::parse($booking->delivery_time)->format('h:iA') }}
                @endif
              </td>
              <td>
                <button class="btn-edit" 
                        onclick="openEditModal({{ $booking->id }})" 
                        {{ in_array($booking->status, ['cancelled', 'on the way', 'completed']) || \Carbon\Carbon::parse($booking->booking_date)->isPast() ? 'disabled' : '' }}>
                  <i class="fas fa-edit"></i> Edit
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
 <!-- Edit Booking Modal -->
 <div id="editModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2 class="modal-title">Edit Booking</h2>
      <span class="close">&times;</span>
    </div>
    <form id="editBookingForm" method="POST">
      @csrf
      @method('PUT')
      <input type="hidden" name="booking_id" id="booking_id">
      
      <div class="form-group">
        <label for="edit_flavor">Flavor</label>
        <select class="form-control" id="edit_flavor" name="flavor" required onchange="calculateTotalPrice()">
          <option value="">Select Flavor</option>
          @foreach($items as $item)
            <option value="{{ $item->flavor_name }}" data-price="{{ $item->price }}">{{ $item->flavor_name }} (₱{{ number_format($item->price, 2) }})</option>
          @endforeach
        </select>
      </div>
      
      <div class="form-group">
        <label for="edit_size">Size of Gallon</label>
        <select class="form-control" id="edit_size" name="size_of_gallon" required onchange="calculateTotalPrice()">
          <option value="">Select Size</option>
          @foreach($gallons as $gallon)
            <option value="{{ $gallon->size }}" data-addon-price="{{ $gallon->addon_price }}">{{ $gallon->size }} (₱{{ number_format($gallon->addon_price, 2) }} add-on)</option>
          @endforeach
        </select>
      </div>
      
      <div class="form-group">
        <label for="edit_payment_method">Payment Method</label>
        <select class="form-control" id="edit_payment_method" name="payment_method" required>
          <option value="">Select Payment Method</option>
          <option value="Cash on Delivery">Cash on Delivery</option>
          <option value="GCash">GCash</option>
          <option value="Bank Transfer">Bank Transfer</option>
        </select>
      </div>
      
      <div class="form-group">
        <label for="edit_booking_date">Booking Date</label>
        <input type="date" class="form-control" id="edit_booking_date" name="booking_date" required>
      </div>
      
      <div class="form-group">
        <label for="edit_delivery_time">Delivery Time</label>
        <input type="time" class="form-control" id="edit_delivery_time" name="delivery_time" required>
      </div>
      
      <div class="form-group">
        <label>Price Calculation</label>
        <div class="price-calculation">
          <div>Base Price: <span id="base-price">₱0.00</span></div>
          <div>Add-on Price: <span id="addon-price">₱0.00</span></div>
          <div class="total-price">Total Price: <span id="total-price">₱0.00</span></div>
          <input type="hidden" name="price_total" id="price_total" value="0">
        </div>
      </div>
      
      <button type="submit" class="btn-submit">Save Changes</button>
    </form>
  </div>
</div>

<script>
  // Fixed modal centering
  function centerModal() {
    const modal = document.getElementById('editModal');
    const modalContent = modal.querySelector('.modal-content');
    modalContent.style.top = '50%';
    modalContent.style.transform = 'translateY(-50%)';
  }

  // Update the openEditModal function to use the correct route
  function openEditModal(bookingId) {
    const row = document.querySelector(`tr:has(button[onclick="openEditModal(${bookingId})"])`);
    
    if (row) {
      document.getElementById("booking_id").value = bookingId;
      
      // Set flavor and trigger price calculation
      const flavorName = row.cells[1].textContent;
      const flavorSelect = document.getElementById('edit_flavor');
      for (let i = 0; i < flavorSelect.options.length; i++) {
        if (flavorSelect.options[i].text.includes(flavorName)) {
          flavorSelect.selectedIndex = i;
          break;
        }
      }
      
      // Set size and trigger price calculation
      const sizeName = row.cells[2].textContent;
      const sizeSelect = document.getElementById('edit_size');
      for (let i = 0; i < sizeSelect.options.length; i++) {
        if (sizeSelect.options[i].text.includes(sizeName)) {
          sizeSelect.selectedIndex = i;
          break;
        }
      }
      
      // Set payment method
      const paymentMethod = row.cells[4].textContent;
      document.getElementById('edit_payment_method').value = paymentMethod;
      
      // Set the correct form action (FIXED ROUTE)
      document.getElementById("editBookingForm").action = `/customer/bookings/${bookingId}`;
      
      // Trigger initial price calculation
      calculateTotalPrice();
      
      // Show modal
      const modal = document.getElementById("editModal");
      modal.style.display = "block";
      centerModal();
    }
  }

  // Close modal when clicking the X button
  document.querySelector('.close').onclick = function() {
    document.getElementById('editModal').style.display = 'none';
  }

  // Close modal when clicking outside
  window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  }

  // Price calculation function
  function calculateTotalPrice() {
    const flavorSelect = document.getElementById('edit_flavor');
    const sizeSelect = document.getElementById('edit_size');
    const basePriceSpan = document.getElementById('base-price');
    const addonPriceSpan = document.getElementById('addon-price');
    const totalPriceSpan = document.getElementById('total-price');
    const priceTotalInput = document.getElementById('price_total');
    
    // Get selected values
    const selectedFlavor = flavorSelect.options[flavorSelect.selectedIndex];
    const selectedSize = sizeSelect.options[sizeSelect.selectedIndex];
    
    // Parse prices
    const basePrice = selectedFlavor ? parseFloat(selectedFlavor.dataset.price) || 0 : 0;
    const addonPrice = selectedSize ? parseFloat(selectedSize.dataset.addonPrice) || 0 : 0;
    const totalPrice = basePrice + addonPrice;
    
    // Update display
    basePriceSpan.textContent = `₱${basePrice.toFixed(2)}`;
    addonPriceSpan.textContent = `₱${addonPrice.toFixed(2)}`;
    totalPriceSpan.textContent = `₱${totalPrice.toFixed(2)}`;
    priceTotalInput.value = totalPrice.toFixed(2);
  }

  // Initialize modal centering on window resize
  window.addEventListener('resize', centerModal);
</script>
</body>
</html>
