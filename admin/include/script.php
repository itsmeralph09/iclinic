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
            var activeItem = $('#accordionSidebar').find('a[href="' + currentPage + '.php"]');
            activeItem.closest('li').addClass('active');
            activeItem.closest('a').addClass('active');

            // If the item is inside a collapsible menu, open the menu
            if (activeItem.closest('.collapse').length) {
                var collapseItem = activeItem.closest('.collapse');
                collapseItem.addClass('show'); // Open the collapse
                collapseItem.prev('a').removeClass('collapsed'); // Remove the collapsed class from the parent link
                collapseItem.prev('a').addClass('active'); // Add active class to the parent link
            }
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