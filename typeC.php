<?php
require_once('config.php');

class TypeC
{
    // Ajouter un type
    public function addType($type)
    {
        $sql = "INSERT INTO type (type_produit) 
                VALUES (:type_produit)";

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'type_produit' => $type->getType_produit()
            ]);
            echo "Type ajouté avec succès!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Liste des types
    public function listTypes()
    {
        $sql = "SELECT * FROM type";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Supprimer un type
    public function deleteType($id)
    {
        $sql = "DELETE FROM type WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Afficher un type
    public function showType($id)
    {
        $sql = "SELECT * FROM type WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $type = $query->fetch();
            return $type;
        } catch (Exception $e) {
            throw new Exception('Error showing type: ' . $e->getMessage());
        }
    }

    // Mettre à jour un type
    public function updateType($type, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE type SET
                type_produit = :type_produit,
                WHERE id = :id'
            );
            $query->execute([
                'id' => $id,
                'type_produit' => $type->getType_produit(),
            ]);
            echo $query->rowCount() . " enregistrements mis à jour avec succès <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Récupérer un produit par son ID
    public function getProduitById($id)
    {
        $sql = "SELECT * FROM produit WHERE id = :id";
        $db = config::getConnexion();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        try {
            $stmt->execute();
            $row = $stmt->fetch();
            return $row;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Afficher les types par produit_id
    public function listTypesByProduit($produit_id)
    {
        $sql = "SELECT * FROM type WHERE produit_id = :produit_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':produit_id', $produit_id);
            $query->execute();
            $types = $query->fetchAll();
            return $types; // Retourne un tableau contenant tous les types associés au produit
        } catch (Exception $e) {
            throw new Exception('Error fetching types by produit_id: ' . $e->getMessage());
        }
    }
}
