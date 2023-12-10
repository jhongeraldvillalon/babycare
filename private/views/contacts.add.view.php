<main>
    <h1>Contacts</h1>
    <div class="add-form">
        <h2>Add Contact</h2>
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
                        <label for="hospital">Hospital</label>
                        <input type="text" id="hospital" name="hospital" value="<?= get_var('hospital') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="hospital_contact">Hospital Contact</label>
                        <input type="text" id="hospital" name="hospital_contact" value="<?= get_var('hospital_contact') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="hospital_address">Hospital Address</label>
                        <input type="text" id="hospital_address" name="hospital_address" value="<?= get_var('hospital_address') ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="pharmacy">Pharmacy</label>
                        <input type="text" id="pharmacy" name="pharmacy" value="<?= get_var('pharmacy') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="pharmacy_contact">Pharmacy Contact</label>
                        <input type="text" id="pharmacy" name="pharmacy_contact" value="<?= get_var('pharmacy_contact') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="pharmacy_address">Pharmacy Address</label>
                        <input type="text" id="pharmacy_address" name="pharmacy_address" value="<?= get_var('pharmacy_address') ?>" required />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="pharmacy">Ambulance</label>
                        <input type="text" id="ambulance" name="ambulance" value="<?= get_var('ambulance') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="ambulance_contact">Ambulance Contact</label>
                        <input type="text" id="ambulance" name="ambulance_contact" value="<?= get_var('ambulance_contact') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="ambulance_address">Ambulance Address</label>
                        <input type="text" id="ambulance_address" name="ambulance_address" value="<?= get_var('ambulance_address') ?>" required />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="poison_control_center">Poison Control Center</label>
                        <input type="text" id="poison_control_center" name="poison_control_center" value="<?= get_var('poison_control_center') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="poison_control_center_contact">Poison Control Center Contact</label>
                        <input type="text" id="poison_control_center" name="poison_control_center_contact" value="<?= get_var('poison_control_center_contact') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="poison_control_center_address">Poison Control Center Address</label>
                        <input type="text" id="poison_control_center_address" name="poison_control_center_address" value="<?= get_var('poison_control_center_address') ?>" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="burn_center">Burn Center</label>
                        <input type="text" id="burn_center" name="burn_center" value="<?= get_var('burn_center') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="burn_center_contact">Burn Center Contact</label>
                        <input type="text" id="burn_center" name="burn_center_contact" value="<?= get_var('burn_center_contact') ?>" required />
                    </div>

                    <div class="form-column">
                        <label for="burn_center_address">Burn Center Address</label>
                        <input type="text" id="burn_center_address" name="burn_center_address" value="<?= get_var('burn_center_address') ?>" required />
                    </div>
                </div>



                <div class="center-button">
                    <button>Save</button>
                </div>
            </form>
        </div>
</main>