<div class="container">
    <aside>
        <div class="toggle">
            <div class="logo">
                <img src="<?= ASSETS ?>/logo.png">
                <h2><span class="success">BabyCare</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">
                    close
                </span>
            </div>
        </div>
        <div class="sidebar">
            <?php // Auth::getFirst_name()   
            ?>
            <a href="<?= ROOT ?>">
                <span class="material-icons-sharp">
                    dashboard
                </span>
                <h3>Dashboard </h3>
            </a>
            <?php if (Auth::isAdmin()) :  ?>
                <a href="<?= ROOT ?>/users">
                    <span class="material-icons-sharp">
                        groups
                    </span>
                    <h3>Staff</h3>
                </a>
                <a href="<?= ROOT ?>/parents">
                    <span class="material-icons-sharp">
                        family_restroom
                    </span>
                    <h3>Parents </h3>
                <?php endif; ?>
                </a>
                <a href="<?= ROOT ?>/children">
                    <span class="material-icons-sharp">
                        face
                    </span>
                    <h3>Children </h3>
                </a>
                <!-- <a href="<?php // ROOT 
                                ?>/profile">
                <span class="material-icons-sharp">
                    person_outline
                </span>
                <h3>Profile</h3>
            </a> -->
                <!-- <a href="register.php">
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Register</h3>
            </a> -->

                <a href="<?= ROOT ?>/logout">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
        </div>
    </aside>