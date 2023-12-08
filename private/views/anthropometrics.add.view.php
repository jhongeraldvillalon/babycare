

    <main>
        <h1>Anthropometrics</h1>
        <div class="add-form">
            <h2>Anthropometrics</h2>
            <div class="form-section">
                <form method="post">
                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-warning alert-dismissible fade show p-0" role="alert">
                            <strong>Oops</strong>
                            <?php foreach ($errors as $error) : ?>
                                <br> <?= $error ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-row">
                        <div class="form-column">
                            <label for="weight_metric">Weight Metric</label>
                            <div class="select-wrapper">
                                <select  id="weight_metric_select" name="weight_metric" onchange="updateWeight()" <?= get_var('weight_metric') ?>>
                                    <option value="" disabled selected>Select</option>
                                    <option <?= get_var('weight_metric') == 'kilograms' ? 'selected' : '' ?> value="kilograms">Kilograms</option>
                                    <option <?= get_var('weight_metric') == 'pounds' ? 'selected' : '' ?> value="pounds">Pounds</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-column">
                            <label for="weight">Birth Weight</label>
                            <input type="text" id="weight" name="weight" value="<?= get_var('weight') ?>" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-column">
                            <label for="length_metric">Length Metric</label>
                            <div class="select-wrapper">
                                <select  id="length_metric_select" name="length_metric" onchange="updateLength()" <?= get_var('length_metric') ?>>
                                    <option value="" disabled selected>Select</option>
                                    <option <?= get_var('length_metric') == 'cm' ? 'selected' : '' ?> value="cm">Centimeters</option>
                                    <option <?= get_var('length_metric') == 'inches' ? 'selected' : '' ?> value="inches">Inches</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-column">
                            <label for="length">Birth Length</label>
                            <input type="text" id="length" name="length" value="<?= get_var('length') ?>" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-column">
                            <label for="head_metric">Head Metric</label>
                            <div class="select-wrapper">
                                <select id="head_metric_select" name="head_metric" onchange="updateHead()" <?= get_var('head_metric') ?>>
                                    <option value="" disabled selected>Select</option>
                                    <option <?= get_var('head_metric') == 'cm' ? 'selected' : '' ?> value="cm">Centimeters</option>
                                    <option <?= get_var('head_metric') == 'inches' ? 'selected' : '' ?> value="inches">Inches</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-column">
                            <label for="head">Head Circumference</label>
                            <input type="text" id="head" name="head" value="<?= get_var('head') ?>" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-column">
                            <label for="chest_metric">Chest Metric</label>
                            <div class="select-wrapper">
                                <select id="chest_metric_select" name="chest_metric" onchange="updateChest()"  <?= get_var('chest_metric') ?>>
                                    <option value="" disabled selected>Select</option>
                                    <option <?= get_var('chest_metric') == 'cm' ? 'selected' : '' ?> value="cm">Centimeters</option>
                                    <option <?= get_var('chest_metric') == 'inches' ? 'selected' : '' ?> value="inches">Inches</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-column">
                            <label for="chest">Chest Circumference</label>
                            <input type="text" id="chest" name="chest" value="<?= get_var('chest') ?>" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-column">
                            <label for="abdomen_metric">Abdomen Metric</label>
                            <div class="select-wrapper">
                                <select id="abdomen_metric_select" name="abdomen_metric" onchange="updateAbdomen()" <?= get_var('abdomen_metric') ?>>
                                    <option value="" disabled selected>Select</option>
                                    <option <?= get_var('abdomen_metric') == 'cm' ? 'selected' : '' ?> value="cm">Centimeters</option>
                                    <option <?= get_var('abdomen_metric') == 'inches' ? 'selected' : '' ?> value="inches">Inches</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-column">
                            <label for="abdomen">Abdomen Circumference</label>
                            <input type="text" id="abdomen" name="abdomen" value="<?= get_var('abdomen') ?>" required />
                        </div>
                    </div>

                    <div class="center-button">
                        <button>Save</button>
                    </div>
                </form>
            </div>
    </main>

<script>
    function updateWeight() {
        const weightMetricSelect = document.getElementById("weight_metric_select");
        const weightInput = document.getElementById("weight");
        const weightValue = weightInput.value.trim(); // Trim any leading/trailing spaces

        if (weightValue === "") {
            return; // If weight input is empty, do nothing
        }

        if (weightMetricSelect.value === "pounds") {
            // Convert weight to pounds
            const weightInKilograms = parseFloat(weightValue);
            const weightInPounds = weightInKilograms * 2.20462;
            weightInput.value = weightInPounds.toFixed(2);
        } else if (weightMetricSelect.value === "kilograms") {
            // Convert weight to kilograms
            const weightInPounds = parseFloat(weightValue);
            const weightInKilograms = weightInPounds / 2.20462;
            weightInput.value = weightInKilograms.toFixed(2);
        }
    }

    function updateLength() {
        const lengthMetricSelect = document.getElementById("length_metric_select");
        const lengthInput = document.getElementById("length");
        const lengthValue = lengthInput.value.trim(); // Trim any leading/trailing spaces

        if (lengthValue === "") {
            return; // If length input is empty, do nothing
        }

        if (lengthMetricSelect.value === "cm") {
            // Convert length to centimeters
            const lengthInInches = parseFloat(lengthValue);
            const lengthInCentimeters = lengthInInches * 2.54;
            lengthInput.value = lengthInCentimeters.toFixed(2);
        } else if (lengthMetricSelect.value === "inches") {
            // Convert length to inches
            const lengthInCentimeters = parseFloat(lengthValue);
            const lengthInInches = lengthInCentimeters / 2.54;
            lengthInput.value = lengthInInches.toFixed(2);
        }
    }

    function updateHead() {
        const headMetricSelect = document.getElementById("head_metric_select");
        const headInput = document.getElementById("head");
        const headValue = headInput.value.trim();

        if (headValue === "") {
            return; // If head input is empty, do nothing
        }

        if (headMetricSelect.value === "cm") {
            // Convert head to centimeters
            const headInInches = parseFloat(headValue);
            const headInCentimeters = headInInches * 2.54;
            headInput.value = headInCentimeters.toFixed(2);
        } else if (headMetricSelect.value === "inches") {
            // Convert head to inches
            const headInCentimeters = parseFloat(headValue);
            const headInInches = headInCentimeters / 2.54;
            headInput.value = headInInches.toFixed(2);
        }
    }

    function updateChest() {
        // Similar to updateHead(), add the logic for updating the chest
        const chestMetricSelect = document.getElementById("chest_metric_select");
        const chestInput = document.getElementById("chest");
        const chestValue = chestInput.value.trim();

        if (chestValue === "") {
            return; // If chest input is empty, do nothing
        }

        if (chestMetricSelect.value === "cm") {
            // Convert chest to centimeters
            const chestInInches = parseFloat(chestValue);
            const chestInCentimeters = chestInInches * 2.54;
            chestInput.value = chestInCentimeters.toFixed(2);
        } else if (chestMetricSelect.value === "inches") {
            // Convert chest to inches
            const chestInCentimeters = parseFloat(chestValue);
            const chestInInches = chestInCentimeters / 2.54;
            chestInput.value = chestInInches.toFixed(2);
        }
    }

    function updateAbdomen() {
        // Similar to updateHead(), add the logic for updating the chest
        const abdomenMetricSelect = document.getElementById("abdomen_metric_select");
        const abdomenInput = document.getElementById("abdomen");
        const abdomenValue = abdomenInput.value.trim();

        if (abdomenValue === "") {
            return; // If abdomen input is empty, do nothing
        }

        if (abdomenMetricSelect.value === "cm") {
            // Convert abdomen to centimeters
            const abdomenInInches = parseFloat(abdomenValue);
            const abdomenInCentimeters = abdomenInInches * 2.54;
            abdomenInput.value = abdomenInCentimeters.toFixed(2);
        } else if (abdomenMetricSelect.value === "inches") {
            // Convert abdomen to inches
            const abdomenInCentimeters = parseFloat(abdomenValue);
            const abdomenInInches = abdomenInCentimeters / 2.54;
            abdomenInput.value = abdomenInInches.toFixed(2);
        }
    }
</script>
<script>
    // Function to autofill the dropdowns based on database values
    function autofillDropdowns() {
        const weightMetricSelect = document.getElementById("weight_metric_select");
        const lengthMetricSelect = document.getElementById("length_metric_select");
        const headMetricSelect = document.getElementById("head_metric_select");
        const chestMetricSelect = document.getElementById("chest_metric_select");
        const abdomenMetricSelect = document.getElementById("abdomen_metric_select");

        // Set selected option for Weight Metric dropdown
        if ("<?= $weight_metric ?>" !== "") {
            weightMetricSelect.value = "<?= $weight_metric ?>";
        }

        // Set selected option for Length Metric dropdown
        if ("<?= $length_metric ?>" !== "") {
            lengthMetricSelect.value = "<?= $length_metric ?>";
        }

        // Set selected option for Head Metric dropdown
        if ("<?= $head_metric ?>" !== "") {
            headMetricSelect.value = "<?= $head_metric ?>";
        }

        // Set selected option for Chest Metric dropdown
        if ("<?= $chest_metric ?>" !== "") {
            chestMetricSelect.value = "<?= $chest_metric ?>";
        }

        // Set selected option for Abdomen Metric dropdown
        if ("<?= $abdomen_metric ?>" !== "") {
            abdomenMetricSelect.value = "<?= $abdomen_metric ?>";
        }
    }

    // Call the function to autofill the dropdowns when the page loads
    window.addEventListener("load", autofillDropdowns);
</script>