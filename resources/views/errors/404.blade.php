<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $extension = '';

        if (!empty($company->favicon)) {
            $extension = pathinfo($company->favicon, PATHINFO_EXTENSION);
        }

        $faviconPath = $company->favicon ?? 'default/image/favicon/default_favicon.ico';
    @endphp


    @if (!empty($company->favicon))
        @switch($extension)
            @case('svg')
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/svg+xml">
            @break

            @case('png')
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/png">
            @break

            @default
                <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
        @endswitch
    @else
        <link rel="icon" href="{{ asset($faviconPath) }}" type="image/x-icon">
    @endif
    <title>404 – Page Not Found</title>
    <style>
        .navbar.validnavs.navbar-default .navbar-nav li a {
            color: black !important;
        }

        .mainDiv {
            margin-top: 150px;
            margin-bottom: 100px;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .bg-gray-50 {
            background-color: #f9fafb;
        }

        .text-center {
            text-align: center;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .text-7xl {
            font-size: 4.5rem;
            line-height: 1;
        }

        .font-bold {
            font-weight: 700;
        }

        .text-indigo-600 {
            color: #4f46e5;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .text-2xl {
            font-size: 1.5rem;
            line-height: 2rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .inline-block {
            display: inline-block;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .bg-indigo-600 {
            background-color: #4f46e5;
        }

        .text-white {
            color: #ffffff;
        }

        .hover\:bg-indigo-700:hover {
            background-color: #4338ca;
        }

        .transition {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center bg-gray-50 mainDiv">
        <div class="text-center px-6">
            <h1 class="text-7xl font-bold text-indigo-600 mb-4">404</h1>
            <h2 class="text-2xl font-semibold mb-2">Page Not Found</h2>
            <p class="mb-6 text-gray-600">
                Oops! The page you were looking for doesn’t exist or has been moved.
            </p>
            <a href="/"
                class="inline-block px-6 py-3 text-sm font-medium rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                Go Home
            </a>
        </div>
    </div>
</body>

</html>
