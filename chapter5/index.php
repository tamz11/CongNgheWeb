<?php
// =============== CONTROLLER =================

// TODO 6:
require_once 'models/SinhVienModel.php';

// === KẾT NỐI CSDL (PDO) ===
$host = '127.0.0.1';
$dbname = 'cse485_web';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}


// === LOGIC CỦA CONTROLLER ===

// TODO 8:
if (isset($_POST['ten_sinh_vien'])) {

    // TODO 9:
    $ten = $_POST['ten_sinh_vien'];
    $email = $_POST['email'];

    // TODO 10:
    addSinhVien($pdo, $ten, $email);

    // TODO 11:
    header('Location: index.php');
    exit;
}

// TODO 12:
$danh_sach_sv = getAllSinhVien($pdo);

// TODO 13:
include 'views/sinhvien_view.php';
?>
