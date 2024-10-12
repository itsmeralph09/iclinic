<?php
// Include your database connection file
require '../../db/dbconn.php';

header('Content-Type: application/json');

// Query to get distinct years from the appointment_date column
$query = "SELECT DISTINCT YEAR(appointment_date) AS year FROM appointment_tbl WHERE deleted = 0 ORDER BY year DESC";

$stmt = $con->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$years = [];

while ($row = $result->fetch_assoc()) {
    $years[] = $row['year'];
}

// Return the JSON response
echo json_encode($years);
?>
