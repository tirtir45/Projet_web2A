<?php
include '..\projet\config.php';
include '..\projet\controller\reclamationc.php';
include '..\projet\model\reclamation.php';

$recController = new Reclamationc();
$reclamations = $recController->getAllReclamations(); // Supposons que cette méthode récupère toutes les réclamations

if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    $recController->deleteReclamation($idToDelete);
    header('Location: backOfficeReclamations.php');
    exit;
}

if (isset($_GET['update_status'])) {
    $idToUpdate = $_GET['update_status'];
    $newStatus = $_GET['status'];
    $recController->updateReclamationStatus($idToUpdate, $newStatus);
    header('Location: backOfficeReclamations.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Réclamations - Khomsa & Khmis</title>
    <link rel="stylesheet" href="bck.css">
</head>
<body>

<header class="header">
    <h1>Gestion des Réclamations - Khomsa & Khmis</h1>
    <nav>
        <ul class="nav-links">
            <li><a href="index.html">Accueil</a></li>
            <li><a href="compte.html">Compte</a></li>
            <li><a href="sites-patrimoniaux.html">Sites Patrimoniaux</a></li>
            <li><a href="evenements.html">Événements & Actualités</a></li>
            <li><a href="reclamtionliste.php">Consulter Réclamation</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="reclamation-list">
        <h2>Liste des Réclamations</h2>
        
        <!-- Table des réclamations -->
        <table>
            <thead>
                <tr>
                    <th>Objet</th>
                    <th>Détail</th>
                    <th>Catégorie</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reclamations as $reclamation): ?>
                    <tr>
                        <td><?php echo $reclamation['objet']; ?></td>
                        <td><?php echo $reclamation['detail']; ?></td>
                        <td><?php echo $reclamation['categorie']; ?></td>
                        <td><?php echo $reclamation['statut']; ?></td>
                        <td><?php echo $reclamation['date_reclamation']; ?></td>
                        <td>
                            <!-- Actions de gestion -->
                            <a href="?update_status=<?php echo $reclamation['id']; ?>&status=Traité">Marquer comme traité</a> |
                            <a href="?update_status=<?php echo $reclamation['id']; ?>&status=Non traité">Marquer comme non traité</a> |
                            <a href="?delete=<?php echo $reclamation['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<footer>
    <p>&copy; 2024 Khomsa & Khmis. Tous droits réservés.</p>
</footer>

</body>
</html>
