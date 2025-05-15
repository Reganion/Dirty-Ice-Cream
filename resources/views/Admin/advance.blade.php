<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Advance-Payment Management</title>

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
        
        .table-container {
    margin-top: 80px;
    margin-left: auto;
    margin-right: auto;
    padding: 15px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: calc(100% - 300px); /* Better control over total width */
    max-width: 1200px; /* Optional: Prevents it from getting too wide on large screens */
    margin-bottom: 30px;
}


        /* Make the table responsive */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Prevents table overflow */
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:hover {
            background-color: #f5f7fa;
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
.content {
    margin-left: 260px; /* width of the sidebar */
    padding: 20px;
    flex: 1;
    width: 100%;
    transition: all 0.3s ease-in-out;
}
.img-container img {
    width: 100%;
    height: auto;
    object-fit: contain;
}

@media (max-width: 768px) {
    .wrapper {
        flex-direction: column;
    }

    .navbar {
        flex-direction: row;
        justify-content: space-between;
        height: 60px;
        padding: 10px 15px;
    }

    .brand-link {
        font-size: 1.1rem;
        padding: 10px 0;
    }

    .navbar .nav-link i {
        font-size: 1.5rem; /* Resize icons */
    }

    .navbar .nav-link:last-child {
        font-size: 0.95rem; /* Resize last item */
    }

    .main-sidebar {
        position: fixed;
        top: 60px;
        left: 0;
        width: 220px;
        height: calc(100vh - 60px);
        background-color: #fff; /* or your sidebar bg */
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        z-index: 1001;
    }

    .main-sidebar.sidebar-open {
        transform: translateX(0);
    }

    .content {
        margin-left: 0;
        margin-top: 60px; /* space below navbar */
        padding: 10px;
        width: 100%;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
        margin-top: 10px;
    }

    .container {
        padding: 0 10px;
    }

    table {
        width: 100%;
        table-layout: auto;
        border-collapse: collapse;
    }

    table th,
    table td {
        font-size: 0.75rem;
        padding: 8px;
        text-align: left;
        word-wrap: break-word;
        white-space: nowrap;
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
        <main class="content">
            <div class="table-container">
                <h1 align='center'>Proof of Payment</h1>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    @foreach ($advancePayments as $payment)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm rounded">
                                <img src="{{ asset('storage/' . $payment->image_path) }}" alt="Proof" class="card-img-top clickable" style="height: 200px; object-fit: contain; cursor: pointer;">

                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $payment->customer->firstname }} {{ $payment->customer->lastname }}</h5>
                                    <p class="card-text">Amount: ₱{{ number_format($payment->amount, 2) }}</p>
        
                                    <form method="POST" action="{{ route('advance-payments.update', ['id' => $payment->id]) }}">
                                        @csrf
                                        @method('POST')
                                        <select class="form-select" name="status" onchange="this.form.submit()">
                                            <option {{ $payment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option {{ $payment->status == 'Received' ? 'selected' : '' }}>Received</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
<!-- Image Modal -->
<div id="imageModal" class="modal" tabindex="-1" style="display:none; position: fixed; z-index: 2000; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); align-items: center; justify-content: center;">
    <span id="closeModal" style="position: absolute; top: 20px; right: 40px; color: white; font-size: 36px; font-weight: bold; cursor: pointer;">&times;</span>
    <img id="modalImage" style="max-width: 90%; max-height: 80%; border-radius: 10px;">
</div>


  
        
    </div>
  
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const closeBtn = document.getElementById('closeModal');
    
            document.querySelectorAll('.clickable').forEach(img => {
                img.addEventListener('click', function () {
                    modal.style.display = 'flex';
                    modalImg.src = this.src;
                });
            });
    
            closeBtn.addEventListener('click', function () {
                modal.style.display = 'none';
            });
    
            window.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
    
      
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
