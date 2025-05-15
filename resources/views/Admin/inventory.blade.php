<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Ingredients Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            flex-wrap: wrap;
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

        /* Main Content Container */
        .container {
            margin-left: 260px;
            padding: 25px;
            flex: 1;
            max-height: calc(100vh - 60px); /* subtracting navbar height */
            overflow-y: auto;
            transition: margin-left 0.3s ease;

        }
        .table-wrapper {
    max-height: 400px; /* adjust as needed */
    overflow-y: auto;
    border: 1px solid #ddd;
    margin-top: 5px;
}

      /* Modal Background */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
    justify-content: center;
    align-items: center;
    padding-top: 50px;
    z-index: 9999; /* Ensure it is on top of other content */
}

/* Modal Content */
.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 20px;
    border-radius: 8px;
    width: 70%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

    max-height: 80vh;            /* Limit modal height */
    overflow-y: auto;            /* Enable vertical scrolling */
    position: relative;          /* Needed for positioning the close button */
}

/* Close Button */
.close {
    color: #d62121;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 15px;
    right: 25px;
    cursor: pointer;
}

/* Close button hover */
.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Heading Style */
h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #333;
}

/* Form Group */
.form-group {
    margin-bottom: 15px;
}

/* Input Fields and Select */
input[type="text"],
input[type="number"],
input[type="file"],
select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 1rem;
}

input[type="file"] {
    padding: 8px;
}

/* Submit Button */
.btn-submit {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

.btn-submit:hover {
    background-color: #45a049;
}
/* Edit Modal Styles */
.editModal {
    display: none; /* Hidden by default */
    position: fixed; /* Fixed position to overlay on top of content */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); /* Background overlay with slight transparency */
    z-index: 10000; /* Ensure it's on top of other content */
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease-in-out; /* Smooth transition */
}

.editModal .modal-content {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    width: 80%;
    max-width: 600px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

    max-height: 80vh;            /* Limit modal height */
    overflow-y: auto;            /* Enable vertical scrolling */
    position: relative;          /* Needed for positioning the close button */
}


.editModal h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.editModal label {
    font-size: 16px;
    color: #555;
    margin-bottom: 8px;
    display: block;
}

.editModal input, .editModal select, .editModal button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.editModal input[type="file"] {
    padding: 5px;
}

.editModal button {
    background-color: #4CAF50; /* Green background */
    color: white;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.editModal button:hover {
    background-color: #45a049;
}

.editModal .close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px;
    font-weight: bold;
    color: #df1a1a;
    cursor: pointer;
    transition: color 0.3s ease;
}

.editModal .close:hover {
    color: #000;
}

.inventory-box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.inventory-box {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease;
}

.inventory-box:hover {
    transform: translateY(-5px);
}

.inventory-box img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-bottom: 1px solid #eee;
}

.inventory-content {
    padding: 16px;
    flex: 1;
}

.inventory-content h4 {
    margin: 0 0 8px;
    font-size: 1.1rem;
    color: #333;
}

.inventory-content p {
    margin: 4px 0;
    font-size: 0.95rem;
    color: #666;
}

.inventory-actions {
    padding: 12px 16px;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.inventory-actions button {
    flex: 1;
}


/* Circular image style */
.img-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

/* Style for buttons */
button {
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

/* Edit button */
.btn-edit {
    background-color: #4CAF50;
    color: white;
}

.btn-edit:hover {
    background-color: #45a049;
}

/* Delete button */
.btn-delete {
    background-color: #f44336;
    color: white;
}

.btn-delete:hover {
    background-color: #e53935;
}

.btn-deduct {
        background-color: #ff9800;
        color: white;
        padding: 8px 16px;
        font-size: 14px;
        cursor: pointer;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }
    .btn-deduct:hover {
        background-color: #e68a00;
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

            /* Adjust container margin for smaller screens */
            .container {
                margin-left: 0;
                width: 100%;
                padding: 10px;
            }

            /* Adjust sidebar toggle button */
            .navbar .nav-link#sidebarToggle {
                font-size: 1.5rem;
            }

            /* Ensure table is fully responsive */
            table {
                width: 100%;
                overflow-x: auto;
                display: block;
            }

            table th, table td {
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

        <!-- Main Content (Container) -->
        <div class="container">
            <h2>Inventory Management</h2>
<!-- Replace your current button section with this -->
<div class="d-flex justify-content-between mb-3">
    <div>
        <button class="btn-edit" onclick="openAddModal()">Add Item</button>
        <button class="btn-deduct" onclick="openDeductModal()">Deduct Ingredients</button>
    </div>
</div>
<!-- Updated Deduct Modal with Multiplier -->
<div id="deductModal" class="editModal">
    <div class="modal-content">
        <span class="close" onclick="closeDeductModal()">&times;</span>
        <h3>Deduct Ingredients</h3>
        <form id="deductForm" action="{{ route('admin.inventory.deduct') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="multiplier">Multiplier:</label>
                <select id="multiplier" name="multiplier" class="form-control" required>
                    <option value="1">Normal (x1)</option>
                    <option value="2">Double (x2)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sugar_type">Sugar Type:</label>
                <select id="sugar_type" name="sugar_type" class="form-control" required>
                    <option value="">Select Sugar Type</option>
                    <option value="White Sugar">White Sugar</option>
                    <option value="Brown Sugar">Brown Sugar</option>
                </select>
            </div>

            <div class="form-group">
                <label for="flavor">Flavor:</label>
                <select id="flavor" name="flavor" class="form-control" required>
                    <option value="">Select Flavor</option>
                    @isset($flavors)
                        @foreach($flavors as $flavor)
                            <option value="{{ $flavor->item_name }}">{{ $flavor->item_name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>

            <button type="submit" class="btn-submit">Deduct Ingredients</button>
        </form>
    </div>
</div>


         <div class="inventory-box-container">
    @foreach($inventoryItems as $booking)
    <div class="inventory-box">
        <img src="{{ asset('storage/flavors/' . $booking->image_url) }}" alt="Flavor Image">
        <div class="inventory-content">
            <h4>{{ $booking->item_name }}</h4>
            <p><strong>Type:</strong> {{ $booking->item_type }}</p>
            <p><strong>Quantity:</strong> {{ $booking->quantity }}</p>
            <p><strong>Unit:</strong> {{ $booking->unit }}</p>
         
        </div>
        <div class="inventory-actions">
            <button class="btn-edit" onclick="openEditModal({{ $booking->id }})">Edit</button>
            <button class="btn-delete" onclick="confirmDelete({{ $booking->id }})">Delete</button>
        </div>
    </div>
        <!-- Hidden Form -->
<form id="delete-form-{{ $booking->id }}" action="{{ route('admin.inventory.destroy', $booking->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
    @endforeach
</div>

        </div>
    </div>
    



<!-- Add Item Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddModal()">&times;</span>
        <h3>Add Item</h3>
        <form id="addItemForm" action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" id="item_name" name="item_name" required>
            </div>

            <div class="form-group">
                <label for="item_type">Item Type:</label>
                <select id="item_type" name="item_type" required onchange="toggleImageInput()">
                    <option value="flavor">Flavor</option>
                    <option value="ingredient">Ingredient</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="unit">Unit:</label>
                <input type="text" id="unit" name="unit" required>
            </div>

            <div class="form-group" id="imageInput">
                <label for="image_url">Image URL:</label>
                <input type="file" id="image_url" name="image_url">
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">Add Item</button>
            </div>
        </form>
    </div>
</div>


<!-- Edit Item Modal -->
<div id="editModal" class="editModal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h3>Edit Item</h3>
        <form id="editItemForm" action="{{ route('admin.inventory.update', ['id' => ':id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_item_name">Item Name:</label>
                <input type="text" id="edit_item_name" name="item_name" required>
            </div>

            <div class="form-group">
                <label for="edit_item_type">Item Type:</label>
                <select id="edit_item_type" name="item_type" required>
                    <option value="ingredient">Ingredient</option>
                    <option value="flavor">Flavor</option>
                </select>
            </div>

            <div class="form-group">
                <label for="edit_quantity">Quantity:</label>
                <input type="number" id="edit_quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="edit_unit">Unit:</label>
                <input type="text" id="edit_unit" name="unit" required>
            </div>

            <div class="form-group">
                <label for="edit_image_url">Image URL (Optional for flavors):</label>
                <input type="file" id="edit_image_url" name="image_url">
            </div>

            <div class="form-group">
                <img id="edit_image_preview" src="" alt="Image Preview" style="max-width: 100px; display: none;">
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">Update Item</button>
            </div>
        </form>
    </div>
</div>

<!-- Update your JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to open the deduct modal
    window.openDeductModal = function() {
        document.getElementById("deductModal").style.display = "flex";
    }

    window.closeDeductModal = function() {
        document.getElementById("deductModal").style.display = "none";
    }

    const deductForm = document.getElementById('deductForm');
    if (deductForm) {
        deductForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    let message = `Ingredients deducted successfully! `;
                    message += `(Multiplier: x${data.multiplier}) `;
                    message += `(Flavor not multiplied)`;
                    alert(message);
                    closeDeductModal();
                    location.reload();
                } else {
                    alert('Error: ' + (data.message || 'Unknown error occurred'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred: ' + error.message);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Deduct Ingredients';
            });
        });
    }
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
    
<script>
    // Function to open the Add Item modal
    function openAddModal() {
        document.getElementById("addModal").style.display = "flex";
    }

    // Function to close the Add Item modal
    function closeAddModal() {
        document.getElementById("addModal").style.display = "none";
    }

// Function to open the Edit Item modal and populate form
function openEditModal(itemId) {
    // Fetch the item data dynamically (e.g., using AJAX)
    fetch(`/admin/inventory/${itemId}/edit`)  // Adjust based on your route
        .then(response => response.json())
        .then(item => {
            // Populate the form with existing item data
            document.getElementById("edit_item_name").value = item.item_name;
            document.getElementById("edit_item_type").value = item.item_type;
            document.getElementById("edit_quantity").value = item.quantity;
            document.getElementById("edit_unit").value = item.unit;

            // Dynamically set the form action with the correct item ID
            document.getElementById("editItemForm").action = `/admin/inventory/${item.id}`;

            // If the item has an image, show the preview
            if (item.image_url) {
                document.getElementById("edit_image_preview").style.display = "block";
                document.getElementById("edit_image_preview").src = `/storage/flavors/${item.image_url}`;
            } else {
                document.getElementById("edit_image_preview").style.display = "none";
            }

            // Show the modal
            document.getElementById("editModal").style.display = "flex";
        })
        .catch(error => {
            console.error('Error fetching item data:', error);
        });
}

// Function to close the Edit Item modal
function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}


</script>

<!-- JavaScript -->
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this booking?")) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

</body>
</html>
