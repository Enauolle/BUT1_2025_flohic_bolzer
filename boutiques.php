<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

$sqlboutique = "SELECT * FROM boutiques" ;
$connection = $PDO->query($sqlboutique);
$recup = $connection->fetchAll();
$id = $_GET['id'];


?>
    <main>
        <div class= "Info">
            <?php
                foreach($recup as $boutiques){
                    if ($boutiques['id'] == $id) {
                        $nomb = $boutiques['nom'];
                        $imgb = $boutiques['illustration'];
                        echo('<h1>'.$nomb.'</h1>');
                        echo('<div class="banniere"> <img src="img/img_bdd/'.$imgb.'"/> </div>');
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
                        echo("</br>");
                        echo($boutiques['histoire']);
                    }
            }
            ?>
        </div>
        <a href="boutiques.php?id=1" class="boutton">Accéder aux produits</a>
    </main>
    <div class="banniere">
    <img src="img/banniere4.jpg" alt="Bannière test">
  </div>
<?php
include_once("footer.php");
?>