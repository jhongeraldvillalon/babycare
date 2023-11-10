<div class="container-fluid">
    <form method="post">
        <div class="p-4 mx-auto shadow rounded" style="margin-top:50px;width:100%;max-width:340px;">
            <h2 class="text-center">BabyCare</h2>
            <img src="assets/OLFU_logo.png" alt="logo" class="d-block mx-auto rounded-circle" style="width:100px;">
            <h3>Add User</h3>

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

            <input class="my-2 form-control" value="<?= get_var('first_name') ?>" type="first_name" name="first_name" placeholder="First Name">
            <input class="my-2 form-control" value="<?= get_var('middle_name') ?>" type="middle_name" name="middle_name" placeholder="Middle Name">
            <input class="my-2 form-control" value="<?= get_var('last_name') ?>" type="last_name" name="last_name" placeholder="Last Name">
            <input class="my-2 form-control" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email">

            <select class="my-2 form-control" name="gender">
                <option <?= get_select('gender', '') ?> value="">--Select a Gender--</option>
                <option <?= get_select('gender', 'male') ?> value="male">Male</option>
                <option <?= get_select('gender', 'female') ?> value="female">Female</option>
            </select>

            <!-- <select class="my-2 form-control" name="role">
                <option value="">--Select a Role--</option>
                <option value="parent">Parent</option>
                <option value="pediatrician">Pediatrician</option>
                <option value="obgyne">OB/Gyne</option>
                <option value="dentist">Dentist</option>
                <option value="admin">Admin</option>
            </select> -->

            <select class="my-2 form-control" name="user_role">
                <option <?= get_select('user_role', '') ?> value="">--Select a Role--</option>
                <option <?= get_select('user_role', 'student') ?> value="student">Student</option>
                <option <?= get_select('user_role', 'reception') ?> value="reception">Reception</option>
                <option <?= get_select('user_role', 'lecturer') ?> value="lecturer">Lecturer</option>
                <option <?= get_select('user_role', 'admin') ?> value="admin">Admin</option>
                <?php if (Auth::getUser_role() == 'super_admin') : ?>
                    <option <?= get_select('user_role', 'super_admin') ?> value="super_admin">Super Admin</option>
                <?php endif; ?>
            </select>

            <input class="my-1 form-control" value="<?= get_var('password') ?>" type="password" name="password" id="" placeholder="Password">
            <input class="my-1 form-control" value="<?= get_var('password2') ?>" type="password" name="password2" id="" placeholder="Retype Password">
            <br>
            <button class="btn btn-primary float-end">Add User</button>
            <a href="<?= ROOT ?>/users">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </div>
    </form>
</div>