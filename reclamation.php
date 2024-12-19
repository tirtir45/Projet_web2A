<?php
// Corrigez les chemins pour inclure correctement les fichiers
include "C:/xampp/htdocs\projet/config.php";
include "C:/xampp/htdocs/projet/controller/reclamationc.php";
include "C:/xampp/htdocs/projet/model/reclamation.php";

$error = null;
$r = null;

if (
    isset($_POST["objet"]) &&
    isset($_POST["detail"]) &&
    isset($_POST["categorie"])
) {
    if (
        !empty($_POST["objet"]) &&
        !empty($_POST["detail"]) &&
        !empty($_POST["categorie"])
    ) {
        $r = new Reclamation(
            NULL,
            strtoupper($_POST["objet"]), // Objet en majuscules
            strtolower($_POST["detail"]), // Détail en minuscules
            "Non traitée", // Statut par défaut
            new DateTime(), // Date actuelle
            $_POST["categorie"]
        );
        $rec = new Reclamationc();
        $rec->addReclamation($r);
        header('Location: reclamtionliste.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réclamations - Khomsa & Khmis</title>
    <link rel="stylesheet" href="rec.css">
    <script>
  
function validateForm() {
    const subject = document.getElementById("subject").value.trim();
    const message = document.getElementById("message").value.trim();
    const category = document.getElementById("category").value.trim();

    // Vérifier que toutes les cases sont remplies
    if (subject === "") {
        alert("Veuillez renseigner l'objet de votre réclamation.");
        return false;
    }
    if (message === "") {
        alert("Veuillez détailler votre réclamation.");
        return false;
    }
    if (category === "") {
        alert("Veuillez sélectionner une catégorie.");
        return false;
    }

    // Vérifier que l'objet est en majuscules
    if (subject !== subject.toUpperCase()) {
        alert("L'objet doit être en majuscules.");
        return false;
    }

    // Vérifier que la description est en minuscules
    if (message !== message.toLowerCase()) {
        alert("La description doit être en minuscules.");
        return false;
    }}

    return true; // Si toutes les validations passent

    </script>
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
    <section class="reclamation-section">
        <h2>Réclamations</h2>
        <p>Soumettez vos réclamations concernant la préservation des sites patrimoniaux.</p>
        <form action="" method="POST" class="row g-4" onsubmit="return validateForm()">
            <label for="subject">Objet</label>
            <input type="text" id="subject" name="objet" placeholder="Objet de la réclamation" required>

            <label for="message">Détail de la réclamation</label>
            <textarea id="message" name="detail" placeholder="Décrivez votre réclamation" required></textarea>

            <label for="category">Catégorie</label>
            <select id="category" name="categorie" required>
                <option value="">Sélectionnez une catégorie</option>
                <option value="Site">Site</option>
                <option value="Événement">Événement</option>
                <option value="Autre">Autre</option>
            </select>

            <button type="submit">Soumettre</button>
        </form>
    </section>
    <a href="projet/view/back/back-office-reclamations.php">Gestion des réclamations</a>

    <!-- Section de confirmation après soumission -->
    <section class="reclamation-confirmation" style="display: none;">
        <p>Votre réclamation a été soumise avec succès. Nous vous remercions pour votre contribution à la préservation du patrimoine culturel.</p>
    </section>
</main>

<footer>
    <p>&copy; 2024 Khomsa & Khmis. Tous droits réservés.</p>
</footer>

</body>
</html>

