<?php
require_once(__DIR__ . '/../../Controller/ReservationController.php');
$ResC = new ReservationController();
$ResC->deleteReservation($_GET["id"]);
header('Location:listReservation.php');
?>