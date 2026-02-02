export function singleLineTd() {
    document.querySelectorAll("td").forEach((td) => {
        if (
            !td.querySelector("textarea") &&
            !td.querySelector("img") &&
            !td.querySelector("button") &&
            !td.querySelector("a")
        ) {
            const words = td.textContent.trim().split(/\s+/).slice(0, 3);
            td.textContent = words.join(" ") + (words.length < 2 ? "" : "...");
        }
    });
}
