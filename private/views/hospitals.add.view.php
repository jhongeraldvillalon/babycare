<main>
    <div class="recent-orders">
        <div class="add-form">
            <div class="form-section">
                <form method="post">
                    <h4>Add New Hospital</h4>
                    <?php if (count($errors) > 0) : ?>

                        <div class="alert alert-warning alert-dismissible fade show p-0" role="alert">
                            <strong>Oops</strong>
                            <?php foreach ($errors as $error) : ?>
                                <br> <?= $error ?>
                            <?php endforeach; ?>
                            <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </span>
                        </div>

                    <?php endif; ?>
                    <input autofocus class="form-control" value="<?= get_var('hospital') ?>" type="text" name="hospital" placeholder="Hospital Name">

                    <div class="center-button">
                        <button type="submit" value="Save">Save</button>
                    </div>
                    <div class="center-button">
                        <a href="<?= ROOT ?>/hospitals">
                            <button value="Cancel">Cancel</button>
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</main>