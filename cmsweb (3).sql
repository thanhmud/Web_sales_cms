-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 21, 2020 lúc 01:34 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cmsweb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` double NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `send_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_details`
--

CREATE TABLE `bill_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bill` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stt` int(11) NOT NULL DEFAULT 0,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `media_id` bigint(20) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `stt`, `desc`, `parent_id`, `media_id`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'danhmuc1', 0, 'add_pro', 0, 1, 2, 2, NULL, NULL),
(2, 'danhmuc2', 0, 'add_pro', 0, 1, 2, 2, NULL, NULL),
(3, 'danhmuc3', 0, 'add_pro', 0, 1, 2, 2, NULL, NULL),
(4, 'danh muc 1', 0, 'add_pro', 0, 1, 1, 2, NULL, NULL),
(5, 'danh muc 2', 0, 'add_pro', 0, 1, 1, 2, NULL, NULL),
(6, 'danh muc 3', 0, 'add_pro', 0, 1, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_link`
--

CREATE TABLE `category_link` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `link_id` bigint(20) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category_link`
--

INSERT INTO `category_link` (`id`, `category_id`, `link_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, '2020-12-11 02:25:34', NULL),
(2, 2, 2, 2, '2020-12-11 02:25:34', NULL),
(3, 3, 2, 2, '2020-12-11 02:25:34', NULL),
(4, 1, 1, 2, '2020-12-11 02:25:51', NULL),
(5, 2, 1, 2, '2020-12-11 02:25:51', NULL),
(6, 2, 3, 2, '2020-12-11 02:26:33', NULL),
(7, 3, 3, 2, '2020-12-11 02:26:33', NULL),
(8, 4, 2, 1, '2020-12-13 23:12:09', NULL),
(9, 5, 2, 1, '2020-12-13 23:12:09', NULL),
(10, 4, 3, 1, '2020-12-13 23:12:39', NULL),
(11, 6, 3, 1, '2020-12-13 23:12:39', NULL),
(12, 4, 4, 1, '2020-12-13 23:13:07', NULL),
(13, 5, 4, 1, '2020-12-13 23:13:07', NULL),
(16, 4, 8, 1, '2020-12-14 19:44:21', NULL),
(17, 5, 8, 1, '2020-12-14 19:44:21', NULL),
(20, 4, 9, 1, '2020-12-14 20:30:49', NULL),
(21, 5, 9, 1, '2020-12-14 20:30:49', NULL),
(22, 6, 9, 1, '2020-12-14 20:30:49', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `member_rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `title`, `content`, `firstname`, `lastname`, `email`, `status`, `member_rate`, `user_id`, `post_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'rate', 'rate', NULL, NULL, NULL, 1, '2', NULL, NULL, 3, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, 3, '2020-12-13 09:15:29', '2020-12-13 09:15:29'),
(4, NULL, 'SA', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:14:56', '2020-12-13 16:14:56'),
(5, NULL, 'SA', NULL, NULL, NULL, 1, '5', NULL, NULL, 2, '2020-12-13 16:14:56', '2020-12-13 16:14:56'),
(6, NULL, 'SA', NULL, NULL, NULL, 1, '5', NULL, NULL, 2, '2020-12-13 16:15:47', '2020-12-13 16:15:47'),
(7, NULL, 'SA', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:15:47', '2020-12-13 16:15:47'),
(8, NULL, 'SA', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:15:47', '2020-12-13 16:15:47'),
(9, NULL, 'SA', NULL, NULL, NULL, 1, '5', NULL, NULL, 2, '2020-12-13 16:15:47', '2020-12-13 16:15:47'),
(10, NULL, 'OE', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:17:38', '2020-12-13 16:17:38'),
(11, NULL, 'OE', NULL, NULL, NULL, 1, '4', NULL, NULL, 2, '2020-12-13 16:17:38', '2020-12-13 16:17:38'),
(12, NULL, 'RATE', NULL, NULL, NULL, 1, '3', NULL, NULL, 2, '2020-12-13 16:20:38', '2020-12-13 16:20:38'),
(13, NULL, 'RATE', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:20:38', '2020-12-13 16:20:38'),
(14, NULL, 'sada', NULL, NULL, NULL, 1, '5', NULL, NULL, 2, '2020-12-13 16:36:02', NULL),
(15, NULL, 'sada', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:36:02', NULL),
(16, NULL, 'sada á', NULL, NULL, NULL, 1, '3', NULL, NULL, 2, '2020-12-13 16:37:07', NULL),
(17, NULL, 'sada á', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:37:07', NULL),
(18, NULL, 'sada á', NULL, NULL, NULL, 1, '5', NULL, NULL, 1, '2020-12-13 16:38:02', NULL),
(19, NULL, 'sada á', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:38:02', NULL),
(20, NULL, 'sad', NULL, NULL, NULL, 1, '5', NULL, NULL, 2, '2020-12-13 16:38:34', NULL),
(21, NULL, 'sad', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-12-13 16:38:34', NULL),
(22, 'bài viết', 'bài viết', NULL, NULL, NULL, 2, '0', NULL, 1, NULL, NULL, NULL),
(23, NULL, 'SADSA', 'sada', 'Thành', 'thanhmud1906@gmail.com', 1, NULL, NULL, NULL, NULL, '2020-12-13 21:22:30', NULL),
(24, NULL, 'SADSA', 'sada', 'Thành', 'thanhmud1906@gmail.com', 1, '4', NULL, NULL, 2, '2020-12-13 21:22:30', NULL),
(25, NULL, 'raat tot', 'sada', 'Thành', 'thanhmud1906@gmail.com', 1, NULL, NULL, NULL, NULL, '2020-12-13 21:30:19', NULL),
(26, NULL, 'raat tot', 'sada', 'Thành', 'thanhmud1906@gmail.com', 2, '4', NULL, NULL, 2, '2020-12-13 21:30:19', NULL),
(27, NULL, 'raat tot', 'Tuan', 'tuan', 'thanhmud19061@gmail.com', 2, '5', NULL, NULL, 2, '2020-12-13 21:32:56', NULL),
(28, NULL, 'raat tot', 'Tuan', 'tuan', 'thanhmud19061@gmail.com', 1, NULL, NULL, NULL, NULL, '2020-12-13 21:32:56', NULL),
(29, NULL, 'raat tot', 'Hoang', 'Hoang', 'thanhmud19061@gmail.com', 2, '2', NULL, NULL, 2, '2020-12-13 21:33:08', NULL),
(30, NULL, 'raat tot', 'Hoang', 'Hoang', 'thanhmud19061@gmail.com', 2, NULL, NULL, NULL, NULL, '2020-12-13 21:33:08', NULL),
(31, 'post_comment', 'sada', 'Thành', 'Thành', 'user1@gmail.com', 2, '0', NULL, 1, NULL, '2020-12-13 21:53:00', NULL),
(32, 'post_comment', 'sada sas', 'Thành 1', 'Thành 1', 'user12@gmail.com', 2, '0', NULL, 1, NULL, '2020-12-13 21:53:15', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment_post`
--

CREATE TABLE `comment_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `company`
--

CREATE TABLE `company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` bigint(20) DEFAULT NULL,
  `share_icon` bigint(20) DEFAULT NULL,
  `hotline` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iframe_map` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `favicon`, `share_icon`, `hotline`, `email`, `copyright`, `facebook`, `twitter`, `google`, `youtube`, `pinterest`, `instagram`, `iframe_map`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'thanh', 'Liên trung', 1, 2, 967461697, 'hoangtuanthanh@gmail.com', 'PD', 'than3', 'than3', 'than3', 'than4@gmail.com', 'than3', 'than3', 'than4@gmail.com', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `address`, `phone`, `content`, `status`, `type`, `created_at`, `updated_at`) VALUES
(5, NULL, 'user1@gmail.com', 'a', '0985756473', NULL, 2, NULL, '2020-12-16 00:59:42', '2020-12-17 08:16:34'),
(6, 'sada', 'sad', 'a', '0985756473', NULL, 1, NULL, '2020-12-16 01:03:42', NULL),
(7, 'sada', 'thanh1@gmail.com', 'a', '0985756473', NULL, 2, NULL, '2020-12-16 01:06:24', '2020-12-17 08:16:41'),
(8, 'sada', 'thanh1@gmail.com', 'a', '0985756473', NULL, 1, NULL, '2020-12-16 01:07:40', NULL),
(9, 'sada', 'user1@gmail.com', 'a', '0985756473', NULL, 2, NULL, '2020-12-16 01:08:19', '2020-12-17 08:16:52'),
(10, 'sada', 'thanh1@gmail.com', 'a', '0985756473', NULL, 1, NULL, '2020-12-16 01:09:57', NULL),
(11, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'sada', 1, NULL, '2020-12-16 01:10:54', NULL),
(12, 'dsaa', 'user1@gmail.com', 'a', '0985756473', 'dsadadad', 1, NULL, '2020-12-16 02:31:40', NULL),
(13, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'saddada', 1, NULL, '2020-12-16 02:32:47', NULL),
(14, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'fds', 1, NULL, '2020-12-16 02:34:10', NULL),
(15, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'saddssadad', 2, NULL, '2020-12-16 02:37:51', '2020-12-17 08:20:08'),
(16, 'sada', 'user1@gmail.com', 'a', '0985756473', 'sada', 1, NULL, '2020-12-16 02:38:48', NULL),
(17, 'sada', 'user1@gmail.com', 'a', '0985756473', 'sada', 1, NULL, '2020-12-16 02:39:10', NULL),
(18, 'sada', 'user1@gmail.com', 'a', '0985756473', 'sadaa', 1, NULL, '2020-12-16 02:41:55', NULL),
(19, 'sada', 'user1@gmail.com', 'a', '0985756473', 'sadsa', 1, NULL, '2020-12-16 02:42:26', NULL),
(20, 'sada', 'admin1@gmail.com', 'a', '0985756473', 'ádsa', 1, NULL, '2020-12-16 02:46:10', NULL),
(21, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'dsadsa', 1, NULL, '2020-12-16 02:47:21', NULL),
(22, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'sđâ', 1, NULL, '2020-12-16 02:49:42', NULL),
(23, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'sadaaa', 1, NULL, '2020-12-16 02:52:27', NULL),
(24, 'sada', 'user1@gmail.com', 'a', '0985756473', 'sad', 1, NULL, '2020-12-16 17:05:25', NULL),
(25, 'sada', 'user1@gmail.com', 'a', '0985756473', 'sad', 1, NULL, '2020-12-16 17:05:55', NULL),
(26, 'sada', 'sa1@gmail.com', 'a', '0985756473', 'ád', 1, NULL, '2020-12-16 17:06:19', NULL),
(27, 'sada', 'user1@gmail.com', 'a', '0985756473', 'ád', 1, NULL, '2020-12-16 17:07:39', NULL),
(28, 'sada', 'user1@gmail.com', 'a', '0985756473', 'ád', 1, NULL, '2020-12-16 17:07:52', NULL),
(29, 'sada', 'sa1@gmail.com', 'a', '0985756473', 'sdsadda', 1, NULL, '2020-12-16 17:08:19', NULL),
(30, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'sda', 1, NULL, '2020-12-16 17:09:34', NULL),
(31, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'sadsa', 1, NULL, '2020-12-16 17:10:31', NULL),
(32, 'sada', 'user1@gmail.com', 'a', '0985756473', 'sda', 1, NULL, '2020-12-16 17:12:52', NULL),
(33, 'sada', 'admin1@gmail.com', 'a', '0985756473', 'dsada', 1, NULL, '2020-12-16 17:13:30', NULL),
(34, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'sda', 1, NULL, '2020-12-16 17:15:35', NULL),
(35, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'sadsad', 1, NULL, '2020-12-16 17:16:50', NULL),
(36, 'sada', 'thanh1@gmail.com', 'a', '0985756473', 'ádsadsa', 1, NULL, '2020-12-16 17:19:26', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customs_product`
--

CREATE TABLE `customs_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_buy` tinyint(4) DEFAULT NULL,
  `is_payment_online` tinyint(4) DEFAULT NULL,
  `is_payment_code` tinyint(4) DEFAULT NULL,
  `is_management_store` tinyint(4) DEFAULT NULL,
  `is_report` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `form`
--

CREATE TABLE `form` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `form`
--

INSERT INTO `form` (`id`, `email_to`, `source_code`, `name`, `value`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'thanhmud1906@gmail.com', 'form3', '[contact_form_lienhe_day_du]', '<form id=\"form-data\" method=\"POST\"><input name=\"_token\" type=\"hidden\" value=\"{{csrf_token()}}\" />\r\n<div class=\"form-group row\">\r\n<div class=\"col-md-3\">T&ecirc;n của bạn:</div>\r\n\r\n<div class=\"col-md-9\"><input name=\"name\" id=\"name\" size=\"60\" type=\"text\" value=\"\" /></div>\r\n</div>\r\n\r\n<div class=\"form-group row\">\r\n<div class=\"col-md-3\">Email của bạn:</div>\r\n\r\n<div class=\"col-md-9\"><input name=\"email\" id=\"email\" size=\"60\" type=\"text\" value=\"\" /></div>\r\n</div>\r\n\r\n<div class=\"form-group row\">\r\n<div class=\"col-md-3\">Địa chỉ:</div>\r\n\r\n<div class=\"col-md-9\"><input name=\"address\" id=\"address\" size=\"60\" type=\"text\" value=\"\" /></div>\r\n</div>\r\n\r\n<div class=\"form-group row\">\r\n<div class=\"col-md-3\">Số điện thoại:</div>\r\n\r\n<div class=\"col-md-9\"><input name=\"phone\" id=\"phone\" size=\"60\" type=\"text\" value=\"\" /></div>\r\n</div>\r\n\r\n<div class=\"form-group row\">\r\n<div class=\"col-md-3\">Tin nhắn gửi:</div>\r\n\r\n<div class=\"col-md-9\"><textarea cols=\"63\" name=\"message\" id=\"message\" rows=\"10\"></textarea>\r\n\r\n<p><input type=\"button\" id=\"send_email\" value=\"Send email\" /></p>\r\n</div>\r\n</div>\r\n</form>', 2, '2020-12-16 01:02:09', '2020-12-16 01:02:09'),
(6, 'thanhmud1906@gmail.com', NULL, '[form_page_Form_lien_he_3_truong_68838]', '<div class=\"form-group row\">\r\n<div class=\"col-md-3\">T&ecirc;n của bạn:</div>\r\n\r\n<div class=\"col-md-9\"><input name=\"name\" size=\"60\" type=\"text\" value=\"\" /></div>\r\n</div>\r\n\r\n<div class=\"form-group row\">\r\n<div class=\"col-md-3\">Email của bạn:</div>\r\n\r\n<div class=\"col-md-9\"><input name=\"email\" size=\"60\" type=\"text\" value=\"\" /></div>\r\n</div>\r\n\r\n<div class=\"form-group row\">\r\n<div class=\"col-md-3\">Tin nhắn gửi:</div>\r\n\r\n<div class=\"col-md-9\"><textarea cols=\"63\" name=\"message\" rows=\"10\"></textarea>\r\n\r\n<p><input type=\"submit\" value=\"Send email\" /></p>\r\n</div>\r\n</div>\r\n\r\n<p>&quot;</p>\r\n\r\n<p>&quot;</p>', 2, '2020-12-15 21:51:20', '2020-12-15 21:51:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history`
--

CREATE TABLE `history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `history`
--

INSERT INTO `history` (`id`, `link_id`, `type`, `ip`, `location`, `created_at`, `updated_at`) VALUES
(2, '2', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 01:13:03', '2020-12-18 01:13:03'),
(3, '2', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:10:51', '2020-12-18 02:10:51'),
(4, '11', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:11:12', '2020-12-18 02:11:12'),
(5, '3', '2', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:11:27', '2020-12-18 02:11:27'),
(6, '2', '2', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:11:39', '2020-12-18 02:11:39'),
(7, '1', '2', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:14:34', '2020-12-18 02:14:34'),
(8, '4', '3', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:15:15', '2020-12-18 02:15:15'),
(9, '2', '4', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:16:10', '2020-12-18 02:16:10'),
(10, '4', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:16:43', '2020-12-18 02:16:43'),
(11, '4', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:44:39', '2020-12-18 02:44:39'),
(12, '4', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:44:56', '2020-12-18 02:44:56'),
(13, '3', '2', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:45:41', '2020-12-18 02:45:41'),
(14, '2', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:45:50', '2020-12-18 02:45:50'),
(15, '4', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:45:56', '2020-12-18 02:45:56'),
(16, '9', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:46:00', '2020-12-18 02:46:00'),
(17, '4', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:47:12', '2020-12-18 02:47:12'),
(18, '4', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:47:21', '2020-12-18 02:47:21'),
(19, '2', '1', '42.117.200.216', 'Ho Chi Minh City,Vietnam', '2020-12-18 02:47:25', '2020-12-18 02:47:25'),
(20, '2', '1', '118.69.20.90', ',Vietnam', '2020-12-21 00:22:48', '2020-12-21 00:22:48'),
(21, '3', '1', '118.69.20.90', ',Vietnam', '2020-12-21 00:22:56', '2020-12-21 00:22:56'),
(22, '2', '1', '118.69.20.90', ',Vietnam', '2020-12-21 00:23:01', '2020-12-21 00:23:01'),
(23, '2', '1', '118.69.20.90', ',Vietnam', '2020-12-21 02:35:11', '2020-12-21 02:35:11'),
(24, '3', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:35:26', '2020-12-21 02:35:26'),
(25, '3', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:35:32', '2020-12-21 02:35:32'),
(26, '2', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:35:36', '2020-12-21 02:35:36'),
(27, '2', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:35:37', '2020-12-21 02:35:37'),
(28, '2', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:36:23', '2020-12-21 02:36:23'),
(29, '3', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:36:29', '2020-12-21 02:36:29'),
(30, '2', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:36:34', '2020-12-21 02:36:34'),
(31, '3', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:36:38', '2020-12-21 02:36:38'),
(32, '3', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:37:29', '2020-12-21 02:37:29'),
(33, '3', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:37:38', '2020-12-21 02:37:38'),
(34, '2', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:37:43', '2020-12-21 02:37:43'),
(35, '2', '2', '118.69.20.90', ',Vietnam', '2020-12-21 02:37:46', '2020-12-21 02:37:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `media`
--

INSERT INTO `media` (`id`, `type`, `url`, `user_id`, `created_at`, `updated_at`) VALUES
(205, 2, '1607063792980user.jpg', 2, NULL, NULL),
(206, 2, '1607063792980user.jpg', 3, NULL, NULL),
(208, 1, '1607063792980user.jpg', 2, NULL, NULL),
(209, 1, '16076786108751606274056789galacupchienthang2018.jpg', 2, '2020-12-11 02:23:31', '2020-12-11 02:23:31'),
(210, 1, '16076786108781606274056793giải1 - Copy.png', 2, '2020-12-11 02:23:31', '2020-12-11 02:23:31'),
(211, 1, '16076786108791606274311456images (1).jpg', 2, '2020-12-11 02:23:32', '2020-12-11 02:23:32'),
(212, 1, '16076786108801606275045729galacupchienthang2018.jpg', 2, '2020-12-11 02:23:32', '2020-12-11 02:23:32'),
(213, 1, '16076786810301606444704507images (5).jpg', 2, '2020-12-11 02:24:41', '2020-12-11 02:24:41'),
(214, 1, '16076786810341606444704513images.jpg', 2, '2020-12-11 02:24:41', '2020-12-11 02:24:41'),
(215, 1, '16076786810381606444704518tải xuống (1).jpg', 2, '2020-12-11 02:24:41', '2020-12-11 02:24:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `type_id` tinyint(4) DEFAULT NULL,
  `link_id` bigint(20) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stt` int(11) DEFAULT 0,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `name`, `type`, `type_id`, `link_id`, `parent_id`, `icon`, `stt`, `url`, `user_id`, `created_at`, `updated_at`) VALUES
(76, 'danh muc 2', 3, NULL, 5, -1, NULL, 0, NULL, 2, '2020-12-15 23:08:02', NULL),
(77, 'danhmuc1', 4, NULL, 1, -1, NULL, 0, NULL, 2, '2020-12-15 23:08:02', NULL),
(78, 'danh muc 1', 3, NULL, 4, -1, NULL, 0, NULL, 2, '2020-12-15 23:08:02', NULL),
(79, 'danhmuc2', 4, NULL, 2, -1, NULL, 0, NULL, 2, '2020-12-15 23:08:02', NULL),
(80, 'Bài viết 3', 1, 0, 2, 76, NULL, 0, NULL, 2, '2020-12-15 23:08:02', NULL),
(81, 'sp3', 2, NULL, 3, 77, NULL, 0, NULL, 2, '2020-12-15 23:08:04', NULL),
(82, 'Bài viết 4', 1, 0, 3, 78, NULL, 0, NULL, 2, '2020-12-15 23:08:04', NULL),
(83, 'SP2', 2, NULL, 2, 79, NULL, 0, NULL, 2, '2020-12-15 23:08:05', NULL),
(84, 'Về chúng tôi', 1, 1, 7, -1, NULL, 0, NULL, 2, '2020-12-16 17:00:59', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_26_000036_create_post_table', 1),
(5, '2020_10_26_000105_create_media_table', 1),
(6, '2020_10_26_000106_create_product_table', 1),
(7, '2020_10_26_000107_create_history_table', 1),
(8, '2020_10_26_000108_create_comment_table', 1),
(9, '2020_10_26_000109_create_contact_table', 1),
(10, '2020_10_26_000114_create_category_table', 1),
(11, '2020_10_26_0001345_create_slide_table', 1),
(12, '2020_10_26_0001347_create_subscriber_table', 1),
(13, '2020_10_26_000244_create_category_link_table', 1),
(14, '2020_10_26_000353_create_menu_table', 1),
(15, '2020_10_26_000729_create_company_table', 1),
(16, '2020_10_26_015755_create_tag_table', 1),
(17, '2020_10_26_015937_create_tag_link_table', 1),
(18, '2020_10_26_020021_create_comment_post_table', 1),
(19, '2020_10_26_020156_create_product_media_table', 1),
(20, '2020_10_26_020156_create_product_tag_table', 1),
(21, '2020_10_26_000119_create_product_setting_table', 2),
(22, '2020_12_14_094819_create_form_table', 3),
(23, '2020_12_14_094818_create_form_table', 4),
(24, '2020_10_26_000119_create_customs_product_table', 5),
(25, '2020_10_26_000120_create_shop_info_table', 5),
(26, '2020_12_14_095036_create_bills_table', 5),
(27, '2020_12_14_095110_create_bill_details_table', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length_expect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allow_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_id` bigint(20) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `count` double NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `slug`, `title`, `content`, `length_expect`, `allow_comment`, `media_id`, `type`, `count`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'bai-viet-1', 'BÀI VIÊT 1', '<p>B&Agrave;I VI&Ecirc;T 1</p>', '<p>B&Agrave;I VI&Ecirc;T 1</p>', '1', 209, 0, 0, 2, '2020-12-11 02:27:49', NULL),
(2, 'bai-viet-3', 'Bài viết 3', NULL, '', '1', 210, 0, 3, 2, '2020-12-13 23:12:09', '2020-12-21 02:35:11'),
(3, 'bai-viet-4', 'Bài viết 4', NULL, '', '1', 213, 0, 1, 2, '2020-12-13 23:12:38', '2020-12-21 00:22:56'),
(4, 'bai-viet-5', 'Bài viết 5', NULL, '', '1', 215, 0, 0, 2, '2020-12-13 23:13:07', NULL),
(7, 've-chung-toi', 'Về chúng tôi', '<div class=\"container\">\n<div class=\"space-top-none\" id=\"content\">\n<div class=\"space50\">&nbsp;</div>\n\n<div class=\"row\">\n<div class=\"col-sm-8\">\n<h2>LI&Ecirc;N HỆ</h2>\n\n<div class=\"space20\">&nbsp;</div>\n\n<p>[contact_form_lienhe_day_du]</p>\n</div>\n\n<div class=\"col-sm-4\">\n<h2>Th&ocirc;ng tin li&ecirc;n hệ</h2>\n\n<div class=\"space20\">&nbsp;</div>\n\n<h6>Địa chỉ</h6>\n\n<p>Li&ecirc;n Trung - Đan Phượng<br />\nH&agrave; Nội</p>\n\n<div class=\"space20\">&nbsp;</div>\n\n<h6>Thắc mắc c&ocirc;ng việc</h6>\n\n<p>Mọi thắc mắc của c&aacute;c bạn xin h&atilde;y gửi về h&ograve;m mail của của h&agrave;ng ch&uacute;ng t&ocirc;i<br />\nCảm ơn bạn đ&atilde; quan t&acirc;m<br />\n<a href=\"mailto:hoangtuanthanh19061997@gmail.com\">hoangtuanthanh19061997@gmail.com</a></p>\n\n<div class=\"space30\">&nbsp;</div>\n</div>\n</div>\n</div>\n<!-- #content --></div>\n<!-- .container -->', '<div class=\"container\">\n<div class=\"space-top-none\" id=\"content\">\n<div class=\"sp', '1', NULL, 1, 0, 2, '2020-12-15 21:53:32', '2020-12-15 21:53:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `promotion_price` double DEFAULT 0,
  `count` int(11) DEFAULT 0,
  `product_media_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `slug`, `title`, `short_content`, `content`, `price`, `promotion_price`, `count`, `product_media_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'sp1', 'SP1', '', NULL, NULL, NULL, 0, '208', 2, '2020-12-11 02:25:50', '2020-12-11 02:25:50'),
(2, 'sp2', 'SP2', '<p>SP2</p>', '<p>SP2</p>', 111, NULL, 2, '208', 2, '2020-12-11 02:25:34', '2020-12-21 02:37:46'),
(3, 'sp3', 'sp3', '', NULL, 11111111, 11111, 2, '212', 2, '2020-12-11 02:26:33', '2020-12-21 02:37:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_media`
--

CREATE TABLE `product_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_media`
--

INSERT INTO `product_media` (`id`, `media_id`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 208, 2, '2020-12-11 02:25:35', NULL),
(4, 209, 2, '2020-12-11 02:25:35', NULL),
(5, 210, 2, '2020-12-11 02:25:35', NULL),
(7, 208, 1, '2020-12-11 02:25:51', NULL),
(8, 210, 3, '2020-12-11 02:26:33', NULL),
(9, 211, 3, '2020-12-11 02:26:33', NULL),
(10, 212, 3, '2020-12-11 02:26:33', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_tag`
--

CREATE TABLE `product_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shop_info`
--

CREATE TABLE `shop_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slide`
--

CREATE TABLE `slide` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slide`
--

INSERT INTO `slide` (`id`, `name`, `url`, `media_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 212, 1, '2020-12-12 18:41:03', NULL),
(2, NULL, 'da', 213, 1, '2020-12-12 18:41:51', NULL),
(3, NULL, NULL, 214, 1, '2020-12-12 18:42:09', NULL),
(4, NULL, 'ONEPIECE', 211, 2, '2020-12-13 01:49:49', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subscriber`
--

CREATE TABLE `subscriber` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tag`
--

CREATE TABLE `tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tag`
--

INSERT INTO `tag` (`id`, `name`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'tag 1', 1, 2, '2020-12-13 23:11:21', '2020-12-13 23:11:21'),
(2, 'tag 2', 1, 2, '2020-12-13 23:11:31', '2020-12-13 23:11:31'),
(3, 'tag 3', 1, 2, '2020-12-13 23:11:43', '2020-12-13 23:11:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tag_link`
--

CREATE TABLE `tag_link` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `link_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tag_link`
--

INSERT INTO `tag_link` (`id`, `type`, `post_id`, `link_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2020-12-13 23:12:09', NULL),
(2, 1, 2, 2, '2020-12-13 23:12:09', NULL),
(3, 1, 3, 2, '2020-12-13 23:12:39', NULL),
(4, 1, 3, 3, '2020-12-13 23:12:39', NULL),
(5, 1, 4, 1, '2020-12-13 23:13:07', NULL),
(6, 1, 4, 3, '2020-12-13 23:13:07', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `avatar`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Thanh', 'mud', '212', 'thanh', 'thanh1@gmail.com', NULL, '$2y$10$0Bf72GP1mx2d/RsiRHtxsu3nM.Tj2IyWvCkUuns55dohJXO40bWhe', NULL, '2020-12-12 18:44:16', '2020-12-12 18:44:16'),
(2, 'Thành', NULL, '207', 'user', 'user1@gmail.com', NULL, '$2y$10$ZvKu1yDVfPIHG12rdDNBWOsFcZc4OUWHvjD8DShCEHpupgFGZpNBO', NULL, NULL, NULL),
(3, 'Thành', NULL, '206', 'liên', 'liên1@gmail.com', NULL, '$2y$10$RB965Gq6yK4n/CMXYI1pHubcHMpPOAXkbLBeFku8eYKLMrEVxu9vO', NULL, NULL, NULL),
(4, 'Thành', NULL, '208', 'hạ', 'ha1@gmail.com', NULL, '$2y$10$BQYtFHtZV3tdysNtGBAs7u3s8Ds.a/FpXz5ODw3jH96XL.P4JC/E.', NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_details_id_bill_foreign` (`id_bill`),
  ADD KEY `bill_details_id_product_foreign` (`id_product`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `category_link`
--
ALTER TABLE `category_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_link_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_user_id_foreign` (`user_id`),
  ADD KEY `comment_post_id_foreign` (`post_id`),
  ADD KEY `comment_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `comment_post`
--
ALTER TABLE `comment_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_post_comment_id_foreign` (`comment_id`),
  ADD KEY `comment_post_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customs_product`
--
ALTER TABLE `customs_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_media_media_id_foreign` (`media_id`),
  ADD KEY `product_media_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_tag_tag_id_foreign` (`tag_id`),
  ADD KEY `product_tag_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slide_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `tag_link`
--
ALTER TABLE `tag_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_link_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `category_link`
--
ALTER TABLE `category_link`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `comment_post`
--
ALTER TABLE `comment_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `customs_product`
--
ALTER TABLE `customs_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `form`
--
ALTER TABLE `form`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `history`
--
ALTER TABLE `history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product_media`
--
ALTER TABLE `product_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `slide`
--
ALTER TABLE `slide`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tag_link`
--
ALTER TABLE `tag_link`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `bill_details_id_bill_foreign` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_details_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `category_link`
--
ALTER TABLE `category_link`
  ADD CONSTRAINT `category_link_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comment_post`
--
ALTER TABLE `comment_post`
  ADD CONSTRAINT `comment_post_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_media_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `slide`
--
ALTER TABLE `slide`
  ADD CONSTRAINT `slide_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tag_link`
--
ALTER TABLE `tag_link`
  ADD CONSTRAINT `tag_link_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
