<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="employees-appointment-history"></div>

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

                    <?php
                        $employee_user_id = urldecode($_GET['id']);
                        $employee_user_name = urldecode($_GET['name']);
                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Appointment History of <span class="text-primary"><?php echo $employee_user_name; ?></span></h1>
                        <a href="employees-approved.php" class="btn btn-sm btn-secondary"><i class="fa-solid fa-arrow-left mr-1"></i>Back</a>     
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
								<div class="card-header py-3 d-flex flex-column flex-md-row">
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
								        <h6 class="font-weight-bold text-primary mb-0">List of Employee Completed Appointments</h6>
								    </div>
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
								    	<div class="col-12 col-md-4 float-right mx-0 px-0">
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
                                                    <th scope="col">Occupation</th>                                        
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
                                                					SELECT apt.*, CONCAT(st.last_name, ', ', st.first_name, ' ', st.suffix_name) as fullname, st.occupation, avt.blood_pressure, avt.temperature, avt.weight, avt.height, avt.diagnosis, avt.date_completed
                                                                    FROM appointment_tbl apt
                                                                    INNER JOIN user_tbl ut ON ut.user_id = apt.user_id
                                                                    INNER JOIN employee_tbl st ON st.user_id = ut.user_id
                                                                    INNER JOIN appointment_vitals_tbl avt ON avt.appointment_id = apt.appointment_id
                                                                    WHERE apt.deleted = 0 AND ut.role = 'EMPLOYEE' AND apt.appointment_status = 'COMPLETED' AND apt.user_id = '$employee_user_id'
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
                                                    $occupation = $row['occupation'];

                                                    // Format the appointment date
                                                    $formatted_date = date('M d, Y', strtotime($appointment_date));
            										$formatted_date_completed = date('M d, Y', strtotime($appointment_date));

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

                                                    $blood_pressure = $row['blood_pressure'];
                                                    $temperature = $row['temperature'];
                                                    $weight = $row['weight'];
                                                    $height = $row['height'];
                                                    $diagnosis = $row['diagnosis'];
                                                    $date_completed = $row['date_completed'];
                                                    $formatted_date_completed = date('M d, Y', strtotime($date_completed));
                                                    
                                            ?>
                                        <tr>         
                                            <td class=""><?php echo $counter; ?></td>
                                            <td class=""><?php echo $fullname; ?></td>
                                            <td class=""><?php echo $occupation; ?></td>
                                            <td class=""><?php echo $appointment_no; ?></td>
                                            <td class=""><?php echo $appointment_description_text; ?></td>
                                            <td class=""><?php echo $formatted_date; ?></td>
                                            <td class=""><?php echo $status_text; ?></td>
                                           
                                            <td class="text-center">
                                            	<a class="btn btn-sm shadow-sm btn-primary" data-toggle="modal" data-target="#vitalsview_<?php echo $appointment_id; ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a class="btn btn-sm btn-success print-docx" data-id="<?php echo $appointment_id; ?>" data-no="<?php echo $appointment_no; ?>">
                                                    <i class="fa-solid fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            $counter++;
                                            include('modal/appointment_employee_vitalsview_modal.php');
                                        } 
                                        ?>
                                        </tbody>

                                        </table>
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

        <script>
$(document).ready(function() {
    $('.print-docx').click(function() {
        var appointmentId = $(this).data('id');

        // Show loading dialog using SweetAlert2
        Swal.fire({
            title: 'Preparing Document...',
            text: 'Please wait while the document is being prepared for print.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        // AJAX call to get the document content
        $.ajax({
            url: 'action/generate_print_view_employee.php', // Adjusted to point to the new PHP script
            method: 'POST',
            data: { appointment_id: appointmentId },
            success: function(response) {
                // Add a 1-second delay before switching to the new tab
                setTimeout(function() {
                    // Open the response in a new window for printing
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write(response);
                    printWindow.document.close();

                    // Wait for the new window to load
                    printWindow.onload = function() {
                        // Now that the content is loaded, we can print
                        printWindow.focus();
                        printWindow.print();
                        Swal.close();

                        // Show a success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'The document is ready for printing.',
                            icon: 'success'
                        });
                    };
                }, 1000); // 1000 milliseconds = 1 second
            },
            error: function(xhr, status, error) {
                // Handle error
                Swal.close();
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while preparing the document for print: ' + error,
                    icon: 'error'
                });
            }
        });
    });
});
</script>

</body>

</html>