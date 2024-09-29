<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $quantity_in_stock = mysqli_real_escape_string($con, $_POST['quantity_in_stock']);

    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);

    $new_quantity = $quantity_in_stock + $quantity;

    // SQL query to update the item
    $sql = "UPDATE `item_tbl` SET 
                `quantity_in_stock` = '$new_quantity'
            WHERE `item_id` = '$item_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {

        // Calculate the adjustment amount
        $adjustment = $quantity - $quantity_in_stock;
        $transaction_type = ($adjustment > 0) ? 'STOCKS ADDED' : 'STOCKS REDUCED';

        $transaction_date = date('Y-m-d H:i:s');

        // SQL query to insert new stock transaction
        $sqlStocks = "INSERT INTO `stock_transaction_tbl`(`item_id`, `transaction_type`, `quantity`, `transaction_date`, `transaction_by`, `remarks`) 
                      VALUES ('$item_id', '$transaction_type', '$quantity', '$transaction_date', '$user_id', 'STOCK ADJUSTMENT')";

        if (mysqli_query($con, $sqlStocks)) {
            $response = ['status' => 'success', 'message' => 'Stock added successfully. Stock transaction recorded.'];
        } else {
            // If the query fails, return error
            $response = ['status' => 'error', 'message' => 'Error: ' . mysqli_error($con)];
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
