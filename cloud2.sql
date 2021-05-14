-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 14, 2021 lúc 02:13 AM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cloud2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `uid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`uid`, `username`, `fullname`, `email`, `password`) VALUES
('eumowvrfui8mu100xwmu', 'lvminh98', 'John McTavish', 'lvminh98@gmail.com', '6df73cc169278dd6daab5fe7d6cacb1fed537131'),
('pwcjlo8joukv6membwoi', 'lvminh', 'Lương Văn Minh', 'minh.luong@samsung.com', '6df73cc169278dd6daab5fe7d6cacb1fed537131');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item`
--

CREATE TABLE `item` (
  `item_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `share_mode` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'mode_private'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `item`
--

INSERT INTO `item` (`item_id`, `path`, `type`, `parent_id`, `time`, `share_mode`) VALUES
('08ub0tw9nhz1mtth1pnv9knio', 'Root_pwcjlo8joukv6membwoi/Folder A/Picturesss/Camera Roll', 'folder', 'u4madj17oz3gqtjpu9nprvy98', '2021-03-29 17:52:42', 'mode_private'),
('0bge1hc10i75huhogge30jw1n', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP/sohokhau02.jpg', 'image/jpeg', 'x1q3riasxv43exeuonsvkz4ps', '2021-03-29 21:27:06', 'mode_private'),
('0hp4yypmk3rdv1t6ls72rcq1v', 'Root_pwcjlo8joukv6membwoi/SVMC2', 'folder', 'Root_pwcjlo8joukv6membwoi', '2021-03-29 21:27:05', 'mode_normal'),
('0sbbvxykmxuue5kujby3itmqe', 'Root_pwcjlo8joukv6membwoi/Pictures/white.jpg', 'image/jpeg', 'n19bi7jq98iuxzd90hu8uopsz', '2021-03-29 17:53:38', 'mode_private'),
('1iz14mijfs7wl2z8onnlfgp4r', 'Root_pwcjlo8joukv6membwoi/Pictures/Camera Roll', 'folder', 'n19bi7jq98iuxzd90hu8uopsz', '2021-03-29 17:53:38', 'mode_private'),
('1utqcduff0343ag94psj61cy7', 'Root_pwcjlo8joukv6membwoi/Folder A/Picturesss/Camera Roll/desktop.ini', 'application/octet-stream', '08ub0tw9nhz1mtth1pnv9knio', '2021-03-29 17:52:42', 'mode_private'),
('27rcm5q8rc2rfj7jysr0rines', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP/cmt02.jpg', 'image/jpeg', 'x1q3riasxv43exeuonsvkz4ps', '2021-03-29 21:27:06', 'mode_private'),
('2u0zy8ir8dkfmv9n5mkiuqf5v', 'Root_pwcjlo8joukv6membwoi/Folder A/Picturesss/white.jpg', 'image/jpeg', 'u4madj17oz3gqtjpu9nprvy98', '2021-03-29 17:52:42', 'mode_private'),
('45lsp7ms9fikhm8cf76snat0r', 'Root_pwcjlo8joukv6membwoi/SVMC2/YEP 2020/20201225_145109.jpg', 'image/jpeg', 'aq43gyw3kpi4y842hbuq9ca8c', '2021-03-29 21:28:38', 'mode_private'),
('7x1g66pe9lceopw355d04ezw0', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP/sohokhau01.jpg', 'image/jpeg', 'x1q3riasxv43exeuonsvkz4ps', '2021-03-29 21:27:06', 'mode_private'),
('7xgx7674j6ab3qwke1x3mz53n', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP/stk.jpg', 'image/jpeg', 'x1q3riasxv43exeuonsvkz4ps', '2021-03-29 21:27:06', 'mode_private'),
('amlvjxrcgtotif7rkduqafbp8', 'Root_pwcjlo8joukv6membwoi/Pictures/desktop.ini', 'application/octet-stream', 'n19bi7jq98iuxzd90hu8uopsz', '2021-03-29 17:53:38', 'mode_private'),
('aq43gyw3kpi4y842hbuq9ca8c', 'Root_pwcjlo8joukv6membwoi/SVMC2/YEP 2020', 'folder', '0hp4yypmk3rdv1t6ls72rcq1v', '2021-03-29 21:27:05', 'mode_private'),
('b7uyhaav17fj055j8fuuuotmm', 'Root_pwcjlo8joukv6membwoi/Pictures/Camera Roll/desktop.ini', 'application/octet-stream', '1iz14mijfs7wl2z8onnlfgp4r', '2021-03-29 17:53:38', 'mode_private'),
('biuh6v766xp8d3m4c9a4q0df1', 'Root_eumowvrfui8mu100xwmu/John MacTavish 001/N.H.Hau_MachPhatTanSoThap_ESP/index.h', 'text/plain', 't2bvbwtjcdviroy6sctjxemug', '2021-05-07 00:47:16', 'mode_private'),
('czgzj0x123y46d4tm3ghmauai', 'Root_pwcjlo8joukv6membwoi/Pictures/Saved Pictures/desktop.ini', 'application/octet-stream', 'x5zsecm5csdyrbzfjvuct72i2', '2021-03-29 17:53:38', 'mode_private'),
('d868q53eivwnt7bcpby7bjr12', 'Root_pwcjlo8joukv6membwoi/Folder BC', 'folder', 'Root_pwcjlo8joukv6membwoi', '2021-03-29 17:53:28', 'mode_private'),
('ej4o8002kr5rjqskfcrazauq2', 'Root_pwcjlo8joukv6membwoi/SVMC2/YEP 2020/20201225_145422.jpg', 'image/jpeg', 'aq43gyw3kpi4y842hbuq9ca8c', '2021-03-29 21:27:05', 'mode_private'),
('gcwul16bri21743fmf8orxfh3', 'Root_eumowvrfui8mu100xwmu/John MacTavish 001/N.H.Hau_MachPhatTanSoThap_ESP/N.H.Hau_MachPhatTanSoThap_ESP.ino', 'application/octet-stream', 't2bvbwtjcdviroy6sctjxemug', '2021-05-07 00:47:16', 'mode_private'),
('hm0t9b9t4yy5v3pvcdk4kd0tn', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP/Thumbs.db', 'application/octet-stream', 'x1q3riasxv43exeuonsvkz4ps', '2021-03-29 21:27:06', 'mode_private'),
('ijzm504gbiqs3lv8e8z65lexg', 'Root_pwcjlo8joukv6membwoi/Folder A/Picturesss/Saved Pictures', 'folder', 'u4madj17oz3gqtjpu9nprvy98', '2021-03-29 17:52:42', 'mode_private'),
('n19bi7jq98iuxzd90hu8uopsz', 'Root_pwcjlo8joukv6membwoi/Pictures', 'folder', 'Root_pwcjlo8joukv6membwoi', '2021-03-29 17:53:38', 'mode_private'),
('nkavq4ktdh0ibm0zkjopc9yn8', 'Root_pwcjlo8joukv6membwoi/Folder A', 'folder', 'Root_pwcjlo8joukv6membwoi', '2021-03-29 17:51:21', 'mode_normal'),
('oydtnb6t0qjfewxfz9u1em5ga', 'Root_eumowvrfui8mu100xwmu/John MacTavish 001', 'folder', 'Root_eumowvrfui8mu100xwmu', '2021-05-07 00:46:30', 'mode_normal'),
('r95qgltxnth0y1zh6k8y15i5w', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP/cmt01.jpg', 'image/jpeg', 'x1q3riasxv43exeuonsvkz4ps', '2021-03-29 21:27:06', 'mode_private'),
('Root_eumowvrfui8mu100xwmu', 'Root_eumowvrfui8mu100xwmu', 'folder', 'root', '2021-05-06 23:31:51', 'mode_private'),
('Root_pwcjlo8joukv6membwoi', 'Root_pwcjlo8joukv6membwoi', 'folder', 'root', '2021-03-28 12:44:03', 'mode_private'),
('s84wu1zy1mh5396vdctnz5mcs', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP/37011773_1761408810617244_5952541779940081664_n.jpg', 'image/jpeg', 'x1q3riasxv43exeuonsvkz4ps', '2021-03-29 21:27:05', 'mode_private'),
('t2bvbwtjcdviroy6sctjxemug', 'Root_eumowvrfui8mu100xwmu/John MacTavish 001/N.H.Hau_MachPhatTanSoThap_ESP', 'folder', 'oydtnb6t0qjfewxfz9u1em5ga', '2021-05-07 00:47:16', 'mode_private'),
('tzrzshyqainu1bcxd4geui1l5', 'Root_pwcjlo8joukv6membwoi/Folder A/Picturesss/desktop.ini', 'application/octet-stream', 'u4madj17oz3gqtjpu9nprvy98', '2021-03-29 17:52:42', 'mode_private'),
('u4madj17oz3gqtjpu9nprvy98', 'Root_pwcjlo8joukv6membwoi/Folder A/Picturesss', 'folder', 'nkavq4ktdh0ibm0zkjopc9yn8', '2021-03-29 17:52:42', 'mode_private'),
('uearl6mf69dgzxsdkt8kmayzj', 'Root_pwcjlo8joukv6membwoi/Folder A/Picturesss/Saved Pictures/desktop.ini', 'application/octet-stream', 'ijzm504gbiqs3lv8e8z65lexg', '2021-03-29 17:52:42', 'mode_private'),
('v3fwlbnye3ojzxsan7mc9xmzv', 'Root_pwcjlo8joukv6membwoi/296.jpg', 'image/jpeg', 'Root_pwcjlo8joukv6membwoi', '2021-05-03 23:50:37', 'mode_normal'),
('x1q3riasxv43exeuonsvkz4ps', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP', 'folder', '0hp4yypmk3rdv1t6ls72rcq1v', '2021-03-29 21:27:05', 'mode_private'),
('x5zsecm5csdyrbzfjvuct72i2', 'Root_pwcjlo8joukv6membwoi/Pictures/Saved Pictures', 'folder', 'n19bi7jq98iuxzd90hu8uopsz', '2021-03-29 17:53:38', 'mode_private'),
('z2ief0hj5a934wvxrhqkc3959', 'Root_pwcjlo8joukv6membwoi/237.jpg', 'image/jpeg', 'Root_pwcjlo8joukv6membwoi', '2021-05-03 23:50:37', 'mode_private'),
('zamaidyz2otx7o7xjf5jck39g', 'Root_pwcjlo8joukv6membwoi/294.jpg', 'image/jpeg', 'Root_pwcjlo8joukv6membwoi', '2021-05-03 23:50:37', 'mode_private'),
('zlqcbsauk4gbzpd5bp4hc9cpb', 'Root_pwcjlo8joukv6membwoi/SVMC2/STP/70334818_525811754909025_9223073802915676160_n.jpg', 'image/jpeg', 'x1q3riasxv43exeuonsvkz4ps', '2021-03-29 21:27:06', 'mode_private');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `owner`
--

CREATE TABLE `owner` (
  `uid` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `own` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `owner`
--

INSERT INTO `owner` (`uid`, `item_id`, `own`) VALUES
('eumowvrfui8mu100xwmu', '0hp4yypmk3rdv1t6ls72rcq1v', 'writeable'),
('eumowvrfui8mu100xwmu', 'nkavq4ktdh0ibm0zkjopc9yn8', 'readonly'),
('eumowvrfui8mu100xwmu', 'Root_eumowvrfui8mu100xwmu', 'owner'),
('eumowvrfui8mu100xwmu', 'v3fwlbnye3ojzxsan7mc9xmzv', 'readonly'),
('pwcjlo8joukv6membwoi', 'oydtnb6t0qjfewxfz9u1em5ga', 'writeable'),
('pwcjlo8joukv6membwoi', 'Root_pwcjlo8joukv6membwoi', 'owner');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`uid`);

--
-- Chỉ mục cho bảng `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Chỉ mục cho bảng `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`uid`,`item_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
