<?php
include_once("header.php");
?>
   
<nav class="navbar">
    <ul>
        <li> Boutique 1 </li>
        <li> Boutique 2 </li>
        <li> Boutique 3 </li>
        <?php 
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){
                 echo('<a class="logout-button" href="logout.php">Se déconnecter</a>');
                 echo('<a class="button" href="index2.php">Interface admin</a>');
               }
        ?>
    </ul>
                    
</nav>
<main>
    <h1> Notre Nom </h1>
    
</main>

<?php
include_once("footer.php");
?>