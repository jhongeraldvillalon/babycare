<?php 
if (Auth::isLoggedIn() && !Auth::isAdmin()) {
    $this->redirect("home");
}

?>

<div class=" mw-50">
    <form method="post" enctype="multipart/form-data">
        <div class="p-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width:340px;">
            <!-- <h2 class="text-center">BabyCare</h2> -->
            <!-- <img src="assets/OLFU_logo.png" alt="logo" class="d-block mx-auto rounded-circle" style="width:100px;"> -->
            <?php if ($mode == 'parents') : ?>
                <h3>Parent Sign Up</h3>
            <?php else : ?>
                <h3>Staff Sign Up</h3>
            <?php endif; ?>

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
            <p>Basic Information</p>
            <input class="my-2 form-control" value="<?= get_var('first_name') ?>" type="first_name" name="first_name" placeholder="First Name">
            <input class="my-2 form-control" value="<?= get_var('middle_name') ?>" type="middle_name" name="middle_name" placeholder="Middle Name">
            <input class="my-2 form-control" value="<?= get_var('last_name') ?>" type="last_name" name="last_name" placeholder="Last Name">

            <input class="my-2 form-control" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email">
            <input class="my-2 form-control" value="<?= get_var('contact') ?>" type="contact" name="contact" placeholder="Contact">

            <?php if ($mode !== 'parents') : ?>
                <p>Identification Card</p>
                <div class="text-center">
                    <label class="btn-sm btn btn-info text-white" for="image_browser">
                        <input id="image_browser" onchange="display_image_name(this.files[0].name)" class="my-2 form-control" value="" type="file" name="id_card" style="display:none;" placeholder="Identification Card">
                        Identification Card
                    </label>
                    <small class="file_info text-muted"></small>
                </div>
            <?php endif; ?>

            <p>Gender</p>
            <select class="my-2 form-control" name="gender">
                <option <?= get_select('gender', '') ?> value="">--Select a Gender--</option>
                <option <?= get_select('gender', 'male') ?> value="male">Male</option>
                <option <?= get_select('gender', 'female') ?> value="female">Female</option>
            </select>

            <?php if ($mode == 'parents') : ?>
                <input hidden type="text" value="parent" name="user_role">
            <?php else : ?>
                <select class="my-2 form-control" name="user_role">
                    <option <?= get_select('user_role', '') ?> value="">--Select a Type--</option>
                    <option <?= get_select('user_role', 'obgyne') ?> value="obgyne">Ob/Gyne</option>
                    <option <?= get_select('user_role', 'dentist') ?> value="dentist">Dentist</option>
                    <option <?= get_select('user_role', 'pediatrician') ?> value="pediatrician">Pediatrician</option>
                    <?php if (Auth::getUser_role() == 'super_admin') :
                    ?>
                        <option <?= get_select('user_role', 'admin') ?> value="admin">Admin</option>

                        <!-- <option <?= get_select('user_role', 'super_admin') ?> value="super_admin">Super Admin</option> -->
                    <?php endif;
                    ?>
                </select>
            <?php endif; ?>
            <p>Password</p>

            <input class="my-1 form-control" value="<?= get_var('password') ?>" type="password" name="password" id="" placeholder="Password">
            <input class="my-1 form-control" value="<?= get_var('password2') ?>" type="password" name="password2" id="" placeholder="Retype Password">
            <br>
            <button class="btn btn-primary float-end">Register</button>

            <?php if ($mode == 'parents') : ?>
                <a href="<?= ROOT ?>/parents">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            <?php else : ?>
                <a href="<?= ROOT ?>/users">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 20px;">
        <?php if ($mode == 'parents') : ?>
            <div class="col-sm text-center">
                <a href="<?= ROOT ?>/signup" class="btn btn-success mb-2">Sign up for Staff</a>
            </div>
        <?php else : ?>
            <div class="col-sm text-center">
                <a href="<?= ROOT ?>/signup?mode=parents" class="btn btn-success mb-2">Sign up for Parents</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function display_image_name(file_name) {
        document.querySelector(".file_info").innerHTML = file_name;
    }
</script>