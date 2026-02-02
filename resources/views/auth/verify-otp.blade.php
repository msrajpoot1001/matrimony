<x-guest-layout>
    <div class="authentication-bg min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="mb-4 pb-2 text-center">
                            <a href="{{ url('/') }}" class="d-block auth-logo">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo" height="30"
                                    class="auth-logo-light" />
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body p-4">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="text-center mt-2">
                                    <h5>Enter OTP</h5>
                                    <p class="text-muted">Please enter the OTP sent to your email to verify your device.
                                    </p>
                                </div>

                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('verify.otp.post') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="otp" class="form-label">OTP</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="text" name="otp" id="otp" class="form-control"
                                                    placeholder="Enter OTP" required>
                                                <span class="bx bx-key"></span>
                                            </div>
                                            @error('otp')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">
                                                Verify OTP
                                            </button>
                                        </div>
                                    </form>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Didn't receive OTP?
                                            <a href="{{ route('send.otp.index') }}"
                                                class="fw-medium text-primary">Resend OTP</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end container -->
    </div>
</x-guest-layout>
