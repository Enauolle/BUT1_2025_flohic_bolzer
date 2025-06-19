<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

?>
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
?>