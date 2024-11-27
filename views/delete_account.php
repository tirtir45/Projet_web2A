<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de login
    header("Location: login.php");
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Inclure le contrôleur UserController pour gérer la suppression
include '../Controller/UserController.php';
$userController = new UserController();

// Appeler la méthode pour supprimer l'utilisateur par ID
$deleteResult = $userController->desactiviercompte($user_id);

if ($deleteResult === "User deleted successfully!") {
    // Supprimer les données de la session après suppression
    session_destroy();
    header("Location: login.php"); // Rediriger vers la page de login après la suppression
    exit();
} else {
    // Gérer l'erreur si la suppression échoue
    echo "Erreur lors de la suppression du compte.";
}

?>
