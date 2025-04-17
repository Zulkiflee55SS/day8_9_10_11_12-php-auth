<?php
include 'auth.php';
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf', 'docx', 'mp4'];
    $fileName = $_FILES["file"]["name"];
    $fileTmp = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $category = isset($_POST["category"]) ? $_POST["category"] : 'other';

    if (!in_array($fileExt, $allowedTypes)) {
        die("อัปโหลดได้เฉพาะไฟล์ JPG, PNG, PDF, DOCX, MP4 เท่านั้น!");
    }
    if ($fileSize > 5 * 1024 * 1024) {
        die("ไฟล์ต้องมีขนาดไม่เกิน 5MB!");
    }

    $newFileName = uniqid() . "." . $fileExt;
    $filePath = "uploads/" . $newFileName;
    echo "<div class='gallery'>";
    
    if (move_uploaded_file($fileTmp, $filePath)) {
        $stmt = $conn->prepare("INSERT INTO files (user_id, file_name, file_path, file_size, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $_SESSION["user_id"], $fileName, $filePath, $fileSize, $category);
        $stmt->execute();

        echo "<h2>อัปโหลดสำเร็จ</h2><br>";

        if (in_array($fileExt, ['jpg', 'jpeg', 'png'])) {
            echo "<div class='image-container'>";
            echo "<img src='" . htmlspecialchars($filePath) . "' alt='Uploaded Image'>";
            echo "</div>";
        } elseif ($fileExt == 'mp4') {
            echo "<video controls width='320'><source src='" . htmlspecialchars($filePath) . "' type='video/mp4'>วิดีโอไม่รองรับ</video>";
        } else {
            echo "<a href='" . htmlspecialchars($filePath) . "' target='_blank'>เปิดไฟล์</a>";
        }
    } else {
        echo "เกิดข้อผิดพลาด!";
    }
    echo "</div>";
}
?>
<style>
body {
    font-family: Arial, sans-serif;
    text-align: center;
    background-color: #f4f4f4;
}
h2 {
    margin-bottom: 20px;
}
div.gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    padding: 20px;
}
div.image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 10px;
    background-color: white;
    max-width: 100%;
    max-height: 100%;
}

div.image-container img {
    max-width: 100%;
    max-height: 300px;
    object-fit: contain;
    border-radius: 5px;
}


</style>