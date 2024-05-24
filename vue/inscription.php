<?php
$title = "Inscription";
include($_SERVER["DOCUMENT_ROOT"] . "/vue/header.php");
if (isset($_SESSION["errors"])) {
  $errors = $_SESSION["errors"];
}
if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1 && isset($_SESSION["user_id_edit"])) {
  $user = $_SESSION["user_id_edit"];
?>
  <section class="section_one_inscription">
    <div class="container small">
      <div class="section_one_inscription_layout">
        <h1 class="center">Modification administrateur</h1>
        <div class="form">
          <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="POST" name="Modification">
            <div>
              <label for="lastname">Nom</label>
              <input class="input" type="text" id="lastname" name="lastname" minlength="3" autofocus value="<?php echo $user['lastname']; ?>" />
              <label for="firstname">Prénom</label>
              <input class="input" type="text" id="firstname" name="firstname" minlength="3" value="<?php echo $user['firstname']; ?>" />
            </div>
            <div class="space">
              <div>
                <?php
                if (isset($errors[0])) {
                  echo '<span class="form_erreur">' . $errors[0] . '</span>';
                }
                ?>
              </div>
              <div>
                <?php
                if (isset($errors[1])) {
                  echo '<span class="form_erreur">' . $errors[1] . '</span>';
                }
                ?>
              </div>
            </div>
            <div>
              <label for="username">Nom d'utilisateur</label>
              <input class="input input_large" type="text" id="username" name="username" minlength="3" value="<?php echo $user['username']; ?>" />
            </div>
            <div>
              <?php
              if (isset($errors[2])) {
                echo '<span class="form_erreur">' . $errors[2] . '</span>';
              }
              ?>
            </div>
            <div>
              <label for="email">Adresse mail</label>
              <input class="input" type="email" id="email" name="email" value="<?php echo $user['email']; ?>" />
            </div>
            <div>
              <?php
              if (isset($errors[3])) {
                echo '<span class="form_erreur">' . $errors[3] . '</span>';
              }
              ?>
            </div>
            <div>
              <label for="password">Mot de passe</label>
              <input class="input" type="text" id="password" name="password" minlength="8" />
            </div>
            <div>
              <?php
              if (isset($errors[4])) {
                echo '<span class="form_erreur">' . $errors[4] . '</span>';
              }
              ?>
            </div>
            <div>
              <label for="password2">Confirmation</label>
              <input class="input" type="text" id="password2" name="password2" minlength="8" />
            </div>
            <div>
              <?php
              if (isset($errors[5])) {
                echo '<span class="form_erreur">' . $errors[5] . '</span>';
              }
              ?>
            </div>
            <div>
              <label for="role">Rôle</label>
              <select class="input" name="role" id="role">
                <option value="0">Utilisateur</option>
                <option value="1">Administrateur</option>
              </select>
            </div>
            <span>
              <input type="hidden" value="<?php echo $user["user_id"]; ?>" name="id">
              <input class="btn_form" type="submit" name="bEditUserData" value="Modifier">
            </span>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php
  unset($_SESSION["errors"]);
} else {
?>
  <section class="section_one_inscription">
    <div class="container small">
      <div class="section_one_inscription_layout">
        <h1 class="center"><?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 0) {
                              echo "Modification des données";
                            } else {
                              echo "Inscription";
                            } ?></h1>
        <div class="form">
          <form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="POST" name="inscription">
            <div>
              <label for="lastname">Nom</label>
              <input class="input" type="text" id="lastname" name="lastname" required minlength="3" autofocus value="<?php if (isset($_SESSION['user']) && isset($_SESSION['user_id_edit'])) {
                                                                                                                        echo $_SESSION['user']['lastname'];
                                                                                                                      } ?>" />
              <label for="firstname">Prénom</label>
              <input class="input" type="text" id="firstname" name="firstname" required minlength="3" value="<?php if (isset($_SESSION['user']) && isset($_SESSION['user_id_edit'])) {
                                                                                                                echo $_SESSION['user']['firstname'];
                                                                                                              } ?>" />
            </div>
            <div class="space">
              <div>
                <?php
                if (isset($errors[0])) {
                  echo '<span class="form_erreur">' . $errors[0] . '</span>';
                }
                ?>
              </div>
              <div>
                <?php
                if (isset($errors[1])) {
                  echo '<span class="form_erreur">' . $errors[1] . '</span>';
                }
                ?>
              </div>
            </div>
            <div>
              <label for="username">Nom d'utilisateur</label>
              <input class="input input_large" type="text" id="username" name="username" required minlength="3" value="<?php if (isset($_SESSION['user']) && isset($_SESSION['user_id_edit'])) {
                                                                                                                          echo $_SESSION['user']['username'];
                                                                                                                        } ?>" />
            </div>
            <div>
              <?php
              if (isset($errors[2])) {
                echo '<span class="form_erreur">' . $errors[2] . '</span>';
              }
              ?>
            </div>
            <div>
              <label for="email">Adresse mail</label>
              <input class="input" type="email" id="email" name="email" required value="<?php if (isset($_SESSION['user']) && isset($_SESSION['user_id_edit'])) {
                                                                                          echo $_SESSION['user']['email'];
                                                                                        } ?>" />
            </div>
            <div>
              <?php
              if (isset($errors[3])) {
                echo '<span class="form_erreur">' . $errors[3] . '</span>';
              }
              ?>
            </div>
            <div>
              <label for="password">Mot de passe</label>
              <input class="input" type="password" id="password" name="password" <?php if (!isset($_SESSION['user'])) echo "required" ?>minlength="8" />
            </div>
            <div>
              <?php
              if (isset($errors[4])) {
                echo '<span class="form_erreur">' . $errors[4] . '</span>';
              }
              ?>
            </div>
            <div>
              <label for="password2">Confirmation</label>
              <input class="input" type="password" id="password2" name="password2" <?php if (!isset($_SESSION['user'])) echo "required" ?> />
            </div>
            <div>
              <?php
              if (isset($errors[5])) {
                echo '<span class="form_erreur">' . $errors[5] . '</span>';
              }
              ?>
            </div>
            <?php
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 0) {
            ?>
              <span>
                <input class="btn_form" type="submit" name="bEditUserData" value="Modifier" />
              </span>
              <?php
            } else {
              if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1) {
              ?>
                <div>
                  <label for="role">Rôle</label>
                  <select class="input" name="role" id="role">
                    <option value="0">Utilisateur</option>
                    <option value="1">Administrateur</option>
                  </select>
                </div>
              <?php
              }
              ?>
              <span>
                <input class="btn_form" type="submit" name="binscription" value="S'inscrire" />
              </span>
          </form>
          <div class="center">
            <ul class="nav_form">
              <li><a href="connexion.php">Vous avez déjà un compte ?</a></li>
            </ul>
          </div>
        <?php
            }
        ?>
        </div>
      </div>
    </div>
  </section>
<?php
  unset($_SESSION["errors"]);
}
include($_SERVER["DOCUMENT_ROOT"] . "/vue/footer.php");
