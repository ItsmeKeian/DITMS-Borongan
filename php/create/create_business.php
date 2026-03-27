<?php

require "../dbconnect.php";

// ================= VALIDATE =================

$business_name = $_POST['business_name'] ?? '';
$owner_name = $_POST['owner_name'] ?? '';
$barangay = $_POST['barangay'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$latitude = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;

// basic validation
if(empty($business_name)){
    die("Business name is required.");
}

// ================= INSERT =================

$stmt = $conn->prepare("
    INSERT INTO businesses (
        business_name,
        owner_name,
        barangay,
        contact_number,
        latitude,
        longitude
    )
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $business_name,
    $owner_name,
    $barangay,
    $contact_number,
    $latitude,
    $longitude
]);

// ================= REDIRECT =================

header("Location: ../../business.php");
exit();