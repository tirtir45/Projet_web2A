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
        isset($_POST["quantity"])
    ) {
        // Vérifier que les champs ne sont pas vides
        if (
            !empty($_POST["id"]) &&
            !empty($_POST["type"]) &&
            !empty($_POST["category"]) &&
            !empty($_POST["color"]) &&
            !empty($_POST["quantity"])
        ) {

            $PRODUITID = $_POST["id"];
            if (!is_numeric($PRODUITID) || $PRODUITID <= 0) {
                echo '<script>
                        alert("LE ID DOIT ETRE POSITIVE");
                        window.location.href = "/foued_benyou/view/frontofiice/produit.html";
                      </script>';
                exit(); // Stop execution if quantity is invalid
            }

            // Vérifier que la quantité est un nombre positif
            $quantity = $_POST["quantity"];
            if (!is_numeric($quantity) || $quantity <= 0) {
                echo '<script>
                        alert("La quantité doit être un nombre positif supérieur à zéro.");
                        window.location.href = "/foued_benyou/view/frontofiice/produit.html";
                      </script>';
                exit(); // Stop execution if quantity is invalid
            }

            // Instanciation de la classe produit
            $produit = new Produit(
                $_POST["id"],
                $_POST["type"],
                $_POST["category"],
                $_POST["color"],
                $quantity // Use validated quantity
            );

            // Ajouter le produit à la base de données
            $produitC->addProduit($produit);

            // Rediriger l'utilisateur vers la page des produits après ajout
            header('Location: liste_produit.php');
            exit(); // Ensure no further code is executed after redirect
        } else {
            // Afficher un message d'erreur si des champs sont vides
            echo '<script>
                    alert("Tous les champs doivent être remplis");
                    window.location.href = "ajout_panier.php";
                  </script>';
        }
    } else {
        // Afficher un message d'erreur si des champs sont manquants
        echo '<script>
                alert("Veuillez remplir tous les champs du formulaire");
                window.location.href = "ajout_panier.php";
              </script>';
    }
}
