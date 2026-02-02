<section class="container my-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-5">
            <!-- Header -->
            <div class="mb-4 text-center">
                <h2 class="card-title fw-bold">{{ __('Update Password') }}</h2>
                <p class="card-text text-muted">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
            </div>

            <!-- Update Password Form -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <!-- Current Password -->
                <div class="mb-3">
                    <label for="update_password_current_password"
                        class="form-label fw-semibold">{{ __('Current Password') }}</label>
                    <input type="password" id="update_password_current_password" name="current_password"
                        class="form-control" autocomplete="current-password">
                    <div class="text-danger small mt-1">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" />
                    </div>
                </div>

                <!-- New Password -->
                <div class="mb-3">
                    <label for="update_password_password"
                        class="form-label fw-semibold">{{ __('New Password') }}</label>
                    <input type="password" id="update_password_password" name="password" class="form-control"
                        autocomplete="new-password">
                    <div class="text-danger small mt-1">
                        <x-input-error :messages="$errors->updatePassword->get('password')" />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="update_password_password_confirmation"
                        class="form-label fw-semibold">{{ __('Confirm Password') }}</label>
                    <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                        class="form-control" autocomplete="new-password">
                    <div class="text-danger small mt-1">
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
                    </div>
                </div>

                <!-- Save Button & Status -->
                <div class="d-flex align-items-center justify-content-between">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">{{ __('Save') }}</button>

                    @if (session('status') === 'password-updated')
                        <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-success small">{{ __('Saved.') }}</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>
