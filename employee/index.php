<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="index"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-info text-uppercase mb-1">
                                                Hello, <span class=""><?= $_SESSION['fullname']; ?>!</span></div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Welcome to iClinic - PRMSU Candelaria Clinic Management System.</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-house-medical-flag text-info fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                            $my_user_id = $_SESSION['user_id']; 
                        ?>
                        
                        <?php

                            require '../db/dbconn.php';

                            $sql = "
                                    SELECT * 
                                    FROM appointment_tbl apt
                                    INNER JOIN user_tbl ut ON ut.user_id = apt.user_id
                                    WHERE ut.role = 'STUDENT' AND apt.appointment_status = 'PENDING' AND apt.deleted = 0 AND apt.user_id = '$my_user_id'
                                ";

                            $result = mysqli_query($con, $sql);
                            $total_pending = mysqli_num_rows($result);
                        ?>
                        
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                My Pending Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pending ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-hourglass-start text-primary fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <?php

                            require '../db/dbconn.php';

                            $sql = "
                                    SELECT * 
                                    FROM appointment_tbl apt
                                    INNER JOIN user_tbl ut ON ut.user_id = apt.user_id
                                    WHERE ut.role = 'STUDENT' AND apt.appointment_status = 'APPROVED' AND apt.deleted = 0 AND apt.deleted = 0 AND apt.user_id = '$my_user_id'
                            ";

                            $result = mysqli_query($con, $sql);
                            $total_started = mysqli_num_rows($result);
                        ?>
                        
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                My Approved Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_started ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-hourglass-half text-success fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <?php

                            require '../db/dbconn.php';

                            $sql = "
                                    SELECT * 
                                    FROM appointment_tbl apt
                                    INNER JOIN user_tbl ut ON ut.user_id = apt.user_id
                                    WHERE ut.role = 'STUDENT' AND apt.appointment_status = 'COMPLETED' AND apt.deleted = 0 AND apt.deleted = 0 AND apt.user_id = '$my_user_id'
                            ";

                            $result = mysqli_query($con, $sql);
                            $total_closed = mysqli_num_rows($result);
                        ?>
                        
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">My Completed Appointment
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_closed ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-hourglass-end text-danger fa-2x"></i>
                                        </div>
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
   
    <a class="scroll-to-top rounded-circle bg-primary" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include './include/logout_modal.php'; ?>

    <?php include './include/script.php'; ?>
    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- <script src="../js/demo/chart-area-demo.js"></script> -->
    <!-- <script>
        $(document).ready(function() {
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Function to format numbers
            function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // AJAX request to fetch data from PHP script
            $.ajax({
                url: 'action/fetch_completed_events.php', // Replace 'your_php_script.php' with the actual path to your PHP script
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Extracting labels and data from the response
                    var labels = data.map(function(item) {
                        return item.month;
                    });
                    var eventData = data.map(function(item) {
                        return item.completed_events;
                    });

                    // Area Chart Example
                    var ctx = document.getElementById("myAreaChart");
                    var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Completed Events",
                                lineTension: 0.3,
                                backgroundColor: "rgba(78, 115, 223, 0.05)",
                                borderColor: "rgba(78, 115, 223, 1)",
                                pointRadius: 3,
                                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointBorderColor: "rgba(78, 115, 223, 1)",
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                                pointHitRadius: 10,
                                pointBorderWidth: 2,
                                data: eventData,
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 25,
                                    top: 25,
                                    bottom: 0
                                }
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                }],
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: 1,
                                        padding: 10,
                                    },
                                    gridLines: {
                                        color: "rgb(234, 236, 244)",
                                        zeroLineColor: "rgb(234, 236, 244)",
                                        drawBorder: false,
                                        borderDash: [2],
                                        zeroLineBorderDash: [2]
                                    }
                                }],
                            },
                            legend: {
                                display: false
                            },
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                titleMarginBottom: 10,
                                titleFontColor: '#6e707e',
                                titleFontSize: 14,
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                intersect: false,
                                mode: 'index',
                                caretPadding: 10,
                                callbacks: {
                                    label: function(tooltipItem, chart) {
                                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                        return datasetLabel + ': ' + tooltipItem.yLabel;
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Output error response to console (for debugging)
                    // Handle the error
                }
            });
        }); 
    </script> -->

    <!-- <script src="../js/demo/chart-pie-demo.js"></script> -->
    <!-- <script>
        $(document).ready(function() {
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Function to fetch data using AJAX
            function fetchData() {
                // Make an AJAX request to your PHP script
                $.ajax({
                    url: 'action/fetch_completed_events_per_host.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Check if data is received successfully
                        if (response && response.length > 0) {
                            // Extract data from the response
                            var labels = [];
                            var data = [];
                            for (var i = 0; i < response.length; i++) {
                                labels.push(response[i].office);
                                data.push(Math.round(response[i].event_count));
                            }

                            // Update the chart with the retrieved data
                            updateChart(labels, data);
                        } else {
                            console.error('No data received from the server');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // Function to update the chart
            function updateChart(labels, data) {
                // Define background and hover background colors with transparency
                var backgroundColors = [
                    'rgba(78, 115, 223, 0.5)',
                    'rgba(28, 200, 138, 0.5)',
                    'rgba(54, 185, 204, 0.5)',
                    'rgba(255, 193, 7, 0.5)',  // Yellow
                    'rgba(255, 99, 132, 0.5)', // Red
                    'rgba(153, 102, 255, 0.5)', // Purple
                    'rgba(75, 192, 192, 0.5)', // Teal
                    'rgba(255, 159, 64, 0.5)' // Orange
                ];
                var hoverBackgroundColors = [
                    'rgba(46, 89, 217, 0.5)',
                    'rgba(23, 166, 115, 0.5)',
                    'rgba(44, 159, 175, 0.5)',
                    'rgba(255, 206, 86, 0.5)',  // Yellow
                    'rgba(255, 99, 132, 0.5)',  // Red
                    'rgba(153, 102, 255, 0.5)',  // Purple
                    'rgba(75, 192, 192, 0.5)',  // Teal
                    'rgba(255, 159, 64, 0.5)'  // Orange
                ];

                // Get the context of the canvas element
                var ctx = document.getElementById('myPieChart').getContext('2d');

                // Create new chart instance
                var myPieChart = new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgroundColors,
                            hoverBackgroundColor: hoverBackgroundColors,
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            backgroundColor: 'rgb(255,255,255)',
                            bodyFontColor: '#858796',
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: true,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 80,
                    },
                });
            }

            // Call the fetchData function to fetch data and update the chart
            fetchData();

        }); 
    </script> -->
    
    </body>

</html>