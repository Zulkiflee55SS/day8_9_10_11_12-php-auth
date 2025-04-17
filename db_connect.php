<?php
$host = 'localhost';
$dbname = 'user_auth';
$username = 'zulf';
$password = '123456';             // ✅ ไม่มีรหัสผ่าน (ค่าว่าง)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
