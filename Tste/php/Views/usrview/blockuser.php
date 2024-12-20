<?php
session_start();
include '../../Controller/UserController.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $userController = new UserController();

    // Appeler la méthode pour bloquer l'utilisateur
    $message = $userController->blockUserById($user_id);

    // Afficher le message ou rediriger
    echo $message;

    // Redirection (optionnelle)
    // header("Location: userlist.php");
    // exit();
} else {
    echo "Invalid or missing user ID.";
}
?>
