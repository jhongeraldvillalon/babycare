<div style="display: flex; justify-content: center;">
    <form autofocus method="post" style="width:100%; max-width:400px; margin-top: 20px;">
        <h4>Add Staff</h4>
        <input type="text" name="name" placeholder="Staff name" class="form-control">
        <button>Search</button>
       
    </form>
</div>

<div>
    <div class="analyse">
        <?php if (isset($results) && $results) : ?>
            <?php foreach ($results as $row) : ?>
                <?php include(views_path("user")); ?>
            <?php endforeach; ?>
        <?php else : ?>
            <?php if (count($_POST) > 0) : ?>

                <p style="margin-top: 20px;margin-left: 135%; width:100%;">No results were found</p>


            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>