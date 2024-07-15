<?php
session_start();

// Function to check if there are session error messages
function displaySessionErrorMessage() {
    if (isset($_SESSION['error'])) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '" . $_SESSION['error'] . "'
                });
            </script>";
        unset($_SESSION['error']); // Clear the session error message after displaying it
    }
}

// Function to check if user_id and role sessions are set and redirect accordingly
function redirectToDashboard() {
    if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        switch ($_SESSION['role']) {
            case "ADMIN":
                // Redirect to admin dashboard
                header("Location: ./admin/index.php");
                exit;
            case "EMPLOYEE":
                // Redirect to staff dashboard
                header("Location: ./employee/index.php");
                exit;
            case "STUDENT":
                // Redirect to user dashboard
                header("Location: ./student/index.php");
                exit;
            default:
                // Redirect to login page if role is not recognized
                header("Location: login.php");
                exit;
        }
    }
}

?>
