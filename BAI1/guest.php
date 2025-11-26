<?php
session_start();
$flowers = isset($_SESSION['flowers']) ? $_SESSION['flowers'] : [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách hoa</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .flower { display: inline-block; margin: 10px; padding: 10px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 180px; text-align: center; }
        .flower img { width: 150px; height: 150px; object-fit: cover; border-radius: 6px; }
        .flower h3 { margin: 8px 0 4px; font-size: 16px; }
        .flower p { font-size: 14px; color: #555; }
    </style>
</head>
<body>

<h1>Danh sách hoa</h1>

<?php foreach($flowers as $f): ?>
<div class="flower">
    <img src="<?= htmlspecialchars($f['image']) ?>" alt="<?= htmlspecialchars($f['name']) ?>">
    <h3><?= htmlspecialchars($f['name']) ?></h3>
    <p><?= htmlspecialchars($f['desc']) ?></p>
</div>
<?php endforeach; ?>

</body>
</html>
