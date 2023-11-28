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
                        <a href="<?= ROOT ?>/milestone">
                            <button value="Cancel">Cancel</button>
                        </a>
                    </th>
                </thead>
            </table>
        </div>
    </div>
    <div class="add-form">
        <h2>Milestone Information</h2>
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
                    <input style="" class="form-control" value="<?= get_var('name') ?>" type="text" name="name" placeholder="Milestone Name">
                </div>
                <div class="form-row">
                    <input class="form-control" value="<?= get_var('description') ?>" type="text" name="description" placeholder="Description">
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="age_range">Age Range</label>
                        <div class="select-wrapper">
                            <select id="age_range" name="age_range" <?= get_var('age_range') ?>>
                                <option value="" disabled selected>Select</option>
                                <option <?= get_var('age_range') == '1-6 months' ? 'selected' : '' ?> value="1-6 months">1-6 months</option>
                                <option <?= get_var('age_range') == '7-12 months' ? 'selected' : '' ?> value="7-12 months">7-12 months</option>
                                <option <?= get_var('age_range') == '13-18 months' ? 'selected' : '' ?> value="13-18 months">13-18 months</option>
                                <option <?= get_var('age_range') == '19-24 months' ? 'selected' : '' ?> value="19-24 months">19-24 months</option>
                                <option <?= get_var('age_range') == '25-36 months' ? 'selected' : '' ?> value="25-36 months">25-36 months</option>
                                <option <?= get_var('age_range') == '37-48 months' ? 'selected' : '' ?> value="37-48 months">37-48 months</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" value="Create">Create</button>
            </form>
        </div>
    </div>

</main>