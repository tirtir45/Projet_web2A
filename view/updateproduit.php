<?php
 
 require_once('C:/xampp/htdocs/foued_benyou/controller/produitc.php');
 require_once('C:/xampp/htdocs/foued_benyou/model/produit.php');
 $produit = null;
$produitc = new produitC();  // Assuming the class name is ProductC, modify if necessary.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the panier details based on ID
    $produit = $produitc->showProduit($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (    isset($_POST["id"]) &&
    isset($_POST["type"]) &&
    isset($_POST["category"]) &&
    isset($_POST["color"]) &&
    isset($_POST["quantity"])
) {
    if (
        !empty($_POST["id"]) &&
        !empty($_POST["type"]) &&
        !empty($_POST["category"]) &&
        !empty($_POST["color"]) &&
        !empty($_POST["quantity"])
    ) {
        // Create a new Product object with the form data
        $produit = new produit(
            $_POST["id"],        // Type of the product
            $_POST["type"],        // Type of the product
            $_POST["category"],    // Category of the product
            $_POST["color"],       // Color of the product
            $_POST["quantity"]     // Quantity of the product
        );

        // Call the updateProduct method to update the product in the database
        $produitc->updateProduit($produit, $_GET['id']);  // Use $_GET['id'] to get the product ID

        // Redirect to the product list after updating
        header('Location: liste_produit.php');
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="back_office/assets/img/apple-icon.png">
  <title>
tableau de bord 
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="backoffice/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="backoffice/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="backoffice/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<body class="g-sidenav-show  bg-gray-200">
  <aside
  class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
  id="sidenav-main">
  <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
          aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
          target="_blank">
           <span class="ms-1 font-weight-bold text-white">Tableau de bord </span>
      </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link text-white active bg-gradient-primary" href="#">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">table_view</i>
                  </div>
                  <span class="nav-link-text ms-1">Configuration des produits </span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link text-white " href="#">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">notifications</i>
                  </div>
                  <span class="nav-link-text ms-1">Notifications</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white " href="#">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">assignment</i>
                  </div>
                  <span class="nav-link-text ms-1">Se deconnecter</span>
              </a>
          </li>
      </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
          <a class="btn btn-outline-primary mt-4 w-100" href="#" type="button">Documentation</a>
      </div>
  </div>
</aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-7 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0"> Modification de  Produit </h6>
            </div>
            <div class="card-body pt-4 p-3">
            <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Mise a jour du produit </h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="btn btn-outline-primary btn-sm mb-0"> <a href="liste_produit.php"> Retour
                                            à la liste </a></button>
                                    <?php
                                    if (isset($_GET['id'])){ 
                                        $oldproduit = $produitc->showProduit($_GET['id']);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <form action="" method="POST">
    <div class="card-body p-3 pb-0">
        <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark font-weight-bold text-sm">
                        <label for="id">ID :</label>
                    </h6>
                    <input type="text" id="id" name="id" value="<?php echo $_GET['id']; ?>" readonly />
                </div>
            </li>
        </ul>

        <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark font-weight-bold text-sm">
                        <label for="type">Type :</label>
                        <select id="type" name="type">
                            <option value="vetement" <?php if ($oldproduit['type'] == 'vetement') echo 'selected' ?>>Vetement</option>
                            <option value="bijoux" <?php if ($oldproduit['type'] == 'bijoux') echo 'selected' ?>>Bijoux</option>
                            <option value="chaussure" <?php if ($oldproduit['type'] == 'chaussure') echo 'selected' ?>>Chaussure</option>
                            <option value="accessoir" <?php if ($oldproduit['type'] == 'accessoir') echo 'selected' ?>>Accessoir</option>
                        </select>
                    </h6>
                </div>
            </li>
        </ul>

        <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark font-weight-bold text-sm">
                        <label for="category">Categorie :</label>
                        <select id="category" name="category">
                            <option value="homme" <?php if ($oldproduit['category'] == 'homme') echo 'selected' ?>>Homme</option>
                            <option value="femme" <?php if ($oldproduit['category'] == 'femme') echo 'selected' ?>>Femme</option>
                        </select>
                    </h6>
                </div>
            </li>
        </ul>

        <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark font-weight-bold text-sm">
                        <label for="color">Couleur :</label>
                        <select id="color" name="color">
                            <option value="rouge" <?php if ($oldproduit['color'] == 'rouge') echo 'selected' ?>>Rouge</option>
                            <option value="bleu" <?php if ($oldproduit['color'] == 'bleu') echo 'selected' ?>>Bleu</option>
                            <option value="noir" <?php if ($oldproduit['color'] == 'noir') echo 'selected' ?>>Noir</option>
                            <option value="blanc" <?php if ($oldproduit['color'] == 'blanc') echo 'selected' ?>>Blanc</option>
                        </select>
                    </h6>
                </div>
            </li>
        </ul>

        <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark font-weight-bold text-sm">
                        <label for="quantity">Quantité :</label>
                    </h6>
                    <input type="text" id="quantity" name="quantity" value="<?php echo $oldproduit['quantity']; ?>" />
                </div>
            </li>
        </ul>

        <input class="btn btn-outline-primary btn-sm mb-0" type="submit" value="Update">
        <input class="btn btn-outline-primary btn-sm mb-0" type="reset" value="Reset">
    </div>
</form>

                        <?php }
?>









            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="backoffice/assets/js/core/popper.min.js"></script>
  <script src="backoffice/assets/js/core/bootstrap.min.js"></script>
  <script src="backoffice/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="backoffice/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="back_office/assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>






