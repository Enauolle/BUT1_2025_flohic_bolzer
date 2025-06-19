<?php
require_once("db.php");

function check_login($login, $password){
    $password = md5($password);  
    $result = dbquery("SELECT * FROM utilisateurs WHERE username = ? AND password = ?", [$login, $password]);
    return count($result) > 0;
}

function check_role($login){
    $result = dbquery("SELECT role FROM utilisateurs WHERE username = ?", [$login]);
    return count($result) > 0 ? $result[0]['role'] : null;
}
?>
