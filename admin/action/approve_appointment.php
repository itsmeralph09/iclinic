<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if appointment_id is provided and is numeric
if (isset($_POST['appointment_id']) && is_numeric($_POST['appointment_id'])) {
    // Sanitize the input to prevent SQL injection
    $appointment_id = mysqli_real_escape_string($con, $_POST['appointment_id']);

    // SQL query to update the 'deleted' flag
    $sql = "UPDATE appointment_tbl SET appointment_status = 'APPROVED' WHERE appointment_id = '$appointment_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error';
    }
} else {
    // If appointment_id is not provided or is not numeric, return error
    echo 'error';
}

// Close the database connection
mysqli_close($con);
?>
