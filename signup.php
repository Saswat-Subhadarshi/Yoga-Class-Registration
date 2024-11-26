<?php
include("db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Signup successful. Please log in.";
        header('Location: login.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
