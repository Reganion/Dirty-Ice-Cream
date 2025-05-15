<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Booking Management</title>

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
            margin-left: 260px; /* Ensure content doesn't hide behind sidebar */
            flex-grow: 1;
        }

        /* Sidebar */
        .main-sidebar {
            width: 260px;
            background: linear-gradient(145deg, #343a40, #2d3237);
            color: white;
            height: 100vh;
            position: fixed;
            top: 60px;
            left: 0;
            right: 0;
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

        /* Adjustments for container to fit into sidebar and topbar */
        .wrapper {
            display: flex;
            margin-top: 60px; /* Space for the topbar */
            margin-left: 260px; /* Ensure content doesn't hide behind sidebar */
            flex-grow: 1;
            padding-right: 15px; /* Prevent content from touching the right edge */
            padding-left: 20px; /* Optional: Adds a little space between the container and the sidebar */
        }

        .container {
            flex-grow: 1;
            padding: 20px;
            background-color: #ffffff;
            margin-left: 15px; /* Add some space from sidebar */
            margin-right: 15px;
            margin-top: 20px; 
            overflow-x: auto; /* Allow horizontal scrolling if the table overflows */
            max-height: calc(100vh - 120px); /* Adjust for top navbar height */
            padding-bottom: 50px; /* Ensure there's enough space at the bottom */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Light shadow for separation */
            border-radius: 8px;
        }

        /* Table responsiveness adjustments */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px; /* Ensure table doesn't get too narrow */
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            white-space: nowrap;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        select.form-control {
            border-radius: 8px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            padding: 8px;
            width: 100%;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        select.form-control:hover, select.form-control:focus {
            border-color: #007bff;
            background-color: #fff;
        }

        select.form-control:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
            opacity: 0.8;
        }

        /* Custom dropdown arrow for select */
        select.custom-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: #f1f1f1;
            background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6"%3E%3Cpath fill="none" stroke="%23666" stroke-width="2" d="M1 1l4 4 4-4"%3E%3C/path%3E%3C/svg%3E');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px 7px;
            padding-right: 30px;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .wrapper {
                margin-left: 0;
                padding-left: 15px;
                padding-right: 15px;
            }
            
            .main-sidebar {
                left: -260px;
                z-index: 1000;
            }
            
            .main-sidebar.sidebar-open {
                left: 0;
            }
            
            .container {
                margin-left: 0;
                margin-right: 0;
            }
        }
    /* Updated notification styles for center-top position */
    .notification-container {
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: none; /* Allows clicks to pass through when notifications aren't visible */
        }
        
        .notification {
            position: relative;
            padding: 15px 30px;
            margin-bottom: 10px;
            border-radius: 5px;
            color: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideDown 0.5s forwards;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 80%;
            width: fit-content;
            pointer-events: auto; /* Allows interaction with the notification */
        }
        
        .notification-success {
            background-color: #28a745;
            border-left: 5px solid #218838;
        }
        
        .notification-error {
            background-color: #dc3545;
            border-left: 5px solid #c82333;
        }
        
        .notification-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0 0 0 15px;
            margin-left: 10px;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-100px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeOut {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(-50px);
                opacity: 0;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .notification {
                max-width: 90%;
                padding: 12px 20px;
                font-size: 0.9rem;
            }
        }
        @media (max-width: 768px) {
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
        }
    </style>
</head>
<body>
 <!-- Remove the old alert divs and replace with this notification container -->
 <div class="notification-container" id="notificationContainer">
    @if(session('success'))
    <div class="notification notification-success">
        <span>{{ session('success') }}</span>
        <button class="notification-close" onclick="this.parentElement.remove()">&times;</button>
    </div>
    @endif
    
    @if(session('error'))
    <div class="notification notification-error">
        <span>{{ session('error') }}</span>
        <button class="notification-close" onclick="this.parentElement.remove()">&times;</button>
    </div>
    @endif
</div>


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

        <!-- Customer Information Section -->
        <div class="container">

            <h3>Customer Bookings</h3>
            
            <div class="d-flex justify-content-end mb-3 gap-2">
                <div class="input-group" style="width: 350px;">
                    <input type="text" id="searchBar" class="form-control" placeholder="Search by name..." onkeyup="searchBookings()">
                    <select class="form-select" id="statusFilter" onchange="searchBookings()">
                        <option value="">All Statuses</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="on the way">On the Way</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="bookingTable">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Customer Name</th>
                            <th>Contact No</th>
                            <th>Location</th>
                            <th>Booking Date</th>
                            <th>Delivery Time</th>
                            <th>Flavor</th>
                            <th>Size</th>
                            <th>Total Price</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->firstname }} {{ $booking->lastname }}</td>
                                <td>{{ $booking->contact_no }}</td>
                                <td>{{ $booking->location }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->delivery_time)->format('h:iA') }}</td>
                                <td>{{ $booking->flavor }}</td>
                                <td>{{ $booking->size_of_gallon }}</td>
                                <td>{{ number_format($booking->price_total, 2) }}</td>
                                <td>{{ $booking->payment_method }}</td>
                                <td>
                                    <form action="{{ route('admin.booking.updateStatus', ['id' => $booking->id]) }}" method="POST" id="status-form-{{ $booking->id }}">
                                        @csrf
                                        <select class="form-control custom-select" name="status" id="status-{{ $booking->id }}" onchange="this.form.submit()" 
                                            {{ $booking->status == 'cancelled' ? 'disabled' : '' }}
                                            {{ $booking->status == 'completed' ? 'disabled' : '' }}>
                                            <option value="scheduled" {{ $booking->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                            <option value="on the way" {{ $booking->status == 'on the way' ? 'selected' : '' }}>On the Way</option>
                                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }} 
                                                {{ $booking->status == 'on the way' ? '' : 'disabled' }}>Completed</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       function searchBookings() {
        const nameFilter = document.getElementById('searchBar').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const table = document.getElementById('bookingTable');
        const rows = table.getElementsByTagName('tr');
        
        for (let i = 1; i < rows.length; i++) { // Skip header row
            const nameCell = rows[i].getElementsByTagName('td')[1]; // Customer Name column
            const statusSelect = rows[i].querySelector('select[name="status"]');
            
            if (nameCell && statusSelect) {
                const nameText = nameCell.textContent.toLowerCase();
                const statusValue = statusSelect.value.toLowerCase();
                const selectedOption = statusSelect.options[statusSelect.selectedIndex];
                const statusText = selectedOption.text.toLowerCase();
                
                // Check if row matches both filters (or filter is empty)
                const nameMatches = nameText.includes(nameFilter) || nameFilter === '';
                const statusMatches = statusValue === statusFilter || 
                                     statusText.includes(statusFilter) || 
                                     statusFilter === '';
                
                rows[i].style.display = (nameMatches && statusMatches) ? "" : "none";
            }
        }
    }

    // Initialize from URL parameters if present
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const statusParam = urlParams.get('status');
        if (statusParam) {
            document.getElementById('statusFilter').value = statusParam;
        }
        searchBookings();
        
        // Your existing initialization code...
    });

        // Initialize status dropdowns based on current status
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelects = document.querySelectorAll('select[name="status"]');
            
            statusSelects.forEach(select => {
                const status = select.value;
                if (status === 'cancelled' || status === 'completed') {
                    select.disabled = true;
                }
                
                // If status is "on the way", only enable "completed" option
                if (status === 'on the way') {
                    const options = select.querySelectorAll('option');
                    options.forEach(option => {
                        if (option.value !== 'completed' && option.value !== 'on the way') {
                            option.disabled = true;
                        }
                    });
                }
            });
        });
    </script>
    
    <!-- Add this JavaScript for notification handling -->
    <script>
        // Auto-close notifications after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.notification');
            
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.5s forwards';
                    setTimeout(() => notification.remove(), 500);
                }, 5000);
            });
            
            // Close button functionality
            document.querySelectorAll('.notification-close').forEach(button => {
                button.addEventListener('click', function() {
                    const notification = this.parentElement;
                    notification.style.animation = 'slideOut 0.5s forwards';
                    setTimeout(() => notification.remove(), 500);
                });
            });
        });
    </script>
    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.main-sidebar').classList.toggle('sidebar-open');
        });
    </script>
</body>
</html>