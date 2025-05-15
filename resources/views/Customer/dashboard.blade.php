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
      background: rgba(0, 0, 0, 0.75);
      padding: 15px 40px;
      width: 100%;
      position: fixed;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .brand {
      color: #fff;
      font-size: 2em;
      font-weight: bold;
      text-decoration: none;
      display: flex;
      align-items: center;
    }

    .brand img {
      height: 45px;
      width: 45px;
      border-radius: 50%;
      margin-right: 12px;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .nav-item {
      position: relative;
      transition: transform 0.2s ease;
    }

    .nav-item:hover {
      transform: translateY(-3px);
    }

    .nav-icon {
      font-size: 1.7em;
      color: #ffffff;
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
      background-color: rgba(0, 0, 0, 0.85);
      padding: 6px 14px;
      border-radius: 10px;
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
      margin-top: 90px;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 70vh;
      animation: fadeIn 1.5s ease-in-out;
    }

    .about-box {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 40px;
      border-radius: 20px;
      max-width: 850px;
      width: 95%;
      box-shadow: 0 10px 30px rgba(0,0,0,0.4);
      text-align: left;
    }

    .about-box h1 {
      font-size: 2.5em;
      color: #161515;
      margin-bottom: 20px;
    }

    .about-box p {
      font-size: 1.2em;
      line-height: 1.8;
      color: #111010;
      margin-bottom: 15px;
    }

/* Simple fade-in animation */
@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(40px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        padding: 10px 0;
      }

      .brand {
        margin-bottom: 12px;
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

      .content {
        margin-top: 200px;
        margin-bottom: 80px;
        padding: 15px;
      }

      h1 {
        font-size: 2.3em;
      }

      p {
        font-size: 1.1em;
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

  <div class="content">
    <div class="about-box">
    <h1>Welcome to our Dirty Ice Cream Shop</h1>
    <p>Where sweet memories are served with every scoop!</p>
    <p>Discover the delightful taste of nostalgia with our classic dirty ice cream flavors that transport you back to childhood. Each bite is a blend of creamy sweetness and joyful tradition.</p>
    <p>Whether you're planning a celebration or just craving a cool treat, we've got the perfect scoop for you. From colorful cones to party-sized gallons, we make every moment more special.</p>
    <p>Book your orders in advance, track your delivery, and pay online—all from the comfort of your home. We’re here to bring you not just ice cream, but a heartwarming experience.</p>
    <p>Come taste happiness today. Welcome to a world where every lick tells a story!</p>
  </div>
</div>
</body>
</html>
