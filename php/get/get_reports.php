<?php
require "../dbconnect.php";

/* GET FILTERS */
$barangay = $_GET['barangay'] ?? '';
$status   = $_GET['status'] ?? '';
$from     = $_GET['from'] ?? '';
$to       = $_GET['to'] ?? '';
$search   = $_GET['search'] ?? '';

/* ================= BASE QUERY ================= */
$query = "
SELECT 
    b.id,
    b.business_name,
    b.owner_name,
    b.barangay,
    i.date_of_inspection,
    f.notice_violation,
    i.id as inspection_id
FROM businesses b

/* 👉 GET ONLY LATEST INSPECTION */
LEFT JOIN inspections i 
ON i.id = (
    SELECT id FROM inspections 
    WHERE business_id = b.id
    ORDER BY date_of_inspection DESC
    LIMIT 1
)

/* 👉 GET FINDINGS PER INSPECTION */
LEFT JOIN (
    SELECT 
        inspection_id,
        MAX(notice_violation) as notice_violation
    FROM findings
    GROUP BY inspection_id
) f ON i.id = f.inspection_id

WHERE 1=1
";

/* ================= FILTERS ================= */

// Barangay
if($barangay != ''){
    $query .= " AND b.barangay = :barangay";
}

// Date range (apply sa latest inspection only)
if($from != ''){
    $query .= " AND (i.date_of_inspection >= :from OR i.date_of_inspection IS NULL)";
}

if($to != ''){
    $query .= " AND (i.date_of_inspection <= :to OR i.date_of_inspection IS NULL)";
}

// Search
if($search != ''){
    $query .= " AND (b.business_name LIKE :search OR b.owner_name LIKE :search)";
}

/* ================= EXECUTE ================= */
$stmt = $conn->prepare($query);

if($barangay != ''){
    $stmt->bindValue(':barangay', $barangay);
}
if($from != ''){
    $stmt->bindValue(':from', $from);
}
if($to != ''){
    $stmt->bindValue(':to', $to);
}
if($search != ''){
    $stmt->bindValue(':search', "%$search%");
}

$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ================= PROCESS STATUS ================= */
foreach($rows as &$r){

    if(!$r['inspection_id']){
        $r['status'] = "Pending";
    } else {
        if($r['notice_violation'] == 1){
            $r['status'] = "Violation";
        } else {
            $r['status'] = "Inspected";
        }
    }
}
unset($r);

/* ================= STATUS FILTER ================= */
if($status != ''){
    $rows = array_filter($rows, function($r) use ($status){
        return strtolower($r['status']) == strtolower($status);
    });
}

/* ================= CHART DATA ================= */

/* MONTHLY (based on latest inspections only) */
$months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
$counts = array_fill(0, 12, 0);

foreach($rows as $r){
    if($r['date_of_inspection']){
        $m = date("n", strtotime($r['date_of_inspection']));
        $counts[$m - 1]++;
    }
}

/* ================= STATUS COUNTS ================= */

$inspected = 0;
$pending = 0;
$violations = 0;

foreach($rows as $r){
    if($r['status'] == "Inspected") $inspected++;
    if($r['status'] == "Pending") $pending++;
    if($r['status'] == "Violation") $violations++;
}

/* ================= RETURN ================= */
echo json_encode([
    "rows" => array_values($rows),
    "months" => $months,
    "monthly" => $counts,
    "inspected" => $inspected,
    "pending" => $pending,
    "violations" => $violations
]);