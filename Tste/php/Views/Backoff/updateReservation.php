<?php
require_once(__DIR__ . '/../../Controller/ReservationController.php');
$error = "";
$Rs = null;
$Ec=new EventController();
$listE=$Ec->listEvent();
$Uc=new UserController();
$listU=$Uc->listUsers();
$ResC = new ReservationController();
if($_SERVER['REQUEST_METHOD']==='POST'){
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

if (
    isset($_POST["idClient"]) && isset($_POST["IdEvenement"]) && isset($_POST["details"]) && isset($_POST["dateCreation"]) && isset($_POST["dateReservation"]) && isset($_POST["statut"])
) {
    if (
        !empty($_POST["idClient"]) && !empty($_POST["IdEvenement"]) && !empty($_POST["details"]) && !empty($_POST["dateCreation"]) && !empty($_POST["dateReservation"]) && !empty(["statut"])
    ) {

        $Rs = new ReservationController(
            null,
            $_POST['idClient'],
            $_POST['IdEvenement'],
            $_POST['details'],
            new DateTime($_POST['dateCreation']),
            new DateTime($_POST['dateReservation']),
            $_POST['statut']
        );
        $ResC->updateReservation($Rs, $_POST["id"]);
        header('Location:listReservation.php');
        exit(); 
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
    <title>Update_Reservation</title>
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
            text-align: center;
        }
        .form-group-row {
            margin-bottom: 10px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
<header>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#"> <img src="/../../Assets/Images/black-logo.png" width="160" height="50" class="d-inline-block align-top" alt=""></a>
        <div class="navbar-nav">
            <a class="nav-item nav-link-active btn btn-outline-primary" href="../FrontOff/Home.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link-active btn btn-outline-warning" href="listReservation.php">View</a>
        </div>
    </nav>
</header>
<div class="form-container">
    <h1 style="color: lightskyblue; text-shadow: 2px 2px 4px gold; font-size: 300%; text-align: center;">Update Reservation</h1>
    <div class="card">
        <div class="card-body">
            <?php 
            if (isset($_POST['id'])) {
                $Rs = $ResC->showReservation($_POST["id"]);
            ?>
            <form id="FormResAdd" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($Rs["IdDemande"]); ?>">
                <div class="form-group row">
                    <label for="idClient" class="col-sm-11 col-form-label form-label">Client ID:</label>
                    <div class="col-sm-20">
                        <input class="form-control" type="text" id="idClient" name="idClient" value="<?php echo htmlspecialchars($Rs['idClient']); ?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="IdEvenement" class="col-sm-11 col-form-label form-label">Event ID:</label>
                    <div class="col-sm-20">
                        <input class="form-control" type="text" id="IdEvenement" name="IdEvenement" value="<?php echo htmlspecialchars($Rs['IdEvenement']); ?>" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="details" class="col-sm-11 col-form-label form-label">Details:</label>
                    <div class="col-sm-20">
                        <textarea class="form-control" rows="3" id="details" name="details"><?php echo htmlspecialchars($Rs['details']); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dateCreation" class="col-sm-11 col-form-label form-label">Date de Creation:</label>
                    <div class="col-sm-20">
                        <input class="form-control" type="text" id="dateCreation" name="dateCreation" value="<?php echo htmlspecialchars($Rs['dateCreation']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="statut" class="col-sm-11 col-form-label text-center">State:</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="statut" name="statut">
                            <option selected><?php echo htmlspecialchars($Rs['statut']); ?></option>
                            <option value="In Progress">In Progress</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row hidden" id="dateReservationRow" style="display: <?php echo ($Rs['statut'] == 'Accepted') ? 'block' : 'none'; ?>">
                    <label for="dateReservation" class="col-sm-11 col-form-label form-label">Date de Reservation:</label>
                    <div class="col-sm-20">
                        <input class="form-control" type="text" id="dateReservation" name="dateReservation" value="<?php echo htmlspecialchars($Rs['dateReservation']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-7 offset-sm-2">
                        <div id="Err" name="Erreur" style="color: red;"><?php echo htmlspecialchars($error); ?></div>
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                    </div>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
