<?php
require "../dbconnect.php";

$municipality = $_POST['municipality'];
$province = $_POST['province'];

$logoName = "";

// handle image upload
if(isset($_FILES['logo'])){
    $file = $_FILES['logo'];

    if($file['name'] != ""){
        $logoName = time() . "_" . $file['name'];
        move_uploaded_file($file['tmp_name'], "../../uploads/" . $logoName);
    }
}

// update query
if($logoName != ""){
    $sql = "UPDATE system_settings 
            SET municipality=?, province=?, logo=? 
            WHERE id=1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$municipality, $province, $logoName]);
} else {
    $sql = "UPDATE system_settings 
            SET municipality=?, province=? 
            WHERE id=1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$municipality, $province]);
}

echo "Saved successfully!";