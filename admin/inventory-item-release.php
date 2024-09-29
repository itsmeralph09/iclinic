<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="inventory-item-release"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Item Release</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
								<div class="card-header py-3 d-flex flex-column flex-md-row">
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
								        <h6 class="font-weight-bold text-primary mb-0">History of Item Released</h6>
								    </div>
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
								    	<div class="col-12 col-md-4 float-right mx-0 px-0">
								    		<a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>Release Item</a>
								        </div>
								    </div>
								</div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap text-center" id="myTable" width="100%" cellspacing="0">
                                            <thead class="">
                                                <tr>
                                                  
                                                    <th scope="col">#</th>                                        
                                                    <th scope="col">Item Name</th>                                                                                
                                                    <th scope="col">Quantity Released</th>                                        
                                                    <th scope="col">Released To</th>                                               
                                                    <th scope="col">Released By</th>                                                                       
                                                    <th scope="col">Released Date</th>                                                                       
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            <?php

                                                require '../db/dbconn.php';

                                                $user_id = $_SESSION['user_id'];
                                                $display_appointments = "
                                                					SELECT 
                                                                        irt.release_id, 
                                                                        it.item_name, 
                                                                        irt.quantity_released,
                                                                        COALESCE(CONCAT(st.first_name, ' ', st.last_name), CONCAT(et.first_name, ' ', et.last_name)) AS recipient_name,
                                                                        CONCAT(adt.first_name, ' ', adt.last_name) AS releaser_name,
                                                                        irt.release_date
                                                                    FROM `item_release_tbl` irt
                                                                    INNER JOIN `item_tbl` it ON it.item_id = irt.item_id
                                                                    -- Alias ut1 for the user who the item is released to
                                                                    INNER JOIN `user_tbl` ut1 ON ut1.user_id = irt.released_to
                                                                    -- Alias ut2 for the user who released the item (admin or other roles)
                                                                    INNER JOIN `user_tbl` ut2 ON ut2.user_id = irt.released_by
                                                                    INNER JOIN `admin_tbl` adt ON adt.user_id = ut2.user_id
                                                                    LEFT JOIN `student_tbl` st ON ut1.user_id = st.user_id AND ut1.role = 'STUDENT'
                                                                    LEFT JOIN `employee_tbl` et ON ut1.user_id = et.user_id AND ut1.role = 'EMPLOYEE'
                                                					";
                                                $sqlQuery = mysqli_query($con, $display_appointments) or die(mysqli_error($con));

                                                $counter = 1;

                                                while($row = mysqli_fetch_array($sqlQuery)){
                                                    $release_id = $row['release_id'];
                                                    $item_name = $row['item_name'];
                                                    $quantity_released = $row['quantity_released'];
                                                    $recipient_name = $row['recipient_name'];
                                                    $releaser_name = $row['releaser_name'];
                                                    $release_date = $row['release_date'];

                                                    // Format the expiry date
                                                    $formatted_date = date('M d, Y', strtotime($release_date));
                                            ?>
                                            <tr>         
                                                <td class=""><?php echo $counter; ?></td>
                                                <td class=""><?php echo $item_name; ?></td>
                                                <td class=""><?php echo $quantity_released; ?></td>
                                                <td class="">
                                                    <?php echo $recipient_name; ?>
                                                </td>
                                                <td class=""><?php echo $releaser_name; ?></td>
                                                <td class=""><?php echo $formatted_date; ?></td>
                                            </tr>
                                            <?php
                                                    $counter++;
                                                    //include('modal/item_modals.php');
                                                } 
                                            ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include('modal/item_release_modal.php'); ?>
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

</body>

</html>