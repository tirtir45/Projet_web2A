<?php
    require_once('C:/xampp/htdocs/foued_benyou/controller/produitc.php');
    $produitC= new produitC();
$produitC->deleteProduit($_GET['id']);
header('Location: liste_produit.php');

?>