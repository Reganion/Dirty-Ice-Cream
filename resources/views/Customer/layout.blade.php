<!-- resources/views/layouts/customer.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <!-- Inline styles for layout -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .sidebar {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            width: 250px;
            height: 100%;
            position: fixed;
        }

        .sidebar h2 {
            color: #ecf0f1;
            font-size: 1.2em;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 1.1em;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            flex-grow: 1;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 20px auto;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #27ae60;
        }

        .message {
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- Main Wrapper -->
    <div class="container">
        <!-- Header -->
        <header>
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Your Orders</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </nav>
        </header>

        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Welcome, {{ auth()->user()->firstname }}</h2>
            <ul>
                <li><a href="#">My Orders</a></li>
                <li><a href="#">My Cart</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="content">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; 2025 Dirty Ice Cream Shop. All Rights Reserved.</p>
        </footer>
    </div>
</body>

</html>
