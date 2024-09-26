<?php
// Include your database connection file
require '../../db/dbconn.php';

// SQL query to fetch the count of completed appointments per month
$query = "
    SELECT 
        DATE_FORMAT(appointment_date, '%M') AS month, 
        COUNT(*) AS completed_appointments
    FROM appointment_tbl
    WHERE appointment_status = 'COMPLETED' AND deleted = 0
    GROUP BY month(appointment_date)
    ORDER BY appointment_date ASC
";

// Execute the query
$result = mysqli_query($con, $query);

if (!$result) {
    // If there's an error with the query, return a JSON error message
    echo json_encode(['error' => 'Failed to fetch completed appointments']);
    exit();
}

// Initialize an array to store the results
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row; // Add each row of result to the $data array
}

// Return the data as JSON
echo json_encode($data);
?>
