<main><?php
include_once("header.php");
?>
<main>
    <div class="main-container">
         <form method="POST" action="">
            <h1>Connection</h1>
            <h2>Nom d'utilisateur</h2>
            <input type="text" id="login" name="login" />
            <h2>Mot de passe</h2>
            <input type="password" id="password" name="password" />
            <button type="submit">Se connecter</button>

            <?php
                include_once("check.php");
            
            if(isset($_POST["login"]) && isset($_POST["password"])){
                $login = $_POST["login"];
                $password = $_POST["password"];

                $resultat = check_login($login, $password);
                
                if ($resultat == 1){
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $login;
                    header("location: index.php");
                }
                else {
                    $_SESSION["error"] = "Mauvais Nom d'utilisateur / mot de passe";
                }
            }   
                ?>
        </form>
    </div>
</main>
<?php
include_once("footer.php");
?>