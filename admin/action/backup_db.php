<?php
// Include your database connection file
require '../../db/dbconn.php';

// Set headers to force download
header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="backup.sql"');

// Start output buffering
ob_start();

// Generate SQL dump (replace this with your actual backup logic)
$tables = $con->query('SHOW TABLES');
while ($row = $tables->fetch_array()) {
    $table = $row[0];
    $createTable = $con->query("SHOW CREATE TABLE `$table`")->fetch_row()[1];
    echo "$createTable;\n\n";
    
    $data = $con->query("SELECT * FROM `$table`");
    while ($dataRow = $data->fetch_assoc()) {
        $columns = implode(", ", array_keys($dataRow));
        $values = implode(", ", array_map([$con, 'real_escape_string'], array_values($dataRow)));
        echo "INSERT INTO `$table` ($columns) VALUES ($values);\n";
    }
    echo "\n\n";
}

// Flush output buffer
ob_end_flush();
?>
