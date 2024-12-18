<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte Désactivé</title>
    <link rel="stylesheet" href="style.css"> <!-- Incluez votre style si disponible -->
</head>
<body>
    <div class="container">
        <h1>Votre compte a été désactivé</h1>
        <p>Votre compte est maintenant désactivé pendant 30 jours. Vous ne pourrez plus vous connecter durant cette période.</p>
        <p>Si vous souhaitez réactiver votre compte, veuillez contacter notre support ou attendre la fin de la période de désactivation.</p>
        <a href="contact.php" class="btn btn-primary">Contactez-nous</a>
    </div>
</body>
</html>
