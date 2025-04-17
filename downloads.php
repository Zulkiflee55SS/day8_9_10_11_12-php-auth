<?php
include 'auth.php';
include 'db_connect.php'; // ให้แน่ใจว่าไฟล์นี้สร้างตัวแปร $pdo

echo "<h2>รายการไฟล์ที่ดาวน์โหลดได้</h2>";
echo "<div class='gallery'>";

// ✅ ใช้ PDO แทน
$stmt = $pdo->query("SELECT id, file_name, file_path, file_size, category, download_count, user_id FROM files");

while ($row = $stmt->fetch()) {
    $file_ext = strtolower(pathinfo($row['file_name'], PATHINFO_EXTENSION));
    $fileSizeMB = round($row['file_size'] / 1024 / 1024, 2);

    echo "<div class='image-container'>";
    echo "<p><strong>หมวดหมู่ " . htmlspecialchars($row['category']) . "</strong></p>";

    if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "<p>รูปภาพ</p>";
        echo "<p>ชื่อไฟล์ " . htmlspecialchars($row['file_name']) . "</p>";
        echo "<img src='" . htmlspecialchars($row['file_path']) . "' alt='" . htmlspecialchars($row['file_name']) . "'>";

    } elseif ($file_ext === 'mp4') {
        echo "<p>วิดีโอ</p>";
        echo "<p>ชื่อไฟล์ " . htmlspecialchars($row['file_name']) . "</p>";
        echo "<video width='100%' controls><source src='" . htmlspecialchars($row['file_path']) . "' type='video/mp4'>เบราว์เซอร์ของคุณไม่รองรับวิดีโอ</video>";

    } else {
        echo "<p>ไฟล์เอกสาร</p>";
        echo "<p>ไฟล์ " . htmlspecialchars($row['file_name']);
    }

    if ($row["user_id"] == $_SESSION["user_id"]) {
        echo "<form action='rename_file.php' method='POST' style='display:inline;'>
                <input type='hidden' name='file_id' value='{$row['id']}'>
                <input type='text' name='new_name' placeholder='เปลี่ยนชื่อไฟล์' required>
                <button type='submit'>✏️ เปลี่ยนชื่อ</button>
              </form>";
    }

    echo "<p>ขนาดไฟล์: $fileSizeMB MB</p>";
    echo "<p>ดาวน์โหลด: {$row['download_count']} ครั้ง</p>";
    echo "<p><a href='download.php?id={$row['id']}'>ดาวน์โหลด</a></p>";

    if (isset($_SESSION["user_id"]) && $row["user_id"] == $_SESSION["user_id"]) {
        echo "<p><a href='delete_file.php?id={$row['id']}' onclick='return confirm(\"แน่ใจหรือไม่ว่าต้องการลบไฟล์นี้?\")'>❌ ลบไฟล์</a></p>";
    }
    
    echo "</div>";
    
}   
echo "</div>";
echo "<p><a href=dashboard.php class=back-btn>🔙 กลับไปหน้าหลัก</a></p>";
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
    
    background: #fff;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 200px;
}

div.image-container img {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

div.image-container p {
    margin-top: 10px;
}

div.image-container a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

div.image-container a:hover {
    color: #0056b3;
}
input {
    display: block;
    background-color:rgb(214, 214, 214);
    color: white;
    text-decoration: none;
    padding: 12px;
    border-radius: 6px;
    margin: 10px 0;
    font-weight: 6000;           
}
button{

    display: flex;
    background-color:rgb(178, 178, 178);
    border: none;
    border-radius: 6px;
}button:hover {
    background-color:rgb(196, 196, 196);
}
.back-btn {
    display: inline-block;
    background-color: #6c757d;
    color: white;
    padding: 10px 16px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    margin-top: 30px;
}
</style>
