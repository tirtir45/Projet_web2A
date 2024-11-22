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
    <title>Discover Tunisia</title>
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
        /* General Styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Andalus', sans-serif;
        }

        h1 {
            color: gold;
            text-shadow: 4px 4px 5px purple;
            font-size: 3.5rem;
            text-align: center;
            margin: 2rem 0;
        }

        /* Navbar Styling */
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

        /* Carousel Styling */
        .carousel-item img {
            max-height: 600px;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            padding: 1.5rem;
        }

        .carousel-caption h3 {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
        }

        .carousel-caption p {
            font-size: 1.2rem;
            color: #f8f9fa;
        }

        .center-button {
            background-color: yellow;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre pour un effet 3D */
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(100%);
        }

        /* Button Styling */
        .carousel-control-prev,
        .carousel-control-next {
            outline: none;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .carousel-caption h3 {
                font-size: 1.5rem;
            }

            .carousel-caption p {
                font-size: 1rem;
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
            <a class="nav-item nav-link btn btn-outline-primary" href="../BackOff/Eventlist.php">Edit</a>
            <a class="nav-item nav-link btn btn-outline-secondary" href="#" onclick="Alert()">Register</a>
            <a class="nav-item nav-link btn btn-outline-warning" href="#" onclick="Alert()">Login</a>
        </div>
    </nav>
</header>

<main>
    <h1>Discover Tunisia With Our Events!</h1>

    <div id="eventCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <?php 
            $first = true;
            foreach ($list as $Ev) { ?>
                <div class="carousel-item <?php echo $first ? 'active' : ''; $first = false; ?>">
                    <img src="<?php echo htmlspecialchars($Ev['Pic']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($Ev['title']); ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h3><?php echo htmlspecialchars($Ev['title']); ?></h3>
                        <p><?php echo htmlspecialchars($Ev['description']); ?></p>
                        <button class="btn btn-outline-warning" onclick="registerHere()">Register Now</button>
                    </div>
                </div>
            <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#eventCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#eventCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</main>

<script src="../../jscript/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
