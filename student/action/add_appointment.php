<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $appointment_date = mysqli_real_escape_string($con, $_POST['appointment_date']);
    $appointment_description = strtoupper(mysqli_real_escape_string($con, $_POST['appointment_description']));

    if ($appointment_description == "OTHERS") {
        $others_description = strtoupper(mysqli_real_escape_string($con, $_POST['appointment_description_others']));
    } else {
        $others_description = "NONE";
    }

    // Function to generate a unique appointment number
    function generateUniqueAppointmentNo($con, $appointment_date, $user_id) {
        do {
            // Generate the appointment number
            $date_part = date('Ymd', strtotime($appointment_date)); // Format the date as YYYYMMDD
            $appointment_no = 'APT-' . $date_part . '-' . $user_id . '-' . substr(uniqid(), -4);

            // Check if the appointment number already exists in the database
            $check_query = "SELECT 1 FROM `appointment_tbl` WHERE `appointment_no` = '$appointment_no'";
            $result = mysqli_query($con, $check_query);
        } while (mysqli_num_rows($result) > 0); // Repeat if the appointment number is not unique

        return $appointment_no;
    }

    // Generate a unique appointment number
    $appointment_no = generateUniqueAppointmentNo($con, $appointment_date, $user_id);

    // SQL query to insert new event
    $sql = "INSERT INTO `appointment_tbl` (`appointment_no`, `appointment_description`, `appointment_description_others`, `appointment_date`, `appointment_status`, `user_id`) VALUES ('$appointment_no', '$appointment_description', '$others_description', '$appointment_date', 'PENDING', '$user_id')";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error: ' . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
