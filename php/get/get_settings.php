<?php
require "../dbconnect.php";

$stmt = $conn->query("SELECT * FROM system_settings WHERE id=1");
$data = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($data);