<main>
    <div class="add-form">
        <div class="form-section">
            <?php if ($row) { ?>
                <div>
                    <form method="post">
                        <h4>Granting Access</h4>
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


                        <div class="form-row">
                            <div class="form-column">
                                <label for="approve">Are you sure?</label>
                                <input type="hidden" id="approve" name="approve" value="1" />
                            </div>

                        </div>

                        <button type="submit" value="Save">Approve</button>
                        <a href="<?= ROOT ?>/children">
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