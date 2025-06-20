<?php
include_once("header.php");
include_once("fonction.php");
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

        if ($user['role'] === 'gerant') {
            header("Location: gerant.php");
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
