<?php include 'auth.php'; ?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>✨ ยินดีต้อนรับ</h1> 
    <h2><?php echo $_SESSION["username"]; ?></h2>
    <hr>

    <?php
    if (isset($_SESSION['role'])) {
        echo "<p>🔐 คุณคือ: <strong>" . $_SESSION['role'] . "</strong></p>";

        if ($_SESSION['role'] === 'admin') {
            echo '<p><a class="admin-link" href="admin_dashboard.php">🛠️ Admin Dashboard</a></p>';
        }
    } else {
        echo "<p style='color:red;'>⚠️ ยังไม่มี SESSION role!</p>";
    }
    ?>    

    <p><a href="upload.php">📤 อัปโหลดไฟล์</a></p>
    <p><a href="downloads.php">📥 ดาวน์โหลดไฟล์</a></p>
    <p><a href="edit_profile.php">⚙️ แก้ไขข้อมูลส่วนตัว</a></p>

    <a href="logout.php" class="btn btn-danger">🚪 ออกจากระบบ</a>
</div>

</body>
</html>

<style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: 'Prompt', sans-serif;
    }

    .container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 350px;
    }

    h1 {
        color: #343a40;
        margin-bottom: 10px;
        font-size: 26px;
    }

    h2 {
        color: #007bff;
        margin-bottom: 15px;
        font-size: 22px;
    }

    hr {
        border: none;
        border-top: 1px solid #dee2e6;
        margin: 15px 0;
    }

    p {
        margin: 10px 0;
    }

    p a {
        display: block;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        padding: 12px;
        border-radius: 6px;
        font-weight: 600;
        transition: 0.3s;
    }

    p a:hover {
        background-color: #0056b3;
    }

    .admin-link {
        background-color: #28a745;
    }

    .admin-link:hover {
        background-color: #218838;
    }

    .btn-danger {
        display: inline-block;
        background-color: #dc3545;
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 20px;
        transition: 0.3s;
    }

    .btn-danger:hover {
        background-color: #b02a37;
    }
</style>
