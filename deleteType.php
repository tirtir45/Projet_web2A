<?php
    require_once('C:/xampp/htdocs/foued_benyou/controller/typec.php');
    $typeC= new typeC();
$typeC->deleteType($_GET['id']);
header('Location: listeType.php');
?>