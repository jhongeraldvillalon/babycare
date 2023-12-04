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
        <?php if (!empty($milestone_errors)) : ?>
            <div class="milestone_errors" style="margin-top: 10px;">
                <?php
                $errorCount = count($milestone_errors);
                $errorText = ($errorCount !== 1) ? "goals" : "goal";
                $showLimit = 2;

                for ($i = 0; $i < min($errorCount, $showLimit); $i++) {
                    echo '<div class="notifications deactive">';
                    echo '<div class="icon">';
                    echo '<span class="material-icons-sharp">warning</span>';
                    echo '</div>';
                    echo '<p>Your child has an important issue in the milestones tracker: ' . $milestone_errors[$i] . '</p>';
                    echo '</div>';
                }

                if ($errorCount > $showLimit) {
                    
                    echo '<a href="?tab=goals">Show more...</a>';
                }
                ?>
            </div>
        <?php endif; ?>
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