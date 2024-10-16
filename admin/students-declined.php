<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="students-declined"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Declined Students</h1>
                        <!-- <a href="deleted_users.php" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-trash fa-sm"></i> Archived Users</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">List of Declined Students</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap" id="myTable" width="100%" cellspacing="0">
                                            <thead class="">
                                                <tr>
                                                  
                                                    <th scope="col">#</th>                                        
                                                    <th scope="col">Profile</th>                                        
                                                    <th scope="col">Name</th>                                               
                                                    <th scope="col">Course & Year</th>                                             
                                                    <th scope="col">Contact Info</th>                                           
                                                    <th scope="col">Account Status</th>                                           
                                                    <th scope="col">Action</th>                             
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            <?php

                                                require '../db/dbconn.php';
                                                $display_users = "SELECT st.*, ut.user_id, ut.no, ut.email, ut.role, ut.status
                                                                    FROM student_tbl st
                                                                    INNER JOIN user_tbl ut ON ut.user_id = st.user_id
                                                                    WHERE ut.status = 'DECLINED' AND ut.deleted = 0
                                                                    ";
                                                $sqlQuery = mysqli_query($con, $display_users) or die(mysqli_error($con));

                                                $counter = 1;

                                                while($row = mysqli_fetch_array($sqlQuery)){
                                                    $user_id = $row['user_id'];
                                                    $student_no = $row['no'];
                                                    $first_name = $row['first_name'];
                                                    $mid_name = $row['middle_name'];
                                                    $last_name = $row['last_name'];

                                                    $suffix_name = $row['suffix_name'];
                                                    if ($suffix_name == 'NA') {
                                                        $suffix = '';
                                                    }else{
                                                        $suffix = ', '.$suffix_name;
                                                    }

                                                    $birthdate = $row['birthdate'];
                                                    // Create a DateTime object from the birthdate
                                                    $birthdate_object = new DateTime($birthdate);

                                                    // Format the date to "M j, Y" (e.g., "Sep 9, 2001")
                                                    $formatted_birthdate = $birthdate_object->format('M j, Y');
                                                    
                                                    $age = $row['age'];
                                                    $sex = $row['sex'];
                                                    $email = $row['email'];
                                                    $contact = $row['contact_no'];
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
                                                    $emergency_no = $row['emergency_contact_no'];
                                                    $emergency_address = $row['emergency_contact_address'];

                                                    $profile = $row['profile'];
                                                    $role = $row['role'];

                                                    $status = $row['status'];
                                                    if ($status == 'PENDING') {
                                                        $status_text = "<p class='badge-warning text-center rounded-pill'>PENDING</p>";
                                                    } elseif ($status == "APPROVED") {
                                                        $status_text = "<p class='badge-success text-center rounded-pill'>APPROVED</p>";
                                                    } elseif ($status == "DECLINED") {
                                                        $status_text = "<p class='badge-danger text-center rounded-pill'>DECLINED</p>";
                                                    }
                                                   
                                                    $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . '' . $suffix;
                                            ?>
                                        <tr>         
                                            <td class=""><?php echo $counter; ?></td>
                                            <td class="d-flex">
                                                <img class="mx-auto rounded" src="../img/profiles/<?php echo $profile; ?>" alt="Profile Picture" style="width: 60px; height: 60px; object-fit: cover;">
                                            </td>
                                            <td class=""><?php echo $full_name; ?></td>
                                            <td class=""><?php echo $course; ?> - <?php echo $year; ?></td>
                                            <td class=""><?php echo $contact; ?></td>
                                            <td class=""><?php echo $status_text; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#view_<?php echo $user_id; ?>"><i class="fa-solid fa-eye"></i></a>
                                                <a href="#" class="btn btn-sm btn-success approve-student-btn"
                                                   data-user-id="<?php echo $user_id; ?>"
                                                   data-user-name="<?php echo htmlspecialchars($full_name); ?>"
                                                   data-user-no="<?php echo htmlspecialchars($student_no); ?>"
                                                   data-user-contact="<?php echo htmlspecialchars($contact); ?>"
                                                   data-user-course="<?php echo htmlspecialchars($course); ?>">
                                                   <i class="fa-solid fa-check"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            $counter++;
                                            include('modal/student_view_edit_modal.php');
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

    <!-- Approve Students Account Registration -->
    <script>
        $(document).ready(function() {
            // Function for approving student account registration
            $('.approve-student-btn').on('click', function(e) {
                e.preventDefault();
                var approveButton = $(this);
                var userId = approveButton.data('user-id');
                var userName = decodeURIComponent(approveButton.data('user-name'));
                var userNo = decodeURIComponent(approveButton.data('user-no'));
                var userContact = decodeURIComponent(approveButton.data('user-contact'));
                var userCourse = decodeURIComponent(approveButton.data('user-course'));

                Swal.fire({
                    title: 'Approve Student Account Registration',
                    html: "You are about to approve the following student:<br><br>" +
                          "<strong>Name:</strong> " + userName + "<br>" +
                          "<strong>Student No.:</strong> " + userNo + "<br>" +
                          "<strong>Course:</strong> " + userCourse + "<br>",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, approve!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading indicator
                        Swal.fire({
                            title: 'Processing...',
                            html: 'Sending SMS, please wait...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Send the AJAX request to approve student
                        $.ajax({
                            url: 'action/approve_student.php',
                            type: 'POST',
                            data: {
                                user_id: userId,
                                user_contact: userContact,
                                user_fullname: userName
                            },
                            success: function(response) {
                                Swal.close(); // Close the loading indicator

                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Approved!',
                                        'Student has been approved. An SMS has been sent to notify them.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to approve student.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.close(); // Close the loading indicator
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to approve student.',
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