<?php
include 'connection.php';

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "UPDATE admins SET password = ? WHERE username = ?"
);

$stmt->bind_param("ss", $password, $username);

if ($stmt->execute()) {
    echo "Admin password updated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>