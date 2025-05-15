<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .otp-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .otp-input {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .otp-input input {
            width: 40px;
            height: 50px;
            font-size: 20px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .otp-input input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<div class="otp-container">
    <h2>Verify Your Email</h2>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <p class="error">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('customer.otp.verify') }}" id="otpForm">
        @csrf
        <div class="otp-input">
            @for ($i = 1; $i <= 6; $i++)
                <input type="text" maxlength="1" name="otp[]" pattern="\d*" required>
            @endfor
        </div>
        <input type="hidden" name="otp_code" id="otp_code">
        <button type="submit">Verify</button>
    </form>

    <form method="POST" action="{{ route('customer.otp.resend') }}">
        @csrf
        <button type="submit">Resend OTP</button>
    </form>
</div>

<script>
    const inputs = document.querySelectorAll('.otp-input input');

    inputs.forEach((input, i) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && i < inputs.length - 1) {
                inputs[i + 1].focus();
            }
        });
    });

    document.getElementById('otpForm').addEventListener('submit', function (e) {
        const otp = Array.from(inputs).map(input => input.value).join('');
        document.getElementById('otp_code').value = otp;
    });
</script>

</body>
</html>
