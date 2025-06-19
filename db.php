<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const DB_DRIVER = 'mysql';
const DB_HOST = 'localhost';
const DB_PORT = 3306;
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DATABASE = 'sae203';

try {
    $PDO = new PDO(
        DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';port=' . DB_PORT,
        DB_USERNAME,
        DB_PASSWORD
    );
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    die("Erreur de connexion DB : " . $ex->getMessage());
}

function dbquery($sql, $params = []){
    global $PDO;
    $stmt = $PDO->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$idc = isset($_GET['confiserie_id']) ? (int) $_GET['confiserie_id'] : null;

$sqlboutique = "SELECT * FROM boutiques" ;
$connection = $PDO->query($sqlboutique);
$recup = $connection->fetchAll();

$sqlconfiserie = "SELECT * FROM confiseries" ;
$connection2 = $PDO->query($sqlconfiserie);
$recup2 = $connection2->fetchAll();

$sqlstocks = "SELECT * FROM stocks JOIN boutiques ON boutiques.id = stocks.boutique_id" ;
$connection3 = $PDO->query($sqlstocks);
$recup3 = $connection3->fetchAll();





?>





