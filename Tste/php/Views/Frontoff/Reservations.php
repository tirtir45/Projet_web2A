<?php
require_once(__DIR__ . '/../../Controller/ReservationController.php');

$resC = new ReservationController();
$list = $resC->listEvent();
?>
<!DOCTYPE html>