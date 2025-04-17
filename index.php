<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบ Authentication</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>ระบบ Authentication</h1>

    <?php if (isset($_SESSION["user_id"])): ?>
        <p>คุณล็อกอินแล้วเป็น: <strong><?php echo $_SESSION["username"]; ?></strong></p>
        <a href="dashboard.php" class="btn">ไปที่ Dashboard</a>
        <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
    <?php else: ?>
        <a href="register.php" class="btn">สมัครสมาชิก</a>
        <a href="login.php" class="btn">เข้าสู่ระบบ</a>
        <a href="forgot_password.php">ลืมรหัสผ่าน?</a>
        
    <?php endif; ?>
</div>

</body>
</html>
