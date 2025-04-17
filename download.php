<?php
include 'auth.php';
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // ดึงข้อมูลไฟล์จากฐานข้อมูล
    $result = $conn->query("SELECT file_name, file_path FROM files WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        $file_path = $row['file_path'];

        // อัปเดตจำนวนการดาวน์โหลด
        $conn->query("UPDATE files SET download_count = download_count + 1 WHERE id = $id");

        // ส่งไฟล์ให้ผู้ใช้ดาวน์โหลด
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }
}
?>
