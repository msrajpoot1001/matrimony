
// frontend example 
{/* <div class="putTickBeforeLi"> </div> */}
export function tickIconInCkditorDivFrontend() {
    // ck ck editor tick befor frontend
    document.addEventListener("DOMContentLoaded", function () {
        // Add tick icons before each li
        const tickLists = document.querySelectorAll(".putTickBeforeLi ul li");

        tickLists.forEach(function (li) {
            if (!li.querySelector(".round-tick-icon")) {
                const icon = document.createElement("i");
                icon.className = "fas fa-check round-tick-icon";
                li.prepend(icon);
            }
        });
    });
}
