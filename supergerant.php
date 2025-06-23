<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

if (!isset($PDO) || $PDO === null) {
    die("Erreur : Connexion à la base de données non établie.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $utilisateur_id = $_POST['utilisateur_id'];
    $numero_rue = $_POST['numero_rue'];
    $nom_adresse = $_POST['nom_adresse'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $histoire = $_POST['histoire'];

    $image = $_FILES['illustration'];

    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array(strtolower($ext), $allowedExts)) {
        echo "<p style='color:red;'>Type de fichier non autorisé.</p>";
    } elseif ($image['error'] !== UPLOAD_ERR_OK) {
        echo "<p style='color:red;'>Erreur lors de l'upload de la photo. Code erreur: " . $image['error'] . "</p>";
    } else {
        $fileName = time() . '_' . uniqid() . '.' . $ext;
        $targetDir = "img/img_bdd/";
        $photoPath = $targetDir . $fileName;

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (move_uploaded_file($image['tmp_name'], $photoPath)) {
            try {
                $stmt = $PDO->prepare("
                    INSERT INTO boutiques (
                        nom, utilisateur_id, numero_rue, nom_adresse, code_postal, ville, pays, illustration, histoire
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");

                $success = $stmt->execute([
                    $nom, $utilisateur_id, $numero_rue, $nom_adresse, $code_postal,
                    $ville, $pays, $photoPath, $histoire
                ]);

                if ($success) {
                    header("Location: supergerant.php?ajout=ok");
                    exit;
                } else {
                    echo "<p style='color:red;'>Erreur lors de l'ajout en base de données.</p>";
                }
            } catch (PDOException $e) {
                echo "<p style='color:red;'>Erreur base de données : " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p style='color:red;'>Erreur lors du déplacement du fichier uploadé.</p>";
        }
    }
}
?>

<div class="titre2"> 
    <h2>NOS BOUTIQUES</h2>
</div>
<div class="boutiques">
    <div class="boutique">
        <a href="boutiques.php?id=1">
            <img src="img/img_bdd/B1" alt="La Mika-line">
            <h3>Le Mika-line</h3>
            <span class="voir-plus">Voir plus &gt;</span>
        </a>
        </div>
    <div class="boutique">
        <a href="boutiques.php?id=2">
            <img src="img/img_bdd/B2" alt="Ok Bonbons">
            <h3>Ok Bonbons</h3>
            <span class="voir-plus">Voir plus &gt;</span>
        </a>
    </div>
    <div class="boutique">
        <a href="boutiques.php?id=3">
            <img src="img/img_bdd/B3" alt="Le Saccharo">
            <h3>Le Saccharo</h3>
            <span class="voir-plus">Voir plus &gt;</span>
        </a>
    </div>
</div>

<div class="banniere">
    <img src="img/banniere2.jpg" alt="Bannière">
</div>

<button class="ajouter" id="openFormBtn">Ajouter une boutique</button>

<div id="formPopup" class="popup-hidden">
    <div class="popup-content">
        <button id="closePopup" class="close-btn">&times;</button>
        <h3>Ajouter une boutique</h3>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group full-width">
                <label for="nom">Nom de la boutique :</label>
                <input type="text" id="nom" name="nom" required />
            </div>
            <div class="form-group full-width">
                <label for="utilisateur_id">ID du gérant :</label>
                <input type="text" id="utilisateur_id" name="utilisateur_id" required />
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

<script src="script.js"></script>
<?php include_once("footer.php"); ?>