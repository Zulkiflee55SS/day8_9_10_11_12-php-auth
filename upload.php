<?php include 'auth.php'; ?>
<h2>อัปโหลดไฟล์</h2>
<form action="upload_process.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <select name="category">
    <option value="image">รูปภาพ</option>
    <option value="document">เอกสาร</option>
    <option value="video">วิดีโอ</option>
</select>

    <button type="submit">อัปโหลด</button>
    
</form>
<p><a href="dashboard.php" class="back-btn">🔙 กลับไปหน้าหลัก</a></p>
<style>body {
    font-family: Arial, sans-serif;
    text-align: center;
}

form {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input, button {
    margin: 5px;
    padding: 10px;
    width: 100%;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
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
</style>