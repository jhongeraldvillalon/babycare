<form method="post">
    <div class="container-fluid">
        <div class="p-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width:340px;">
            <h2 class="text-center">BabyCare</h2>
            <img src="assets/OLFU_logo.png" alt="logo" class="d-block mx-auto rounded-circle" style="width:100px;">
            <h3>Login</h3>
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
            <input class="form-control" value="<?= get_var('email') ?>" type="email" name="email" id="" placeholder="Email" autofocus>
            <br>
            <input class="form-control" value="<?= get_var('password') ?>" type="password" name="password" id="" placeholder="Password">
            <br>
            <button class="btn btn-primary">Login</button>
        </div>
    </div>

</form>