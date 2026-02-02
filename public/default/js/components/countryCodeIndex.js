// to load country code

// this 1 is dynamic
// this is for country code show
//  <select class="country-code country-code1" name="country_code" style="width:100%"></select>

//  this is for selcting in search country
//  <input type="text" id="countrySearch1" placeholder="serach country" />

import { countryCodes } from "./countryCodes.js";

export function countryCodeIndex() {
    // Populate a select with given options frontent
    function populateSelect(selectEl, filteredList, defaultCode = "+91") {
        selectEl.innerHTML = "";
        filteredList.forEach(({ code, country }) => {
            const option = document.createElement("option");
            option.value = `${code} ${country}`;
            option.textContent = `${code} ${country}`;
            if (code === defaultCode) option.selected = true;
            selectEl.appendChild(option);
        });
    }

    // Initialize all pairs frontend
    document.addEventListener("DOMContentLoaded", () => {
        let i = 1;

        while (true) {
            const input = document.getElementById(`countrySearch${i}`);
            const select = document.querySelector(`.country-code${i}`);

            if (!input || !select) break; // stop if no more pairs

            // Populate initially
            populateSelect(select, countryCodes);

            // On search
            input.addEventListener("input", () => {
                const keyword = input.value.toLowerCase();
                const filtered = countryCodes.filter(({ code, country }) =>
                    `${code} ${country}`.toLowerCase().includes(keyword)
                );
                populateSelect(select, filtered);
            });

            i++;
        }
    });
}
