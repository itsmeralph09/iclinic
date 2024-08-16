<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="appointments"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">My Appointments</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
								<div class="card-header py-3 d-flex flex-column flex-md-row">
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
								        <h6 class="font-weight-bold text-primary mb-0">List of My Appointments</h6>
								    </div>
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
								    	<div class="col-12 col-md-4 float-right mx-0 px-0">
								        	<a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>New Appointment</a>
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
                                                    <th scope="col">Appointment No.</th>                                        
                                                    <th scope="col">Appointment Description</th>                                               
                                                    <th scope="col">Appointment Date</th>                                               
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>                           
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            <?php

                                                require '../db/dbconn.php';

                                                $user_id = $_SESSION['user_id'];
                                                $display_appointments = "
                                                					SELECT apt.*
																	FROM appointment_tbl apt
																	INNER JOIN user_tbl ut ON ut.user_id = apt.user_id
																	INNER JOIN student_tbl st ON st.user_id = ut.user_id
																	WHERE apt.deleted = 0 AND apt.user_id = '$user_id';
                                                					";
                                                $sqlQuery = mysqli_query($con, $display_appointments) or die(mysqli_error($con));

                                                $counter = 1;

                                                while($row = mysqli_fetch_array($sqlQuery)){
                                                    $appointment_id = $row['appointment_id'];
                                                    $appointment_no = $row['appointment_no'];
                                                    $appointment_description = $row['appointment_description'];
                                                    $appointment_description_others = $row['appointment_description_others'];
                                                    $appointment_date = $row['appointment_date'];
                                                    $appointment_status = $row['appointment_status'];

                                                    // Format the appointment date
            										$formatted_date = date('M d, Y', strtotime($appointment_date));

                                                    if ($appointment_status == 'PENDING') {
                                                        $status_text = "<p class='text-warning text-center'>PENDING</p>";
                                                    } elseif ($appointment_status == 'APPROVED') {
                                                        $status_text = "<p class='text-success text-center'>APPROVED</p>";
                                                    } elseif ($appointment_status == 'COMPLETED') {
                                                        $status_text = "<p class='text-primary text-center'>COMPLETED</p>";
                                                    }

                                                    if ($appointment_description == "OTHERS") {
                                                    	$appointment_description_text = $appointment_description. ' (' . $appointment_description_others . ') ';
                                                    } else {
                                                    	$appointment_description_text = $appointment_description;
                                                    }
                                                    
                                            ?>
                                        <tr>         
                                            <td class=""><?php echo $counter; ?></td>
                                            <td class=""><?php echo $appointment_no; ?></td>
                                            <td class=""><?php echo $appointment_description_text; ?></td>
                                            <td class=""><?php echo $formatted_date; ?></td>
                                            <td class=""><?php echo $status_text; ?></td>
                                           
                                            <td class="text-center">
                                            	<?php if ($appointment_status == 'PENDING') { ?>
                                            		<a class="btn btn-sm shadow-sm btn-primary" data-toggle="modal" data-target="#edit_<?php echo $appointment_id; ?>">
                                                		<i class="fa-solid fa-pen-to-square"></i>
                                                	</a>
                                                	<a href="#" class="btn btn-sm shadow-sm btn-danger delete-appointment-btn"
                                                		data-appointment-id="<?php echo $appointment_id; ?>"
                                                		data-appointment-no="<?php echo $appointment_no; ?>" 
                                                		data-appointment-date="<?php echo htmlspecialchars($appointment_date); ?>"
                                                		data-appointment-description="<?php echo htmlspecialchars($appointment_description); ?>"
                                                		data-appointment-status="<?php echo htmlspecialchars($appointment_status); ?>">
	                                                   <i class="fa-solid fa-trash"></i>
	                                                </a>
                                            	<?php }else { ?>
                                            		<a class="btn btn-sm shadow-sm btn-primary disabled" disabled data-toggle="modal" data-target="#edit_<?php  ?>">
                                                		<i class="fa-solid fa-pen-to-square"></i>
                                                	</a>
                                                	<a class="btn btn-sm shadow-sm btn-danger disabled" disabled data-toggle="modal" data-target="#edit_<?php  ?>">
                                                		<i class="fa-solid fa-trash"></i>
                                                	</a>
                                            	<?php } ?>
                                                
                                            </td>
                                        </tr>
                                        <?php
                                            $counter++;
                                            include('modal/appointment_edit_modal.php');
                                        } 
                                        ?>
                                        </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include('modal/appointment_add_modal.php'); ?>
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

    <!-- Add Modal Script -->
    <script>
		 // Description Select Validation
		 document.addEventListener("DOMContentLoaded", function() {
		     var descSelect = document.getElementById("appointment_description");
		     var descDivOthers = document.getElementById("descriptionDivOthers");
		     var descInput = document.getElementById("appointment_description_others");

		     descSelect.addEventListener("change", function() {
		         if (descSelect.value === "Others") {
		             descDivOthers.classList.remove('d-none');
		             descInput.setAttribute('required', ''); // Add the 'required' attribute
		             // descInput.focus();
		         } else {
		             descDivOthers.classList.add('d-none');
		             descInput.removeAttribute('required'); // Remove the 'required' attribute
		             descInput.style.border = ''; // Removes the border style
		         }
		     });
		 });

		// Appointment Date Validation
		document.getElementById('appointment_date').addEventListener('change', function() {
		    var inputDate = new Date(this.value);
		    var currentDate = new Date();

		    // Remove the time component from currentDate to compare only the date part
		    currentDate.setHours(0, 0, 0, 0);

		    // Check if the input date is set and not in the past
		    if (!this.value || inputDate < currentDate) {
		        Swal.fire({
		            icon: 'warning',
		            title: 'Oops...',
		            text: 'Please select a valid appointment date.'
		        });
		        $('input[name="appointment_date"]').css('border', '1px solid red');
		        this.value = ''; // Clear the input field
		    } else {
		        $('input[name="appointment_date"]').css('border', ''); // Remove red border if valid
		    }
		});
    </script>

    <!-- Add -->
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

	        $('#addAppointment').on('click', function(e) {
	            e.preventDefault(); // Prevent default form submission

	            var formData = $('#addNew form'); // Select the form element

	            const requiredFields = formData.find('[required], select');
	            let fieldsAreValid = false; // Initialize as false

	            // Remove existing error classes
	            $('.form-control').removeClass('input-error');

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
	                	fieldsAreValid = true;
	                    $(this).removeClass('is-invalid'); // Remove red border if field is filled
	                }
	            });

	            // Additional validation for appointment date
	            var appointmentDate = formData.find('#appointment_date').val();
	            if (appointmentDate === '' || appointmentDate === '0000-00-00' || appointmentDate === null) {
	                fieldsAreValid = false; // Set to false if date is invalid
	                showWarningMessage('Please select a valid appointment date.');
	                formData.find('#appointment_date').addClass('is-invalid'); // Add red border to date field
	            } else {
	            	fieldsAreValid = true;
	                formData.find('#appointment_date').removeClass('is-invalid'); // Remove red border if date is valid
	            }

	            if (fieldsAreValid) {
	                // If department doesn't exist, proceed with form submission
	                $.ajax({
	                    url: 'action/add_appointment.php', // URL to submit the form data
	                    type: 'POST',
	                    data: formData.serialize(), // Serialize form data
	                    success: function(response) {
	                        // Handle the success response
	                        console.log(response); // Output response to console (for debugging)
                            if (response === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Appointment added successfully!',
                                    showConfirmButton: true, // Show OK button
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to add appointment!',
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
	                            title: 'Failed to add appointment',
	                            text: 'Please try again later.',
	                            showConfirmButton: true, // Show OK button
	                            confirmButtonText: 'OK'
	                        }).then(() => {
	                            location.reload();
	                        });
	                    }
	                });
	            }
	        });
	    });
	</script>

	<!-- Edit Modal Script -->
	<script>
		$(document).ready(function() {
		    // Description Select Validation
		    $(document).on('change', '[id^="appointment_description_"]', function() {
		        var descSelect = $(this);
		        var modal = descSelect.closest('.modal');
		        var descDivOthers = modal.find('[id^="descriptionDivOthers_"]');
		        var descInput = modal.find('[id^="appointment_descriptionOthers_"]');

		        if (descSelect.val() === "Others") {
		            descDivOthers.removeClass('d-none');
		            descInput.attr('required', ''); // Add the 'required' attribute
		        } else {
		            descDivOthers.addClass('d-none');
		            descInput.removeAttr('required'); // Remove the 'required' attribute
		            descInput.val(''); // Clear the input field
		            descInput.css('border', ''); // Remove the border style
		        }

		    });

		    // Appointment Date Validation
		    $(document).on('change', '[id^="appointment_date_"]', function() {
		        var inputDate = new Date($(this).val());
		        var currentDate = new Date();

		        currentDate.setHours(0, 0, 0, 0);

		        if (!$(this).val() || inputDate < currentDate) {
		            Swal.fire({
		                icon: 'warning',
		                title: 'Oops...',
		                text: 'Please select a valid appointment date.'
		            });
		            $(this).css('border', '1px solid red');
		            $(this).val(''); // Clear the input field
		        } else {
		            $(this).css('border', ''); // Remove red border if valid
		        }
		    });

		    // Ensure textarea is shown if "Others" is pre-selected on modal open
		    $(document).on('shown.bs.modal', function(e) {
		        var modal = $(e.target);
		        var descSelect = modal.find('[id^="appointment_description_"]');
		        var descDivOthers = modal.find('[id^="descriptionDivOthers_"]');
		        var descInput = modal.find('[id^="appointment_descriptionOthers_"]');

		        if (descSelect.val() === "Others") {
		            descDivOthers.removeClass('d-none');
		            descInput.attr('required', ''); // Add the 'required' attribute
		        } else {
		            descDivOthers.addClass('d-none');
		            descInput.removeAttr('required'); // Remove the 'required' attribute
		            descInput.val(''); // Clear the input field
		            descInput.css('border', ''); // Remove the border style
		        }
		    });
		});
	</script>

	<!-- Update -->
    <script>
        $(document).ready(function() {
            // Function to show SweetAlert2 messages
            const showSweetAlert = (icon, title, message) => {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: message
                });
            };

            // Delegate click event handling to a parent element
            $(document).on('click', '[id^="updateAppointment_"]', function(e) {
                e.preventDefault(); // Prevent default form submission
                var userID = $(this).attr('id').split('_')[1]; // Extract event ID
                var formData = $('#updateForm_' + userID); // Get the form data
                var modalDiv = $('#edit_' + userID);

                let fieldsAreValid = true; // Initialize as true
                // const requiredFields = formData.find('[required]'); // Select required fields
                const requiredFields = modalDiv.find(':input[required]'); // Select required fields

                // Remove existing error classes
                $('.form-control').removeClass('input-error');

                requiredFields.each(function() {
                    // Check if the element is a select and it doesn't have a selected value
                    if ($(this).is('select') && $(this).val() === null) {
                        fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                        showSweetAlert('warning', 'Oops!', 'Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    }
                    // Check if the element is empty
                    else if ($(this).val().trim() === '') {
                        fieldsAreValid = false; // Set to false if any required field is empty or null
                        showSweetAlert('warning', 'Oops!', 'Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    } else {
                        $(this).removeClass('is-invalid'); // Remove red border if field is filled
                    }
                });

                // Additional validation for appointment date
	            var appointmentDate = modalDiv.find('#appointment_date_' + userID).val();
	            if (appointmentDate === '' || appointmentDate === '0000-00-00' || appointmentDate === null) {
	                fieldsAreValid = false; // Set to false if date is invalid
	                showSweetAlert('warning', 'Oops!', 'Please select a valid appointment date.');
	                modalDiv.find('#appointment_date_' + userID).addClass('is-invalid'); // Add red border to date field
	            } else {
	            	fieldsAreValid = true;
	                modalDiv.find('#appointment_date_' + userID).removeClass('is-invalid'); // Remove red border if date is valid
	            }
                
                if (fieldsAreValid) {
                    $.ajax({
                        url: 'action/update_appointment.php', // URL to submit the form data
                        type: 'POST',
                        data: formData.serialize(), // Form data to be submitted
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
                            showSweetAlert('error', 'Error', 'Failed to update user. Please try again later.');
                        }
                    });
                }
            });
        });
    </script>

    <!-- Delete -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.delete-appointment-btn').on('click', function(e) {
                e.preventDefault();
                var deleteButton = $(this);
                var appointmentID = deleteButton.data('appointment-id');
                var appointmentDescription = decodeURIComponent(deleteButton.data('appointment-description'));
                var appointmentNo = decodeURIComponent(deleteButton.data('appointment-no'));
                var appointmentDate = decodeURIComponent(deleteButton.data('appointment-date'));
                var appointmentStatus = decodeURIComponent(deleteButton.data('appointment-status'));
                Swal.fire({
                    title: 'Delete Appointment',
                    html: "You are about to delete the following appointment:<br><br>" +
                          "<strong>Appointment No.:</strong> " + appointmentNo + "<br>" +
                          "<strong>Appointment Description:</strong> " + appointmentDescription + "<br>" +
                          "<strong>Appointment Date:</strong> " + appointmentDate + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/delete_appointment.php',
                            type: 'POST',
                            data: {
                                appointment_id: appointmentID
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Appointment has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete appointment.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete appointment.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>