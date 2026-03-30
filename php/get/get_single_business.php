<?php
require "../dbconnect.php";

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM businesses WHERE id = ?");
$stmt->execute([$id]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($row);