//  <div class="position-relative auth-pass-inputgroup input-custom-icon">
//      <span class="bx bx-lock-alt"></span>
//      <input type="password" name="password" id="password"
//          class="form-control" placeholder="Enter password"
//          autocomplete="current-password" required>

//      <button type="button"
//          class="btn btn-link position-absolute h-100 end-0 top-0"
//          id="password-addon">
//          <i class="mdi mdi-eye-outline font-size-18 text-muted"
//              id="toggle-password-icon"></i>
//      </button>
//  </div>

export function loginPasswordPage() {
    // this is for password see or not see in login page backend
    document.addEventListener("DOMContentLoaded", function () {
        const passwordInput = document.getElementById("password");
        const toggleButton = document.getElementById("password-addon");
        const toggleIcon = document.getElementById("toggle-password-icon");

        if (passwordInput && toggleButton && toggleIcon) {
            toggleButton.addEventListener("click", function () {
                const isPassword = passwordInput.type === "password";
                console.log("Before toggle:", passwordInput.type); // DEBUG
                passwordInput.type = isPassword ? "text" : "password";
                console.log("After toggle:", passwordInput.type); // DEBUG

                toggleIcon.classList.toggle("mdi-eye-outline", !isPassword);
                toggleIcon.classList.toggle("mdi-eye-off-outline", isPassword);
            });
        }
    });
}
