<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // ตรวจสอบว่า Token ถูกต้องและไม่หมดอายุ
    $stmt = $conn->prepare("SELECT email FROM password_reset_tokens WHERE token = ? AND expires_at > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // อัปเดตรหัสผ่านใหม่
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_password, $email);
        $stmt->execute();

        // ลบ Token หลังใช้งาน
        $stmt = $conn->prepare("DELETE FROM password_reset_tokens WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();

        echo "✅ เปลี่ยนรหัสผ่านสำเร็จ! <a href='login.php'>เข้าสู่ระบบ</a>";
        exit();
    } else {
        echo "❌ Token ไม่ถูกต้องหรือหมดอายุ!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนรหัสผ่าน</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }
        .reset-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            width: 350px;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="reset-form">
    <h2>เปลี่ยนรหัสผ่าน</h2>
    <form method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <input type="password" name="password" placeholder="รหัสผ่านใหม่" required>
        <button type="submit">เปลี่ยนรหัสผ่าน</button>
    </form>
</div>

</body>
</html>
