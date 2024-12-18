<?php
session_start();
include '../Controller/UserController.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $userController = new UserController();
    $message = $userController->unblockUserById($user_id);

    $_SESSION['message'] = $message;
    header("Location: listuser.php");
    exit();
} else {
    echo "ID utilisateur invalide ou manquant.";
}
?>
