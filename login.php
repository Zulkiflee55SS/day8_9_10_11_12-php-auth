<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $user["role"];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<p class='error-msg'>ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!</p>";
    }
}
?>



<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>เข้าสู่ระบบ</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
        <input type="password" name="password" placeholder="รหัสผ่าน" required>
        <button type="submit" class="btn">เข้าสู่ระบบ</button>
    </form>
    <p>ยังไม่มีบัญชี? <a href="register.php">สมัครสมาชิก</a></p>
    <p><a href="forgot_password.php">ลืมรหัสผ่าน?</a></p>


</div>

</body>
</html>
