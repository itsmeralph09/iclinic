<?php
// Include your database connection file
require '../db/dbconn.php';

// Check if the employee_number parameter is set in the POST request
if (isset($_POST['employee_number'])) {
    // Sanitize the employee_number input to prevent SQL injection
    $employee_number = mysqli_real_escape_string($con, $_POST['employee_number']);

    // Query to check if the employee_number already exists in the database
    $sql = "SELECT * FROM user_tbl WHERE no = '$employee_number'";
    $result = $con->query($sql);

    if ($result) {
        // If the query is successful, check if the employee_number already exists
        if ($result->num_rows > 0) {
            // employee_number exists, send response as JSON indicating that the employee_number exists
            echo json_encode(array('exists' => true));
        } else {
            // employee_number does not exist, send response as JSON indicating that the employee_number does not exist
            echo json_encode(array('exists' => false));
        }
    } else {
        // If the query fails, send an error response
        echo json_encode(array('error' => 'Failed to execute query'));
    }
} else {
    // If the employee_number parameter is not set, send an error response
    echo json_encode(array('error' => 'employee_number parameter is not set'));
}
?>
