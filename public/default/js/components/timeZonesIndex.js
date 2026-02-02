{/* <div class="row">
    <div class="col-lg-12">
        <select name="timezone" id="timezone" class="timezone">
            <option value="">-- Select Timezone --</option>
        </select>
    </div>
</div>; */}

import { timezones } from "./timezones.js";
export function timeZonesIndex() {
    document.addEventListener("DOMContentLoaded", function () {
        const timezoneSelect = document.getElementById("timezone");

        if (!timezoneSelect) {
            // Element not found, just exit
            return;
        }

        timezones.forEach((tz) => {
            const option = document.createElement("option");
            option.value = `${tz.name} (${tz.offset})`;
            option.textContent = `${tz.name} (${tz.offset})`;
            timezoneSelect.appendChild(option);
        });
    });
}
