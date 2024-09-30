<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $item_id = mysqli_real_escape_string($con, $_POST['item_id']);
    $released_to = mysqli_real_escape_string($con, $_POST['released_to']);
    $released_by = mysqli_real_escape_string($con, $_POST['released_by']);
    $quantity_released = mysqli_real_escape_string($con, $_POST['quantity_released']);

    // Get the current stock quantity for the item
    $stock_query = "SELECT `quantity_in_stock` FROM `item_tbl` WHERE `item_id` = '$item_id'";
    $stock_result = mysqli_query($con, $stock_query);

    if ($stock_result && mysqli_num_rows($stock_result) > 0) {
        $row = mysqli_fetch_assoc($stock_result);
        $current_stock = $row['quantity_in_stock'];

        // Check if sufficient stock is available
        if ($current_stock < $quantity_released) {
            echo json_encode(['status' => 'error', 'message' => 'Insufficient stock available.']);
            exit;
        }

        // Calculate new stock quantity after release
        $new_quantity = $current_stock - $quantity_released;

        // SQL query to update the item stock
        $update_sql = "UPDATE `item_tbl` SET `quantity_in_stock` = '$new_quantity' WHERE `item_id` = '$item_id'";

        // Execute the update query
        if (mysqli_query($con, $update_sql)) {
            // Prepare the release date
            $release_date = date("Y-m-d H:i:s");

            // SQL query to insert new item release record
            $insert_release_sql = "INSERT INTO `item_release_tbl` (`item_id`, `quantity_released`, `release_date`, `released_to`, `released_by`) 
                                   VALUES ('$item_id', '$quantity_released', '$release_date', '$released_to', '$released_by')";

            // Execute the insert query for item release
            if (mysqli_query($con, $insert_release_sql)) {
                // Insert a transaction record for the stock adjustment
                $transaction_date = date('Y-m-d H:i:s');
                $transaction_type = 'STOCKS RELEASED';

                // SQL query to insert stock transaction
                $transaction_sql = "INSERT INTO `stock_transaction_tbl`(`item_id`, `transaction_type`, `quantity`, `transaction_date`, `transaction_by`, `remarks`) 
                                    VALUES ('$item_id', '$transaction_type', '$quantity_released', '$transaction_date', '$released_by', 'STOCKS RELEASED')";

                // Execute the transaction insert
                if (mysqli_query($con, $transaction_sql)) {
                    // Send success response
                    echo json_encode(['status' => 'success', 'message' => 'Stock released and transaction recorded successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error recording transaction: ' . mysqli_error($con)]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error releasing item: ' . mysqli_error($con)]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error updating stock: ' . mysqli_error($con)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Item not found.']);
    }
}

// Close the database connection
mysqli_close($con);
?>
