<?php
require_once(__DIR__ . '/../connect.php');
require_once(__DIR__ . '/../Models/Event.php');

class EventController {
	public function listEvent(){
    $sql = "SELECT * FROM Evenement";
    $db = config::getConnexion();
    try {
        $list = $db->query($sql);
        $elist = $list->fetchAll(PDO::FETCH_ASSOC);

        foreach ($elist as &$event) {
            if (!empty($event['Pic'])) {
                $Pic64 = base64_encode($event['Pic']);
                $event['Pic'] = 'data:image/jpg;base64,' . $Pic64;
            }
        }

        return $elist;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

	function deleteEvent($id){
		$sql="DELETE FROM Evenement WHERE IdEvent = :id";
		$db=config::getConnexion();
		$req=$db->prepare($sql);
		$req->bindValue(':id', $id);
		try{
			$req->execute();
		}catch(Execption $e){
			die('Error: ' . $e->getMessage());
		}

	}
function addEvent($Ev)
{
    $sql = "INSERT INTO Evenement (title, Pic, category, description, disponibility, price)  
            VALUES (:title, :Pic, :category, :description, :disponibility, :price)";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $title = $Ev->getTitle();
        $Pic = $Ev->getPic();
        $category = $Ev->getCategory();
        $description = $Ev->getDescription();
        $disponibility = $Ev->getAvailability() ? 1 : 0;
        $price = $Ev->getPrice();

        $query->bindParam(':title', $title);
        $query->bindParam(':Pic', $Pic, PDO::PARAM_LOB);
        $query->bindParam(':category', $category);
        $query->bindParam(':description', $description);
        $query->bindParam(':disponibility', $disponibility);
        $query->bindParam(':price', $price);

        $query->execute();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


	function updateEvent($Ev, $id)
{
    $sql = "UPDATE Evenement 
            SET title = :title, Pic = :Pic, category = :category, description = :description, disponibility = :disponibility, price = :price 
            WHERE IdEvent = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);

        $title = $Ev->getTitle();
        $Pic = $Ev->getPic();
        $category = $Ev->getCategory();
        $description = $Ev->getDescription();
        $disponibility = $Ev->getAvailability() ? 1 : 0;
        $price = $Ev->getPrice();

        $query->bindParam(':title', $title);
        $query->bindParam(':Pic', $Pic, PDO::PARAM_LOB);
        $query->bindParam(':category', $category);
        $query->bindParam(':description', $description);
        $query->bindParam(':disponibility', $disponibility);
        $query->bindParam(':price', $price);
        $query->bindParam(':id', $id);

        $query->execute();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

     function showEvent($id)
    {
        $sql = "SELECT * FROM Evenement where IdEvent = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $Ev = $query->fetch();
            return $Ev;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>