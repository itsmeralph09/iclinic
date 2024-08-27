<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $appointment_id = mysqli_real_escape_string($con, $_POST['appointment_id']);
    $appointment_blood_pressure = mysqli_real_escape_string($con, $_POST['appointment_blood_pressure']);
    $appointment_temperature = mysqli_real_escape_string($con, $_POST['appointment_temperature']);
    $appointment_weight = mysqli_real_escape_string($con, $_POST['appointment_weight']);
    $appointment_height = mysqli_real_escape_string($con, $_POST['appointment_height']);
    $appointment_diagnosis = strtoupper(mysqli_real_escape_string($con, $_POST['appointment_diagnosis']));

    // Generate the current date and time
    $current_date = date('Y-m-d H:i:s');  // Format: YYYY-MM-DD HH:MM:SS

    // SQL query to update existing appointment
    $sql = "UPDATE `appointment_tbl` SET  
                `appointment_status` = 'COMPLETED'
            WHERE `appointment_id` = '$appointment_id'";

    // Execute the update query
    if (mysqli_query($con, $sql)) {
        // SQL query to insert appointment vitals with the current date
        $sql2 = "INSERT INTO `appointment_vitals_tbl` (`blood_pressure`, `temperature`, `weight`, `height`, `diagnosis`, `appointment_id`, `date_completed`) 
                 VALUES ('$appointment_blood_pressure', '$appointment_temperature', '$appointment_weight', '$appointment_height', '$appointment_diagnosis', '$appointment_id', '$current_date')";

        if (mysqli_query($con, $sql2)) {
            // If the query is successful
            $response = ['status' => 'success', 'message' => 'Appointment completed successfully.'];
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
