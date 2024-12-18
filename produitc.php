<?php
require_once('config.php');

class ProduitC
{
    // Ajouter un produit
    function addProduit($produit)
    {
        $sql = "INSERT INTO produit (id,type,name,category, color, quantity,typeId) 
                VALUES (:id,:type,:name,:category, :color, :quantity,:typeId)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $produit->getId(),
                'name' => $produit->getName(),
                'type' => $produit->getType(),
                'category' => $produit->getCategory(),
                'color' => $produit->getColor(),
                'quantity' => $produit->getQuantity(),
                'typeId' => $produit->gettypeId(),

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
                name=:name,
                category = :category,
                color = :color,
                quantity = :quantity
                WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'type' => $produit->getType(),
                'name' => $produit->getName(),
                'category' => $produit->getCategory(),
                'color' => $produit->getColor(),
                'quantity' => $produit->getQuantity(),
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function searchProduitByType($searchTerm)
    {
        $sql = "SELECT * FROM produit 
            WHERE id LIKE :searchTerm
            OR name LIKE :searchTerm
            OR type LIKE :searchTerm
            OR category LIKE :searchTerm
            OR color LIKE :searchTerm
            OR quantity LIKE :searchTerm
            OR typeId LIKE :searchTerm";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'searchTerm' => '%' . $searchTerm . '%'
            ]);
            return $query->fetchAll(); // Returns all matching results
        } catch (Exception $e) {
            throw new Exception('Error searching produits: ' . $e->getMessage());
        }
    }
}
