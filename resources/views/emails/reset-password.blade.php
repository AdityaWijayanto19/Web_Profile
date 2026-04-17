<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #880808 0%, #ca0000 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
        }

        .content h2 {
            color: #880808;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .content p {
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.8;
        }

        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .reset-button {
            display: inline-block;
            padding: 14px 40px;
            background-color: #880808;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .reset-button:hover {
            background-color: #ca0000;
        }

        .alert {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 5px;
            padding: 12px 15px;
            margin: 20px 0;
            font-size: 13px;
            color: #856404;
        }

        .link-section {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            font-size: 12px;
            word-break: break-all;
        }

        .link-section p {
            margin-bottom: 8px;
            color: #666;
        }

        .link-section a {
            color: #880808;
            text-decoration: none;
            font-weight: 600;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            color: #666;
            text-align: center;
        }

        .footer p {
            margin-bottom: 10px;
        }

        .divider {
            height: 1px;
            background-color: #dee2e6;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Password Reset Request</h1>
            <p>Web Profile Admin Portal</p>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Hello,</h2>

            <p>
                We received a request to reset your password for your Web Profile Admin account.
                If you didn't make this request, you can safely ignore this email.
            </p>

            <div class="alert">
                <strong>Important:</strong> This reset link will expire in <strong>{{ $expiresIn }} minutes</strong>
            </div>

            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">Reset Your Password</a>
            </div>

            <p style="text-align: center; color: #999; font-size: 12px;">
                or copy and paste this link in your browser:
            </p>

            <div class="link-section">
                <p><strong>Reset Link:</strong></p>
                <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
            </div>

            <div class="divider"></div>

            <p>
                <strong>What happens next?</strong>
            </p>
            <p>
                1. Click the "Reset Your Password" button above<br>
                2. Enter your new password<br>
                3. Confirm your new password<br>
                4. You'll be directed to login with your new password
            </p>

            <p>
                If you have any questions or didn't request this reset,
                please contact the administrator immediately.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                <strong>Web Profile Admin Portal</strong><br>
                © {{ date('Y') }} All rights reserved.
            </p>
            <p style="margin-top: 15px; font-size: 11px; color: #999;">
                This is an automated email. Please do not reply directly to this message.
            </p>
        </div>
    </div>
</body>
</html>
