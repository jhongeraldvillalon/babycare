<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php // $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>
    <?php if ($row) { ?>
        <div class="card-group justify-content-center">
            <form method="post">
                <h4>Edit Hospital</h4>
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

                <input autofocus class="form-control" value="<?= get_var('hospital', $row[0]->hospital) ?>" type="text" name="hospital" placeholder="Hospital Name">
                <br>
                <input class="btn btn-primary float-end" type="submit" value="Save">
                <a href="<?= ROOT ?>/hospitals">
                    <input class="btn btn-danger text-white" type="button" value="Cancel">
                </a>
            </form>

        </div>
    <?php } else { ?>
        <div style="text-align:center;">
            <p>That hospital can't be found</p>
            <a href="<?= ROOT ?>/hospitals">

                <input class="btn btn-danger text-white" type="button" value="Cancel">
            </a>
        </div>
    <?php } ?>

</div>