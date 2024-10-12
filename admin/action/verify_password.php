<?php
// Include your database connection file
require '../../db/dbconn.php';

// Start the session
session_start();

// Prepare response array
$response = ['success' => false, 'message' => ''];

// Check if the current password is provided
if (isset($_POST['current_password'])) {
    $currentPassword = $_POST['current_password'];

    // Retrieve the current hashed password from the settings table
    $stmt = $con->prepare("SELECT system_password FROM settings_tbl WHERE settings_id = 1"); // Assuming settings_id is 1
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['system_password'];

        // Verify the password against the hashed password
        if (password_verify($currentPassword, $hashedPassword)) {
            $response['success'] = true; // Password is correct
        } else {
            $response['message'] = 'Incorrect current password.';
        }
    } else {
        $response['message'] = 'Settings not found.';
    }

    // Close statement
    $stmt->close();
} else {
    $response['message'] = 'No password provided.';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$con->close();
?>
