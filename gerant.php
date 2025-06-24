<?php
include_once("header.php"); // session_start supposé dans header.php
include_once("menu.php");
include_once("db.php");

// Récupération de l'ID boutique depuis l'URL
$idb = isset($_GET['idb']) ? (int)$_GET['idb'] : null;

if (!$idb) {
    echo "<p style='color:red;'>Boutique non spécifiée.</p>";
    exit;
}

// Récupérer infos boutique
$recup = dbquery("SELECT * FROM boutiques WHERE id = ?", [$idb]);
if (empty($recup)) {
    echo "<p style='color:red;'>Boutique introuvable.</p>";
    exit;
}
$boutique = $recup[0];

// Récupérer toutes les confiseries (pour menu ajout bonbon)
$recup2 = dbquery("SELECT * FROM confiseries ORDER BY nom");

// Récupérer stocks de cette boutique
$recup3 = dbquery("SELECT * FROM stocks WHERE boutique_id = ?", [$idb]);

// Connexion PDO depuis db.php (ex: $PDO)
// Gestion des POST (modification stock, suppression, ajout)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['changer'])) {
        $nv_quantite = max(0, (int)$_POST['nouvelle_quantite']);
        $idc = (int)$_POST['id_produit'];
        $id_boutique = (int)$_POST['id_boutique'];

        $sqlajout = "UPDATE stocks SET quantite = ? WHERE confiserie_id = ? AND boutique_id = ?";
        $stmt = $PDO->prepare($sqlajout);
        $stmt->execute([$nv_quantite, $idc, $id_boutique]);

        header("Location: gerant.php?idb=$id_boutique");
        exit();
    }

    if (isset($_POST['supp'])) {
        $idc = (int)$_POST['id_produit'];
        $id_boutique = (int)$_POST['id_boutique'];

        $sqlsupp = "DELETE FROM stocks WHERE confiserie_id = ? AND boutique_id = ?";
        $stmt = $PDO->prepare($sqlsupp);
        $stmt->execute([$idc, $id_boutique]);

        header("Location: gerant.php?idb=$id_boutique");
        exit();
    }

    if (isset($_POST['bonbon'])) {
        $idp = (int)$_POST['id_produit'];
        $id_boutique = (int)$_POST['id_boutique'];

        // Vérifier si déjà présent pour éviter doublon (optionnel)
        $check = dbquery("SELECT * FROM stocks WHERE confiserie_id = ? AND boutique_id = ?", [$idp, $id_boutique]);
        if (empty($check)) {
            $sqladd = $PDO->prepare("INSERT INTO stocks (confiserie_id, boutique_id, quantite) VALUES (?, ?, 1)");
            $sqladd->execute([$idp, $id_boutique]);
        }

        header("Location: gerant.php?idb=$id_boutique");
        exit();
    }
}
?>

<h1><?php echo htmlspecialchars($boutique['nom']); ?></h1>

<!-- Menu d'ajout de bonbon -->
<div class="dropdown">
    <button class="ajout" id="bouton">Ajouter un bonbon</button>
    <div class="hidden" id="dropdownMenu">
        <?php foreach ($recup2 as $confiserie): ?>
            <form method="post" style="margin:0;">
                <input type="hidden" name="id_produit" value="<?= (int)$confiserie['id'] ?>">
                <input type="hidden" name="id_boutique" value="<?= $idb ?>">
                <button type="submit" name="bonbon" class="bon"><?= htmlspecialchars($confiserie['nom']) ?></button>
            </form>
        <?php endforeach; ?>
    </div>
</div>

<!-- Affichage des bonbons en stock -->
<main class="propro" id="produit">
    <?php
    foreach ($recup3 as $stock):
        foreach ($recup2 as $confiserie):
            if ($confiserie['id'] == $stock['confiserie_id']):
                $imgc = htmlspecialchars($confiserie['illustration']);
                $nomc = htmlspecialchars($confiserie['nom']);
                $prix = htmlspecialchars($confiserie['prix']);
                $desc = htmlspecialchars($confiserie['description']);
                $idc = (int)$confiserie['id'];
    ?>
    <div class="carte">
        <div class="confis">
            <img src="img/img_bdd/<?= $imgc ?>" alt="<?= $nomc ?>">
        </div>
        <h4><?= $nomc ?></h4>
        <p><?= $desc ?></p>
        <p><?= $prix ?> €</p>
        <a href="bonbon.php?confiserie_id=<?= $idc ?>">Voir les détails ></a>

        <form method="post">
            <input type="number" name="nouvelle_quantite" value="<?= (int)$stock['quantite'] ?>" min="0">
            <input type="hidden" name="id_produit" value="<?= $idc ?>">
            <input type="hidden" name="id_boutique" value="<?= $idb ?>">
            <button class="stock" type="submit" name="changer">Changer le stock</button>
            <button class="supp" type="submit" name="supp">Supprimer</button>
        </form>
    </div>
    <?php
            endif;
        endforeach;
    endforeach;
    ?>
</main>

<?php include_once("footer.php"); ?>

<script>
const menu = document.getElementById("dropdownMenu");
const button = document.getElementById("bouton");

button.addEventListener("click", () => {
    menu.classList.toggle("hidden");
    menu.classList.toggle("menu");
});
</script>
