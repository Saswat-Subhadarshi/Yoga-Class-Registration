<?php
session_start(); 

include('db.php'); 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$classType = $_POST['classType'];
$timing = $_POST['timing'];
$comments = $_POST['comments'];


$stmt = $conn->prepare("INSERT INTO registrations (name, email, phone, class_type, timing, comments) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $phone, $classType, $timing, $comments);


if ($stmt->execute()) {
    echo "Thank you for registering for our yoga classes!";
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
