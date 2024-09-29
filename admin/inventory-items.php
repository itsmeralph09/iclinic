<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="inventory-items"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Inventory Items</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
								<div class="card-header py-3 d-flex flex-column flex-md-row">
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
								        <h6 class="font-weight-bold text-primary mb-0">List of Inventory Items</h6>
								    </div>
								    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
								    	<div class="col-12 col-md-4 float-right mx-0 px-0">
								    		<a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>Add Item</a>
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
                                                    <th scope="col">Item Name</th>                                        
                                                    <th scope="col">Description</th>                                        
                                                    <th scope="col">Stock Quantity</th>                                        
                                                    <th scope="col">Unit</th>                                               
                                                    <th scope="col">Expiry Date</th>                                               
                                                    <th scope="col">Added By</th>
                                                    <th scope="col">Action</th>                           
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            <?php

                                                require '../db/dbconn.php';

                                                $user_id = $_SESSION['user_id'];
                                                $display_appointments = "
                                                					SELECT it.*, CONCAT(adt.first_name, ' ', adt.last_name) as adder_name
																	FROM `item_tbl` it
																	INNER JOIN `user_tbl` ut ON ut.user_id = it.added_by
																	INNER JOIN `admin_tbl` adt ON adt.user_id = ut.user_id
																	WHERE it.deleted = 0
                                                					";
                                                $sqlQuery = mysqli_query($con, $display_appointments) or die(mysqli_error($con));

                                                $counter = 1;

                                                while($row = mysqli_fetch_array($sqlQuery)){
                                                    $item_id = $row['item_id'];
                                                    $item_name = $row['item_name'];
                                                    $description = $row['description'];
                                                    $quantity_in_stock = $row['quantity_in_stock'];
                                                    $unit = $row['unit'];
                                                    $expiry_date = $row['expiry_date'];
                                                    $adder_name = $row['adder_name'];

                                                    // Format the expiry date
                                                    $formatted_date = date('M d, Y', strtotime($expiry_date));
                                            ?>
                                        <tr>         
                                            <td class=""><?php echo $counter; ?></td>
                                            <td class=""><?php echo $item_name; ?></td>
                                            <td class=""><?php echo $description; ?></td>
                                            <td class=""><?php echo $quantity_in_stock; ?></td>
                                            <td class=""><?php echo $unit; ?></td>
                                            <td class=""><?php echo $formatted_date; ?></td>
                                            <td class=""><?php echo $adder_name; ?></td>
                                           
                                            <td class="text-center">
                                            	<a class="btn btn-sm shadow-sm btn-primary" data-toggle="modal" data-target="#vitals_<?php echo $item_id; ?>">
                                                    <i class="fa-solid fa-heart-pulse"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            $counter++;
                                            include('modal/appointment_employee_vitals_modal.php');
                                        } 
                                        ?>
                                        </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include('modal/item_add_modal.php'); ?>
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
		// Expiry Date Validation
		document.getElementById('expiry_date').addEventListener('change', function() {
		    var inputDate = new Date(this.value);
		    var currentDate = new Date();

		    // Remove the time component from currentDate to compare only the date part
		    currentDate.setHours(0, 0, 0, 0);

		    // Check if the input date is set and not in the past
		    if (!this.value || inputDate < currentDate) {
		        Swal.fire({
		            icon: 'warning',
		            title: 'Oops...',
		            text: 'Please select a valid expiry date.'
		        });
		        $('input[name="expiry_date"]').addClass('is-invalid');
		        this.value = ''; // Clear the input field
		    } else {
		        $('input[name="expiry_date"]').removeClass('is-invalid');
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

	        $('#addItem').on('click', function(e) {
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
	            var expiryDate = formData.find('#expiry_date').val();
	            if (expiryDate === '' || expiryDate === '0000-00-00' || expiryDate === null) {
	                fieldsAreValid = false; // Set to false if date is invalid
	                showWarningMessage('Please select a valid expiry date.');
	                formData.find('#expiry_date').addClass('is-invalid'); // Add red border to date field
	            } else {
	            	fieldsAreValid = true;
	                formData.find('#expiry_date').removeClass('is-invalid'); // Remove red border if date is valid
	            }

	            if (fieldsAreValid) {
	                // If department doesn't exist, proceed with form submission
	                $.ajax({
	                    url: 'action/add_item.php', // URL to submit the form data
	                    type: 'POST',
	                    data: formData.serialize(), // Serialize form data
	                    success: function(response) {
	                        // Handle the success response
	                        console.log(response); // Output response to console (for debugging)
                            if (response === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Item added successfully!',
                                    showConfirmButton: true, // Show OK button
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to add item!',
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
	                            title: 'Failed to add item',
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

</body>

</html>