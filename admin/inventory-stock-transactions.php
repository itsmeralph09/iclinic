<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="inventory-stock-transactions"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Inventory Stock Transaction</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
								<div class="card-header py-3 d-flex flex-column flex-md-row">
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
								        <h6 class="font-weight-bold text-primary mb-0">History of Inventory Stock Transaction</h6>
								    </div>
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
								    	<div class="col-12 col-md-4 float-right mx-0 px-0">
								    		<!-- <a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>Add Item</a> -->
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
                                                    <th scope="col">Transaction Type</th>                                        
                                                    <th scope="col">Quantity</th>                                        
                                                    <th scope="col">Transaction Date</th>                                               
                                                    <th scope="col">Transacted By</th>                                                                       
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            <?php

                                                require '../db/dbconn.php';

                                                $user_id = $_SESSION['user_id'];
                                                $display_appointments = "
                                                					SELECT it.item_name, stt.transaction_type, stt.quantity, stt.transaction_date, CONCAT(adt.first_name, ' ', adt.last_name) as transactioner_name
                                                                    FROM `stock_transaction_tbl` stt
                                                                    INNER JOIN `item_tbl` it ON it.item_id = stt.item_id
                                                                    INNER JOIN `user_tbl` ut ON ut.user_id = stt.transaction_by
                                                                    INNER JOIN `admin_tbl` adt ON adt.user_id = ut.user_id
                                                					";
                                                $sqlQuery = mysqli_query($con, $display_appointments) or die(mysqli_error($con));

                                                $counter = 1;

                                                while($row = mysqli_fetch_array($sqlQuery)){
                                                    $item_name = $row['item_name'];
                                                    $transaction_type = $row['transaction_type'];
                                                    $quantity = $row['quantity'];
                                                    $transaction_date = $row['transaction_date'];
                                                    $transactioner_name = $row['transactioner_name'];

                                                    // Format the expiry date
                                                    $formatted_date = date('M d, Y', strtotime($transaction_date));


                                                    if ($transaction_type == "STOCKS REDUCED") {
                                                        $transaction_type_text = "text-danger";
                                                    } elseif ($transaction_type == "STOCKS ADDED") {
                                                        $transaction_type_text = "text-success";
                                                    } elseif ($transaction_type == "STOCKS RELEASED") {
                                                        $transaction_type_text = "text-primary";
                                                    } else{
                                                        $transaction_type_text = "text-secondary";
                                                    }
                                            ?>
                                        <tr>         
                                            <td class=""><?php echo $counter; ?></td>
                                            <td class=""><?php echo $item_name; ?></td>
                                            <td class="<?php echo $transaction_type_text; ?>"><?php echo $transaction_type; ?></td>
                                            <td class="<?php echo $transaction_type_text; ?>">
                                                <?php echo $quantity; ?>
                                            </td>
                                            <td class=""><?php echo $formatted_date; ?></td>
                                            <td class=""><?php echo $transactioner_name; ?></td>
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
                        <?php //include('modal/item_add_modal.php'); ?>
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