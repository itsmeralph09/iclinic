<?php
    // Include your database connection file
    require '../db/dbconn.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Extract data from the POST request
        $first_name = strtoupper(mysqli_real_escape_string($con, $_POST['first_name']));
        $middle_name = strtoupper(mysqli_real_escape_string($con, $_POST['middle_name']));
        $last_name = strtoupper(mysqli_real_escape_string($con, $_POST['last_name']));
        $suffix_name = strtoupper(mysqli_real_escape_string($con, $_POST['suffix_name']));
        $birth_date = mysqli_real_escape_string($con, $_POST['birth_date']); 

        // Debug: Check the format of the input birth date
        error_log("Received birth date: " . $birth_date);

        // Initialize age variable
        $age = 0;

        // Calculate age
        try {
            // Create DateTime object from the birth date
            $birthDate = DateTime::createFromFormat('Y-m-d', $birth_date);

            if (!$birthDate || $birthDate->format('Y-m-d') !== $birth_date) {
                throw new Exception("Date format incorrect");
            }

            // Get the current date
            $currentDate = new DateTime();

            // Ensure birth date is not in the future
            if ($birthDate > $currentDate) {
                throw new Exception("Birth date is in the future.");
            }

            // Calculate the age
            $age = $birthDate->diff($currentDate)->y;

            // Debug: Check the calculated age
            error_log("Calculated age: " . $age);
        } catch (Exception $e) {
            error_log("Error parsing date: " . $e->getMessage());
        }

        $sex = strtoupper(mysqli_real_escape_string($con, $_POST['sex']));
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $address = strtoupper(mysqli_real_escape_string($con, $_POST['address']));
        $classification = strtoupper(mysqli_real_escape_string($con, $_POST['classification']));

        if ($classification == "STUDENT") {
            $student_number = mysqli_real_escape_string($con, $_POST['student_number']);
            $course = strtoupper(mysqli_real_escape_string($con, $_POST['course']));
            $year_level = mysqli_real_escape_string($con, $_POST['year_level']);
        } elseif ($classification == "EMPLOYEE") {
            $employee_number = mysqli_real_escape_string($con, $_POST['employee_number']);
            $occupation = strtoupper(mysqli_real_escape_string($con, $_POST['occupation']));
        }

        $emergency_person = strtoupper(mysqli_real_escape_string($con, $_POST['emergency_person']));
        $emergency_contact = mysqli_real_escape_string($con, $_POST['emergency_contact']);
        $emergency_address = strtoupper(mysqli_real_escape_string($con, $_POST['emergency_address']));

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if ($classification == "STUDENT") {
            // Insert into the database
            $sql = "INSERT INTO user_tbl (no, email, password, role, status) VALUES ('$student_number','$email', '$hashed_password', '$classification', 'PENDING')";

            if ($con->query($sql) === TRUE) {
                $last_id = $con->insert_id;
                // Handle image file upload
                $file = $_FILES['profile'];
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $current_datetime = date('YmdHis'); // Generate current datetime
                $last_name_trimmed = trim($last_name); // Trim leading and trailing whitespace
                $last_name_trimmed = preg_replace('/[^a-zA-Z0-9]/', '', $last_name_trimmed); // Remove non-alphanumeric characters
                $file_name = $last_name_trimmed . '_' . $last_id . '_' . $current_datetime . '.' . $file_extension;
                $file_tmp = $file['tmp_name'];

                // Move uploaded image file to desired location
                $file_destination = "../img/profiles/" . $file_name;

                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $sqlSaveStudent = "INSERT INTO student_tbl (user_id, first_name, middle_name, last_name, suffix_name, birthdate, age, sex, contact_no, personal_address, course, year_level, emergency_contact_name, emergency_contact_no, emergency_contact_address, profile) VALUES ('$last_id', '$first_name', '$middle_name', '$last_name', '$suffix_name', '$birth_date', '$age', '$sex', '$contact', '$address', '$course','$year_level', '$emergency_person', '$emergency_contact', '$emergency_address', '$file_name')";

                    if ($con->query($sqlSaveStudent) === TRUE) {
                        // Return success response
                        echo json_encode(array("status" => "success", "message" => "Registration successful." .$age));
                    } else {
                        // Return error response if student insertion fails
                        echo json_encode(array("status" => "error", "message" => "Failed to save student details."));
                    }
                } else {
                    // Return error response if file upload fails
                    echo json_encode(array("status" => "error", "message" => "Failed to upload file."));
                }
            } else {
                // Return error response if user insertion fails
                echo json_encode(array("status" => "error", "message" => "Failed to save account details."));
            }
        } elseif ($classification == "EMPLOYEE") {
            // Insert into the database
            $sql = "INSERT INTO user_tbl (no, email, password, role, status) VALUES ('$employee_number','$email', '$hashed_password', '$classification', 'PENDING')";

            if ($con->query($sql) === TRUE) {
                $last_id = $con->insert_id;
                // Handle image file upload
                $file = $_FILES['profile'];
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $current_datetime = date('YmdHis'); // Generate current datetime
                $last_name_trimmed = trim($last_name); // Trim leading and trailing whitespace
                $last_name_trimmed = preg_replace('/[^a-zA-Z0-9]/', '', $last_name_trimmed); // Remove non-alphanumeric characters
                $file_name = $last_name_trimmed . '_' . $last_id . '_' . $current_datetime . '.' . $file_extension;
                $file_tmp = $file['tmp_name'];

                // Move uploaded image file to desired location
                $file_destination = "../img/profiles/" . $file_name;
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    $sqlSaveEmployee = "INSERT INTO employee_tbl (user_id, first_name, middle_name, last_name, suffix_name, birthdate, age, sex, contact_no, personal_address, occupation, emergency_contact_name, emergency_contact_no, emergency_contact_address, profile) VALUES ('$last_id', '$first_name', '$middle_name', '$last_name', '$suffix_name', '$birth_date', '$age', '$sex', '$contact', '$address', '$occupation', '$emergency_person', '$emergency_contact', '$emergency_address', '$file_name')";

                    if ($con->query($sqlSaveEmployee) === TRUE) {
                        // Return success response
                        echo json_encode(array("status" => "success", "message" => "Registration successful."));
                    } else {
                        // Return error response if employee insertion fails
                        echo json_encode(array("status" => "error", "message" => "Failed to save employee details."));
                    }
                } else {
                    // Return error response if file upload fails
                    echo json_encode(array("status" => "error", "message" => "Failed to upload file."));
                }
            } else {
                // Return error response if user insertion fails
                echo json_encode(array("status" => "error", "message" => "Failed to save account details."));
            }
        }

    } else {
        // If the form is not submitted via POST method, return error response
        echo json_encode(array("status" => "error", "message" => "Form submission method not allowed."));
    }
?>
