<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ================= TITLE ================= --}}
    @if (!empty($global_seo?->title))
        <title>{{ $global_seo->title }}</title>
    @elseif (trim($__env->yieldContent('title')))
        <title>@yield('title')</title>
    @else
        <title>Tax Pal Solutions | Expert Tax Services</title>
    @endif


    {{-- ============== META DESCRIPTION ============== --}}
    @if (!empty($global_seo?->description))
        <meta name="description" content="{{ $global_seo->description }}" />
    @elseif (trim($__env->yieldContent('meta_description')))
        <meta name="description" content="@yield('meta_description')" />
    @else
        <meta name="description" content="Default meta description for Tax Pal Solutions." />
    @endif


    {{-- ============== META KEYWORDS ============== --}}
    @if (!empty($global_seo?->keywords))
        <meta name="keywords" content="{{ $global_seo->keywords }}" />
    @elseif (trim($__env->yieldContent('meta_keywords')))
        <meta name="keywords" content="@yield('meta_keywords')" />
    @else
        <meta name="keywords" content="tax, solutions, accounting, finance" />
    @endif



    {{-- to include favicon  --}}
    @include('components.favicon')

    {{-- Page-specific CSS --}}
    @yield('style')
    @stack('style')

    {{-- Global Head CSS --}}
    @include('website.partials.head-css')
</head>

<body>
    <div>
        {{-- Top Header --}}
        @include('website.partials.header')


        @stack('content')
        @yield('content')

        {{-- Footer --}}
        @include('website.partials.footer')
    </div>

    {{-- Global Vendor Scripts --}}
    @include('website.partials.vendor-scripts')

    {{-- Page-specific Scripts --}}
    @yield('script')
    @stack('script')
</body>

</html>
