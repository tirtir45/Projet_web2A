<?php

require_once('C:/xampp/htdocs/foued_benyou/controller/typec.php');

$typeC = new typeC();
$tab = $typeC->listTypes();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Table des Produits</title>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="backoffice/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="backoffice/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="backoffice/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
                target="_blank">
                <span class="ms-1 font-weight-bold text-white">Tableau de bord</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white active bg-gradient-primary" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text ms-1"> Types des produits</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="../view/Front_office/deconnecter.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">assignment</i>
                        </div>
                        <span class="nav-link-text ms-1">Se déconnecter</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 align="center" class="text-white text-capitalize ps-3">Table des Produits</h6>
                            </div>

                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type_produit</th>
                                            <th>produit_id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tab as $type) { ?>
                                            <tr>
                                                <td><?= htmlspecialchars($type["id"]); ?></td>
                                                <td><?= htmlspecialchars($type["type_produit"]); ?></td>

                                                <td>
                                                    <a href="deleteType.php?id=<?= $type["id"]; ?>"
                                                        class="btn btn-danger btn-sm">Supprimer</a>
                                                    <a href="showType.php?id=<?= $type["id"]; ?>"
                                                        class="btn btn-info btn-sm">Détails</a>
                                                    <a href="updateType.php?id=<?= $type["id"]; ?>"
                                                        class="btn btn-warning btn-sm">Modifier</a>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php if (empty($tab)) { ?>
                                    <p class="text-center text-muted">Aucun produit trouvé.</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="backoffice/assets/js/core/popper.min.js"></script>
    <script src="backoffice/assets/js/core/bootstrap.min.js"></script>
    <script src="backoffice/assets/js/plugins/perfect-scrollbar.min.js"></script>
</body>

</html>