<?php
include($_SERVER["DOCUMENT_ROOT"] . "/model/dbconnect.php");
// FUNCTION SECURISATION FORMULAIRE
function validateForm($post)
{
    $nameRegex = "/^.{3,}$/";
    $emailRegex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
    $mdpRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/";
    $errors = [];
    if (isset($post)) {
        if (empty($_POST["lastname"]) || !(preg_match($nameRegex, $_POST["lastname"]))) {
            $errors[0] = "Votre nom doit être composé de trois caractères minimum.";
        }
        if (empty($_POST["firstname"]) || !preg_match($nameRegex, $_POST["firstname"])) {
            $errors[1] = "Votre prénom doit être composé de trois caractères minimum.";
        }

        if (empty($_POST["username"]) || !preg_match($nameRegex, $_POST["username"])) {
            $errors[2] = "Votre nom d'utilisateur doit être composé de trois caractères minimum.";
        }
        if (empty($_POST["email"]) || !preg_match($emailRegex, $_POST["email"])) {
            $errors[3] = "Veuillez entrer une adresse mail valide.";
        } elseif (EmailExist($_POST["email"])) {
            $errors[3] = "Cette adresse e-mail est déjà utilisée.";
        }
        if (empty($_POST["password"]) || !preg_match($mdpRegex, $_POST["password"])) {
            $errors[4] = "Votre mot de passe doit contenir au moin : 1 lettre majuscule , 1 lettre minuscules
            1 chiffres et 1 caractère spécial. ";
        } elseif ($_POST["password2"] != $_POST["password"]) {
            $errors[5] = "Les mot de passe ne corresponde pas.";
        }
        return $errors;
    }
}
function validateEditForm($post)
{
    $email = $_POST["email"];
    $user_id = $_SESSION["user_id_edit"]["user_id"];
    $nameRegex = "/^.{3,}$/";
    $emailRegex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
    $mdpRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/";
    $errors = [];
    if (isset($post)) {
        if (empty($_POST["lastname"]) || !(preg_match($nameRegex, $_POST["lastname"]))) {
            $errors[0] = "Votre nom doit être composé de trois caractères minimum.";
        }
        if (empty($_POST["firstname"]) || !preg_match($nameRegex, $_POST["firstname"])) {
            $errors[1] = "Votre prénom doit être composé de trois caractères minimum.";
        }

        if (empty($_POST["username"]) || !preg_match($nameRegex, $_POST["username"])) {
            $errors[2] = "Votre nom d'utilisateur doit être composé de trois caractères minimum.";
        }
        if (empty($_POST["email"]) || !preg_match($emailRegex, $_POST["email"])) {
            $errors[3] = "Veuillez entrer une adresse mail valide.";
        } elseif (isset($_SESSION['user_id_edit']) && EmailExist($email, $user_id)) {
            $errors[3] = "Cette adresse e-mail est déjà utilisée.";
        }
        if (empty($_POST["password"])  && !isset($_SESSION['user_id_edit'])) {
            if (!preg_match($mdpRegex, $_POST["password"])) {
                $errors[4] = "Votre mot de passe doit contenir au moin : 1 lettre majuscule , 1 lettre minuscules
                1 chiffres et 1 caractère spécial. ";
            } elseif ($_POST["password2"] != $_POST["password"]) {
                $errors[5] = "Les mot de passe ne corresponde pas.";
            }
        }
        return $errors;
    }
}
function EmailExist($email, $user_Id = null)
{
    global $bdd;
    $query = "SELECT * FROM users WHERE email = :email";
    if ($user_Id !== null) {
        $query .= " AND user_id != :user_id";
    }
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':email', $email);
    if ($user_Id !== null) {
        $stmt->bindParam(':user_id', $user_Id);
    }
    $stmt->execute();
    return $stmt->fetch() !== false;
}
//FUNCTION INSERER EN BDD
function insertData($firstname, $lastname, $username, $password, $email, $role)
{
    //RECUPERATION DE LA CONNEXION A LA BDD
    global $bdd;
    //REQUETE SQL
    $querySql = "INSERT INTO `users`(firstname,lastname,username,password,email,role) VALUES (:firstname,:lastname,:username,:password,:email,:role)";
    // PREPARE LA REQUETE SQL
    $stmtUserData = $bdd->prepare($querySql);
    //BINDPARAM
    $stmtUserData->bindParam(":firstname", $firstname);
    $stmtUserData->bindParam(":lastname", $lastname);
    $stmtUserData->bindParam(":username", $username);
    $stmtUserData->bindParam(":password", $password);
    $stmtUserData->bindParam(":email", $email);
    $stmtUserData->bindParam(":role", $role);
    try {
        $stmtUserData->execute();
    } catch (PDOException $e) {
        $message = "Une Erreur s'est produite : " . $e;
    }
    if (isset($message)) {
        return $message;
    }
}
//FUNCTION LOGIN
function login($email, $password)
{

    global $bdd;
    $sqlUser = "SELECT * FROM `users` WHERE email= :email";
    $stmtUsers = $bdd->prepare($sqlUser);
    $stmtUsers->bindParam(":email", $email);
    try {
        $stmtUsers->execute();
    } catch (PDOException $e) {
        return "Erreur 2";
    }

    $user = $stmtUsers->fetch();
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user;
        $_SESSION["role"] = $user["role"];
    }
}
//FUNCTION DISCONNECT
function disconnect()
{
    session_destroy();
}
function updateData($user_id, $lastname, $firstname, $username, $email, $password, $role)
{
    global $bdd;
    if (empty($_POST["password"])) {
        $querysqlData = "UPDATE users SET firstname= :firstname,lastname= :lastname,username= :username,email= :email,role= :role WHERE user_id = :user_id";
    } else {
        $querysqlData = "UPDATE users SET firstname= :firstname,lastname= :lastname,username= :username, password= :password,email= :email,role= :role WHERE user_id = :user_id";
    }
    $stmtUserInsert = $bdd->prepare($querysqlData);
    $stmtUserInsert->bindParam(":user_id", $user_id);
    $stmtUserInsert->bindParam(":firstname", $firstname);
    $stmtUserInsert->bindParam(":lastname", $lastname);
    $stmtUserInsert->bindParam(":username", $username);
    if (!empty($_POST["password"])) {
        $stmtUserInsert->bindParam(":password", $password);
    }
    $stmtUserInsert->bindParam(":email", $email);
    $stmtUserInsert->bindParam(":role", $role);
    try {
        $stmtUserInsert->execute();
    } catch (PDOException $e) {
        $message = "Erreur 1";
    }
    if (!isset($message)) {
        return true;
    }
    return false;
}
function deleteUserAdmin($user_id)
{
    global $bdd;
    $querysqlData = "DELETE FROM users WHERE user_id = :user_id";

    $stmtUserDelete = $bdd->prepare($querysqlData);
    $stmtUserDelete->bindParam(":user_id", $user_id);

    try {
        $stmtUserDelete->execute();
    } catch (PDOException $e) {
        return false;
    }
    return true;
}
function deleteUser($user_id, $user_msg_id)
{
    //Récupération de la connexion à la BDD
    global $bdd;
    //Suppression de l'utilisateur via son id
    $sql = "DELETE FROM users WHERE user_id= :user_id";
    $stmtUserData = $bdd->prepare($sql);
    $stmtUserData->bindParam(":user_id", $user_id);
    $stmtUserData->execute();
    // Suppression des données personnelles de l'utilisateur via son id
    $sql2 = "DELETE FROM users_msg where user_msg_id= :user_msg_id";
    $stmtUserData2 = $bdd->prepare($sql2);
    $stmtUserData2->bindParam(":user_msg_id", $user_msg_id);
    $stmtUserData2->execute();

    return true;
}
function addMsg($msg, $user_id)
{
    global $bdd;
    $sql = "INSERT INTO users_msg (user_id, message) VALUES (:user_id, :message)";
    $stmtUserMsg = $bdd->prepare($sql);
    $stmtUserMsg->bindParam(':user_id', $user_id);
    $stmtUserMsg->bindParam(':message', $msg);
    try {
        $stmtUserMsg->execute();
    } catch (PDOException $e) {
        return false;
    }
    return true;
}
function infoUser($user_id)
{
    global $bdd;
    $sql = "SELECT * FROM users WHERE user_id= :user_id";
    $stmtUser = $bdd->prepare($sql);
    $stmtUser->bindParam(':user_id', $user_id);
    try {
        $stmtUser->execute();
    } catch (PDOException $e) {
        return false;
    }
    $user_info = $stmtUser->fetch();
    return $user_info;
}
