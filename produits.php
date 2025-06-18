<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");


?>

   <main>
        <?php
            foreach ($recup3 as $stock) {
                    foreach ($recup2 as $confiseries) {
                        if ($stock['confiserie_id'] == $confiseries['id'] && $stock['boutique_id'] == $id) {
                            $imgc = $confiseries['illustration'];
                            $nomc = $confiseries['nom'];
                            $prix = $confiseries['prix'];
                            echo('<div class="banniere"> <img src="img/img_bdd/'.$imgc.'"/> </div>');
                            echo('<h4>'.$nomc.'</h4>');
                            echo('</br>');
                            echo($confiseries['description']);
                            echo('</br>');
                            echo(''.$prix.'€');
                            echo('</br>');
                            echo('Voir les détails');
                  }
                }
            }
        ?>
    </main>