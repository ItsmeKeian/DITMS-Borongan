<?php
session_start();
require "../dbconnect.php";

$username = $_SESSION['user'];

$current = $_POST['current_password'];
$new = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

if(empty($current) || empty($new) || empty($confirm)){
    echo "Please fill all fields";
    exit();
}

if($new !== $confirm){
    echo "Passwords do not match";
    exit();
}

// GET USER
$stmt = $conn->prepare("SELECT id, password FROM user WHERE username=?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){
    echo "User not found!";
    exit();
}

// 🔥 DETECT IF HASHED OR NOT
if(password_get_info($user['password'])['algo'] !== 0){
    // ✔ already hashed
    if(!password_verify($current, $user['password'])){
        echo "Current password is incorrect";
        exit();
    }
}else{
    // ❗ plain text (old system)
    if($current !== $user['password']){
        echo "Current password is incorrect";
        exit();
    }
}

// 🔐 HASH NEW PASSWORD
$hashed = password_hash($new, PASSWORD_DEFAULT);

// UPDATE
$stmt = $conn->prepare("UPDATE user SET password=? WHERE id=?");
$stmt->execute([$hashed, $user['id']]);

echo "Password updated successfully!";