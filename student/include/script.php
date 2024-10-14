    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Get the ID of the current page
            var currentPage = $('div[id]').attr('id');

            // Add the .active class to the corresponding navigation item
            $('#accordionSidebar').find('a[href="' + currentPage + '.php"]').closest('li').addClass('active');
        });
    </script>

    <!-- Update Password -->
    <script>
        $(document).ready(function() {
            // Function for resetting password
            $('#resetPassBtn').on('click', function(e) {
                e.preventDefault();
                var resetButton = $(this);
                var userId = resetButton.data('user-id');

                // SweetAlert2 form to confirm current password
                Swal.fire({
                    title: 'Confirm Current Password',
                    html:
                        "<p>Please enter your current password:</p>" +
                        '<input type="password" id="currentPassword" class="swal2-input" placeholder="Current Password">',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    allowOutsideClick: false, // Disable outside click
                    preConfirm: () => {
                        const currentPassword = Swal.getPopup().querySelector('#currentPassword').value;
                        if (!currentPassword) {
                            Swal.showValidationMessage(`Please enter your current password`);
                        }
                        return { currentPassword: currentPassword };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var currentPassword = result.value.currentPassword;

                        // Perform AJAX request to verify the current password
                        $.ajax({
                            url: 'action/verify_current_password.php', // Backend script to handle password verification
                            type: 'POST',
                            data: {
                                user_id: userId,
                                password: currentPassword
                            },
                            success: function(response) {
                                if (response.trim() === 'verified') {
                                    // If verified, prompt for the new password
                                    Swal.fire({
                                        title: 'Update Password',
                                        html:
                                            "<p>Enter your new password:</p>" +
                                            '<input type="password" id="newPassword" class="swal2-input" placeholder="New Password">' +
                                            '<input type="password" id="confirmPassword" class="swal2-input" placeholder="Confirm Password">',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Update Password',
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
                                    }).then((newPasswordResult) => {
                                        if (newPasswordResult.isConfirmed) {
                                            var newPassword = newPasswordResult.value.newPassword;

                                            // Show an additional confirmation step
                                            Swal.fire({
                                                title: 'Confirm Password Update',
                                                text: "Are you sure you want to update your password?",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonText: 'Yes, update it!',
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
                                                                    'Password Updated!',
                                                                    'The password has been updated successfully.',
                                                                    'success'
                                                                );
                                                            } else {
                                                                Swal.fire(
                                                                    'Error!',
                                                                    'Failed to update password.',
                                                                    'error'
                                                                );
                                                            }
                                                        },
                                                        error: function(xhr, status, error) {
                                                            console.error(xhr.responseText);
                                                            Swal.fire(
                                                                'Error!',
                                                                'Failed to update password.',
                                                                'error'
                                                            );
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                } else {
                                    // If verification fails
                                    Swal.fire(
                                        'Error!',
                                        'Current password is incorrect.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to verify current password.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#logoutBtn").click(function(e){
                e.preventDefault(); // Prevent default action of the link

                $.ajax({
                    url: "../function/logout_action.php",
                    type: "POST",
                    success: function(response){
                        // Show SweetAlert2 notification with confirm button
                        Swal.fire({
                            icon: 'success',
                            title: 'Logout Successful',
                            text: 'You have been logged out successfully!',
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to login page after clicking "OK"
                                window.location.href = "../login.php";
                            }
                        });
                        // Redirect to login page after successful logout
                        setTimeout(function(){
                        window.location.href = "../login.php";
                        }, 1500); // Redirect after 1.5 seconds
                    },
                    error: function(xhr, status, error){
                        // Handle error if any
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>