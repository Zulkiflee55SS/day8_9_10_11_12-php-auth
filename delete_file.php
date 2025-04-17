<?php
include 'auth.php';
include 'db_connect.php';

$fileId = $_GET["id"];
$userId = $_SESSION["user_id"];

// ตรวจสอบว่าไฟล์เป็นของผู้ใช้ที่ล็อกอินอยู่หรือไม่
$stmt = $conn->prepare("SELECT file_path FROM files WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $fileId, $userId);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($filePath);
$stmt->fetch();

if ($stmt->num_rows > 0) {
    unlink($filePath); // ลบไฟล์จากเซิร์ฟเวอร์
    $conn->query("DELETE FROM files WHERE id = $fileId"); // ลบข้อมูลในฐานข้อมูล
    echo "ไฟล์ถูกลบเรียบร้อย!";
} else {
    echo "คุณไม่มีสิทธิ์ลบไฟล์นี้!";
}
?>
