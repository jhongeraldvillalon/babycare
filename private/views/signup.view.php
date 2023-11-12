<div class=" mw-50">
    <form method="post">
        <div class="p-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width:340px;">
            <!-- <h2 class="text-center">BabyCare</h2> -->
            <!-- <img src="assets/OLFU_logo.png" alt="logo" class="d-block mx-auto rounded-circle" style="width:100px;"> -->
            <h3>Sign Up</h3>

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
            <p>Name</p>
            <input class="my-2 form-control" value="<?= get_var('first_name') ?>" type="first_name" name="first_name" placeholder="First Name">
            <input class="my-2 form-control" value="<?= get_var('middle_name') ?>" type="middle_name" name="middle_name" placeholder="Middle Name">
            <input class="my-2 form-control" value="<?= get_var('last_name') ?>" type="last_name" name="last_name" placeholder="Last Name">

            <input class="my-2 form-control" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email">
            <p>Identification Card</p>
            <input class="my-2 form-control" value="" type="file" name="id_card" placeholder="Identification Card">
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
                    <option <?= get_select('user_role', 'parent') ?> value="parent">Parent</option>
                    <option <?= get_select('user_role', 'obstetrician') ?> value="obstetrician">Obstetrician</option>
                    <option <?= get_select('user_role', 'gynecologist') ?> value="gynecologist">Gynecologist</option>
                    <option <?= get_select('user_role', 'dentist') ?> value="dentist">Dentist</option>
                    <option <?= get_select('user_role', 'pediatrician') ?> value="pediatrician">Pediatrician</option>
                    <?php if (Auth::getUser_role() == 'super_admin') :
                    ?>
                        <option <?= get_select('user_role', 'admin') ?> value="admin">Admin</option>

                        <option <?= get_select('user_role', 'super_admin') ?> value="super_admin">Super Admin</option>
                    <?php endif;
                    ?>
                </select>
            <?php endif; ?>

            <input class="my-1 form-control" value="<?= get_var('password') ?>" type="password" name="password" id="" placeholder="Password">
            <input class="my-1 form-control" value="<?= get_var('password2') ?>" type="password" name="password2" id="" placeholder="Retype Password">
            <br>
            <button class="btn btn-primary float-end">Add User</button>

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