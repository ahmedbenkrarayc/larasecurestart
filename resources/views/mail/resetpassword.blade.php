<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f6f0ff;
            margin: 0;
            padding: 20px;
            color: #2c3e50;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(128,90,213,0.1);
            overflow: hidden;
            border: 1px solid #e6e0f3;
        }
        .email-header {
            background-color: #8a4fff;
            color: white;
            text-align: center;
            padding: 25px;
        }
        .email-body {
            padding: 35px;
        }
        .reset-button {
            display: block;
            width: 220px;
            margin: 25px auto;
            padding: 14px 22px;
            background-color: #7c3aed;
            color: white !important;
            text-decoration: none;
            text-align: center;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .reset-button:hover {
            background-color: #9333ea;
        }
        .footer {
            background-color: #f6f0ff;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #6b46c1;
        }
        .security-note {
            background-color: #f3e8ff;
            border-left: 5px solid #8a4fff;
            padding: 15px;
            margin-top: 25px;
            font-size: 14px;
            border-radius: 0 5px 5px 0;
        }
        ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Password Recovery</h1>
        </div>
        <div class="email-body">
            <p>Hello,</p>
            
            <p>A password reset for your account has been requested. If this wasn't you, please contact our support team immediately.</p>
            
            <a href="{{ $link }}" class="reset-button">Reset My Password</a>
            
            <p>The reset link is valid for 15 minutes. If you're experiencing issues, manually enter this link in your browser:</p>
            
            <p style="word-break: break-all; color: #4a5568;">{{ $link }}</p>
            
            <div class="security-note">
                <strong>Secure Your Account:</strong>
                <ul>
                    <li>Create a unique, strong password</li>
                    <li>Use a mix of characters and numbers</li>
                    <li>Avoid common password patterns</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>