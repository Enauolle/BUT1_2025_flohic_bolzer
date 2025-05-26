<nav class="navbar">
    <ul>
        <li> La Confiserie </li>
        <li> Bon-Bons </li>
        <li> Confiz </li>
        <?php 
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]){
                 echo('<a class="logout-button" href="logout.php">Se déconnecter</a>');
                 echo('<a class="button" href="index2.php">Interface admin</a>');
               }
        ?>
    </ul>
                    
</nav>
