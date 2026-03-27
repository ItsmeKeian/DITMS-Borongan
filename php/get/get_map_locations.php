<?php

require "../dbconnect.php";

$barangay = $_GET["barangay"] ?? "";
$status = $_GET["status"] ?? "";
$search = $_GET["search"] ?? "";

$sql = "

SELECT 
    b.id,
    b.business_name,
    b.owner_name,
    b.barangay,
    b.latitude,
    b.longitude,

    i.operation_status

FROM businesses b

LEFT JOIN inspections i 
    ON b.id = i.business_id

WHERE b.latitude IS NOT NULL
AND b.longitude IS NOT NULL

";

$params = [];

if ($barangay != "") {
    $sql .= " AND b.barangay = ?";
    $params[] = $barangay;
}

if ($search != "") {
    $sql .= " AND (
        b.business_name LIKE ?
        OR b.owner_name LIKE ?
    )";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);

echo json_encode(
    $stmt->fetchAll(PDO::FETCH_ASSOC)
);