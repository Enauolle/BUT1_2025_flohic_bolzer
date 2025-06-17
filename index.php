<?php
include_once("header.php");
include_once("menu.php");
?>
   
<div class="banniere">
    <img src="img/banniere.jpg" alt="Bannière test">
</div>


<div class="titre2"> NOS BOUTIQUES</div>
<div class="boutiques">
    <div class="boutique">
        <a href="boutiques.php?id=1">
            <img src="img/img_bdd/B1" alt="La Mika-line">
            <h2>Le Mika-line</h2>
        </a>
        </div>
    <div class="boutique">
        <a href="boutiques.php?id=2">
            <img src="img/img_bdd/B2" alt="Ok Bonbons">
            <h2>Ok Bonbons</h2>
        </a>
    </div>
    <div class="boutique">
        <a href="boutiques.php?id=3">
            <img src="img/img_bdd/B3" alt="Le Saccharo">
            <h2>Le Saccharo</h2>
        </a>
    </div>

</div>

<?php
include_once("footer.php");
?>