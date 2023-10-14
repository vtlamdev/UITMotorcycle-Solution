-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 13, 2022 lúc 04:27 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sql_uitmotorcycle`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cthd`
--

CREATE TABLE `cthd` (
  `SOHD` int(10) NOT NULL,
  `MASP` int(10) NOT NULL,
  `SL` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MASP` int(10) NOT NULL,
  `MAKH` int(10) NOT NULL,
  `SOLUONG` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hangxe`
--

CREATE TABLE `hangxe` (
  `MAHANG` int(10) NOT NULL,
  `TENHANG` char(50) DEFAULT NULL,
  `URLIMAGE` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hangxe`
--

INSERT INTO `hangxe` (`MAHANG`, `TENHANG`, `URLIMAGE`) VALUES
(1, 'Honda', 'Asset/DB-Picture/Honda.png'),
(2, 'Suzuki', 'Asset/DB-Picture/Suzuki.png'),
(3, 'Yamaha', 'Asset/DB-Picture/Yamaha.png'),
(4, 'SYM', 'Asset/DB-Picture/SYM.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `SOHD` int(10) NOT NULL,
  `NGHD` datetime NOT NULL,
  `MAKH` int(10) NOT NULL,
  `TRIGIA` bigint(255) NOT NULL,
  `TRANGTHAI` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MAKH` int(10) NOT NULL,
  `HOTEN` varchar(100) DEFAULT NULL,
  `DCHI` varchar(200) DEFAULT NULL,
  `SODT` varchar(12) DEFAULT NULL,
  `NGSINH` date DEFAULT NULL,
  `NGDK` date DEFAULT NULL,
  `SODU` bigint(255) NOT NULL,
  `khachhang_ip` varchar(100) DEFAULT NULL,
  `GIOITINH` varchar(40) DEFAULT NULL,
  `SOCCCD` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MAKH`, `HOTEN`, `DCHI`, `SODT`, `NGSINH`, `NGDK`, `SODU`, `khachhang_ip`, `GIOITINH`, `SOCCCD`) VALUES
(1, 'Nguyễn Gia Huy', '6A đường 5', '0909776624', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '::1', 'Nam', '123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaixe`
--

CREATE TABLE `loaixe` (
  `LOAIXE` int(2) NOT NULL,
  `TENLOAI` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaixe`
--

INSERT INTO `loaixe` (`LOAIXE`, `TENLOAI`) VALUES
(1, 'Xe số'),
(2, 'Xe tay ga'),
(3, 'Xe phân khối lớn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `naptien`
--

CREATE TABLE `naptien` (
  `MANAPTIEN` int(10) NOT NULL,
  `MAKH` int(10) NOT NULL,
  `SOTIEN` bigint(255) NOT NULL,
  `NGAYNAP` date NOT NULL,
  `SOTAIKHOAN` varchar(40) NOT NULL,
  `DADUYET` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MASP` int(10) NOT NULL,
  `MAHANG` int(10) DEFAULT NULL,
  `TENSP` varchar(200) DEFAULT NULL,
  `PHANKHOI` varchar(20) DEFAULT NULL,
  `MAU` varchar(20) DEFAULT NULL,
  `NAMSX` varchar(4) DEFAULT NULL,
  `GIA` int(20) DEFAULT NULL,
  `LOAIXE` int(2) DEFAULT NULL,
  `URL_IMAGE` varchar(200) DEFAULT NULL,
  `IS_ACTIVE` int(1) NOT NULL,
  `SOLUONG` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MASP`, `MAHANG`, `TENSP`, `PHANKHOI`, `MAU`, `NAMSX`, `GIA`, `LOAIXE`, `URL_IMAGE`, `IS_ACTIVE`, `SOLUONG`) VALUES
(1, 1, 'CB150R The Streetster', '150cc', 'Đen', '2022', 105500000, 3, 'Asset/DB-Picture/XPKL_1.png', 1, 100),
(2, 1, 'Gold Wing', '1833cc', 'Đen', '2022', 123100000, 3, 'Asset/DB-Picture/XPKL_10.png', 1, 80),
(3, 1, 'Gold Wing', '1833cc', 'Trắng', '2022', 123100000, 3, 'Asset/DB-Picture/XPKL_11.png', 1, 45),
(4, 2, 'GSX-S150', '150cc', 'Đen', '2022', 145000000, 3, 'Asset/DB-Picture/XPKL_12.jpg', 1, 65),
(5, 2, 'GSX-S150', '150cc', 'Xanh Đen', '2022', 145000000, 3, 'Asset/DB-Picture/XPKL_13.jpg', 1, 110),
(6, 2, 'Satria F150', '150cc', 'Đen', '2022', 59000000, 3, 'Asset/DB-Picture/XPKL_14.png', 1, 103),
(7, 3, 'MT-07', '689cc', 'Xanh', '2022', 259000000, 3, 'Asset/DB-Picture/XPKL_15.jpg', 1, 89),
(8, 3, 'MT-07', '689cc', 'Đen', '2022', 259000000, 3, 'Asset/DB-Picture/XPKL_16.jpg', 1, 142),
(9, 3, 'MT-10', '998cc', 'Đen', '2022', 439000000, 3, 'Asset/DB-Picture/XPKL_17.jpg', 1, 78),
(10, 3, 'MT-10', '998cc', 'Xám', '2022', 439000000, 3, 'Asset/DB-Picture/XPKL_18.jpg', 1, 56),
(11, 3, 'Tracer 9', '890cc', 'Đỏ', '2022', 369000000, 3, 'Asset/DB-Picture/XPKL_19.jpg', 1, 87),
(12, 1, 'Winner X', '150cc', 'Trắng Đen', '2022', 46160000, 3, 'Asset/DB-Picture/XPKL_2.png', 1, 88),
(13, 3, 'Tracer 9', '890cc', 'Đen', '2022', 369000000, 3, 'Asset/DB-Picture/XPKL_20.jpg', 1, 100),
(14, 1, 'Winner X', '150cc', 'Bạc Đen', '2022', 46160000, 3, 'Asset/DB-Picture/XPKL_3.png', 1, 86),
(15, 1, 'Winner X', '150cc', 'Đỏ Đen', '2022', 46160000, 3, 'Asset/DB-Picture/XPKL_5.png', 1, 112),
(16, 1, 'Winner X', '150cc', 'Đỏ Đen Xanh', '2022', 46160000, 3, 'Asset/DB-Picture/XPKL_4.png', 1, 114),
(17, 1, 'Winner X', '150cc', 'Đen vàng', '2022', 46160000, 3, 'Asset/DB-Picture/XPKL_6.png', 1, 140),
(18, 1, 'Rebel 1100', '1084cc', 'Đen', '2022', 449000000, 3, 'Asset/DB-Picture/XPKL_7.png', 1, 152),
(19, 1, 'Rebel 1100', '1084cc', 'Nâu', '2022', 449000000, 3, 'Asset/DB-Picture/XPKL_8.png', 1, 123),
(20, 1, 'Gold Wing', '1833cc', 'Xanh', '2022', 123100000, 3, 'Asset/DB-Picture/XPKL_9.png', 1, 142),
(21, 1, 'Wave Alpha 110cc phiên bản 2023', '110cc', 'Đỏ, bạc', '2022', 17859273, 1, 'Asset/DB-Picture/xs01.png', 1, 144),
(22, 1, 'Future 125 FI', '125cc', 'Trắng, đen', '2020', 31506545, 1, 'Asset/DB-Picture/xs10.png', 1, 165),
(23, 1, 'Future 125 FI', '125cc', 'Xanh, đen', '2020', 31506545, 1, 'Asset/DB-Picture/xs11.png', 1, 98),
(24, 1, 'Future 125 FI', '125cc', 'Đỏ, đen', '2020', 31506545, 1, 'Asset/DB-Picture/xs12.png', 1, 100),
(25, 1, 'Future 125 FI', '125cc', 'Đen', '2020', 31997455, 1, 'Asset/DB-Picture/xs13.png', 1, 120),
(26, 1, 'Future 125 FI', '125cc', 'Xanh, đen', '2020', 31997455, 1, 'Asset/DB-Picture/xs14.png', 1, 124),
(27, 1, 'Future 125 FI', '125cc', 'Đỏ, đen', '2020', 30328363, 1, 'Asset/DB-Picture/xs15.png', 1, 79),
(28, 1, 'Future 125 FI', '125cc', 'Xanh, đen', '2020', 30328363, 1, 'Asset/DB-Picture/xs16.png', 1, 142),
(29, 1, 'Super Cub C125', '125cc', 'Đen', '2021', 86782909, 1, 'Asset/DB-Picture/xs17.png', 1, 152),
(30, 1, 'Super Cub C125', '125cc', 'Xanh, trắng', '2021', 85801091, 1, 'Asset/DB-Picture/xs18.png', 1, 45),
(31, 1, 'Super Cub C125', '125cc', 'Xanh, trắng', '2021', 85801091, 1, 'Asset/DB-Picture/xs19.png', 1, 87),
(32, 1, 'Wave Alpha 110cc phiên bản 2023', '110cc', 'Trắng, bạc', '2022', 17859273, 1, 'Asset/DB-Picture/xs02.png', 1, 66),
(33, 1, 'Super Cub C128', '125cc', 'Đỏ, trắng', '2021', 85801091, 1, 'Asset/DB-Picture/xs20.png', 1, 68),
(34, 1, 'Wave RSX FI 110', '110cc', 'Trắng, đen', '2020', 24633818, 1, 'Asset/DB-Picture/xs21.png', 1, 125),
(35, 1, 'Wave RSX FI 110', '110cc', 'Đỏ, đen', '2020', 24633818, 1, 'Asset/DB-Picture/xs22.png', 1, 120),
(36, 1, 'Wave RSX FI 110', '110cc', 'Xanh, đen', '2020', 24633818, 1, 'Asset/DB-Picture/xs23.png', 1, 100),
(37, 3, 'Exciter 150 Phiên bản RC', '150cc', 'Đen', '2020', 44800000, 1, 'Asset/DB-Picture/xs24.png', 1, 80),
(38, 3, 'Exciter 150 Phiên bản RC', '150cc', 'Đỏ, đen', '2020', 44800000, 1, 'Asset/DB-Picture/xs25.png', 1, 90),
(39, 3, 'Exciter 150 Phiên bản RC', '150cc', 'Xám, đen, cam', '2020', 44800000, 1, 'Asset/DB-Picture/xs26.png', 1, 50),
(40, 3, 'Exciter 150 Phiên bản RC', '150cc', 'Trắng, đỏ, đen', '2020', 44800000, 1, 'Asset/DB-Picture/xs27.png', 1, 75),
(41, 3, 'Jupiter FI Phiên bản tiêu chuẩn', '114cc', 'Đen', '2022', 30000000, 1, 'Asset/DB-Picture/xs28.png', 1, 80),
(42, 3, 'Jupiter FI Phiên bản tiêu chuẩn', '114cc', 'Đỏ, đen', '2022', 30000000, 1, 'Asset/DB-Picture/xs29.png', 1, 89),
(43, 1, 'Wave Alpha 110cc phiên bản 2023', '110cc', 'Xanh, bạc', '2022', 17859273, 1, 'Asset/DB-Picture/xs03.png', 1, 87),
(44, 3, 'Jupiter FINN Phiên bản cao cấp', '114cc', 'Vàng', '2022', 28000000, 1, 'Asset/DB-Picture/xs30.png', 1, 78),
(45, 3, 'Jupiter FINN Phiên bản cao cấp', '114cc', 'Bạc', '2022', 28000000, 1, 'Asset/DB-Picture/xs31.png', 1, 100),
(46, 3, 'Sirius Phiên bản phanh cơ màu mới', '110cc', 'Trắng, xanh', '2022', 20500000, 1, 'Asset/DB-Picture/xs32.png', 1, 145),
(47, 3, 'Sirius Phiên bản phanh cơ màu mới', '110cc', 'Xám, đen', '2022', 20500000, 1, 'Asset/DB-Picture/xs33.png', 1, 200),
(48, 3, 'Sirius FI Phiên bản phanh đĩa', '115cc', 'Đen, xám', '2021', 21000000, 1, 'Asset/DB-Picture/xs34.png', 1, 210),
(49, 3, 'Sirius FI Phiên bản phanh đĩa', '115cc', 'Đỏ, đen', '2021', 21000000, 1, 'Asset/DB-Picture/xs35.png', 1, 135),
(50, 3, 'Sirius FI Phiên bản phanh đĩa', '115cc', 'Trắng, xanh', '2021', 21000000, 1, 'Asset/DB-Picture/xs36.png', 1, 110),
(51, 4, 'Star SR 170 (ABS)', '175cc', 'Đen, đỏ', '2019', 52400000, 1, 'Asset/DB-Picture/xs37.jpg', 1, 124),
(52, 4, 'Star SR 170 (ABS)', '175cc', 'Đen, xanh', '2019', 52400000, 1, 'Asset/DB-Picture/xs38.jpg', 1, 97),
(53, 4, 'Elegant 110', '110cc', 'Xanh, đen', '2021', 16700000, 1, 'Asset/DB-Picture/xs39.jpg', 1, 78),
(54, 1, 'Wave Alpha 110cc phiên bản 2023', '110cc', 'Đen mờ', '2022', 18448364, 1, 'Asset/DB-Picture/xs04.png', 1, 54),
(55, 4, 'Elegant 110', '110cc', 'Đỏ, đen', '2021', 16700000, 1, 'Asset/DB-Picture/xs40.jpg', 1, 75),
(56, 4, 'Elegant 110', '110cc', 'Trắng, đen', '2021', 16700000, 1, 'Asset/DB-Picture/xs41.jpg', 1, 45),
(57, 4, 'Angela 50', '50cc', 'Xám, đen', '2021', 16800000, 1, 'Asset/DB-Picture/xs42.jpg', 1, 78),
(58, 4, 'Angela 50', '50cc', 'Trắng, đỏ', '2021', 16800000, 1, 'Asset/DB-Picture/xs43.jpg', 1, 87),
(59, 4, 'Angela 50', '50cc', 'Xanh, trắng', '2021', 16800000, 1, 'Asset/DB-Picture/xs44.jpg', 1, 100),
(60, 4, 'Galaxy 50', '50cc', 'Đen, cam (sơn mờ)', '2020', 17300000, 1, 'Asset/DB-Picture/xs45.jpg', 1, 145),
(61, 4, 'Galaxy 50', '50cc', 'Đỏ, đen', '2020', 16800000, 1, 'Asset/DB-Picture/xs46.jpg', 1, 156),
(62, 4, 'Elegant 50', '50cc', 'Đỏ, đen', '2020', 16000000, 1, 'Asset/DB-Picture/xs47.jpg', 1, 153),
(63, 4, 'Elegant 50', '50cc', 'Xanh, đen', '2020', 16000000, 1, 'Asset/DB-Picture/xs48.jpg', 1, 160),
(64, 1, 'Blade 110', '110cc', 'Đen, xanh, xám', '2020', 21295637, 1, 'Asset/DB-Picture/xs05.png', 1, 187),
(65, 1, 'Blade 110', '110cc', 'Đen, đỏ, xám', '2020', 21295637, 1, 'Asset/DB-Picture/xs06.png', 1, 198),
(66, 1, 'Blade 110', '110cc', 'Đen, xám', '2020', 21295637, 1, 'Asset/DB-Picture/xs07.png', 1, 98),
(67, 1, 'Blade 110', '110cc', 'Đỏ, đen', '2020', 18841091, 1, 'Asset/DB-Picture/xs08.png', 1, 201),
(68, 1, 'Blade 110', '110cc', 'Đen', '2020', 19822909, 1, 'Asset/DB-Picture/xs09.png', 1, 142),
(69, 1, 'Air Blade 125 Phiên bản Đặc biệt', '125cccc', 'Đen Vàng', '2022', 42502909, 2, 'Asset/DB-Picture/XTG_1.png', 1, 145),
(70, 1, 'Lead 125cc Cao cấp', '125cc', 'Xanh', '2022', 41226545, 2, 'Asset/DB-Picture/XTG_10.png', 1, 156),
(71, 1, 'Lead 125cc Cao cấp', '125cc', 'Xám', '2022', 41226545, 2, 'Asset/DB-Picture/XTG_11.png', 1, 142),
(72, 1, 'Lead 125cc Đặc biệt', '125cc', 'Đen', '2022', 42306454, 2, 'Asset/DB-Picture/XTG_12.png', 1, 125),
(73, 1, 'Lead 125cc Đặc biệt', '125cc', 'Bạc', '2022', 42306454, 2, 'Asset/DB-Picture/XTG_13.png', 1, 142),
(74, 1, 'Lead 125cc Tiêu chuẩn', '125cc', 'Trắng', '2022', 39066545, 2, 'Asset/DB-Picture/XTG_14.png', 1, 89),
(75, 1, 'Lead 125cc Tiêu chuẩn', '125cc', 'Đỏ', '2022', 39066545, 2, 'Asset/DB-Picture/XTG_15.png', 1, 78),
(76, 3, 'FreeGo Phiên bản Tiêu chuẩn màu mới', '125cc', 'Đỏ Đen', '2022', 29900000, 2, 'Asset/DB-Picture/XTG_16.png', 1, 145),
(77, 3, 'FreeGo Phiên bản Tiêu chuẩn màu mới', '125cc', 'Trắng Đen', '2022', 29900000, 2, 'Asset/DB-Picture/XTG_17.png', 1, 187),
(78, 3, 'FreeGo Phiên bản Tiêu chuẩn màu mới', '125cc', 'Đen', '2022', 29900000, 2, 'Asset/DB-Picture/XTG_18.png', 1, 87),
(79, 3, 'FreeGo S Phiên bản Đặc biệt màu mới', '125cc', 'Đỏ Đen', '2022', 33800000, 2, 'Asset/DB-Picture/XTG_19.png', 1, 89),
(80, 1, 'Air Blade 125 Phiên bản Tiêu chuẩn', '125cc', 'Xanh Đen', '2022', 41324727, 2, 'Asset/DB-Picture/XTG_2.png', 1, 85),
(81, 3, 'FreeGo S Phiên bản Đặc biệt màu mới', '125cc', 'Xám Đen', '2022', 33800000, 2, 'Asset/DB-Picture/XTG_20.png', 1, 142),
(82, 3, 'FreeGo S Phiên bản Đặc biệt màu mới', '125cc', 'Xanh lá Đen', '2022', 33800000, 2, 'Asset/DB-Picture/XTG_21.png', 1, 132),
(83, 3, 'FreeGo S Phiên bản Đặc biệt màu mới', '125cc', 'Xanh Đen', '2022', 33800000, 2, 'Asset/DB-Picture/XTG_22.png', 1, 54),
(84, 3, 'Latte Phiên bản Tiêu chuẩn', '125cc', 'Đỏ Đen', '2022', 37800000, 2, 'Asset/DB-Picture/XTG_23.png', 1, 96),
(85, 3, 'Latte Phiên bản Tiêu chuẩn', '125cc', 'Trắng Đen', '2022', 37800000, 2, 'Asset/DB-Picture/XTG_24.png', 1, 47),
(86, 3, 'Latte Phiên bản Tiêu chuẩn', '125cc', 'Đen', '2022', 37800000, 2, 'Asset/DB-Picture/XTG_25.png', 1, 100),
(87, 3, 'Latte Phiên bản Giới hạn', '125cc', 'Bạc', '2022', 38300000, 2, 'Asset/DB-Picture/XTG_26.png', 1, 123),
(88, 3, 'Grande Blue Core Hybrid Phiên bản Tiêu chuẩn', '125cc', 'Đỏ Đen', '2022', 45200000, 2, 'Asset/DB-Picture/XTG_27.png', 1, 142),
(89, 3, 'Grande Blue Core Hybrid Phiên bản Tiêu chuẩn', '125cc', 'Trắng Đen', '2022', 45200000, 2, 'Asset/DB-Picture/XTG_28.png', 1, 125),
(90, 3, 'Grande Blue Core Hybrid Phiên bản Tiêu chuẩn', '125cc', 'Đen', '2022', 45200000, 2, 'Asset/DB-Picture/XTG_29.png', 1, 126),
(91, 1, 'Air Blade 125 Phiên bản Tiêu chuẩn', '125cc', 'Đỏ Đen', '2022', 41324727, 2, 'Asset/DB-Picture/XTG_3.png', 1, 120),
(92, 3, 'Grande Phiên bản Giới hạn hoàn toàn mới', '125cc', 'Hồng ánh đồng Đen', '2022', 51000000, 2, 'Asset/DB-Picture/XTG_30.png', 1, 102),
(93, 3, 'Grande Phiên bản Giới hạn hoàn toàn mới', '125cc', 'Bạc Đen', '2022', 51000000, 2, 'Asset/DB-Picture/XTG_31.png', 1, 103),
(94, 3, 'Grande Phiên bản Giới hạn hoàn toàn mới', '125cc', 'Xám Đen', '2022', 51000000, 2, 'Asset/DB-Picture/XTG_32.png', 1, 152),
(95, 3, 'Grande Phiên bản Giới hạn hoàn toàn mới', '125cc', 'Xanh Đen', '2022', 51000000, 2, 'Asset/DB-Picture/XTG_33.png', 1, 142),
(96, 2, 'Impulse 125 FI', '125cc', 'Đen Mờ', '2019', 31408000, 2, 'Asset/DB-Picture/XTG_34.png', 1, 120),
(97, 2, 'Impulse 125 FI', '125cc', 'Đen Mờ Xám', '2019', 31408000, 2, 'Asset/DB-Picture/XTG_35.png', 1, 90),
(98, 2, 'Impulse 125 FI', '125cc', 'Xanh Đỏ', '2019', 31408000, 2, 'Asset/DB-Picture/XTG_36.png', 1, 80),
(99, 2, 'Impulse 125 FI', '125cc', 'Trắng Nâu Bạc', '2019', 31408000, 2, 'Asset/DB-Picture/XTG_37.png', 1, 123),
(100, 2, 'Burgman Street', '125cc', 'Xám Mờ Vàng Đồng', '2022', 48600000, 2, 'Asset/DB-Picture/XTG_38.png', 1, 70),
(101, 2, 'Burgman Street', '125cc', 'Đen Vàng Đồng', '2022', 48600000, 2, 'Asset/DB-Picture/XTG_39.png', 1, 75),
(102, 1, 'Air Blade 160 Phiên bản Đặc biệt', '160cc', 'Xanh Xám Đen', '2022', 57190000, 2, 'Asset/DB-Picture/XTG_4.png', 1, 75),
(103, 2, 'Burgman Street', '125cc', 'Trắng Vàng Đồng', '2022', 48600000, 2, 'Asset/DB-Picture/XTG_40.png', 1, 152),
(104, 1, 'Air Blade 160 Phiên bản Tiêu chuẩn', '160cc', 'Đỏ Xám', '2022', 55990000, 2, 'Asset/DB-Picture/XTG_5.png', 1, 140),
(105, 1, 'Air Blade 160 Phiên bản Tiêu chuẩn', '160cc', 'Đen Xám', '2022', 55990000, 2, 'Asset/DB-Picture/XTG_6.png', 1, 100),
(106, 1, 'Air Blade 160 Phiên bản Tiêu chuẩn', '160cc', 'Xanh Xám', '2022', 55990000, 2, 'Asset/DB-Picture/XTG_7.png', 1, 80),
(107, 1, 'Lead 125cc Cao cấp', '125cc', 'Trắng', '2022', 41226545, 2, 'Asset/DB-Picture/XTG_8.png', 1, 88),
(108, 1, 'Lead 125cc Cao cấp', '125cc', 'Đỏ', '2022', 41226545, 2, 'Asset/DB-Picture/XTG_9.png', 1, 94);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `tendangnhap` varchar(100) NOT NULL,
  `MAKH` int(10) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `khachhang_ip` varchar(100) NOT NULL,
  `is_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`tendangnhap`, `MAKH`, `matkhau`, `email`, `khachhang_ip`, `is_admin`) VALUES
('huygia0811', 1, '$2y$10$JdGfxS./bwvqhm90gnY8Ye28FPfDBvNuMGh8.7Mm8XtXZ76uEeMbG', '20520203@gm.uit.edu.vn', '::1', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cthd`
--
ALTER TABLE `cthd`
  ADD KEY `fk01_CTHD` (`MASP`),
  ADD KEY `fk02_CTHD` (`SOHD`);
ALTER TABLE `cthd`
  ADD PRIMARY KEY (`MASP`, `SOHD`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD KEY `fk01_GH` (`MASP`),
  ADD KEY `fk02_GH` (`MAKH`);
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`MASP`, `MAKH`);
--
-- Chỉ mục cho bảng `hangxe`
--
ALTER TABLE `hangxe`
  ADD PRIMARY KEY (`MAHANG`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`SOHD`),
  ADD KEY `fk01_HD` (`MAKH`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MAKH`);

--
-- Chỉ mục cho bảng `loaixe`
--
ALTER TABLE `loaixe`
  ADD PRIMARY KEY (`LOAIXE`);

--
-- Chỉ mục cho bảng `naptien`
--
ALTER TABLE `naptien`
  ADD PRIMARY KEY (`MANAPTIEN`),
  ADD KEY `fk01_NT` (`MAKH`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MASP`),
  ADD KEY `fk01_SANPHAM` (`MAHANG`),
  ADD KEY `fk02_LOAIXE` (`LOAIXE`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`tendangnhap`),
  ADD KEY `fk01_TK` (`MAKH`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `hangxe`
--
ALTER TABLE `hangxe`
  MODIFY `MAHANG` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `SOHD` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MAKH` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `loaixe`
--
ALTER TABLE `loaixe`
  MODIFY `LOAIXE` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `naptien`
--
ALTER TABLE `naptien`
  MODIFY `MANAPTIEN` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MASP` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cthd`
--
ALTER TABLE `cthd`
  ADD CONSTRAINT `fk01_CTHD` FOREIGN KEY (`MASP`) REFERENCES `sanpham` (`MASP`),
  ADD CONSTRAINT `fk02_CTHD` FOREIGN KEY (`SOHD`) REFERENCES `hoadon` (`SOHD`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `fk01_GH` FOREIGN KEY (`MASP`) REFERENCES `sanpham` (`MASP`),
  ADD CONSTRAINT `fk02_GH` FOREIGN KEY (`MAKH`) REFERENCES `khachhang` (`MAKH`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk01_HD` FOREIGN KEY (`MAKH`) REFERENCES `khachhang` (`MAKH`);

--
-- Các ràng buộc cho bảng `naptien`
--
ALTER TABLE `naptien`
  ADD CONSTRAINT `fk01_NT` FOREIGN KEY (`MAKH`) REFERENCES `khachhang` (`MAKH`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk01_SANPHAM` FOREIGN KEY (`MAHANG`) REFERENCES `hangxe` (`MAHANG`),
  ADD CONSTRAINT `fk02_LOAIXE` FOREIGN KEY (`LOAIXE`) REFERENCES `loaixe` (`LOAIXE`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `fk01_TK` FOREIGN KEY (`MAKH`) REFERENCES `khachhang` (`MAKH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
