<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>La Confiserie</title>
    <link rel="icon" type="image/x-icon" href="img/logoico.ico" />
    <link href="css/mn.css" rel="stylesheet" />
    <link href="css/header.css" rel="stylesheet" />
    <link href="css/footer.css" rel="stylesheet" />
    <link href="css/menu.css" rel="stylesheet" />
    <link href="css/boutique.css" rel="stylesheet" />
    <link href="css/bonbon.css" rel="stylesheet" />
    <link href="css/login.css" rel="stylesheet" />
    <link href="css/g.css" rel="stylesheet" />
    <link href="https://fonts.cdnfonts.com/css/goudy-old-style" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/08b10a2ab2.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="icones">
        <a href="#"><i class="cart fa-solid fa-cart-shopping"></i></a>

        <?php if (isset($_SESSION["isConnected"]) && $_SESSION["isConnected"] === true): ?>
            <a href="logout.php" class="deco">Se déconnecter</a>
        <?php else: ?>
            <a href="login.php" title="Se connecter">
                <i class="user fa-regular fa-user"></i>
            </a>
        <?php endif; ?>
    </div>

    <a href="index.php">
        <img src="img/logocoupé.png" alt="logo La Confiserie" class="logoheader" />
    </a>
</header>
