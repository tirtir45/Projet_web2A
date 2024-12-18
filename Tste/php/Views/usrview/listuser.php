<?php
session_start();

// Vérifier si l'utilisateur est connecté et a un rôle d'administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include '../Controller/UserController.php';
$userController = new UserController();

if (isset($_GET['search_id']) && !empty($_GET['search_id'])) {
    $searchId = intval($_GET['search_id']);
    $users = [];
    $user = $userController->getUserById($searchId);
    if ($user) {
        $users[] = $user; // Ajouter le résultat dans le tableau
    }
} else {
    // Récupérer la liste des utilisateurs si aucune recherche n'est effectuée
    $users = $userController->listUsers();
}

?>


<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <!-- Basic metas
    ======================================== -->
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Mobile specific metas
    ======================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:title" content="Documentation">
    <meta property="og:url" content="index.html">
    <!-- Page Title
    ======================================== -->
    <title>Addina - Multipurpose eCommerce HTML Template</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- fonts
	======================================== -->
    <link rel="stylesheet" type="text/css" href="css/elegantFont.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/vendor/bootstrap.min.css">
    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->
    <!-- Header starts -->
    <a href="#top" class="back-to-top">
        <i class="fal fa-arrow-up"></i>
    </a>
    <header class="page-header sticky-top" id="top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="logo">
                        <a href="#" class="nav-brand">
                            <img src="images/logo.png" alt="logo" width="155" height="36">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-6">
                    <div class="right-part d-flex justify-content-end align-items-center">
                        <form action="#" class="search-form d-none d-lg-block">
                            <div class="input-group">
                                <input type="text" class="search-input" placeholder="Search item">
                            </div>
                        </form>
                        <div class="nav-list">
                            <a class="e-btn d-none d-md-inline-block" href="logout.php" target="_blank">Se déconnecter
                                </a>
                           
                        </div>
                    </div>
                </div>
            </div>
   

        </div>
        <!-- End of .container -->
    </header>
    <div class="main-content-wrapper">
        <div class="container ">





        <h2>Liste des utilisateurs</h2>
<!-- Bouton pour ajouter un nouvel utilisateur -->
<a href="adduser.php" class="btn btn-success btn-sm">Ajouter un utilisateur</a>
<form method="GET" action="" class="form-inline mb-3">
    <label for="search-id" class="mr-2">Rechercher par ID :</label>
    <input type="text" id="search-id" name="search_id" class="form-control mr-2" placeholder="Entrer l'ID" >
    <button type="submit" class="btn btn-primary">Rechercher</button>
</form>

<br><br> <!-- Ajouter un peu d'espace avant la table -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['firstname']; ?></td>
                <td><?php echo $user['lastname']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                <td>
                    <a href="updateuser.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Modifier</a>
                   <a href="deleteuser.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                   <a href="blockuser.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir blocker cet utilisateur?');">block</a>
                   <a href="unblockuser.php?id=<?php echo $user['id']; ?>" 
   class="btn btn-success" 
   onclick="return confirm('Êtes-vous sûr de vouloir débloquer cet utilisateur ?');">
   Débloquer l'utilisateur
</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>









            <!-- End of .main-content -->
        </div>
        <!-- End of .container -->
    </div>
    <!-- End of .main-content -->
    <footer class="tp-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-footer">
                        <p>Copyright © 2024 Addina All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="social-footer text-md-right">
                        <a href="index.html">
                            <i class="social_youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of .page-footer -->
    <!-- Javascripts
		======================================= -->
    <!-- jQuery -->
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/jquery-migrate.min.js"></script>
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <!-- jQuery Easing Plugin -->
    <script src="js/vendor/easing-1.3.js"></script>
  
    <!-- Custom Script -->
    <script src="js/onpage-menu.js"></script>
    <script src="js/main.js"></script>
</body>

</html>