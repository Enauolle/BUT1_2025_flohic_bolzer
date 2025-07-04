<?php
include_once("header.php");
include_once("menu.php");
include_once("db.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$idc = isset($_GET['confiserie_id']) ? (int)$_GET['confiserie_id'] : null;


?>  <a class="retour" href="#" onclick="history.back(); return false;">Retour à la page précedente</a> <?php 

 foreach ($recup3 as $stock) {
    if ($stock['boutique_id'] == $id) { 
      return $stock['boutique_id'];
    }  }

  foreach ($recup2 as $confiseries) {
    if ($confiseries['id'] == $idc ) {
      $imgc = $confiseries['illustration'];
      $typec = $confiseries['type'];
      $nomc = $confiseries['nom'];
      $dc = $confiseries['description'];
      $prixc = $confiseries['prix'];
      $stocks = $stock['quantite'];
      echo('<h1>'.$typec.'</h1>');
      echo('<div class="tout">
              <div class="Bonbon">
                <div class="carousel">
                  <div class="carousel-images">');
              echo('<img id="TourneImage" src="img/img_bdd/'.$imgc.'" alt="Bonbon" class="active">');
      echo('  </div>
            </div>
            <div class="carousel-dots">
              <span class="dot active" onclick="rotateImage(0)"></span>
              <span class="dot" onclick="rotateImage(90)"></span>
              <span class="dot" onclick="rotateImage(180)"></span>
              <span class="dot" onclick="rotateImage(270)"></span>
            </div>
          </div>
          <div class="info-produit">');
            echo('<h1>'.$nomc.'</h1>');
            echo('<p>'.$dc.'</p>');
            echo('<p class="prix">'.$prixc.'€ </p>');
            echo('<p>'.$stocks.' restants</p>');

            echo('<div class="quantity-cart">
                    <div class="quantity">
                      <button>-</button>
                      <span>1</span>
                      <button>+</button>
                    </div>
                    <button class="btn-panier">Ajouter Au Panier</button>
                  </div>
                </div>
            </div>');
    }
  }

?>


<script>
  function rotateImage(degrees) {
    const img = document.getElementById('TourneImage');
    img.style.transform = `rotate(${degrees}deg)`;

    const dots = document.querySelectorAll('.dot');
    dots.forEach(dot => dot.classList.remove('active'));
    const index = degrees / 90;
    if (dots[index]) dots[index].classList.add('active');
  }

  window.onload = () => rotateImage(0);
</script>

<?php
include_once("footer.php");
?>
