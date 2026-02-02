    @php
        $user = Auth()->user();

    @endphp

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="PK Managing Solutions" name="description" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- to include favicon  --}}
        @include('components.favicon')


        <!-- include head css -->
        @include('dashboard.partials.head-css')

        @yield('style');
        @stack('style')
        <style>
            .page-content {
                padding-top: 4rem;
            }

            @media (max-width: 500px) {
                .page-content {
                    padding: 0 !important;
                    padding-top: 2.5rem !important;
                }

                .container-fluid {
                    padding-left: 0px !important;
                    padding-right: 0px !important;
                }
            }
        </style>
    </head>


    <body>

        <div id="layout-wrapper">

            @include('dashboard.partials.header')


            @include('dashboard.partials.sidebar')

            <!-- Start right Content here -->

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid ">
                        @include('components.success-modal')
                        @yield('content')
                        @stack('content')
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                @include('dashboard.partials.footer')

            </div>
            <!-- end main content-->
        </div>

        <!-- vendor-scripts -->
        @include('dashboard.partials.vendor-scripts')
        @yield('script')
        @stack('script')

    </body>

    </html>
