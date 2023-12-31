<form method="post">
    <div class="container-fluid">
        <div class="p-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width:500px;">
            <!-- <h2 class="text-center">BabyCare</h2> -->
            <!-- <img src="assets/OLFU_logo.png" alt="logo" class="d-block mx-auto rounded-circle" style="width:100px;"> -->
            <center>
                <h3>Login</h3>
            </center>
            <?php if (count($errors) > 0) : ?>

                <div class="p-3 alert alert-warning alert-dismissible fade show p-0" role="alert">
                    <strong>Alert!</strong>
                    <?php foreach ($errors as $error) : ?>
                        <br> <?= $error ?>
                    <?php endforeach; ?>
                    <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </span>
                </div>
            <?php endif; ?>
            <div class="form-floating mb-3">
                <input name="email" value="<?= get_var('email') ?>" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" autofocus>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input name="password" value="<?= get_var('password') ?>" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="row " style="margin-top: 10px;">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary button-fixed-width">Login</button>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <a href="<?= ROOT ?>/forgotPassword?mode=enter_email" class="btn btn-primary button-fixed-width">Forgot Password</a>
                </div>
            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <a href="<?= ROOT ?>/signup?mode=parents" class="btn btn-primary button-fixed-width">Parent Sign up</a>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <a href="<?= ROOT ?>/signup" class="btn btn-primary button-fixed-width">Medical Sign up</a>
                </div>
            </div>

        </div>
    </div>
</form>