<?php
include_once("header.php");
include_once("menu.php");
?>


<div class="banniere">
    <img src="img/banniere.jpg" alt="Bannière">
</div>






<div class="titre2"> 
    <h2>NOS BOUTIQUES</h2>
</div>

<?php
require_once 'db.php';

?>
<div class="boutiques">
    <?php foreach($recup as $boutique): ?>
        <div class="boutique">
            <a href="boutiques.php?id=<?php echo htmlspecialchars($boutique['id']); ?>">
                <?php
                    $baseName = $boutique['illustration'];
                    $imageDir = 'img/img_bdd/';
                    $image = $imageDir . 'default.jpg'; 

                    if (!empty($baseName)) {
                        if (file_exists($imageDir . $baseName)) {
                            $image = $imageDir . $baseName;
                        } else {
                            $baseNoExt = pathinfo($baseName, PATHINFO_FILENAME); // enleve extension s'il y en a
                            if (file_exists($imageDir . $baseNoExt . '.jpg')) {
                                $image = $imageDir . $baseNoExt . '.jpg';
                            } elseif (file_exists($imageDir . $baseNoExt . '.png')) {
                                $image = $imageDir . $baseNoExt . '.png';
                            }
                        }
                    }
                ?>
                <img src="<?php echo htmlspecialchars($image); ?>" 
                     alt="<?php echo htmlspecialchars($boutique['nom']); ?>">
                <h3><?php echo htmlspecialchars($boutique['nom']); ?></h3>
                <span class="voir-plus">Voir plus &gt;</span>
            </a>
        </div>
    <?php endforeach; ?>
</div>





<div class="histoire">
    <div>
        <img src="img/àpropos.jpg" alt="">
    </div>
    <div>
        <div class="trait"></div>
        <h2>NOTRE HISTOIRE</h2>
        <p>La confiserie est une entreprise familiale créée en 1847 par Emile Bonpère à Aix en Provence. 
        En 1985 Emile cède son entreprise à sa fille Chantal qui fera en sorte de maintenir la fabrication artisanale des sucreries à Aix malgré un contexte concurrentiel de plus en plus dur. En 2020, c'est au tour d'Annie de rejoindre l'entreprise familiale. Titulaire d'un MBA obtenu aux USA, elle décide de rentrer en France pour aider sa mère et développe une stratégie de commercialisation de la production familiale à travers un réseau international de grossistes spécialisés dans la revente des produits maisons.
        </br> Annie veille à maintenir et à valoriser le côté artisanal des productions et le savoir-faire de la maison "La Confiserie". Si aujourd'hui... de nombreux processus ont été automatisé, chaque bonbon produit par "La Confiserie" est d'une très grande qualité, toujours fabriqué avec des ingrédients sélectionnés avec soin et malgré la mécanisation, les recettes n'ont pas changé, conférant aux bonbons le goût de cette tradition chère à la famille Bonpère.
        </p>
        <div class="trait"></div>
    </div>
    

</div>





<div class="banniere">
    <img src="img/banniere3.jpg" alt="Bannière">
</div>





<div class="trait"></div>
<div class="addresse">
    <div>
        <p>Rue Henri-Poincaré</p>
        </br>
        <p>54000 Nancy</p>
    </div>
    <div>
        <img src="img/magasinlaconfi.png" alt="">
    </div>
</div>

<?php
include_once("footer.php");
?>