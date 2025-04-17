<?php
session_start();
require_once 'db_connect.php'; // ให้แน่ใจว่าไฟล์นี้สร้างตัวแปร $pdo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสรหัสผ่าน

    try {
        // เช็คว่ามีผู้ใช้งานนี้แล้วหรือยัง
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            echo "ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว กรุณาใช้ชื่ออื่น";
        } else {
            // บันทึกข้อมูลผู้ใช้ใหม่
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $password]);

            echo "สมัครสมาชิกสำเร็จ! <a href='login.php'>เข้าสู่ระบบ</a>";
        }
    } catch (PDOException $e) {
        die("เกิดข้อผิดพลาดในการสมัครสมาชิก: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- แบบฟอร์มสมัครสมาชิก -->
<h2>สมัครสมาชิก</h2>
<form method="POST" action="">
    <label>ชื่อผู้ใช้: <input type="text" name="username" required></label><br><br>
    <label>รหัสผ่าน: <input type="password" name="password" required></label><br><br>
    <button type="submit">สมัคร</button>
</form>
</body>
</html>