<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="students-pending"></div>

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

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-column flex-md-row">
                                <div class="col-12 col-md-5 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
                                    <h6 class="font-weight-bold text-primary mb-0">List of Pending Students</h6>
                                </div>
                                <div class="col-12 col-md-7 d-flex align-items-center justify-content-end mx-0 px-0">
                                    <div class="col-12 col-md-8 mx-0 px-0 d-flex flex-column flex-md-row justify-content-end">
                                        <button class="btn btn-sm btn-success shadow-sm mr-0 mr-md-2 mb-2 mb-md-0 me-md-2 w-100 w-md-auto" id="approveSelectedBtn" disabled>Approve Selected</button>
                                        <button class="btn btn-sm btn-danger shadow-sm w-100 w-md-auto" id="declineSelectedBtn" disabled>Decline Selected</button>
                                    </div>
                                </div>
                            </div>


                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap" id="myTable" width="100%" cellspacing="0">
                                            <thead class="">
                                                <tr>
                                                  
                                                    <th class="d-flex align-items-center">
                                                        <input type="checkbox" id="checkAll" class="form-check mr-2">
                                                        <label class="form-check-label" for="checkAll">Select All</label>
                                                    </th>                                        
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
                                                                    WHERE ut.status = 'PENDING' AND ut.deleted = 0
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
                                            <td class="text-center">
                                                <input type="checkbox" value="<?php echo $user_id; ?>" name="user_ids[]" id="user_<?php echo $user_id; ?>">
                                                <label class="form-check-label" for="user_<?php echo $user_id; ?>">Select</label>
                                            </td>
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
                                                   data-user-course="<?php echo htmlspecialchars($course); ?>">
                                                   <i class="fa-solid fa-check"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger decline-student-btn"
                                                   data-user-id="<?php echo $user_id; ?>" 
                                                   data-user-name="<?php echo htmlspecialchars($full_name); ?>"
                                                   data-user-no="<?php echo htmlspecialchars($student_no); ?>"
                                                   data-user-course="<?php echo htmlspecialchars($course); ?>">
                                                   <i class="fa-solid fa-xmark"></i>
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
        $(document).ready(function() {
            // Select buttons
            const approveSelectedBtn = $('#approveSelectedBtn');
            const declineSelectedBtn = $('#declineSelectedBtn');

            // Function to check if any checkboxes are selected
            function updateButtonState() {
                const anyChecked = $('input[type="checkbox"]:checked').length > 0;

                if (anyChecked) {
                    approveSelectedBtn.prop('disabled', false); // Enable Approve button
                    declineSelectedBtn.prop('disabled', false); // Enable Decline button
                } else {
                    approveSelectedBtn.prop('disabled', true);  // Disable Approve button
                    declineSelectedBtn.prop('disabled', true);  // Disable Decline button
                }
            }

            // Event listener for individual checkboxes
            $('input[type="checkbox"]').on('change', function() {
                updateButtonState(); // Check button state when checkbox is changed
            });

            // Event listener for "Select All" checkbox
            $('#checkAll').on('change', function() {
                const isChecked = $(this).is(':checked');
                $('input[type="checkbox"]').prop('checked', isChecked);
                updateButtonState(); // Check button state when "Select All" is changed
            });

            // Initially disable buttons if no checkbox is selected
            updateButtonState();

            // Function to collect selected students' IDs, filtering out invalid values and the "Select All" checkbox
            function getSelectedStudentIds() {
                let selectedIds = [];
                // Iterate through each checked checkbox
                $('input[type="checkbox"]:checked').each(function() {
                    const value = $(this).val(); // Get the value (student ID)
                    // Exclude the "Select All" checkbox and ensure value is not "on"
                    if (value && value !== "on" && $(this).attr('id') !== 'checkAll') {
                        selectedIds.push(value); // Collect the valid student ID of the checked checkboxes
                    }
                });
                return selectedIds;
            }

            // Approve selected students with confirmation
            approveSelectedBtn.on('click', function() {
                let selectedIds = getSelectedStudentIds();
                
                if (selectedIds.length > 0) {
                    // Show confirmation prompt with the count of selected students
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to approve ${selectedIds.length} selected student(s).`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, approve them!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send selected IDs to the server via AJAX for approval
                            $.ajax({
                                url: 'action/approve_selected_students.php', // Your PHP script to handle approval
                                type: 'POST',
                                data: { user_ids: selectedIds }, // Correctly send selected IDs
                                success: function(response) {
                                    Swal.fire(
                                        'Approved!',
                                        'The selected students have been approved.',
                                        'success'
                                    ).then(() => {
                                        location.reload(); // Reload the page to reflect the updated status
                                    });
                                },
                                error: function() {
                                    Swal.fire('Error!', 'Failed to approve students. Please try again later.', 'error');
                                }
                            });
                        }
                    });
                }
            });

            // Decline selected students with confirmation
            declineSelectedBtn.on('click', function() {
                let selectedIds = getSelectedStudentIds();
                
                if (selectedIds.length > 0) {
                    // Show confirmation prompt with the count of selected students
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to decline ${selectedIds.length} selected student(s).`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, decline them!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send selected IDs to the server via AJAX for declining
                            $.ajax({
                                url: 'action/decline_selected_students.php', // Your PHP script to handle declining
                                type: 'POST',
                                data: { user_ids: selectedIds }, // Correctly send selected IDs
                                success: function(response) {
                                    Swal.fire(
                                        'Declined!',
                                        'The selected students have been declined.',
                                        'success'
                                    ).then(() => {
                                        location.reload(); // Reload the page to reflect the updated status
                                    });
                                },
                                error: function() {
                                    Swal.fire('Error!', 'Failed to decline students. Please try again later.', 'error');
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>


    <script>
        $(document).ready(function(){
            //inialize datatable
            $('#myTable').DataTable({
                scrollX: true
            })
        });
    </script>

    <!-- Decline Students Account Registration -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.decline-student-btn').on('click', function(e) {
                e.preventDefault();
                var declineButton = $(this);
                var userId = declineButton.data('user-id');
                var userName = decodeURIComponent(declineButton.data('user-name'));
                var userNo = decodeURIComponent(declineButton.data('user-no'));
                var userCourse = decodeURIComponent(declineButton.data('user-course'));
                Swal.fire({
                    title: 'Decline Student Account Registration',
                    html: "You are about to decline the following student:<br><br>" +
                          "<strong>Name:</strong> " + userName + "<br>" +
                          "<strong>Student No.:</strong> " + userNo + "<br>" +
                          "<strong>Course:</strong> " + userCourse + "<br>",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, decline!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/decline_student.php', // Corrected 'file' to 'url'
                            type: 'POST',
                            data: {
                                user_id: userId
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Declined!',
                                        'Student has been declined.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to decline student.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to decline student.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Approve Students Account Registration -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.approve-student-btn').on('click', function(e) {
                e.preventDefault();
                var approveButton = $(this);
                var userId = approveButton.data('user-id');
                var userName = decodeURIComponent(approveButton.data('user-name'));
                var userNo = decodeURIComponent(approveButton.data('user-no'));
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
                        $.ajax({
                            url: 'action/approve_student.php', // Corrected 'file' to 'url'
                            type: 'POST',
                            data: {
                                user_id: userId
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Approved!',
                                        'Student has been approved.',
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