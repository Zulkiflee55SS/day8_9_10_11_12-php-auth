<?php
include 'auth.php';
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileId = $_POST["file_id"];
    $newName = htmlspecialchars($_POST["new_name"]);
    $userId = $_SESSION["user_id"];

    // ดึงข้อมูลไฟล์เดิม
    $stmt = $conn->prepare("SELECT file_name, file_path FROM files WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $fileId, $userId);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($oldFileName, $oldPath);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        $fileExt = pathinfo($oldFileName, PATHINFO_EXTENSION); // นามสกุลไฟล์เดิม
        $safeNewName = preg_replace('/[^A-Za-z0-9ก-๙_\-]/u', '_', $newName); // ลบอักขระที่ไม่ปลอดภัย
        $newFileName = $safeNewName . "." . $fileExt; // ตั้งชื่อใหม่โดยคงนามสกุลเดิม
        $newPath = dirname($oldPath) . "/" . $newFileName;

        // ตรวจสอบว่าไฟล์ใหม่ซ้ำกับไฟล์เดิมหรือไม่
        if ($newPath !== $oldPath && !file_exists($newPath)) {
            if (rename($oldPath, $newPath)) {
                // อัปเดตฐานข้อมูล
                $stmt = $conn->prepare("UPDATE files SET file_name = ?, file_path = ? WHERE id = ?");
                $stmt->bind_param("ssi", $newFileName, $newPath, $fileId);
                if ($stmt->execute()) {
                    echo "เปลี่ยนชื่อไฟล์สำเร็จ!";
                } else {
                    echo "เกิดข้อผิดพลาดในการอัปเดตฐานข้อมูล!";
                }
            } else {
                echo "ไม่สามารถเปลี่ยนชื่อไฟล์ได้!";
            }
        } else {
            echo "ชื่อไฟล์ซ้ำหรือไม่มีการเปลี่ยนแปลง!";
        }
    } else {
        echo "คุณไม่มีสิทธิ์เปลี่ยนชื่อไฟล์นี้!";
    }
}
?>
