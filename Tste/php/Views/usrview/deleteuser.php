<?php
session_start();

// Vérifier si l'utilisateur est connecté et a un rôle d'administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Vérifier si l'ID de l'utilisateur à supprimer est passé en paramètre
if (!isset($_GET['id'])) {
    header("Location: listuser.php");
    exit();
}

$user_id = $_GET['id'];

// Inclure le contrôleur UserController
include '../../Controller/UserController.php';

$userController = new UserController();

// Supprimer l'utilisateur
$userController->deleteUser($user_id);

// Rediriger vers la liste des utilisateurs après la suppression
header("Location: listuser.php");
exit();
?>
