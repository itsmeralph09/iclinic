<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if the item_id is provided via GET request
if (isset($_GET['item_id'])) {
    // Sanitize the input to prevent SQL injection
    $item_id = mysqli_real_escape_string($con, $_GET['item_id']);

    // Prepare the SQL query to fetch item details
    $sql = "SELECT item_id, item_name, quantity_in_stock FROM item_tbl WHERE item_id = '$item_id' AND deleted = 0 LIMIT 1";
    $result = $con->query($sql);

    // Check if the item exists
    if ($result->num_rows > 0) {
        // Fetch the item details
        $item = $result->fetch_assoc();

        // Return the item details as a JSON response
        echo json_encode([
            'success' => true,
            'item_id' => $item['item_id'],
            'item_name' => $item['item_name'],
            'quantity_in_stock' => $item['quantity_in_stock']
        ]);
    } else {
        // If no item is found, return an error response
        echo json_encode([
            'success' => false,
            'message' => 'Item not found.'
        ]);
    }
} else {
    // If no item_id is provided, return an error response
    echo json_encode([
        'success' => false,
        'message' => 'No item ID provided.'
    ]);
}

// Close the database connection
$con->close();
?>
