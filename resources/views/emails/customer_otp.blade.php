<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden;">
        <!-- Header with Logo -->
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #007bff;">
                <img src="https://img.icons8.com/external-flatart-icons-flat-flatarticons/100/ffffff/external-ice-cream-summer-flatart-icons-flat-flatarticons.png" alt="Ice Cream Logo" style="width: 80px; margin-bottom: 10px;">
                <h1 style="color: #ffffff; font-size: 24px; margin: 0;">Verify Your Email</h1>
            </td>
        </tr>
        
        <!-- OTP Body -->
        <tr>
            <td style="padding: 30px; color: #333333;">
                <p style="font-size: 16px;">Hi {{ $customer->firstname ?? 'Customer' }},</p>
                <p style="font-size: 16px;">Thank you for signing up! Please use the following One-Time Password (OTP) to verify your email address:</p>
                
                <p style="font-size: 32px; font-weight: bold; color: #007bff; text-align: center; margin: 30px 0;">{{ $otp }}</p>

                <p style="font-size: 14px; color: #555;">This OTP is valid for <strong>5 minutes</strong>. If you did not request this code, you can safely ignore this email.</p>
                <p style="font-size: 14px; color: #555;">Please <strong>do not share this code</strong> with anyone for security reasons.</p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #f4f4f4; font-size: 12px; color: #999;">
                Need help? Contact us at <a href="mailto:kylereganion187@gmail.com" style="color: #007bff;">kylereganion187@gmail.com</a><br>
                &copy; {{ date('Y') }} Ice Cream Delight. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
