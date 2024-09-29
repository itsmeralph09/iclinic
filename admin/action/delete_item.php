<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if item_id is provided and is numeric
if (isset($_POST['item_id']) && is_numeric($_POST['item_id'])) {
    // Sanitize the input to prevent SQL injection
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);

    // SQL query to update the 'deleted' flag
    $sql = "UPDATE item_tbl SET deleted = 1 WHERE item_id = '$item_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error';
    }
} else {
    // If item_id is not provided or is not numeric, return error
    echo 'error';
}

// Close the database connection
mysqli_close($con);
?>
