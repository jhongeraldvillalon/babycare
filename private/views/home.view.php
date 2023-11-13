<?php if (Auth::isAdmin()) :  ?>
    <main>
        <br><br><br>
        <div class="analyse">
            <div class="searches">
                <a href="<?= ROOT ?>/users">
                    <div class="status">
                        <div class="info">
                            <h1>Staff</h1>
                            <p>List of staff</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS ?>/staff.png" alt="">
                            <div class="percentage">

                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="searches">
                <a href="<?= ROOT ?>/parents">
                    <div class="status">
                        <div class="info">
                            <h1>Parents</h1>
                            <p>List of parents</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS ?>/parents.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
            <div class="searches">
                <a href="<?= ROOT ?>/children">
                    <div class="status">
                        <div class="info">
                            <h1>Children</h1>
                            <p>List of children</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS ?>/children.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
            <div class="searches">
                <a href="<?= ROOT ?>/management">
                    <div class="status">
                        <div class="info">
                            <h1>Management</h1>
                            <p>Access level</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS ?>/management.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
            <div class="searches">
                <a href="<?= ROOT ?>/management">
                    <div class="status">
                        <div class="info">
                            <h1>Request Access</h1>
                            <p>Access level</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS ?>/management.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
            <div class="searches">
                <a href="<?= ROOT ?>/management">
                    <div class="status">
                        <div class="info">
                            <h1>Logs</h1>
                            <p>Access level</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS ?>/management.png" alt="">
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </main>

    <div class="right-section">
        <div class="nav">
            <button id="menu-btn">
                <span class="material-icons-sharp">
                    menu
                </span>
            </button>

            <div class="profile">
                <div class="info">
                    <p>Hi, <b><?= Auth::getFirst_name() ?></b></p>
                    <small><?= ucwords(str_replace('_', ' ', Auth::getUser_role())) ?></small>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (Auth::isDentist()) :  ?>
    <main>
        <br><br><br>
        <div class="analyse">
            <div class="searches">
                <a href="<?= ROOT ?>/children">
                    <div class="status">
                        <div class="info">
                            <h1>Children</h1>
                            <p>List of children</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS ?>/children.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
            <div class="searches">
                <a href="<?= ROOT ?>/management">
                    <div class="status">
                        <div class="info">
                            <h1>Request Access</h1>
                            <p>Access level</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS ?>/management.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>

    
<?php endif; ?>