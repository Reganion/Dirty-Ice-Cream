<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh; /* Ensure the container is vertically centered */
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
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        width: 320px;
        text-align: center;
        z-index: 1;
    }

    h2 {
        margin-bottom: 20px;
        color: #007bff;
    }

    fieldset {
        border: 2px solid #007bff;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    legend {
        font-weight: bold;
        color: #007bff;
    }

    .input-field {
        width: 93%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #000;
        border-radius: 5px;
        background: #f8f8f8;
        color: #000;
    }

    .btn {
        width: 100%;
        padding: 10px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn:hover {
        background: #0056b3;
    }

    .error {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .success {
        color: green;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .register-link {
        margin-top: 10px;
        font-size: 14px;
        color: #000;
    }

    .register-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .register-link a:hover {
        text-decoration: underline;
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

      .container {
        width: 90%;
        margin-top: 120px; /* Adjusted space for mobile */
      }

      h2 {
        font-size: 1.8em;
      }

      .input-field {
        width: 100%;
      }

      .btn {
        width: 100%;
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
    
    <div class="container">
        <h2>Login</h2>
        
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('customer.login') }}">
            @csrf
            <fieldset>
                <legend>Account Login</legend>
                <input type="text" name="email" class="input-field" placeholder="Email" required><br>
                <input type="password" name="password" class="input-field" placeholder="Password" required><br>
                <button type="submit" class="btn">Login</button>
            </fieldset>
        </form>

        <p class="register-link">Don't have an account? <a href="/customer/register">Register here</a></p>
    </div>

</body>
</html>
