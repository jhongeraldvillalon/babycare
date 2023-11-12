<main>

    <div class="add-form">
        <div class="form-section">
            <table style="margin-top: -20px;">
                <thead>
                    <th style="padding-right: 500px; width: 2000px;">

                    </th>
                    <th style="padding-right: 20px;">

                    </th>
                    <th>
                        <a href="<?= ROOT ?>/children">
                            <button value="Cancel">Cancel</button>
                        </a>
                    </th>
                </thead>
            </table>
        </div>
    </div>
    <div class="add-form">
        <h2>Personal Information</h2>
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
                    <input style="" class="form-control" value="<?= get_var('first_name') ?>" type="text" name="first_name" placeholder="First Name">
                    <input style="margin-left: 20px;" class="form-control" value="<?= get_var('middle_name') ?>" type="text" name="middle_name" placeholder="Middle Name">
                    <input style="margin-left: 20px;" class="form-control" value="<?= get_var('last_name') ?>" type="text" name="last_name" placeholder="Last Name">
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="gender">Gender</label>
                        <div class="select-wrapper">
                            <select id="gender" name="gender" <?= get_var('gender') ?>>
                                <option value="" disabled selected>Select</option>
                                <option <?= get_var('gender') == 'male' ? 'selected' : '' ?> value="male">Male</option>
                                <option <?= get_var('gender') == 'female' ? 'selected' : '' ?> value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <label for="birthday">Birth Date</label>
                        <input type="date" id="birthday" name="birth_date" value="<?= get_var('birth_date') ?>" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="blood_type">Blood Type</label>
                        <div class="select-wrapper">
                            <select id="blood_type" name="blood_type">
                                <option value="" disabled selected>Select</option>
                                <option <?= get_var('blood_type') == 'O' ? 'selected' : '' ?> value="O">O</option>
                                <option <?= get_var('blood_type') == 'A' ? 'selected' : '' ?> value="A">A</option>
                                <option <?= get_var('blood_type') == 'B' ? 'selected' : '' ?> value="B">B</option>
                                <option <?= get_var('blood_type') == 'AB' ? 'selected' : '' ?> value="AB">AB</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-column">
                        <label for="delivery">Mode of Delivery</label>
                        <input type="text" id="delivery" name="delivery" value="<?= get_var('delivery') ?>" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="birth_place">Place of Birth</label>
                        <input type="text" id="birth_place" name="birth_place" value="<?= get_var('birth_place') ?>" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="birth_type">Type of Birth</label>
                        <div class="select-wrapper">
                            <select id="birth_type" name="birth_type">
                                <option value="" disabled selected>Select</option>
                                <option <?= get_var('birth_type') == 'Singleton' ? 'selected' : '' ?> value="Singleton">Singleton</option>
                                <option <?= get_var('birth_type') == 'Twins' ? 'selected' : '' ?> value="Twins">Twins</option>
                                <option <?= get_var('birth_type') == 'Triplets' ? 'selected' : '' ?> value="Triplets">Triplets</option>
                                <option <?= get_var('birth_type') == 'Quadruplets' ? 'selected' : '' ?> value="Quadruplets">Quadruplets</option>
                                <option <?= get_var('birth_type') == 'Quintuplets' ? 'selected' : '' ?> value="Quintuplets">Quintuplets</option>
                                <option <?= get_var('birth_type') == 'Sextuplets' ? 'selected' : '' ?> value="Sextuplets">Sextuplets</option>
                                <option <?= get_var('birth_type') == 'Septuplets' ? 'selected' : '' ?> value="Septuplets">Septuplets</option>
                                <option <?= get_var('birth_type') == 'Octuplets' ? 'selected' : '' ?> value="Octuplets">Octuplets</option>
                                <option <?= get_var('birth_type') == 'Nonuplets' ? 'selected' : '' ?> value="Nonuplets">Nonuplets</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-column">
                        <label for="multiple">If Multiple Birth, Child Was</label>
                        <div class="select-wrapper">
                            <select id="multiple" name="multiple">
                                <option value="" disabled <?= get_var('multiple') == '' ? 'selected' : '' ?>>Select</option>
                                <option <?= get_var('multiple') == 'N/A' ? 'selected' : '' ?> value="N/A">N/A</option>
                                <option <?= get_var('multiple') == 'First' ? 'selected' : '' ?> value="First">First</option>
                                <option <?= get_var('multiple') == 'Second' ? 'selected' : '' ?> value="Second">Second</option>
                                <option <?= get_var('multiple') == 'Third' ? 'selected' : '' ?> value="Third">Third</option>
                                <option <?= get_var('multiple') == 'Fourth' ? 'selected' : '' ?> value="Fourth">Fourth</option>
                                <option <?= get_var('multiple') == 'Fifth' ? 'selected' : '' ?> value="Fifth">Fifth</option>
                                <option <?= get_var('multiple') == 'Sixth' ? 'selected' : '' ?> value="Sixth">Sixth</option>
                                <option <?= get_var('multiple') == 'Seventh' ? 'selected' : '' ?> value="Seventh">Seventh</option>
                                <option <?= get_var('multiple') == 'Eight' ? 'selected' : '' ?> value="Eight">Eight</option>
                                <option <?= get_var('multiple') == 'Ninth' ? 'selected' : '' ?> value="Ninth">Ninth</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="mother">Mother</label>
                        <input type="text" id="mother" name="mother" value="<?= get_var('mother') ?>" />
                    </div>
                    <div class="form-column">
                        <label for="father">Father</label>
                        <input type="text" id="father" name="father" value="<?= get_var('father') ?>" />
                    </div>
                </div>


                <button type="submit" value="Create">Create</button>
            </form>
        </div>
    </div>

</main>