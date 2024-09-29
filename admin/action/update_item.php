<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);
    $item_name = strtoupper(mysqli_real_escape_string($con, $_POST['item_name']));
    $item_description = strtoupper(mysqli_real_escape_string($con, $_POST['item_description']));

    $quantity_in_stock = mysqli_real_escape_string($con, $_POST['quantity_in_stock']);
    $quantity_in_stock_old = mysqli_real_escape_string($con, $_POST['quantity_in_stock_old']);

    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    $unit = strtoupper(mysqli_real_escape_string($con, $_POST['unit']));
    $expiry_date = mysqli_real_escape_string($con, $_POST['expiry_date']);

    // SQL query to update the item
    $sql = "UPDATE `item_tbl` SET 
                `item_name` = '$item_name', 
                `description` = '$item_description', 
                `quantity_in_stock` = '$quantity_in_stock', 
                `unit` = '$unit',
                `expiry_date` = '$expiry_date'
            WHERE `item_id` = '$item_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, check if new stock quantity is different from the old stock quantity
        if ($quantity_in_stock_old != $quantity_in_stock) {
            // Calculate the adjustment amount
            $adjustment = $quantity_in_stock - $quantity_in_stock_old;
            $transaction_type = ($adjustment > 0) ? 'STOCKS ADDED' : 'STOCKS REDUCED';

            $transaction_date = date('Y-m-d H:i:s');

            // SQL query to insert new stock transaction
            $sqlStocks = "INSERT INTO `stock_transaction_tbl`(`item_id`, `transaction_type`, `quantity`, `transaction_date`, `transaction_by`, `remarks`) 
                          VALUES ('$item_id', '$transaction_type', '$adjustment', '$transaction_date', '$user_id', 'STOCK ADJUSTMENT')";

            if (mysqli_query($con, $sqlStocks)) {
                $response = ['status' => 'success', 'message' => 'Item updated successfully. Stock transaction recorded.'];
            } else {
                // If the query fails, return error
                $response = ['status' => 'error', 'message' => 'Error: ' . mysqli_error($con)];
            }
        } else {
            $response = ['status' => 'success', 'message' => 'Item updated successfully.'];
        }
    } else {
        // If the query fails, return error
        $response = ['status' => 'error', 'message' => 'Error: ' . mysqli_error($con)];
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
mysqli_close($con);
?>
