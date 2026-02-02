<section class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="h4 fw-bold text-danger">{{ __('Delete Account') }}</h2>
            <p class="text-muted small">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </div>

        <!-- Delete Button -->
        <button type="button" class="btn btn-outline-danger rounded-pill px-4 py-2" data-bs-toggle="modal"
            data-bs-target="#confirmUserDeletionModal">
            {{ __('Delete Account') }}
        </button>
    </div>

    <!-- Confirm Deletion Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title text-danger fw-bold" id="confirmUserDeletionLabel">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="{{ __('Password') }}" required>
                            <div class="text-danger small mt-1">
                                <x-input-error :messages="$errors->userDeletion->get('password')" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
