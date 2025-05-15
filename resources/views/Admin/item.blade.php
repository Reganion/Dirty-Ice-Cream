<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Flavor Management</title>


    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    
<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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

        /* Content Styling */
        .container {
            margin-left: 260px;
            padding: 25px;
            flex: 1;
            max-height: calc(100vh - 60px); /* subtracting navbar height */
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }

        .card {
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .card-img-top {
    width: 100%;
    height: 200px; /* or adjust to your preferred height */
    object-fit: contain; /* keeps aspect ratio, doesn't crop */
    padding: 10px; /* optional: adds space inside the box */
}



        .card-body {
            padding: 15px;
        }

        .btn-primary,
        .btn-warning,
        .btn-danger {
            font-size: 0.9rem;
            padding: 6px 12px;
            border-radius: 4px;
        }

        /* Modal */
        .modal-content {
            padding: 20px;
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

            .wrapper {
                margin-top: 60px;
            }

            .container {
                margin-left: 0;
                width: 100%;
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

        <div class="container">
            <h1>Item Management</h1>
           <!-- Bootstrap 5 Button -->
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
    Add Item
</button>

<!-- Place this Add Item Modal OUTSIDE the loop -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.item.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Flavor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="flavor_name" class="form-label">Flavor Name</label>
                        <input type="text" name="flavor_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="flavor_type" class="form-label">Flavor Type</label>
                        <select class="form-select" name="flavor_type" required>
                            <option value="" disabled selected>Select Flavor Type</option>
                            @foreach($flavorTypes as $flavor)
                                <option value="{{ $flavor }}">{{ $flavor }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (₱)</label>
                        <input type="number" name="price" class="form-control" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Flavor Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="special" value="1" id="specialCheck">
                        <label class="form-check-label" for="specialCheck">
                            Mark as Special
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Flavor</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Item Cards and Edit Modals -->
<div class="row">
    @foreach ($items as $item)
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $item->image_path) }}" class="card-img-top" alt="{{ $item->flavor_name }}">
                    @if ($item->special)
                        <i class="fas fa-star text-warning position-absolute" style="top: 10px; right: 10px; font-size: 24px;"></i>
                    @endif
                </div>
                
                <div class="card-body">
                    <h5 class="card-title">{{ $item->flavor_name }}</h5>
                    <p class="card-text">₱{{ number_format($item->price, 2) }}</p>

                    <!-- Edit Button -->
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editItemModal{{ $item->id }}">Edit</button>

                    <!-- Delete Form -->
                    <form action="{{ route('admin.item.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>

   <!-- Edit Modal -->
<div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel{{ $item->id }}">Edit Flavor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="flavor_name{{ $item->id }}" class="form-label">Flavor Name</label>
                        <input type="text" class="form-control" id="flavor_name{{ $item->id }}" name="flavor_name" value="{{ $item->flavor_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price{{ $item->id }}" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price{{ $item->id }}" name="price" value="{{ $item->price }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image{{ $item->id }}" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image{{ $item->id }}" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="flavor_type{{ $item->id }}" class="form-label">Flavor Type</label>
                        <select class="form-select" id="flavor_type{{ $item->id }}" name="flavor_type" required>
                            <option value="" disabled>Select Flavor Type</option>
                            @foreach($flavorTypes as $flavor)
                                <option value="{{ $flavor }}" {{ $item->flavor_type == $flavor ? 'selected' : '' }}>{{ $flavor }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-check mb-3">
                        <!-- Mark as Special Checkbox -->
                        <input class="form-check-input" type="checkbox" name="special" value="1" id="specialCheck{{ $item->id }}" {{ $item->special ? 'checked' : '' }}>
                        <label class="form-check-label" for="specialCheck{{ $item->id }}">
                            Mark as Special
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Flavor</button>
                </div>
            </form>
        </div>
    </div>
</div>

    @endforeach
</div>

        </div>
    </div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
