<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="students-appointment-pending"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Student Pending Appointments</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
								<div class="card-header py-3 d-flex flex-column flex-md-row">
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
								        <h6 class="font-weight-bold text-primary mb-0">List of Student Pending Appointments</h6>
								    </div>
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
								    	<div class="col-12 col-md-4 float-right mx-0 px-0">
								        	<!-- <a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>New Appointment</a> -->
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
                                                    <th scope="col">Name</th>                                        
                                                    <th scope="col">Course & Year</th>                                        
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

                                                $display_appointments = "
                                                					SELECT apt.*, CONCAT(st.last_name, ', ', st.first_name, ' ', st.suffix_name) as fullname, CONCAT(st.course, ' - ', 
                                                                              CASE 
                                                                                 WHEN st.year_level = 1 THEN '1st Year'
                                                                                 WHEN st.year_level = 2 THEN '2nd Year'
                                                                                 WHEN st.year_level = 3 THEN '3rd Year'
                                                                                 WHEN st.year_level = 4 THEN '4th Year'
                                                                                 ELSE CONCAT(st.year_level, 'th Year')
                                                                              END) AS course_year
																	FROM appointment_tbl apt
																	INNER JOIN user_tbl ut ON ut.user_id = apt.user_id
																	INNER JOIN student_tbl st ON st.user_id = ut.user_id
																	WHERE apt.deleted = 0 AND ut.role = 'STUDENT' AND apt.appointment_status = 'PENDING'
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
                                                    $fullname = $row['fullname'];
                                                    $course_year = $row['course_year'];

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
                                            <td class=""><?php echo $fullname; ?></td>
                                            <td class=""><?php echo $course_year; ?></td>
                                            <td class=""><?php echo $appointment_no; ?></td>
                                            <td class=""><?php echo $appointment_description_text; ?></td>
                                            <td class=""><?php echo $formatted_date; ?></td>
                                            <td class=""><?php echo $status_text; ?></td>
                                           
                                            <td class="text-center">
                                            	<a href="#" class="btn btn-sm shadow-sm btn-success approve-appointment-btn"
                                            		data-appointment-id="<?php echo $appointment_id; ?>"
                                            		data-appointment-name="<?php echo htmlspecialchars($fullname); ?>"
                                            		data-appointment-no="<?php echo htmlspecialchars($appointment_no); ?>" 
                                            		data-appointment-date="<?php echo htmlspecialchars($appointment_date); ?>"
                                            		data-appointment-description="<?php echo htmlspecialchars($appointment_description_text); ?>"
                                            		data-appointment-status="<?php echo htmlspecialchars($appointment_status); ?>">
                                                   <i class="fa-solid fa-check"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm shadow-sm btn-danger decline-appointment-btn"
                                            		data-appointment-id="<?php echo $appointment_id; ?>"
                                            		data-appointment-name="<?php echo htmlspecialchars($fullname); ?>"
                                            		data-appointment-no="<?php echo htmlspecialchars($appointment_no); ?>"
                                            		data-appointment-date="<?php echo htmlspecialchars($appointment_date); ?>"
                                            		data-appointment-description="<?php echo htmlspecialchars($appointment_description_text); ?>"
                                            		data-appointment-status="<?php echo htmlspecialchars($appointment_status); ?>">
                                                   <i class="fa-solid fa-xmark"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            $counter++;
                                            // include('modal/appointment_edit_modal.php');
                                        } 
                                        ?>
                                        </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php // include('modal/appointment_add_modal.php'); ?>
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

    <!-- Decline -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.decline-appointment-btn').on('click', function(e) {
                e.preventDefault();
                var declineButton = $(this);
                var appointmentID = declineButton.data('appointment-id');
                var appointmentDescription = decodeURIComponent(declineButton.data('appointment-description'));
                var appointmentNo = decodeURIComponent(declineButton.data('appointment-no'));
                var appointmentName = decodeURIComponent(declineButton.data('appointment-name'));
                var appointmentDate = decodeURIComponent(declineButton.data('appointment-date'));
                var appointmentStatus = decodeURIComponent(declineButton.data('appointment-status'));
                Swal.fire({
                    title: 'Decline Appointment',
                    html: "You are about to decline the following appointment:<br><br>" +
                    	  "<strong>Student Name.:</strong> " + appointmentName + "<br>" +
                          "<strong>Appointment No.:</strong> " + appointmentNo + "<br>" +
                          "<strong>Appointment Description:</strong> " + appointmentDescription + "<br>" +
                          "<strong>Appointment Date:</strong> " + appointmentDate + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, decline!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/decline_appointment.php',
                            type: 'POST',
                            data: {
                                appointment_id: appointmentID
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Declined!',
                                        'Appointment has been declined.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to decline appointment.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to decline appointment.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Approve -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.approve-appointment-btn').on('click', function(e) {
                e.preventDefault();
                var approveButton = $(this);
                var appointmentID = approveButton.data('appointment-id');
                var appointmentDescription = decodeURIComponent(approveButton.data('appointment-description'));
                var appointmentNo = decodeURIComponent(approveButton.data('appointment-no'));
                var appointmentName = decodeURIComponent(approveButton.data('appointment-name'));
                var appointmentDate = decodeURIComponent(approveButton.data('appointment-date'));
                var appointmentStatus = decodeURIComponent(approveButton.data('appointment-status'));
                Swal.fire({
                    title: 'Approve Appointment',
                    html: "You are about to approve the following appointment:<br><br>" +
                    	  "<strong>Student Name.:</strong> " + appointmentName + "<br>" +
                          "<strong>Appointment No.:</strong> " + appointmentNo + "<br>" +
                          "<strong>Appointment Description:</strong> " + appointmentDescription + "<br>" +
                          "<strong>Appointment Date:</strong> " + appointmentDate + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, approve!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/approve_appointment.php',
                            type: 'POST',
                            data: {
                                appointment_id: appointmentID
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Approved!',
                                        'Appointment has been approved.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to approve appointment.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to approve appointment.',
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