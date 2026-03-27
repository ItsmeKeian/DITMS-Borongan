<?php

require "../dbconnect.php";

$stmt = $conn->query("
    SELECT * FROM businesses 
    ORDER BY id DESC
");

echo json_encode(
    $stmt->fetchAll(PDO::FETCH_ASSOC)
);