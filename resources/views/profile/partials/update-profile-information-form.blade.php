<section class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
        <div class="mb-4 text-center">
            <h2 class="h4 fw-bold">{{ __('Profile Information') }}</h2>
            <p class="text-muted small">{{ __("Update your account's profile information and email address.") }}</p>
        </div>

        <!-- Email Verification Form -->
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <!-- Profile Update Form -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">{{ __('Name') }}</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                    autofocus autocomplete="name" class="form-control">
                <div class="text-danger small mt-1">
                    <x-input-error :messages="$errors->get('name')" />
                </div>
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                    autocomplete="username" class="form-control">
                <div class="text-danger small mt-1">
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2 p-3 bg-warning bg-opacity-10 border-start border-warning rounded">
                        <p class="text-warning mb-1 small">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification"
                                class="btn btn-link p-0 m-0 align-baseline text-warning text-decoration-underline">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-1 text-success small">
                                {{ __('A new verification link has been sent to your email address.') }}</p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Save Button & Status -->
            <div class="d-flex align-items-center justify-content-between mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">{{ __('Save') }}</button>

                @if (session('status') === 'profile-updated')
                    <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-success small">{{ __('Saved.') }}</span>
                @endif
            </div>
        </form>
    </div>
</section>
