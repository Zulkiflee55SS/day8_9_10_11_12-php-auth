<?php
include 'auth.php';
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = htmlspecialchars($_POST["username"]);
    $newEmail = htmlspecialchars($_POST["email"]);
    $userId = $_SESSION["user_id"];

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $newUsername, $newEmail, $userId);
    
    if ($stmt->execute()) {
        echo "ข้อมูลของคุณถูกอัปเดตเรียบร้อย!";
    } else {
        echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล!";
    }
}
?>
