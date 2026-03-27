<?php

require "../dbconnect.php";

$stmt = $conn->query("
    SELECT 
        b.*,
        COUNT(i.id) as inspection_count
    FROM businesses b
    LEFT JOIN inspections i 
        ON b.id = i.business_id
    GROUP BY b.id
    ORDER BY b.id DESC
");

echo json_encode(
    $stmt->fetchAll(PDO::FETCH_ASSOC)
);