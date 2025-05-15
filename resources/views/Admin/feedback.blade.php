<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback Management</title>

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
        
        /* New Table Container Styles */
        .table-container {
            margin-top: 80px;
            margin-left: 270px;
            margin-right: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 8px;
        }

        .feedback-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        .feedback-table thead th {
            background-color: #4361ee;
            color: white;
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-weight: 500;
            position: sticky;
            top: 0;
        }

        .feedback-table tbody td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        /* Adjusted column widths */
        .feedback-table th:nth-child(1),
        .feedback-table td:nth-child(1) {
            width: 5%; /* SN */
        }

        .feedback-table th:nth-child(2),
        .feedback-table td:nth-child(2) {
            width: 15%; /* Customer */
        }

        .feedback-table th:nth-child(3),
        .feedback-table td:nth-child(3) {
            width: 15%; /* Flavor */
        }

        .feedback-table th:nth-child(4),
        .feedback-table td:nth-child(4) {
            width: 10%; /* Rating */
        }

        .feedback-table th:nth-child(5),
        .feedback-table td:nth-child(5) {
            width: 25%; /* Comments */
            text-align: left;
        }

        .feedback-table th:nth-child(6),
        .feedback-table td:nth-child(6) {
            width: 15%; /* Media */
        }

        .feedback-table th:nth-child(7),
        .feedback-table td:nth-child(7) {
            width: 15%; /* Action */
        }

        .feedback-table tbody tr {
            transition: all 0.2s ease;
        }

        .feedback-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .feedback-table tbody tr:hover {
            background-color: #e9ecef;
        }

        .rating-stars {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .rating-stars .fa-star {
            margin: 0 2px;
        }

        .media-preview {
            max-width: 120px;
            max-height: 80px;
            border-radius: 4px;
            object-fit: cover;
            margin: 0 auto;
            display: block;
        }

        .action-btn {
            padding: 6px 12px;
            font-size: 0.85rem;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin: 0 auto;
        }

        /* Mobile Responsiveness */
        @media (max-width: 992px) {
            .table-container {
                margin-left: 0;
                margin-right: 0;
                border-radius: 0;
                padding: 15px;
            }
        }

        @media (max-width: 768px) {
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .feedback-table th, 
            .feedback-table td {
                padding: 10px;
                font-size: 0.85rem;
            }
            
            .media-preview {
                max-width: 80px;
                max-height: 60px;
            }
            
            .action-btn {
                padding: 5px 8px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .table-title {
                font-size: 1.3rem;
            }
            
            .feedback-table th, 
            .feedback-table td {
                padding: 8px;
                font-size: 0.8rem;
            }
            
            .media-preview {
                max-width: 60px;
                max-height: 45px;
            }
        }
/* Optional backdrop when sidebar is open */
.sidebar-backdrop {
    display: none;
    position: fixed;
    top: 60px;
    left: 0;
    width: 100%;
    height: calc(100% - 60px);
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 999;
}

.sidebar-backdrop.show {
    display: block;
}

/* Add animation for smoother sidebar */
.main-sidebar {
    transition: transform 0.3s ease-in-out;
}
@media (max-width: 768px) {
    .wrapper {
        flex-direction: column;
    }

    .main-sidebar {
        transform: translateX(-100%);
        position: fixed;
        height: 100vh;
        top: 60px;
        z-index: 1001;
    }

    .main-sidebar.sidebar-open {
        transform: translateX(0);
    }

    .table-container {
        margin-left: 0;
        max-width: 100%;
        overflow-x: auto; /* Enable horizontal scroll */
    }

    .container {
        padding: 0 10px;
    }

    .navbar {
        flex-direction: row;
        justify-content: space-between;
    }

    .navbar .nav-link i {
        font-size: 1.5rem; /* Resize icons for mobile */
    }

    .navbar .nav-link:last-child {
        font-size: 0.95rem; /* Resize last navbar item */
    }

    .brand-link {
        font-size: 1.1rem;
        padding: 15px;
    }

    /* Table Styles */
    table {
        width: 100%;
        table-layout: auto; /* Allow columns to size naturally */
        border-collapse: collapse;
        min-width: 600px; /* Helps avoid squishing too much on small screens */
    }

    table th, table td {
        font-size: 0.75rem;
        padding: 8px;
        text-align: left;
        word-wrap: break-word;
    }

    table th {
        background-color: #007bff;
        font-weight: 600;
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

        <!-- Feedback Table Container wrapped in Bootstrap container -->
        <div class="container">
        <!-- Only the table container is changed -->
    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">
                <i class="fas fa-comments me-2"></i>
                Feedback Management
            </h2>
            <div class="table-count">
                <span class="badge bg-primary">{{ $feedbacks->count() }} Feedback Items</span>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Customer</th>
                        <th>Flavor</th>
                        <th>Rating</th>
                        <th>Comments</th>
                        <th>Media</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($feedbacks as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->customer->firstname}} {{ $item->customer->lastname}}</td>
                        <td>{{ $item->flavor_name }}</td>
                        <td>
                            <div class="rating-stars">
                                @php $rating = $item->rating; @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star" style="color: {{ $i <= $rating ? 'gold' : '#ddd' }};"></i>
                                @endfor
                            </div>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 100%;" title="{{ $item->comments }}">
                                {{ $item->comments }}
                            </div>
                        </td>
                        <td>
                            @if($item->media_type == 'image' && $item->image_path)
                                <img src="{{ asset('storage/feedback/' . basename($item->image_path)) }}" 
                                     alt="Feedback Image" 
                                     class="media-preview">
                            @elseif($item->media_type == 'video' && $item->video_path)
                                <video class="media-preview" controls>
                                    <source src="{{ asset('storage/feedback/' . basename($item->video_path)) }}" type="video/mp4">
                                </video>
                            @else
                                <span class="text-muted">None</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.feedback.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this feedback?')">
                                    <i class="fas fa-trash-alt"></i>
                                    <span class="d-none d-sm-inline">Delete</span>
                                </button>
                            </form>
                        </td>
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
