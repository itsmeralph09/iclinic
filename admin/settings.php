<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="settings"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">System Settings</h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-info text-uppercase mb-1">
                                                Hello, <span class=""><?= $_SESSION['fullname']; ?>!</span></div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Welcome to iClinic - PRMSU Candelaria Clinic Management System.</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-house-medical-flag text-info fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

<div class="row">

<?php
// Include your database connection file
require '../db/dbconn.php';

// Fetch current settings from the database
$sql = "SELECT system_name, system_profile, system_password FROM settings_tbl WHERE settings_id = 1";
$result = $con->query($sql);

$currentSettings = null;
if ($result->num_rows > 0) {
    $currentSettings = $result->fetch_assoc();
}

$con->close(); // Close DB connection
?>

<!-- Area Chart -->
<div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Common Settings</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="px-3">
                <form id="settingsForm" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="systemName">System Name</label>
                        <textarea type="text" class="form-control" id="systemName" name="system_name" required><?php echo isset($currentSettings['system_name']) ? htmlspecialchars($currentSettings['system_name']) : ''; ?></textarea>
                        <div class="invalid-feedback">
                            Please input a valid System Name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="systemPassword">System Password</label>
                        <input type="password" class="form-control" id="systemPassword" name="system_password" required>
                        <div class="invalid-feedback">
                            Please input a valid System Password.
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-primary shadow-sm" id="updateSettingsBtn">Update Settings</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Advance</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="px-2">
                    <!-- Backup Button -->
                    <button id="backupBtn" class="btn btn-primary shadow-sm">Backup Database</button> 
                </div>
            </div>
        </div>
    </div>

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
   
    <a class="scroll-to-top rounded-circle bg-primary" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include './include/logout_modal.php'; ?>

    <?php include './include/script.php'; ?>
    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#updateSettingsBtn').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission
                
                let fieldsAreValid = true; // Initialize as true
                const requiredFields = $('#settingsForm').find(':input[required]'); // Select required fields

                // Remove existing error classes
                $('.form-control').removeClass('is-invalid');

                requiredFields.each(function() {
                    // Check if the element is a select and it doesn't have a selected value
                    if ($(this).is('select') && $(this).val() === null) {
                        fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                        showSweetAlert('warning', 'Oops!', 'Please fill in the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    }
                    // Check if the element is empty
                    else if ($(this).val().trim() === '') {
                        fieldsAreValid = false; // Set to false if any required field is empty or null
                        showSweetAlert('warning', 'Oops!', 'Please fill in the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    } else {
                        $(this).removeClass('is-invalid'); // Remove red border if field is filled
                    }
                });

                // Proceed only if all required fields are valid
                if (fieldsAreValid) {
                    // Show SweetAlert for current password confirmation
                    Swal.fire({
                        title: 'Confirm Current Password',
                        input: 'password',
                        inputPlaceholder: 'Enter your current password',
                        showCancelButton: true,
                        confirmButtonText: 'Submit',
                        cancelButtonText: 'Cancel',
                        allowOutsideClick: false,
                        preConfirm: (currentPassword) => {
                            return new Promise((resolve) => {
                                $.ajax({
                                    url: 'action/verify_password.php', // URL to the PHP script for password verification
                                    type: 'POST',
                                    data: { current_password: currentPassword },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success) {
                                            // If password is correct, resolve to proceed with settings update
                                            resolve();
                                        } else {
                                            // Reject to show error message
                                            Swal.showValidationMessage(response.message);
                                            resolve(); // Resolve to close the dialog
                                        }
                                    },
                                    error: function() {
                                        Swal.showValidationMessage('An error occurred while verifying the password. Please try again.');
                                        resolve(); // Resolve to close the dialog
                                    }
                                });
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the password was confirmed, proceed to update the settings
                            const formData = new FormData($('#settingsForm')[0]); // Create FormData object from the form

                            // AJAX request to update settings
                            $.ajax({
                                url: 'action/update_settings.php', // URL to the PHP script for updating settings
                                type: 'POST',
                                data: formData,
                                processData: false, // Prevent jQuery from automatically transforming the data into a query string
                                contentType: false, // Prevent jQuery from setting content type
                                success: function(updateResponse) {
                                    if (updateResponse.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Settings Updated',
                                            text: updateResponse.message, // Message from the update response
                                            confirmButtonText: 'Okay'
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Update Failed',
                                            text: updateResponse.message, // Error message from the update response
                                            confirmButtonText: 'Okay'
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while updating the settings. Please try again.',
                                        confirmButtonText: 'Okay'
                                    });
                                }
                            });
                        }
                    });
                }
            });
        });

        // Helper function to show SweetAlert
        function showSweetAlert(icon, title, text) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text,
                confirmButtonText: 'Okay'
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#backupBtn').on('click', function() {
                // Show SweetAlert for current password confirmation
                Swal.fire({
                    title: 'Confirm Current Password',
                    input: 'password',
                    inputPlaceholder: 'Enter your current password',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel',
                    allowOutsideClick: false,
                    preConfirm: (currentPassword) => {
                        return new Promise((resolve) => {
                            $.ajax({
                                url: 'action/verify_password.php', // URL to the PHP script for password verification
                                type: 'POST',
                                data: { current_password: currentPassword },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.success) {
                                        resolve(); // Password is correct, resolve the promise
                                    } else {
                                        Swal.showValidationMessage(response.message); // Show validation error
                                        resolve(); // Resolve to close the dialog
                                    }
                                },
                                error: function() {
                                    Swal.showValidationMessage('An error occurred while verifying the password. Please try again.');
                                    resolve(); // Resolve to close the dialog
                                }
                            });
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show confirmation prompt for backup
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You are about to backup the database. This action cannot be undone.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, backup it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Trigger the backup using AJAX
                                $.ajax({
                                    url: 'action/backup_db.php', // Update the path to your backup script
                                    type: 'GET',
                                    success: function(response) {
                                        // Create a Blob from the response
                                        const blob = new Blob([response], { type: 'application/sql' });
                                        const url = window.URL.createObjectURL(blob);
                                        
                                        // Create a link element
                                        const a = document.createElement('a');
                                        a.href = url;
                                        a.download = 'backup.sql'; // Specify the filename for the downloaded file
                                        document.body.appendChild(a);
                                        a.click(); // Trigger the download
                                        a.remove(); // Clean up the link element

                                        // Notify user of success
                                        Swal.fire('Success!', 'Database backup completed.', 'success');
                                    },
                                    error: function() {
                                        Swal.fire('Error!', 'Failed to backup the database. Please try again.', 'error');
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    </body>

</html>