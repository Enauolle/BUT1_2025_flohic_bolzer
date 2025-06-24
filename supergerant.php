<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");


//  Si stock = 0 (pas besoin d'ajouter la deuxieme condition, c'est une page dédiée à l'admin)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supp']) && isset($_POST['id_boutique'])) {
    $idb = (int)$_POST['id_boutique'];

    $countstock = $PDO->prepare("SELECT COUNT(*) FROM stocks WHERE boutique_id = ?");
    $countstock->execute([$idb]);
    $stockCount = (int)$countstock->fetchColumn();


    // Supprimer une boutique
    if ($stockCount === 0) {
        $supp = $PDO->prepare("DELETE FROM boutiques WHERE id = ?");
        $supp->execute([$idb]);
        header("Location: supergerant.php?deleted=ok");
        exit;
    } else {
        echo "<p style='color:red;'>Impossible de supprimer une boutique avec du stock.</p>";
    }
}



// Ajout dans la base de données depuis un formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_boutique'])) {
    $nom = $_POST['nom'] ?? '';
    $utilisateur_id = $_POST['utilisateur_id'] ?? '';
    $numero_rue = $_POST['numero_rue'] ?? '';
    $nom_adresse = $_POST['nom_adresse'] ?? '';
    $code_postal = $_POST['code_postal'] ?? '';
    $ville = $_POST['ville'] ?? '';
    $pays = $_POST['pays'] ?? '';
    $histoire = $_POST['histoire'] ?? '';

    $image = $_FILES['illustration'] ?? null;

    # Pour que ca accepte autant les jpeg que les png
    $fileName = '';
    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($ext, $allowedExts)) {
            $fileName = time() . '_' . uniqid() . '.' . $ext;
            $targetDir = "img/img_bdd/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
            $photoPath = $targetDir . $fileName;
            if (!move_uploaded_file($image['tmp_name'], $photoPath)) {
                echo "<p style='color:red;'>Erreur lors du déplacement du fichier uploadé.</p>";
            }
        } else {
            echo "<p style='color:red;'>Type de fichier non autorisé.</p>";
        }
    } else {
        echo "<p style='color:red;'>Veuillez télécharger une photo de la boutique.</p>";
    }

    if ($fileName) {
        # Insertion dans la bdd
        $insert = $PDO->prepare("
            INSERT INTO boutiques 
            (nom, utilisateur_id, numero_rue, nom_adresse, code_postal, ville, pays, illustration, histoire)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $success = $insert->execute([
            $nom, $utilisateur_id, $numero_rue, $nom_adresse, $code_postal,
            $ville, $pays, $fileName, $histoire
        ]);

        if ($success) {
            header("Location: supergerant.php?ajout=ok");
            exit;
        } else {
            echo "<p style='color:red;'>Erreur lors de l'ajout en base de données.</p>";
        }
    }
}


//  Affichage des boutiques avec la nouvelle
$AffichBoutiqque = $PDO->query("SELECT * FROM boutiques ORDER BY nom");
$recuperation = $AffichBoutiqque->fetchAll(PDO::FETCH_ASSOC);

?>

 <!-- Image dans le dossier img/img_bdd -->
<div class="boutiques">
    <?php foreach($recuperation as $boutique): ?>
        <div class="boutique">
            <a href="boutiques.php?id=<?php echo htmlspecialchars($boutique['id']); ?>">
                <?php
                    $baseName = $boutique['illustration'];
                    $imageDir = 'img/img_bdd/';
                    $image = $imageDir . 'default.jpg'; 

                    if (!empty($baseName)) {
                        if (file_exists($imageDir . $baseName)) {
                            $image = $imageDir . $baseName;
                        } else {
                            $baseNoExt = pathinfo($baseName, PATHINFO_FILENAME); // enleve extension s'il y en a
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
        <?php
                $countstock = $PDO->prepare("SELECT COUNT(*) FROM stocks WHERE boutique_id = ?");
                $countstock->execute([$boutique['id']]);
                $stockCount = (int)$countstock->fetchColumn();
            
            if ($stockCount === 0): ?>
                <form method="POST" onsubmit="return confirm('Confirmer la suppression ?');" class="form-supp">
                    <input type="hidden" name="id_boutique" value="<?= htmlspecialchars($boutique['id']) ?>">
                    <button type="submit" name="supp" class="boutton-supprimer">Supprimer</button>
                </form>
            <?php endif; ?>
    <?php endforeach; ?>
</div>


<div class="trait" ></div>

<!--  Formulaire d'ajout -->
<button class="ajouter" id="openFormBtn">Ajouter une boutique</button>

<div id="formPopup" class="popup-hidden">
    <div class="popup-content">
        <button id="closePopup" class="close-btn">&times;</button>
        <h3>Ajouter une boutique</h3>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="add_boutique" value="1" />
            <div class="form-group full-width">
                <label for="nom">Nom de la boutique :</label>
                <input type="text" id="nom" name="nom" required />
            </div>
            <div class="form-group full-width">
                <label for="utilisateur_id">ID du gérant :</label>
                <input type="number" id="utilisateur_id" name="utilisateur_id" required />
            </div>
            <div class="form-group full-width">
                <label for="numero_rue">Numéro de rue :</label>
                <input type="text" id="numero_rue" name="numero_rue" required />
            </div>
            <div class="form-group full-width">
                <label for="nom_adresse">Nom de rue :</label>
                <input type="text" id="nom_adresse" name="nom_adresse" required />
            </div>
            <div class="form-group full-width">
                <label for="code_postal">Code postal :</label>
                <input type="text" id="code_postal" name="code_postal" required />
            </div>
            <div class="form-group full-width">
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required />
            </div>
            <div class="form-group full-width">
                <label for="pays">Pays :</label>
                <input type="text" id="pays" name="pays" required />
            </div>
            <div class="form-group full-width">
                <label for="illustration">Photo de la boutique :</label>
                <input type="file" id="illustration" name="illustration" accept="image/*" required />
            </div>
            <div class="form-group full-width">
                <label for="histoire">Histoire de la boutique :</label>
                <textarea id="histoire" name="histoire" required></textarea>
            </div>
            <button type="submit" class="ajouter">Ajouter la boutique</button>
        </form>
    </div>
</div>
<div class="banniere">
    <img src="img/banniere2.jpg" alt="Bannière">
</div>

<div>
    <a class="lalaland" href="ajout_bonbon.php"> Ajouter des bonbons</a>
</div>


<script src="script.js"></script>

<?php include_once("footer.php"); ?>
