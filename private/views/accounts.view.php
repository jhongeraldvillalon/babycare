<main>
    <h1>My Account</h1>
    <div class="add-form">
        <h2>Update Account Information</h2>
        <div class="form-section">
            <form method="post" action="<?= ROOT . '/accounts/updateInfo' ?>">
                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-warning alert-dismissible fade show p-0" role="alert">
                        <strong>Oops</strong>
                        <?php foreach ($errors as $error) : ?>
                            <br> <?= $error ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>


                <div class="form-row">
                    <div class="form-column">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="<?= get_var('first_name', $rows->first_name) ?>" />
                    </div>
                    <div class="form-column">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" value="<?= get_var('middle_name', $rows->middle_name) ?>" />
                    </div>
                    <div class="form-column">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="<?= get_var('last_name', $rows->last_name) ?>" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?= get_var('email', $rows->email) ?>" />
                    </div>
                    <div class="form-column">
                        <label for="gender">Gender</label>
                        <div class="select-wrapper">
                            <select id="gender" name="gender">
                                <option value="male" <?= get_var('gender', $rows->gender) == 'male' ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?= get_var('gender', $rows->gender) == 'female' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-column">
                        <label for="contact">Contact</label>
                        <input type="contact" id="contact" name="contact" value="<?= get_var('contact', $rows->contact) ?>" />
                    </div>
                </div>

                <div class="center-button">
                    <button>Save</button>
                </div>
                <div class="center-button">
                    <a href="<?= ROOT . '/accounts/password' ?>">Go to Password</a>
                </div>
            </form>
        </div>


    </div>
</main>