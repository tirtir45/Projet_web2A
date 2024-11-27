<?php
session_start();

// Vérifier si l'utilisateur est connecté et a un rôle d'administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$error = "";
$successMessage = "";

// Vérifier si l'ID de l'utilisateur à mettre à jour est passé en paramètre
if (!isset($_GET['id'])) {
    header("Location: listuser.php");
    exit();
}

$user_id = $_GET['id'];

// Inclure le contrôleur UserController et la classe User
include '../Controller/UserController.php';
$userController = new UserController();

// Récupérer l'utilisateur par ID
$user = $userController->getUserById($user_id);

// Si l'utilisateur n'existe pas, rediriger
if (!$user) {
    header("Location: listuser.php");
    exit();
}

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newFirstname = $_POST['firstname'];
    $newLastname = $_POST['lastname'];
    $newGender = $_POST['gender'];
    $newEmail = $_POST['email'];
    $newPassword = $_POST['password'];
    $newRole = $_POST['role'];

    // Créer un objet User avec les nouvelles informations
    $updatedUser = new User(null,$newFirstname, $newLastname, $newGender, $newEmail, $newPassword, $newRole);
    
    // Mettre à jour l'utilisateur
    $userController->updateUser($updatedUser, $user_id);

    $successMessage = "Utilisateur mis à jour avec succès!";
    
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
                            <a class="e-btn d-none d-md-inline-block" href="https://themeforest.net/user/gramentheme/portfolio" target="_blank">Request
                                support</a>
                            <a href="#" class="toggle-navbar">
                                <i class="icon_menu"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of .container -->
    </header>
    <div class="main-content-wrapper">

        <div class="container">
        <h2>Mettre à jour l'utilisateur</h2>
        <button><a href="listuser.php">Back to list</a></button>

<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php if ($successMessage): ?>
    <div class="alert alert-success"><?php echo $successMessage; ?></div>
<?php endif; ?>

<form method="POST">
    <div class="form-group">
        <label for="firstname">Prénom</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>
    </div>
    <div class="form-group">
        <label for="lastname">Nom</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>
    </div>
    <div class="form-group">
        <label for="gender">Genre</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="Male" <?php echo ($user['gender'] == 'Male' ? 'selected' : ''); ?>>Homme</option>
            <option value="Female" <?php echo ($user['gender'] == 'Female' ? 'selected' : ''); ?>>Femme</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="role">Rôle</label>
        <select class="form-control" id="role" name="role" required>
            <option value="admin" <?php echo ($user['role'] == 'admin' ? 'selected' : ''); ?>>Administrateur</option>
            <option value="user" <?php echo ($user['role'] == 'user' ? 'selected' : ''); ?>>Utilisateur</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>







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