<main>
    <h1>Edit Contact</h1>
    <div class="add-form">
        <h2>Update Contact Information</h2>
        <div class="form-section">
        <form method="post" action="<?php ROOT . '/contacts/edit/' . child_id_URL() ?>">
                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-warning alert-dismissible fade show p-0" role="alert">
                        <strong>Oops</strong>
                        <?php foreach ($errors as $error) : ?>
                            <br> <?= $error ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Hospital Information -->
                <div class="form-row">
                    <div class="form-column">
                        <label for="hospital">Hospital</label>
                        <input type="text" id="hospital" name="hospital" value="<?= get_var('hospital', $row[0]->hospital) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="hospital_contact">Hospital Contact</label>
                        <input type="text" id="hospital_contact" name="hospital_contact" value="<?= get_var('hospital_contact', $row[0]->hospital_contact) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="hospital_address">Hospital Address</label>
                        <input type="text" id="hospital_address" name="hospital_address" value="<?= get_var('hospital_address', $row[0]->hospital_address) ?>" required />
                    </div>
                </div>

                <!-- Pharmacy Information -->
                <div class="form-row">
                    <div class="form-column">
                        <label for="pharmacy">Pharmacy</label>
                        <input type="text" id="pharmacy" name="pharmacy" value="<?= get_var('pharmacy', $row[0]->pharmacy) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="pharmacy_contact">Pharmacy Contact</label>
                        <input type="text" id="pharmacy_contact" name="pharmacy_contact" value="<?= get_var('pharmacy_contact', $row[0]->pharmacy_contact) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="pharmacy_address">Pharmacy Address</label>
                        <input type="text" id="pharmacy_address" name="pharmacy_address" value="<?= get_var('pharmacy_address', $row[0]->pharmacy_address) ?>" required />
                    </div>
                </div>

                <!-- Ambulance Information -->
                <div class="form-row">
                    <div class="form-column">
                        <label for="ambulance">Ambulance</label>
                        <input type="text" id="ambulance" name="ambulance" value="<?= get_var('ambulance', $row[0]->ambulance) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="ambulance_contact">Ambulance Contact</label>
                        <input type="text" id="ambulance_contact" name="ambulance_contact" value="<?= get_var('ambulance_contact', $row[0]->ambulance_contact) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="ambulance_address">Ambulance Address</label>
                        <input type="text" id="ambulance_address" name="ambulance_address" value="<?= get_var('ambulance_address', $row[0]->ambulance_address) ?>" required />
                    </div>
                </div>

                <!-- Poison Control Center Information -->
                <div class="form-row">
                    <div class="form-column">
                        <label for="poison_control_center">Poison Control Center</label>
                        <input type="text" id="poison_control_center" name="poison_control_center" value="<?= get_var('poison_control_center', $row[0]->poison_control_center) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="poison_control_center_contact">Poison Control Center Contact</label>
                        <input type="text" id="poison_control_center_contact" name="poison_control_center_contact" value="<?= get_var('poison_control_center_contact', $row[0]->poison_control_center_contact) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="poison_control_center_address">Poison Control Center Address</label>
                        <input type="text" id="poison_control_center_address" name="poison_control_center_address" value="<?= get_var('poison_control_center_address', $row[0]->poison_control_center_address) ?>" required />
                    </div>
                </div>

                <!-- Burn Center Information -->
                <div class="form-row">
                    <div class="form-column">
                        <label for="burn_center">Burn Center</label>
                        <input type="text" id="burn_center" name="burn_center" value="<?= get_var('burn_center', $row[0]->burn_center) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="burn_center_contact">Burn Center Contact</label>
                        <input type="text" id="burn_center_contact" name="burn_center_contact" value="<?= get_var('burn_center_contact', $row[0]->burn_center_contact) ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="burn_center_address">Burn Center Address</label>
                        <input type="text" id="burn_center_address" name="burn_center_address" value="<?= get_var('burn_center_address', $row[0]->burn_center_address) ?>" required />
                    </div>
                </div>

                <div class="center-button">
                    <button>Save</button>
                </div>
            </form>
        </div>
    </div>
</main>