<?php

require "../dbconnect.php";

$search = $_GET["search"] ?? "";

if ($search != "") {

    $sql = "

    SELECT
    inspections.*,
    findings.no_mayor_permit,
    findings.expired_permit

    FROM inspections

    LEFT JOIN findings
    ON inspections.id = findings.inspection_id

    WHERE
    inspections.business_name LIKE ?
    OR inspections.owner_name LIKE ?
    OR inspections.barangay LIKE ?

    ORDER BY inspections.id DESC

    ";

    $stmt = $conn->prepare($sql);

    $s = "%$search%";

    $stmt->execute([$s, $s, $s]);

} else {

    $sql = "

    SELECT
    inspections.*,
    findings.no_mayor_permit,
    findings.expired_permit

    FROM inspections

    LEFT JOIN findings
    ON inspections.id = findings.inspection_id

    ORDER BY inspections.id DESC

    ";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

}

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);