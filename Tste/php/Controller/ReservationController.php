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
	function addReservation($Rs) {
    $sql = "INSERT INTO Reservation (idClient, IdEvenement, details, dateCreation, dateReservation, statut)
            VALUES (:idClient, :IdEvenement, :details, :dateCreation, :dateReservation, :statut)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $details = $Rs->getDetails();
        $idC = $Rs->getIdC();
        $idE = $Rs->getIdE();
        $dateC = $Rs->getDateC() ? $Rs->getDateC()->format('d/m/Y H:i') : null;
        $dateR = $Rs->getDateR() ? $Rs->getDateR()->format('d-m-Y H:i:s') : null;
	

        $statut = $Rs->getEtat();

        $query->bindParam(':idClient', $idC);
        $query->bindParam(':IdEvenement', $idE);
        $query->bindParam(':details', $details);
        $query->bindParam(':dateCreation', $dateC);
        $query->bindParam(':dateReservation', $dateR);
        $query->bindParam(':statut', $statut);

        $query->execute();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


	function showReservation($id)
  {
      $sql = "SELECT * FROM Reservation where IdDemande = $id";
      $db = config::getConnexion();
      try {
          $query = $db->prepare($sql);
          $query->execute();

          $Rs = $query->fetch();
          return $Rs;
      } catch (Exception $e) {
          die('ErrorShw: ' . $e->getMessage());
      }
  }
  function updateReservation($Rs, $id)
  {
	  $sql = "UPDATE Reservation 
            SET  idClient = :idClient, idEvenement = :idEvenement, details = :details, dateCreation = :dateCreation, dateReservation = :dateReservation, statut = :statut 
            WHERE IdDemande = :id";
	  $db=config::getConnexion();
	  try{
		  $query=$db->prepare($sql);

		  $details=$Rs->getDetails();
		  $dateC=$Rs->getDateC()->format('d-m-Y  H:i:s');
		  $dateR=$Rs->getDateR()->format('d-m-Y  H::i::s');
		  $state=$Rs->getEtat();

		  $query->bindParam(':details', $details);
		  $query->bindParam(':dateCreation', $dateC);
		  $query->bindParam(':dateReservation', $dateR);
		  $query->bindParam(':statut', $state);
		  $query->bindParam(':id', $id);

		  
		  $query->execute();

	  } catch(Exception $e){
		  echo 'ErrorUpdt: ' . $e->getMessage();
	  }
  }
}
?>