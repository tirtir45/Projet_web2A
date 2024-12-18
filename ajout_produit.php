<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ajouter le produit à la base de données
    require_once('C:/xampp/htdocs/foued_benyou/controller/produitc.php');
    require_once('C:/xampp/htdocs/foued_benyou/model/produit.php');

    $produit = null;
    $produitC = new produitC();

    // Vérifier si tous les champs nécessaires sont définis
    if (
        isset($_POST["id"]) &&
        isset($_POST["type"]) &&
        isset($_POST["category"]) &&
        isset($_POST["color"]) &&
        isset($_POST["quantity"]) &&
        isset($_POST["name"])
    ) {
        // Vérifier que les champs ne sont pas vides
        if (
            !empty($_POST["id"]) &&
            !empty($_POST["type"]) &&
            !empty($_POST["category"]) &&
            !empty($_POST["color"]) &&
            !empty($_POST["quantity"]) &&
            !empty($_POST["name"])
        ) {
            // Tous les champs nécessaires sont remplis;

            // Créer une instance de la classe Produit
            $produit = new Produit(
                $_POST["id"],
                $_POST["type"],
                $_POST["category"],
                $_POST["color"],
                $_POST["quantity"],
                $_POST["name"],
                $_POST["typeId"]


            );

            // Ajouter le produit à la base de données
            $produitC->addProduit($produit);

            // Rediriger l'utilisateur vers la page des produits après ajout
            header('Location:  liste_produit.php');
        } else {
            // Afficher un message d'erreur si des champs sont vides
            echo '<script>
                    alert("Tous les champs doivent être remplis");
                    window.location.href = "../view/ajouter_produit.php";
                  </script>';
        }
    } else {
        // Afficher un message d'erreur si des champs sont manquants
        echo '<script>
                alert("Veuillez remplir tous les champs du formulaire");
                window.location.href = "../view/ajouter_produit.php";
              </script>';
    }
}
