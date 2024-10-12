<?php
require '../../db/dbconn.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $systemName = $_POST['system_name'] ?? '';
    $systemPassword = $_POST['system_password'] ?? '';

    $settingsId = 1; // Assuming you are updating the settings for the first record

    // Hash the new password
    $hashedPassword = password_hash($systemPassword, PASSWORD_BCRYPT);

    // Update the settings in the database
    $stmt = $con->prepare("UPDATE settings_tbl SET system_name = ?, system_password = ? WHERE settings_id = ?");
    $stmt->bind_param("ssi", $systemName, $hashedPassword, $settingsId);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Settings updated successfully.';
    } else {
        $response['message'] = 'Failed to update settings. Please try again.';
    }

    $stmt->close();
} else {
    $response['message'] = 'Invalid request.';
}

header('Content-Type: application/json');
echo json_encode($response);
$con->close();
?>
