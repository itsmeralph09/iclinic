<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data

    $appointment_id = mysqli_real_escape_string($con, $_POST['appointment_id']);
    $appointment_date = mysqli_real_escape_string($con, $_POST['appointment_date']);
    $appointment_description = strtoupper(mysqli_real_escape_string($con, $_POST['appointment_description']));

    if ($appointment_description == "OTHERS") {
        $others_description = strtoupper(mysqli_real_escape_string($con, $_POST['appointment_description_others']));
    } else {
        $others_description = "NONE";
    }

    // SQL query to update existing appointment
    $sql = "UPDATE `appointment_tbl` SET 
                `appointment_description` = '$appointment_description', 
                `appointment_description_others` = '$others_description', 
                `appointment_date` = '$appointment_date', 
                `appointment_status` = 'PENDING'
            WHERE `appointment_id` = '$appointment_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        $response = ['status' => 'success', 'message' => 'Appointment updated successfully.'];
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
