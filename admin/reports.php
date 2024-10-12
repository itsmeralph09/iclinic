<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="reports"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Reports</h1>
                        <!-- <a href="deleted_users.php" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-trash fa-sm"></i> Archived Users</a> -->
                    </div>

<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Medical Cases Report And Analysis</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="yearSelect">Select Year:</label>
                        <select id="yearSelect" class="form-control custom-select">
                            <option value="">-- Select Year --</option>
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="monthSelect">Select Month:</label>
                        <select id="monthSelect" class="form-control custom-select">
                            <option value="">-- Select Month --</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="diagnosisSelect">Select Diagnosis:</label>
                        <select id="diagnosisSelect" class="form-control custom-select">
                            <option value="">-- Select Diagnosis --</option>
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                </div>
                <button id="generateBtn" class="btn btn-primary">Generate</button>
                <button id="printBtn" class="btn btn-secondary">Print</button>
                <hr>
                <div class="mt-3" id="reportContainer">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    <h5 id="reportTitle" class="text-center">Medical Cases Report</h5>
                                    <h6 id="subtitle" class="text-center text-muted mb-0"></h6>
                                </div>
                                <div class="card-body p-5">
                                    <canvas id="myPolarAreaChart" width="400" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center">Data Summary</h5> <!-- Title for Data Table -->
                                </div>
                                <div class="card-body p-4">
                                    <table class="table table-bordered mt-3 table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Diagnosis</th>
                                                <th>Cases Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data rows will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="legend mt-3" id="chartLegend"></div>
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

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

<script> 
    $(document).ready(function() {
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Reference for the chart instance
        let myPolarAreaChart;

        // Function to fetch years from the database
        function fetchYears() {
            $.ajax({
                url: 'action/fetch_years.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    const yearSelect = $('#yearSelect');
                    response.forEach(year => {
                        const option = $('<option>').val(year).text(year);
                        yearSelect.append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching years:', error);
                }
            });
        }

        // Function to fetch diagnoses from the database
        function fetchDiagnoses() {
            $.ajax({
                url: 'action/fetch_diagnosis.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    const diagnosisSelect = $('#diagnosisSelect');
                    response.forEach(diagnosis => {
                        const option = $('<option>').val(diagnosis).text(diagnosis);
                        diagnosisSelect.append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching diagnoses:', error);
                }
            });
        }

        // Function to generate the report
        function generateReport() {
            const selectedYear = $('#yearSelect').val();
            const selectedMonth = $('#monthSelect').val();
            const selectedMonthText = selectedMonth !== "" && selectedMonth !== "-- Select Month --" ? $('#monthSelect option:selected').text() : ""; // Get the text of the selected option if it's valid
            const selectedDiagnosis = $('#diagnosisSelect').val();

            // Set subtitle for year, month, and diagnosis
            let subtitle = '';
            if (selectedYear) subtitle += `Year: ${selectedYear} `;
            if (selectedMonthText) subtitle += `Month: ${selectedMonthText} `;
            if (selectedDiagnosis) subtitle += `Diagnosis: ${selectedDiagnosis}`;
            
            $('#subtitle').text(subtitle.trim()); // Set the subtitle text

            $.ajax({
                url: `action/generate_report.php?year=${selectedYear}&month=${selectedMonth}&diagnosis=${selectedDiagnosis}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Destroy the existing chart if it exists
                    if (myPolarAreaChart) {
                        myPolarAreaChart.destroy();
                    }

                    createPolarAreaChart(data);
                    populateDataTable(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error generating report:', error);
                }
            });
        }

        // Function to create a polar area chart
        function createPolarAreaChart(data) {
            var ctx = document.getElementById('myPolarAreaChart').getContext('2d');
            myPolarAreaChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Patient Count',
                        data: data.counts,
                        backgroundColor: [
                            'rgba(28, 200, 138, 0.5)', 
                            'rgba(54, 185, 204, 0.5)', 
                            'rgba(246, 194, 62, 0.5)', 
                            'rgba(231, 74, 59, 0.5)'    
                        ],
                        hoverBackgroundColor: [
                            'rgba(23, 166, 115, 0.7)', 
                            'rgba(44, 159, 175, 0.7)', 
                            'rgba(244, 182, 25, 0.7)', 
                            'rgba(224, 45, 27, 0.7)'    
                        ],
                        borderColor: "rgba(234, 236, 244, 1)"
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: true,
                        caretPadding: 10
                    },
                    legend: {
                        position: 'bottom',
                        display: true
                    },
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            backdropColor: 'rgba(255, 255, 255, 0)'
                        }
                    }
                }
            });
        }

        // Function to populate the data table
        function populateDataTable(data) {
            const dataTableBody = $('#dataTable tbody');
            dataTableBody.empty();

            data.labels.forEach((label, index) => {
                const row = $('<tr>');
                row.append($('<td>').text(label));
                row.append($('<td>').text(data.counts[index]));
                dataTableBody.append(row);
            });
        }

        // Event listener for the generate button
        $('#generateBtn').on('click', generateReport);

        // Fetch years and diagnoses on page load
        fetchYears();
        fetchDiagnoses();
    });
</script>

<script>
    $(document).ready(function () {
        // Event listener for the print button
        $('#printBtn').on('click', function () {
            // Convert the chart to an image URL before showing SweetAlert
            const chartCanvas = document.getElementById('myPolarAreaChart');
            const chartImage = chartCanvas.toDataURL('image/png');

            // Show SweetAlert loading animation
            Swal.fire({
                title: 'Preparing Report...',
                html: 'Please wait while we generate your report.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    // Delay the print action slightly to ensure everything is set
                    setTimeout(() => {
                        printReport(chartImage);
                    }, 1000); // Adjust the delay as needed (1000ms = 1 second)
                }
            });
        });
    });

    function printReport(chartImage) {
        // Open a new window for printing
        const printWindow = window.open('', '_blank');
        const reportContent = $('#reportContainer').html();

        // Add basic styling for print layout
        const style = `
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                h5, h6 { text-align: center; }
                .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                .table, .table th, .table td { border: 1px solid #ddd; padding: 8px; }
                .table th { background-color: #f2f2f2; }
                .text-center { text-align: center; }
                .text-muted { color: #6c757d; }
                .mb-0 { margin-bottom: 0; }
                .chart-container { text-align: center; margin-bottom: 20px; }
            </style>
        `;

        // Replace the original chart canvas with an image in the report content
        const modifiedContent = $(reportContent).find('#myPolarAreaChart').replaceWith(`<img src="${chartImage}" class="chart-container"/>`).end().html();

        // Write the report content to the print window
        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Report</title>
                    ${style}
                </head>
                <body>
                    ${modifiedContent}
                </body>
            </html>
        `);

        // Close the document, then print and close the window
        printWindow.document.close();

        // Wait a bit before printing to ensure everything is loaded properly
        printWindow.onload = function () {
            printWindow.print();
            printWindow.close();
            // Close the SweetAlert loading animation after printing is complete
            Swal.close();
        };
    }
</script>

</body>

</html>