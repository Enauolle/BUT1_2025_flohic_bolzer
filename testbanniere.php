<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Test Bannière</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: sans-serif;
    }
    .banniere {
      width: 100vw;
      height: 300px;
      overflow: hidden;
      background-color: lightgray;
    }
    .banniere img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }
  </style>
</head>
<?php
include_once("header.php");
?>
<body>

  <div class="banniere">
    <img src="img/banniere.jpg" alt="Bannière test">
  </div>

</body>
</html>
