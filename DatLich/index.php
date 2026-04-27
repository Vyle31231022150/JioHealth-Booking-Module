<?php
require_once __DIR__ . '/model/pdo.php';
$stmt = $pdo->query("
    SELECT lk.MaLichKham, dv.TenDV, dv.HinhThucKham, lk.NgayKham, lk.GioHenChinhXac,
           lk.SoThuTuKham, lk.LinkKham, lk.TrangThaiLK
    FROM lichkham lk
    JOIN dichvukham dv ON lk.MaDV = dv.MaDV
    ORDER BY lk.NgayKham ASC
");
$lichkham = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đặt Lịch Khám</title>
<link rel="stylesheet" href="layout/style.css">
</head>
<body>
<div class="app-container">
<aside class="sidebar">
    <div class="logo-section">
        <img src="layout/image/logo.jpg" alt="Jio Health" class="logo-icon">
    </div>
    <nav class="menu">
        <ul>
            <li class="menu-item">Quản lý lịch khám</li>
            <li class="menu-item active">Đặt lịch khám</li>
            <li class="menu-item">Chăm sóc khách hàng</li>
            <li class="menu-item">Quản lý hồ sơ bệnh nhân</li>
            <li class="menu-item">Quản lý đơn thuốc</li>
            <li class="menu-item">Quản lý bệnh án</li>
            <li class="menu-item">Quản lý tài khoản cá nhân</li>
            <li class="menu-item">Quản lý thông tin cá nhân</li>
        </ul>
    </nav>
</aside>

<main class="content">
<header class="header">
    <h1 class="header-title">ĐẶT LỊCH KHÁM</h1>
    
    <div class="user-info">
        <span class="user-icon">👤</span>
        <div class="user-name">
            <span class="name">Lê Mỹ Phụng</span><br>
            <span class="role">Khách hàng</span>
        </div>
    </div>
</header>

<?php if(isset($_GET['success'])): ?>
<div class="alert-success-top" id="successAlert">
    Đặt lịch thành công!
</div>

<?php endif; ?>
<section class="table-section">
<table class="complaint-table">
<thead>
<tr>
    <th>STT</th><th>Mã LK</th><th>Dịch Vụ</th><th>Ngày & Giờ</th><th>STT / Link</th><th>Trạng Thái</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($lichkham as $row): ?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= $row['MaLichKham'] ?></td>
    <td><strong><?= $row['TenDV'] ?></strong><br><small><?= $row['HinhThucKham'] ?></small></td>
    <td><?= date('d/m/Y',strtotime($row['NgayKham'])) ?><br><small><?= substr($row['GioHenChinhXac'],0,5) ?></small></td>
    <td><?= $row['HinhThucKham']=='Khám từ xa' ? "<a href='{$row['LinkKham']}' target='_blank'>Link</a>" : "STT: {$row['SoThuTuKham']}" ?></td>
    <td><?= $row['TrangThaiLK']=='Đã xác nhận'?'Đã thanh toán':'Chưa thanh toán' ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</section>

<div class="main-actions-footer">
    <button class="btn-primary" onclick="window.location.href='view/dat_lich_kham.php'">+ Đặt Lịch</button>
    <button class="btn-primary">Thanh toán</button>
</div>
</main>
</div>
</body>
</html>