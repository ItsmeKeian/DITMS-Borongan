<?php

require "../dbconnect.php";

$id = $_GET["id"];

$stmt = $conn->prepare("
SELECT 
inspections.*,
registration_status.*,
findings.*

FROM inspections

LEFT JOIN registration_status
ON inspections.id = registration_status.inspection_id

LEFT JOIN findings
ON inspections.id = findings.inspection_id

WHERE inspections.id = ?
");

$stmt->execute([$id]);

echo json_encode(
    $stmt->fetch(PDO::FETCH_ASSOC)
);