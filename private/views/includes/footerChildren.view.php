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
        // Check for overdue immunizations
        $immunizationsController = new Immunization();
        $overdueImmunizations = checkOverdueImmunizations(child_id_URL_milestone());
        $immunizationCount = count($overdueImmunizations);
        $immunizationText = ($immunizationCount !== 1) ? "immunizations" : "immunization";

        if (!empty($overdueImmunizations)) {
            echo "<div class='immunization-errors' style='margin-top: 10px;'>";
            echo "<a href='" . ROOT . "/immunizations/" . $row->child_id  . "'>";
            echo "<div class='notifications deactive'>";
            echo "<div class='icon'>";
            echo "<span class='material-icons-sharp'>warning</span>";
            echo "</div>";
            echo "<p>Your child has $immunizationCount overdue $immunizationText</p>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
        }
        ?>
        <?php if (!empty($milestone_errors)) : ?>
            <div class="milestone_errors" style="margin-top: 10px;">
                <?php
                $errorCount = count($milestone_errors);
                $errorText = "goal";
                if ($errorCount !== 1) {
                    $errorText = "goals";
                }

                ?>

                <a href="<?= ROOT ?>/milestonestracker/<?= $row->child_id ?>">
                    <div class="notifications deactive">
                        <div class="icon">
                            <span class="material-icons-sharp">
                                warning
                            </span>
                        </div>
                        <p>Your child have <?php echo $errorCount; ?> important <?php echo $errorText; ?> issue in the milestones tracker</p>
                    </div>
                </a>

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