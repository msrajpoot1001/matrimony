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

                                <!-- Heading -->
                                <div class="text-center mt-2">
                                    <h5>Reset Your Password</h5>
                                    <p class="text-muted">
                                        Enter your new password and confirm it to reset your account.
                                    </p>
                                </div>

                                <!-- Form -->
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('password.store') }}">
                                        @csrf

                                        <!-- Hidden Token -->
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ old('email', $request->email) }}" required autofocus
                                                    autocomplete="username">
                                                <span class="bx bx-envelope"></span>
                                            </div>
                                            @error('email')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- New Password -->
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                <span class="bx bx-lock-alt"></span>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" required autocomplete="new-password">
                                            </div>
                                            @error('password')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mb-3">
                                            <label class="form-label" for="password_confirmation">Confirm
                                                Password</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" class="form-control" required
                                                    autocomplete="new-password">
                                                <span class="bx bx-lock"></span>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit -->
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">
                                                Reset Password
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
