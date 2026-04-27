<?php
require_once __DIR__ . '/../model/booking_model.php';
$maKH = 'KH001'; // giả lập đăng nhập
$hosos = get_patient_profiles($maKH);
$doctors = get_doctors();
// CHỈ GỌI HÀM (ĐƯỢC ĐỊNH NGHĨA TRONG booking_model.php)
$cosos = get_coso(); 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đặt Lịch Khám</title>
<link rel="stylesheet" href="../layout/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
/* Điều chỉnh form-container để phù hợp khi nằm trong main content */
.form-container {
    background-color: #ffffff;
    max-width: 600px; /* Giảm max-width để giống modal hơn */
    margin: 50px auto; 
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: relative; /* Quan trọng cho nút đóng */
}
.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.form-header h2 {
    font-size: 26px;
    color: #002b5c;
    font-weight: 700;
    margin: 0;
    text-align: left;
}
.close-btn {
    font-size: 30px;
    cursor: pointer;
    color: #333;
    line-height: 1;
    text-decoration: none;
    transition: 0.2s;
}
.close-btn:hover {
    color: #c0392b;
}

/* Gray out disabled selects */
select:disabled,
input[type="date"]:disabled,
.btn-submit:disabled {
    background-color: #f0f0f0;
    cursor: not-allowed;
    opacity: 0.6;
}
</style>
</head>
<body>
<div class="app-container">

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
            <div class="form-header">
                <h2>Đặt Lịch</h2>
                <a href="../index.php" class="close-btn">&times;</a>
            </div>

            <form method="POST" action="../controller/booking_controller.php" onsubmit="return confirm('Xác nhận gửi form đặt lịch?')">
                <div class="form-row">
                    
                    <div class="form-group">
                        <label>Hồ sơ bệnh nhân:</label>
                        <select name="MaHS" id="MaHS" required>
                            <option value="">-- Chọn hồ sơ --</option>
                            <?php foreach ($hosos as $h): ?>
                                <option value="<?= $h['MaHS'] ?>"><?= htmlspecialchars($h['HoTen']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Hình thức khám:</label>
                        <select name="HinhThuc" id="HinhThuc" required disabled>
                            <option value="">-- Chọn hình thức --</option>
                            <option value="Khám tại phòng khám">🏥 Khám tại phòng khám</option>
                            <option value="Khám từ xa">💻 Khám trực tuyến</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="CoSoKhamGroup">
                        <label>Cơ sở khám:</label>
                        <select name="MaCoSo" id="MaCoSo" required disabled>
                            <option value="">-- Chọn cơ sở --</option>
                            <?php foreach ($cosos as $cs): ?>
                                <option value="<?= $cs['MaCoSo'] ?>"><?= htmlspecialchars($cs['TenCoSo']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Dịch vụ khám:</label>
                        <select name="MaDV" id="MaDV" required disabled>
                            <option value="">-- Chọn dịch vụ --</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Bác sĩ:</label>
                        <select name="MaBS" id="MaBS" required disabled>
                            <option value="">-- Chọn bác sĩ --</option>
                            <?php foreach ($doctors as $bs): ?>
                                <option value="<?= $bs['MaBS'] ?>"><?= htmlspecialchars($bs['HoTen'].' - '.$bs['ChuyenKhoa']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ngày khám:</label>
                        <input type="date" name="NgayKham" id="NgayKham" min="<?= date('Y-m-d') ?>" required disabled>
                    </div>

                    <div class="form-group">
                        <label>Khung giờ:</label>
                        <select name="KhungGio" id="KhungGio" required disabled>
                            <option value="">-- Chọn khung giờ --</option>
                            <option value="07:00">07:00</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                    </div>
                    
                    <div class="form-group"></div>

                </div>

                <button type="submit" class="btn-submit" name="submit" id="btnSubmit" disabled>Xác nhận đặt lịch</button>
            </form>
        </div>
        
    </main>
</div>

<script>
$(document).ready(function() {
    
    // --- 1. HÀM HỖ TRỢ ---
    function enableFields(fields) {
        fields.prop('disabled', false);
    }

    function disableFields(fields) {
        // Vô hiệu hóa và reset giá trị
        fields.prop('disabled', true).val('');
    }

    function resetAndDisable(fields) {
        // Vô hiệu hóa và reset giá trị cho form-group
        fields.each(function() {
            $(this).val('').prop('disabled', true);
            if ($(this).is('select')) {
                // Đặt lại option mặc định nếu là select
                $(this).find('option:first').prop('selected', true);
            }
        });
    }

    // --- 2. THEO DÕI HỒ SƠ BN (Mở khóa Hình thức) ---
    $('#MaHS').on('change', function() {
        if ($(this).val()) {
            enableFields($('#HinhThuc'));
        } else {
            resetAndDisable($('#HinhThuc, #MaCoSo, #MaDV, #MaBS, #NgayKham, #KhungGio, #btnSubmit'));
            $('#CoSoKhamGroup').hide();
        }
    }).trigger('change'); // Kích hoạt lần đầu để disable tất cả

    // --- 3. THEO DÕI HÌNH THỨC KHÁM ---
    $('#HinhThuc').on('change', function() {
        var hinhthuc = $(this).val();
        var maCoSo = $('#MaCoSo');
        var coSoGroup = $('#CoSoKhamGroup');
        
        // Reset và Vô hiệu hóa các trường phụ thuộc vào Hình thức
        resetAndDisable($('#MaCoSo, #MaDV, #MaBS, #NgayKham, #KhungGio, #btnSubmit'));

        if (hinhthuc === 'Khám tại phòng khám') {
            // Khám tại phòng khám: Yêu cầu chọn Cơ sở
            coSoGroup.show();
            enableFields(maCoSo);
        } else if (hinhthuc === 'Khám từ xa') {
            // Khám từ xa: Bỏ qua Cơ sở, chuyển sang chọn Dịch vụ
            coSoGroup.hide();
            
            // Mở khóa Dịch vụ ngay lập tức
            loadServices(hinhthuc);
            enableFields($('#MaDV'));
        } else {
             // Chưa chọn gì: Vô hiệu hóa tất cả
            coSoGroup.hide();
        }
    });


    // --- 4. THEO DÕI CƠ SỞ KHÁM (Chỉ kích hoạt cho Khám tại phòng khám) ---
    $('#MaCoSo').on('change', function() {
        var maCoSoVal = $(this).val();
        var hinhthuc = $('#HinhThuc').val();

        // Vô hiệu hóa các trường phụ thuộc vào Dịch vụ/Bác sĩ
        resetAndDisable($('#MaDV, #MaBS, #NgayKham, #KhungGio, #btnSubmit'));
        
        if (hinhthuc === 'Khám tại phòng khám' && maCoSoVal) {
            // Mở khóa Dịch vụ
            loadServices(hinhthuc);
            enableFields($('#MaDV'));
        }
    });

    // --- 5. TẢI DỊCH VỤ QUA AJAX ---
    function loadServices(hinhthuc) {
        var maDV = $('#MaDV');
        maDV.html('<option value="">-- Đang tải dịch vụ... --</option>');
        
        $.ajax({
            url: '../view/load_dichvu.php',
            method: 'GET',
            data: { hinhthuc: hinhthuc },
            success: function(data) {
                maDV.html(data);
            },
            error: function() {
                 maDV.html('<option value="">-- Lỗi tải dịch vụ --</option>');
            }
        });
    }


    // --- 6. THEO DÕI DỊCH VỤ KHÁM ---
    $('#MaDV').on('change', function() {
        var maDVVal = $(this).val();
        
        // Vô hiệu hóa các trường phụ thuộc vào Bác sĩ
        resetAndDisable($('#MaBS, #NgayKham, #KhungGio, #btnSubmit'));
        
        if (maDVVal) {
            // Mở khóa Bác sĩ, Ngày khám, Khung giờ
            enableFields($('#MaBS, #NgayKham, #KhungGio'));
        }
    });

    // --- 7. THEO DÕI CÁC TRƯỜNG CUỐI CÙNG (Để mở khóa nút Submit) ---
    $('#MaBS, #NgayKham, #KhungGio').on('change', function() {
        var maBS = $('#MaBS').val();
        var ngayKham = $('#NgayKham').val();
        var khungGio = $('#KhungGio').val();

        // Kiểm tra tất cả các trường cuối cùng đã được chọn chưa
        if (maBS && ngayKham && khungGio) {
            enableFields($('#btnSubmit'));
        } else {
            disableFields($('#btnSubmit')); // Dùng disableFields để có hiệu ứng gray-out
        }
    });
});
</script>
</body>
</html>