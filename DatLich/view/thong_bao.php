<?php
require_once __DIR__ . '/../model/pdo.php';
$maLich = $_GET['malich'] ?? '';
$lk = false;

if ($maLich) {
    // TRUY VẤN MỚI: JOIN với dichvukham để lấy TenDV và GiaTien
    $stmt = $pdo->prepare("
        SELECT 
            lk.*, 
            dv.TenDV, 
            dv.GiaTien 
        FROM lichkham lk
        JOIN dichvukham dv ON lk.MaDV = dv.MaDV
        WHERE lk.MaLichKham=?
    ");
    $stmt->execute([$maLich]);
    $lk = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Kiểm tra nếu không tìm thấy lịch khám
if (!$lk) {
    die("Không tìm thấy thông tin lịch khám!");
}

// Hàm định dạng tiền tệ Việt Nam (VNĐ)
function format_currency($amount) {
    // Ép kiểu về float hoặc decimal để đảm bảo định dạng đúng
    return number_format((float)$amount, 0, ',', '.') . ' VNĐ';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đặt Lịch Thành Công</title>
<link rel="stylesheet" href="../layout/style.css">
<style>
    /* CSS bổ sung cho trang thông báo */
    .success-icon {
        color: #2ecc71; /* Màu xanh lá cây cho thành công */
        font-size: 50px;
        text-align: center;
        margin-bottom: 15px;
    }
    .info-item {
        margin-bottom: 10px;
        padding: 8px 0;
        border-bottom: 1px dashed #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .info-item:last-child {
        border-bottom: none;
    }
    .info-item label {
        font-weight: 600;
        color: #555;
    }
    .info-item span {
        font-weight: bold;
        color: #002b5c;
    }
    /* Màu đỏ cho Giá tiền */
    .info-item.price span {
        color: #c0392b; 
    }
    .info-item a {
        color: #4361ee;
        text-decoration: none;
        font-weight: bold;
    }
    .info-item a:hover {
        text-decoration: underline;
    }
    .action-button {
        text-align: center;
        margin-top: 30px;
    }
    /* Điều chỉnh form-container để phù hợp khi nằm trong main content */
    .form-container {
        margin: 20px 0; /* Giảm margin trên/dưới khi đã có sidebar/header */
    }
</style>
</head>
<body>
<div class="app-container">
    <div class="alert-success-top" id="successAlert">
        Đặt lịch thành công!
    </div>   
    <script>
        // Ẩn sau 4 giây với hiệu ứng mượt
        setTimeout(() => {
            const alert = document.getElementById('successAlert');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translate(-50%, -120%)';
                alert.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                setTimeout(() => alert.remove(), 800);
            }
        }, 4000);
    </script>
    <aside class="sidebar">
        <div class="logo-section">
            <img src="../layout/image/logo.jpg" alt="Jio Health" class="logo-icon">
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
        </header>

        <div class="form-container">
            <h2 class="header-title" style="text-align: center; margin-bottom: 10px;">CHI TIẾT LỊCH KHÁM</h2>
            <p style="text-align: center; margin-bottom: 30px; color: #777;">Vui lòng lưu lại các thông tin dưới đây:</p>

            <div class="info-item">
                <label>Mã lịch khám:</label>
                <span><?= $lk['MaLichKham'] ?></span>
            </div>
            
            <div class="info-item">
                <label>Dịch vụ:</label>
                <span><?= htmlspecialchars($lk['TenDV']) ?></span>
            </div>

            <div class="info-item">
                <label>Ngày khám:</label>
                <span><?= date('d/m/Y',strtotime($lk['NgayKham'])) ?></span>
            </div>

            <div class="info-item">
                <label>Giờ hẹn chính xác:</label>
                <span><?= substr($lk['GioHenChinhXac'], 0, 5) ?></span>
            </div>

            <div class="info-item">
                <label>Số thứ tự khám:</label>
                <span><?= $lk['SoThuTuKham'] ?? '—' ?></span>
            </div>

            <div class="info-item">
                <label>Link khám:</label>
                <span>
                    <?php if ($lk['LinkKham']): ?>
                        <a href="<?= $lk['LinkKham'] ?>" target="_blank">Tham gia ngay</a>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </span>
            </div>
            
            <?php if ($lk['GiaTien'] !== null): ?>
            <div class="info-item">
                <label>Số tiền:</label>
                <span><?= format_currency($lk['GiaTien']) ?></span>
            </div>
            <?php endif; ?>

            <div class="info-item">
                <label>Trạng thái:</label>
                <span><?= $lk['TrangThaiLK'] ?></span>
            </div>

            <div class="action-button">
                <a href="../index.php" class="btn-primary" style="text-decoration: none; display: inline-block;">Đóng</a>
            </div>

        </div>
    </main>
</div>
</body>
</html>