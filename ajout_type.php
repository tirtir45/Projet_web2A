<?php
// Inclure les fichiers nécessaires pour la gestion des réservations
require_once('C:/xampp/htdocs/foued_benyou/controller/produitc.php');
require_once('C:/xampp/htdocs/foued_benyou/model/produit.php');
require_once('C:/xampp/htdocs/foued_benyou/controller/typec.php');
require_once('C:/xampp/htdocs/foued_benyou/model/type.php');

$produitC = new ProduitC();
$typeC = new TypeC();

$allProduits = $produitC->listeProduits();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_dump = $_POST["id"];
    var_dump($id_dump);
    // Vérifier que tous les champs nécessaires sont présents
    if (isset($_POST["id"]) && !empty($_POST["id"]) && isset($_POST["type_produit"]) && !empty($_POST["type_produit"])) {
        $id = $_POST["id"];  // ID unique du type
        $type_produit = $_POST["type_produit"];  // Nom du type

        // Créer un nouvel objet Type
        $type = new Type(
            null,  // Si un champ supplémentaire pour l'objet est nécessaire
            $type_produit,
            $id
        );

        // Ajouter le type à la base de données
        $typeC->addType($type);

        header('Location: /foued_benyou/view/listeType.php');
        exit();
    } else {
        // Si certains champs sont manquants
        echo "<script>alert('Veuillez remplir tous les champs requis !');</script>";
    }
} else {
    // Si la requête n'est pas de type POST
    echo "<script>alert('Accès non autorisé !');</script>";
}
