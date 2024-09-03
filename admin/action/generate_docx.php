<?php

require '../../vendor/autoload.php';
require '../../db/dbconn.php';

use PhpOffice\PhpWord\TemplateProcessor;

// Check if appointment_id is sent via POST
if (isset($_POST['appointment_id'])) {
    $appointmentId = $_POST['appointment_id'];

    // Fetch the appointment details from the database
    $query = "
        SELECT 
            ut.no AS student_number,
            CONCAT(st.first_name, ' ', st.middle_name, ' ', st.last_name, ' ', st.suffix_name) AS fullname,
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

    // Determine the year level based on the value in the database
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

    // Combine course and year level
    $courseYear = $appointment['student_course'] . ' ' . $yearLevel;

    // Load the Word template
    $templateProcessor = new TemplateProcessor('../../form/medcert.docx');

    // Replace placeholders with actual values from the database
    $templateProcessor->setValue('{{student_number}}', $appointment['student_number']);
    $templateProcessor->setValue('{{student_name}}', $appointment['fullname']);
    $templateProcessor->setValue('{{student_birthdate}}', $formatted_birthdate);
    $templateProcessor->setValue('{{student_age}}', $appointment['student_age']);
    $templateProcessor->setValue('{{student_sex}}', $appointment['student_sex']);
    $templateProcessor->setValue('{{student_address}}', $appointment['student_address']);
    $templateProcessor->setValue('{{student_course_year}}', strtoupper($courseYear));
    $templateProcessor->setValue('{{student_contact}}', $appointment['student_contact']);
    $templateProcessor->setValue('{{student_guardian}}', $appointment['student_guardian']);
    $templateProcessor->setValue('{{student_guardian_contact}}', $appointment['student_guardian_contact']);
    $templateProcessor->setValue('{{student_blood}}', $appointment['student_blood']);
    $templateProcessor->setValue('{{student_temperature}}', $appointment['student_temperature']);
    $templateProcessor->setValue('{{student_weight}}', $appointment['student_weight'] . ' kg');
    $templateProcessor->setValue('{{student_height}}', $appointment['student_height'] . ' cm');
    $templateProcessor->setValue('{{student_diagnosis}}', $appointment['student_diagnosis']);
    $templateProcessor->setValue('{{student_appointment_date}}', $formatted_appointment_date);
    $templateProcessor->setValue('{{student_appointment_no}}', $appointment['student_appointment_no']);

    // Set headers for download
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="Appointment_' . $appointmentId . '.docx"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    // Save the document to PHP's output stream
    $templateProcessor->saveAs('php://output');
    exit;
} else {
    // Handle the error case
    http_response_code(400);
    echo 'Invalid request. Appointment ID not provided.';
}
?>
