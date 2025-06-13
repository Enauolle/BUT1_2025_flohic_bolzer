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

function check_role($login, $role){
    $supergerant = dbquery("SELECT * FROM utilisateur WHERE role LIKE admin") ;
    $gerant = dbquery("SELECT * FROM utilisateur WHERE role LIKE gerant") ;
    if ($supergerant == true){
    header("location: supergerant.php");
    }
    elseif ($gerant == true){
    header("location: gerant.php");
    }
    else {
    header("location: index.php");
    }
}

            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){
                 echo('<a class="logout-button" href="logout.php">Se déconnecter</a>');
                 echo('<a class="button" href="index2.php">Interface admin</a>');
               }
        
?>