<?php
ob_start();
require_once(__DIR__ . '/../../Controller/EventController.php');
$eventC= new EventController();
$eventC->deleteEvent($_GET["id"]);
ob_end_clean();
header('Location:EventList.php');
exit();
?>