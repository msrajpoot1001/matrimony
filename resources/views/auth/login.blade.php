@php
    $company = DB::table('company_infos')->first();
@endphp

@extends('website.layouts.app')

{{-- title for this page  --}}
@section('title')
    Login
@endsection

{{-- meta description  --}}
@section('meta_description')
    This is the description for this page.
@endsection

{{-- meta keywords --}}
@section('meta_keywords')
    keyword1, keyword2, keyword3
@endsection


{{-- custom csss  --}}
@section('style')
    <style>
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: #f5f5f5;
        }

        .auth-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .auth-left {
            background: linear-gradient(180deg, var(--orange-color), var(--green-color));
            color: #fff;
            padding: 60px 40px;
            text-align: center;
            height: 100%;
        }

        .auth-left h3 {
            font-weight: 700;
            margin-top: 20px;
        }

        .auth-left p {
            font-size: 14px;
            opacity: 0.9;
        }

        .auth-icon {
            width: 150px;
            height: 150px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .auth-right {
            padding: 50px;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid var(--orange-color);
        }

        .btn-login {
            background: var(--orange-color) !important;
            color: black;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 6px;
        }

        .btn-login:hover {
            opacity: 0.9;
        }

        .link-pink {
            color: var(--orange-color);
            font-size: 14px;
        }
    </style>
@endsection

{{-- custom script for this page --}}
@section('script')
    <script></script>
@endsection

@section('content')
    <div class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="auth-card row g-0">

                        {{-- LEFT PANEL --}}
                        <div class="col-md-5 d-none d-md-block">
                            <div class="auth-left">
                                <div class="auth-icon">
                                    {{-- <p>{{$company->logo}}</p> --}}
                                    <img src="{{ asset($company->logo) }}" style="height: 100%">
                                </div>
                                <h3 class="text-white">Login</h3>
                                <p>
                                    User can login with matrimony ID, email ID or registered mobile no.
                                    Once browse profiles make sure to logout
                                </p>
                            </div>
                        </div>

                        {{-- RIGHT PANEL --}}
                        <div class="col-md-7">
                            <div class="auth-right">

                                <h2 class="fw-bold">Secure Login</h2>
                                <p class="text-muted mb-4">Existing Member? Login</p>

                                {{-- Alerts --}}
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    {{-- Email / Mobile --}}
                                    <div class="mb-3">
                                        <label class="form-label text-pink">
                                            Email ID / Username / Mobile No.
                                        </label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ old('email') }}" placeholder="Enter here" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter here"
                                            required>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>





                                    {{-- Button --}}
                                    <button type="submit" class="btn btn-login w-100 text-white">
                                        Login
                                    </button>

                                </form>

                                <p class="text-center mt-4">
                                    New Candidate Register ?
                                    <a href="{{ route('register') }}" class="link-pink fw-bold">
                                        SignUp
                                    </a>
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
