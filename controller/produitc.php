<?php
require_once('config.php');

class ProduitC
{
    // Ajouter un produit
    function addProduit($produit)
    {
        $sql = "INSERT INTO produit (id, type, category, color, quantity) 
                VALUES (:id, :type, :category, :color, :quantity)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $produit->getId(),
                'type' => $produit->getType(),
                'category' => $produit->getCategory(),
                'color' => $produit->getColor(),
                'quantity' => $produit->getQuantity(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Liste des produits
    public function listeProduits()
    {
        $sql = "SELECT * FROM produit";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Supprimer un produit
    function deleteProduit($id)
    {
        $sql = "DELETE FROM produit WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Afficher un produit spécifique
    function showProduit($id)
    {
        $sql = "SELECT * FROM produit WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $produit = $query->fetch();
            return $produit;
        } catch (Exception $e) {
            throw new Exception('Error showing produit: ' . $e->getMessage());
        }
    }

    // Mettre à jour un produit
    function updateProduit($produit, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE produit SET
                type = :type,
                category = :category,
                color = :color,
                quantity = :quantity
                WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'type' => $produit->getType(),
                'category' => $produit->getCategory(),
                'color' => $produit->getColor(),
                'quantity' => $produit->getQuantity(),
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
