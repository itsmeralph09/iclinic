<?php
// Include your database connection
require '../../db/dbconn.php';

// Get the recipient type (student or employee) from the GET request
$recipientType = isset($_GET['type']) ? $_GET['type'] : '';

// Determine the SQL query based on the recipient type
if ($recipientType == 'student') {
    $sqlFetchRecipients = "
        SELECT 
            u.user_id, 
            CONCAT(s.first_name, ' ', s.last_name) AS full_name 
        FROM user_tbl u
        INNER JOIN student_tbl s ON u.user_id = s.user_id
        WHERE u.deleted = 0";
} elseif ($recipientType == 'employee') {
    $sqlFetchRecipients = "
        SELECT 
            u.user_id, 
            CONCAT(e.first_name, ' ', e.last_name) AS full_name 
        FROM user_tbl u
        INNER JOIN employee_tbl e ON u.user_id = e.user_id
        WHERE u.deleted = 0";
} else {
    echo json_encode([]);
    exit;
}

$resultFetchRecipients = $con->query($sqlFetchRecipients);

$recipients = [];
if ($resultFetchRecipients->num_rows > 0) {
    while ($row = $resultFetchRecipients->fetch_assoc()) {
        $recipients[] = [
            'user_id' => $row['user_id'],
            'full_name' => $row['full_name']
        ];
    }
}

echo json_encode($recipients);
?>
