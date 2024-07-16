<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="students"></div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include './include/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include './include/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Pending Students</h1>
                        <!-- <a href="deleted_users.php" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-trash fa-sm"></i> Archived Users</a> -->
                    </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Full Calendar -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">List of Pending Students</h6>
                     
                        <!-- <a class="btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#addnew"><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a> -->
                   
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap" id="myTable" width="100%" cellspacing="0">
                                <thead class="">
                                    <tr>
                                      
                                        <th scope="col">#</th>                                        
                                        <th scope="col">Profile Picture</th>                                        
                                        <th scope="col">Name</th>                                               
                                        <th scope="col">Course & Year</th>                                             
                                        <th scope="col">Email</th>                                               
                                        <th scope="col">Action</th>                             
                                       
                                    </tr>
                                </thead>
                                
                                <tbody>

                                <?php

                                    require '../db/dbconn.php';
                                    $display_users = "SELECT *
                                                        FROM student_tbl st
                                                        INNER JOIN user_tbl ut ON ut.user_id = st.user_id
                                                        WHERE ut.status = 'PENDING' AND ut.deleted = 0
                                                        ";
                                    $sqlQuery = mysqli_query($con, $display_users) or die(mysqli_error($con));

                                    $counter = 1;

                                    while($row = mysqli_fetch_array($sqlQuery)){
                                        $user_id = $row['user_id'];
                                        $first_name = $row['first_name'];
                                        $mid_name = $row['middle_name'];
                                        $last_name = $row['last_name'];
                                        $suffix_name = $row['suffix_name'];
                                        if ($suffix_name == 'NA') {
                                            $suffix = '';
                                        }else{
                                            $suffix = ', '.$suffix_name;
                                        }
                                        $age = $row['age'];
                                        $sex = $row['sex'];
                                        $email = $row['email'];
                                        $contact = $row['contact'];
                                        $address = $row['personal_address'];
                                        $course = $row['course'];
                                        $yr = $row['year_level'];
                                        if ($yr == 1) {
                                            $year = "1st Year";
                                        } elseif($yr == 2) {
                                            $year = "2nd Year";
                                        } elseif($yr == 3) {
                                            $year = "3rd Year";
                                        } elseif($yr == 4) {
                                            $year = "4th Year";
                                        }
                                        $emergency_person = $row['emergency_contact_name'];
                                        $profile = $row['profile'];
                                       
                                        $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '' . $suffix;
                                ?>
                            <tr>         
                                <td class=""><?php echo $counter; ?></td>
                                <td class="d-flex">
                                    <img class="mx-auto rounded" src="../img/profiles/<?php echo $profile; ?>" alt="Profile Picture" style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td class=""><?php echo $full_name; ?></td>
                                <td class=""><?php echo $course; ?> - <?php echo $year; ?></td>
                                <td class=""><?php echo $email; ?></td>
                               
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view_<?php echo $user_id; ?>"><i class="fa-solid fa-eye"></i></a>
                                    <a href="#" class="btn btn-sm btn-success approve-student-btn"
                                       data-user-id="<?php echo $user_id; ?>"
                                       data-user-name="<?php echo htmlspecialchars($full_names); ?>">
                                       <i class="fa-solid fa-check"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger decline-student-btn"
                                       data-user-id="<?php echo $user_id; ?>" 
                                       data-user-name="<?php echo htmlspecialchars($full_names); ?>">
                                       <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                $counter++;
                                // include('modal/user_edit_modal.php');
                            } 
                            ?>
                            </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <?php include('modal/user_add_modal.php'); ?>   -->
        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include './include/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include './include/logout_modal.php'; ?>

    <?php include './include/script.php'; ?>

<script>
    $(document).ready(function(){
        //inialize datatable
        $('#myTable').DataTable({
            scrollX: true
        })

        // Input Element for Contact Number
         function limitContactInputLength(event) {
             // Remove non-digit characters
             var inputValue = event.target.value.replace(/\D/g, '');

             // Limit the length to 11 digits
             if (inputValue.length > 11) {
                 inputValue = inputValue.slice(0, 11);
             }

             // Update the input value
             event.target.value = inputValue;
         }

         // Contact Input Validation
         var contactInput = document.getElementById('contactInput');
         contactInput.addEventListener('input', limitContactInputLength);


         // Select all inputs with the class 'contact-input'
        const contactInputs = document.querySelectorAll('.contact-input');

        // Add event listener to each contact input
        contactInputs.forEach((input) => {
            input.addEventListener('input', limitContactInputLength);
        });
    });
</script>

<!-- <script>
    $(document).ready(function() {
        // Function for deleting event
        $('.delete-user-btn').on('click', function(e) {
            e.preventDefault();
            var deleteBtn = $(this);
            var userId = deleteBtn.data('user-id');
            var userName = decodeURIComponent(deleteBtn.data('user-name'));
            Swal.fire({
                title: 'Delete User',
                html: "You are about to delete the following user:<br><br>" +
                      "<strong>Name:</strong> " + userName + "<br>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'action/delete_user.php', // Corrected 'file' to 'url'
                        type: 'POST',
                        data: {
                            user_id: userId
                        },
                        success: function(response) {
                            if (response.trim() === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    'User has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete user.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            Swal.fire(
                                'Error!',
                                'Failed to delete user.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
 -->
<!-- <script>
    $(document).ready(function() {
        // Variable to track if the profile picture is changed
        let profileValid = false;

        // Function to show SweetAlert2 warning message
        const showWarningMessage = (message) => {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: message
            });
        };

        // Function to check if email or username exists
        const checkExistingUser = (formData) => {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: 'action/check_user_exist.php', // URL to check the database
                    type: 'POST',
                    data: formData, // Serialize form data
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.exists) {
                            // Highlight the corresponding input fields with red border
                            if (response.exists.username && response.exists.email) {
                                showWarningMessage('Email and Username already exist.');
                                $('input[name="username"]').addClass('input-error');
                                $('input[name="email"]').addClass('input-error');
                            } else if (response.exists.email) {
                                showWarningMessage('Email already exists.');
                                $('input[name="email"]').addClass('input-error');
                            } else if (response.exists.username) {
                                showWarningMessage('Username already exists.');
                                $('input[name="username"]').addClass('input-error');
                            }
                            reject(); // Reject the promise if user already exists
                        } else {
                            resolve(); // Resolve the promise if user doesn't exist
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Output error response to console (for debugging)
                        reject(); // Reject the promise if there's an error
                    }
                });
            });
        };

        $('#profileUpload').on('change', function() {
            const fileInput = $(this)[0];
            const file = fileInput.files[0];

            // Update the label text with the selected file name
            $(this).next('#profileLabel').text(file.name);

            // Set profileValid to true when a new profile picture is selected
            profileValid = true;

            // Check if the file type is allowed
            const allowedTypes = ['image/png', 'image/jpeg', 'image/webp'];
            if (allowedTypes.includes(file.type)) {
                // Read the selected file and display the preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#profilePreview').attr('src', e.target.result); // Set image source to preview element
                    $('input[name="profile"]').removeClass('input-error');
                    $('.custom-file-label[for="profileUpload"]').removeClass('input-error'); // Remove input-error class from the label as well
                };
                reader.readAsDataURL(file);
            } else {
                // Show warning message for invalid file type
                showWarningMessage('Please select a valid image file (PNG, JPG, WEBP).');
                profileValid = false;
                $('#profileUpload').val(''); // Clear the file input
                $('input[name="profile"]').addClass('input-error');
                $('.custom-file-label[for="profileUpload"]').addClass('input-error'); // Add input-error class to the label as well
            }
        });

        // Function to handle form submission
        $('#addUser').on('click', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = new FormData($('#addForm')[0]); // Create FormData object

            const requiredFields = $('#addForm').find('[required], select[required]');

            let fieldsAreValid = true; // Initialize as true

            // Remove existing error classes
            $('.form-control').removeClass('input-error');

            requiredFields.each(function() {
                // Check if the element is a select and it doesn't have a selected value
                if ($(this).is('select') && $(this).val() === null) {
                    fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                    showWarningMessage('Please fill-up the required fields.');
                    $(this).addClass('input-error'); // Add red border to missing field
                } else if ($(this).val().trim() === '') {
                    fieldsAreValid = false; // Set to false if any required field is empty
                    showWarningMessage('Please fill-up the required fields.');
                    $(this).addClass('input-error'); // Add red border to missing field
                } else {
                    $(this).removeClass('input-error'); // Remove red border if field is filled
                }
            });

            let passwordsAreValid = true; // Initialize as true
            const password = formData.get('password');
            const confirmPassword = formData.get('confirm_password');

            if (fieldsAreValid) {
                if (password !== confirmPassword) {
                    passwordsAreValid = false;
                    showWarningMessage("Passwords don't match. Please check and try again.");
                    $('input[name="password"]').addClass('is-invalid');
                    $('input[name="confirm_password"]').addClass('is-invalid'); // Add red border to confirm password field
                } else {
                    $('input[name="password"]').removeClass('is-invalid');
                    $('input[name="confirm_password"]').removeClass('is-invalid'); // Remove red border if passwords match
                }
            }

            if (fieldsAreValid && passwordsAreValid) {
                if (!profileValid) {
                    showWarningMessage('Please upload a valid profile picture.');
                    $('#profileUpload').addClass('input-error');
                    $('#profileLabel').addClass('input-error'); // Add input-error class to the label as well
                    return; // Stop form submission
                }

                checkExistingUser(formData).then(() => {
                    $.ajax({
                        url: 'action/add_user.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Handle success response
                            if (response.trim() === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'User added successfully',
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                // Show error message if response is not 'success'
                                showWarningMessage('Failed to add user. Please try again later.');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.error(xhr.responseText);
                            showWarningMessage('Failed to add user. Please try again later.');
                        }
                    });
                }).catch(() => {
                    // If user exists, do nothing (error message already shown)
                });
            }
        });
    });
</script> -->

<!-- <script>
    $(document).ready(function() {
        // Variable to track if the profile picture is changed
        let profileValid = true;

        // Function to show SweetAlert2 warning message
        const showWarningMessage = (message) => {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: message
            });
        };

        // Function to check if email or username exists
        const checkExistingUser = (formData, userId) => {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: 'action/check_user_existence.php', // URL to check the database
                    type: 'POST',
                    data: formData, // Serialize form data
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.exists) {
                            // Highlight the corresponding input fields with red border
                            if (response.exists.username && response.exists.email) {
                                showWarningMessage('Email and Username already exist.');
                                $('#edit_' + userId).find('input[name="username"]').addClass('input-error');
                                $('#edit_' + userId).find('input[name="email"]').addClass('input-error');
                            } else if (response.exists.email) {
                                showWarningMessage('Email already exists.');
                                $('#edit_' + userId).find('input[name="email"]').addClass('input-error');
                            } else if (response.exists.username) {
                                showWarningMessage('Username already exists.');
                                $('#edit_' + userId).find('input[name="username"]').addClass('input-error');
                            }
                            reject(); // Reject the promise if user already exists
                        } else {
                            resolve(); // Resolve the promise if user doesn't exist
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Output error response to console (for debugging)
                        reject(); // Reject the promise if there's an error
                    }
                });
            });
        };

        // Function to handle file input change event for profile picture
        $('[id^="profileUpload_"]').on('change', function() {
            var userId = $(this).attr('id').split('_')[1]; // Extract event ID
            const fileInput = $(this)[0];
            const file = fileInput.files[0];

            // Update the label text with the selected file name
            $(this).next('#profileLabel_' + userId).text(file.name);

            // Check if the file type is allowed
            const allowedTypes = ['image/png', 'image/jpeg', 'image/webp'];
            if (allowedTypes.includes(file.type)) {
                // Read the selected file and display the preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#profilePreview_' + userId).attr('src', e.target.result); // Set image source to preview element
                };
                reader.readAsDataURL(file);
                profileValid = true; // Reset profileValid if file type is valid
            } else {
                // Show warning message for invalid file type
                showWarningMessage('Please select a valid image file (PNG, JPG, WEBP).');
                profileValid = false;
            }

            // Toggle input-error class based on profileValid
            $(this).toggleClass('input-error', !profileValid);
            $(this).next('#profileLabel_' + userId).toggleClass('input-error', !profileValid);
        });

        // For dynamically rendered modals
        $(document).on('click', '[id^="updateUser_"]', function(e) {
            e.preventDefault(); // Prevent default form submission
            var userId = $(this).attr('id').split('_')[1]; // Extract event ID
            var formData = new FormData($('#edit_' + userId + ' form')[0]);

            const requiredFields = $('#edit_' + userId).find('input[required], select[required]');

            let fieldsAreValid = true; // Initialize as true

            // Remove existing error classes
            $('.form-control').removeClass('input-error');

            requiredFields.each(function() {
                // Check if the element is a select and it doesn't have a selected value
                if ($(this).is('select') && $(this).val() === null) {
                    fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                    showWarningMessage('Please fill-up the required fields.');
                    $(this).addClass('input-error'); // Add red border to missing field
                } else if ($(this).val().trim() === '') {
                    fieldsAreValid = false; // Set to false if any required field is empty
                    showWarningMessage('Please fill-up the required fields.');
                    $(this).addClass('input-error'); // Add red border to missing field
                } else {
                    $(this).removeClass('input-error'); // Remove red border if field is filled
                }
            });

            let passwordsAreValid = true; // Initialize as true
            const password = formData.get('password');
            const confirmPassword = formData.get('confirm_password');

            if (fieldsAreValid) {
                if (password !== '' && password !== confirmPassword) {
                    passwordsAreValid = false;
                    showWarningMessage("Passwords don't match. Please check and try again.");
                    $('#edit_' + userId).find('input[name="password"]').addClass('is-invalid');
                    $('#edit_' + userId).find('input[name="confirm_password"]').addClass('is-invalid'); // Add red border to confirm password field
                } else {
                    $('#edit_' + userId).find('input[name="password"]').removeClass('is-invalid');
                    $('#edit_' + userId).find('input[name="confirm_password"]').removeClass('is-invalid'); // Remove red border if passwords match
                }
            }

            if (fieldsAreValid && passwordsAreValid) {
                checkExistingUser(formData, userId).then(() => {
                    // Check if profile picture is changed
                    if (!profileValid) {
                        showWarningMessage('Please upload a valid profile picture.');
                        $('[id^="profileUpload_"]').addClass('input-error');
                        $('[id^="profileLabel_"]').addClass('input-error');
                        return; // Stop form submission
                    }

                    $.ajax({
                        url: 'action/update_user.php', // file to submit the form data
                        type: 'POST',
                        data: formData, // Form data to be submitted
                        contentType: false, // Important: Prevent jQuery from setting contentType
                        processData: false, // Important: Prevent jQuery from processing data
                        dataType: 'json',
                        success: function(response) {
                            // Handle the success response
                            console.log(response); // Output response to console (for debugging)
                            if (response.status === 'success') {
                                Swal.fire(
                                    'Success!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response
                            console.error(xhr.responseText); // Output error response to console (for debugging)
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to update User',
                                text: 'Please try again later.',
                                showConfirmButton: true, // Show OK button
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });
                }).catch(() => {
                    // If user exists, do nothing (error message already shown)
                });
            }
        });
    });
</script> -->

</body>

</html>