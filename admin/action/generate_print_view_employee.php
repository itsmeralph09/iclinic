<?php
require '../../vendor/autoload.php';
require '../../db/dbconn.php';

// Check if appointment_id is sent via POST
if (isset($_POST['appointment_id'])) {
    $appointmentId = $_POST['appointment_id'];

    // Fetch the appointment details from the database
    $query = "
        SELECT 
            ut.no AS employee_number,
            CONCAT(st.first_name, ' ', 
               IF(st.middle_name IS NOT NULL AND st.middle_name != '', 
                  CONCAT(SUBSTRING(st.middle_name, 1, 1), '. '), 
                  ''), 
               st.last_name, 
               CASE 
                   WHEN st.suffix_name = 'NA' THEN ''
                   ELSE CONCAT(' ', st.suffix_name) 
               END) AS fullname,
            st.profile as employee_photo,
            st.birthdate AS employee_birthdate,
            st.age AS employee_age,
            st.sex AS employee_sex,
            st.personal_address AS employee_address,
            st.occupation AS employee_occupation,
            st.contact_no AS employee_contact,
            st.emergency_contact_name AS employee_guardian,
            st.emergency_contact_no AS employee_guardian_contact,
            avt.blood_pressure AS employee_blood,
            avt.temperature AS employee_temperature,
            avt.weight AS employee_weight,
            avt.height AS employee_height,
            avt.diagnosis AS employee_diagnosis,
            apt.appointment_date AS employee_appointment_date,
            apt.appointment_no AS employee_appointment_no
        FROM appointment_tbl apt
        INNER JOIN user_tbl ut ON ut.user_id = apt.user_id
        INNER JOIN employee_tbl st ON st.user_id = ut.user_id
        INNER JOIN appointment_vitals_tbl avt ON avt.appointment_id = apt.appointment_id
        WHERE apt.appointment_id = '$appointmentId'
    ";
    $result = mysqli_query($con, $query);
    $appointment = mysqli_fetch_assoc($result);

    $formatted_birthdate = date('M d, Y', strtotime($appointment['employee_birthdate']));
    $formatted_appointment_date = date('M d, Y', strtotime($appointment['employee_appointment_date']));

    // Generate the printable content as HTML
    echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Patient Chart Form - Print</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }
                h1, h2 {
                    text-align: center;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                table, th, td {
                    border: 1px solid black;
                    padding: 10px;
                }
                th {
                    background-color: #f2f2f2;
                }
                .form-row {
                    display: flex; /* Use flexbox for layout */
                    justify-content: space-between; /* Space between elements */
                    align-items: flex-start; /* Align items at the start */
                }
                .form-info {
                    flex: 1; /* Allow this section to grow */
                }
                .underline {
                    text-decoration: underline;
                }
                .picture-box {
                    border: 1px solid black;
                    width: 195px; /* Adjust width */
                    height: 195px; /* Adjust height */
                    margin-left: 20px; /* Space from text */
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 14px;
                    text-align: center;
                    overflow: hidden;
                }
                .employee-photo{
                    width: auto;
                    height: 192px;
                }
            </style>
        </head>

        <body>
            <div class='container'>
                <table class='tg'>
                    <thead>
                        <tr>
                            <td class='tg-input' colspan='2' rowspan='6'><img src='../img/prmsu_cande.png' alt='' width='100px'></td>
                            <td class='tg-input' colspan='6' rowspan='6' style='font-size: 20px;'><strong>PATIENT'S CHART</strong></td>
                            <td class='tg-input' colspan='2' rowspan='2'>Form No.</td>
                            <td class='tg-input' colspan='4' rowspan='2'><strong>PRMSU-ASA-MEDSF04</strong></td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td class='tg-input' colspan='2' rowspan='2'>Effectivity Date</td>
                            <td class='tg-input' colspan='4' rowspan='2'>January 29, 2019</td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td class='tg-input' colspan='2' rowspan='2'>Revision No.</td>
                            <td class='tg-input' rowspan='2'>03</td>
                            <td class='tg-input' colspan='3' rowspan='2'>Page 1 of 1</td>
                        </tr>
                        <tr></tr>
                    </thead>
                </table>

                <br>

                <div class='form-row'>
                    <div class='form-info'>
                        <p><strong>Employee Number:</strong> <span class='underline'>{$appointment['employee_number']}</span></p>
                        <p><strong>Name:</strong> <span class='underline'>{$appointment['fullname']}</span> &emsp; <strong>Civil Status:</strong> <span class='underline'>Single</span></p>
                        <p><strong>Date of Birth:</strong> <span class='underline'>{$formatted_birthdate}</span> &emsp; <strong>Age:</strong> <span class='underline'>{$appointment['employee_age']}</span> &emsp; <strong>Sex:</strong> <span class='underline'>{$appointment['employee_sex']}</span></p>
                        <p><strong>Home Address:</strong> <span class='underline'>{$appointment['employee_address']}</span></p>
                        <p><strong>Occupation:</strong> <span class='underline'>{$appointment['employee_occupation']}</span></p>
                        <p><strong>Employee Contact No.:</strong> <span class='underline'>{$appointment['employee_contact']}</span></p>
                        <p><strong>Parent/Guardian:</strong> <span class='underline'>{$appointment['employee_guardian']}</span></p>
                        <p><strong>Parent/Guardian Contact No.:</strong> <span class='underline'>{$appointment['employee_guardian_contact']}</span></p>
                        <br>
                        <p><strong>Blood Pressure:</strong> <span class='underline'>{$appointment['employee_blood']}</span></p>
                        <p><strong>Temperature:</strong> <span class='underline'>{$appointment['employee_temperature']}</span></p>
                        <p><strong>Weight:</strong> <span class='underline'>{$appointment['employee_weight']} kg</span></p>
                        <p><strong>Height:</strong> <span class='underline'>{$appointment['employee_height']} cm</span></p>
                        <p><strong>Diagnosis:</strong> <span class='underline'>{$appointment['employee_diagnosis']}</span></p>
                        <p><strong>Date:</strong> <span class='underline'>{$formatted_appointment_date}</span></p>
                        <p><strong>Appointment No.:</strong> <span class='underline'>{$appointment['employee_appointment_no']}</span></p>
                        <br>
                        <p><strong>Signature of Employee: _______________________________</strong></p>
                        <p><strong>Signature of University Physician: ______________________</strong></p>                    
                    </div>
                    <div class='picture-box'>
                        <img class='employee-photo' src='../img/profiles/{$appointment['employee_photo']}' alt='employee Photo'>
                    </div>
                </div>
            </div>
        </body>
        </html>
    ";
}
?>
