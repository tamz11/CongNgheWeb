<?php
session_start(); // Bắt buộc phải có để dùng $_SESSION

// Khởi tạo dữ liệu ban đầu nếu chưa có
if(!isset($_SESSION['flowers'])) {
    include "data.php"; // $flowers từ data.php
    $_SESSION['flowers'] = $flowers;
}

$flowers = $_SESSION['flowers'];

// Thêm hoặc sửa
if (isset($_POST["save"])) {
    $item = [
        "name"  => $_POST["name"],
        "desc"  => $_POST["desc"],
        "image" => $_POST["image"]
    ];

    if ($_POST["id"] == -1) {
        $flowers[] = $item;
    } else {
        $flowers[$_POST["id"]] = $item;
    }

    $_SESSION['flowers'] = $flowers; // lưu vào session
    header("Location: admin.php");
    exit;
}

// Xóa
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    array_splice($flowers, $id, 1);
    $_SESSION['flowers'] = $flowers; // lưu vào session
    header("Location: admin.php");
    exit;
}

// Sửa
$edit = -1;
$editData = ["name"=>"", "desc"=>"", "image"=>""];
if (isset($_GET["edit"])) {
    $edit = $_GET["edit"];
    $editData = $flowers[$edit];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin quản lý hoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Trang Admin - Quản lý Hoa</h1>

<form method="POST">
    <input type="hidden" name="id" value="<?= $edit ?>">

    <input name="name" placeholder="Tên hoa" value="<?= $editData['name'] ?>"><br>
    <input name="desc" placeholder="Mô tả" value="<?= $editData['desc'] ?>"><br>
    <input name="image" placeholder="Link ảnh" value="<?= $editData['image'] ?>"><br>

    <button type="submit" name="save">Lưu</button>
    <a href="admin.php">Hủy</a>
</form>

<table border="1" width="100%" cellpadding="5">
<tr>
    <th>Ảnh</th>
    <th>Tên hoa</th>
    <th>Mô tả</th>
    <th>Hành động</th>
</tr>

<?php foreach ($flowers as $i => $f): ?>
<tr>
    <td><img src="<?= $f['image'] ?>" width="80"></td>
    <td><?= $f['name'] ?></td>
    <td><?= $f['desc'] ?></td>
    <td>
        <a href="admin.php?edit=<?= $i ?>">Sửa</a> |
        <a onclick="return confirm('Xóa?')" href="admin.php?delete=<?= $i ?>">Xóa</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>
