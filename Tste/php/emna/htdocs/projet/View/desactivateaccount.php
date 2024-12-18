<?php
session_start();
include '../Controller/UserController.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigez vers la page de connexion si non connecté
    exit();
}

// Récupérez l'ID de l'utilisateur depuis la session
$user_id = $_SESSION['user_id'];

// Instance du contrôleur
$userController = new UserController();

// Appeler la méthode pour désactiver le compte
$message = $userController->deactivateAccountById($user_id);

// Détruisez la session après désactivation
if (strpos($message, "succès") !== false) {
    session_destroy();
    header("Location: goodbye.php"); // Page pour informer que le compte est désactivé
    exit();
} else {
    echo $message;
}
?>
