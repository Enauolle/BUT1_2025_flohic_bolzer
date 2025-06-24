<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

// Suppression boutique si aucun stock
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supp'], $_POST['id_boutique'])) {
    $idb = (int)$_POST['id_boutique'];
    $stockCount = (int) dbquery("SELECT COUNT(*) AS count FROM stocks WHERE boutique_id = ?", [$idb])[0]['count'];

    if ($stockCount === 0) {
        $supp = $PDO->prepare("DELETE FROM boutiques WHERE id = ?");
        $supp->execute([$idb]);
        header("Location: supergerant.php?deleted=ok");
        exit;
    } else {
        echo "<p style='color:red;'>Impossible de supprimer une boutique avec du stock.</p>";
    }
}

// Ajout d'une boutique
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_boutique'])) {
    // ?? : Si la première valeur n'est pas définie, utilise la seconde, ici une chaîne de charactères vide
    $nom = $_POST['nom'] ?? '';
     $utilisateur_id = $_POST['utilisateur_id'] ?? '';
    $numero_rue = $_POST['numero_rue'] ?? '';
    $nom_adresse = $_POST['nom_adresse'] ?? '';
    $code_postal = $_POST['code_postal'] ?? '';
    $ville = $_POST['ville'] ?? '';
    $pays = $_POST['pays'] ?? '';
    $histoire = $_POST['histoire'] ?? '';
    $image = $_FILES['illustration'] ?? null;

    // Acceptation de tout type de photo
    $fileName = '';
    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        //  On regarde le type du fichier (jpg, png gif, ect)
        $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        // Liste de ceux autorisés
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        // Si type dans liste, c'est ok
        if (in_array($ext, $allowedExts)) {
            // Nom du fichier généré grace au temps et un identifiant unique très precis
            $fileName = time() . '_' . uniqid() . '.' . $ext;
            $targetDir = "img/img_bdd/";
            // On met l'image dans le dossier choisi + Création du dossier si il n'existe pas
            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
                $photoPath = $targetDir . $fileName;
            if (!move_uploaded_file($image['tmp_name'], $photoPath)) {
                echo "<p style='color:red;'>Erreur lors du déplacement du fichier uploadé.</p>";
                $fileName = '';
            }
        } else {
            echo "<p style='color:red;'>Type de fichier non autorisé.</p>";
        }
    } else {
        echo "<p style='color:red;'>Veuillez télécharger une photo de la boutique.</p>";
    }

    if ($fileName) {
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

// Récupération des boutiques
$recuperation = dbquery("SELECT * FROM boutiques ORDER BY nom");
?>

<!-- Affichage des boutiques -->
<div class="boutiques">
    <?php foreach($recuperation as $boutique): ?>
        <div class="boutique">
            <a href="boutiques.php?id=<?= htmlspecialchars($boutique['id']) ?>">
                <?php
                    $baseName = $boutique['illustration'];
                    $imageDir = 'img/img_bdd/';
                    $image = $imageDir . 'default.jpg';
                    // Vérification de l'existence de l'image
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
                <!-- Liens vers les boutiques -->
                <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($boutique['nom']) ?>">
                <h3><?= htmlspecialchars($boutique['nom']) ?></h3>
                <span class="voir-plus">Voir plus &gt;</span>
            </a>

        </div>
        <!-- Bouton supprimer qui apparais que si le stock = 0 (pas besoin de demander si on est admin, c'ette page n'est pas accessible (normalement) par les autres) -->
        <?php
                $stockCount = (int) dbquery("SELECT COUNT(*) AS count FROM stocks WHERE boutique_id = ?", [$boutique['id']])[0]['count'];
                if ($stockCount === 0): ?>
                    <form method="POST" onsubmit="return confirm('Confirmer la suppression ?');" class="form-supp">
                        <input type="hidden" name="id_boutique" value="<?= htmlspecialchars($boutique['id']) ?>">
                        <button type="submit" name="supp" class="boutton-supprimer">Supprimer</button>
                    </form>
            <?php endif; ?>
    <?php endforeach; ?>
</div>

<div class="trait"></div>

<!-- Formulaire d'ajout -->
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

<div>
    <a class="lalaland" href="ajout_bonbon.php"> Ajouter des bonbons</a>
</div>

<div class="banniere">
    <img src="img/banniere2.jpg" alt="Bannière">
</div>

<script src="script.js"></script>

<?php include_once("footer.php"); ?>
