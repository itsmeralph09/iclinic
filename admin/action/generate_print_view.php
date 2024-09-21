<?php
require '../../vendor/autoload.php';
require '../../db/dbconn.php';

// Check if appointment_id is sent via POST
if (isset($_POST['appointment_id'])) {
    $appointmentId = $_POST['appointment_id'];

    // Fetch the appointment details from the database
    $query = "
        SELECT 
            ut.no AS student_number,
            CONCAT(st.first_name, ' ', 
               IF(st.middle_name IS NOT NULL AND st.middle_name != '', 
                  CONCAT(SUBSTRING(st.middle_name, 1, 1), '. '), 
                  ''), 
               st.last_name, 
               CASE 
                   WHEN st.suffix_name = 'NA' THEN ''
                   ELSE CONCAT(' ', st.suffix_name) 
               END) AS fullname,
            st.profile as student_photo,
            st.birthdate AS student_birthdate,
            st.age AS student_age,
            st.sex AS student_sex,
            st.personal_address AS student_address,
            st.course AS student_course,
            st.year_level AS student_year_level,
            st.contact_no AS student_contact,
            st.emergency_contact_name AS student_guardian,
            st.emergency_contact_no AS student_guardian_contact,
            avt.blood_pressure AS student_blood,
            avt.temperature AS student_temperature,
            avt.weight AS student_weight,
            avt.height AS student_height,
            avt.diagnosis AS student_diagnosis,
            apt.appointment_date AS student_appointment_date,
            apt.appointment_no AS student_appointment_no
        FROM appointment_tbl apt
        INNER JOIN user_tbl ut ON ut.user_id = apt.user_id
        INNER JOIN student_tbl st ON st.user_id = ut.user_id
        INNER JOIN appointment_vitals_tbl avt ON avt.appointment_id = apt.appointment_id
        WHERE apt.appointment_id = '$appointmentId'
    ";
    $result = mysqli_query($con, $query);
    $appointment = mysqli_fetch_assoc($result);

    // Determine the year level
    $yearLevel = '';
    switch ($appointment['student_year_level']) {
        case 1:
            $yearLevel = '1st Year';
            break;
        case 2:
            $yearLevel = '2nd Year';
            break;
        case 3:
            $yearLevel = '3rd Year';
            break;
        case 4:
            $yearLevel = '4th Year';
            break;
        default:
            $yearLevel = 'Unknown Year';
    }

    $formatted_birthdate = date('M d, Y', strtotime($appointment['student_birthdate']));
    $formatted_appointment_date = date('M d, Y', strtotime($appointment['student_appointment_date']));
    $courseYear = strtoupper($appointment['student_course'] . ' ' . $yearLevel);

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
                    width: 196px; /* Adjust width */
                    height: 196px; /* Adjust height */
                    margin-left: 20px; /* Space from text */
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 14px;
                    text-align: center;
                    overflow: hidden;
                }

                .student-photo {
                    max-width: 192px; /* Prevents overflow */
                    max-height: auto; /* Prevents overflow */
                    object-fit: cover; /* Maintains aspect ratio */
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
                        <p><strong>Student Number:</strong> <span class='underline'>{$appointment['student_number']}</span></p>
                        <p><strong>Name:</strong> <span class='underline'>{$appointment['fullname']}</span> &emsp; <strong>Civil Status:</strong> <span class='underline'>Single</span></p>
                        <p><strong>Date of Birth:</strong> <span class='underline'>{$formatted_birthdate}</span> &emsp; <strong>Age:</strong> <span class='underline'>{$appointment['student_age']}</span> &emsp; <strong>Sex:</strong> <span class='underline'>{$appointment['student_sex']}</span></p>
                        <p><strong>Home Address:</strong> <span class='underline'>{$appointment['student_address']}</span></p>
                        <p><strong>Year and Course:</strong> <span class='underline'>{$courseYear}</span></p>
                        <p><strong>Student Contact No.:</strong> <span class='underline'>{$appointment['student_contact']}</span></p>
                        <p><strong>Parent/Guardian:</strong> <span class='underline'>{$appointment['student_guardian']}</span></p>
                        <p><strong>Parent/Guardian Contact No.:</strong> <span class='underline'>{$appointment['student_guardian_contact']}</span></p>
                        <br>
                        <p><strong>Blood Pressure:</strong> <span class='underline'>{$appointment['student_blood']}</span></p>
                        <p><strong>Temperature:</strong> <span class='underline'>{$appointment['student_temperature']}</span></p>
                        <p><strong>Weight:</strong> <span class='underline'>{$appointment['student_weight']} kg</span></p>
                        <p><strong>Height:</strong> <span class='underline'>{$appointment['student_height']} cm</span></p>
                        <p><strong>Diagnosis:</strong> <span class='underline'>{$appointment['student_diagnosis']}</span></p>
                        <p><strong>Date:</strong> <span class='underline'>{$formatted_appointment_date}</span></p>
                        <p><strong>Appointment No.:</strong> <span class='underline'>{$appointment['student_appointment_no']}</span></p>
                        <br>
                        <p><strong>Signature of Student: _______________________________</strong></p>
                        <p><strong>Signature of University Physician: ______________________</strong></p>                   
                    </div>
                    <div class='picture-box'>
                        <img class='student-photo' src='../img/profiles/{$appointment['student_photo']}' alt='Student Photo'>
                    </div>
                </div>
            </div>
        </body>
        </html>
    ";
}
?>
