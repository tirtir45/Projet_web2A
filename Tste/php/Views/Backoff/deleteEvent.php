<?php
require_once(__DIR__ . '/../../Controller/EventController.php');
$eventC= new EventController();
$eventC->deleteEvent($_GET["id"]);
header('Location:Eventlist.php');
?>