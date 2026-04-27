<?php
require_once 'pdo.php';

// Hồ sơ bệnh nhân
function get_patient_profiles($maKH) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT MaHS, HoTen FROM hosobenhnhan WHERE MaKH=?");
    $stmt->execute([$maKH]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy dịch vụ (nếu có hình thức thì lọc)
function get_services($hinhthuc = null) {
    global $pdo;
    if ($hinhthuc) {
        $stmt = $pdo->prepare("SELECT MaDV, TenDV, HinhThucKham FROM dichvukham WHERE HinhThucKham=?");
        $stmt->execute([$hinhthuc]);
    } else {
        $stmt = $pdo->query("SELECT MaDV, TenDV, HinhThucKham FROM dichvukham");
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy bác sĩ
function get_doctors() {
    global $pdo;
    $stmt = $pdo->query("SELECT MaBS, HoTen, ChuyenKhoa FROM bacsi WHERE TrangThaiHoatDong='Hoạt động'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy danh sách cơ sở khám
// *** ĐÃ SỬA TÊN BẢNG TỪ 'coso' SANG 'cosokham' DỰA TRÊN LỖI TRƯỚC VÀ HÌNH ẢNH DB ***
function get_coso() {
    global $pdo;
    $stmt = $pdo->query("SELECT MaCoSo, TenCoSo FROM cosokham"); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Tạo lịch khám
function insert_booking($data) {
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO lichkham(MaLichKham, TrangThaiLK, LinkKham, SoThuTuKham, NgayKham, GioHenChinhXac, MaHS, MaDV, MaCa, MaBS, MaCoSo)
        VALUES (?, 'Chờ thanh toán', ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([
        $data['MaLichKham'],
        $data['LinkKham'],
        $data['SoThuTuKham'],
        $data['NgayKham'],
        $data['GioHenChinhXac'],
        $data['MaHS'],
        $data['MaDV'],
        $data['MaCa'],
        $data['MaBS'],
        $data['MaCoSo']
    ]);
}

function update_slot_count($maBS, $maCa) {
    global $pdo;
    $pdo->prepare("UPDATE lichlam SET SoLuongDaDat = SoLuongDaDat + 1 WHERE MaBS=? AND MaCa=?")->execute([$maBS, $maCa]);
}
?>