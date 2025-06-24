<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

if (!isset($PDO) || $PDO === null) {
    die("Erreur : Connexion à la base de données non établie.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supp']) && isset($_POST['id_boutique'])) {
    $idb = (int)$_POST['id_boutique'];

    $stmtCheck = $PDO->prepare("SELECT COUNT(*) FROM stocks WHERE boutique_id = ?");
    $stmtCheck->execute([$idb]);
    $stockCount = (int)$stmtCheck->fetchColumn();

    if ($stockCount === 0) {
        $stmtDel = $PDO->prepare("DELETE FROM boutiques WHERE id = ?");
        $stmtDel->execute([$idb]);
        header("Location: supergerant.php?deleted=ok");
        exit;
    } else {
        echo "<p style='color:red;'>Impossible de supprimer une boutique avec du stock.</p>";
    }
}

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
        // Insert into DB
        $stmt = $PDO->prepare("
            INSERT INTO boutiques 
            (nom, utilisateur_id, numero_rue, nom_adresse, code_postal, ville, pays, illustration, histoire)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $success = $stmt->execute([
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

$stmtBoutiques = $PDO->query("SELECT * FROM boutiques ORDER BY nom");
$recup = $stmtBoutiques->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="boutiques">
    <?php foreach($recup as $boutique): ?>
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
                $stmtStock = $PDO->prepare("SELECT COUNT(*) FROM stocks WHERE boutique_id = ?");
                $stmtStock->execute([$boutique['id']]);
                $stockCount = (int)$stmtStock->fetchColumn();

                if ($stockCount === 0):
            ?>
                <form method="POST" onsubmit="return confirm('Confirmer la suppression ?');" style="margin-top:10px;">
                    <input type="hidden" name="id_boutique" value="<?= htmlspecialchars($boutique['id']) ?>">
                    <button type="submit" name="supp" class="boutton-supprimer">Supprimer</button>
                </form>
            <?php endif; ?>
    <?php endforeach; ?>
</div>

<div class="trait" ></div>


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

<script src="script.js"></script>

<?php include_once("footer.php"); ?>
