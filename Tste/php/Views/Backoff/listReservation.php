<?php
require_once(__DIR__ . '/../../Controller/ReservationController.php');
$ResC = new ReservationController();
$list = $ResC->listReservation();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        /* General styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: gold;
            text-shadow: 2px 2px 4px green;
            font-size: 3.5rem;
            text-align: center;
            margin: 2rem 0;
        }

        /* Navbar styling */
        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.3));
        }

        .navbar-nav .nav-item .btn {
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-item .btn:hover {
            background-color: #e63946;
            color: white;
        }

        /* Table styling */
        .table {
            margin: 2rem auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: forestgreen;
            color: white;
            text-align: center;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table img {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Buttons styling */
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        .btn-outline-success:hover {
            background-color: #28a745;
            color: white;
        }

        .btn-outline-warning:hover {
            background-color: #ffc107;
            color: white;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .table img {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
 <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="/../../Assets/Images/black-logo.png" width="160" height="50" alt="Logo">
            </a>
            <div class="ml-auto navbar-nav">
                <a class="nav-item nav-link btn btn-outline-primary" href="../FrontOff/Reservations.php">View</a>
                <a class="nav-item nav-link btn btn-outline-secondary" href="#" onclick="Alert()">Register</a>
                <a class="nav-item nav-link btn btn-outline-warning" href="#" onclick="Alert()">Login</a>
                <a class="nav-item nav-link btn btn-outline-success" href="AddReservation.php">Add Reservation</a>
        </div>
    </nav>
</header>
<main>
<h1>Reservation List</h1>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>IdClient</th>
                        <th>idEvent</th>
                        <th>Date_Creation</th>
                        <th>Date_Reservation</th>
                        <th>Details</th>
                        <th>State</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list as $Rs) {
                    ?>
                        <tr>
                            <td><?= $Rs['IdDemande']; ?></td>
                            <td><?= $Rs['idClient']; ?></td>
                            <td><?= $Rs['IdEvenement']; ?></td>
                            <td><?= $Rs['dateCreation']; ?></td>
                            <?php if(!empty($Rs['dateReservation'])){
                            ?><td><?= $Rs['dateReservation']; ?></td>
                            <?php }else{?>
                            <td>-</td>
                            <?php } ?>

                            <td><?= $Rs['details']; ?></td>
                            <td><?= $Rs['statut']; ?></td>
                               <td>    
                                <form method="POST" action="updateReservation.php">
                                    <input type="submit" class="btn btn-outline-primary" name="update" value="Update">
                                    <input type="hidden" value="<?= $Rs['IdDemande']; ?>" name="id">
                                </form>
                            </td>
                            <td>
                                <a href="deleteReservation.php?id=<?= $Rs['IdDemande']; ?>" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script>
window.embeddedChatbotConfig = {
chatbotId: "3zu3KHQ-B_FDt6Km__eg1",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="3zu3KHQ-B_FDt6Km__eg1"
domain="www.chatbase.co"
defer>
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

