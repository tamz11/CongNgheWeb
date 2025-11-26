<?php
// File: display.php
$filename = "Quiz.txt"; // đường dẫn tới file txt

// Kiểm tra file tồn tại
if(file_exists($filename)){
    $content = file_get_contents($filename);
} else {
    $content = "Không tìm thấy tệp tin!";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hiển thị tệp tin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .file-content {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            white-space: pre-wrap; /* giữ xuống dòng */
            word-wrap: break-word;
        }
    </style>
</head>
<body>

<h1>Danh sách câu hỏi</h1>
<div class="file-content">
    <?= htmlspecialchars($content) ?>
</div>

</body>
</html>
