<main>
    <h1>Health Assessment</h1>
    <!-- Analyses -->

    <div class="add-form">
        <h2>Assessment</h2>
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
                        <label for="hearing">Newborn Hearing</label>
                        <input type="date" id="hearing" name="newborn_hearing_date" value="<?php echo date('Y-m-d', strtotime($row[0]->newborn_hearing_date)); ?>" required />
                    </div>
                    <div class="form-column">
                        <label for="screening">Newborn Screening</label>
                        <input type="date" id="screening" name="newborn_screening_date" value="<?php echo date('Y-m-d', strtotime($row[0]->newborn_screening_date)); ?>" required />
                    </div>
                </div>
                <div class="center-button">
                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</main>