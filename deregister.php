<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}
$userId=$_SESSION['user_id'];

$sql = "SELECT email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId); 
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $userEmail = $row['email'];
    $updateSql = "UPDATE registrations SET deregistered = 1 WHERE email = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("s", $userEmail); 
    if ($updateStmt->execute()) {
        echo "You have been successfully deregistered.";
    } else {
        echo "Error: " . $updateStmt->error;
    }
} else {
    echo "Error: User not found.";
}

$stmt->close();
$conn->close();
?>
