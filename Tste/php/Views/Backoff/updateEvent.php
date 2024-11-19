<?php
require_once(__DIR__ . '/../../Controller/EventController.php');
$error = "";
$Ev = null;
$eventC = new EventController();
$picPath = "";

if (
    isset($_POST["title"]) && isset($_POST["category"]) && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["disponibility"]) && isset($_POST["Pic"])
) {
    if (
        !empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["description"]) && !empty($_POST["price"]) && !empty($_POST["disponibility"]) && !empty($_POST["Pic"])
    ) {
        $available = isset($_POST['disponibility']) ? true : false;
        $Ev = new Event(
            null,
            $_POST['title'],
            $_POST['Pic'],
            $_POST['description'],
            $_POST['category'],
            $available,
            $_POST['price']
        );
        $eventC->updateEvent($Ev, $_POST['IdEvent']);
        header('Location:EventList.php');
        exit();
    } else {
        $error = "Missing Information";
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
        <h1 style="color:lightskyblue;text-shadow:2px 2px 4px gold; font-size:300%; text-align:center">Update Event (<?php echo $_POST['id'] ?>)</h1>
        <div class="card">
            <div class="card-body">
                <?php if (isset($_POST['id'])) {
                    $Ev = $eventC->showEvent($_POST['id']);
                ?>
                <form id="FormEventAdd" action="" method="POST">
                    <label for="id">ID Offer:</label><br>
                    <input class="form-control form-control-user" type="text" id="id" name="id" readonly value="<?php echo $_POST['id'] ?>">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label text-center">Title:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="title" name="title" type="text" value="<?php echo $Ev['title'] ?>">
                            <span id="title_error"></span><br>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label text-center">Category:</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="category" name="category">
                                <option selected><?php echo $Ev['category'] ?></option>
                                <option value="Nature">Nature</option>
                                <option value="History">History</option>
                                <option value="Culture">Culture</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descr" class="col-sm-2 col-form-label text-center">Description:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" id="descr" name="description"><?php echo $Ev['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="formFile" class="col-sm-2 col-form-label text-center">Choose a pic for preview:</label>
                        <div class="col-sm-10">
                            <?php if (!empty($Ev['Pic'])) { ?>
                                <div class="image-preview">
                                    <img src="/../Assets/Images/<?php echo $Ev['Pic']; ?>.jpg" alt="Current Image">
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formFile').click()">Modify pic</button>
                                </div>
                            <?php } ?>
                            <input class="form-control" type="file" id="formFile" name="Pic" style="display: none;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label text-center">Price:</label>
                        <div class="col-sm-10 input-group">
                            <input type="text" class="form-control" id="price" name="price" value="<?php echo $Ev['price'] ?>">
                            <span class="input-group-text">TND</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 text-center">Sits available:</div>
                        <div class="col-sm-10">
                            <?php if ($Ev['disponibility'] == 1) { ?>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Seats Available</label>
                                </div>
                            <?php } else { ?>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Seats Available</label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
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
