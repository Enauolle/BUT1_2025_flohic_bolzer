<?php
include_once("header.php");
include_once("menu.php");
?>
<a href="#">Retour à la page précedente</a>

<h1>CHOCOLAT</h1>
<div class="tout">
  <div class="Bonbon">
    <div class="carousel">
      <div class="carousel-images">
        <img id="TourneImage" src="img/img_bdd/praline.png" alt="Bonbon" class="active">
      </div>
    </div>
    <div class="carousel-dots">
        <span class="dot active" onclick="rotateImage(0)"></span>
        <span class="dot" onclick="rotateImage(90)"></span>
        <span class="dot" onclick="rotateImage(180)"></span>
        <span class="dot" onclick="rotateImage(270)"></span>
      </div>
  </div>

  <div class="info-produit">
    <h1>CHOCOLAT NOIR</h1>
    <p>Chocolat Noir À 70% De Cacao</p>
    <p class="prix">3.99€</p>
    
    <div class="quantity-cart">
      <div class="quantity">
        <button>-</button>
        <span>1</span>
        <button>+</button>
      </div>
      <button class="btn-panier">Ajouter Au Panier</button>
    </div>
  </div>
</div>

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
