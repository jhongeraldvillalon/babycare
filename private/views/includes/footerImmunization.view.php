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

    <div class="reminders">
        <div class="header">
            <h2>Reminders</h2>
            <span class="material-icons-sharp">
                near_me
            </span>
        </div>
        <?php

        $immunizationsController = new Immunization();
        $overdueImmunizations = checkOverdueImmunizations(child_id_URL());
        if (!empty($overdueImmunizations)) {
            echo "<div class='immunization-errors' style='margin-top: 10px;'>";
            foreach ($overdueImmunizations as $immunization) {
                echo '<div class="notifications deactive">';
                echo '<div class="icon">';
                echo '<span class="material-icons-sharp">warning</span>';
                echo '</div>';
                echo '<p>Overdue Immunization: ' . $immunization . '</p>';
                echo '</div>';
            }
            echo "</div>";
        }
        ?>
    </div>
</div>
<script>
    const sideMenu = document.querySelector('aside');
    const menuBtn = document.getElementById('menu-btn');
    const closeBtn = document.getElementById('close-btn');

    const darkMode = document.querySelector('.dark-mode');

    menuBtn.addEventListener('click', () => {
        sideMenu.style.display = 'block';
    })

    closeBtn.addEventListener('click', () => {
        sideMenu.style.display = 'none';
    });

    darkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode-variables');
        darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
        darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
    })
</script>
</body>

</html>