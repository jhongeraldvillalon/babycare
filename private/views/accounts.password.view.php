<main>
    <h1>My Account</h1>
    <div class="add-form">

        <div class="form-section">
            <form method="post" action="<?= ROOT . '/accounts/password' ?>">
                <h2>Update Password Information</h2>
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
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required />
                    </div>
                    <div class="form-column">
                        <label for="password2">Retype Password</label>
                        <input type="password" id="password2" name="password2" required />
                    </div>
                </div>

                <div class="center-button">
                    <button>Save</button>
                </div>
            </form>
        </div>

    </div>
</main>