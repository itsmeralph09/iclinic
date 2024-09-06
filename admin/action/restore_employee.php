<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if user_id is provided and is numeric
if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    // Sanitize the input to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    // SQL query to update the 'deleted' flag
    $sql = "UPDATE user_tbl SET deleted = 0 WHERE user_id = '$user_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error';
    }
} else {
    // If user_id is not provided or is not numeric, return error
    echo 'error';
}

// Close the database connection
mysqli_close($con);
?>
