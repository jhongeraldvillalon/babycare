<?php

////////////////////// CALCULATE AGE ////////////////////////

$growth_chart = new GrowthChart();
$growth_chart_row = $growth_chart->first('growth_chart_id', child_id_URL());


$children = new Child();
$child_row = $children->first('child_id', $growth_chart_row->child_id);

$current_date = new DateTime();

// Create a DateTime object for the child's birthday
$birthday_date = new DateTime($child_row->birth_date);

// Calculate the age interval
$age_interval = $current_date->diff($birthday_date);

// Extract the individual components of the age
$age_years = $age_interval->y;
$age_months = $age_interval->m;
$age_days = $age_interval->d;

// Calculate the weeks and remaining days
$total_days = ($age_years * 365) + ($age_months * 30) + $age_days;
$age_weeks = floor($total_days / 7);
$remaining_days = $total_days % 7;
//////////////////////////// END OF FOR  AGE ////////////////////////

?>
<!-- Main Content -->
<main>
    <h1>Growth Chart</h1>
    <!-- Analyses -->
    <div class="add-form">
        <h2>Edit Measurement Notes</h2>
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
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d', strtotime($row[0]->date)); ?>" required>

                    </div>
                    <div class="form-column">
                        <label for="old">Age</label>
                        <!-- HIDDEN -->
                        <input type="hidden" name="year" value="<?= get_var('year', $row[0]->year) ?>">
                        <input type="hidden" name="months" value="<?= get_var('months', $row[0]->months) ?>">
                        <input type="hidden" name="week" value="<?= get_var('week', $row[0]->week) ?>">
                        <input type="hidden" name="days" value="<?= get_var('days', $row[0]->days) ?>">
                        <!--  -->
                        <input type="text" id="old" value="<?= "{$age_years} years {$age_months} months old or {$age_weeks} weeks {$remaining_days} days old" ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="weight_metrics">Weight Metric</label>
                        <div class="select-wrapper">
                            <select id="weightMetricSelect" name="weight_metrics" onchange="updateWeight()" required>
                                <option value="" disabled selected>Select</option>
                                <option <?= get_var('weight_metrics', $row[0]->weight_metrics) == 'kilograms' ? 'selected' : '' ?> value="kilograms">Kilograms</option>
                                <option <?= get_var('weight_metrics', $row[0]->weight_metrics) == 'pounds' ? 'selected' : '' ?> value="pounds">Pounds</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <label for="weight">Weight</label>
                        <input type="text" id="weight" name="weight" value="<?= get_var('weight', $row[0]->weight) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="length_metrics">Length Metric</label>
                        <div class="select-wrapper">
                            <select id="lengthMetricSelect" name="length_metrics" onchange="updateLength()" required>
                                <option value="" disabled selected>Select</option>
                                <option <?= get_var('length_metrics', $row[0]->length_metrics) == 'cm' ? 'selected' : '' ?> value="cm">Centimeters</option>
                                <option <?= get_var('length_metrics', $row[0]->length_metrics) == 'inches' ? 'selected' : '' ?> value="inches">Inches</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <label for="length">Length</label>
                        <input type="text" id="length" name="length" value="<?= get_var('length', $row[0]->length) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="body_mass_index">Body Mass Index</label>
                        <input type="text" id="body_mass_index" name="body_mass_index" value="<?= $formattedWeight = number_format(get_var('body_mass_index', $row[0]->body_mass_index), 2) ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="notes_observation">Notes / Observation</label>
                        <input class="text" name="notes_observation" value="<?= get_var('notes_observation', $row[0]->notes_observation) ?>" />
                    </div>
                </div>
                <div class="center-button">
                    <button type="submit">Save</button>
                </div>
            </form>





</main>
<!-- End of Main Content -->

<script>
    function updateWeight() {
        const weightMetricSelect = document.getElementById("weightMetricSelect");
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
        const lengthMetricSelect = document.getElementById("lengthMetricSelect");
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

    function updateBMI() {
        const weightInput = document.getElementById("weight");
        const weightValue = parseFloat(weightInput.value);

        const lengthInput = document.getElementById("length");
        const lengthValue = parseFloat(lengthInput.value);

        const weightMetricSelect = document.getElementById("weightMetricSelect");
        const lengthMetricSelect = document.getElementById("lengthMetricSelect");

        const weightMetric = weightMetricSelect.value;
        const lengthMetric = lengthMetricSelect.value;

        if (isNaN(weightValue) || isNaN(lengthValue)) {
            return;
        }

        let weight_kg = weightValue;
        let height_m = lengthValue;

        if (weightMetric === "pounds") {
            weight_kg *= 0.45359237;
        }

        if (lengthMetric === "inches") {
            height_m *= 0.0254;
        } else if (lengthMetric === "cm") {
            height_m /= 100;
        }

        const BMI = weight_kg / (height_m * height_m);
        const bmiInput = document.getElementById("body_mass_index");
        bmiInput.value = BMI.toFixed(2);
    }

    // Attach the function to the onchange event of weight and length inputs and selects
    document.getElementById("weight").addEventListener("change", updateBMI);
    document.getElementById("length").addEventListener("change", updateBMI);
    document.getElementById("weightMetricSelect").addEventListener("change", updateBMI);
    document.getElementById("lengthMetricSelect").addEventListener("change", updateBMI);

    // Call the function to calculate and display the initial BMI
    updateBMI();
</script>
<script>
    // Function to autofill the dropdowns based on database values
    function autofillDropdowns() {
        const weightMetricSelect = document.getElementById("weightMetricSelect");
        const lengthMetricSelect = document.getElementById("lengthMetricSelect");

        // Set selected option for Weight Metric dropdown
        if ("<?= $weight_metric ?>" !== "") {
            weightMetricSelect.value = "<?= $weight_metric ?>";
        }

        // Set selected option for Length Metric dropdown
        if ("<?= $length_metric ?>" !== "") {
            lengthMetricSelect.value = "<?= $length_metric ?>";
        }
    }

    // Call the function to autofill the dropdowns when the page loads
    window.addEventListener("load", autofillDropdowns);
</script>