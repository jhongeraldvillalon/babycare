<style>
    .button-fixed-width {
        width: 150px;
    }
</style>

<form method="post">
    <div class="container-fluid">
        <div class="p-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width:500px;">
            <center>
                <h3>Forgot Password</h3>
                <p>Enter your new password below</p>
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
                <input name="password" value="<?= get_var('password') ?>" type="password" class="form-control" id="floatingInput" placeholder="Password" autofocus>

                <label for="floatingInput">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input name="password2" value="<?= get_var('password2') ?>" type="password" class="form-control" id="floatingInput" placeholder="Retype Password" autofocus>
                <label for="floatingInput">Retype Password</label>
            </div>

            <div class="row" style="margin-top: 10px;">
                <!-- Submit Button -->
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary button-fixed-width">Reset Password</button>
                </div>
                <!-- Start Over Link -->
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <a class="btn btn-primary button-fixed-width" href="<?= ROOT ?>/forgotPassword">Start Over</a>
                </div>
                <!-- Cancel Link -->
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <a class="btn btn-primary button-fixed-width" href="<?= ROOT ?>/login">Cancel</a>
                </div>
            </div>

        </div>
    </div>
</form>