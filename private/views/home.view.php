<main>
    <br><br><br>
    <div class="analyse">
        <div class="searches">
            <a href="<?= ROOT ?>/hospitals">
                <div class="status">
                    <div class="info">
                        <h1>Hospital</h1>
                        <p>List of hospitals</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS ?>/hospital.png" alt="">
                    </div>
                </div>
            </a>
        </div>
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
    <!-- End of Nav -->
    <!-- <div class="user-profile">
        <div class="logo"> -->
    <!-- <img src="images/logo.png"> -->
    <!-- <h2>Baby Dashboard</h2>
        </div>
    </div>
    <div class="reminders">
        <div class="header">
            <h2>Navigate</h2>
            <span class="material-icons-sharp">
                move_up
            </span>
        </div> -->
    <!-- <a href="">
            <div class="notifications ">
                <div class="icon">
                    <span class="material-icons-sharp">
                        looks_one
                    </span>
                </div>
                <div class="content">
                    <div class="info">
                        <h3>First</h3>
                    </div>
                </div>
            </div>
        </a> -->
    <!-- <a href="">
            <div class="notifications deactive">
                <div class="icon">
                    <span class="material-icons-sharp">
                        sentiment_very_satisfied
                    </span>
                </div>
                <div class="content">
                    <div class="info">
                        <h3>Tooth Development</h3>
                    </div>
                </div>
            </div>
        </a> -->
    <!-- <div class="notifications add-reminder">
            <div>
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Add Reminder</h3>
            </div>
        </div> -->
</div>

</div>