<?php 
require_once(__DIR__ . '/../connect.php');
require_once(__DIR__ . '/../Models/Reservation.php');
require_once(__DIR__ . '/../Controller/EventController.php');
require_once(__DIR__ . '/../Controller/UserController.php');

class ReservationController{
	public function listReservation(){
	$sql = "SELECT * FROM Reservation";
    $db = config::getConnexion();
	try{
		$list=$db->query($sql);
		return $list;
	}
	catch(Exception $e){
		die('ErrorLst: ' . $e->getMessage());
	}
    }
	function deleteReservation($id){
		$sql="DELETE FROM Reservation WHERE IdDemande = :id";
		$db=config::getConnexion();
		$req=$db->prepare($sql);
		$req->bindValue(':id', $id);
		try{
			$req->execute();
		}catch(Exception $e){
			die('ErrorDel: ' . $e->getMessage());
		}
	}
function addReservation($idC,$idE,$details,$dateC,$statut) {
    $sql = "INSERT INTO Reservation (idClient, IdEvenement, details, dateCreation, statut)
            VALUES (:idClient, :IdEvenement, :details, :dateCreation,:statut)";
    $db = config::getConnexion();
    try { 
	
        $query = $db->prepare($sql);
       
        $query->bindParam(':idClient', $idC, PDO::PARAM_INT);
        $query->bindParam(':IdEvenement', $idE, PDO::PARAM_INT);
        $query->bindParam(':details', $details, PDO::PARAM_STR);
        $query->bindParam(':dateCreation', $dateC);
        $query->bindParam(':statut', $statut, PDO::PARAM_STR);

        $query->execute();
        return true;

    } catch (Exception $e) {
        error_log("Error adding reservation: " . $e->getMessage());
        return false; 
    }
}


function showReservation($id)
{
    $sql = "SELECT * FROM Reservation WHERE IdDemande = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $Rs = $query->fetch(PDO::FETCH_ASSOC); 
        return $Rs;
    } catch (Exception $e) {
        error_log('ErrorShw: ' . $e->getMessage()); 
        return false; 
    }
}
            function updateReservation($Res, $id)
            {
                $sql = "UPDATE Reservation 
                        SET details = :details, dateCreation = :dateCreation, statut = :statut ,dateReservation= :dateReservation
                        WHERE IdDemande = :id";
                
                $db = config::getConnexion();
                
                try {
                    $query = $db->prepare($sql);

                    $details = $Res->getDetails();
                    $dateCreation = $Res->getDateC()->format('Y-m-d H:i:s');
                    $statut = $Res->getEtat();
                    $dateR = $Res->getDateR()->format('Y-m-d H:i:s');

                    $query->bindParam(':details', $details);
                    $query->bindParam(':dateCreation', $dateCreation);
                    $query->bindParam(':statut', $statut);
                    $query->bindParam(':dateReservation', $dateR);

                    $query->bindParam(':id', $id);

                    // Execute the query
                    if ($query->execute()) {
                        $rowsAffected = $query->rowCount();
                        if ($rowsAffected > 0) {
                            return true;
                        }
                        return false; // No rows updated
                    } else {
                        echo "Erreur SQL: " . implode(" ", $query->errorInfo());
                        return false;
                    }
                } catch (Exception $e) {
                    error_log('Error: ' . $e->getMessage());
                    echo 'Error: ' . $e->getMessage();
                    return false;
                }
            }
}
?>