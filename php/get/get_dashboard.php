<?php
require "../dbconnect.php";

/* ================= GET LATEST INSPECTION PER BUSINESS ================= */
$query = "
SELECT 
    b.id,
    i.id as inspection_id,
    f.notice_violation
FROM businesses b

LEFT JOIN inspections i 
ON i.id = (
    SELECT id FROM inspections 
    WHERE business_id = b.id
    ORDER BY date_of_inspection DESC
    LIMIT 1
)

LEFT JOIN (
    SELECT 
        inspection_id,
        MAX(notice_violation) as notice_violation
    FROM findings
    GROUP BY inspection_id
) f ON i.id = f.inspection_id
";

$data = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);

/* ================= COUNTS ================= */

$total = count($data);
$inspected = 0;
$pending = 0;
$violations = 0;

foreach($data as $r){

    if(!$r['inspection_id']){
        $pending++;
    } else {
        if($r['notice_violation'] == 1){
            $violations++;
        } else {
            $inspected++;
        }
    }
}

/* ================= MONTHLY (REAL INSPECTIONS COUNT) ================= */

$months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
$counts = array_fill(0, 12, 0);

$monthlyData = $conn->query("
SELECT MONTH(date_of_inspection) as m, COUNT(*) as total
FROM inspections
GROUP BY m
")->fetchAll(PDO::FETCH_ASSOC);

foreach($monthlyData as $row){
    $counts[$row['m'] - 1] = $row['total'];
}

/* ================= BARANGAY ================= */

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

/* ================= TOP BARANGAY ================= */

$top = $conn->query("
SELECT barangay, COUNT(*) as total
FROM businesses
GROUP BY barangay
ORDER BY total DESC
LIMIT 1
")->fetch(PDO::FETCH_ASSOC);

/* ================= RETURN ================= */

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