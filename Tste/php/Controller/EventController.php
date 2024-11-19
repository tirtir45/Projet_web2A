<?php
require_once(__DIR__ . '/../connect.php');
require_once(__DIR__ . '/../Models/Event.php');

class EventController {
	public function listEvent(){
		$sql="SELECT * FROM Evenement";
		$db=config::getConnexion();
		try{
			$list=$db->query($sql);
			return $list;
		}catch(Execption $e){
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
    {   var_dump($Ev);
        $sql = "INSERT INTO Evenement  
        VALUES (NULL, :title, :Pic, :category, :description, :disponibility, :price)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'title' => $Ev->getTitle(),
                'Pic' => $Ev->getPic(),
                'category' => $Ev->getCategory(), 
                'description' => $Ev->getDescription(),
                'disponibility' => $Ev->getAvailability()? 1 : 0,
                'price' => $Ev->getPrice()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
	function updateOffer($Ev, $id)
    {
        var_dump($Ev);
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE Evenement SET 
                    title = :title,
                    Pic = :pic,
                    category = :category,
                    description = :description,
                    disponibility = :disponibility,
                    price =price,
                WHERE IdEvent = :id'
            );

            $query->execute([
                'id' => $id,
                'title' => $Ev->getTitle(),
                'pic' => $Ev->getPic(),
                'category' => $Ev->getCategory(), 
                'description' => $Ev->getDescription(),
                'disponibility' => $Ev->getAvailability() ? 1 : 0,
                'price' => $Ev->getPrice()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
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