-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 04:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ql_phongkham`
--

-- --------------------------------------------------------

--
-- Table structure for table `bacsi`
--

CREATE TABLE `bacsi` (
  `MaBS` char(10) NOT NULL,
  `HoTen` varchar(200) DEFAULT NULL,
  `GioiTinh` enum('Nam','Nu','Khác') DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `ChuyenKhoa` varchar(100) DEFAULT NULL,
  `BangCap` varchar(100) DEFAULT NULL,
  `TrangThaiHoatDong` enum('Hoạt động','Tạm dừng','Đã nghỉ') DEFAULT 'Hoạt động',
  `MaTK` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bacsi`
--

INSERT INTO `bacsi` (`MaBS`, `HoTen`, `GioiTinh`, `NgaySinh`, `DiaChi`, `Email`, `ChuyenKhoa`, `BangCap`, `TrangThaiHoatDong`, `MaTK`) VALUES
('BS001', 'Trần Quốc Hùng', 'Nam', '1980-03-10', '10 Hàng Bông, HN', 'h1@example.com', '', 'Bác sĩ CK I', 'Hoạt động', 'TK003'),
('BS002', 'Phạm Thị Mai', 'Nu', '1985-07-20', '20 Trần Hưng Đạo, HN', 'm2@example.com', '', 'Thạc sĩ', 'Hoạt động', 'TK004'),
('BS003', 'Lê Văn Quang', 'Nam', '1978-11-02', '30 Hai Bà Trưng, HN', 'q3@example.com', '', 'Tiến sĩ', 'Hoạt động', 'TK005'),
('BS004', 'Nguyễn Thị Yến', 'Nu', '1990-01-15', '40 Lê Duẩn, HN', 'y4@example.com', '', 'Thạc sĩ', 'Hoạt động', 'TK006'),
('BS005', 'Đoàn Văn Sơn', 'Nam', '1982-09-09', '50 Nguyễn Trãi, HN', 's5@example.com', '', 'Bác sĩ CK I', 'Hoạt động', NULL),
('BS006', 'Hoàng Thị Thu', 'Nu', '1987-12-12', '60 Lý Thường Kiệt, HN', 't6@example.com', '', 'Thạc sĩ', 'Tạm dừng', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `calam`
--

CREATE TABLE `calam` (
  `MaCa` char(10) NOT NULL,
  `Ngay` date DEFAULT NULL,
  `LoaiCa` enum('Sáng','Chiều','Tối') DEFAULT NULL,
  `GioBatDau` time DEFAULT NULL,
  `GioKetThuc` time DEFAULT NULL,
  `MaCoSo` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calam`
--

INSERT INTO `calam` (`MaCa`, `Ngay`, `LoaiCa`, `GioBatDau`, `GioKetThuc`, `MaCoSo`) VALUES
('CA001', '2025-10-21', 'Sáng', '07:00:00', '11:00:00', 'CS001'),
('CA002', '2025-10-21', 'Chiều', '13:00:00', '17:00:00', 'CS001'),
('CA003', '2025-10-22', 'Sáng', '07:00:00', '11:00:00', 'CS002'),
('CA004', '2025-10-22', 'Chiều', '13:00:00', '17:00:00', 'CS003'),
('CA005', '2025-10-23', 'Sáng', '08:00:00', '12:00:00', 'CS001');

-- --------------------------------------------------------

--
-- Table structure for table `cosokham`
--

CREATE TABLE `cosokham` (
  `MaCoSo` char(10) NOT NULL,
  `TenCoSo` varchar(200) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cosokham`
--

INSERT INTO `cosokham` (`MaCoSo`, `TenCoSo`, `DiaChi`) VALUES
('CS001', 'Phòng khám đa khoa Hy Vọng - Quận 1', '12 Nguyễn Huệ, P. Bến Nghé, Quận 1, TP.HCM'),
('CS002', 'Phòng khám Hy Vọng - Vũng Tàu', '34 Trần Phú, Phường 1, TP. Vũng Tàu'),
('CS003', 'Phòng khám Hy Vọng - Hà Nội', '56 Nguyễn Trãi, P. Thượng Đình, Q. Thanh Xuân, Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `dichvukham`
--

CREATE TABLE `dichvukham` (
  `MaDV` char(10) NOT NULL,
  `TenDV` varchar(200) DEFAULT NULL,
  `HinhThucKham` enum('Khám tại phòng khám','Khám từ xa') NOT NULL,
  `GiaTien` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dichvukham`
--

INSERT INTO `dichvukham` (`MaDV`, `TenDV`, `HinhThucKham`, `GiaTien`) VALUES
('DV001', 'Khám tổng quát', 'Khám tại phòng khám', 200000.00),
('DV002', 'Tư vấn Online', 'Khám từ xa', 150000.00),
('DV003', 'Xét nghiệm máu', 'Khám tại phòng khám', 120000.00),
('DV004', 'Siêu âm', 'Khám tại phòng khám', 300000.00),
('DV005', 'Chụp X-quang', 'Khám tại phòng khám', 250000.00),
('DV006', 'Khám chuyên khoa', 'Khám tại phòng khám', 350000.00),
('DV007', 'Khám định kỳ', 'Khám tại phòng khám', 180000.00),
('DV008', 'Tư vấn dinh dưỡng Online', 'Khám từ xa', 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `hosobenhnhan`
--

CREATE TABLE `hosobenhnhan` (
  `MaHS` char(10) NOT NULL,
  `HoTen` varchar(200) DEFAULT NULL,
  `GioiTinh` enum('Nam','Nu','Khác') DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `MaKH` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hosobenhnhan`
--

INSERT INTO `hosobenhnhan` (`MaHS`, `HoTen`, `GioiTinh`, `NgaySinh`, `MaKH`) VALUES
('HS001', 'Nguyễn Văn A', 'Nam', '1990-01-01', 'KH001'),
('HS002', 'Lê Thị B (con chị A)', 'Nu', '2020-02-02', 'KH001'),
('HS003', 'Trần Văn C', 'Nam', '1988-03-03', 'KH003'),
('HS004', 'Phạm Thị D', 'Nu', '1995-04-04', 'KH004');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` char(10) NOT NULL,
  `HoTen` varchar(200) DEFAULT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `SoDienThoai` varchar(20) DEFAULT NULL,
  `MaTK` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `HoTen`, `Email`, `SoDienThoai`, `MaTK`) VALUES
('KH001', 'Nguyen Van A', 'a@example.com', '090111222', 'TK001'),
('KH002', 'Le Thi B', 'b@example.com', '090222333', 'TK002'),
('KH003', 'Tran Van C', 'c@example.com', '090333444', NULL),
('KH004', 'Pham Thi D', 'd@example.com', '090444555', NULL),
('KH005', 'Hoang Van E', 'e@example.com', '090555666', NULL),
('KH006', 'Mai Thi F', 'f@example.com', '090666777', NULL),
('KH007', 'Vu Van G', 'g@example.com', '090777888', NULL),
('KH008', 'Ngoc Lan H', 'h@example.com', '090888999', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lichkham`
--

CREATE TABLE `lichkham` (
  `MaLichKham` char(10) NOT NULL,
  `TrangThaiLK` enum('Chờ thanh toán','Đã xác nhận','Đã khám','Hủy','Tái khám') DEFAULT 'Chờ thanh toán',
  `LinkKham` varchar(255) DEFAULT NULL,
  `SoThuTuKham` int(11) DEFAULT NULL,
  `NgayKham` date DEFAULT NULL,
  `GioHenChinhXac` time DEFAULT NULL,
  `MaHS` char(10) DEFAULT NULL,
  `MaDV` char(10) DEFAULT NULL,
  `MaCa` char(10) DEFAULT NULL,
  `MaBS` char(10) DEFAULT NULL,
  `MaCoSo` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lichkham`
--

INSERT INTO `lichkham` (`MaLichKham`, `TrangThaiLK`, `LinkKham`, `SoThuTuKham`, `NgayKham`, `GioHenChinhXac`, `MaHS`, `MaDV`, `MaCa`, `MaBS`, `MaCoSo`) VALUES
('LK001', 'Đã khám', NULL, 1, '2025-10-21', '08:00:00', 'HS001', 'DV001', 'CA001', 'BS001', 'CS001'),
('LK002', 'Đã xác nhận', NULL, 2, '2025-10-21', '08:30:00', 'HS002', 'DV002', 'CA001', 'BS002', 'CS001');

-- --------------------------------------------------------

--
-- Table structure for table `lichlam`
--

CREATE TABLE `lichlam` (
  `MaBS` char(10) NOT NULL,
  `MaCa` char(10) NOT NULL,
  `SoLuongToiDa` int(11) DEFAULT NULL,
  `SoLuongDaDat` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lichlam`
--

INSERT INTO `lichlam` (`MaBS`, `MaCa`, `SoLuongToiDa`, `SoLuongDaDat`) VALUES
('BS001', 'CA001', 10, 2),
('BS001', 'CA005', 10, 0),
('BS002', 'CA001', 10, 5),
('BS003', 'CA002', 8, 1),
('BS004', 'CA002', 8, 0),
('BS005', 'CA003', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTK` char(10) NOT NULL,
  `TenDangNhap` varchar(100) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `LoaiTaiKhoan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `LoaiTaiKhoan`) VALUES
('TK001', 'khachhang1', 'hashed_password', 'KhachHang'),
('TK002', 'khachhang2', 'hashed_password', 'KhachHang'),
('TK003', 'tran_quoc_h', 'hashed_password', 'BacSi'),
('TK004', 'pham_thi_m', 'hashed_password', 'BacSi'),
('TK005', 'le_van_q', 'hashed_password', 'BacSi'),
('TK006', 'nguyen_thi_y', 'hashed_password', 'BacSi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bacsi`
--
ALTER TABLE `bacsi`
  ADD PRIMARY KEY (`MaBS`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `FK_BACSI_TAIKHOAN` (`MaTK`);

--
-- Indexes for table `calam`
--
ALTER TABLE `calam`
  ADD PRIMARY KEY (`MaCa`),
  ADD KEY `FK_CALAM_COSOKHAM` (`MaCoSo`);

--
-- Indexes for table `cosokham`
--
ALTER TABLE `cosokham`
  ADD PRIMARY KEY (`MaCoSo`);

--
-- Indexes for table `dichvukham`
--
ALTER TABLE `dichvukham`
  ADD PRIMARY KEY (`MaDV`);

--
-- Indexes for table `hosobenhnhan`
--
ALTER TABLE `hosobenhnhan`
  ADD PRIMARY KEY (`MaHS`),
  ADD KEY `FK_HS_KHACHHANG` (`MaKH`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `FK_KHACHHANG_TAIKHOAN` (`MaTK`);

--
-- Indexes for table `lichkham`
--
ALTER TABLE `lichkham`
  ADD PRIMARY KEY (`MaLichKham`),
  ADD KEY `FK_LK_HS` (`MaHS`),
  ADD KEY `FK_LK_DV` (`MaDV`),
  ADD KEY `FK_LK_LICHLAM` (`MaBS`,`MaCa`),
  ADD KEY `FK_LK_CS` (`MaCoSo`);

--
-- Indexes for table `lichlam`
--
ALTER TABLE `lichlam`
  ADD PRIMARY KEY (`MaBS`,`MaCa`),
  ADD KEY `FK_LICHLAM_CALAM` (`MaCa`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTK`),
  ADD UNIQUE KEY `TenDangNhap` (`TenDangNhap`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bacsi`
--
ALTER TABLE `bacsi`
  ADD CONSTRAINT `FK_BACSI_TAIKHOAN` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `calam`
--
ALTER TABLE `calam`
  ADD CONSTRAINT `FK_CALAM_COSOKHAM` FOREIGN KEY (`MaCoSo`) REFERENCES `cosokham` (`MaCoSo`) ON UPDATE CASCADE;

--
-- Constraints for table `hosobenhnhan`
--
ALTER TABLE `hosobenhnhan`
  ADD CONSTRAINT `FK_HS_KHACHHANG` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD CONSTRAINT `FK_KHACHHANG_TAIKHOAN` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `lichkham`
--
ALTER TABLE `lichkham`
  ADD CONSTRAINT `FK_LK_CS` FOREIGN KEY (`MaCoSo`) REFERENCES `cosokham` (`MaCoSo`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LK_DV` FOREIGN KEY (`MaDV`) REFERENCES `dichvukham` (`MaDV`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LK_HS` FOREIGN KEY (`MaHS`) REFERENCES `hosobenhnhan` (`MaHS`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LK_LICHLAM` FOREIGN KEY (`MaBS`,`MaCa`) REFERENCES `lichlam` (`MaBS`, `MaCa`) ON UPDATE CASCADE;

--
-- Constraints for table `lichlam`
--
ALTER TABLE `lichlam`
  ADD CONSTRAINT `FK_LICHLAM_BACSI` FOREIGN KEY (`MaBS`) REFERENCES `bacsi` (`MaBS`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LICHLAM_CALAM` FOREIGN KEY (`MaCa`) REFERENCES `calam` (`MaCa`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
