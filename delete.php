<?php
include "C:\xampp\htdocs\projet\controller\reclamationc.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance du contrôleur
    $recController = new Reclamationc();
    
    // Appel de la méthode pour supprimer la réclamation
    $recController->deleteReclamation($id);

    // Rediriger vers la liste des réclamations après la suppression
    header('Location: reclamtionliste.php');
    exit;
} else {
    echo "Aucun identifiant de réclamation fourni.";
}
?