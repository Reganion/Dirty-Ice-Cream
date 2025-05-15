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
        <h2 style="font-size: 2.5em; color: #ffd166; margin-bottom: 30px; text-shadow: 1px 1px 5px rgba(0,0,0,0.3);">🍧 What Our Customers Say</h2>
      
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; padding: 0 20px;">
          @foreach($feedbacks as $feedback)
            <div style="
              background: rgba(255, 255, 255, 0.452);
              border-radius: 16px;
              padding: 25px;
              color: #333;
              box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
              transition: transform 0.3s ease, box-shadow 0.3s ease;
            " onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.2)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 6px 15px rgba(0, 0, 0, 0.15)'">
              <h4 style="font-size: 1.3em; color: #444; margin-bottom: 10px;">
                {{ $feedback->customer->firstname ?? 'Anonymous' }} {{ $feedback->customer->lastname ?? '' }}
              </h4>
              <p><strong>🍨 Flavor:</strong> {{ $feedback->flavor_name }}</p>
              <p><strong>⭐ Rating:</strong> {{ $feedback->rating }}/5</p>
              <p style="margin-top: 10px; font-style: italic; color: #555;">“{{ $feedback->comments }}”</p>
              <small style="color: #888; display: block; margin-top: 12px;">{{ \Carbon\Carbon::parse($feedback->created_at)->format('F d, Y') }}</small>
            </div>
          @endforeach
        </div>
      </div>
      
</body>
</html>
