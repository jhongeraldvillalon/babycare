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
                        <a href="<?= ROOT ?>/milestones">
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
                                <option <?= get_var('age_range') == '1' ? 'selected' : '' ?> value="6">1 month</option>
                                <option <?= get_var('age_range') == '2' ? 'selected' : '' ?> value="6">2 months</option>
                                <option <?= get_var('age_range') == '4' ? 'selected' : '' ?> value="4">3-4 months</option>
                                <option <?= get_var('age_range') == '6' ? 'selected' : '' ?> value="6">5-6 months</option>
                                <option <?= get_var('age_range') == '8' ? 'selected' : '' ?> value="8">7-8 months</option>
                                <option <?= get_var('age_range') == '10' ? 'selected' : '' ?> value="10">9-10 months</option>
                                <option <?= get_var('age_range') == '12' ? 'selected' : '' ?> value="12">11-12 months</option>
                                <option <?= get_var('age_range') == '18' ? 'selected' : '' ?> value="18">13-18 months</option>
                                <option <?= get_var('age_range') == '24' ? 'selected' : '' ?> value="24">19-24 months</option>
                                <option <?= get_var('age_range') == '36' ? 'selected' : '' ?> value="36">25-36 months</option>
                                <option <?= get_var('age_range') == '48' ? 'selected' : '' ?> value="48">37-48 months</option>
                                <option <?= get_var('age_range') == '60' ? 'selected' : '' ?> value="60">49-60 months</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <label for="category">Category</label>
                        <div class="select-wrapper">
                            <select id="category" name="category" <?= get_var('category') ?>>
                                <option value="" disabled selected>Select</option>
                                <option <?= get_var('category') == 'mental' ? 'selected' : '' ?> value="mental">Mental</option>
                                <option <?= get_var('category') == 'lingual' ? 'selected' : '' ?> value="lingual">Lingual</option>
                                <option <?= get_var('category') == 'social' ? 'selected' : '' ?> value="social">Social</option>
                                <option <?= get_var('category') == 'physical' ? 'selected' : '' ?> value="physical">Physical</option>
                                <option <?= get_var('category') == 'breastfeeding' ? 'selected' : '' ?> value="breastfeeding">Breastfeeding</option>
                                <option <?= get_var('category') == 'play' ? 'selected' : '' ?> value="play">Play</option>
                                <option <?= get_var('category') == 'baby vaccine' ? 'selected' : '' ?> value="baby vaccine">Baby Vaccine</option>
                                <option <?= get_var('category') == 'wellness visit' ? 'selected' : '' ?> value="wellness visit">Wellness Visit</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" value="Create">Create</button>
            </form>
        </div>
    </div>

</main>