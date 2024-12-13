<?php
require_once(__DIR__ . '/../../Controller/ReservationController.php');
$ResC = new ReservationController();
$list = $ResC->listReservation();
$userC = new UserController();
$eventC = new EventController();
$listU = $userC->listUsers();
$listE = $eventC->listEvent();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- ... other CSS links ... -->
  <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            color: gold;
            text-shadow: 4px 4px 5px green;
            font-size: 3.5rem;
            text-align: center;
            margin: 2rem 0;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            width: 300px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .card-text {
            margin-bottom: 15px;
        }

        .btn-reserve {
            background-color: gold;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-reserve:hover {
            background-color: black;
        }

        .sorting-buttons {
            text-align: center;
            margin: 20px 0;
        }

        .sorting-buttons .btn {
            margin: 0 5px;
        }
    </style>
</head>

<body>
   <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">
                <img src="/../../Assets/Images/black-logo.png" width="160" height="50" alt="Logo">
            </a>

        <form class="form-inline" onsubmit="event.preventDefault();">
           <input class="form-control mr-sm-2" type="search" id="searchInput" onkeyup="searchReservations()" placeholder="Search by event name..." aria-label="Search">
           <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
            <div class="ml-auto navbar-nav">
                <a class="nav-item nav-link btn btn-outline-primary" href="../BackOff/listReservation.php">Edit</a>
                <a class="nav-item nav-link btn btn-outline-secondary" href="#" onclick="Alert()">Register</a>
                <a class="nav-item nav-link btn btn-outline-warning" href="#" onclick="Alert()">Login</a>
            </div>
        </nav>
        <div class="sorting-buttons">
            <button class="btn btn-sm btn-outline-secondary" onclick="sortReservations('eventTitle', 'asc')">Sort by Event (A-Z)</button>
            <button class="btn btn-sm btn-outline-secondary" onclick="sortReservations('eventTitle', 'desc')">Sort by Event (Z-A)</button>
            <button class="btn btn-sm btn-outline-secondary" onclick="sortReservations('dateReservation', 'asc')">Sort by Date (Oldest First)</button>
            <button class="btn btn-sm btn-outline-secondary" onclick="sortReservations('dateReservation', 'desc')">Sort by Date (Newest First)</button>
        </div>
    </header>

    <main>
        <h1>Your Reservations!</h1>
         <div class="container">
            <div class="card-container" id="reservationList">
                <?php foreach ($list as $Rs) :
                    $user = $userC->showUser($Rs['idClient']);
                    $event = $eventC->showEvent($Rs['IdEvenement']);
                ?>
                    <div class="card" data-event-title="<?= $event['title'] ?>" data-date-reservation="<?= $Rs['dateReservation'] ?? '' ?>">
                        <img src="data:image/jpeg;base64,<?= base64_encode($event['Pic']) ?>" class="card-img-top" alt="<?= $event['title'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $event['title'] ?></h5>
                            <p class="card-text">Client: <?= $user['firstname'] . ' ' . $user['lastname'] ?></p>
                            <p class="card-text">Date Created: <?= $Rs['dateCreation'] ?></p>
                            <p class="card-text">Date Reserved: <?= $Rs['dateReservation'] ?? '-' ?></p>
                            <p class="card-text">Details: <?= $Rs['details'] ?></p>
                            <p class="card-text">Status: <?= $Rs['statut'] ?></p>
                            <button class="btn-reserve" onclick="registerHere()">Reserve</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <script src="../../jscript/script.js"></script>

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
</body>

</html>