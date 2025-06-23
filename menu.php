<?php
require_once 'db.php';

?>
<div class="boutiques">
    <?php foreach($recup as $boutique): ?>
        <div class="boutique">
            <a href="boutiques.php?id=<?php echo htmlspecialchars($boutique['id']); ?>">
                <h3><?php echo htmlspecialchars($boutique['nom']); ?></h3>
            </a>
        </div>
    <?php endforeach; ?>
</div>
<div class="trait"></div>
