   {{-- ✅ Success Modal (opens only if success exists) --}}
   @if (session('success'))
       @push('content')
           <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                   <div class="modal-content">

                       <div class="modal-header text-white" style="background-color: #f69a25;color:white">
                           <h5 class="modal-title" id="successModalLabel" style="color:white">Success 🎉</h5>
                           <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                               aria-label="Close"></button>
                       </div>

                       <div class="modal-body">
                           {{ session('success') }}
                       </div>

                       <div class="modal-footer">
                           <button type="button" class="btn " data-bs-dismiss="modal"
                               style="background-color: #f69a25;color:white">Close</button>
                       </div>

                   </div>
               </div>
           </div>
       @endpush

       <!-- ✅ Auto open only on success -->
       @push('script')
           <script>
               document.addEventListener("DOMContentLoaded", function() {
                   const modal = new bootstrap.Modal(document.getElementById('successModal'));
                   modal.show();
               });
           </script>
       @endpush
   @endif
