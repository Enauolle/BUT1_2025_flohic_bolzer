<?php
include_once("header.php");
include_once("menu.php");  
include_once("db.php");


// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    echo "<p style='color:red;'>Vous devez être connecté pour voir vos boutiques.</p>";
    exit;
}

$gerant_id = $_SESSION['id']; // ID du gérant connecté

// Récupération des boutiques dont le gérant est l'utilisateur connecté
$recup_mes_boutiques = dbquery("SELECT * FROM boutiques WHERE utilisateur_id = ?", [$gerant_id]);

if (empty($recup_mes_boutiques)) {
    echo "<p>Aucune boutique trouvée pour ce gérant.</p>";
} else {
    echo '<div class="boutiques">';
    foreach($recup_mes_boutiques as $boutique): ?>
        <div class="boutique">
            <a href="gerant.php?idb=<?php echo htmlspecialchars($boutique['id']); ?>">
                <?php
                    $baseName = $boutique['illustration'];
                    $imageDir = 'img/img_bdd/';
                    $image = $imageDir . 'default.jpg'; 

                    if (!empty($baseName)) {
                        if (file_exists($imageDir . $baseName)) {
                            $image = $imageDir . $baseName;
                        } else {
                            $baseNoExt = pathinfo($baseName, PATHINFO_FILENAME);
                            if (file_exists($imageDir . $baseNoExt . '.jpg')) {
                                $image = $imageDir . $baseNoExt . '.jpg';
                            } elseif (file_exists($imageDir . $baseNoExt . '.png')) {
                                $image = $imageDir . $baseNoExt . '.png';
                            }
                        }
                    }
                ?>
                <img src="<?php echo htmlspecialchars($image); ?>" 
                     alt="<?php echo htmlspecialchars($boutique['nom']); ?>">
                <h3><?php echo htmlspecialchars($boutique['nom']); ?></h3>
                <span class="voir-plus">Voir plus &gt;</span>
            </a>
        </div>
    <?php endforeach;
    echo '</div>';
}

include_once("footer.php");
?>
