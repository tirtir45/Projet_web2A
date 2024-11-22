<?php
require_once(__DIR__ . '/../../Controller/EventController.php');
$error = "";
$Ev = null;
$eventC = new EventController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 

    if (
        isset($_POST["title"], $_POST["category"], $_POST["description"], $_POST["price"],  $_FILES["Pic"])
    ) {
$disponibility = isset($_POST["disponibility"]) ? 1 : '' ;        

        if (!empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["description"]) && !empty($_POST["price"])) {

            if (!empty($_FILES["Pic"]["tmp_name"])) {
                $imageData = file_get_contents($_FILES["Pic"]["tmp_name"]);
            } else {
                $Ev = $eventC->showEvent($_POST["id"]);
                $imageData = $Ev['Pic'];
            }

            $Ev = new Event(
                null,
                $_POST['title'],
                $imageData,
                $_POST['description'],
                $_POST['category'],
                $disponibility,
                $_POST['price']
            );

            $eventC->updateEvent($Ev, $_POST["id"]);
            
            header('Location:EventList.php');
            exit();
        } else {
            $error = "Missing Information!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event_Update</title>
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
            text-align:center;
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
<header>
			<nav class="navbar navbar-light bg-light">
				<a class="navbar-brand" href="#"> <img src="/../../Assets/Images/black-logo.png" width="160" height="50" class="d-inline-block align-top" alt=""></a>
				<div class="navbar-nav">
					<a class="nav-item nav-link-active btn btn-outline-primary" href="../FrontOff/Home.php">Home <span class="sr-only">(current)</span></a>
				    <a class="nav-item nav-link-active btn btn-outline-warning" href="EventList.php" >View</a>
					
				</div>
			</nav>
		</header>
    <div class="form-container">
        <h1 style="color:lightskyblue;text-shadow:2px 2px 4px gold; font-size:300%; text-align:center">Update Event (<?php echo isset($_POST['id']) ? $_POST['id'] : ''; ?>)</h1>
        <div class="card">
            <div class="card-body">
                <?php 
                if (isset($_POST['id'])) {
                    $Ev = $eventC->showEvent($_POST['id']);
                ?>
                <form id="FormEventAdd" action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id" name="id" value="<?php echo $_POST['id']; ?>">
                    <div class="form-group row">
                        <label for="title" class="col-sm-11 col-form-label text-center">Title:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="title" name="title" type="text" value="<?php echo $Ev['title']; ?>">
                            <span id="title_error"></span><br>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-sm-11 col-form-label text-center">Category:</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="category" name="category">
                                <option selected><?php echo $Ev['category']; ?></option>
                                <option value="Nature">Nature</option>
                                <option value="History">History</option>
                                <option value="Culture">Culture</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descr" class="col-sm-11 col-form-label text-center">Description:</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="3" id="descr" name="description"><?php echo $Ev['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="formFile" class="col-sm-11 col-form-label text-center">Choose a pic for preview:</label>
                        <div class="col-sm-8">
                            <?php if (!empty($Ev['Pic'])) { ?>
                                <div class="image-preview">
                                    <img src="data:image/jpg;base64,<?php echo base64_encode($Ev['Pic']); ?>" alt="Current Image">
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formFile').click()">Modify pic</button>
                                </div>
                            <?php } ?>
                            <input class="form-control" type="file" id="formFile" name="Pic" style="display: none;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-11 col-form-label text-center">Price:</label>
                        <div class="col-sm-20 input-group">
                            <input type="text" class="form-control" id="price" name="price" value="<?php echo $Ev['price']; ?>">
                            <span class="input-group-text">TND</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-11">Seats available:</div>
                        <div class="col-sm-11">
                            <input type="hidden" name="Hdisponibility" id="Tchecked" value="<?php echo $Ev['disponibility']; ?>">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="disponibility" value=" <?php echo $Ev['disponibility']  ?'checked' : 0 ; ?>">
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-7 offset-sm-2">
                            <div id="Err" name="Erreur"style="color:red; display:none;"></div>
                            <button type="submit" class="btn btn-outline-primary">Update</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="/../../jscript/script.js"></script>
</body>
</html>
