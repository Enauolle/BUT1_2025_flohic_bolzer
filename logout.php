<?php

 //récupère la session courante
 session_start();

 //efface toutes les données de session enregistrées
 unset($_SESSION['id']);
 unset($_SESSION['username']);

 //détruit la session courante
 session_destroy();
 
 //redirige vers une page de sortie : la page d'accueil de notre → site.
 header("location: index.php");
 
 exit;
 ?>