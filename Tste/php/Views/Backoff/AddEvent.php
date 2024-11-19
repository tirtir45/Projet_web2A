<?php
ob_start(); // Démarre le tampon de sortie
require_once(__DIR__ . '/../../Controller/EventController.php');
$error = "";
$Ev = null;
$eventC = new EventController();
if (
    isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["disponibility"]) && isset($_POST["Pic"])
) {
    $disponibility = isset($_POST["disponibility"]) ? $_POST["disponibility"] : 0;
    if (
        !empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["disponibility"]) && !empty($_POST["Pic"])
    ) {
        $Ev = new Event(
            null,
            $_POST['title'],
            $_POST['Pic'],
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
ob_end_flush(); // Envoie le contenu du tampon de sortie
?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event_add</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
        .form-container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .form-group-row {
            margin-bottom: 10px;
        }
        #category {
            margin-top: 10px;
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
  </style>
</head>
<body>
    <div class="form-container">
        <h1 style="color:gold;text-shadow:2px 2px 4px red; font-size:300%; text-align:center">Add an Event</h1>
        <div class="card">
            <div class="card-body">
                <form id="FormEventAdd" action="" method="POST">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-center">Title:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="title" name="title" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label text-center">Category:</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="category" name="category">
                                <option value="Nature">Nature</option>
                                <option value="History">History</option>
                                <option value="Culture">Culture</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descr" class="col-sm-2 col-form-label text-center">Description:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" id="descr" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="formFile" class="col-sm-2 col-form-label text-center">Choose a pic for preview:</label>
                        <div class="col-sm-10">
                            <div class="image-preview">
                                    <button type="button" class="btn btn-warning" onclick="document.getElementById('formFile').click()">Upload pic</button>
                            </div>
                        </div>
                         <input class="form-control" type="file" id="formFile" name="Pic" style="display: none;">
                        </div
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label text-center">Price:</label>
                        <div class="col-sm-10 input-group">
                            <input type="text" class="form-control" id="price" name="price">
                            <span class="input-group-text">TND</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 text-center">Sits available:</div>
                        <div class="col-sm-10">
                        <input type="hidden" name="disponibility" value="0">
                        <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="disponibility" value="1">
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                        </div>
                     </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
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
</body>
</html>
