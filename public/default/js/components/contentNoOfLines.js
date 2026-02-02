// this is for arrange number of lines

export function contentNoOfLines() {
    document.querySelectorAll(".clamp-1-lines").forEach((element) => {
        const computedStyle = getComputedStyle(element);
        const lineHeight = parseFloat(computedStyle.lineHeight);
        const lines = Math.round(element.scrollHeight / lineHeight);

        // Reset height first
        element.style.height = "auto";

        if (lines < 1) {
            element.classList.add("no-clamp");

            element.style.height = `$ {
                lineHeight * 1
            }

            px`; // Force exactly 2 lines height
        } else if (lines === 1) {
            element.classList.add("no-clamp");
            element.style.height = "auto"; // Exact 2 lines, no need for manual height
        } else {
            element.classList.remove("no-clamp");
            element.style.height = "auto"; // Let clamp handle it
        }
    });

    document.querySelectorAll(".clamp-2-lines").forEach((element) => {
        const computedStyle = getComputedStyle(element);
        const lineHeight = parseFloat(computedStyle.lineHeight);
        const lines = Math.round(element.scrollHeight / lineHeight);

        // Reset height first
        element.style.height = "auto";

        if (lines < 2) {
            element.classList.add("no-clamp");

            element.style.height = `$ {
                lineHeight * 2
            }

            px`; // Force exactly 2 lines height
        } else if (lines === 2) {
            element.classList.add("no-clamp");
            element.style.height = "auto"; // Exact 2 lines, no need for manual height
        } else {
            element.classList.remove("no-clamp");
            element.style.height = "auto"; // Let clamp handle it
        }
    });

    document.querySelectorAll(".clamp-3-lines").forEach((element) => {
        const computedStyle = getComputedStyle(element);
        const lineHeight = parseFloat(computedStyle.lineHeight);
        const lines = Math.round(element.scrollHeight / lineHeight);

        // Reset height first
        element.style.height = "auto";

        if (lines < 3) {
            element.classList.add("no-clamp");

            element.style.height = `$ {
                lineHeight * 3
            }

            px`; // Force exactly 2 lines height
        } else if (lines === 3) {
            element.classList.add("no-clamp");
            element.style.height = "auto"; // Exact 2 lines, no need for manual height
        } else {
            element.classList.remove("no-clamp");
            element.style.height = "auto"; // Let clamp handle it
        }
    });
}
