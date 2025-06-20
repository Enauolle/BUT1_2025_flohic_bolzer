<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");
?>

<h1>La Mika-Line</h1>

<div class="dropdown">
    <button class="ajout"> 
        Ajouter un bonbon
    </button>
  <div class="menu">
    <?php
    foreach ($recup2 as $confiseries) {
                            $nomc = $confiseries['nom'];
                            echo('<h4>'.$nomc.'</h4>');
                  }
                
    ?>
    </a>
  </div>
</div>

<main class="propro">
    <?php
    foreach ($recup3 as $stock) {
                    foreach ($recup2 as $confiseries) {
                        if ($stock['confiserie_id'] == $confiseries['id'] && $stock['boutique_id'] == 1) {
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
                            echo('</div>');
                  }
                }
            }
?>

</main>
<?php
include_once("footer.php");
?>