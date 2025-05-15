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


    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
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

      .content {
        margin-top: 200px;
        padding: 15px;
        margin-bottom: 100px;
      }

      .about-box {
        padding: 20px;
        text-align: center;
      }

      .about-box h1 {
        font-size: 2em;
      }

      .about-box p {
        font-size: 1.1em;
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
    <div class="about-box">
    <h1>Welcome to our Dirty Ice Cream Shop</h1>
    <p>Where sweet memories are served with every scoop!</p>
  
    <p>Step into a world of nostalgia and delight, where every flavor tells a story and every cone brings a smile. At Dirty Ice Cream, we celebrate the joy of traditional Filipino ice cream with a twist of fun and freshness.</p>
  
    <p>Whether you're craving classic sorbetes or adventurous new blends, our handcrafted delights are made with love, laughter, and local ingredients. We believe ice cream is more than just a treat — it's a moment to cherish.</p>
  
    <p>Come taste the joy, share the sweetness, and make every visit a memory to treasure. We’re glad you’re here — now let’s scoop up some happiness together!</p>
  </div>
</div>
</body>
</html>
