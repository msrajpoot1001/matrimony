<x-guest-layout>
    <div class="authentication-bg min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <!-- Logo -->
                        <div class="mb-4 pb-2 text-center">
                            <a href="{{ url('/') }}" class="d-block auth-logo">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo" height="30"
                                    class="auth-logo-light mx-auto" />
                            </a>
                        </div>

                        <!-- Card -->
                        <div class="card">
                            <div class="card-body p-4">

                                
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" id="targetDiv"
                                        role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" onclick="hideDiv()"
                                            data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <!-- Page Heading -->
                                <div class="text-center mt-2">
                                    <h5>Forgot Your Password?</h5>
                                    <p class="text-muted">
                                        No problem. Enter your email address and we will send you a link
                                        to reset your password.
                                    </p>
                                </div>

                                <!-- Form -->
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Enter your email" value="{{ old('email') }}" required
                                                    autofocus>
                                                <span class="bx bx-envelope"></span>
                                            </div>
                                            @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit -->
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">
                                                Send Password Reset Link
                                            </button>
                                        </div>

                                    </form>

                                    <!-- Back to Login -->
                                    <div class="mt-4 text-center">
                                        <p class="mb-0">
                                            Remember your password?
                                            <a href="{{ route('login') }}" class="fw-medium text-primary">Login</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End Card -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
