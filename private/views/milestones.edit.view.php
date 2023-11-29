<main>
    <div class="add-form">
        <div class="form-section">
            <?php if ($row) { ?>
                <div>
                    <form method="post">
                        <h2>Milestone Information</h2>
                        <div class="form-section">

                            <?php if (count($errors) > 0) : ?>
                                <div class="alert alert-warning alert-dismissible fade show p-0" role="alert">
                                    <strong>Oops</strong>
                                    <?php foreach ($errors as $error) : ?>
                                        <br> <?= $error ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-row">
                                <input style="" class="form-control" value="<?= get_var('name',  $row[0]->name) ?>" type="text" name="name" placeholder="Milestone Name">

                            </div>
                            <div class="form-row">
                                <input class="form-control" value="<?= get_var('description',  $row[0]->description) ?>" type="text" name="description" placeholder="Description">
                            </div>
                            <div class="form-row">
                                <div class="form-column">
                                    <label for="age_range">Age Range</label>
                                    <div class="select-wrapper">
                                        <select id="age_range" name="age_range" <?= get_var('age_range',  $row[0]->age_range) ?>>
                                            <option value="" disabled selected>Select</option>
                                            <option <?= get_var('age_range',  $row[0]->age_range) == '6' ? 'selected' : '' ?> value="6">1-6 months</option>
                                            <option <?= get_var('age_range',  $row[0]->age_range) == '12' ? 'selected' : '' ?> value="12">7-12 months</option>
                                            <option <?= get_var('age_range',  $row[0]->age_range) == '18' ? 'selected' : '' ?> value="18">13-18 months</option>
                                            <option <?= get_var('age_range',  $row[0]->age_range) == '24' ? 'selected' : '' ?> value="24">19-24 months</option>
                                            <option <?= get_var('age_range',  $row[0]->age_range) == '36' ? 'selected' : '' ?> value="36">25-36 months</option>
                                            <option <?= get_var('age_range',  $row[0]->age_range) == '48' ? 'selected' : '' ?> value="48">37-48 months</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-column">
                                    <label for="disabled">Status</label>
                                    <div class="select-wrapper">
                                        <select id="disabled" name="disabled" <?= get_var('disabled',  $row[0]->disabled) ?>>
                                            <option value="" disabled selected>Select</option>
                                            <option <?= get_var('disabled',  $row[0]->disabled) == '1' ? 'selected' : '' ?> value="1">Disabled</option>
                                            <option <?= get_var('disabled',  $row[0]->disabled) == '0' ? 'selected' : '' ?> value="0">Enable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" value="Save">Save</button>
                        <a href="<?= ROOT ?>/milestones">
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