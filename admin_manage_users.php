<?php
include 'auth.php';
include 'db_connect.php';
checkRole('admin');

echo "<h2>👥 รายชื่อผู้ใช้ทั้งหมด</h2>";
echo "<div class='user-list'>";

$result = $pdo->query("SELECT * FROM users");
while ($row = $result->fetch()) {
    echo "<div class='user-card'>";
    echo "<p><strong>ชื่อผู้ใช้:</strong> {$row['username']}</p>";
    echo "<p><strong>สิทธิ์:</strong> {$row['role']}</p>";
    echo "<p><a href='delete_user.php?id={$row['id']}' onclick='return confirm(\"ลบผู้ใช้นี้จริงหรือ?\")'>❌ ลบ</a></p>";
    echo "</div>";
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
    color: #343a40;
    margin-bottom: 20px;
}

.user-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 15px;
    justify-content: center;
    padding: 20px 0;
}

.user-card {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    width: 200px;
    text-align: center;
}

.user-card p {
    margin: 10px 0;
}

.user-card a {
    display: inline-block;
    text-decoration: none;
    background-color: #dc3545;
    color: white;
    padding: 6px 12px;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

.user-card a:hover {
    background-color: #c82333;
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
</style>
