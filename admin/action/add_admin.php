<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $employee_no = strtoupper(mysqli_real_escape_string($con, $_POST['no']));
    $first_name = strtoupper(mysqli_real_escape_string($con, $_POST['first_name']));
    $middle_name = strtoupper(mysqli_real_escape_string($con, $_POST['middle_name']));
    $last_name = strtoupper(mysqli_real_escape_string($con, $_POST['last_name']));
    $suffix_name = strtoupper(mysqli_real_escape_string($con, $_POST['suffix_name']));
    $contact_no = mysqli_real_escape_string($con, $_POST['contact_no']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $occupation = strtoupper(mysqli_real_escape_string($con, $_POST['occupation']));
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password

    // Insert into user_tbl first
    $user_insert_query = "INSERT INTO user_tbl (no, email, password, role, status) 
                          VALUES ('$employee_no', '$email', '$hashed_password', 'ADMIN', 'APPROVED')";

    if (mysqli_query($con, $user_insert_query)) {
        // Get the inserted user_id
        $user_id = mysqli_insert_id($con);

        // Now insert the admin details into admin_tbl
        $admin_insert_query = "INSERT INTO admin_tbl (user_id, first_name, middle_name, last_name, suffix_name, contact_no, occupation) 
                               VALUES ('$user_id', '$first_name', '$middle_name', '$last_name', '$suffix_name', '$contact_no', '$occupation')";

        if (mysqli_query($con, $admin_insert_query)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }

    // Close the database connection
    mysqli_close($con);
}
?>
