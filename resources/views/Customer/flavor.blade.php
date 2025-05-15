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
  margin-top: 100px; /* or adjust to your preference */
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
    .items-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;

  padding-right: 10px;
}

.item-box {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 15px;
  overflow: hidden;
  width: 240px;
  backdrop-filter: blur(5px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
  transition: transform 0.3s ease;
}

.item-box:hover {
  transform: scale(1.05);
}

.image-container {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.star {
  position: absolute;
  top: 10px;
  right: 10px;
  background: #ffd700;
  color: #fff;
  padding: 5px;
  border-radius: 50%;
  font-size: 1.1em;
  box-shadow: 0 0 5px rgba(0,0,0,0.6);
}

.item-details {
  padding: 15px;
  background-color: rgba(0, 0, 0, 0.6);
}

.item-details h3 {
  font-size: 1.4em;
  margin-bottom: 5px;
  color: #fff;
}

.item-details p {
  font-size: 1.2em;
  color: #ffd166;
}
.out-of-stock-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.65);
      color: #ffd166;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2em;
      font-weight: bold;
      z-index: 2;
      letter-spacing: 2px;
      text-shadow: 1px 1px 8px #000;
      border-radius: 0 0 15px 15px;
      pointer-events: none;
      /* Prevents click-through */
    }
.book-now-btn { background-color: #ffd166; color: #fff; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px; width: 100%; }
    .book-now-btn:hover { background-color: #ff9a00; }
    /* Add these new styles for ratings */
    .rating-container {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 8px 0;
    }

    .stars {
      color: #ffd700;
      font-size: 1em;
      margin-right: 5px;
    }

    .average-rating {
      font-size: 0.9em;
      color: #fff;
      background: rgba(0,0,0,0.5);
      padding: 2px 6px;
      border-radius: 10px;
    }

    .rating-count {
      font-size: 0.8em;
      color: #ccc;
      margin-left: 5px;
    }

    /* Adjust item details padding */
    .item-details {
      padding: 15px;
      background-color: rgba(0, 0, 0, 0.6);
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Mobile-specific styling */
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

      .nav-item {
        flex: 1;
        text-align: center;
      }

      .nav-item span {
        display: none;
      }

      .content {
        margin-top: 100px;
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
  <div class="items-container">
    @foreach ($items as $item)
      @php
        // Calculate average rating for this item
        $itemFeedback = $feedbacks->where('flavor_name', $item->flavor_name);
        $averageRating = $itemFeedback->avg('rating');
        $ratingCount = $itemFeedback->count();
      @endphp
      
      <div class="item-box">
        <div class="image-container">
          <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->flavor_name }}">
          @if ($item->special)
            <div class="star"><i class="fas fa-star"></i></div>
          @endif
          @if (isset($item->stock_quantity) && $item->stock_quantity == 0)
            <div class="out-of-stock-overlay">
              Out of Stock
            </div>
          @endif
        </div>
        <div class="item-details">
          <h3>{{ $item->flavor_name }}</h3>
          
          <!-- Rating Display -->
          <div class="rating-container">
            @if($ratingCount > 0)
              <div class="stars">
                @for($i = 1; $i <= 5; $i++)
                  @if($i <= floor($averageRating))
                    <i class="fas fa-star"></i>
                  @elseif($i == ceil($averageRating) && ($averageRating - floor($averageRating)) >= 0.5)
                    <i class="fas fa-star-half-alt"></i>
                  @else
                    <i class="far fa-star"></i>
                  @endif
                @endfor
              </div>
              <span class="average-rating">{{ number_format($averageRating, 1) }}</span>
              <span class="rating-count">({{ $ratingCount }})</span>
            @else
              <span class="no-ratings">No ratings yet</span>
            @endif
          </div>
          
          <p>₱{{ number_format($item->price, 2) }}</p>
          <button class="book-now-btn" 
            @if (isset($item->stock_quantity) && $item->stock_quantity == 0) disabled style="opacity:0.6;cursor:not-allowed;" @endif
            onclick="window.location.href='{{ route('customer.book.form') }}'">
            Book Now
          </button>
        </div>
      </div>
    @endforeach
  </div>
</div>
</body>
</html>
