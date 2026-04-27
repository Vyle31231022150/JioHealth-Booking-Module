<?php
require_once __DIR__ . '/../model/booking_model.php';

if (isset($_POST['submit'])) {
    global $pdo; 
    
    $maLich = 'LK' . str_pad(rand(1,9999), 3, '0', STR_PAD_LEFT);
    $maHS = $_POST['MaHS'];
    $maDV = $_POST['MaDV'];
    $maBS = $_POST['MaBS'];
    $ngay = $_POST['NgayKham'];
    $khunggio = $_POST['KhungGio'];
    $maCoSo = null;
    $soThuTu = null;
    $link = null;
    $maCa = null; // Khởi tạo MaCa là NULL

    // Kiểm tra hình thức khám từ dịch vụ
    $stmt = $pdo->prepare("SELECT HinhThucKham FROM dichvukham WHERE MaDV=?");
    $stmt->execute([$maDV]);
    $hinhThuc = $stmt->fetchColumn();


    if ($hinhThuc === 'Khám từ xa') {
        // --- XỬ LÝ CHO KHÁM TỪ XA ---
        $link = "https://meet.google.com/czu-hsic-cwt";
        
        // Vì là khám từ xa, không cần MaCa và MaCoSo vật lý.
        // Gán NULL để tránh lỗi khóa ngoại 1452 (FK_LK_LICHLAM và FK_LK_CS).
        // Yêu cầu cột MaCa và MaCoSo trong lichkham PHẢI CHO PHÉP NULL.
        $maCa = null; 
        $maCoSo = null; 
        
    } else { // Khám tại phòng khám (Khám tại phòng khám)
        // --- XỬ LÝ CHO KHÁM TẠI PHÒNG KHÁM ---
        
        // 1. TÌM MÃ CA HỢP LỆ (Lấy MaCa bất kỳ từ lichlam cho Bác sĩ này)
        $stmt_ca = $pdo->prepare("SELECT MaCa FROM lichlam WHERE MaBS=? LIMIT 1");
        $stmt_ca->execute([$maBS]);
        $maCa = $stmt_ca->fetchColumn(); 
        
        // Nếu vẫn không tìm được MaCa nào (bác sĩ không có lịch làm), thì hệ thống vẫn sẽ lỗi FK.
        // Đây là lỗi dữ liệu, nhưng ta phải cố gắng lấy giá trị hợp lệ nhất.
        if (!$maCa) {
             // Đặt một giá trị tạm nếu không tìm thấy (VẪN CÓ NGUY CƠ LỖI)
             $maCa = 'CA001'; 
        }
        
        // 2. TÍNH SỐ THỨ TỰ
        $stmt_stt = $pdo->prepare("SELECT COUNT(*) FROM lichkham WHERE MaBS=? AND NgayKham=?");
        $stmt_stt->execute([$maBS, $ngay]);
        $soThuTu = $stmt_stt->fetchColumn() + 1;
        
        // 3. LẤY MÃ CƠ SỞ
        $maCoSo = $_POST['MaCoSo'] ?? 'CS001'; 
    }

    $data = [
        'MaLichKham' => $maLich,
        'LinkKham' => $link,
        'SoThuTuKham' => $soThuTu,
        'NgayKham' => $ngay,
        'GioHenChinhXac' => $khunggio,
        'MaHS' => $maHS,
        'MaDV' => $maDV,
        'MaCa' => $maCa,       // Có thể là NULL hoặc MaCa hợp lệ
        'MaBS' => $maBS,
        'MaCoSo' => $maCoSo    // Có thể là NULL hoặc MaCoSo hợp lệ
    ];
    
    insert_booking($data);
    
    // Chỉ cập nhật slot nếu có MaCa hợp lệ (tức là không phải khám từ xa)
    if ($maCa) {
        update_slot_count($maBS, $maCa); 
    }

    // Quay về trang thông báo
    header("Location: ../view/thong_bao.php?malich=" . $maLich);
    exit;
}
?>