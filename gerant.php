<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

$idg = isset($_GET['idg']) ? (int)$_GET['idg'] : null; //prendre id du gérant
$idc = isset($_GET['confiserie_id']) ? (int)$_GET['confiserie_id'] : null; // id de la confiserie

if (isset($_POST['changer'])) { //si je clique sur le boutton changer
    $nv_quantite = $_POST['nouvelle_quantite']; //prendre la quantité déja existante
    $idc = $_POST['id_produit'];
    $id_boutique = $_POST['id_boutique'];

    $sqlajout = "UPDATE stocks SET quantite = $nv_quantite WHERE confiserie_id = $idc AND boutique_id = $id_boutique";
    $PDO->query($sqlajout);
}

if (isset($_POST['supp'])) { //supp une confiserie
    $idc = $_POST['id_produit'];
    $id_boutique = $_POST['id_boutique'];

    $sqlsupp = "DELETE FROM stocks WHERE confiserie_id = $idc AND boutique_id = $id_boutique";
    $PDO->query($sqlsupp);
}

if (isset($_POST['bonbon'])) { //ajoute une confiserie
    $idp = intval($_POST['id_produit']);
    $id_boutique = intval($_POST['id_boutique']);

    $sqladd = $PDO->prepare("INSERT INTO stocks (confiserie_id, boutique_id, quantite) VALUES (?, ?, 1)");
    $sqladd->execute([$idp, $id_boutique]);
}


foreach($recup as $boutiques){
                if ($boutiques['id'] == $idg) {
                    $nomb = $boutiques['nom'];
                    echo('<h1>'.$nomb.'</h1>');
                    }
                }

?>

<div class="dropdown">
    <button class="ajout" id="bouton">Ajouter un bonbon</button>
    <div class="hidden" id="dropdownMenu">
        <?php foreach ($recup2 as $confiseries){ ?>
           <form method="post" action="">  <!-- méthode post = permet d'ajouter, supp etc -->
                <input type="hidden" name="id_produit" value="<?php echo($confiseries['id']) ?>">
                <input type="hidden" name="id_boutique" value="<?php echo($idg) ?>"> 
                <button type="submit" name="bonbon" class="bon"><?php echo($confiseries['nom']) ?></button>
            </form>
        <?php } ?>
    </div>
</div>





<main class="propro" id="produit">
<?php
    foreach ($recup3 as $stock) {
                    foreach ($recup2 as $confiseries) {
                        if ($stock['confiserie_id'] == $confiseries['id'] && $stock['boutique_id'] == $idg) {
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
                            echo(''.$prix.'€');
                            echo('</br>');
                            echo('</br>');
                            echo('<a href="bonbon.php?confiserie_id='.$idc.'" >Voir les détails ></a>');
                            ?>
                            <form method="post" action="">
                                <input type="number" name="nouvelle_quantite" value="<?php echo $stock['quantite']; ?>" min="0">
                                <input type="hidden" name="id_produit" value="<?php echo $stock['confiserie_id']; ?>">
                                <input type="hidden" name="id_boutique" value="<?php echo $stock['boutique_id']; ?>">
                                <button class="stock" type="submit" name="changer">Changer le stock</button>
                                <button class="supp" type="submit" name="supp">Supprimer</button>
                            </form>

<?php
                            echo('</div>');
                  }
                }
            }
?>

</div>
</main>
<?php
include_once("footer.php");
?>

<script>
    const menu = document.getElementById("dropdownMenu");
    const button = document.getElementById("bouton");
    const bonbons = document.getElementById("produit");
    const nomp = document.getElementById("nom");
    const catalogue = document.getElementById("catalogueBonbons");



button.addEventListener("click", function(event) {
    menu.classList.toggle("hidden");
    menu.classList.toggle("menu");
});



</script>