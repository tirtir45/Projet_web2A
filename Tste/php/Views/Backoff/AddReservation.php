<?php
require_once(__DIR__ . '/../../Controller/ReservationController.php');
$error = "";
$Rs = null;
$Ec = new EventController();
$listE = $Ec->listEvent();
$Uc = new UserController();
$listU = $Uc->listUsers();
$ResC = new ReservationController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if (isset($_POST["idClient"]) && isset($_POST["IdEvenement"]) && isset($_POST["details"]) && isset($_POST["dateCreation"]) && isset($_POST["statut"])) {
        if (!empty($_POST["idClient"]) && !empty($_POST["IdEvenement"]) && !empty($_POST["details"]) && !empty($_POST["dateCreation"]) && !empty($_POST["statut"])) {
            $dateCreation = DateTime::createFromFormat('d/m/Y H:i', $_POST['dateCreation']);
            if ($dateCreation === false) {
                $error = "Invalid date format. Please use dd-mm-yyyy hh:mm:ss.";
            } else {
                $dateReservation = DateTime::createFromFormat('d-m-Y H:i:s', '01-01-2000 00:00:00');
                if ($dateReservation === false) {
                    $error = "Invalid date format for dateReservation.";
                } else {
                    $Rs = new Reservation(
                        null,
                        $_POST['idClient'],
                        $_POST['IdEvenement'],
                        $_POST['details'],
                        $dateCreation,
                        $dateReservation,
                        $_POST['statut']
                    );

                    // Debugging: vérifier l'objet Reservation
                    var_dump($Rs);

                    $ResC->addReservation($Rs);
                    header('Location: listReservation.php');
                    exit();
                }
            }
        } else {
            $error = "Missing Informations!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reservation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/mian.css">
    <link rel="stylesheet" href="../../css/spacing.css">
    <link rel="stylesheet" href="../../css/swiper.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/meanmenu.min.css">
    <link rel="stylesheet" href="../../css/pharmecy.css">
    <link rel="stylesheet" href="../../css/pharmecy.css">
    <link rel="stylesheet" href="../../css/slick.css">
    <link rel="stylesheet" href="../../css/magnific-popup.css">
    <link rel="stylesheet" href="../../css/grocery.css">
    <link rel="stylesheet" href="../../css/fontawesome-pro.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <style>
        .form-container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .form-group-row {
            margin-bottom: 10px;
        }
        .image-preview {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .image-preview img {
            max-width: 200px;
            margin-right: 10px;
        }
        .form-label {
            text-align: center;
        }
        .form-control, .form-select, .form-check-input {
            border-radius: 0.5rem;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<header>
<nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="/../../Assets/Images/black-logo.png" width="160" height="50" class="d-inline-block align-top" alt=""></a>
        <div class="navbar-nav">
            <a class="nav-item nav-link-active btn btn-outline-primary" href="../FrontOFf/Home.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link-active btn btn-outline-warning" href="listReservation.php" style="color: yellow; outline-color: yellow;">View</a>
        </div>
    </nav>
</header>
<div class="form-container">
    <h1 style="color: gold; text-shadow: 2px 2px 4px red; font-size: 300%; text-align: center;">New Reservation</h1>
    <div class="card">
        <div class="card-body">
            <form id="FormResAdd" action="" method="POST">
                <div class="form-group row">
                    <label for="idClient" class="col-sm-11 col-form-label form-label">Client:</label>
                    <div class="col-sm-20">
                        <select class="form-select" id="idClient" name="idClient">
                        <?php foreach($listU as $U) { ?>
                            <option value="<?= $U['id']; ?>"><?= $U['firstname']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="IdEvenement" class="col-sm-11 col-form-label form-label">Event:</label>
                    <div class="col-sm-20">
                        <select class="form-select" id="IdEvenement" name="IdEvenement">
                        <?php foreach($listE as $E) { ?>
                            <option value="<?= $E['IdEvent']; ?>"><?= $E['title']; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="details" class="col-sm-11 col-form-label form-label">Details:</label>
                    <div class="col-sm-20">
                        <textarea class="form-control" rows="3" id="details" name="details" placeholder="Insert details (at least 5 characters)"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateCreation" class="col-sm-11 col-form-label form-label">Date of Creation:</label>
                    <div class="col-sm-20">
                        <input class="form-control" type="datetime-local" id="dateCreation" name="dateCreation" placeholder="jj-mm-aaaa hh:mm:ss">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="statut" class="col-sm-11 col-form-label form-label">Status:</label>
                    <div class="col-sm-20">
                        <select class="form-select" id="statut" name="statut">
                            <option value="In Progress">In Progress</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-11 offset-sm-5">
                        <div id="Err" name="Erreur" style="color: red; display: none;"></div>
                        <button type="submit" class="btn btn-success">Add Reservation</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/../../jscript/Reservation.js"></script>
</body>
</html>
