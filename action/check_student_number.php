<?php
// Include your database connection file
require '../db/dbconn.php';

// Check if the student_number parameter is set in the POST request
if (isset($_POST['student_number'])) {
    // Sanitize the student_number input to prevent SQL injection
    $student_number = mysqli_real_escape_string($con, $_POST['student_number']);

    // Query to check if the student_number already exists in the database
    $sql = "SELECT * FROM user_tbl WHERE no = '$student_number'";
    $result = $con->query($sql);

    if ($result) {
        // If the query is successful, check if the student_number already exists
        if ($result->num_rows > 0) {
            // student_number exists, send response as JSON indicating that the student_number exists
            echo json_encode(array('exists' => true));
        } else {
            // student_number does not exist, send response as JSON indicating that the student_number does not exist
            echo json_encode(array('exists' => false));
        }
    } else {
        // If the query fails, send an error response
        echo json_encode(array('error' => 'Failed to execute query'));
    }
} else {
    // If the student_number parameter is not set, send an error response
    echo json_encode(array('error' => 'student_number parameter is not set'));
}
?>
