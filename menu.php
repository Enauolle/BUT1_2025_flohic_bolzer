<?php
require_once('db.php');
?>
<div class="boutiques_menu">
    <?php foreach($recup as $boutique): ?>
        <div class="boutique_menu">
            <a href="boutiques.php?id=<?php echo htmlspecialchars($boutique['id']); ?>">
                <?php echo htmlspecialchars($boutique['nom']); ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<div class="trait"></div>
