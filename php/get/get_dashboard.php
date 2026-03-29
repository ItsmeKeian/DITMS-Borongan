<?php
require "../dbconnect.php";

/* TOTALS */
$inspected = $conn->query("
SELECT COUNT(DISTINCT business_id)
FROM inspections
")->fetchColumn();

$total = $conn->query("
SELECT COUNT(*) FROM businesses
")->fetchColumn();

$pending = $total - $inspected;

$violations = $conn->query("
SELECT COUNT(*) 
FROM inspections 
WHERE inspection_status = 'violation'
")->fetchColumn();

/* MONTHLY */
$monthlyData = $conn->query("
SELECT DATE_FORMAT(created_at, '%b') as month, COUNT(*) as total
FROM inspections
GROUP BY month
")->fetchAll(PDO::FETCH_ASSOC);

$months = [];
$counts = [];

foreach($monthlyData as $m){
    $months[] = $m['month'];
    $counts[] = $m['total'];
}

/* BARANGAY */
$barangayData = $conn->query("
SELECT barangay, COUNT(*) as total
FROM businesses
GROUP BY barangay
")->fetchAll(PDO::FETCH_ASSOC);

$barangays = [];
$bCounts = [];

foreach($barangayData as $b){
    $barangays[] = $b['barangay'];
    $bCounts[] = $b['total'];
}

/* TOP BARANGAY */
$top = $conn->query("
SELECT barangay, COUNT(*) as total
FROM businesses
GROUP BY barangay
ORDER BY total DESC
LIMIT 1
")->fetch(PDO::FETCH_ASSOC);

echo json_encode([
    "inspected" => $inspected,
    "pending" => $pending,
    "violations" => $violations,
    "months" => $months,
    "monthly" => $counts,
    "barangays" => $barangays,
    "counts" => $bCounts,
    "top_barangay" => $top['barangay']
]);