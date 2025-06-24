<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

// ajout d'un bonbon
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_bonbon'])) {
    $nombo = $_POST['nom_bonbon'] ?? '';
    $typebo = $_POST['type_bonbon'] ?? '';
    $prixbo = $_POST['prix_bonbon'] ?? '';
    $description = $_POST['description_bonbon'] ?? '';

    $imagebo = $_FILES['illustration_bonbon'] ?? null;

    // Valider l'image
    $fileNameb = '';
    if ($imagebo && $imagebo['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($imagebo['name'], PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($ext, $allowedExts)) {
            $fileNameb = time() . '_' . uniqid() . '.' . $ext;
            $targetDir = "img/img_bdd/";
            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);
            $photoPath = $targetDir . $fileNameb;
            if (!move_uploaded_file($imagebo['tmp_name'], $photoPath)) {
                echo "<p style='color:red;'>Erreur lors du déplacement du fichier uploadé.</p>";
            }
        } else {
            echo "<p style='color:red;'>Type de fichier non autorisé.</p>";
        }
    } else {
        echo "<p style='color:red;'>Veuillez télécharger une photo de la boutique.</p>";
    }

    if ($fileNameb) {
        $sqlajoutb = $PDO->prepare("
            INSERT INTO confiseries 
            (nom, type, prix, illustration, description)
            VALUES (?, ?, ?, ?, ?)
        ");
        $success = $sqlajoutb->execute([
            $nombo, $typebo, $prixbo, $fileNameb, $description
        ]);

        if ($success) {
            header("Location: supergerant.php?ajout=ok");
            exit;
        } else {
            echo "<p style='color:red;'>Erreur lors de l'ajout en base de données.</p>";
        }
    }
}


?>
<a class="retour" href="#" onclick="history.back(); return false;">Retour à la page précedente</a>
<h1>Catalogue de Bonbons</h1>
<button class="ajout" id="openFormBtn">Ajouter un bonbon</button>

<div id="formPopup" class="popup-hidden">
    <div class="popup-content">
        <button id="closePopup" class="close-btn">&times;</button>
        <h3>Ajouter un bonbon</h3>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="add_bonbon" value="1" />
            <div class="form-group full-width">
                <label for="nom_bonbon">Nom du bonbon :</label>
                <input type="text" id="nom_bonbon" name="nom_bonbon" required />
            </div>
            <div class="form-group full-width">
                <label for="type_bonbon">Type :</label>
                <input type="text" id="type_bonbon" name="type_bonbon" required />
            </div>
            <div class="form-group full-width">
                <label for="prix_bonbon">Prix :</label>
                <input type="number" id="prix_bonbon" name="prix_bonbon" required />
            </div>
            <div class="form-group full-width">
                <label for="illustration_bonbon">Photo du bonbon :</label>
                <input type="file" id="illustration_bonbon" name="illustration_bonbon" accept="image/*" required />
            </div>
            <div class="form-group full-width">
                <label for="description_bonbon">Description :</label>
                <textarea id="description_bonbon" name="description_bonbon" required></textarea>
            </div>
            <button type="submit" class="ajouter">Ajouter le bonbon</button>
        </form>
    </div>
</div>

<main class="propro">
<?php
foreach ($recup2 as $confiseries) {
    $imgc = $confiseries['illustration'];
    $nomc = $confiseries['nom'];
    $prix = $confiseries['prix'];
    $idc = $confiseries['id'];

    echo('<div class="carte">');
    echo('<div class="confis"> <img src="img/img_bdd/'.$imgc.'"/> </div>');
    echo('<h4>'.$nomc.'</h4>');
    echo('</br>');
    echo($confiseries['description']);
    echo('</br>');
    echo($prix.'€');
    echo('</br></br>');
    echo('<a href="bonbon.php?confiserie_id='.$idc.'" >Voir les détails ></a>');
    ?>
    <form method="post" action="">
        <input type="hidden" name="id_produit" value="<?php echo $confiseries['id']; ?>">
        <button class="supp" type="submit" name="supp">Supprimer</button>
    </form>
    <?php
    if (isset($_POST['supp'])) {
    $idp = $_POST['id_produit'];

    $sqlsup = "DELETE FROM confiseries WHERE id = $idp";
    $PDO->query($sqlsup);

    echo '<script>window.location.href=" ajout_bonbon.php";</script>'; //rafraichir la page
    exit();
}
    echo('</div>');
}
?>
</main>


<?php
include_once("footer.php");
?>

<script src="script.js"></script>