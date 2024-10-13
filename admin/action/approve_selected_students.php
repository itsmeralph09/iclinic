<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if user_ids are provided
if (isset($_POST['user_ids']) && is_array($_POST['user_ids'])) {
    // Sanitize input and prepare the array for SQL
    $user_ids = array_map(function($id) use ($con) {
        return mysqli_real_escape_string($con, $id);
    }, $_POST['user_ids']);

    // Convert the array into a comma-separated string for the SQL query
    $user_ids_string = implode(',', $user_ids);

    // SQL query to update the 'status' of multiple users to 'APPROVED'
    $sql = "UPDATE user_tbl SET status = 'APPROVED' WHERE user_id IN ($user_ids_string)";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Fetch the contact numbers for the approved users
        $contact_query = "SELECT contact_no FROM student_tbl WHERE user_id IN ($user_ids_string)";
        $result = mysqli_query($con, $contact_query);

        // Collect contact numbers into an array
        $contacts = [];
        while ($row = mysqli_fetch_assoc($result)) {
            if (!empty($row['contact_no'])) {
                $contacts[] = $row['contact_no'];
            }
        }

        // Proceed to send bulk SMS if there are contacts
        if (!empty($contacts)) {
            $apiKey = '5f7a3eafdbc2beb2f31ce012700445a0'; // Replace with your actual API key
            $apiUrl = 'https://semaphore.co/api/v4/messages';

            // Prepare parameters for the bulk SMS
            $parameters = [
                'apikey' => $apiKey,
                'number' => implode(',', $contacts), // Comma-separated list of contact numbers
                'message' => 'Good Day! Your registration for the iClinic - PRMSU Candelaria Clinic Management System has been APPROVED. You may now log in and update your account information.',
                'sendername' => 'iClinicCAND'
            ];

            // Initialize cURL session
            $ch = curl_init();

            // Set cURL options
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
                // echo 'error'; // Error in sending SMS
            } else {
                // echo 'success'; // Successful operation
            }

            echo 'success'; // Successful operation

            // Close cURL session
            curl_close($ch);
        } else {
            echo 'error'; // No contact numbers found
        }
    } else {
        echo 'error'; // Database update error
    }
} else {
    echo 'error'; // No user IDs provided
}

// Close the database connection
mysqli_close($con);
?>
