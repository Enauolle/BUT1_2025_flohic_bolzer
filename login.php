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
        </form>
    </div>
</main>
<?php
include_once("footer.php");
?>