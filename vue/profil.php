<?php
$title = "Votre profil";
include($_SERVER["DOCUMENT_ROOT"] . "/vue/header.php");
if (isset($_SESSION["user"]) && ($_SESSION["user"]["role"])) {
?>
    <section class="section_one_profil_admin">
        <div class="container">
            <div class="section_one_profil_admin_layout">
                <h1 class="center">Gestion des utilisateur</h1>
                <form class="admin_btn center" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="post">
                    <input class="btn_form" type="submit" value="Ajouter un nouvel utilisateur" name="bAddUser" />
                    <input class="btn_form" type="submit" value="Déconnexion" name="bdeconnexion" />
                </form>
                <div class="user_card_layout">
                    <?php
                    //RECUPERATION DE LA CONNEXION A LA BDD
                    global $bdd;
                    $reponse = $bdd->query('SELECT * FROM users');
                    while ($donnees = $reponse->fetch()) {
                        $id = $donnees['user_id'];
                    ?>
                        <div class="user_card radius">
                            <div class="center popup_admin_overlay" id="popup_admin_overlay<?php echo $id; ?>">
                                <div class="container center">
                                    <div class="popup_admin_layout">
                                        <a href="javascript:void(0)" onclick="togglePopup(<?php echo $id; ?>)">&#10006;</a>
                                        <textarea></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="id_role">
                                <button onclick="togglePopup(<?php echo $id; ?>)"><?php echo $donnees['user_id']; ?></button>
                                <p><?php echo $donnees['role']; ?></p>
                            </div>
                            <p>
                                <?php echo $donnees['firstname']; ?>
                            </p>
                            <p>
                                <?php echo $donnees['lastname']; ?>
                            </p>
                            <p>
                                <?php echo $donnees['username']; ?>
                            </p>
                            <p>
                                <?php echo $donnees['email']; ?>
                            </p>
                            <div class="id_role">
                                <form class="card_btn" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="POST">
                                    <input type="hidden" value="<?php echo $donnees['user_id']; ?>" name="id">
                                    <input class="btn_form" type="submit" value="Modifier" name="bEditUser">
                                </form>
                                <form class="card_btn" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="POST">
                                    <input type="hidden" value="<?php echo $donnees['user_id']; ?>" name="id">
                                    <input class="btn_form" type="submit" name="bAdminDeleteUser" value="Suprimer" />
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                    $reponse->closeCursor(); // Termine le traitement de la requête
                    ?>

                </div>
            </div>
        </div>
    </section>
<?php
} elseif (isset($_SESSION["user"]) && ($_SESSION["user"]["role"] === 0)) {
?>
    <section class="section_one_profil_user">
        <div class="container">
            <div class="section_one_profil_user_layout">
                <h1 class="center">Votre profil</h1>
                <div class="profil_user_card_layout">
                    <div class="form user_card_profil radius">
                        <h2 class="center">Vos informations</h2>
                        <div>
                            <p>
                                <b>Email :</b> <?php echo $_SESSION["user"]['email']; ?>
                            </p>
                            <p>
                                <b>Nom d'utilisateur:</b> <?php echo $_SESSION["user"]['username']; ?>
                            </p>
                            <p>
                                <b>Nom :</b> <?php echo $_SESSION["user"]['lastname']; ?>
                            </p>
                            <p>
                                <b>Prénom :</b> <?php echo $_SESSION["user"]['firstname']; ?>
                            </p>
                        </div>
                        <div>
                            <form class="btn_profil_user" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="post">
                                <input type="hidden" value="<?php echo $_SESSION["user"]['user_id']; ?>" name="id">
                                <input class="btn_form" type="submit" value="Modifier" name="bEditUser">
                                <input class="btn_form" type="submit" value="Déconnexion" name="bdeconnexion" />
                            </form>
                            <form class="pad_null" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="POST">
                                <input type="hidden" value="<?php echo $_SESSION["user"]['user_id']; ?>" name="id">
                                <input class="btn_form btn_delete" type="submit" name="bDeleteUser" value="Suprimer mon compte" />
                            </form>
                        </div>
                    </div>
                    <div>
                        <form class="form" action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/controller/userController.php" method="post">
                            <label for="msg" class="center h2">Votre message</label>
                            <?php if (isset($_GET["Success"])) {
                                echo '<p class="center form_succes">Votre message à bien été envoyer</p>';
                            } elseif (isset($_GET["Error"])) {
                                echo '<p class="center form_erreur">Votre message n\'a pas pu êtres envoyer</p>';
                            }
                            ?>
                            <textarea class="input_profil" name="msg" id="msg"></textarea>
                            <input type="hidden" value="<?php echo $_SESSION["user"]["user_id"]; ?>" name="id">
                            <input class="btn_form" type="submit" value="Envoyer" name="bMsgSend">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
} else {
    header("Location: ../vue/connexion.php");
    exit;
}
include($_SERVER["DOCUMENT_ROOT"] . "/vue/footer.php");
?>