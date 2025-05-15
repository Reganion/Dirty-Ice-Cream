<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            height: 100vh;
            margin: 0;
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
            width: 100%;
            max-width: 300px; /* Max width for larger screens */
            margin: 0 auto; /* Centering the container */
            text-align: center;
            max-height: 80vh; /* Limit container height */
            overflow-y: auto; /* Add vertical scrollbar */
        }

        /* For landscape orientation */
        @media (orientation: landscape) {
            .container {
                width: 40%; /* Adjust the container width for better use of horizontal space */
                max-width: 500px; /* Max width for larger screens */
                margin-top: 50px; /* Space from the top, considering the navbar */
                padding: 40px; /* Add more padding for a comfortable layout */
            }
        }

        h2 {
            margin-bottom: 20px;
            color: #007bff;
        }

        fieldset {
            border: 2px solid #007bff;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
        }

        legend {
            font-weight: bold;
            color: #007bff;
        }

        .input-field {
            width: 100%; /* Full width */
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #000;
            border-radius: 5px;
            background: #f8f8f8;
            color: #000;
        }

        .input-container {
            position: relative;
            width: 100%;
        }

        .email-input {
            width: 100%; /* Full width */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #000;
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

        .login-link {
            margin-top: 10px;
            font-size: 14px;
            color: #000;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
        /* Modern alert styles */
        .alert {
            padding: 15px;
            color: white;
            margin-bottom: 20px;
            border-radius: 10px;
            position: fixed;
            top: 20px;
            width: 50%;
            text-align: center;
            z-index: 9999; /* Increased z-index to bring alert in front of the navbar */
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.5s ease-in-out;
        }


        .alert-success {
            background-color: #28a745; /* Green */
        }

        .alert-error {
            background-color: #dc3545; /* Red */
        }

        /* Animation for alert */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Optional: smooth transition for the alert disappearing */
        .alert.hide {
            opacity: 0;
            transition: opacity 0.5s ease-out;
            visibility: hidden;
        }


        /* Mobile-specific styling */
        @media (max-width: 768px) {
            .alert {
                position: fixed; /* Position it fixed at the top */
                top: 0;
                left: 0;
                right: 0;
                width: 100%; /* Alert takes full width */
                margin: 0; /* Remove margin */
                padding: 15px;
                font-size: 16px;
                z-index: 9999; /* Ensure it stays on top */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            /* Adjust container to give space for the alert at the top */
            .container {
                margin-top: 60px; /* Add space to the top for alert */
            }
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
                width: 90%; /* Adjust container width for smaller screens */
                max-width: 90%; /* Limit the max width */
                margin: 20px auto; /* Center the container with margin */
            }

            .content {
                margin-top: 200px;
                padding: 15px;
                margin-bottom: 80px; /* Space for bottom navbar */
            }

            h1 {
                font-size: 2.5em;
            }

            p {
                font-size: 1.2em;
            }
        }

        /* Validation message styles */
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: -5px;
            margin-bottom: 5px;
            text-align: left;
            display: none;
        }

        .password-strength {
            font-size: 12px;
            margin-top: -5px;
            margin-bottom: 5px;
            text-align: left;
        }

        .weak {
            color: red;
        }

        .medium {
            color: orange;
        }

        .strong {
            color: green;
        }

        input.invalid {
            border-color: red;
        }

        input.valid {
            border-color: green;
        }
    </style>
</head>
<body>
   
    <!-- Success and error alerts -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-error">
        {{ $errors->first() }}
    </div>
    @endif

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
                <a href="#" class="nav-icon"><i class="fas fa-users"></i></a>
                <span>About us</span>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-icon"><i class="fas fa-comments"></i></a>
                <span>Feedback</span>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-icon"><i class="fas fa-ice-cream"></i></a>
                <span>Flavors</span>
            </div>
            <div class="nav-item">
                <a href="{{ route('customer.login') }}" class="nav-icon"><i class="fas fa-sign-in-alt"></i></a>
                <span>Sign In</span>
            </div>
        </div>
    </nav>
 
    <div class="container">
        <h2>Register</h2>
    
        <form method="POST" action="{{ route('customer.register') }}" onsubmit="return validateForm()">
            @csrf
            <fieldset>
                <legend>Personal Information</legend>
                <div class="input-container">
                    <input type="text" id="firstname" name="firstname" class="input-field" placeholder="First Name" value="{{ old('firstname') }}" required maxlength="16">
                    <div id="firstnameError" class="error-message"></div>
                    
                    <input type="text" id="lastname" name="lastname" class="input-field" placeholder="Last Name" value="{{ old('lastname') }}" required maxlength="16">
                    <div id="lastnameError" class="error-message"></div>
    
                    {{-- Gender Dropdown --}}
                    <select name="gender" class="input-field" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select><br>
                </div>
                
                <input type="text" id="username" name="username" class="input-field" placeholder="Username" value="{{ old('username') }}" required maxlength="16">
                <div id="usernameError" class="error-message"></div>
    
                <div class="input-container">
                    <input type="email" id="email" name="email" class="email-input" placeholder="Email" value="{{ old('email') }}" required maxlength="30">
                    <div id="emailError" class="error-message"></div>
                </div>
    
                <input type="text" id="phone" name="phone" class="input-field" placeholder="Phone Number" value="{{ old('phone') }}" required maxlength="11">
                <div id="phoneError" class="error-message"></div>
            </fieldset>
    
            <fieldset>
                <legend>Account Security</legend>
                <input type="password" id="password" name="password" class="input-field" placeholder="Password" required>
                <div id="passwordError" class="error-message"></div>
                <input type="password" id="confirm_password" name="confirm_password" class="input-field" placeholder="Confirm Password" required>
                <div id="passwordStrength" class="password-strength"></div>
            </fieldset>
    
            <button type="submit" class="btn">Register</button>
        </form>
    
        <p class="login-link">Already have an account? <a href="/customer/login">Login here</a></p>
    </div>
    

    <script>
        // Hide the alert after 5 seconds
        setTimeout(function() {
            var alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.add('hide');
            }
        }, 5000); // 5000ms = 5 seconds

        // Validation functions
        function validateForm() {
            let isValid = true;
            
// Validate firstname
const firstname = document.getElementById('firstname').value;
const firstnameError = document.getElementById('firstnameError');

// Check if field is empty
if (firstname === '') {
    firstnameError.textContent = 'First name is required';
    firstnameError.style.display = 'block';
    document.getElementById('firstname').classList.add('invalid');
    isValid = false;
} 
// Check if starts with whitespace
else if (/^\s/.test(firstname)) {
    firstnameError.textContent = 'First name cannot start with whitespace';
    firstnameError.style.display = 'block';
    document.getElementById('firstname').classList.add('invalid');
    isValid = false;
} 
// Check if contains only letters and spaces (but not at start)
else if (!/^[a-zA-Z][a-zA-Z\s]*$/.test(firstname)) {
    firstnameError.textContent = 'First name can only contain letters and spaces (not at start)';
    firstnameError.style.display = 'block';
    document.getElementById('firstname').classList.add('invalid');
    isValid = false;
} 
// Check length
else if (firstname.length > 16) {
    firstnameError.textContent = 'First name cannot exceed 16 characters';
    firstnameError.style.display = 'block';
    document.getElementById('firstname').classList.add('invalid');
    isValid = false;
} 
else {
    firstnameError.style.display = 'none';
    document.getElementById('firstname').classList.remove('invalid');
}

            // Validate lastname
            const lastname = document.getElementById('lastname').value.trim();
            const lastnameError = document.getElementById('lastnameError');
            if (lastname === '') {
                lastnameError.textContent = 'Last name is required';
                lastnameError.style.display = 'block';
                document.getElementById('lastname').classList.add('invalid');
                isValid = false;
            } else if (/^\s/.test(lastname)) {
                lastnameError.textContent = 'Last name cannot start with whitespace';
                lastnameError.style.display = 'block';
                document.getElementById('lastname').classList.add('invalid');
                isValid = false;
            } else if (!/^[a-zA-Z]+$/.test(lastname)) {
                lastnameError.textContent = 'Last name can only contain letters';
                lastnameError.style.display = 'block';
                document.getElementById('lastname').classList.add('invalid');
                isValid = false;
            } else {
                lastnameError.style.display = 'none';
                document.getElementById('lastname').classList.remove('invalid');
            }

            // Validate username
            const username = document.getElementById('username').value.trim();
            const usernameError = document.getElementById('usernameError');
            if (username === '') {
                usernameError.textContent = 'Username is required';
                usernameError.style.display = 'block';
                document.getElementById('username').classList.add('invalid');
                isValid = false;
            } else if (/^\s/.test(username)) {
                usernameError.textContent = 'Username cannot start with whitespace';
                usernameError.style.display = 'block';
                document.getElementById('username').classList.add('invalid');
                isValid = false;
            } else {
                usernameError.style.display = 'none';
                document.getElementById('username').classList.remove('invalid');
            }

            // Validate email
            const email = document.getElementById('email').value.trim();
            const emailError = document.getElementById('emailError');
            const emailPattern = /^[^\s@]+@(yahoo\.com|gmail\.com|hotmail\.com|outlook\.com|icloud\.com|protonmail\.com|aol\.com|mail\.com|zoho\.com|yandex\.com)$/i;
            
            if (email === '') {
                emailError.textContent = 'Email is required';
                emailError.style.display = 'block';
                document.getElementById('email').classList.add('invalid');
                isValid = false;
            } else if (/^\s/.test(email)) {
                emailError.textContent = 'Email cannot start with whitespace';
                emailError.style.display = 'block';
                document.getElementById('email').classList.add('invalid');
                isValid = false;
            } else if (!emailPattern.test(email)) {
                emailError.textContent = 'Please enter a valid email address from supported providers';
                emailError.style.display = 'block';
                document.getElementById('email').classList.add('invalid');
                isValid = false;
            } else {
                emailError.style.display = 'none';
                document.getElementById('email').classList.remove('invalid');
            }

            // Validate phone
            const phone = document.getElementById('phone').value.trim();
            const phoneError = document.getElementById('phoneError');
            if (phone === '') {
                phoneError.textContent = 'Phone number is required';
                phoneError.style.display = 'block';
                document.getElementById('phone').classList.add('invalid');
                isValid = false;
            } else if (/^\s/.test(phone)) {
                phoneError.textContent = 'Phone number cannot start with whitespace';
                phoneError.style.display = 'block';
                document.getElementById('phone').classList.add('invalid');
                isValid = false;
            } else if (!/^\d+$/.test(phone)) {
                phoneError.textContent = 'Phone number can only contain digits';
                phoneError.style.display = 'block';
                document.getElementById('phone').classList.add('invalid');
                isValid = false;
            } else if (phone.length !== 11) {
                phoneError.textContent = 'Phone number must be exactly 11 digits';
                phoneError.style.display = 'block';
                document.getElementById('phone').classList.add('invalid');
                isValid = false;
            } else {
                phoneError.style.display = 'none';
                document.getElementById('phone').classList.remove('invalid');
            }

            // Validate password
            const password = document.getElementById('password').value.trim();
            const passwordError = document.getElementById('passwordError');
            if (password === '') {
                passwordError.textContent = 'Password is required';
                passwordError.style.display = 'block';
                document.getElementById('password').classList.add('invalid');
                isValid = false;
            } else if (/^\s/.test(password)) {
                passwordError.textContent = 'Password cannot start with whitespace';
                passwordError.style.display = 'block';
                document.getElementById('password').classList.add('invalid');
                isValid = false;
            } else if (password.length < 8) {
                passwordError.textContent = 'Password must be at least 8 characters';
                passwordError.style.display = 'block';
                document.getElementById('password').classList.add('invalid');
                isValid = false;
            } else {
                passwordError.style.display = 'none';
                document.getElementById('password').classList.remove('invalid');
            }

            // Validate confirm password
            const confirmPassword = document.getElementById('confirm_password').value.trim();
            if (confirmPassword === '') {
                passwordError.textContent = 'Please confirm your password';
                passwordError.style.display = 'block';
                document.getElementById('confirm_password').classList.add('invalid');
                isValid = false;
            } else if (password !== confirmPassword) {
                passwordError.textContent = 'Passwords do not match';
                passwordError.style.display = 'block';
                document.getElementById('confirm_password').classList.add('invalid');
                isValid = false;
            } else {
                document.getElementById('confirm_password').classList.remove('invalid');
            }

            return isValid;
        }

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthText = document.getElementById('passwordStrength');
            
            // Reset
            strengthText.textContent = '';
            strengthText.className = 'password-strength';
            
            if (password.length === 0) return;
            
            // Check strength
            let strength = 0;
            
            // Length
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            
            // Contains numbers
            if (/\d/.test(password)) strength++;
            
            // Contains uppercase
            if (/[A-Z]/.test(password)) strength++;
            
            // Contains special chars
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // Display result
            if (strength <= 2) {
                strengthText.textContent = 'Weak password (include at least 1 uppercase letter, 1 number, and 1 special character)';
                strengthText.className = 'password-strength weak';
            } else if (strength <= 4) {
                strengthText.textContent = 'Medium password (could be stronger)';
                strengthText.className = 'password-strength medium';
            } else {
                strengthText.textContent = 'Strong password';
                strengthText.className = 'password-strength strong';
            }
        });

        // Real-time validation for firstname and lastname (letters only)
   document.getElementById('firstname').addEventListener('input', function(e) {
    // Prevent whitespace at the beginning
    if (this.value.length === 1 && this.value === ' ') {
        this.value = '';
        return;
    }
    
    // Allow only letters and spaces (but not consecutive spaces)
    this.value = this.value.replace(/[^a-zA-Z\s]/g, '')
                          .replace(/\s{2,}/g, ' ');
    
    // Trim to 16 characters
    if (this.value.length > 16) {
        this.value = this.value.substring(0, 16);
    }
});

        document.getElementById('lastname').addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z]/g, '');
        });

        // Real-time validation for phone (numbers only)
        document.getElementById('phone').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });

        // Prevent whitespace at the beginning for all fields
        const fields = ['firstname', 'lastname', 'username', 'email', 'phone', 'password', 'confirm_password'];
        fields.forEach(field => {
            document.getElementById(field).addEventListener('keydown', function(e) {
                if (this.value === '' && e.key === ' ') {
                    e.preventDefault();
                }
            });
        });
    </script>
    
</body>
</html>