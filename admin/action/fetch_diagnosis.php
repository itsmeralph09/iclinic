<?php
// Include your database connection file
require '../../db/dbconn.php';

$query = "SELECT DISTINCT diagnosis FROM appointment_vitals_tbl WHERE deleted = 0";
$result = mysqli_query($con, $query);

$diagnoses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $diagnoses[] = $row['diagnosis'];
}

echo json_encode($diagnoses);
?>
