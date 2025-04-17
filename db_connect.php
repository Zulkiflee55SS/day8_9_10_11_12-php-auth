<?php
$host = 'localhost';          // ✅ ชื่อ host ของ XAMPP
$dbname = 'user_auth';        // ✅ ชื่อฐานข้อมูลของคุณ (ตรวจใน phpMyAdmin)
$username = 'root';           // ✅ ค่าเริ่มต้นใน XAMPP
$password = '';               // ✅ ไม่มีรหัสผ่าน (ค่าว่าง)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
