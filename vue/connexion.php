<?php
$title = "Connexion";
include($_SERVER["DOCUMENT_ROOT"] . "/vue/header.php");
?>
<section class="section_one_connexion">
  <div class="container small">
    <div class="section_one_connexion_layout">
      <h1 class="center">Connexion</h1>
      <div class="form">
        <?php
        if (isset($_SESSION["user"])) {
          header("Location: ../vue/accueil.php");
        } else {
        ?>
          <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="post">
            <?php if (isset($_GET["success"])) {
              echo '<p class="center form_succes">Votre inscription s\'est correctement déroulée</p>';
            } elseif (isset($_GET["Error"])) {
              echo '<p class="center form_erreur">Email ou mot de passe incorrect</p>';
            }
            ?>
            <div class="nav_form center">
              <label for="email">Adresse mail</label>
              <input class="input_large input" type="email" id="email" name="email" required autofocus />
            </div>
            <div class="nav_form center">
              <label for="password">Mot de passe</label>
              <input class="input_large input" type="password" id="password" name="password" required />
            </div>
            <span>
              <input class="btn_form" type="submit" value="Connexion" name="bconnexion" />
            </span>
          </form>
        <?php
        }
        ?>
        <div class="center">
          <ul class="nav_form">
            <li><a href="#">Mot de passe oublié ?</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
include($_SERVER["DOCUMENT_ROOT"] . "/vue/footer.php");
?>