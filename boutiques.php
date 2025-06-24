<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

$user = $_SESSION['user'] ?? ['role' => 'guest']; // rôle par défaut si non connecté

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$idc = isset($_GET['confiserie_id']) ? (int)$_GET['confiserie_id'] : null;


?>
<a class="retour" href="#" onclick="history.back(); return false;">Retour à la page précedente</a>
        <div class= "infob">
            <?php
                foreach($recup as $boutiques){
                    if ($boutiques['id'] == $id) {
                        $nomb = $boutiques['nom'];
                        $imgb = $boutiques['illustration'];
                        $hist = $boutiques['histoire'];
                        echo('<h1>'.$nomb.'</h1>');
                        echo('<div class="banniere"> <img src="img/img_bdd/'.$imgb.'"/> </div>');
                        echo('<div class="infoloca">');
                        echo($boutiques['code_postal']);
                        echo("</br>");
                        echo($boutiques['numero_rue']);
                        echo(" ");
                        echo($boutiques['nom_adresse']);
                        echo("</br>");
                        echo($boutiques['ville']);
                        echo(" ");
                        echo($boutiques['pays']);
                        echo("</br>");
                        echo('Horaires : 8h00 - 19h00 du lundi au samedi');
                        echo("</div>");
                        echo("</br>");
                        echo("</br>");
                        echo('<div class="histoire">'.$hist.'</div>');
                    }
            }
        
            echo '<a href="produits.php?id=' .$id. '" class="boutton">Accéder aux produits</a>';

            
            ?>
        </div>
    <div class="bannierefin">
    <img src="img/banniere4.jpg" alt="Bannière test">
  </div>
<?php
include_once("footer.php");

$boutiqueTrouvee = null;
foreach ($recup as $boutique) {
    if ($boutique['id'] == $id) {
        $boutiqueTrouvee = $boutique;
        break;
    }
}
?>

<div class="infob">
<?php if ($boutiqueTrouvee): 
    $nom = htmlspecialchars($boutiqueTrouvee['nom']);
    $histoire = htmlspecialchars($boutiqueTrouvee['histoire']);
    $code_postal = htmlspecialchars($boutiqueTrouvee['code_postal']);
    $numero_rue = htmlspecialchars($boutiqueTrouvee['numero_rue']);
    $nom_adresse = htmlspecialchars($boutiqueTrouvee['nom_adresse']);
    $ville = htmlspecialchars($boutiqueTrouvee['ville']);
    $pays = htmlspecialchars($boutiqueTrouvee['pays']);
    $imageFolder = 'img/img_bdd/';
    $filename = basename($boutiqueTrouvee['illustration']);
    $imagePath = $imageFolder . $filename;
    $imageToShow = (!empty($filename) && file_exists($imagePath)) ? $imagePath : $imageFolder . 'default.jpg';
?>
    <h1><?= $nom ?></h1>
    <div class="banniere">
        <img src="<?= htmlspecialchars($imageToShow) ?>" alt="<?= $nom ?>">
    </div>
    <div class="infoloca">
        <?= $code_postal ?><br>
        <?= $numero_rue . ' ' . $nom_adresse ?><br>
        <?= $ville . ' ' . $pays ?><br>
        Horaires : 8h00 - 19h00 du lundi au samedi
    </div>
    <br><br>
    <div class="histoire"><?= $histoire ?></div>
    <br>
    <a href="produits.php?id=<?= $id ?>" class="boutton">Accéder aux produits</a>

    <?php
    if ($user['role'] === 'admin') {
        $stmt = $PDO->prepare("SELECT COUNT(*) FROM stocks WHERE boutique_id = ?");
        $stmt->execute([$id]);
        $stockCount = (int) $stmt->fetchColumn();

        if ($stockCount === 0) {
            echo '<br><br><a href="supp.php?id=' . $id . '" class="boutton" onclick="return confirm(\'Confirmer la suppression de cette boutique ?\');">Supprimer cette boutique</a>';
        }
    }
    ?>

<?php else: ?>
    <p>Boutique non trouvée.</p>
<?php endif; ?>
</div>

<div class="bannierefin">
    <img src="img/banniere4.jpg" alt="Bannière test">
</div>

<?php include_once("footer.php"); ?>
