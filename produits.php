<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : null; //prendre l'id de l'url
$idc = isset($_GET['confiserie_id']) ? (int)$_GET['confiserie_id'] : null;


?>
    <div class="titrepro">
        <?php
            foreach($recup as $boutiques){
            if ($boutiques['id'] == $id) {
                $nomb = $boutiques['nom'];
                echo('<h1>'.$nomb.'</h1>');
                }
            }
        ?>
    </div>
<a class="retour" href="#" onclick="history.back(); return false;">Retour à la page précedente</a>
   <main class="propro">
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
                            //echo '<a href="bonbon.php?id=' . $id . '&idc=' . $idc . '">Voir le bonbon</a>';
                            echo('<a href="bonbon.php?confiserie_id='.$idc.'" >Voir les détails ></a>');
                            echo('</div>');
                  }
                }
            }
        ?>
    </main>
    <div class="bannierefin">
        <img src="img/banniere4.jpg" alt="Bannière test">
    </div>
    <?php
include_once("footer.php");
?>