<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .email-header {
            background-color: #4c1f84;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .email-body {
            padding: 30px 20px;
        }

        .email-body h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .email-body .info {
            background-color: #f0f8ff;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .email-footer a {
            color: #6de5f2;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Tax Pal Solutions</h2>
        </div>
        <div class="email-body">
            <h1>Hello {{ $contact->name }},</h1>
            <p>Thank you for contacting us. We have successfully received your message. Here are the details:</p>

            <div class="info">
                <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                <p><strong>Website:</strong> {{ $contact->website ?? 'N/A' }}</p>
                <p><strong>Message:</strong> {{ $contact->message }}</p>
            </div>

            <p>Our team will get back to you as soon as possible. Meanwhile, feel free to browse our <a
                    href="{{ url('/') }}">website</a> for more information.</p>

            <p>Thanks,<br>Tax Pal Solutions Team</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Tax Pal Solutions. All rights reserved.
        </div>
    </div>
</body>

</html>
