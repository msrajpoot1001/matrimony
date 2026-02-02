<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
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
            font-size: 22px;
            margin-bottom: 15px;
            color: #4c1f84;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .email-body .info {
            background-color: #f0f8ff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 15px;
        }

        .email-body .info p {
            margin: 5px 0;
        }

        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .email-footer a {
            color: #4c1f84;
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
            <h1>New Contact Form Submission</h1>
            <p>A new contact form has been submitted. Details are as follows:</p>

            <div class="info">
                <p><strong>Name:</strong> {{ $contact->name }}</p>
                <p><strong>Email:</strong> {{ $contact->email ?? 'N/A' }}</p>
                <p><strong>Type:</strong> {{ $contact->type }}</p>
                <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                <p><strong>Website:</strong> {{ $contact->website ?? 'N/A' }}</p>
                <p><strong>Message:</strong> {{ $contact->message }}</p>
            </div>

            <p>Please follow up with the client as soon as possible.</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Tax Pal Solutions. All rights reserved.
        </div>
    </div>
</body>

</html>
