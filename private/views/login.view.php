<form method="post">
    <div class="container-fluid">
        <div class="p-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width:340px;">
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
            <div class="float-right">
                <button style="margin-top: 10px;" class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
</form>

<div class="container-fluid">
    <div class="d-flex justify-content-center">
        <div class="p-4 shadow rounded" style="margin-top: 1%; max-width: 340px;">
            <!-- Row for Sign up buttons -->
            <div class="row">
                <div class="col-sm">
                    <a href="<?= ROOT ?>/signup?mode=parents" class="btn btn-success mb-2">Parent Sign up</a>
                </div>
                <div class="col-sm">
                    <a href="<?= ROOT ?>/signup" class="btn btn-success mb-2">Staff Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
