<?php

////////////////////// CALCULATE AGE ////////////////////////
$children = new Child();
$child_row = $children->first('child_id', child_id_URL());

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
    <div class="add-form">
        <h2>Measurement Notes</h2>
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
                        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-column">
                        <label for="old">Age</label>
                        <!-- HIDDEN -->
                        <input type="hidden" name="year" value="<?= $age_years ?>">
                        <input type="hidden" name="months" value="<?= $age_months ?>">
                        <input type="hidden" name="week" value="<?= $age_weeks ?>">
                        <input type="hidden" name="days" value="<?= $remaining_days ?>">
                        <!--  -->
                        <input type="text" id="old" value="<?= "{$age_years} years {$age_months} months old or {$age_weeks} weeks {$remaining_days} days old" ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="weight_metrics">Weight Metric</label>
                        <div class="select-wrapper">
                            <select  <?= get_var('weight_metrics') ?> id="weightMetricSelect" name="weight_metrics" onchange="updateWeight()" required>
                                <option value="" disabled selected>Select</option>
                                <option <?= get_var('weight_metrics') == 'kilograms' ? 'selected' : '' ?> value="kilograms">Kilograms</option>
                                <option <?= get_var('weight_metrics') == 'pounds' ? 'selected' : '' ?> value="pounds">Pounds</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <label for="weight">Weight</label>
                        <input type="text" id="weight" name="weight" value="<?= get_var('weight') ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="length_metrics">Length Metric</label>
                        <div class="select-wrapper">
                            <select id="lengthMetricSelect" name="length_metrics" onchange="updateLength()" <?= get_var('length_metrics') ?> required>
                                <option value="" disabled selected>Select</option>
                                <option value="cm">Centimeters</option>
                                <option value="inches">Inches</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <label for="length">Length</label>
                        <input type="text" id="length" name="length" value="<?= get_var('length') ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="body_mass_index">Body Mass Index</label>
                        <input value="<?= get_var('body_mass_index') ?>" type="text" id="body_mass_index" name="body_mass_index" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="notes_observation">Notes / Observation</label>
                        <input class="text" value="<?= get_var('notes_observation') ?>" name="notes_observation" />
                    </div>
                </div>
                <div class="center-button">
                    <button type="submit">Save</button>
                </div>
            </form>

        </div>
        <div class="recent-orders">
            <h2>Measurement Notes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Timeline</th>
                        <th>Date</th>
                        <th>Age</th>
                        <th>Weight (kg)</th>
                        <th>Length (cm)</th>
                        <th>Body Mass Index</th>
                        <th>Notes / Observation</th>
                        <th>Quick Assessment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $growth_chart = new GrowthChart();
                    $growth_chart_exists = $growth_chart->where('child_id', child_id_URL());

                    $child = new Anthropometric();
                    $exists = $child->first('child_id', child_id_URL());

                    if ($exists) {

                        $birth_weight = isset($exists->weight) ? number_format($exists->weight, 2) :  '';
                        $birth_length = isset($exists->length) ? number_format($exists->length, 2) :  '';
                        $birth_meter = $birth_length / 100;
                        $bmi  = $birth_weight / ($birth_meter * $birth_meter);
                        $assessment = '';
                        if ($bmi < 18.5) {
                            // Underweight
                            $assessment = "Underweight: Increased risk of nutritional deficiencies, weakened immune system, osteoporosis, etc.";
                        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                            // Normal weight
                            $assessment = "Normal Weight: Generally lower risk of chronic diseases related to obesity.";
                        } elseif ($bmi >= 25 && $bmi <= 29.9) {
                            // Overweight
                            $assessment = "Overweight: Increased risk of cardiovascular diseases, type 2 diabetes, joint pain, sleep apnea, etc. Contact your baby's pediatrician immediately.";
                        } else {
                            // Obesity Class 1 (Moderate Obesity)
                            $assessment = "Obesity: Higher risk of metabolic syndrome, severe health issues associated with being overweight. Contact your baby's pediatrician immediately.";
                        }


                    ?>

                        <tr>
                            <td>Day 1</td>
                            <td>
                                <?= $formattedDate = date("F jS, Y", strtotime($child_row->birth_date)) ?>
                            </td>
                            <td>
                                <?= "Upon Birth" ?>
                            </td>
                            <td>
                                <?= $formattedWeight = number_format($birth_weight, 2) . " kg" ?>
                            </td>
                            <td>
                                <?= $formatted = number_format($birth_length, 2) . " cm" ?>
                            </td>
                            <td>
                                <?= $formatted = number_format($bmi, 2) ?>
                            </td>
                            <td>
                                <?= "Birth Metrics" ?>
                            </td>
                            <td>
                                <?= $assessment ?>
                            </td>
                            <td><a href="<?php echo ROOT . "/anthropometrics/" . child_id_URL(); ?>">Edit</a></td>
                        </tr>

                        <?php if ($growth_chart_exists) : ?>
                            <?php $number = 1;
                            foreach ($growth_chart_exists as $row) :


                                if ($row->body_mass_index < 18.5) {
                                    // Underweight
                                    $assessment = "Underweight: Increased risk of nutritional deficiencies, weakened immune system, osteoporosis, etc.";
                                } elseif ($row->body_mass_index >= 18.5 && $row->body_mass_index <= 24.9) {
                                    // Normal weight
                                    $assessment = "Normal Weight: Generally lower risk of chronic diseases related to obesity.";
                                } elseif ($row->body_mass_index >= 25 && $row->body_mass_index <= 29.9) {
                                    // Overweight
                                    $assessment = "Overweight: Increased risk of cardiovascular diseases, type 2 diabetes, joint pain, sleep apnea, etc. Contact your baby's pediatrician immediately.";
                                } else {
                                    // Obesity Class 1 (Moderate Obesity)
                                    $assessment = "Obesity: Higher risk of metabolic syndrome, severe health issues associated with being overweight. Contact your baby's pediatrician immediately.";
                                }


                            ?>

                                <tr>
                                    <td>Month <?= $number ?></td>
                                    <td>
                                        <?= $formattedDate = date("F jS, Y", strtotime($row->date))  ?>
                                    </td>
                                    <td>
                                        <?= $row->year . " years and "  . $row->months . " months or " . $row->week . " weeks and " . $row->days . " days old"  ?>
                                    </td>
                                    <td>
                                        <?= $formattedWeight = number_format($row->weight, 2) . " kg" ?>
                                    </td>
                                    <td>
                                        <?= $formattedWeight = number_format($row->length, 2) . " cm" ?>
                                    </td>
                                    <td>
                                        <?= $formattedWeight = number_format($row->body_mass_index, 2)  ?>
                                    </td>
                                    <td>
                                        <?= $row->notes_observation ?>
                                    </td>
                                    <td>
                                        <?= $assessment ?>
                                    </td>
                                    <td><a href="<?php echo ROOT . "/growthcharts/edit/" . $row->growth_chart_id ?>">Edit</a></td>
                                </tr>

                            <?php $number++;
                            endforeach; ?>
                        <?php else : ?>

                        <?php endif; ?>

                    <?php }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="form-section">
            <h2>Growth Chart</h2>

            <div class="form-row">
                <div class="form-column">
                    <div class="chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div class="form-column">
                    <div class="chart">
                        <canvas id="myChartLength"></canvas>
                    </div>
                </div>
            </div>


        </div>
</main>
<!-- End of Main Content -->

<?php
// DEVELOPMENT
$birth_weight = isset($exists->weight) ? number_format($exists->weight, 2) :  '';
$birth_length = isset($exists->length) ? number_format($exists->length, 2) :  '';

$date = [
    'Day 1',
    'Month 1', 'Month 2', 'Month 3', 'Month 4', 'Month 5',  'Month 6', 'Month 7', 'Month  8',  'Month 9', 'Month 10', 'Month 11', 'Month 12',
    'Month 13', 'Month 14', 'Month 15', 'Month 16', 'Month 17',  'Month 18', 'Month 19', 'Month  20',  'Month 21', 'Month 22', 'Month 23', 'Month 24',
    'Month 25', 'Month 26', 'Month 27', 'Month 28', 'Month 29',  'Month 30', 'Month 31', 'Month  32',  'Month 33', 'Month 34', 'Month 35', 'Month 36',
    'Month 37', 'Month 38', 'Month 39', 'Month 40', 'Month 41',  'Month 42', 'Month 43', 'Month  44',  'Month 45', 'Month 46', 'Month 47', 'Month 48',
];
$weights = [$birth_weight];
$lengths = [$birth_length];
$normalWeight = [
    $birth_weight, '2', '4.2', '6', '7.5', '8.2', '9', '10', '10.5', '11', '11.4', '11.6', '11.8',
    '11.9', '12.3', '12.5', '12.8',  '12.9', '13.2', '13.4', '13.6', '13.8', '14.1', '14.3', '14.5',
    '14.8', '15.2', '15.5', '15.8', '16', '16.1', '16.3', '16.5', '16.6', '16.8', '17', '17.2', '17.4',
    '17.5', '17.8', '18', '18.2', '18.3', '18.4', '18.5', '18.8', '18.9', '19', '19.2'
];
$normalLength = [
    $birth_length, '55', '61', '65', '68.6', '70', '71', '73', '74', '76', '79', '82', '83.6', '86', '88',
    '89.5', '91', '92.5', '94', '95.5', '97', '98.5', '100', '101.5', '103',
    '105', '106.5', '108', '109.5', '111', '112.5', '114', '115.5', '117', '118.5', '120', '121.5', '123',
    '124.5', '126', '127.5', '129', '130.5', '132', '133.5', '135.5', '138', '139.5', '141'
];

foreach ($growth_chart_exists as $row) {
    // $date[] = $row['date'];
    $weights[] = number_format($row->weight, 2);
    $lengths[] = number_format($row->length, 2);
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext("2d");
    const lengthCtx = document.getElementById('myChartLength').getContext("2d");
    let delayed;
    const rawDates = <?php echo json_encode($date); ?>;
    const labels = rawDates;

    const data = {
        labels,
        datasets: [{
            data: <?php echo json_encode($weights); ?>,
            label: "Baby Weight",
            fill: true,
        }, {
            data: <?php echo json_encode($normalWeight); ?>,
            label: "Normal Weight",
            fill: true,
        }],
    };

    const lengthData = {
        labels,
        datasets: [{
                data: <?php echo json_encode($lengths); ?>,
                label: "Baby Length",
                fill: true,
            },
            {
                data: <?php echo json_encode($normalLength); ?>,
                label: "Normal Length",
                fill: true,
            }
        ],
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === "data" && context.mode === "default" && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Weight'
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return value + ' kg';
                        }
                    }
                }
            }
        },

    }
    const myChart = new Chart(ctx, config);
    const myChartLength = new Chart(lengthCtx, {
        type: 'line',
        data: lengthData,
        options: {
            responsive: true,
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === "data" && context.mode === "default" && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Length'
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return value + ' cm';
                        }
                    }
                }
            }
        }
    });
</script>
<script>
    function updateWeight() {
        const weightMetricSelect = document.getElementById("weightMetricSelect");
        const weightInput = document.getElementById("weight");
        const weightValue = weightInput.value.trim(); // Trim any leading/trailing spaces

        if (weightValue === "") {
            return; // If weight input is empty, do nothing
        }

        if (weightMetricSelect.value === "Pounds") {
            // Convert weight to pounds
            const weightInKilograms = parseFloat(weightValue);
            const weightInPounds = weightInKilograms * 2.20462;
            weightInput.value = weightInPounds.toFixed(2);
        } else if (weightMetricSelect.value === "Kilograms") {
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

        if (weightMetric === "Pounds") {
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
<script>
    const sideMenu = document.querySelector('aside');
    const menuBtn = document.getElementById('menu-btn');
    const closeBtn = document.getElementById('close-btn');

    const darkMode = document.querySelector('.dark-mode');

    menuBtn.addEventListener('click', () => {
        sideMenu.style.display = 'block';
    })

    closeBtn.addEventListener('click', () => {
        sideMenu.style.display = 'none';
    });

    darkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode-variables');
        darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
        darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
    })
</script>