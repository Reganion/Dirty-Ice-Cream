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

    .content {
      margin-top: 100px;
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

      /* Add these styles to your existing styles */
      .rating {
      margin: 10px 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .rating-stars {
      color: #ffd166;
      font-size: 1.2em;
    }
    
    .rating-count {
      margin-left: 5px;
      font-size: 0.9em;
      color: rgba(255, 255, 255, 0.8);
    }
    
    .top-rated {
      position: absolute;
      top: 10px;
      right: 10px;
      background: rgba(255, 209, 102, 0.9);
      color: #000;
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 0.8em;
      font-weight: bold;
    }
    
    .no-ratings {
      font-size: 0.9em;
      color: rgba(255, 255, 255, 0.6);
      margin: 10px 0;
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
        margin-top: 200px;
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
      <a href="/" class="brand">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" style="height: 40px; width: 40px; border-radius: 50%; vertical-align: middle; margin-right: 10px;">
        Dirty Ice Cream
      </a>      
        <div class="nav-links">
          <div class="nav-item">
            <a href="/" class="nav-icon"><i class="fas fa-home"></i></a>
            <span>Home</span>
          </div>
          <div class="nav-item">
            <a href="/home/aboutus" class="nav-icon"><i class="fas fa-users"></i></a>
            <span>About us</span>
          </div>
          <div class="nav-item">
            <a href="/home/feedback" class="nav-icon"><i class="fas fa-comments"></i></a>
            <span>Feedback</span>
          </div>
          <div class="nav-item">
            <a href="/home/flavor" class="nav-icon"><i class="fas fa-ice-cream"></i></a>
            <span>Flavors</span>
          </div>
          <div class="nav-item">
            <a href="/customer/login" class="nav-icon"><i class="fas fa-sign-in-alt"></i></a>
            <span>Sign In</span>
          </div>
        </div>
      </nav>

      <div class="content">
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px;">
          @foreach ($items as $item)
          <div style="position: relative; background-color: rgba(255, 255, 255, 0.15); border-radius: 15px; width: 250px; padding: 20px; backdrop-filter: blur(5px); box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
            @if($item->average_rating >= 4.5)
              <div class="top-rated">TOP RATED</div>
            @endif
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->flavor_name }}" style="width: 100%; height: 180px; object-fit: cover; border-radius: 10px;">
            <h3 style="margin-top: 15px; font-size: 1.5em; color: #fff;">
              {{ $item->flavor_name }}
              @if ($item->special)
                <i class="fas fa-star" style="color: gold;"></i>
              @endif
            </h3>
            
            <!-- Rating Display -->
            @if($item->rating_count > 0)
              <div class="rating">
                <div class="rating-stars">
                  @php
                    $rating = $item->average_rating;
                    $fullStars = floor($rating);
                    $hasHalfStar = ($rating - $fullStars) >= 0.5;
                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                  @endphp
                  
                  @for ($i = 0; $i < $fullStars; $i++)
                    <i class="fas fa-star"></i>
                  @endfor
                  
                  @if($hasHalfStar)
                    <i class="fas fa-star-half-alt"></i>
                  @endif
                  
                  @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="far fa-star"></i>
                  @endfor
                </div>
                <span class="rating-count">({{ number_format($item->average_rating, 1) }})</span>
              </div>
            @else
              <div class="no-ratings">No ratings yet</div>
            @endif
            
            <p style="font-size: 1.2em; margin-top: 5px; color: #fff;">₱{{ number_format($item->price, 2) }}</p>
            
            <a href="/customer/flavor" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: #ffd166; color: #000; font-weight: bold; text-decoration: none; border-radius: 8px; transition: background 0.3s ease;">
              Book Now
            </a>
          </div>
          @endforeach
        </div>
      </div>
</body>
</html>