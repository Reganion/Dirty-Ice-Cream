<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <!-- Custom Styles -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff;
            padding: 12px 24px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .nav-link {
            color: #007bff;
            font-size: 1.1rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: #0056b3;
        }

        .wrapper {
            display: flex;
            margin-top: 60px;
        }

        /* Sidebar */
        .main-sidebar {
            width: 260px;
            background: linear-gradient(145deg, #343a40, #2d3237);
            color: white;
            height: calc(100vh - 60px);
            position: fixed;
            top: 60px;
            left: 0;
            z-index: 999;
            overflow-y: auto;
            transition: all 0.3s ease;
            border-right: 1px solid #2e3439;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .brand-link {
            padding: 20px;
            font-size: 1.4rem;
            font-weight: bold;
            color: #ffffff;
            background-color: #1e2125;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .user-panel {
            padding: 16px;
            display: flex;
            align-items: center;
            background: #1f2327;
            border-bottom: 1px solid #2f343a;
        }

        .user-panel .image img {
            border-radius: 50%;
            width: 45px;
            height: 45px;
            border: 2px solid #007bff;
        }

        .user-panel .info {
            margin-left: 10px;
            font-size: 0.9rem;
        }

        .nav-sidebar {
            padding: 20px 10px;
        }

        .nav-item {
            margin: 6px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 8px 14px;
            color: #cfd2d6;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: #007bff;
            color: #ffffff;
            transform: translateX(4px);
        }

        .nav-icon {
            margin-right: 12px;
            font-size: 1.2rem;
        }
        .welcome-container {
    margin-top: 20px;
    text-align: center;
    padding: 40px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
}

        .welcome-container h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #007bff;
            font-weight: 700;
        }

        .welcome-container p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #6c757d;
        }

        .quick-links {
            display: flex;
            justify-content: center;
            gap: 25px;
        }

        .quick-links a {
            background-color: #007bff;
            color: white;
            padding: 15px 30px;
            font-size: 1.1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .quick-links a:hover {
            background-color: #0056b3;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .content {
    margin-left: 260px;
    padding: 20px;
    margin-top: 60px;
    flex-grow: 1;
    min-height: calc(100vh - 60px);
}

@media (max-width: 768px) {

    /* Navbar */
    .navbar {
        height: 50px;
        padding: 5px 10px;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1002;
        background-color: #fff;
        border-bottom: 1px solid #ddd;
    }

    .brand-link {
        font-size: 1rem;
        padding: 5px 0;
    }

    .navbar .nav-link {
        margin: 0 5px;
        font-size: 0.9rem;
    }

    .navbar .nav-link i {
        font-size: 1.2rem;
    }

    /* Sidebar */
    .main-sidebar {
        position: fixed;
        top: 50px; /* below navbar */
        left: 0;
        width: 200px;
        height: calc(100vh - 50px);
        background-color: #fff;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        z-index: 1001;
        overflow-y: auto;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .main-sidebar.sidebar-open {
        transform: translateX(0);
    }

    .sidebar-menu li,
    .sidebar-menu a {
        font-size: 0.85rem;
        padding: 8px 12px;
    }

    /* Content Area */
    .content {
        margin-left: 0;
        padding: 10px;
        margin-top: 60px; /* Space for navbar */
    }

    .welcome-container {
    padding: 10px;
    margin: 5px;
    border-radius: 6px;
    background-color: #f9f9f9;
    width: 100%;
}

.welcome-container h1 {
    font-size: 1.2rem;
    margin-bottom: 8px;
}

.welcome-container p {
    font-size: 0.9rem;
    margin-bottom: 10px;
    line-height: 1.3;
}


    .quick-links {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 10px 5px;
    }

    .quick-links a {
        width: 100%;
        max-width: 240px;
        padding: 10px;
        font-size: 0.9rem;
        text-align: center;
        box-sizing: border-box;
    }

    /* Sidebar Toggle Button */
    .navbar #sidebarToggle {
        font-size: 1.4rem;
    }
}

    </style>
</head>
<body>

    <!-- Navbar (top) -->
    <nav class="navbar">
        <a class="nav-link" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></a>
        <a class="nav-link" href="{{ route('admin.logout')}}">Logout</a>
    </nav>

    <div class="wrapper">
        <!-- Sidebar (left) -->
        <aside class="main-sidebar">
            <a href="#" class="brand-link">
                <i class="fas fa-cogs"></i>
                <span class="brand-text">Admin</span>
            </a>
            <div class="sidebar">
                <div class="user-panel">
                    <div class="image">
                        @if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->image)
                            <img src="{{ asset('storage/images/' . Auth::guard('admin')->user()->image) }}" alt="User Image">
                        @else
                            <img src="{{ asset('storage/images/default.jpg') }}" alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="{{ route('admin.gcash')}}"> {{ Auth::guard('admin')->user()->name ?? 'Kyle Admin' }} </a><br>
                        <span>Online</span>
                    </div>
                </div>
                
                <nav class="nav-sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="{{ route('admin.home.index')}}" class="nav-link"><i class="nav-icon fas fa-home"></i> Home</a></li>
                        <li class="nav-item"><a href="{{ route('admin.dashboard')}}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="nav-item"><a href="{{ route('admin.booking')}}" class="nav-link"><i class="nav-icon fas fa-users"></i> Customer Booking</a></li>
                        <li class="nav-item"><a href="{{ route('advance-payments.index')}}" class="nav-link"><i class="nav-icon fas fa-credit-card"></i> Advance Payment</a></li>
                        <li class="nav-item"><a href="{{ route('admin.feedback.index')}}" class="nav-link"><i class="nav-icon fas fa-comments"></i> Feedback</a></li>
                        <li class="nav-item"><a href="{{ route('admin.inventory.index')}}" class="nav-link"><i class="nav-icon fas fa-archive"></i> Ingredients Inventory</a></li>
                        <li class="nav-item"><a href="{{ route('admin.customers')}}" class="nav-link"><i class="nav-icon fas fa-users-cog"></i> Customer Information</a></li>
                        <li class="nav-item"><a href="{{ route('admin.item.index')}}" class="nav-link"><i class="nav-icon fas fa-cogs"></i> Item</a></li>
                        <li class="nav-item"><a href="{{ route('admin.gallon.index')}}" class="nav-link"><i class="nav-icon fas fa-cogs"></i> Gallon</a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content (Welcome Page) -->
        <main class="content">
            <div class="welcome-container">
                <h1>Welcome, Admin</h1>
                <p>We’re glad to have you here. Manage all aspects of your admin panel with ease.</p>
                <div class="quick-links">
                    <a href="{{ route('admin.booking')}}">Manage Bookings</a>
                    <a href="{{ route('admin.feedback.index')}}">View Feedback</a>
                    <a href="{{ route('admin.inventory.index')}}">Manage Inventory</a>
                </div>
            </div>
        </main>
    </div>

    <!-- Toggle Script -->
    <script>
        const sidebarToggle = document.getElementById("sidebarToggle");
        const sidebar = document.querySelector(".main-sidebar");
        
        sidebarToggle.addEventListener("click", (e) => {
            e.preventDefault();
            sidebar.classList.toggle("sidebar-open");
        });
    </script>

</body>
</html>
