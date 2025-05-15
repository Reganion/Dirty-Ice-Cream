<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Customer Management</title>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

    <!-- Custom Styles -->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
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
            height: calc(100vh - 60px); /* Fix height to the viewport height minus navbar */
            position: fixed;
            top: 60px; /* Adjusted to ensure navbar doesn't overlap */
            left: 0;
            right: 0;
            overflow-y: auto; /* Enables scrolling if the content exceeds the height */
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

        /* Modern Styles */
        .container {
            margin-left: 310px;
            padding: 25px;
            flex: 1;
            max-height: calc(100vh - 60px); /* subtracting navbar height */
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }

        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table th, .table td {
            text-align: center;
            padding: 12px;
            font-size: 0.9rem;
        }

        .table th {
            font-weight: bold;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-sidebar {
                width: 250px;
                position: absolute;
                left: -250px;
                z-index: 1000;
                transition: left 0.3s ease;
            }

            .main-sidebar.sidebar-open {
                left: 0;
            }

            .navbar {
                padding: 10px 16px;
            }

            .navbar .nav-link i {
                font-size: 1.5rem;
            }

            .navbar .nav-link:last-child {
                font-size: 0.95rem;
            }

            .brand-link {
                font-size: 1.1rem;
                padding: 15px;
            }

            /* Adjust the content for mobile */
            .container {
                margin-left: 0;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                padding: 8px 10px;
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
                        <li class="nav-item"><a href="{{ route('admin.booking')}}" class="nav-link"><i class="nav-icon fas fa-users"></i>Customer Booking</a></li>
                        <li class="nav-item"><a href="{{ route('advance-payments.index')}}" class="nav-link"><i class="nav-icon fas fa-credit-card"></i>Advance Payment</a></li>
                        <li class="nav-item"><a href="{{ route('admin.feedback.index')}}" class="nav-link"><i class="nav-icon fas fa-comments"></i>Feedback</a></li>
                        <li class="nav-item"><a href="{{ route('admin.inventory.index')}}" class="nav-link"><i class="nav-icon fas fa-archive"></i>Ingredients Inventory</a></li>
                        <li class="nav-item"><a href="{{ route('admin.customers')}}" class="nav-link"><i class="nav-icon fas fa-users-cog"></i> Customer Information</a></li>
                        <li class="nav-item"><a href="{{ route('admin.item.index')}}" class="nav-link"><i class="nav-icon fas fa-cogs"></i> Item</a></li>
                        <li class="nav-item"><a href="{{ route('admin.gallon.index')}}" class="nav-link"><i class="nav-icon fas fa-cogs"></i> Gallon</a></li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Section -->
        <div class="container mt-5">
            <h3>Customer Information</h3>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Register Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->username }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->firstname }}</td>
                                <td>{{ $customer->lastname }}</td>
                                <td>{{ $customer->gender }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ \Carbon\Carbon::parse($customer->created_at)->format('F j, Y h:i A') }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
