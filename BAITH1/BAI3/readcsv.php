<?php
$filename = "accountssv.csv";
$accounts = [];

// Kiểm tra file tồn tại
if(file_exists($filename)){
    if(($handle = fopen($filename, "r")) !== false){
        $header = fgetcsv($handle); // đọc dòng đầu tiên làm header
        while(($data = fgetcsv($handle)) !== false){
            $accounts[] = array_combine($header, $data); // kết hợp header với dữ liệu
        }
        fclose($handle);
    }
} else {
    echo "Không tìm thấy tệp CSV!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f5f5f5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2f7df6;
            color: #fff;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<h1>Danh sách tài khoản</h1>

<table>
    <tr>
        <?php foreach($header as $col): ?>
            <th><?= htmlspecialchars($col) ?></th>
        <?php endforeach; ?>
    </tr>

    <?php foreach($accounts as $acc): ?>
        <tr>
            <?php foreach($header as $col): ?>
                <td><?= htmlspecialchars($acc[$col]) ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
