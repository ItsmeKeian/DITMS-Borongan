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
SELECT COUNT(DISTINCT i.business_id)
FROM findings f
JOIN inspections i ON f.inspection_id = i.id
WHERE f.notice_violation = 1
")->fetchColumn();

/* MONTHLY */
$months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
$counts = array_fill(0, 12, 0);

$monthlyData = $conn->query("
SELECT MONTH(date_of_inspection) as m, COUNT(*) as total
FROM inspections
GROUP BY m
")->fetchAll(PDO::FETCH_ASSOC);

foreach($monthlyData as $row){
    $index = $row['m'] - 1;
    $counts[$index] = $row['total'];
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
    "total" => $total,
    "inspected" => $inspected,
    "pending" => $pending,
    "violations" => $violations,
    "months" => $months,
    "monthly" => $counts,
    "barangays" => $barangays,
    "counts" => $bCounts,
    "top_barangay" => $top['barangay']
]);