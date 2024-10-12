<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if user_ids are provided
if (isset($_POST['user_ids']) && is_array($_POST['user_ids'])) {
    // Sanitize input and prepare the array for SQL
    $user_ids = array_map(function($id) use ($con) {
        return mysqli_real_escape_string($con, $id);
    }, $_POST['user_ids']);

    // Convert the array into a comma-separated string for the SQL query
    $user_ids_string = implode(',', $user_ids);

    // SQL query to update the 'status' of multiple users to 'APPROVED'
    $sql = "UPDATE user_tbl SET status = 'APPROVED' WHERE user_id IN ($user_ids_string)";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        echo 'success'; // Return success message
    } else {
        echo 'error'; // Return error message
    }
} else {
    echo 'error'; // Return error if no user IDs are provided
}

// Close the database connection
mysqli_close($con);
?>
