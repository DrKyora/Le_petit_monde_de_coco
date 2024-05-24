<?php
$title = "Le petit monde de coco";
include($_SERVER["DOCUMENT_ROOT"] . "/vue/header.php");
?>
<section class="section_one_accueil">
  <div class="container">
    <div class="section_one_accueil_layout">
      <h1 class="center">Le petit monde de coco</h1>
      <div class="carousel" id="carousel">
        <ul>
          <li class="center slide active"><img class="radius img" src="/img/art1.jpg" alt="carrousel img 1"></li>
          <li class="center slide"><img class="radius img" src="/img/art2.jpg" alt="carrousel img 2"></li>
          <li class="center slide"><img class="radius img" src="/img/art3.jpg" alt="carrousel img 3"></li>
          <li class="center slide"><img class="radius img" src="/img/art4.jpg" alt="carrousel img 4"></li>
          <li class="center slide"><img class="radius img" src="/img/art5.jpg" alt="carrousel img 5"></li>
          <li class="center slide"><img class="radius img" src="/img/art6.jpg" alt="carrousel img 6"></li>
          <li class="center slide"><img class="radius img" src="/img/art7.jpg" alt="carrousel img 7"></li>
          <li class="center slide"><img class="radius img" src="/img/art8.jpg" alt="carrousel img 8"></li>
          <li class="center slide"><img class="radius img" src="/img/art9.jpg" alt="carrousel img 9"></li>
          <li class="center slide"><img class="radius img" src="/img/art10.jpg" alt="carrousel img 10"></li>
          <li class="center slide"><img class="radius img" src="/img/art11.jpg" alt="carrousel img 11"></li>
          <li class="center slide"><img class="radius img" src="/img/art12.jpg" alt="carrousel img 12"></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<div class="vector"></div>
<section class="section_two_accueil accueil_vector center">
  <div class="section_two_accueil_layout">
    <div class="layout_accueil_articles container">
      <div class="accueil_article radius center">
        <h2>Autodidacte</h2>
        <p>En tant qu'autodidacte, j'ai perfectionné mes compétences en crochet en suivant des tutoriels en ligne et en expérimentant différents motifs et techniques.</p>
      </div>
      <div class="accueil_article radius center">
        <h2>Passionné</h2>
        <p>En tant que passionné du crochet, je passe des heures à créer des pièces uniques, mêlant couleurs et textures pour donner vie à mes inspirations.</p>
      </div>
      <div class="accueil_article radius center">
        <h2>Partage</h2>
        <p>Ce site est né de ma volonté de partager mes compétences en crochet, offrant une plateforme où les passionnés peuvent apprendre et s'inspirer.</p>
      </div>
    </div>
  </div>
</section>
<div class="vector"></div>
<section class="section_three_accueil">
  <div class="container">
    <div class="section_three_accueil_layout">
      <div class="presentation center">
        <div class="presentation_img">
          <img class="img" src="/img/Presentation.png" alt="photo de présentation de la propriétaire du blog">
        </div>
        <div class="presentation_text">
          <h2>Qui suis-je ? </h2>
          <p>Bonjour,<br><br>
            Je suis Coralie, une jeune maman de 26 ans, passionnée par le crochet et puéricultrice de métier. J'ai découvert ma passion pour le crochet il y a quelques années et depuis, entre m'occuper de ma petite famille et créer des pièces uniques avec mon crochet, je trouve un équilibre qui me nourrit au quotidien. Venez découvrir mon univers coloré et plein de tendresse !
          </p>
        </div>
      </div>
    </div>

  </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/vue/footer.php");
?>