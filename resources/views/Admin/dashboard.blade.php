<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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
            height: calc(100vh - 60px);
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


        /* Content Wrapper */
        .content-wrapper {
            margin-left: 260px;
            padding: 25px;
            flex: 1;
            max-height: calc(100vh - 60px); /* subtracting navbar height */
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }

        .small-box {
    border-radius: 12px;
    padding: 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: #6c757d;
    min-height: 200px; /* Minimum height */
    margin-bottom: 10px;
}


        .small-box .icon {
            font-size: 3rem;
            opacity: 0.2;
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .small-box-footer {
    color: #fff;
    text-decoration: none;
    margin-top: 10px;
    display: inline-block;
    transition: color 0.2s;
}
.small-box-footer:hover {
            color: #e2e2e2;
        }
        /* Responsive Adjustments */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col-lg-3, .col-12 {
            flex: 1 1 100%;
            max-width: 100%;
        }

        @media (min-width: 768px) {
            .col-lg-3 {
                flex: 1 1 calc(25% - 20px);
                max-width: calc(25% - 20px);
            }
        }

        /* Adjust charts for better mobile fit */
        canvas {
            width: 100% !important;
            height: auto !important;
            max-height: 350px;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-sizing: border-box;
        }

        /* Sidebar mobile toggle */
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

            .content-wrapper {
                margin-left: 0 !important;
                padding: 15px;
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

            .small-box {
                padding: 15px;
            }

            .small-box .icon {
                font-size: 2.5rem;
                margin-top: 10px;
            }

            .brand-link {
                font-size: 1.1rem;
                padding: 15px;
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

        <!-- Content -->
        <div class="content-wrapper">
            <h1>Admin Dashboard</h1>

            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalOrders }}</h3>
                            <p>Total Orders</p>
                        </div>
                        <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                        <a href="{{ route('admin.booking')}}" class="small-box-footer">View Orders <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalBookings }}</h3>
                            <p>Total Bookings</p>
                        </div>
                        <div class="icon"><i class="fas fa-book"></i></div>
                        <a href="{{ route('admin.booking')}}" class="small-box-footer">View Bookings <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>₱{{ number_format($totalSales, 2) }}</h3>
                            <p>Total Sales</p>
                        </div>
                        <div class="icon"><i class="fas fa-coins"></i></div>
                        <a href="{{ route('admin.booking')}}" class="small-box-footer">View Sales <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $mostPopularFlavor->flavor }}</h3>
                            <p>Most Popular Flavor</p>
                        </div>
                        <div class="icon"><i class="fas fa-ice-cream"></i></div>
                        <a href="{{ route('admin.item.index')}}" class="small-box-footer">View Flavors <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Additional Row for New Totals -->
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalCustomers }}</h3>
                            <p>Total Customers</p>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <a href="{{ route('admin.customers')}}" class="small-box-footer">View Customers <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalCancelled }}</h3>
                            <p>Total Cancelled</p>
                        </div>
                        <div class="icon"><i class="fas fa-times-circle"></i></div>
                        <a href="{{ route('admin.booking')}}" class="small-box-footer">View Cancelled <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalFlavors }}</h3>
                            <p>Total Flavors</p>
                        </div>
                        <div class="icon"><i class="fas fa-pizza-slice"></i></div>
                        <a href="{{ route('admin.item.index')}}" class="small-box-footer">View Flavors <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $totalGallons }}</h3>
                            <p>Total Gallons</p>
                        </div>
                        <div class="icon"><i class="fas fa-tint"></i></div>
                        <a href="{{ route('admin.gallon.index')}}" class="small-box-footer">View Gallons <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Charts -->
            <div class="row">
                <div class="col-lg-6 col-12">
                    <canvas id="genderChart"></canvas>
                </div>
                <div class="col-lg-6 col-12">
                    <canvas id="myBarChart"></canvas>
                </div>
                <div class="col-lg-6 col-12">
                    <canvas id="salesLineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Toggle Script -->
    <script>
   document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('genderChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    'Male ({{ $malePercentage }}%)',
                    'Female ({{ $femalePercentage }}%)',
                    'Others ({{ $otherPercentage }}%)'
                ],
                datasets: [{
                    data: [{{ $malePercentage }}, {{ $femalePercentage }}, {{ $otherPercentage }}],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.parsed}%`;
                            }
                        }
                    }
                }
            }
        });
    });
    const labels = ['Orders', 'Bookings', 'Customers', 'Cancelled', 'Flavors', 'Gallons'];
const dataValues = [
    {{ $totalOrders }},  // Total Orders
    {{ $totalBookings }},  // Total Bookings
    {{ $totalCustomers }},  // Total Customers
    {{ $totalCancelled }},  // Total Cancelled
    {{ $totalFlavors }},  // Total Flavors
    {{ $totalGallons }}
];

const ctx = document.getElementById('myBarChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Metrics',
            data: dataValues,
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#dc3545', '#ffc0cb'],
            borderColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff', '#ffffff', '#ffffff'],
            borderRadius: 8
        }]
    },
    options: {
        plugins: {
            legend: { display: false },
            // Remove the datalabels plugin configuration entirely
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
    // Remove the plugins array that was adding ChartDataLabels
});
    </script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('salesLineChart').getContext('2d');
        
        // Sample weekly data (replace with your actual data)
        const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        const weeklySales = [1200, 1900, 1700, 2100, 2400, 3200, 2800]; // Replace with your PHP data
        
        const salesLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: daysOfWeek,
                datasets: [{
                    label: 'Weekly Sales (₱)',
                    data: weeklySales,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#007bff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₱' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₱' + value.toLocaleString();
                            },
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                },
                elements: {
                    line: {
                        borderWidth: 2
                    }
                }
            }
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
