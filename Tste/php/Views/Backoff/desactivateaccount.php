<?php
// Set deactivation date
$query = "UPDATE users SET deactivation_date = NOW() WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
echo "Account deactivated for 30 days.";
// Check deactivation status
$query = "SELECT deactivation_date FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['deactivation_date']) {
    $deactivation_date = new DateTime($row['deactivation_date']);
    $current_date = new DateTime();
    $interval = $deactivation_date->diff($current_date);

    if ($interval->days < 30) {
        echo "Your account is deactivated. Please try again after " . (30 - $interval->days) . " days.";
        exit;
    } else {
        // Reactivate account after 30 days
        $query = "UPDATE users SET deactivation_date = NULL WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
    }
}




?>