<?php if(isset($error)): ?>
    <?php foreach($error as $err): ?>
        <div class="alert alert-danger"><?= $err; ?></div>
    <?php endforeach; ?>
<?php endif; ?>