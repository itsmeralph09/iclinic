<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if event_id is provided and is numeric
if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    // Sanitize the input to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_contact = mysqli_real_escape_string($con, $_POST['user_contact']);
    $user_fullname = mysqli_real_escape_string($con, $_POST['user_fullname']);

    // SQL query to update the 'deleted' flag
    $sql = "UPDATE user_tbl SET status = 'DECLINED' WHERE user_id='$user_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, proceed to texting
        $apiKey = '5f7a3eafdbc2beb2f31ce012700445a0'; // Replace with your actual API key
        $apiUrl = 'https://semaphore.co/api/v4/messages';

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        $parameters = [
            'apikey' => $apiKey,
            'number' => $user_contact,
            'message' => 'Good Day! ' . $user_fullname . '. Your registration for the iClinic - PRMSU Candelaria Clinic Management System has been DECLINED. Kindly contact the iClinic system administrator for more information.',
            'sendername' => 'iClinicCAND'
        ];

        curl_setopt_array($ch, [
            CURLOPT_URL => $apiUrl,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query($parameters),
            CURLOPT_RETURNTRANSFER => true,
        ]);

        // Execute cURL request
        $output = curl_exec($ch);

        // Check for errors and handle the response from Semaphore
        if ($output === FALSE) {
            // echo 'error';
        } else {
            // echo 'success';
        }

        echo 'success';
        
    } else {
        // If the query fails, return error
        echo 'error';
    }
} else {
    // If event_id is not provided or is not numeric, return error
    echo 'error';
}

// Close the database connection
mysqli_close($con);
?>
