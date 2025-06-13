<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

$sqlboutique = "SELECT * FROM boutiques" ;
$connection = $PDO->query($sqlboutique);
$recup = $connection->fetchAll();

?>
    <main>
        <div class= "Info">
            <?php
                foreach($recup as $boutiques){
                    echo($boutiques['code_postal']);
                    echo("</br>");
                    echo($boutiques['numero_rue']);
                    echo(" ");
                    echo($boutiques['nom_adresse']);
                    echo("</br>");
                    echo($boutiques['ville']);
                    echo(" ");
                    echo($boutiques['pays']);
                }
            ?>
        </div>
    </main>
    <img src="img/banniere4.jpg" class="imboutique">
<?php
include_once("footer.php");
?>