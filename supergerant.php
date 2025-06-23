<?php
include_once("header.php");
include_once("menu.php");
?>
  
  

<div class="titre2"> 
    <h2>NOS BOUTIQUES</h2>
</div>

<div class="boutiques">
    <div class="boutique">
        <a href="boutiques.php?id=1">
            <img src="img/img_bdd/B1" alt="La Mika-line">
            <h3>Le Mika-line</h3>
            <span class="voir-plus">Voir plus &gt;</span>
        </a>
        </div>
    <div class="boutique">
        <a href="boutiques.php?id=2">
            <img src="img/img_bdd/B2" alt="Ok Bonbons">
            <h3>Ok Bonbons</h3>
            <span class="voir-plus">Voir plus &gt;</span>
        </a>
    </div>
    <div class="boutique">
        <a href="boutiques.php?id=3">
            <img src="img/img_bdd/B3" alt="Le Saccharo">
            <h3>Le Saccharo</h3>
            <span class="voir-plus">Voir plus &gt;</span>
        </a>
    </div>

</div>


    <button class="ajouter" id="openFormBtn">Ajouter une boutique</button>

<div id="formPopup" class="popup-hidden">
    <div class="popup-content">
        <button id="closePopup" class="close-btn">&times;</button>
        <h3>Ajouter une boutique</h3>
        <form method="POST" action="#">
            <div class="form-group full-width">
                <label for="boutique_id">Id de la boutique :</label>
                <input type="text" id="boutique_id" name="boutique_id" required />
            </div>
            <div class="form-group full-width">
                <label for="nom_boutique">Nom de la boutique :</label>
                <input type="text" id="nom_boutique" name="nom_boutique" required />
            </div>
            <div class="form-group full-width">
                <label for="nom_gerant">Nom du gérant :</label>
                <input type="text" id="nom_gerant" name="nom_gerant" required />
            </div>
            <div class="form-group full-width">
                <label for="numero_rue">Numéro de rue :</label>
                <input type="text" id="numero_rue" name="numero_rue" required />
            </div>
            <div class="form-group full-width">
                <label for="nom_rue">Nom de rue :</label>
                <input type="text" id="nom_rue" name="nom_rue" required />
            </div>
            <div class="form-group full-width">
                <label for="code_postal">Code postal :</label>
                <input type="text" id="code_postal" name="code_postal" required />
            </div>
            <div class="form-group full-width">
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required />
            </div>
            <div class="form-group full-width">
                <label for="pays">Pays :</label>
                <input type="text" id="pays" name="pays" required />
            </div>
            <div class="form-group full-width">
                <label for="photo_boutique">Photo de la boutique :</label>
                <input type="text" id="photo_boutique" name="photo_boutique" required />
            </div>
            <div class="form-group full-width" style="flex-basis: 100%;">
                <label for="histoire_boutique">Histoire de la boutique :</label>
                <textarea id="histoire_boutique" name="histoire_boutique" required></textarea>
            </div>

            <button type="submit" class="ajouter">Ajouter la boutique</button>
        </form>
    </div>
</div>


    <script src="script.js"></script>







<?php
include_once("footer.php");
?>