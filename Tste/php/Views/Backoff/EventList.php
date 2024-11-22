<?php
require_once(__DIR__ . '/../../Controller/EventController.php');
$eventC = new EventController();
$list = $eventC->listEvent();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
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
            text-shadow: 2px 2px 4px red;
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
            background-color: red;
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
            <a class="nav-item nav-link btn btn-outline-primary" href="../FrontOff/Home.php">Home</a>
            <a class="nav-item nav-link btn btn-outline-secondary" href="#" onclick="Alert()">Register</a>
            <a class="nav-item nav-link btn btn-outline-warning" href="#" onclick="Alert()">Login</a>
            <a class="nav-item nav-link btn btn-outline-success" href="addEvent.php">Add Event</a>
        </div>
    </nav>
</header>

<main>
    <h1>Event List</h1>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Preview</th>
                        <th>Description</th>
                        <th>Availability</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list as $Ev) {
                    ?>
                        <tr>
                            <td><?= $Ev['IdEvent']; ?></td>
                            <td><?= $Ev['title']; ?></td>
                            <td>
                                <img src="<?php echo htmlspecialchars($Ev['Pic']); ?>" width="200" height="150" class="card-img-top" alt="Pic">
                            </td>
                            <td><?= htmlspecialchars($Ev['description']); ?></td>
                            <td><?= $Ev['disponibility'] == 1 ? 'Yes' : 'No'; ?></td>
                            <td><?= htmlspecialchars($Ev['category']); ?></td>
                            <td><?= htmlspecialchars($Ev['price']); ?> TND</td>
                            <td>
                                <form method="POST" action="updateEvent.php">
                                    <input type="submit" class="btn btn-outline-primary" name="update" value="Update">
                                    <input type="hidden" value="<?= $Ev['IdEvent']; ?>" name="id">
                                </form>
                            </td>
                            <td>
                                <a href="deleteEvent.php?id=<?= $Ev['IdEvent']; ?>" class="btn btn-outline-danger">Delete</a>
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

<script src="../../jscript/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>