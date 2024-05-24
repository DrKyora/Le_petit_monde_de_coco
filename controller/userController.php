<?php
session_start();
require($_SERVER["DOCUMENT_ROOT"] . "/model/userModel.php");

if (isset($_POST["binscription"])) {
    $post = $_POST;
    $errors = validateForm($post);
    $_SESSION["errors"] = $errors;
    if (empty($errors)) {
        $lastname = htmlspecialchars(trim($_POST["lastname"]));
        $firstname = htmlspecialchars(trim($_POST["firstname"]));
        $username = htmlspecialchars(trim($_POST["username"]));
        $email = htmlspecialchars(strtolower(trim($_POST["email"])));
        $password = htmlspecialchars(trim(password_hash($_POST["password"], PASSWORD_DEFAULT)));
        $password2 = htmlspecialchars(trim($_POST['password2']));
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1) {
            $role = htmlspecialchars($_POST['role']);
        } else {
            $role = 0;
        }
        $message = insertData($firstname, $lastname,  $username, $password, $email, $role);
        if (isset($message)) {
            header("Location: ../vue/inscription.php?message=" . $message);
            exit;
        } else {
            header("Location: ../vue/connexion.php?success");
            exit;
        }
        unset($_SESSION["errors"]);
    } else {
        header("Location: ../vue/inscription.php?error");
        exit;
    }
} elseif (isset($_POST['bEditUserData'])) {
    $post = $_POST;
    $errors = validateEditForm($post);
    $_SESSION["errors"] = $errors;
    if (empty($errors)) {
        $lastname = htmlspecialchars(trim($_POST["lastname"]));
        $firstname = htmlspecialchars(trim($_POST["firstname"]));
        $username = htmlspecialchars(trim($_POST["username"]));
        $email = htmlspecialchars(strtolower(trim($_POST["email"])));
        $password = htmlspecialchars(trim(password_hash($_POST["password"], PASSWORD_DEFAULT)));
        $password2 = htmlspecialchars(trim($_POST["password2"]));
        if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] == 1 && isset($_SESSION["user_id_edit"])) {
            $role = htmlspecialchars($_POST["role"]);
        } else {
            $role = 0;
        }
        $user_id = htmlspecialchars($_POST["id"]);
        if (updateData($user_id, $lastname, $firstname, $username, $email, $password, $role)) {
            if ($_SESSION["user_id_edit"]["user_id"] == $_SESSION["user"]["user_id"]) {
                session_destroy();
                session_start();
                unset($_SESSION["user_id_edit"]);
                header("Location: ../vue/connexion.php");
                exit;
            } else {
                unset($_SESSION["user_id_edit"]);
                header("Location: ../vue/profil.php");
                exit;
            }
        }
    } else {
        header("Location: ../vue/inscription.php?error");
        exit;
    }
} elseif (isset($_POST["bconnexion"])) {
    $email = htmlspecialchars(strtolower(trim($_POST["email"])));
    $password = htmlspecialchars(trim($_POST["password"]));
    $message = login($email, $password);
    if (isset($message)) {
        header("Location: ../vue/connexion.php?message=" . $message);
        exit;
    } elseif ((isset($_SESSION["user"]))) {
        header("Location: ../vue/accueil.php?succes");
    } else {
        header("Location: ../vue/connexion.php?Error");
        exit;
    }
} elseif (isset($_POST["bdeconnexion"])) {
    disconnect();
    header("Location: ../vue/accueil.php");
    exit;
} elseif (isset($_POST["bAddUser"])) {
    header("Location: ../vue/inscription.php");
    exit;
} elseif (isset($_POST["bEditUser"])) {
    $user_id = htmlspecialchars($_POST["id"]);
    $user_info = infoUser($user_id);
    $_SESSION["user_id_edit"] = $user_info;
    header("Location: ../vue/inscription.php");
} elseif (isset($_POST["bAdminDeleteUser"])) {
    $user_id = $_POST["id"];
    deleteUserAdmin($user_id);
    header("Location: ../vue/profil.php");
} elseif (isset($_POST["bMsgSend"])) {
    $msg = htmlspecialchars($_POST["msg"]);
    $user_id = htmlspecialchars($_POST["id"]);
    if (addMsg($msg, $user_id)) {
        header("Location: ../vue/profil.php?Success");
        exit;
    } else {
        header("Location: ../vue/profil.php?Error");
        exit;
    }
} elseif (isset($_POST["bDeleteUser"])) {
    $user_id = $_POST['id'];
    $user_msg_id = $_SESSION['user']['user_msg_id'];
    disconnect();
    deleteUser($user_id, $msg_user_id);
    header("location: ../vue/accueil.php");
}
