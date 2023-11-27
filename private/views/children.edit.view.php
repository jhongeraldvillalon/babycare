<main>
    <div class="add-form">
        <div class="form-section">
            <?php if ($row) { ?>
                <div>
                    <form method="post">
                        <h4>Edit Child</h4>
                        <?php if (count($errors) > 0) : ?>
                            <div>
                                <strong>Oops</strong>
                                <?php foreach ($errors as $error) : ?>
                                    <br> <?= $error ?>
                                <?php endforeach; ?>
                                <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </span>
                            </div>
                        <?php endif; ?>

                        <input autofocus class="form-control" value="<?= get_var('first_name', $row[0]->first_name) ?>" type="text" name="first_name" placeholder="First Name">
                        <input autofocus class="form-control" value="<?= get_var('middle_name', $row[0]->middle_name) ?>" type="text" name="middle_name" placeholder="Middle Name">
                        <input autofocus class="form-control" value="<?= get_var('last_name', $row[0]->last_name) ?>" type="text" name="last_name" placeholder="Last Name">
                        <br>
                        <div class="form-row">
                            <div class="form-column">
                                <label for="gender">Gender</label>
                                <div class="select-wrapper">
                                    <select id="gender" name="gender" <?= get_var('gender', $row[0]->gender) ?>>
                                        <option value="" disabled selected>Select</option>
                                        <option <?= get_var('gender', $row[0]->gender) == 'male' ? 'selected' : '' ?> value="male">Male</option>
                                        <option <?= get_var('gender', $row[0]->gender) == 'female' ? 'selected' : '' ?> value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-column">
                                <label for="birthday">Birth Date</label>

                                <input type="date" id="birthday" name="birth_date" value="<?= date('Y-m-d', strtotime($row[0]->birth_date)) ?>" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-column">
                                <label for="blood_type">Blood Type</label>
                                <div class="select-wrapper">
                                    <select id="blood_type" name="blood_type">
                                        <option value="" disabled selected>Select</option>
                                        <option <?= get_var('blood_type', $row[0]->blood_type) == 'O' ? 'selected' : '' ?> value="O">O</option>
                                        <option <?= get_var('blood_type', $row[0]->blood_type) == 'A' ? 'selected' : '' ?> value="A">A</option>
                                        <option <?= get_var('blood_type', $row[0]->blood_type) == 'B' ? 'selected' : '' ?> value="B">B</option>
                                        <option <?= get_var('blood_type', $row[0]->blood_type) == 'AB' ? 'selected' : '' ?> value="AB">AB</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-column">
                                <label for="delivery">Mode of Delivery</label>
                                <input type="text" id="delivery" name="delivery" value="<?= get_var('delivery',  $row[0]->delivery) ?>" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-column">
                                <label for="birth_place">Place of Birth</label>
                                <input type="text" id="birth_place" name="birth_place" value="<?= get_var('birth_place', $row[0]->birth_place) ?>" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-column">
                                <label for="birth_type">Type of Birth</label>
                                <div class="select-wrapper">
                                    <select id="birth_type" name="birth_type">
                                        <option value="" disabled selected>Select</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Singleton' ? 'selected' : '' ?> value="Singleton">Singleton</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Twins' ? 'selected' : '' ?> value="Twins">Twins</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Triplets' ? 'selected' : '' ?> value="Triplets">Triplets</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Quadruplets' ? 'selected' : '' ?> value="Quadruplets">Quadruplets</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Quintuplets' ? 'selected' : '' ?> value="Quintuplets">Quintuplets</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Sextuplets' ? 'selected' : '' ?> value="Sextuplets">Sextuplets</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Septuplets' ? 'selected' : '' ?> value="Septuplets">Septuplets</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Octuplets' ? 'selected' : '' ?> value="Octuplets">Octuplets</option>
                                        <option <?= get_var('birth_type', $row[0]->birth_type) == 'Nonuplets' ? 'selected' : '' ?> value="Nonuplets">Nonuplets</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-column">
                                <label for="multiple">If Multiple Birth, Child Was</label>
                                <div class="select-wrapper">
                                    <select id="multiple" name="multiple">
                                        <option value="" disabled <?= get_var('multiple') == '' ? 'selected' : '' ?>>Select</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'N/A' ? 'selected' : '' ?> value="N/A">N/A</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'First' ? 'selected' : '' ?> value="First">First</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'Second' ? 'selected' : '' ?> value="Second">Second</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'Third' ? 'selected' : '' ?> value="Third">Third</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'Fourth' ? 'selected' : '' ?> value="Fourth">Fourth</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'Fifth' ? 'selected' : '' ?> value="Fifth">Fifth</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'Sixth' ? 'selected' : '' ?> value="Sixth">Sixth</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'Seventh' ? 'selected' : '' ?> value="Seventh">Seventh</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'Eight' ? 'selected' : '' ?> value="Eight">Eight</option>
                                        <option <?= get_var('multiple', $row[0]->multiple) == 'Ninth' ? 'selected' : '' ?> value="Ninth">Ninth</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-column">
                                <label for="mother">Mother</label>
                                <input type="text" id="mother" name="mother" value="<?= get_var('mother', $row[0]->mother) ?>" />
                            </div>
                            <div class="form-column">
                                <label for="father">Father</label>
                                <input type="text" id="father" name="father" value="<?= get_var('father', $row[0]->father) ?>" />
                            </div>
                        </div>

                        <button type="submit" value="Save">Save</button>
                        <a href="<?= ROOT ?>/childrensingle/<?= $row[0]->child_id ?>">
                            <input class="cancel" type="button" value="Cancel">
                        </a>
                    </form>
                </div>

            <?php } else { ?>
                <div style="text-align:center;">
                    <p>That child can't be found</p>
                    <a href="<?= ROOT ?>/children">
                        <input class="btn btn-danger text-white" type="button" value="Cancel">
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
</main>