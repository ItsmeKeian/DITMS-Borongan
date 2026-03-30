<?php
require "../dbconnect.php";

$id = $_POST['id'];
$business_name = $_POST['business_name'];
$owner_name = $_POST['owner_name'];
$barangay = $_POST['barangay'];
$contact = $_POST['contact_number'];

$sql = "UPDATE businesses 
        SET business_name=?, owner_name=?, barangay=?, contact_number=?
        WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->execute([$business_name, $owner_name, $barangay, $contact, $id]);

echo "Updated successfully!";