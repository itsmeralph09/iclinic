<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="profile"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Profile Info</h1>
                    </div>

                    <div class="row">

                        <?php

                            $user_id_active = $_SESSION['user_id'];
                            require '../db/dbconn.php';
                            $display_users = "SELECT st.*, ut.user_id, ut.no, ut.email, ut.role, ut.status
                                                FROM employee_tbl st
                                                INNER JOIN user_tbl ut ON ut.user_id = st.user_id
                                                WHERE ut.status = 'APPROVED' AND ut.deleted = 0 AND ut.user_id = '$user_id_active'
                                                ";
                            $sqlQuery = mysqli_query($con, $display_users) or die(mysqli_error($con));

                            $counter = 1;

                            while($row = mysqli_fetch_array($sqlQuery)){
                                $user_id = $row['user_id'];
                                $employee_no = $row['no'];
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
                                $occupation = $row['occupation'];

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
                            }
                        ?>
                        
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow">
                                <form action="" id="updateForm">
                                    <div class="card-header bg-primary">
                                        <h5 class="text-light my-0">My Profile Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="mr-1">
                                                            <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id_active; ?>" required>
                                                            <div class="row form-group">
                                                                <div class="col-sm-4">
                                                                    <label for="first_name" class="col-form-label text-primary">First Name</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="first_name" value="<?php echo $first_name; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-4">
                                                                    <label for="middle_name" class="col-form-label text-primary">Middle Name</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="middle_name" value="<?php echo $mid_name; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-4">
                                                                    <label for="last_name" class="col-form-label text-primary">Last Name</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="last_name" value="<?php echo $last_name; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-4">
                                                                    <label for="suffix_name" class="col-form-label text-primary">Suffix Name</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="suffix_name" value="<?php echo $suffix_name; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-sm-4">
                                                                    <label for="student_no" class="col-form-label text-primary">Employee No</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="employee_no" value="<?php echo $employee_no; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <p class="text-primary">Profile</p>
                                                        <div class="row mb-3">
                                                            <div class="col-12 d-flex justify-content-center align-items-center">
                                                                 <div class="image-preview-container" style="width: 180px; height: 180px; border-radius: 5px; overflow: hidden;">
                                                                    <img class="img-fluid rounded" id="profilePreview_<?php echo $user_id; ?>" src="../img/profiles/<?php echo $profile; ?>" alt="Profile Picture Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>

                                                <hr class="">

                                                <div class="col-lg-12">
                                                    <div class="row form-group">
                                                        <div class="col-sm-3">
                                                            <label for="address" class="col-form-label text-primary">Personal Address</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control-plaintext custom-readonly-input" id="address" rows="1"><?php echo $address; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group row">
                                                                <label for="birthdate" class="col-sm-12 col-form-label text-primary">Birthdate</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="birthdate" value="<?php echo $formatted_birthdate; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-group row">
                                                                <label for="age" class="col-sm-12 col-form-label text-primary">Age</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="age" value="<?php echo $age; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-group row">
                                                                <label for="sex" class="col-sm-12 col-form-label text-primary">Sex</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="sex" value="<?php echo $sex; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group row">
                                                                <label for="contact" class="col-sm-12 col-form-label text-primary">Contact No</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="contact" value="<?php echo $contact; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group row">
                                                                <label for="email" class="col-sm-12 col-form-label text-primary">Email</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="email" value="<?php echo $email; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-group row">
                                                                <label for="course" class="col-sm-12 col-form-label text-primary">Occupation</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control-plaintext custom-readonly-input" id="course" value="<?php echo $occupation; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                           
                                                            
                                                </div>

                                                <hr>

                                                <div class="col-lg-12">
                                                    <div class="row form-group">
                                                        <div class="col-sm-3">
                                                            <label for="emergency_person" class="col-form-label text-primary">Emergency Contact Person</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input class="form-control-plaintext custom-readonly-input" id="emergency_person" value="<?php echo $emergency_person; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3">
                                                            <label for="emergency_no" class="col-form-label text-primary">Contact No</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <input class="form-control-plaintext custom-readonly-input" id="emergency_no" value="<?php echo $emergency_no; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3">
                                                            <label for="emergency_address" class="col-form-label text-primary">Address</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <textarea class="form-control-plaintext custom-readonly-input" id="emergency_address" rows="1"><?php echo $emergency_address; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div> 
                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" id="updateBtn">Update Profile</button>
                                    </div>
                                </form>
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

    </body>

</html>