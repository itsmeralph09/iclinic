<?php
// Include your database connection file
require '../../db/dbconn.php';

$year = $_GET['year'];
$month = $_GET['month'];
$diagnosis = $_GET['diagnosis'];

// Start building the query
$query = "
    SELECT av.diagnosis, COUNT(*) AS patient_count
    FROM appointment_tbl a
    JOIN appointment_vitals_tbl av ON a.appointment_id = av.appointment_id
    WHERE a.deleted = 0 AND av.deleted = 0
";

// Add conditions based on selected filters
if ($year) {
    $query .= " AND YEAR(a.appointment_date) = ?";
}
if ($month) {
    $query .= " AND MONTH(a.appointment_date) = ?";
}
if ($diagnosis) {
    $query .= " AND av.diagnosis = ?";
}

// Group by diagnosis
$query .= " GROUP BY av.diagnosis";

$stmt = $con->prepare($query);

// Bind parameters dynamically
$params = [];
$types = '';
if ($year) {
    $params[] = $year;
    $types .= 'i'; // Integer
}
if ($month) {
    $params[] = $month;
    $types .= 'i'; // Integer
}
if ($diagnosis) {
    $params[] = $diagnosis;
    $types .= 's'; // String
}

// Bind the parameters if any
if ($types) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

$data = [
    'labels' => [],
    'counts' => []
];

while ($row = $result->fetch_assoc()) {
    $data['labels'][] = $row['diagnosis'];
    $data['counts'][] = (int)$row['patient_count'];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
