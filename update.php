<?php
include "C:\xampp\htdocs\projet\controller\reclamationc.php";
include "C:\xampp\htdocs\projet\model\reclamation.php";

$recController = new Reclamationc();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer la réclamation à mettre à jour
    $reclamation = $recController->viewReclamationById($id);
    
    if (!$reclamation) {
        echo "Réclamation non trouvée.";
        exit;
    }
} else {
    echo "Aucun identifiant de réclamation fourni.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et validation des données du formulaire
    $objet = strtoupper($_POST["objet"]);
    $detail = strtolower($_POST["detail"]);
    $categorie = $_POST["categorie"];

    // Mettre à jour la réclamation
    $updatedRec = new Reclamation($id, $objet, $detail, $reclamation->getStatut(), new DateTime(), $categorie); // Conserver le statut existant
    $recController->updateReclamation($updatedRec);

    // Rediriger vers la liste des réclamations après la mise à jour
    header('Location: reclamtionliste.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réclamation - Khomsa & Khmis</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            padding: 10px 0;
            text-align: center;
        }
        .nav-links {
            list-style-type: none;
            padding: 0;
        }
        .nav-links li {
            display: inline;
            margin: 0 15px;
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 20px;
        }
        .update-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Khomsa & Khmis</h1>
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
        <section class="update-section">
            <h2>Modifier la Réclamation</h2>
            <form action="" method="POST">
                <label for="objet">Objet</label>
                <input type="text" id="objet" name="objet" value="<?php echo htmlspecialchars($reclamation->getObjet()); ?>" required>
                
                <label for="detail">Détail de la réclamation</label>
                <textarea id="detail" name="detail" required><?php echo htmlspecialchars($reclamation->getDetail()); ?></textarea>
                
                <label for="categorie">Catégorie</label>
                <select id="categorie" name="categorie" required>
                    <option value="Site" <?php echo ($reclamation->getCategorie() === 'Site') ? 'selected' : ''; ?>>Site</option>
                    <option value="Événement" <?php echo ($reclamation->getCategorie() === 'Événement') ? 'selected' : ''; ?>>Événement</option>
                    <option value="Autre" <?php echo ($reclamation->getCategorie() === 'Autre') ? 'selected' : ''; ?>>Autre</option>
                </select>

                <button type="submit">Mettre à jour</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Khomsa & Khmis. Tous droits réservés.</p>
    </footer>
</body>
</html>