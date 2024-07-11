<?php
// Include your database connection file
require '../db/dbconn.php';

// Check if the email parameter is set in the POST request
if (isset($_POST['email'])) {
    // Sanitize the email input to prevent SQL injection
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Query to check if the email already exists in the database
    $sql = "SELECT * FROM user_tbl WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result) {
        // If the query is successful, check if the email already exists
        if ($result->num_rows > 0) {
            // email exists, send response as JSON indicating that the email exists
            echo json_encode(array('exists' => true));
        } else {
            // email does not exist, send response as JSON indicating that the email does not exist
            echo json_encode(array('exists' => false));
        }
    } else {
        // If the query fails, send an error response
        echo json_encode(array('error' => 'Failed to execute query'));
    }
} else {
    // If the email parameter is not set, send an error response
    echo json_encode(array('error' => 'email parameter is not set'));
}
?>
