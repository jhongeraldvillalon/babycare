<div style="display: flex; justify-content: center;">
    <form autofocus method="post" style="width: 80%; max-width: 600px; margin-left: auto; margin-right: auto; margin-top: 20px;">
        <h4>Remove Staff</h4>
        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-warning alert-dismissible fade show p-0" role="alert">
                <strong>OOPS!</strong>
                <?php foreach ($errors as $error) : ?>
                    <br> <?= $error ?>
                <?php endforeach; ?>
                <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </span>
            </div>
        <?php endif; ?>
        <input type="text" name="name" placeholder="Staff name" class="form-control">
        <button name="search">Search</button>

    </form>
</div>

<div>
    <form method="post">

        <?php if (isset($results) && $results) : ?>
            <div class="analyse">
                <?php foreach ($results as $row) : ?>
                    <?php include(views_path('user')); ?>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <?php if (count($_POST) > 0) : ?>
                <div class="analyse">
                    <p style="margin-top: 20px;margin-left: 135%; width:100%;">No results were found</p>
                </div>

            <?php endif; ?>
        <?php endif; ?>
    </form>
</div>