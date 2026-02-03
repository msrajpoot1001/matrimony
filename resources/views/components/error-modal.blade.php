    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var errorModal = new bootstrap.Modal(
                    document.getElementById('validationErrorModal')
                );
                errorModal.show();
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="modal fade" id="validationErrorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            ❌ Please do this error
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item text-danger">
                                    • {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif
