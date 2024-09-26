<?php
// Include your database connection file
require '../../db/dbconn.php';

// SQL query to fetch appointment counts for each role for the current month
$query = "
    SELECT 
        u.role, 
        COUNT(a.appointment_id) AS appointment_count
    FROM user_tbl u
    JOIN appointment_tbl a ON u.user_id = a.user_id
    WHERE MONTH(a.appointment_date) = MONTH(CURRENT_DATE())
    AND YEAR(a.appointment_date) = YEAR(CURRENT_DATE())
    AND u.deleted = 0
    GROUP BY u.role
";

// Execute the query
$result = mysqli_query($con, $query);

if (!$result) {
    // If there's an error with the query, return a JSON error message
    echo json_encode(['error' => 'Failed to fetch appointment distribution']);
    exit();
}

// Initialize an array to store the results
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'role' => $row['role'],
        'appointment_count' => (int)$row['appointment_count']
    ]; // Add each row of result to the $data array
}

// Return the data as JSON
echo json_encode($data);
?>
