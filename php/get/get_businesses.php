<?php

require "../dbconnect.php";

$search = $_GET['search'] ?? '';

$sql = "
SELECT b.*, 
       COUNT(i.id) as inspection_count
FROM businesses b
LEFT JOIN inspections i ON i.business_id = b.id
WHERE b.business_name LIKE :search
   OR b.owner_name LIKE :search
GROUP BY b.id
ORDER BY b.created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':search' => "%$search%"
]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));