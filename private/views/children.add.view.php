<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php // $this->view('includes/crumbs', ['crumbs' => $crumbs]) 
    ?>
    <div class="card-group justify-content-center">

        <form method="post">
            <h4>Add New Child</h4>
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
            <input class="form-control" value="<?= get_var('first_name') ?>" type="text" name="first_name" placeholder="First Name">
            <input class="form-control" value="<?= get_var('middle_name') ?>" type="text" name="middle_name" placeholder="Middle Name">
            <input class="form-control" value="<?= get_var('last_name') ?>" type="text" name="last_name" placeholder="Last Name">
            <br>
            <input class="btn btn-primary float-end" type="submit" value="Create">
            <a href="<?= ROOT ?>/children">
                <input class="btn btn-danger text-white" type="button" value="Cancel">
            </a>
        </form>

    </div>
</div>