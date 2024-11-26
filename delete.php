<?php
include('db.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM registrations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Deregistered class successfully deleted.";
        header("Location: admin.php"); 
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
