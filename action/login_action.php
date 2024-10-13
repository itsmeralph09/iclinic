<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    require '../db/dbconn.php';

    // Function to sanitize input
    function sanitizeInput($input) {
        global $con;
        return mysqli_real_escape_string($con, $input);
    }

    // Check if keys exist in $_POST array before accessing them
    $no = isset($_POST['no']) ? sanitizeInput($_POST['no']) : '';
    $password = isset($_POST['password']) ? sanitizeInput($_POST['password']) : '';

    // Construct the SQL query
    $sql = "(SELECT 
                ut.user_id, ut.role, ut.no, ut.password, ut.status,
                CONCAT(st.first_name, ' ', st.last_name) AS fullname, st.profile
             FROM 
                user_tbl ut
             INNER JOIN 
                student_tbl st ON ut.user_id = st.user_id
             WHERE 
                ut.no = '$no'
                AND ut.role = 'STUDENT')
            UNION
            (SELECT 
                ut.user_id, ut.role, ut.no, ut.password, ut.status,
                CONCAT(et.first_name, ' ', et.last_name) AS fullname, et.profile
             FROM 
                user_tbl ut
             INNER JOIN 
                employee_tbl et ON ut.user_id = et.user_id
             WHERE 
                ut.no = '$no'
                AND ut.role = 'EMPLOYEE')
            UNION
            (SELECT 
                ut.user_id, ut.role, ut.no, ut.password, ut.status,
                CONCAT(at.first_name, ' ', at.last_name) AS fullname, at.profile
             FROM 
                user_tbl ut
             INNER JOIN 
                admin_tbl at ON ut.user_id = at.user_id
             WHERE 
                ut.no = '$no'
                AND ut.role = 'ADMIN');
            ";

    // Execute the SQL statement
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify approval status
        $row = $result->fetch_assoc();
        
        if ($row['status'] == "APPROVED") { // Check if the account is approved
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Password matches, user authenticated
                // Set session variables
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['profile'] = $row['profile'];

                // Return role value as part of the response
                echo json_encode(['success' => true, 'role' => $row['role']]);
                exit();
            } else {
                // Password does not match
                echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
                exit();
            }
        } else {
            // Account is not approved
            echo json_encode(['success' => false, 'message' => 'Your account is not approved yet. Please contact the administrator.']);
            exit();
        }
    } else {
        // User not found
        echo json_encode(['success' => false, 'message' => 'Student/Employee No. does not exist.']);
        exit();
    }

    // Close connection
    $con->close();
}
?>
