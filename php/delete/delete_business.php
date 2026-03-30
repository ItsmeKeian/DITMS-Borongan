<?php
require "../dbconnect.php";

$id = $_POST['id'];

$sql = "DELETE FROM businesses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id]);

echo "Deleted successfully!";