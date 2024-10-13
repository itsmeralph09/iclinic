<?php
// Assuming you have a database connection established
require '../../db/dbconn.php';

// Check if the no or email already exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no = mysqli_real_escape_string($con, $_POST['no']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Query to check if no or email already exists
    $query = "SELECT * FROM `user_tbl` WHERE no = '$no' OR email = '$email'";
    $result = mysqli_query($con, $query);

    // Prepare response object
    $response = array();

    // If a row is fetched, no or email already exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $exists = array(
            'no' => ($row['no'] == $no),
            'email' => ($row['email'] == $email)
        );
        $response['exists'] = $exists;
    } else {
        // If no row is fetched, garden doesn't exist
        $response['exists'] = false;
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If request method is not POST, return error response
    $response = array('error' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>