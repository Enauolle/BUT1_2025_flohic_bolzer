<?php
include_once("header.php");
include_once("fonction.php");
?>

<main>
    <div class="log-container">
        <form method="POST" action="">
            <h1>Connexion</h1>

            <h2>Nom d'utilisateur</h2>
            <input type="text" id="login" name="login" required />

            <h2>Mot de passe</h2>
            <input type="password" id="password" name="password" required />

            <button type="submit">Se connecter</button>

            <?php
            if (isset($_POST["login"]) && isset($_POST["password"])) {
                $login = $_POST["login"];
                $password = $_POST["password"];

                if (check_login($login, $password)) {
                    $_SESSION["isConnected"] = true;
                    $_SESSION["username"] = $login;
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION["error"] = "Mauvais nom d'utilisateur ou mot de passe.";
                }
            }

            if (!empty($_SESSION["error"])) {
                echo "<p class='error'>" . $_SESSION["error"] . "</p>";
                unset($_SESSION["error"]);
            }
            ?>
        </form>
    </div>
</main>

<?php
include_once("footer.php");
?>
