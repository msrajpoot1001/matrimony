export function mangeImageInForm() {
    // to mange image for delete
    //  Image Preview on File Select
    document.addEventListener("DOMContentLoaded", function () {
        document
            .querySelectorAll(".preview-image-input")
            .forEach(function (input) {
                const inputName = input.name;
                const previewId = input.dataset.previewId;
                const preview = document.getElementById(previewId);
                const statusInput = document.querySelector(
                    `input[name="status_${inputName}"]`
                );
                const deleteBtn = document.getElementById(
                    `statusPhotoBtn_${inputName}`
                );

                if (!preview) return;

                // On file change: show preview and set status to 1
                input.addEventListener("change", function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            preview.src = e.target.result;
                            preview.style.display = "block";
                            if (deleteBtn)
                                deleteBtn.style.display = "inline-block";
                            if (statusInput) statusInput.value = 1;
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // On delete button click: hide preview, reset file input, set status to 0
                if (deleteBtn) {
                    deleteBtn.addEventListener("click", function () {
                        preview.src = "";
                        preview.style.display = "none";
                        input.value = ""; // clear file input
                        if (statusInput) statusInput.value = 0;
                        deleteBtn.style.display = "none";
                    });
                }
            });
    });

    // delet button click logic

    document.addEventListener("DOMContentLoaded", function () {
        document
            .querySelectorAll("button[id^='statusPhotoBtn_']")
            .forEach(function (btn) {
                btn.addEventListener("click", function () {
                    const name = this.id.replace("statusPhotoBtn_", "");

                    const statusInput = document.getElementById(
                        `status_${name}`
                    );
                    if (statusInput) {
                        statusInput.value = "0";
                    }

                    const imagePreview = document.getElementById(
                        `photo_preview_${name}`
                    );
                    if (imagePreview) {
                        imagePreview.src = "";
                        imagePreview.style.display = "none";
                    }

                    const fileInput = document.querySelector(
                        `input[name="${name}"]`
                    );
                    if (fileInput) {
                        fileInput.value = "";
                    }

                    this.style.display = "none";
                });
            });
    });

    // hide button if no image exits
    document.addEventListener("DOMContentLoaded", function () {
        document
            .querySelectorAll("img[id^='photo_preview_']")
            .forEach(function (img) {
                const name = img.id.replace("photo_preview_", "");
                const deleteBtn = document.getElementById(
                    `statusPhotoBtn_${name}`
                );

                if (!deleteBtn) return;

                function checkImage() {
                    if (img.complete && img.naturalWidth > 0) {
                        deleteBtn.style.display = "inline-block";
                    } else {
                        deleteBtn.style.display = "none";
                    }
                }

                if (img.complete) {
                    checkImage();
                } else {
                    img.onload = checkImage;
                    img.onerror = checkImage;
                }
            });
    });
}