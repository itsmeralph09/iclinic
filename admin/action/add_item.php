<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $item_name = strtoupper(mysqli_real_escape_string($con, $_POST['item_name']));
    $item_description = strtoupper(mysqli_real_escape_string($con, $_POST['item_description']));
    $quantity_in_stock = mysqli_real_escape_string($con, $_POST['quantity_in_stock']);
    $unit = strtoupper(mysqli_real_escape_string($con, $_POST['unit']));
    $expiry_date = mysqli_real_escape_string($con, $_POST['expiry_date']);
    $added_by = mysqli_real_escape_string($con, $_POST['added_by']);

    // SQL query to insert new event
    $sql = "INSERT INTO `item_tbl` (`item_name`, `description`, `quantity_in_stock`, `unit`, `expiry_date`, `added_by`) VALUES ('$item_name', '$item_description', '$quantity_in_stock', '$unit', '$expiry_date', '$added_by')";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error: ' . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
