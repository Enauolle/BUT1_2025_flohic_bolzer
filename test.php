<?php

include_once("db.php");
$test = dbquery("SELECT * FROM confiseries LIMIT 1");

print_r($test);


?>