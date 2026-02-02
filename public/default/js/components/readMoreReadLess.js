// this para1 and para1 is dynamic 
{/* <div class="info">
    <p class="para para1" data-lines="3">
        description
    </p>
    <div class="button">
        <a
            href="#"
            class="toggle-btn-read-more"
            data-target="para1"
            role="button"
        >
            Read More
        </a>
    </div>
</div> */}

export function readMoreReadLess() {
    // to set read and read more frontend
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-btn-read-more").forEach((button) => {
            const targetClass = button.getAttribute("data-target");
            const para = document.querySelector("." + targetClass);
            const lines = parseInt(para.getAttribute("data-lines")) || 3;

            // Set initial styles
            para.style.display = "-webkit-box";
            para.style.webkitBoxOrient = "vertical";
            para.style.overflow = "hidden";
            para.style.webkitLineClamp = lines;

            // Check if "Read More" is needed
            const fullHeightCheck = () => {
                para.style.webkitLineClamp = "unset";
                const fullHeight = para.getBoundingClientRect().height;
                para.style.webkitLineClamp = lines;
                const limitedHeight = para.getBoundingClientRect().height;
                return fullHeight > limitedHeight + 1;
            };

            if (!fullHeightCheck()) {
                button.style.display = "none";
            }

            // Toggle expand/collapse
            button.addEventListener("click", function (e) {
                e.preventDefault();
                const isExpanded = para.classList.toggle("expanded");
                if (isExpanded) {
                    para.style.webkitLineClamp = "unset";
                    button.textContent = "Read Less";
                } else {
                    para.style.webkitLineClamp = lines;
                    button.textContent = "Read More";
                }
            });
        });
    });
}
