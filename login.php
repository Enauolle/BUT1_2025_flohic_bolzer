<?php
include_once("header.php");
include_once("fonction.php");
include_once("db.php");
?>


<?php
if (isset($_POST["login"], $_POST["password"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $user = check_login($login, $password);

    if ($user) {
        $_SESSION["isConnected"] = true;
        $_SESSION["username"] = $user['username'];
        $_SESSION["role"] = $user['role'];
        $_SESSION["id"] = $user['id'];
        $idd = $_SESSION["id"];

        if ($user['role'] === 'gerant') {
            header("Location: gerant.php?idg=".$idd);
            exit();
        } elseif ($user['role'] === 'admin') {
            header("Location: supergerant.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        $error = "Mauvais nom d'utilisateur ou mot de passe.";
    }
}

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

            <?php if (!empty($error)) : ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </form>
    </div>
</main>

<?php
include_once("footer.php");
?>
