<?php

////////////////////// CALCULATE AGE ////////////////////////

$immunization = new Immunization();
$immunization_row = $immunization->first('immunization_id', child_id_URL());

?>

<!-- Main Content -->
<main>

    <h1>Immunization</h1>
    <!-- Analyses -->
    <div class="add-form">
        <h2>Edit Immunization</h2>
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
                        <label for="vaccineSelect">Vaccine</label>
                        <div class="select-wrapper">
                            <select id="vaccineSelect" name="vaccineSelect" required>
                                <option value="" disabled <?= get_var('vaccineSelect', $immunization_row->vaccine) == '' ? 'selected' : '' ?>>Select</option>
                                <option value="BCG" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'BCG' ? 'selected' : '' ?>>BCG</option>
                                <option value="Hepatitis B" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Hepatitis B' ? 'selected' : '' ?>>Hepatitis B</option>
                                <option value="Ditheria, Tetanus, Pertussis (DTP)" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Ditheria, Tetanus, Pertussis (DTP)' ? 'selected' : '' ?>>Ditheria, Tetanus, Pertussis (DTP)</option>
                                <option value="Haemophius Influenzae Type B (Hib)" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Haemophius Influenzae Type B (Hib)' ? 'selected' : '' ?>>Haemophius Influenzae Type B (Hib)</option>
                                <option value="Polio (IPV/OPV)" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Polio (IPV/OPV)' ? 'selected' : '' ?>>Polio (IPV/OPV)</option>
                                <option value="Measles" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Measles' ? 'selected' : '' ?>>Measles</option>
                                <option value="Measles, Mumps, Rubella (MMR)" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Measles, Mumps, Rubella (MMR)' ? 'selected' : '' ?>>Measles, Mumps, Rubella (MMR)</option>
                                <option value="Varicella" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Varicella' ? 'selected' : '' ?>>Varicella</option>
                                <option value="Hepatitis A" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Hepatitis A' ? 'selected' : '' ?>>Hepatitis A</option>
                                <option value="Pneumococcal (PCV/PPV)" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Pneumococcal (PCV/PPV)' ? 'selected' : '' ?>>Pneumococcal (PCV/PPV)</option>
                                <option value="Meningocal A+C" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Meningocal A+C' ? 'selected' : '' ?>>Meningocal A+C</option>
                                <option value="Rotavirus" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Rotavirus' ? 'selected' : '' ?>>Rotavirus</option>
                                <option value="Typhoid Fever" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Typhoid Fever' ? 'selected' : '' ?>>Typhoid Fever</option>
                                <option value="Human Papillomavirus (HPV)" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Human Papillomavirus (HPV)' ? 'selected' : '' ?>>Human Papillomavirus (HPV)</option>
                                <option value="Influenza" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Influenza' ? 'selected' : '' ?>>Influenza</option>
                                <option value="Other" <?= get_var('vaccineSelect', $immunization_row->vaccine) == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column" id="customVaccineContainer" style="display: none;">
                        <label for="customVaccine">Custom Vaccine</label>
                        <input type="text" id="customVaccine" value="<?= get_var('customVaccine') ?>" name="customVaccine" />
                    </div>
                    <div class="form-column">
                        <label for="doseSelect">Dose</label>
                        <div class="select-wrapper">
                            <select id="doseSelect" name="doseSelect" required>
                                <option value="" disabled <?= get_var('doseSelect', $immunization_row->dose) == '' ? 'selected' : '' ?>>Select</option>
                                <option value="1" <?= get_var('doseSelect', $immunization_row->dose) == '1' ? 'selected' : '' ?>>1</option>
                                <option value="2" <?= get_var('doseSelect', $immunization_row->dose) == '2' ? 'selected' : '' ?>>2</option>
                                <option value="3" <?= get_var('doseSelect', $immunization_row->dose) == '3' ? 'selected' : '' ?>>3</option>
                                <option value="4" <?= get_var('doseSelect', $immunization_row->dose) == '4' ? 'selected' : '' ?>>4</option>
                                <option value="5" <?= get_var('doseSelect', $immunization_row->dose) == '5' ? 'selected' : '' ?>>5</option>
                                <option value="6" <?= get_var('doseSelect', $immunization_row->dose) == '6' ? 'selected' : '' ?>>6</option>
                                <option value="7" <?= get_var('doseSelect', $immunization_row->dose) == '7' ? 'selected' : '' ?>>7</option>
                                <option value="Booster" <?= get_var('doseSelect', $immunization_row->dose) == 'Booster' ? 'selected' : '' ?>>Booster</option>
                                <option value="Booster 1" <?= get_var('doseSelect', $immunization_row->dose) == 'Booster 1' ? 'selected' : '' ?>>Booster 1</option>
                                <option value="Booster 2" <?= get_var('doseSelect', $immunization_row->dose) == 'Booster 2' ? 'selected' : '' ?>>Booster 2</option>
                                <option value="Booster 3" <?= get_var('doseSelect', $immunization_row->dose) == 'Booster 3' ? 'selected' : '' ?>>Booster 3</option>
                                <option value="Booster 4" <?= get_var('doseSelect', $immunization_row->dose) == 'Booster 4' ? 'selected' : '' ?>>Booster 4</option>
                                <option value="Booster 5" <?= get_var('doseSelect', $immunization_row->dose) == 'Booster 5' ? 'selected' : '' ?>>Booster 5</option>
                                <option value="Booster 6" <?= get_var('doseSelect', $immunization_row->dose) == 'Booster 6' ? 'selected' : '' ?>>Booster 6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h3>Vaccine Info</h3>
                <div class="form-row">
                    <div class="form-column">
                        <label for="type">Type</label>
                        <input type="text" id="type" name="type" value="<?= get_var('type', $immunization_row->type) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="lot">Lot #</label>
                        <input type="text" id="lot" name="lot" value="<?= get_var('lot', $immunization_row->lot) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="expiration">Expiration</label>
                        <input type="date" id="expiration" name="expiration" value="<?php echo date('Y-m-d', strtotime($immunization_row->expiration)); ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="date_administered">Date Administered</label>
                        <input type="date" id="date_administered" name="date_administered" value="<?php echo date('Y-m-d', strtotime($immunization_row->date_administered)); ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="administered_by">Administered by</label>
                        <input type="text" id="administered_by" name="administered_by" value="<?= get_var('administered_by', $immunization_row->administered_by) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="route_site_note">Route Site / Notes</label>
                        <input type="text" id="route_site_note" name="route_site_note" value="<?= get_var('route_site_note', $immunization_row->route_site_note) ?>" required />
                    </div>
                </div>
                <div class="center-button">
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
</main>
<!-- End of Main Content -->

<!-- CODE TO SHOW THE CUSTOM VACCINE IF THE VALUE OF THE VACCINE IS OTHERS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const vaccineDropdown = document.getElementById('vaccineSelect');
        const customVaccineContainer = document.getElementById('customVaccineContainer');
        const customVaccineInput = document.getElementById('customVaccine');

        // Define the list of vaccines
        const vaccines = [
            'BCG',
            'Hepatitis B',
            'Ditheria, Tetanus, Pertussis (DTP)',
            'Haemophius Influenzae Type B (Hib)',
            'Polio (IPV/OPV)',
            'Measles',
            'Measles, Mumps, Rubella (MMR)',
            'Varicella',
            'Hepatitis A',
            'Pneumococcal (PCV/PPV)',
            'Meningocal A+C',
            'Rotavirus',
            'Typhoid Fever',
            'Human Papillomavirus (HPV)',
            'Influenza',
            'Other'
        ];

        const phpValueOfVaccine = '<?php echo $immunization_row->vaccine; ?>';

        // Function to check if the vaccine is in the list
        function checkVaccine() {
            if (!vaccines.includes(phpValueOfVaccine)) {
                vaccineDropdown.value = 'Other';
                customVaccineContainer.style.display = 'block';
                customVaccineInput.value = phpValueOfVaccine;
            } else {
                vaccineDropdown.value = phpValueOfVaccine;
                customVaccineContainer.style.display = phpValueOfVaccine === 'Other' ? 'block' : 'none';
            }
        }

        // Initialize the check on page load
        checkVaccine();

        // Event listener for changes
        vaccineDropdown.addEventListener('change', checkVaccine);
    });
</script>

<!------------------------------------------------------------------>

<script>
    // Get references to the select element and the custom vaccine input field
    const vaccineDropdown = document.getElementById('vaccineSelect');
    const customVaccineContainer = document.getElementById('customVaccineContainer');

    // Function to toggle the display of the custom vaccine input based on the selected vaccine
    function toggleCustomVaccineInput() {
        const selectedValue = vaccineDropdown.value;
        customVaccineContainer.style.display = selectedValue === 'Other' ? 'block' : 'none';
    }

    // Add an event listener to the vaccine select element
    vaccineDropdown.addEventListener('change', toggleCustomVaccineInput);

    // Call the function to set the initial state when the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        toggleCustomVaccineInput();
    });
</script>

<script>
    // Get references to the select elements
    const vaccineSelect = document.getElementById('vaccineSelect');
    const doseSelect = document.getElementById('doseSelect');

    // Define the available dose options for each vaccine
    const doseOptions = {
        'BCG': ['1'],
        'Hepatitis B': ['1', '2', '3', '4', 'Booster'],
        'Ditheria, Tetanus, Pertussis (DTP)': ['1', '2', '3', 'Booster 1', 'Booster 2'],
        'Haemophius Influenzae Type B (Hib)': ['1', '2', '3', 'Booster 1', 'Booster 2'],
        'Polio (IPV/OPV)': ['1', '2', '3', 'Booster 1', 'Booster 2'],
        'Measles': ['1'],
        'Measles, Mumps, Rubella (MMR)': ['1', '2', 'Booster'],
        'Varicella': ['1', '2', 'Booster'],
        'Hepatitis A': ['1', '2'],
        'Pneumococcal (PCV/PPV)': ['1', '2', '3', 'Booster 1', 'Booster 2'],
        'Meningocal A+C': ['1'],
        'Rotavirus': ['1', '2', '3'],
        'Typhoid Fever': ['1', '2', '3'],
        'Human Papillomavirus (HPV)': ['1', '2', '3'],
        'Influenza': ['1', '2', '3'],
        'Other': ['1', '2', '3', '4', '5', '6', '7', '8', 'Booster', 'Booster 1', 'Booster 2', 'Booster 3', 'Booster 4', 'Booster 5', 'Booster 6'],

        // Add more vaccine options and their corresponding doses here
    };

    // Function to update the dose options based on the selected vaccine
    function updateDoseOptions() {
        const selectedVaccine = vaccineSelect.value;

        // Clear the current options in the dose select
        doseSelect.innerHTML = '<option value="" disabled selected>Select</option>';

        // Add the appropriate dose options based on the selected vaccine
        if (doseOptions[selectedVaccine]) {
            doseOptions[selectedVaccine].forEach((dose) => {
                const option = document.createElement('option');
                option.value = dose;
                option.textContent = dose;
                doseSelect.appendChild(option);
            });
        }

        // Enable or disable the dose select based on the selected vaccine
        doseSelect.disabled = !selectedVaccine;
    }

    // Add an event listener to the vaccine select to update the dose options
    vaccineSelect.addEventListener('change', updateDoseOptions);

    // Call the updateDoseOptions function initially to set the initial state
    updateDoseOptions();
</script>