<?php
ob_start();
require_once(__DIR__ . '/../../Controller/ReservationController.php');
$ResC = new ReservationController();
$ResC->deleteReservation($_GET["id"]);
ob_end_clean();
header('Location:listReservation.php');
exit();
?>
