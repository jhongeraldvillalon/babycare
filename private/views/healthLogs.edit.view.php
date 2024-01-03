<?php

////////////////////// CALCULATE AGE ////////////////////////

$health_log = new HealthLog();
$health_log_row = $health_log->first('health_log_id', child_id_URL());

?>

<main>
    <h1>Health Log</h1>
    <!-- Analyses -->

    <div class="add-form">
        <h2>Health Log</h2>
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
                        <label for="hearing">Date</label>
                        <input type="date" id="date_happen" name="date" value="<?php echo date('Y-m-d', strtotime($health_log_row->date)); ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="type">Type</label>
                        <div class="select-wrapper">
                            <select id="type" name="type" required>
                                <option value="" disabled <?= get_var('type', $health_log_row->type) == '' ? 'selected' : '' ?>>Select</option>
                                <option value="accident" <?= get_var('type', $health_log_row->type) == 'accident' ? 'selected' : '' ?>>Accident</option>
                                <option value="sickness" <?= get_var('type', $health_log_row->type) == 'sickness' ? 'selected' : '' ?>>Sickness</option>
                            </select>
                        </div>
                    </div>>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="condition">Condition</label>
                        <input type="text" id="condition" name="condition" value="<?= get_var('condition', $health_log_row->condition) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="is_consult">Is this event already consulted?</label>
                        <input type="checkbox" id="consultedCheckbox" name="is_consult" value="1" onchange="toggleResultField()" <?= $health_log_row->is_consult == 1 ? 'checked' : '' ?> />
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-column" id="resultField">
                        <label for="result">Then what is the result</label>
                        <input type="text" id="result" name="result" value="<?= get_var('result',$health_log_row->result) ?>" />
                    </div>
                </div>
                <div class="center-button">
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="recent-orders">
        <h2>Logs</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Condition</th>
                    <th>Consulted?</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $healthLog = new HealthLog();
                $healthLog_exists = $healthLog->where('child_id', child_id_URL());
                if ($healthLog_exists) :
                    foreach ($healthLog_exists as $row) :
                ?>
                        <tr>
                            <td>
                                <?= $row->date ?>
                            </td>
                            <td>
                                <?= ucfirst($row->type) ?>
                            </td>
                            <td>
                                <?= ucfirst($row->condition) ?>
                            </td>
                            <td>
                                <?= ($row->is_consult == 1) ? 'Yes' : 'No' ?>
                            </td>
                            <td>
                                <?= $row->result ?>
                            </td>
                            <td><a href="<?php echo ROOT . "/healthLogs/edit/" . $row->health_log_id ?>">Edit</a></td>
                        </tr>
                    <?php
                    endforeach; ?>
                <?php else : ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<script>
    function toggleResultField() {
        var checkBox = document.getElementById("consultedCheckbox");
        var resultField = document.getElementById("resultField");
        if (checkBox.checked == true) {
            resultField.style.display = "block";
        } else {
            resultField.style.display = "none";
        }
    }

    // Call the function on page load to set the initial state
    window.onload = function() {
        toggleResultField();
    };
</script>