<?php
session_start();
ob_start();
include '../../Controller/UserController.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $userController = new UserController();
    $message = $userController->unblockUserById($user_id);

    $_SESSION['message'] = $message;
    ob_end_clean();
    header("Location: listuser.php");
    exit();
} else {
    ob_end_flush();
    echo "ID utilisateur invalide ou manquant.";
}
?>
