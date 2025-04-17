<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("รูปแบบอีเมลไม่ถูกต้อง!");
    }

    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM password_reset_tokens WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $token = bin2hex(random_bytes(32));
        $expires_at = date("Y-m-d H:i:s", strtotime("+15 minutes"));

        $stmt = $conn->prepare("INSERT INTO password_reset_tokens (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expires_at);
        $stmt->execute();

        // ✅ เพิ่ม div เพื่อความสวยงาม
        echo '<div class= "body">';
        echo '<div class="reset-box">';
        echo "✅ อีเมลถูกต้องคลิกเพื่อเปลี่ยนรหัสผ่าน ";
        echo "<a class='reset-link' href='reset_password.php?token=$token'>เปลี่ยนรหัสผ่าน</a>";
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class= "body">';
        echo '<div class="reset-box">❌ ไม่มีบัญชีที่ใช้อีเมลนี้!</div>';
        echo '</div>';
    }
    
    $stmt->close();
    $conn->close();
}
?>

<style>
    .body {
        font-family: Arial, sans-serif;
        background-color:rgb(255, 255, 255);
        text-align: center;
        margin: 150x;
    }
    .reset-box {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: inline-block;
        width: 350px;
        text-align: center;
        margin-top: 20px;
    }
    .reset-link {
        display: inline-block;
        width: 90%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        text-decoration: none;
        background-color: #007bff;
        color: white;
    }
    .reset-link:hover {
        background-color: #0056b3;
    }
</style>
