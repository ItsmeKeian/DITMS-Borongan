<?php

require "../dbconnect.php";

$search = $_GET['search'] ?? '';

$sql = "
SELECT 
    b.id,
    b.business_name,
    b.owner_name,
    b.barangay,
    b.contact_number,
    b.latitude,
    b.longitude,
    b.created_at,
    COUNT(i.id) as inspection_count
FROM businesses b
LEFT JOIN inspections i ON i.business_id = b.id
WHERE b.business_name LIKE :search
   OR b.owner_name LIKE :search
GROUP BY 
    b.id,
    b.business_name,
    b.owner_name,
    b.barangay,
    b.contact_number,
    b.latitude,
    b.longitude,
    b.created_at
ORDER BY b.created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':search' => "%$search%"
]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));