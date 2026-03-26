<?php

require "../dbconnect.php";

$stmt = $conn->prepare("
SELECT inspections.*, findings.no_mayor_permit, findings.expired_permit
FROM inspections
LEFT JOIN findings
ON inspections.id = findings.inspection_id
ORDER BY inspections.id DESC
");

$stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);