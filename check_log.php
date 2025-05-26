<?php

function check_login($login, $password){
    $password = MD5($password);
    $result = dbquery("SELECT * FROM utilisateur WHERE username LIKE '$login' AND password LIKE '$password'");
    
    if (count($result) > 0){
        return true;
    } else{
        return false;
    }
}

?>