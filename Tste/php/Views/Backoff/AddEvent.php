<?php
require_once(__DIR__ . '/../../Controller/EventController.php');
$error = "";
$Ev = null;
$eventC = new EventController();
if (
    isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["disponibility"]) && isset($_FILES["Pic"])
) {
    $disponibility = isset($_POST["disponibility"]) ? $_POST["disponibility"] : 0;
    if (
        !empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_FILES["Pic"]["tmp_name"])
    ) {
        // Lire les données du fichier image
        $imageData = file_get_contents($_FILES["Pic"]["tmp_name"]);

        $Ev = new Event(
            null,
            $_POST['title'],
            $imageData,
            $_POST['description'],
            $_POST['category'],
            $disponibility,
            $_POST['price']
        );
        $eventC->addEvent($Ev);
        header('Location:EventList.php');
        exit(); 
    } else {
        $error = "Missing Informations!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event_add</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/mian.css">
    <link rel="stylesheet" href="../../css/spacing.css">
    <link rel="stylesheet" href="../../css/swiper.min.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/meanmenu.min.css">
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
            <a class="nav-item nav-link-active btn btn-outline-warning" href="EventList.php" style="color: yellow; outline-color: yellow;">View</a>
        </div>
    </nav>
</header>
<div class="form-container">
    <h1 style="color: gold; text-shadow: 2px 2px 4px red; font-size: 300%; text-align: center;">Add an Event</h1>
    <div class="card">
        <div class="card-body">
            <form id="FormEventAdd" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="title" class="col-sm-11 col-form-label form-label">Title:</label>
                    <div class="col-sm-20">
                        <input class="form-control" id="title" name="title" type="text" placeholder="Insert title here (at least 3 characters)">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-11 col-form-label form-label">Category:</label>
                    <div class="col-sm-20">
                        <select class="form-select" id="category" name="category">
                            <option value="Nature">Nature</option>
                            <option value="History">History</option>
                            <option value="Culture">Culture</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="descr" class="col-sm-11 col-form-label form-label">Description:</label>
                    <div class="col-sm-20">
                        <textarea class="form-control" rows="3" id="description" name="description" placeholder="Insert a description (at least 3 characters)"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="formFile" class="col-sm-7 col-form-label form-label">Choose a pic for preview:</label>
                    <div class="col-sm-4">
                        <div class="image-preview">
                            <input class="form-control" type="file" id="formFile" name="Pic" style="display: none;">
                            <button type="button" class="btn btn-warning" onclick="document.getElementById('formFile').click()">Upload pic</button>
                             <p> Insert an image (no webp)</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-11 col-form-label form-label">Price:</label>
                    <div class="col-sm-10 input-group">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Insert your price here">
                        <span class="input-group-text">TND</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 form-label">Seats available:</div>
                    <div class="col-sm-6">
                        <input type="hidden" name="disponibility" value="0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="disponibility" value="1">
                            <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-11 offset-sm-5">
                        <div id="Err" name="Erreur" style="display: none;"></div>
                        <button type="submit" class="btn btn-success">Add Event</button>       
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="/../../jscript/script.js"></script>
</body>
</html>
