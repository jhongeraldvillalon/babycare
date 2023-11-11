<style>
    nav ul li a:hover {
        color: green !important;
    }

    nav ul li a {
        color: green !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
    <a class="navbar-brand" href="#">
        <img src="<?= ASSETS ?>/OLFU_logo.png" alt="logo" style="width:40px;">

        BabyCare: <?= Auth::getHospital_name()   ?> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?= ROOT ?>">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>/hospitals">Hospital</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>/users">Staff</a>
            </li>
            <li class="nav-item">
                <!-- parent -->
                <a class="nav-link" href="<?= ROOT ?>/parents">Parent</a>
                <!-- parent -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>/children">Children</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= ROOT ?>/tests">Tests</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= Auth::getFirst_name()   ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?= ROOT ?>/profile">Profile</a>
                    <a class="dropdown-item" href="<?= ROOT ?>">Dashboard</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= ROOT ?>/logout">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>