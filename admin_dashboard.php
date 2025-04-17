<?php
include 'auth.php';
include 'db_connect.php';
checkRole('admin');
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-container">
    <h2>🛠️ Admin Dashboard</h2>

    <div class="admin-links">
        <p><a href="admin_manage_files.php" class="admin-btn">📂 จัดการไฟล์ทั้งหมด</a></p>
        <p><a href="admin_manage_users.php" class="admin-btn">👥 จัดการผู้ใช้ทั้งหมด</a></p>
        <p><a href="dashboard.php" class="back-btn">🔙 กลับไปหน้าหลัก</a></p>
    </div>
</div>

</body>
</html>

<style>
    body {
        background-color: #f1f3f5;
        font-family: 'Prompt', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .admin-container {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 400px;
    }

    h2 {
        color: #343a40;
        margin-bottom: 30px;
        font-size: 26px;
    }

    .admin-links p {
        margin: 15px 0;
    }

    .admin-btn {
        display: block;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }

    .admin-btn:hover {
        background-color: #0056b3;
    }

    .back-btn {
        display: block;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        margin-top: 20px;
        transition: 0.3s;
    }

    .back-btn:hover {
        background-color: #495057;
    }
</style>
