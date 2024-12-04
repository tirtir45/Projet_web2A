<?php
session_start();
// Set deactivation date
$query = "UPDATE users SET deactivation_date = NOW() WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
echo "Account deactivated for 30 days.";

?>
