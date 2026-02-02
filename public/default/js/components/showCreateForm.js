//  <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst('Blog') }}</button>
export function showCreateForm() {
    function hideDiv() {
        const el = document.getElementById("targetDiv");
        if (el) el.style.display = "none";
    }

    document.addEventListener("DOMContentLoaded", function () {
        if (window.validationErrors && window.validationErrors.length > 0) {
            const toggleBtn = document.getElementById("toggleButton");
            if (toggleBtn) {
                toggleBtn.click();
            }
        }
    });
}
