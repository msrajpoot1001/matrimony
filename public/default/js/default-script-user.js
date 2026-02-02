// login page show password with to show password
import { loginPasswordPage } from "./components/loginPasswordPage.js";
loginPasswordPage();

// read more and less
import { readMoreReadLess } from "./components/readMoreReadLess.js";
readMoreReadLess();

// to showcase the design of ckeditor in frontedn page
import { tickIconInCkditorDivFrontend } from "./components/tickIconInCkditorDivFrontend.js";
tickIconInCkditorDivFrontend();

// country code set
import { countryCodeIndex } from "./components/countryCodeIndex.js";
countryCodeIndex();

import { timeZonesIndex } from "./components/timeZonesIndex.js";
timeZonesIndex();

// number of lines in some Element
import { contentNoOfLines } from "./components/contentNoOfLines.js";
contentNoOfLines();

// this for number of line content
document.querySelectorAll(".three-line-text").forEach((el) => {
    const style = window.getComputedStyle(el);
    const lineHeight = parseFloat(style.lineHeight); // current line-height in px
    const height = el.scrollHeight; // actual content height
    const lines = Math.round(height / lineHeight); // number of lines

    const maxLines = 3; // clamp max lines
    let paddingBottom = 0;

    if (lines < maxLines) {
        const emptyLines = maxLines - lines;
        paddingBottom = emptyLines * lineHeight; // space for missing lines
    }

    // Apply the bottom padding only
    el.style.paddingBottom = paddingBottom + "px";

    // Ensure content beyond 3 lines is hidden
    el.style.maxHeight = lineHeight * maxLines + "px";
    el.style.overflow = "hidden";
});

//    <script>
// other services
document.addEventListener("DOMContentLoaded", function () {
    const radios = document.querySelectorAll('input[name="user_type"]');
    const providerSection = document.getElementById("providerFields");

    radios.forEach((radio) => {
        radio.addEventListener("change", function () {
            if (this.value === "provider") {
                providerSection.style.display = "block";
            } else {
                providerSection.style.display = "none";
            }
        });
    });
});
// </script>
