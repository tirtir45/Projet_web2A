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
		}catch(Execption $e){
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
  function updateReservation($id,$idC,$idE,$details,$dateC,$dateR,$statut)
  {
      if (!$dateR) {
    $sql = "UPDATE Reservation 
            SET idClient = :idClient, IdEvenement = :idEvenement, details = :details, dateCreation = :dateCreation, statut = :statut 
            WHERE IdDemande = :id";
}else{
	  $sql = "UPDATE Reservation 
            SET  idClient = :idClient, IdEvenement = :idEvenement, details = :details, dateCreation = :dateCreation, dateReservation = :dateReservation, statut = :statut 
            WHERE IdDemande = :id";
}   
	  $db=config::getConnexion();
	  try{
		$query = $db->prepare($sql);
		$query->bindParam(':idClient', $idC, PDO::PARAM_INT);
        $query->bindParam(':IdEvenement', $idE, PDO::PARAM_INT);
        $query->bindParam(':details', $details, PDO::PARAM_STR);
        $query->bindParam(':dateCreation', $dateC);
        $query->bindParam(':dateReservation',$dateR);
        $query->bindParam(':statut', $statut, PDO::PARAM_STR);
        $query->bindParam(':id',$id);
        $query->execute();
        return true;
      }catch(Exception $e){
                  error_log("Error updating reservation: " . $e->getMessage());
		  return false;
	  }
  }
}
?>