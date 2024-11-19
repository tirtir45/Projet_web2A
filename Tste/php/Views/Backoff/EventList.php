<?php
require_once(__DIR__ . '/../../Controller/EventController.php');
$eventC= new EventController();
$list=$eventC->listEvent();
?>
<!DOCTYPE html>
 <html lang= "en">
	<head>
		<title>EventList</title>
		    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<header>
			<nav class="navbar navbar-light bg-light">
				<a class="navbar-brand" href="#"> <img src="/../../Assets/Images/black-logo.png" width="160" height="50" class="d-inline-block align-top" alt=""></a>
				<div class="navbar-nav">
					<a class="nav-item nav-link-active btn btn-outline-light" href="H">Home <span class="sr-only">(current)</span></a>
				    <a class="nav-item nav-link-active btn btn-outline-secondary" href="R" onclick="Alert()">Register</a>
					<a class="nav-item nav-link-active btn btn-outline-warning" href="L" style="color:yellow; outline-color:yellow"  onclick="Alert()">Login</a>
					  <li class="nav-item active">
						<a class="nav-link" href="addEvent.php">
                        <span class="btn btn-outline-success">Add Event </span></a>
					</li>
				</div>
			</nav>
		</header>
	    <h1 style="color:lightcyan;text-shadow:2px 2px 4px orange; font-size:250%; text-align:center">Event List</h1>
		<div class="card-container">
			<div class="card">
			 <div class="row no-gutters align-items-center">
                <div class="table-responsive">
					<table class="table table-bordered">
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
					   <?php
						foreach($list as $Ev) {
					   ?> <tr>
							<td><?= $Ev['IdEvent']; ?></td>
							<td><?= $Ev['title']; ?></td>
							<td><img src="/../../Assets/Images/<?= $Ev['Pic'];?>.jpg" width="200" height="150" class="card-img-top " alt="..."></td>
							<td><?= $Ev['description']; ?></td>
							<td><?if($Ev['disponibility']==1){echo 'Yes';}else{echo 'No';} ?></td>
							<td><?= $Ev['category']; ?></td>
							<td><?= $Ev['price']; ?> TND</td>
							<td align="center">
								<form method="POST" action="updateEvent.php">
									<input type="submit" class="btn btn-outline-primary" name="update" value="Update">
									<input type="hidden" value=<?PHP echo $Ev['IdEvent']; ?> name="id">
								</form>
							</td>
							<td>
								<a href="deleteEvent.php?id=<?php echo $Ev['IdEvent']; ?>"class="btn btn-outline-danger">Delete</a>
							</td>
					       </tr>
						<?php						   						
					   }
					   ?>
					</table>
				</div>
			 </div>
			</div>
		</div>
	</body>
  </html>