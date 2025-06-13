<?php
// foreach($tableau as $variable_créée_pour_loccasion){
//     foreach($variable_créée_pour_loccasion as $clef => $deuxieme_valeur){
//         echo($clef);
//         echo("</br>"); 
//     }
// };
include_once("db.php");

$sqlboutique = "SELECT * FROM boutiques" ;
$connection = $PDO->query($sqlboutique);
$recup = $connection->fetchAll();

foreach($recup as $boutiques){
    echo($variable_créée_pour_loccasion['nom_adresse']);
}
?>

