<?php
include 'auth.php';
include 'db_connect.php';
checkRole('admin');

echo "<h2>📁 รายการไฟล์ทั้งหมด (Admin)</h2>";
echo "<div class='gallery'>";

$stmt = $pdo->query("SELECT id, file_name, file_path, file_size, category, download_count, user_id FROM files");

while ($row = $stmt->fetch()) {
    $file_ext = strtolower(pathinfo($row['file_name'], PATHINFO_EXTENSION));
    $fileSizeMB = round($row['file_size'] / 1024 / 1024, 2);

    echo "<div class='image-container'>";

    if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "<img src='" . htmlspecialchars($row['file_path']) . "' alt=''>";
    } elseif ($file_ext === 'mp4') {
        echo "<video controls>
                <source src='" . htmlspecialchars($row['file_path']) . "' type='video/mp4'>
              </video>";
    } else {
        echo "<img src='file_icon/images.png' alt='File Icon' class='file-icon'>";

    }

    echo "<div class='image-details'>";
    echo "<p><strong>หมวดหมู่:</strong> " . htmlspecialchars($row['category']) . "</p>";
    echo "<p><strong>โดย User ID:</strong> " . htmlspecialchars($row['user_id']) . "</p>";
    echo "<p><strong>ชื่อไฟล์:</strong> " . htmlspecialchars($row['file_name']) . "</p>";
    echo "<p>ขนาด: $fileSizeMB MB</p>";
    echo "<p>ดาวน์โหลด: {$row['download_count']} ครั้ง</p>";
    echo "<p>
            <a href='download.php?id={$row['id']}'>⬇️ ดาวน์โหลด</a>
            <a href='delete_file.php?id={$row['id']}' onclick='return confirm(\"ลบไฟล์นี้จริงหรือ?\")'>❌ ลบ</a>
          </p>";
    echo "</div>"; // image-details

    echo "</div>"; // image-container
}
echo "</div>";

echo "<p><a href='admin_dashboard.php' class='back-btn'>🔙 กลับหน้าหลักแอดมิน</a></p>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    text-align: center;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}

h2 {
    margin-bottom: 20px;
    color: #343a40;
}

.gallery {
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
    padding: 20px 0;
}

.image-container {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    width: 90%;
    max-width: 900px;
    gap: 20px;
}

.image-container img,
.image-container video {
    width: 200px;
    border-radius: 6px;
    flex-shrink: 0;
}

.image-details {
    text-align: left;
    flex: 1;
}

.image-details p {
    margin: 6px 0;
}

.image-details a {
    display: inline-block;
    text-decoration: none;
    background-color: #007bff;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
    margin-right: 8px;
}

.image-details a:hover {
    background-color: #0056b3;
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

.back-btn:hover {
    background-color: #495057;
}
.file-icon {
    width: 200px;
    border-radius: 6px;
    margin-top: 10px;
}
</style>
