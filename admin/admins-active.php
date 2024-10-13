<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="admins-active"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Active Admin</h1>
                        <!-- <a href="deleted_users.php" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-trash fa-sm"></i> Archived Users</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-column flex-md-row">
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
                                        <h6 class="font-weight-bold text-primary mb-0">List of Active Admin</h6>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
                                        <div class="col-12 col-md-4 float-right mx-0 px-0">
                                            <a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>New Admin</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap" id="myTable" width="100%" cellspacing="0">
                                            <thead class="">
                                                <tr>
                                                  
                                                    <th scope="col">#</th>                                        
                                                    <!-- <th scope="col">Profile</th>                                         -->
                                                    <th scope="col">Name</th>                                                                                         
                                                    <th scope="col">Employee No</th>                                                                                         
                                                    <th scope="col">Contact Info</th>                                           
                                                    <th scope="col">Occupation</th>                                                                                  
                                                    <th scope="col">Action</th>                             
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            <?php
                                                $user_id_logged = $_SESSION['user_id'];
                                                require '../db/dbconn.php';
                                                $display_users = "SELECT adt.*, ut.user_id, ut.no, ut.email, ut.role, ut.status
                                                                    FROM admin_tbl adt
                                                                    INNER JOIN user_tbl ut ON ut.user_id = adt.user_id
                                                                    WHERE ut.status = 'APPROVED' AND ut.deleted = 0 and ut.user_id !=  '$user_id_logged'
                                                                    ";
                                                $sqlQuery = mysqli_query($con, $display_users) or die(mysqli_error($con));

                                                $counter = 1;

                                                while($row = mysqli_fetch_array($sqlQuery)){
                                                    $user_id = $row['user_id'];
                                                    $admin_no = $row['no'];
                                                    $first_name = $row['first_name'];
                                                    $mid_name = $row['middle_name'];
                                                    $last_name = $row['last_name'];

                                                    $suffix_name = $row['suffix_name'];
                                                    if ($suffix_name == 'NA') {
                                                        $suffix = '';
                                                    }else{
                                                        $suffix = ', '.$suffix_name;
                                                    }

                                                    $email = $row['email'];
                                                    $contact = $row['contact_no'];
                                                    $occupation = $row['occupation'];

                                                    $profile = $row['profile'];
                                                    $role = $row['role'];
                                                   
                                                    $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '' . $suffix;
                                            ?>
                                                <tr>         
                                                    <td class=""><?php echo $counter; ?></td>
                                                    <!-- <td class="d-flex">
                                                        <img class="mx-auto rounded" src="../img/profiles/<?php echo $profile; ?>" alt="Profile Picture" style="width: 60px; height: 60px; object-fit: cover;">
                                                    </td> -->
                                                    <td class=""><?php echo $full_name; ?></td>
                                                    <td class=""><?php echo $admin_no; ?></td>
                                                    <td class=""><?php echo $contact; ?></td>
                                                    <td class=""><?php echo $occupation; ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view_<?php echo $user_id; ?>"><i class="fa-solid fa-eye"></i></a>
                                                        <a href="#" class="btn btn-sm btn-info reset-admin-btn"
                                                           data-user-id="<?php echo $user_id; ?>" 
                                                           data-user-name="<?php echo htmlspecialchars($full_name); ?>"
                                                           data-user-no="<?php echo htmlspecialchars($admin_no); ?>">
                                                           <i class="fa-solid fa-key"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger delete-admin-btn"
                                                           data-user-id="<?php echo $user_id; ?>" 
                                                           data-user-name="<?php echo htmlspecialchars($full_name); ?>"
                                                           data-user-no="<?php echo htmlspecialchars($admin_no); ?>">
                                                           <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $counter++;
                                                // include('modal/admin_view_edit_modal.php');
                                            } 
                                            ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include('modal/admin_add_modal.php'); ?>
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
        });
    </script>

    <!-- Delete Admin Account -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.delete-admin-btn').on('click', function(e) {
                e.preventDefault();
                var declineButton = $(this);
                var userId = declineButton.data('user-id');
                var userName = decodeURIComponent(declineButton.data('user-name'));
                var userNo = decodeURIComponent(declineButton.data('user-no'));
                Swal.fire({
                    title: 'Delete Admin Account',
                    html: "You are about to delete the following admin:<br><br>" +
                          "<strong>Name:</strong> " + userName + "<br>" +
                          "<strong>Student No.:</strong> " + userNo + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/delete_admin.php', // Corrected 'file' to 'url'
                            type: 'POST',
                            data: {
                                user_id: userId
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Admin has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete admin.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete admin.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Reset Admin Password -->
    <script>
        $(document).ready(function() {
            // Function for resetting password
            $('.reset-admin-btn').on('click', function(e) {
                e.preventDefault();
                var resetButton = $(this);
                var userId = resetButton.data('user-id');
                var userName = decodeURIComponent(resetButton.data('user-name'));
                var userNo = decodeURIComponent(resetButton.data('user-no'));
                var userCourse = decodeURIComponent(resetButton.data('user-course'));

                // SweetAlert2 form for password reset
                Swal.fire({
                    title: 'Reset Password',
                    html:
                        "<p>You are about to reset the password for the following admin:</p>" +
                        "<strong>Name:</strong> " + userName + "<br>" +
                        "<strong>Employee No.:</strong> " + userNo + "<br>" +
                        '<input type="password" id="newPassword" class="swal2-input" placeholder="New Password">' +
                        '<input type="password" id="confirmPassword" class="swal2-input" placeholder="Confirm Password">',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Reset Password',
                    allowOutsideClick: false, // Disable outside click
                    preConfirm: () => {
                        const newPassword = Swal.getPopup().querySelector('#newPassword').value;
                        const confirmPassword = Swal.getPopup().querySelector('#confirmPassword').value;
                        if (!newPassword || !confirmPassword) {
                            Swal.showValidationMessage(`Please enter both password fields`);
                        } else if (newPassword !== confirmPassword) {
                            Swal.showValidationMessage(`Passwords do not match`);
                        }
                        return { newPassword: newPassword };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var newPassword = result.value.newPassword;

                        // Show an additional confirmation step
                        Swal.fire({
                            title: 'Confirm Password Reset',
                            text: "Are you sure you want to reset this student's password?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, reset it!',
                            cancelButtonText: 'Cancel',
                            allowOutsideClick: false // Disable outside click
                        }).then((confirmResult) => {
                            if (confirmResult.isConfirmed) {
                                // Perform AJAX request to update the password in the backend
                                $.ajax({
                                    url: 'action/reset_password.php', // Backend script to handle password reset
                                    type: 'POST',
                                    data: {
                                        user_id: userId,
                                        password: newPassword
                                    },
                                    success: function(response) {
                                        if (response.trim() === 'success') {
                                            Swal.fire(
                                                'Password Reset!',
                                                'The password has been reset successfully.',
                                                'success'
                                            );
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                'Failed to reset password.',
                                                'error'
                                            );
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText);
                                        Swal.fire(
                                            'Error!',
                                            'Failed to reset password.',
                                            'error'
                                        );
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Add Admin Account-->
    <script>
        $(document).ready(function() {
            // Function to show SweetAlert2 warning message
            const showWarningMessage = (message) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: message
                });
            };

            // Function to check if no or email already exists
            const checkExistingUser = (formData) => {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: 'action/check_admin_exists.php', // URL to check the database
                        type: 'POST',
                        data: formData.serialize(), // Serialize form data
                        success: function(response) {
                            if (response.exists) {
                                // Highlight the corresponding input fields with red border
                                if (response.exists.no && response.exists.email) {
                                    showWarningMessage('Employee No. and Email already exists.');
                                    formData.find('input[name="no"]').addClass('input-error');
                                    formData.find('input[name="email"]').addClass('input-error');
                                } else if (response.exists.no) {
                                    showWarningMessage('Employee No. already exists.');
                                    formData.find('input[name="no"]').addClass('input-error');
                                } else if (response.exists.email) {
                                    showWarningMessage('Email already exists.');
                                    formData.find('input[name="email"]').addClass('input-error');
                                }
                                reject(); // Reject the promise if department already exists
                            } else {
                                resolve(); // Resolve the promise if department doesn't exist
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Output error response to console (for debugging)
                            reject(); // Reject the promise if there's an error
                        }
                    });
                });
            };

            $('#addAdmin').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $('#addNew form'); // Select the form element

                const requiredFields = formData.find('[required], select');
                let fieldsAreValid = true; // Initialize as false

                // Remove existing error classes
                $('.form-control').removeClass('is-invalid');

                requiredFields.each(function() {
                    // Check if the element is a select and it doesn't have a selected value
                    if ($(this).is('select') && $(this).val() === null) {
                        fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                        showWarningMessage('Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    }
                    // Check if the element is empty
                    else if ($(this).val().trim() === '') {
                        fieldsAreValid = false; // Set to false if any required field is empty
                        showWarningMessage('Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    } else {
                        $(this).removeClass('is-invalid'); // Remove red border if field is filled
                    }
                });

                let passwordsAreValid = true; // Initialize as true
                const password = formData.find('input[name="password"]').val();
                const confirmPassword = formData.find('input[name="confirm_password"]').val();

                if (fieldsAreValid) {
                    if (password !== confirmPassword) {
                        passwordsAreValid = false;
                        showWarningMessage("Passwords don't match. Please check and try again.");
                        formData.find('input[name="confirm_password"]').addClass('is-invalid'); // Add red border to confirm password field
                    } else {
                        formData.find('input[name="confirm_password"]').removeClass('is-invalid'); // Remove red border if passwords match
                    }
                }

                if (fieldsAreValid && passwordsAreValid) {
                    checkExistingUser(formData).then(() => {
                        // If username or email doesn't exist, proceed with form submission
                        $.ajax({
                            url: 'action/add_admin.php', // URL to submit the form data
                            type: 'POST',
                            data: formData.serialize(), // Serialize form data
                            success: function(response) {
                                // Handle the success response
                                console.log(response); // Output response to console (for debugging)
                                if (response === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Admin added successfully!',
                                        showConfirmButton: true, // Show OK button
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Failed to add admin!',
                                        text: 'Please try again later.',
                                        showConfirmButton: true,
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle the error response
                                console.error(xhr.responseText); // Output error response to console (for debugging)
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to add admin',
                                    text: 'Please try again later.',
                                    showConfirmButton: true, // Show OK button
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                     }).catch(() => {
                        // If admin exists, do nothing (error message already shown)
                    });
                }
            });
        });
    </script>

</body>

</html>