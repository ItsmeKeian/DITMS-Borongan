<?php
require "../dbconnect.php";

/* GET FILTERS */
$barangay = $_GET['barangay'] ?? '';
$status   = $_GET['status'] ?? '';
$from     = $_GET['from'] ?? '';
$to       = $_GET['to'] ?? '';
$search   = $_GET['search'] ?? '';

/* BASE QUERY (LATEST INSPECTION LOGIC) */
$query = "
SELECT 
    b.business_name,
    b.owner_name,
    b.barangay,
    i.date_of_inspection,
    f.notice_violation,
    i.id as inspection_id
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

WHERE 1=1
";

/* FILTERS */
if($barangay != ''){
    $query .= " AND b.barangay = :barangay";
}

if($from != ''){
    $query .= " AND (i.date_of_inspection >= :from OR i.date_of_inspection IS NULL)";
}

if($to != ''){
    $query .= " AND (i.date_of_inspection <= :to OR i.date_of_inspection IS NULL)";
}

if($search != ''){
    $query .= " AND (b.business_name LIKE :search OR b.owner_name LIKE :search)";
}

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

/* PROCESS STATUS */
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

/* STATUS FILTER */
if($status != ''){
    $rows = array_filter($rows, function($r) use ($status){
        return strtolower($r['status']) == strtolower($status);
    });
}

/* EXPORT AS CSV (Excel readable) */
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="inspection_report.csv"');

$output = fopen("php://output", "w");

/* HEADERS */
fputcsv($output, ["Business", "Owner", "Barangay", "Date", "Status"]);

/* DATA */
foreach($rows as $r){
    fputcsv($output, [
        $r['business_name'],
        $r['owner_name'],
        $r['barangay'],
        $r['date_of_inspection'] ?? '-',
        $r['status']
    ]);
}

fclose($output);
exit;