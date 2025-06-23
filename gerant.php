<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");


echo "ID boutique: " . $id;

foreach($recup4 as $user){
    foreach($recup as $boutiques){
            if ($boutiques['id'] == $id && $user['id'] == $id) {
                $nomb = $boutiques['nom'];
                echo('<h1>'.$nomb.'</h1>');
                }
            }
}
?>
<div class="dropdown">
    <button class="ajout" id="bouton"> 
        Ajouter un bonbon
    </button>
  <div class="hidden" id="dropdownMenu">
    <?php
        foreach ($recup2 as $confiseries) {
            $nomc = $confiseries['nom'];
            $idc = $confiseries['id'];
            echo('<a class="bon" href="#" onclick="'.pls().'">'.$nomc.'</a>');
        }
           
    ?>
  </div>
</div>

<main class="propro" id="produit">
<?php
    foreach ($recup3 as $stock) {
                    foreach ($recup2 as $confiseries) {
                        if ($stock['confiserie_id'] == $confiseries['id'] && $stock['boutique_id'] == $id) {
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
                                <input type="number" name="nv_quantite" value="<?php echo $stock['quantite']; ?>" min="0">
                                <input type="hidden" name="confiserie" value="<?php echo $stock['confiserie_id']; ?>">
                                <input type="hidden" name="id_boutique" value="<?php echo $stock['boutique_id']; ?>">
                                <button class="deco" type="submit" name="changer">Changer le stock</button>
                                <button class="deco" type="submit" name="supp">Supprimer</button>
                            </form>
<?php
                            echo('</div>');
                  }
                }
            }
?>

<?php
function pls(){
    foreach ($recup2 as $confiseries) {
        if ($confiseries['id'] == $idc) {
            $imgc = $confiseries['illustration'];
            $nomc = $confiseries['nom'];
            $prix = $confiseries['prix'];
            $idc = $confiseries['id'];

            echo('<div class="carte">');
            echo('<div class="confis"><img src="img/img_bdd/'.$imgc.'"/></div>');
            echo('<h4>'.$nomc.'</h4>');
            echo('<br>');
            echo($confiseries['description']);
            echo('<br>');
            echo($prix.'€');
            echo('<br><br>');
            echo('<a href="bonbon.php?confiserie_id='.$idc.'">Voir les détails ></a>');
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