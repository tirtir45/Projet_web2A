<?php
include_once "C:/xampp/htdocs\projet/config.php";
class Reclamationc
{
public function addReclamation($rec)
{
$sql="INSERT INTO reclamations VALUES(NULL,:objet,:detail,:statut,:datee,:categorie)";
$db=config::getConnexion();
try{
$req = $db->prepare($sql);
$req->execute([
"objet" => $rec->getObjet(),
"detail" => $rec->getDetail(),
"statut" => $rec->getStatut(),
"datee"=> $rec->getDatee()->format('d/m/y'),
"categorie"=> $rec->getCategorie()
]);
}
catch(Exeption $e) {
die('error d ajout' .$e->getMessage());
}
}
public function viewReclamation()
{
$sql = "SELECT * FROM reclamation"; // Récupère toutes les réclamations
$db = config::getConnexion();

    try {
        $req = $db->prepare($sql);
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats sous forme de tableau associatif

        $reclamations = [];
        foreach ($results as $row) {
            $reclamations[] = new Reclamation(
                $row['id'], // Assurez-vous que 'id' est le bon nom de colonne
                $row['objet'],
                $row['detail'],
                $row['statut'],
                new DateTime($row['datee']), // Assurez-vous que 'datee' est le bon nom de colonne
                $row['categorie']
            );
        }
        return $reclamations; // Retourne le tableau d'objets Reclamation
    } catch (Exception $e) {
        die('Erreur de récupération: ' . $e->getMessage());
    }
} 
public function deleteReclamation($id)
{
    $sql = "DELETE FROM reclamation WHERE id = :id";
    $db = config::getConnexion();

    try {
        $req = $db->prepare($sql);
        $req->execute(['id' => $id]);
    } catch (Exception $e) {
        die('Erreur lors de la suppression: ' . $e->getMessage());
    }
}
public function viewReclamationById($id)
{
    $sql = "SELECT * FROM reclamation WHERE id = :id";
    $db = config::getConnexion();

    try {
        $req = $db->prepare($sql);
        $req->execute(['id' => $id]);
        
        // Récupération de la réclamation sous forme de tableau associatif
        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            // Créer un objet Reclamation avec conversion de datee en DateTime
            return new Reclamation(
                $result['id'],
                $result['objet'],
                $result['detail'],
                $result['statut'],
                new DateTime($result['datee']), // Conversion de datee en DateTime
                $result['categorie']
            );
        }
        return null; // Retourne null si aucune réclamation n'est trouvée
    } catch (Exception $e) {
        die('Erreur lors de la récupération: ' . $e->getMessage());
    }
}

public function updateReclamation($rec)
{
    $sql = "UPDATE reclamation SET objet = :objet, detail = :detail, statut = :statut, datee = :datee, categorie = :categorie WHERE id = :id";
    $db = config::getConnexion();

    try {
        $req = $db->prepare($sql);
        $req->execute([
            'id' => $rec->getId(),
            'objet' => $rec->getObjet(),
            'detail' => $rec->getDetail(),
            'statut' => $rec->getStatut(),
            'datee'=> $rec->getDatee()->format('d/m/y'),
            'categorie' => $rec->getCategorie()
        ]);
    } catch (Exception $e) {
        die('Erreur lors de la mise à jour: ' . $e->getMessage());
    }
}
}
?>