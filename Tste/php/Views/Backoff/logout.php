<?php
session_start();
session_unset();  // Libère toutes les variables de session
session_destroy();  // Détruit la session

// Rediriger vers la page de connexion après la déconnexion
header("Location: login.php");
exit();
?>
