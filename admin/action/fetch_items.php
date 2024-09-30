<?php
// Include your database connection file
require '../../db/dbconn.php';

// Fetch all items from the item table
$sqlFetchItem = "SELECT item_id, item_name, quantity_in_stock FROM item_tbl WHERE deleted = 0";
$resultFetchItem = $con->query($sqlFetchItem);

$items = [];
if ($resultFetchItem->num_rows > 0) {
    while ($row = $resultFetchItem->fetch_assoc()) {
        $items[] = [
            'item_id' => $row['item_id'],
            'item_name' => $row['item_name'] . ' (' . $row['quantity_in_stock'] . ' stocks left)',
            'quantity_in_stock' => $row['quantity_in_stock']
        ];
    }
}

echo json_encode($items);
?>
