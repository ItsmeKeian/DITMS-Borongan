<?php

require "../dbconnect.php";

$barangay = $_GET["barangay"] ?? "";
$status = $_GET["status"] ?? "";
$search = $_GET["search"] ?? "";

$sql = "

SELECT
id,
business_name,
owner_name,
barangay,
operation_status,
latitude,
longitude

FROM inspections

WHERE latitude IS NOT NULL
AND longitude IS NOT NULL

";

$params = [];

if ($barangay != "") {
    $sql .= " AND barangay = ?";
    $params[] = $barangay;
}

if ($status != "") {
    $sql .= " AND operation_status = ?";
    $params[] = $status;
}

if ($search != "") {
    $sql .= " AND (
        business_name LIKE ?
        OR owner_name LIKE ?
    )";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);

echo json_encode(
    $stmt->fetchAll(PDO::FETCH_ASSOC)
);