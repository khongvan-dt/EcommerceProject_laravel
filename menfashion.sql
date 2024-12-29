-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 06:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `menfashion`
--

CREATE DATABASE menfashion;

USE menfashion;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Size', 0, '2024-12-09 05:40:02', '2024-12-09 05:40:02'),
(4, 'Color', 0, '2024-12-09 05:40:09', '2024-12-09 05:40:09'),
(8, 'Size', 0, '2024-12-09 05:55:13', '2024-12-09 05:55:13'),
(9, 'Color', 0, '2024-12-09 05:55:18', '2024-12-09 05:55:18'),
(10, 'Size', 0, '2024-12-09 06:00:51', '2024-12-09 06:00:51'),
(11, 'Color', 0, '2024-12-09 06:00:55', '2024-12-09 06:00:55'),
(12, 'Size', 0, '2024-12-09 06:06:47', '2024-12-09 06:06:47'),
(13, 'Color', 0, '2024-12-09 06:06:51', '2024-12-09 06:06:51'),
(14, 'Size', 0, '2024-12-09 06:13:02', '2024-12-09 06:13:02'),
(15, 'Color', 0, '2024-12-09 06:13:06', '2024-12-09 06:13:06'),
(16, 'Color', 0, '2024-12-09 06:18:13', '2024-12-09 06:18:13'),
(17, 'Size', 0, '2024-12-09 06:18:18', '2024-12-09 06:18:18'),
(18, 'Color', 0, '2024-12-09 06:22:05', '2024-12-09 06:22:05'),
(19, 'Size', 0, '2024-12-09 06:22:10', '2024-12-09 06:22:10'),
(20, 'Color', 0, '2024-12-09 06:28:05', '2024-12-09 06:28:05'),
(21, 'Size', 0, '2024-12-09 06:28:11', '2024-12-09 06:28:11'),
(22, 'Color', 0, '2024-12-09 06:33:00', '2024-12-09 06:33:00'),
(23, 'Size', 0, '2024-12-09 06:33:05', '2024-12-09 06:33:05'),
(24, 'Color', 0, '2024-12-09 06:40:04', '2024-12-09 06:40:04'),
(25, 'Size', 0, '2024-12-09 06:40:08', '2024-12-09 06:40:08'),
(26, 'Size', 0, '2024-12-09 06:43:55', '2024-12-09 06:43:55'),
(27, 'Color', 0, '2024-12-09 06:43:59', '2024-12-09 06:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attributeId` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `priceIn` decimal(8,2) NOT NULL,
  `priceOut` decimal(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attributeId`, `name`, `stock`, `priceIn`, `priceOut`, `status`, `created_at`, `updated_at`) VALUES
(4, 3, 'S', 43, 1450.00, 1799.00, 0, '2024-12-09 05:41:30', '2024-12-09 09:35:06'),
(5, 3, 'M', 50, 1450.00, 1799.00, 0, '2024-12-09 05:41:50', '2024-12-09 05:41:50'),
(6, 3, 'L', 40, 1450.00, 1799.00, 0, '2024-12-09 05:42:02', '2024-12-09 05:42:02'),
(7, 3, 'XL', 30, 1450.00, 1799.00, 0, '2024-12-09 05:42:26', '2024-12-09 05:42:26'),
(8, 4, 'Red', 50, 1450.00, 1799.00, 0, '2024-12-09 05:42:55', '2024-12-09 05:42:55'),
(9, 8, 'S', 50, 980.00, 1299.00, 0, '2024-12-09 05:56:01', '2024-12-09 05:56:01'),
(10, 8, 'M', 50, 980.00, 1299.00, 0, '2024-12-09 05:56:12', '2024-12-09 05:56:12'),
(11, 8, 'L', 40, 980.00, 1299.00, 0, '2024-12-09 05:56:23', '2024-12-09 05:56:23'),
(12, 8, 'XL', 40, 980.00, 1299.00, 0, '2024-12-09 05:56:33', '2024-12-09 05:56:33'),
(13, 9, 'Pink', 50, 980.00, 1299.00, 0, '2024-12-09 05:56:55', '2024-12-09 05:56:55'),
(14, 10, 'S', 30, 350.00, 459.00, 0, '2024-12-09 06:01:22', '2024-12-09 06:01:22'),
(15, 10, 'M', 40, 350.00, 459.00, 0, '2024-12-09 06:01:33', '2024-12-09 06:01:33'),
(16, 10, 'L', 50, 350.00, 459.00, 0, '2024-12-09 06:01:42', '2024-12-09 06:01:42'),
(17, 10, 'XL', 100, 350.00, 459.00, 0, '2024-12-09 06:01:53', '2024-12-09 06:01:53'),
(18, 10, 'XXL', 40, 350.00, 459.00, 0, '2024-12-09 06:02:09', '2024-12-09 06:02:09'),
(19, 11, 'White', 100, 350.00, 459.00, 0, '2024-12-09 06:02:31', '2024-12-09 06:02:31'),
(20, 11, 'Blue', 40, 350.00, 459.00, 0, '2024-12-09 06:02:53', '2024-12-09 06:02:53'),
(21, 11, 'Black', 100, 350.00, 459.00, 0, '2024-12-09 06:03:05', '2024-12-09 06:03:05'),
(22, 12, 'S', 40, 180.00, 249.00, 0, '2024-12-09 06:07:19', '2024-12-09 06:07:19'),
(23, 12, 'M', 50, 180.00, 259.00, 0, '2024-12-09 06:07:33', '2024-12-09 06:07:33'),
(24, 12, 'L', 100, 180.00, 249.00, 0, '2024-12-09 06:07:45', '2024-12-09 06:07:45'),
(25, 12, 'XL', 100, 180.00, 249.00, 0, '2024-12-09 06:07:56', '2024-12-09 06:07:56'),
(26, 13, 'Grey', 100, 180.00, 249.00, 0, '2024-12-09 06:08:25', '2024-12-09 06:08:25'),
(27, 13, 'Black', 100, 180.00, 249.00, 0, '2024-12-09 06:08:34', '2024-12-09 06:08:34'),
(28, 14, 'S', 40, 450.00, 599.00, 0, '2024-12-09 06:13:22', '2024-12-09 06:13:50'),
(29, 14, 'M', 40, 450.00, 599.00, 0, '2024-12-09 06:13:32', '2024-12-09 06:13:32'),
(30, 14, 'L', 100, 450.00, 599.00, 0, '2024-12-09 06:13:42', '2024-12-09 06:13:42'),
(31, 14, 'XL', 100, 450.00, 599.00, 0, '2024-12-09 06:14:06', '2024-12-09 06:14:06'),
(32, 14, 'XXL', 100, 450.00, 599.00, 0, '2024-12-09 06:14:15', '2024-12-09 06:14:15'),
(33, 15, 'Blue', 100, 450.00, 599.00, 0, '2024-12-09 06:14:40', '2024-12-09 06:14:40'),
(34, 15, 'White', 100, 450.00, 599.00, 0, '2024-12-09 06:14:51', '2024-12-09 06:14:51'),
(35, 17, 'S', 50, 270.00, 359.00, 0, '2024-12-09 06:18:45', '2024-12-09 06:18:45'),
(36, 17, 'M', 100, 270.00, 359.00, 0, '2024-12-09 06:18:56', '2024-12-09 06:18:56'),
(37, 17, 'L', 100, 270.00, 359.00, 0, '2024-12-09 06:19:07', '2024-12-09 06:19:07'),
(38, 16, 'Green', 100, 270.00, 359.00, 0, '2024-12-09 06:19:36', '2024-12-09 06:19:36'),
(39, 19, '29', 100, 470.00, 539.00, 0, '2024-12-09 06:22:35', '2024-12-09 06:22:35'),
(40, 19, '30', 100, 470.00, 539.00, 0, '2024-12-09 06:22:48', '2024-12-09 06:22:48'),
(41, 19, '31', 100, 470.00, 539.00, 0, '2024-12-09 06:23:02', '2024-12-09 06:23:02'),
(42, 18, 'Blue', 100, 470.00, 539.00, 0, '2024-12-09 06:23:20', '2024-12-09 06:23:20'),
(43, 20, 'Blue', 100, 300.00, 359.00, 0, '2024-12-09 06:28:29', '2024-12-09 06:28:29'),
(44, 21, '25', 40, 300.00, 359.00, 0, '2024-12-09 06:28:49', '2024-12-09 06:28:49'),
(45, 21, '26', 100, 300.00, 359.00, 0, '2024-12-09 06:29:01', '2024-12-09 06:29:01'),
(46, 21, '27', 100, 300.00, 359.00, 0, '2024-12-09 06:29:12', '2024-12-09 06:29:12'),
(47, 21, '28', 100, 300.00, 359.00, 0, '2024-12-09 06:29:28', '2024-12-09 06:29:28'),
(48, 21, '29', 100, 300.00, 359.00, 0, '2024-12-09 06:29:40', '2024-12-09 06:29:40'),
(49, 22, 'Pink', 50, 750.00, 820.00, 0, '2024-12-09 06:33:54', '2024-12-09 06:33:54'),
(50, 22, 'Black', 100, 720.00, 850.00, 0, '2024-12-09 06:34:05', '2024-12-09 06:34:05'),
(51, 22, 'Grey', 50, 720.00, 820.00, 0, '2024-12-09 06:34:24', '2024-12-09 06:34:24'),
(52, 23, 'S', 100, 720.00, 850.00, 0, '2024-12-09 06:34:50', '2024-12-09 06:34:50'),
(53, 23, 'M', 100, 720.00, 850.00, 0, '2024-12-09 06:35:01', '2024-12-09 06:35:01'),
(54, 24, 'Black', 100, 1150.00, 1399.00, 0, '2024-12-09 06:40:28', '2024-12-09 06:40:28'),
(55, 25, 'Size2', 100, 1120.00, 1399.00, 0, '2024-12-09 06:40:50', '2024-12-09 06:40:50'),
(56, 25, 'Size 4', 100, 1120.00, 1399.00, 0, '2024-12-09 06:41:05', '2024-12-09 06:41:05'),
(57, 25, 'Size 6', 100, 1120.00, 1399.00, 0, '2024-12-09 06:41:16', '2024-12-09 06:41:16'),
(58, 26, 'S', 100, 70.00, 139.00, 0, '2024-12-09 06:44:29', '2024-12-09 06:44:29'),
(59, 26, 'M', 100, 70.00, 139.00, 0, '2024-12-09 06:44:37', '2024-12-09 06:44:37'),
(60, 26, 'L', 70, 70.00, 139.00, 0, '2024-12-09 06:44:46', '2024-12-09 06:44:46'),
(61, 27, 'Grey', 100, 70.00, 139.00, 0, '2024-12-09 06:45:02', '2024-12-09 06:45:02'),
(62, 27, 'White', 70, 70.00, 139.00, 0, '2024-12-09 06:45:11', '2024-12-09 06:45:11'),
(63, 27, 'Black', 100, 70.00, 139.00, 0, '2024-12-09 06:45:22', '2024-12-09 06:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `content`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TOP Những Địa Điểm Chụp Ảnh Áo Dài Đẹp Nhất Dịp Cuối Năm', 'top-nhung-dia-diem-chup-anh-ao-dai-dep', 'Lựa chọn địa điểm chụp ảnh phù hợp là yếu tố quan trọng quyết định đến chất lượng và thông điệp của một bộ ảnh. Với trang phục truyền thống như áo dài, bạn cần chọn địa điểm chụp thế nào cho phù hợp? \r\nDưới đây là những địa điểm chụp ảnh áo dài đẹp tại mà bạn nên tham khảo để có được những bức ảnh hoàn hảo. \r\nCác Tiêu Chí Khi Lựa Chọn Địa Điểm Chụp Ảnh Áo Dài\r\nViệc chọn địa điểm chụp ảnh áo dài không chỉ dựa trên vẻ đẹp mà còn phụ thuộc vào các yếu tố khác để đảm bảo quá trình chụp ảnh suôn sẻ và tạo nên những bức ảnh hoàn hảo nhất.\r\nPhong Cách Phù Hợp Với Áo Dài\r\nÁo dài truyền thống: Hãy chọn các khu vực cổ kính, mang đậm dấu ấn lịch sử văn hóa dân tộc. \r\nÁo dài cách tân: Lựa chọn những địa điểm mang phong cách hiện đại, trẻ trung hơn như phố đi bộ, quán cà phê hay công viên.\r\nKhông Gian Và Bối Cảnh\r\nĐịa điểm rộng rãi, thoáng đãng giúp bạn có nhiều không gian để chụp ảnh, tạo dáng. Những địa điểm chụp ảnh áo dài với quang cảnh thiên nhiên lãng mạn, nên thơ hoặc những địa điểm danh lam thắng cảnh, mang ý nghĩa về lịch sử truyền thống sẽ là lựa chọn tuyệt vời nhất.\r\nÁnh Sáng Tự Nhiên\r\nÁnh sáng có tác động quan trọng đến chất lượng ảnh. Nên chọn thời điểm sáng sớm hoặc chiều muộn để có ánh sáng dịu, giúp bộ ảnh thêm tự nhiên và lung linh hơn. Ánh sáng tốt sẽ làm cho bức ảnh được rõ nét và trong trẻo hơn. \r\nKhả Năng Di Chuyển\r\nLên kế hoạch đến những địa điểm gần hoặc dễ tiếp cận để tránh mất sức trong quá trình di chuyển và đảm bảo bạn có đủ năng lượng chụp ảnh. Nên chọn những nơi có nhiều góc đẹp và ở gần nhau để không mất nhiều thời gian và công sức để di chuyển. \r\nTránh Những Nơi Quá Đông Đúc \r\nĐể hạn chế sự chen lấn hoặc bị dính người lộn xộn vào ảnh, bạn nên chọn những khu vực ít đông người hoặc tránh các khung giờ cao điểm để thoải mái bắt góc ảnh đẹp. \r\nLưu Ý Hỏi Kĩ Về Phí Dịch Vụ \r\nMột số địa điểm như các bảo tàng hoặc di tích lịch sử có phí chụp ảnh. Hãy kiểm tra thông tin trước khi đến để chuẩn bị chi phí và thủ tục cần thiết.\r\nCác Địa Điểm Chụp Ảnh Áo Dài Đẹp Tại Hà Nội\r\nHà Nội – thủ đô ngàn năm văn hiến, với vẻ đẹp cổ kính, là nơi tuyệt vời để chụp ảnh áo dài mang đậm dấu ấn truyền thống.\r\nVăn Miếu Quốc Tử Giám\r\nLà biểu tượng giáo dục truyền thống Việt Nam, Văn Miếu Quốc Tử Giám có kiến trúc cổ xưa với tường gạch đỏ, mái ngói và cây xanh tỏa bóng. Các góc chụp tại đây mang đến không gian cổ kính, nhẹ nhàng rất phù hợp với vẻ đẹp của chiếc áo dài truyền thống.\r\nHoàng Thành Thăng Long\r\nVới dấu ấn lịch sử hàng thế kỷ, Hoàng Thành Thăng Long đem lại góc nhìn trang trọng và cổ kính qua các cổng thành, sân gạch đỏ và kiến trúc độc đáo. Mặc áo dài trắng hoặc các gam màu trung tính sẽ hòa quyện hoàn hảo với không gian tại đây.\r\nHồ Gươm Và Phố Cổ Hà Nội\r\nHồ Gươm luôn được coi như một biểu tượng của Hà Nội và cũng là địa điểm chụp ảnh áo dài được yêu thích. Chụp ảnh áo dài bên Hồ Gươm, cầu Thê Húc hoặc trên những con phố cổ như Hàng Mã sẽ cho bạn bộ ảnh đầy hoài niệm, đặc biệt khi chụp ảnh cho các dịp lễ Tết với áo dài đỏ, vàng, trắng. \r\nLàng Gốm Bát Tràng\r\nLàng gốm Bát Tràng, với nét bình dị và cổ kính, rất phù hợp để chụp ảnh áo dài mang phong cách truyền thống. Những con ngõ hẹp, xưởng gốm hay nền đất nung đỏ sẽ làm nổi bật vẻ đẹp duyên dáng của tà áo dài. \r\nCác Địa Điểm Chụp Ảnh Áo Dài Đẹp Tại TP. Hồ Chí Minh\r\nTại TP. Hồ Chí Minh sôi động, những địa điểm dưới đây giúp bạn vừa hòa mình vào nhịp sống hiện đại, vừa lưu giữ được nét đẹp vượt thời gian của áo dài.\r\nNhà Thờ Đức Bà Và Bưu Điện Trung Tâm Thành Phố\r\nHai địa danh nổi tiếng mang phong cách kiến trúc Pháp cổ điển, Nhà Thờ Đức Bà và Bưu Điện Trung Tâm là nơi lý tưởng để chụp ảnh áo dài thanh lịch và sang trọng. Các góc bên ngoài nhà thờ hoặc bên trong bưu điện với nền gạch bông cổ sẽ là background hoàn hảo cho bộ ảnh của bạn. \r\nBảo Tàng Thành Phố Hồ Chí Minh\r\nVới kiến trúc cổ độc đáo, bảo tàng mang đến những góc chụp đầy tính nghệ thuật. Chiếc áo dài khi kết hợp với cảnh sắc cầu thang xoắn ốc và những khung cửa sổ lớn tại đây sẽ toát lên vẻ thanh lịch và đậm chất cổ điển.\r\nLăng Ông Bà Chiểu\r\nKhông gian đậm chất lịch sử và tâm linh tại Lăng Ông Bà Chiểu phù hợp để tôn vinh vẻ đẹp truyền thống của đất nước. Với mái ngói rêu phong và những họa tiết chạm khắc tỉ mỉ, nơi đây đem lại vẻ đẹp yên bình nhưng không kém phần uy nghiêm cho bộ ảnh.\r\nLời Kết\r\nNhững địa điểm chụp ảnh áo dài trên không chỉ giúp bạn sở hữu bộ ảnh áo dài tuyệt đẹp mà còn là cơ hội để bạn khám phá thêm về vẻ đẹp văn hóa, lịch sử và thiên nhiên của Hà Nội và TP. Hồ Chí Minh. Khi chọn đúng địa điểm và cân nhắc các tiêu chí hợp lý, bạn sẽ tạo nên những bức ảnh áo dài vừa thanh tao, vừa sống động, lưu giữ mãi những kỷ niệm đáng nhớ.', 'blogs/V2OKGnNQwPdCsgIvoFv9aQ1YcTSLADU9ijm6z3zM.webp', 0, '2024-12-07 20:56:44', '2024-12-07 20:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Ivy Moda', 'brands/VW4pYAPFc6crY1odZmlrAFvYW3osPVFf6FV2e9rS.png', 'ivy-moda', 'Thương hiệu Ivy Mdal', 0, '2024-12-09 05:05:24', '2024-12-09 05:05:24'),
(4, 'CoolMate', 'brands/ig3ZjSKAvKYwUZayUIsxGosu45FXs88dUqsV97x6.jpg', 'coolmate', 'Thương hiệu đến từ CoolMate', 0, '2024-12-09 05:07:15', '2024-12-09 05:07:15'),
(5, 'Couple TX', 'brands/nB1Jm5iGKjQ9SWVRzKIRqLrbE5tlFh3U8Q6pjrVy.png', 'couple-tx', 'Thương hiệu CoupleTX', 0, '2024-12-09 05:09:15', '2024-12-09 05:09:15'),
(6, 'YODY', 'brands/jAOyU6UT4OHP3sGvHvSFPBTqtfFs7qdSHsA22Cwj.png', 'yody', 'Thương hiệu YODY', 0, '2024-12-09 05:10:10', '2024-12-09 05:10:10'),
(7, 'Luala', 'brands/dG0CEEXbIOcDqUZsNfsTRidujxGhwbcXTfPM5cYY.png', 'luala', 'Thương hiệu Luala', 0, '2024-12-09 05:11:25', '2024-12-09 05:11:25'),
(8, 'MAGONN', 'brands/7OzOqpssSebKKqUsXIF9jGIbW1ds5Lh4iGxAf6GI.webp', 'magonn', 'Thương hiệu MAGONN', 1, '2024-12-09 05:33:46', '2024-12-09 06:37:35'),
(9, 'Hades', 'brands/w0ddl0n3TpdrZ55X5z2UGlEkJ4vx4Y4vrojFFM8n.webp', 'hades', 'Thương hiệu Hades', 1, '2024-12-09 05:35:40', '2024-12-09 06:37:28'),
(10, 'NEM Fashion', 'brands/mOMmTH30qp2BYW9TOY7KjVQtKu8vAnGul736fedL.webp', 'nem-fashion', 'Thương hiệu NEM Fashion', 0, '2024-12-09 05:36:39', '2024-12-09 05:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Thời trang nam', NULL, 'thoi-trang-nam', 'Danh sách sản phẩm thuộc thời trang nam', 0, '2024-12-09 04:50:32', '2024-12-09 04:50:32'),
(4, 'Áo phông nam', 3, 'ao-phong-nam', 'Danh sách sản phẩm áo phông nam', 0, '2024-12-09 04:51:02', '2024-12-09 04:57:02'),
(5, 'Áo sơ mi nam', 3, 'ao-so-mi-nam', 'Danh sách sản phẩm áo sơ mi nam', 0, '2024-12-09 04:52:19', '2024-12-09 04:57:21'),
(6, 'Quần jean nam', 3, 'quan-jean-nam', 'Danh sách sản phẩm quần jean nam', 0, '2024-12-09 04:53:07', '2024-12-09 04:57:37'),
(7, 'Quần short nam', 3, 'quan-short-nam', 'Danh sách sản phẩm quần short nam', 0, '2024-12-09 04:53:36', '2024-12-09 04:57:43'),
(8, 'Thời trang nữ', NULL, 'thoi-trang-nu', 'Danh sách sản phẩm thời trang nữ', 0, '2024-12-09 04:54:36', '2024-12-09 04:54:36'),
(9, 'Áo thun nữ', 8, 'ao-thun-nu', 'Danh sách sản phẩm áo thun nữ', 0, '2024-12-09 04:55:11', '2024-12-09 04:55:11'),
(10, 'Áo sơ mi nữ', 8, 'ao-so-mi-nu', 'Danh sách sản phẩm áo sơ mi nữ', 0, '2024-12-09 04:55:36', '2024-12-09 04:55:36'),
(11, 'Đầm, váy nữ', 8, 'dam-vay-nu', 'Danh sách sản phẩm đầm, váy nữ', 0, '2024-12-09 04:56:00', '2024-12-09 04:56:00'),
(12, 'Quần jean nữ', 8, 'quan-jean-nu', 'Danh sách sản phẩm quân jean nữ', 0, '2024-12-09 04:56:32', '2024-12-09 04:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `discountPercentage` int(11) NOT NULL,
  `startDate` timestamp NULL DEFAULT NULL,
  `endDate` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_06_151214_create_types_table', 1),
(6, '2024_12_06_154119_create_categories_table', 1),
(7, '2024_12_06_154133_create_brands_table', 1),
(8, '2024_12_06_154146_create_blogs_table', 1),
(9, '2024_12_06_154154_create_products_table', 1),
(10, '2024_12_06_154240_create_product_category_table', 1),
(11, '2024_12_06_154252_create_attributes_table', 1),
(12, '2024_12_06_154303_create_product_atrribute_table', 1),
(13, '2024_12_06_154323_create_attribute_values_table', 1),
(14, '2024_12_06_154345_create_review_products_table', 1),
(15, '2024_12_06_154351_create_review_blogs_table', 1),
(16, '2024_12_06_154403_create_discounts_table', 1),
(17, '2024_12_06_161522_create_product_media_table', 1),
(18, '2024_12_06_162327_create_orders_table', 1),
(19, '2024_12_06_162338_create_order_details_table', 1),
(20, '2024_12_06_165216_create_vouchers_table', 1),
(21, '2024_12_07_135017_create_product_types_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `totalPrice` decimal(8,2) NOT NULL,
  `discountAmount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `voucherCode` varchar(255) NOT NULL,
  `status` enum('PENDING','COMPLETED','CANCELED') NOT NULL DEFAULT 'PENDING',
  `paymentMethod` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `totalPrice`, `discountAmount`, `voucherCode`, `status`, `paymentMethod`, `created_at`, `updated_at`) VALUES
(1, 1, 1530.00, 0.00, '', 'COMPLETED', 'VNPay', '2024-12-09 15:35:32', '2024-12-09 15:35:32'),
(13, 1, 1299.00, 0.00, '0', 'COMPLETED', 'paymoney', '2024-12-09 09:27:51', '2024-12-09 09:27:51'),
(14, 1, 249.00, 0.00, '0', 'COMPLETED', 'paymoney', '2024-12-09 09:29:41', '2024-12-09 09:29:41'),
(15, 1, 359.00, 0.00, '0', 'COMPLETED', 'paymoney', '2024-12-09 09:30:34', '2024-12-09 09:30:34'),
(16, 1, 835.00, 0.00, '0', 'COMPLETED', 'paymoney', '2024-12-09 09:32:15', '2024-12-09 09:32:15'),
(17, 1, 539.00, 0.00, '0', 'COMPLETED', 'paymoney', '2024-12-09 09:33:41', '2024-12-09 09:33:41'),
(18, 1, 359.00, 0.00, '0', 'COMPLETED', 'paymoney', '2024-12-09 09:35:06', '2024-12-09 09:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `sizeId` bigint(20) UNSIGNED NOT NULL,
  `colorId` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `discount_percentage` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `orderId`, `productId`, `sizeId`, `colorId`, `quantity`, `price`, `discount_percentage`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 4, 8, 2, 1799.00, 0.00, '2024-12-09 15:40:40', '2024-12-09 15:40:40'),
(6, 13, 3, 11, 13, 1, 1299.00, 0.00, '2024-12-09 09:27:51', '2024-12-09 09:27:51'),
(7, 14, 5, 25, 26, 1, 249.00, 0.00, '2024-12-09 09:29:41', '2024-12-09 09:29:41'),
(8, 15, 7, 35, 38, 1, 359.00, 0.00, '2024-12-09 09:30:34', '2024-12-09 09:30:34'),
(9, 16, 11, 53, 49, 1, 835.00, 0.00, '2024-12-09 09:32:15', '2024-12-09 09:32:15'),
(10, 17, 8, 39, 42, 1, 539.00, 0.00, '2024-12-09 09:33:41', '2024-12-09 09:33:41'),
(11, 18, 7, 36, 38, 1, 359.00, 0.00, '2024-12-09 09:35:06', '2024-12-09 09:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brandId` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `slug`, `brandId`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Đầm ôm cổ V Opulence', 'Thiết kế được lựa chọn trong BST Office Divas, mang đậm dấu ấn phong cách hiện đại dành riêng cho phái đẹp. Ngôn ngữ thiết kế tối giản được điểm xuyết khéo léo bằng các chi tiết cách điệu mềm mại không chỉ nâng tầm vẻ đẹp thanh lịch mà còn thể hiện cá tính độc lập và gu thời trang đẳng cấp.\r\nĐầm Opulence nổi bật với phần thân tạo kiểu Gile thời thượng, mang đến vẻ đẹp sang trọng và cá tính. Cổ V kết hợp dáng ôm thanh thoát tôn lên vẻ đẹp người mặc, tạo cảm giác tinh tế mà quyến rũ.\r\n- Chất liệu Tuysi cao cấp, mềm mại, thoáng mát và giữ phom dáng chuẩn\r\n- Thiết kế cổ V thanh lịch, tôn dáng và tăng vẻ quyến rũ\r\n- Thân đầm cách điệu theo kiểu áo gile, mang lại phong cách thời thượng, sang trọng\r\n- Dáng ôm tôn lên đường cong cơ thể, phù hợp với nhiều dịp\r\n- Dễ phối hợp với giày cao gót và phụ kiện để tạo nên vẻ ngoài hoàn hảo', 'dam-om-co-v-opulence', 3, 0, '2024-12-09 05:39:53', '2024-12-09 05:39:53'),
(3, 'Áo sơ mi Tuysi Drop Waist', 'Chiếc áo sơ mi kết hợp hoàn hảo giữa phong cách thanh lịch và tinh tế, phù hợp cho nàng tại môi trường công sở hay những buổi gặp gỡ trang trọng.\r\nChất liệu Tuysi cao cấp mang đến cảm giác mềm mại, co giãn nhẹ, giúp áo vừa vặn, thoải mái khi mặc. Thiết kế ôm cơ thể bên cạnh chi tiết chiết eo đã tôn lên đường cong, tạo cảm giác gọn gàng, thanh mảnh.\r\nCổ đức chỉn chu, sang trọng. Tay áo dài lịch sự. Chiếc áo sơ mi này dễ dàng kết hợp với quần tây, chân váy bút chì hoặc các kiểu váy công sở khác để người mặc luôn tỏa sáng trong mọi dịp.', 'ao-sô-mi-tuysi-drop-waist', 3, 0, '2024-12-09 05:47:31', '2024-12-09 05:47:31'),
(4, 'Áo sơ mi Slim fit Basic', '- Áo sơ mi tay dài cổ đức lịch thiệp.\r\n- Thiết kế kiểu dáng Slim fit ôm nhẹ, phù hợp vóc dáng Á - Đông.\r\n- Họa tiết trơn, basic, trẻ trung và hiện đại. \r\n- Kết hợp cùng quần âu, quần jeans, kaki phù hợp diện đi làm, đi chơi, gặp gỡ đối tác.\r\nDòng sản phẩm	Men\r\nNhóm sản phẩm	Áo\r\nCổ áo	Cổ đức\r\nTay áo	Tay dài\r\nKiểu dáng	Slim fit\r\nĐộ dài	Dài thường\r\nHọa tiết	Trơn\r\nChất liệu	Thô', 'ao-so-mi-slim-fit-basic', 3, 0, '2024-12-09 06:00:43', '2024-12-09 06:00:43'),
(5, 'Quần shorts ECC Ripstop', 'Đặc điểm nổi bật\r\nChất liệu: Polyamide Taslan pha Spandex.\r\nĐộ bền và khả năng chịu lực cao.\r\nTrượt nước và chống bám bụi.\r\nNhẹ và thoáng khí, thoải mái khi mặc.\r\nNgười mẫu: 182cm - 77kg, mặc size XL\r\nTự hào sản xuất: từ Dệt, Nhuộm, May tại Việt Nam', 'quan-shorts-ecc-ripsto', 4, 0, '2024-12-09 06:06:41', '2024-12-09 06:06:41'),
(6, 'Áo Sơ Mi Dài Tay Premium Dobby', 'Thông tin sản phẩm\r\nChất liệu 100% Cotton mềm mại, chống nhăn, kiểu dệt Dobby thoáng khí\r\nVải có khả năng trượt nước, chống bám bụi\r\nVải ứng dụng công nghệ nano giúp loại bỏ hơn 70% vi khuẩn và khử mùi hiệu quả\r\nKiểu dáng: Slim Fit thanh lịch\r\nNgười mẫu: 186cm - 77kg, mặc áo 2XL\r\nTự hào sản xuất tại Việt Nam', 'ao-so-mi-nam-dai-tay-premium-dobby', 4, 0, '2024-12-09 06:12:53', '2024-12-09 06:12:53'),
(7, 'Áo Phông Nam The Only Best Energy MTS 1402', 'Áo Thun Nam The Only Best Energy MTS 1402. Áo thun mang đến phong cách trẻ trung và hiện đại, với nhiều kiểu dáng phù hợp cho cả nam, nữ và trẻ em. Sản phẩm có màu sắc mới lạ, phù hợp với tông da người Châu Á. Đây sẽ là lựa chọn tuyệt vời cho các gia đình trong dịp Noel sắp tới.\r\nChất Liệu : SINGLE 2C 100% COTTON 210 GSM\r\nForm : Relax\r\nMàu Sắc : Vàng, Xanh Lá\r\nSản xuất: Việt Nam', 'ao-phong-nam-relax-typo-the-best-energy-mts-1402', 5, 0, '2024-12-09 06:18:02', '2024-12-09 06:18:02'),
(8, 'Quần Jean Nam Slim Fit Wash Vintage', 'Một chiếc quần jeans nam có tính ứng dụng cao. Vải được làm từ bông tự nhiên nên mang đầy đủ tính chất đặc trưng của bông như mềm mại, thông thoáng, có độ bền cao, thấm hút tốt, an toàn với người sử dụng. Quần co giãn nhẹ do chứa thành phần spandex, giúp người mặc thoải mái khi vận động. Sợi ngang chứa thành phần polyester giúp tăng độ bền cho sản phẩm, đồng thời sợi trơn bóng, nằm ở mặt trái của vải nên khi tiếp xúc với da sẽ làm cho người mặc thoải mái hơn.', 'quan-jean-nam-slim-fit-wash-vintage', 6, 0, '2024-12-09 06:21:57', '2024-12-09 06:21:57'),
(10, 'Quần Jean Nữ Giấy Tencel Suông Chiết Ly', 'Siêu thoải mái cùng Quần Jean Nữ Giấy Tencel Suông Chiết Ly. Quần được làm tự sợi tencel có độ bóng mờ, vẻ ngoài cổ điển, giản dị, cảm giác tay mềm mại. Thiết kế dáng suông siêu thoải mái cùng chất mềm, nhẹ và vô cùng thoáng cho ngày hè tự tin diện đẹp.', 'quan-jean-nu-giay-tencel-suong-chiet-ly', 6, 0, '2024-12-09 06:27:56', '2024-12-09 06:27:56'),
(11, 'Đầm Adela cổ lệch lưng đổ', 'Đầm Adela cổ lệch lưng đổ\r\nMột sản phẩm tuyệt vời được thiết kế dành riêng cho những quý cô yêu thích sự thanh lịch và quyến rũ. Với chất liệu lụa cao cấp và thiết kế tinh tế, chiếc đầm này chắc chắn sẽ trở thành một phần không thể thiếu trong tủ đồ của bạn.\r\nĐặc điểm nổi bật của đầm: \r\nChất Liệu lụa Cao Cấp: mang lại cảm giác mềm mại, thoáng mát và dễ chịu khi mặc. Lụa không chỉ giúp tôn lên vẻ đẹp tự nhiên mà còn mang lại sự thoải mái tuyệt đối cho người mặc.\r\n\r\nThiết Kế Tinh Tế: Cổ lệch độc đáo khéo léo khoe bờ vai thon gọn, tạo điểm nhấn quyến rũ và tinh tế. Chi tiết này giúp chiếc đầm trở nên nổi bật và khác biệt. Phần lưng đổ nhẹ nhàng, tinh tế, tạo nên vẻ đẹp huyền bí và cuốn hút. Thiết kế này không chỉ giúp bạn tôn lên nét đẹp tự nhiên mà còn mang lại sự thoải mái khi di chuyển.\r\nPhong Cách Thanh Lịch: Với màu sắc trang nhã và thiết kế thanh lịch, đầm Adela có thể dễ dàng phối hợp với nhiều loại phụ kiện khác nhau. Bạn có thể tự tin diện đầm này trong nhiều dịp, từ dạo phố, dự tiệc đến những buổi hẹn hò lãng mạn.\r\nCách bảo quản đầm lụa:\r\nGiặt tay hoặc giặt khô: Nên giặt tay hoặc giặt khô để bảo vệ chất liệu lụa và giữ được hình dáng của đầm. Tránh sử dụng máy giặt để không làm hỏng các chi tiết và chất liệu vải.\r\nỦi ở nhiệt độ thấp: Lụa nhạy cảm với nhiệt độ cao, nên ủi ở mức nhiệt thấp. Lót một lớp vải khác bên trên khi ủi để bảo vệ bề mặt vải lụa.\r\nPhơi trong bóng râm: Tránh phơi dưới ánh nắng trực tiếp để giữ màu sắc và chất liệu của vải lụa được bền đẹp.', 'dam-adela-co-lech-lung-do', 7, 0, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(12, 'Đầm đen phối hoa nổi D20402', 'Chất liệu: vải tổng hợp cao cấp\r\nKiểu dáng: đầm thiết kế dáng chữ A dài qua gối, tone màu đen đính hoa nổi,kèm tag nơ đá cài \r\nSản phẩm thuộc dòng sản phẩm:  NEM NEW\r\nThông tin người mẫu: mặc sản phẩm size 2', 'dam-den-phoi-hoa-noi-D20402', 10, 0, '2024-12-09 06:39:57', '2024-12-09 06:39:57'),
(13, 'T-shirt Nữ Slimfit Thun Rib Tăm Nhỏ', 'Chất liệu cao cấp:\r\nThun rib tăm mềm mại\r\nKiểu dệt linh hoạt co giãn mang lại cảm giác mặc thoải mái, dễ chịu.\r\nMềm mại trên da nhờ thành phần sợi Viscose.\r\nĐộ bền cao, giữ form tốt, hạn chế nhăn nhàu nhờ pha sợi Poly.\r\nThiết kế:\r\nCổ tròn đơn giản: Tạo nên sự thanh lịch và dễ chịu, phù hợp với đa số khách hàng.\r\nDáng slimfit: Ôm gọn cơ thể giúp tôn lên đường cong và tạo nên vóc dáng thon gọn cho người mặc.\r\nƯu điểm vượt trội:\r\nSiêu co giãn & đàn hồi: Nhờ bổ sung thành phần spandex, áo co giãn và đàn hồi tốt, ôm nhẹ cơ thể mà không gây gò bó, khó chịu.\r\nThoáng mát: Chất liệu thấm hút mồ hôi hiệu quả, giúp bạn luôn khô ráo và thoải mái trong mọi hoạt động.\r\nMềm mại: Chất liệu Rayon cao cấp và Viscose mang đến cảm giác mềm mại, nhẹ nhàng khi chạm vào da.\r\nBền chắc: Chất liệu cao cấp cùng đường may tỉ mỉ đảm bảo độ bền cho sản phẩm, giúp bạn sử dụng lâu dài.\r\nThời trang: Thiết kế basic đơn giản, dễ dàng phối hợp với nhiều trang phục khác nhau, tạo nên phong cách thời trang đa dạng.', 't-shirt-nu-slimfit-thun-rib-tam-nho', 6, 0, '2024-12-09 06:43:46', '2024-12-09 06:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `attributeId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `productId`, `attributeId`, `created_at`, `updated_at`) VALUES
(3, 2, 3, '2024-12-09 05:40:02', '2024-12-09 05:40:02'),
(4, 2, 4, '2024-12-09 05:40:09', '2024-12-09 05:40:09'),
(8, 3, 8, '2024-12-09 05:55:13', '2024-12-09 05:55:13'),
(9, 3, 9, '2024-12-09 05:55:18', '2024-12-09 05:55:18'),
(10, 4, 10, '2024-12-09 06:00:51', '2024-12-09 06:00:51'),
(11, 4, 11, '2024-12-09 06:00:55', '2024-12-09 06:00:55'),
(12, 5, 12, '2024-12-09 06:06:47', '2024-12-09 06:06:47'),
(13, 5, 13, '2024-12-09 06:06:51', '2024-12-09 06:06:51'),
(14, 6, 14, '2024-12-09 06:13:02', '2024-12-09 06:13:02'),
(15, 6, 15, '2024-12-09 06:13:07', '2024-12-09 06:13:07'),
(16, 7, 16, '2024-12-09 06:18:13', '2024-12-09 06:18:13'),
(17, 7, 17, '2024-12-09 06:18:18', '2024-12-09 06:18:18'),
(18, 8, 18, '2024-12-09 06:22:05', '2024-12-09 06:22:05'),
(19, 8, 19, '2024-12-09 06:22:10', '2024-12-09 06:22:10'),
(20, 10, 20, '2024-12-09 06:28:05', '2024-12-09 06:28:05'),
(21, 10, 21, '2024-12-09 06:28:11', '2024-12-09 06:28:11'),
(22, 11, 22, '2024-12-09 06:33:00', '2024-12-09 06:33:00'),
(23, 11, 23, '2024-12-09 06:33:05', '2024-12-09 06:33:05'),
(24, 12, 24, '2024-12-09 06:40:04', '2024-12-09 06:40:04'),
(25, 12, 25, '2024-12-09 06:40:08', '2024-12-09 06:40:08'),
(26, 13, 26, '2024-12-09 06:43:55', '2024-12-09 06:43:55'),
(27, 13, 27, '2024-12-09 06:43:59', '2024-12-09 06:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `categoryId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `productId`, `categoryId`, `created_at`, `updated_at`) VALUES
(2, 2, 11, '2024-12-09 05:39:53', '2024-12-09 05:39:53'),
(3, 3, 10, '2024-12-09 05:47:31', '2024-12-09 05:47:31'),
(4, 4, 5, '2024-12-09 06:00:43', '2024-12-09 06:00:43'),
(5, 5, 7, '2024-12-09 06:06:41', '2024-12-09 06:06:41'),
(6, 6, 5, '2024-12-09 06:12:53', '2024-12-09 06:12:53'),
(7, 7, 4, '2024-12-09 06:18:02', '2024-12-09 06:18:02'),
(8, 8, 6, '2024-12-09 06:21:57', '2024-12-09 06:21:57'),
(10, 10, 12, '2024-12-09 06:27:56', '2024-12-09 06:27:56'),
(11, 11, 11, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(12, 12, 11, '2024-12-09 06:39:57', '2024-12-09 06:39:57'),
(13, 13, 9, '2024-12-09 06:43:46', '2024-12-09 06:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `mediaUrl` varchar(255) NOT NULL,
  `mediaType` varchar(255) NOT NULL,
  `mainImage` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`id`, `productId`, `mediaUrl`, `mediaType`, `mainImage`, `created_at`, `updated_at`) VALUES
(5, 2, 'products/images/hssCJjbJWdjEMFPgu9TUic1T4oLhztOkj95bend5.webp', 'image', 1, '2024-12-09 05:39:53', '2024-12-09 05:39:53'),
(6, 2, 'products/images/euaFUilEWQ1NJmi4yUJeN3tUVGYYwRKBF6c5tUNI.webp', 'image', 0, '2024-12-09 05:39:53', '2024-12-09 05:39:53'),
(7, 2, 'products/images/CgX1lb7QtlUQG0yMsPXZ4pGeVGytjMufzRqhIdmv.webp', 'image', 0, '2024-12-09 05:39:53', '2024-12-09 05:39:53'),
(8, 2, 'products/images/nTMiTGqwSowTkX6tPLlNQoKCaia2NNUwzQ5yjerv.webp', 'image', 0, '2024-12-09 05:39:53', '2024-12-09 05:39:53'),
(9, 2, 'products/images/kChohNrKcNMIUiZtFWPe51KVFq2Sb0WtJuMLF7Oi.webp', 'image', 0, '2024-12-09 05:39:53', '2024-12-09 05:39:53'),
(10, 3, 'products/images/lOy1Oehqggwgl2r3ewlZGiZMWMTmOtjtKXHc6r29.webp', 'image', 1, '2024-12-09 05:47:31', '2024-12-09 05:47:31'),
(11, 3, 'products/images/GQlTgNW7bMFu5ICnHvubuxHUJ5NbOOsPZGZFbwji.webp', 'image', 0, '2024-12-09 05:47:31', '2024-12-09 05:47:31'),
(12, 3, 'products/images/kBck9MHHKkDhdd1cNmhpAVtA7oozg6srjluKwchx.webp', 'image', 0, '2024-12-09 05:47:31', '2024-12-09 05:47:31'),
(13, 3, 'products/images/YN3T5mGtUOSb52JFQQyDOzcKSDteUji2qOAPufNB.webp', 'image', 0, '2024-12-09 05:47:31', '2024-12-09 05:47:31'),
(14, 4, 'products/images/qyszRdHTXv0nwUBjdHeAocDcvdqFtGsTVwL39HY9.jpg', 'image', 1, '2024-12-09 06:00:43', '2024-12-09 06:00:43'),
(15, 4, 'products/images/QNe9IGeWWyHKGybgQRisG5x4z4zweQLCwr2EnWZU.jpg', 'image', 0, '2024-12-09 06:00:43', '2024-12-09 06:00:43'),
(16, 4, 'products/images/8moZ3c3gpUfftCn7e27ti0LGVP6FYI4l2jBb5EFm.jpg', 'image', 0, '2024-12-09 06:00:43', '2024-12-09 06:00:43'),
(17, 4, 'products/images/DFwu3cNgj6OJkKKf76wRK66Nxcoy8SONx5wbztAF.jpg', 'image', 0, '2024-12-09 06:00:43', '2024-12-09 06:00:43'),
(18, 5, 'products/images/MUmRQNpVTebERA9oRdTsjclb7P34S7cdkzPLwFdN.jpg', 'image', 1, '2024-12-09 06:06:41', '2024-12-09 06:06:41'),
(19, 5, 'products/images/FgDmllIFEueIGsADGXbmC4B2fjyBVQhdp6EFaKBD.webp', 'image', 0, '2024-12-09 06:06:41', '2024-12-09 06:06:41'),
(20, 5, 'products/images/uxolNBDO8OXFgRpI3lRCUUSOUI51caeqLFQEKir7.webp', 'image', 0, '2024-12-09 06:06:41', '2024-12-09 06:06:41'),
(21, 5, 'products/images/E49waWFrII9y4TiTVnI2o8Mm8AdwplWOEW7wdyih.webp', 'image', 0, '2024-12-09 06:06:41', '2024-12-09 06:06:41'),
(22, 6, 'products/images/uRHKGhnkJTYoVRDxRwcdIbxqjzqb0EyV7Ee57mnd.webp', 'image', 1, '2024-12-09 06:12:53', '2024-12-09 06:12:53'),
(23, 6, 'products/images/vee1ss1fSaCg6idUzEUoziTkGAcNqm2zIcVaXVBx.webp', 'image', 0, '2024-12-09 06:12:53', '2024-12-09 06:12:53'),
(24, 6, 'products/images/w9BvfHa7VbT2tjtrN2gic4I6lliMBzQgqD0Q3OJb.webp', 'image', 0, '2024-12-09 06:12:53', '2024-12-09 06:12:53'),
(25, 6, 'products/images/7vaXFaQLtJJYEDI6fmvdnPDsNlUwuwHqqCCAggwt.webp', 'image', 0, '2024-12-09 06:12:53', '2024-12-09 06:12:53'),
(26, 7, 'products/images/vs4cYTBSgoShSJOaVXEofFpc5KL7dHmpBOm2Rnug.webp', 'image', 1, '2024-12-09 06:18:02', '2024-12-09 06:18:02'),
(27, 7, 'products/images/sXfP2jnhHb7Jbi21lbv4SteHLTR0vUaZREmivfql.webp', 'image', 0, '2024-12-09 06:18:02', '2024-12-09 06:18:02'),
(28, 7, 'products/images/hkMDUCdP5Sb9GyGnMOxb1jmxt0aTBEjmq3mzctlu.jpg', 'image', 0, '2024-12-09 06:18:02', '2024-12-09 06:18:02'),
(29, 7, 'products/images/2zLRItOnRj9lZ2ZRFpGc0UckaMlHyFRQjVInbBpK.webp', 'image', 0, '2024-12-09 06:18:02', '2024-12-09 06:18:02'),
(30, 8, 'products/images/fs7pgfQLydHOrj50scWvrvstmrLMeWLkyE2KPoZ4.webp', 'image', 1, '2024-12-09 06:21:57', '2024-12-09 06:21:57'),
(31, 8, 'products/images/G809wjqFD3XKyKAa3GvNtETRMVlfEUHvridgcnHh.webp', 'image', 0, '2024-12-09 06:21:57', '2024-12-09 06:21:57'),
(32, 8, 'products/images/wTC4ruQ7jM41LfkVGiVgITqT9IePqVXpg42jRoYQ.webp', 'image', 0, '2024-12-09 06:21:57', '2024-12-09 06:21:57'),
(33, 8, 'products/images/raNKAPKeDjMEXWCnEHPvyZ6hIzUMRRB7bqsB8hTP.webp', 'image', 0, '2024-12-09 06:21:57', '2024-12-09 06:21:57'),
(34, 8, 'products/images/cu9f4l369F6nNOqhp092NEkRiFIGQiqvGUhNV4Rx.webp', 'image', 0, '2024-12-09 06:21:57', '2024-12-09 06:21:57'),
(40, 10, 'products/images/N1npRLWK9g4AzQcc3v6nyxGFiGPAaHjWn0r5B799.webp', 'image', 1, '2024-12-09 06:27:56', '2024-12-09 06:27:56'),
(41, 10, 'products/images/rVJzmDUQ6X8ZsdPyOFj9fEhMDScvqar73d2pe6tC.webp', 'image', 0, '2024-12-09 06:27:56', '2024-12-09 06:27:56'),
(42, 10, 'products/images/bF1oYtTTbNbMvHj6QgD5h4M8ZM58z4RfbFVxU82z.webp', 'image', 0, '2024-12-09 06:27:56', '2024-12-09 06:27:56'),
(43, 10, 'products/images/LTEIzDTJ8OVE4xtacVg1y4HNKuY4xU1ztqQ4j5bH.webp', 'image', 0, '2024-12-09 06:27:56', '2024-12-09 06:27:56'),
(44, 10, 'products/images/sEZbkQtl9ljOdn2dFRNgsVdlr9bXecyfuGV90YE4.webp', 'image', 0, '2024-12-09 06:27:56', '2024-12-09 06:27:56'),
(45, 11, 'products/images/soStc3FLAM3tRdxIXLEELGzFh86W4BNm9JwSnNk2.jpg', 'image', 1, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(46, 11, 'products/images/RN97sDIum0bVYzvjCuQD2tQjWdavcYo3b0Bx59nE.jpg', 'image', 0, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(47, 11, 'products/images/8fCtXN2zdpBPO0uBVtzfVXR7ZXHFzlWv2VpI6pf8.jpg', 'image', 0, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(48, 11, 'products/images/QyeAUM4SDeHbVarYuG5az4whyg8cUqygLg80xsQR.jpg', 'image', 0, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(49, 11, 'products/images/TrBCau32o4SMlyP4bpCZl6UTtGgfqZeZVqyCe09n.jpg', 'image', 0, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(50, 11, 'products/images/pVkFbojD0QPh3jA7RhAZbZyBpdyQXjydG2Wz6TvG.jpg', 'image', 0, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(51, 12, 'products/images/IjFluRxYQ7Np0P1nQZv53BQzaJPhoOw7UTFr8824.webp', 'image', 1, '2024-12-09 06:39:57', '2024-12-09 06:39:57'),
(52, 12, 'products/images/XZFv0eNnWPVYB8sB7sw7vKjjiNR0fwm18AAbt2dl.webp', 'image', 0, '2024-12-09 06:39:57', '2024-12-09 06:39:57'),
(53, 12, 'products/images/mYFoiPhpP2G5bhlO17u989PsESzkXehn9GvGqGPB.webp', 'image', 0, '2024-12-09 06:39:57', '2024-12-09 06:39:57'),
(54, 12, 'products/images/PYF1htRYBqj1Exg5Nu8JHcQKAFGoo7Qc4Ss0lYXT.webp', 'image', 0, '2024-12-09 06:39:57', '2024-12-09 06:39:57'),
(55, 12, 'products/images/T8ipjRzvKP9TFiM2JUUKCuHGW83uRVqI7ESO0rCs.webp', 'image', 0, '2024-12-09 06:39:57', '2024-12-09 06:39:57'),
(56, 13, 'products/images/Qq8mGcKzv8dC3CQEwY1l52i8lwILASnLqYHYC2La.webp', 'image', 1, '2024-12-09 06:43:46', '2024-12-09 06:43:46'),
(57, 13, 'products/images/TuoPhn9kuJYrcTS0k2h9a5a0XjwIHUTsRsKHSAlY.webp', 'image', 0, '2024-12-09 06:43:46', '2024-12-09 06:43:46'),
(58, 13, 'products/images/Q4yLLNYgphvHExVqarP7DhBxgulZkLFuhFLG40mU.webp', 'image', 0, '2024-12-09 06:43:46', '2024-12-09 06:43:46'),
(59, 13, 'products/images/jklUCiXTqKtYRrJgJyubrjmzLM1aY43xypruKvWk.webp', 'image', 0, '2024-12-09 06:43:46', '2024-12-09 06:43:46'),
(60, 13, 'products/images/nINobe9vEyu3OiftHllIPP6v5Xr4RVtssZJeJ7lE.webp', 'image', 0, '2024-12-09 06:43:46', '2024-12-09 06:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `typeId` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `productId`, `typeId`, `created_at`, `updated_at`) VALUES
(2, 2, 3, '2024-12-09 05:39:53', '2024-12-09 05:39:53'),
(3, 3, 2, '2024-12-09 05:47:31', '2024-12-09 05:47:31'),
(4, 4, 2, '2024-12-09 06:00:43', '2024-12-09 06:00:43'),
(5, 5, 2, '2024-12-09 06:06:41', '2024-12-09 06:06:41'),
(6, 6, 2, '2024-12-09 06:12:53', '2024-12-09 06:12:53'),
(7, 7, 2, '2024-12-09 06:18:02', '2024-12-09 06:18:02'),
(8, 8, 2, '2024-12-09 06:21:57', '2024-12-09 06:21:57'),
(10, 10, 2, '2024-12-09 06:27:56', '2024-12-09 06:27:56'),
(11, 11, 2, '2024-12-09 06:32:53', '2024-12-09 06:32:53'),
(12, 12, 2, '2024-12-09 06:39:57', '2024-12-09 06:39:57'),
(13, 13, 2, '2024-12-09 06:43:46', '2024-12-09 06:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `review_blogs`
--

CREATE TABLE `review_blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blogId` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_products`
--

CREATE TABLE `review_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hot Sales', 0, '2024-12-07 20:46:28', '2024-12-07 20:46:28'),
(2, 'Products New', 0, '2024-12-07 20:46:37', '2024-12-07 20:46:37'),
(3, 'Best Sellers', 0, '2024-12-07 20:46:49', '2024-12-07 20:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `countLock` int(11) NOT NULL DEFAULT 0,
  `lastLogin` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` enum('USER','ADMIN') NOT NULL DEFAULT 'USER',
  `avatar` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `countLock`, `lastLogin`, `password`, `phone`, `address`, `role`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Le', 'Nam Anh', 'namanhle02112003@gmail.com', 0, NULL, '$2y$10$KWSayk3OxeYFVlbFnPocCecER2vulY0m5lEwJnB7k7eqZBXERVrBO', '0969325914', 'Me Tri, Nam Tu Liem, Ha Noi', 'ADMIN', 'avatars/mCm6ASr9spPaLbQEIlk6YOygyVUp48Hebj4gF23Q.jpg', 0, '2024-12-07 20:10:47', '2024-12-07 20:37:02');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `discountPercentage` int(11) NOT NULL,
  `minPurchaseAmount` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `startDate` timestamp NULL DEFAULT NULL,
  `endDate` timestamp NULL DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `discountPercentage`, `minPurchaseAmount`, `quantity`, `startDate`, `endDate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CHAOBANMOI100', 15, 100, 100, '2024-12-07 17:00:00', '2024-12-15 17:00:00', 'ACTIVE', '2024-12-07 21:25:52', '2024-12-07 21:36:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attributeid_foreign` (`attributeId`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_productid_foreign` (`productId`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_userid_foreign` (`userId`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_orderid_foreign` (`orderId`),
  ADD KEY `order_details_productid_foreign` (`productId`),
  ADD KEY `fk_sizeId` (`sizeId`),
  ADD KEY `fk_colorId` (`colorId`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brandid_foreign` (`brandId`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_atrribute_productid_foreign` (`productId`),
  ADD KEY `product_atrribute_attributeid_foreign` (`attributeId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_productid_foreign` (`productId`),
  ADD KEY `product_category_categoryid_foreign` (`categoryId`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_media_productid_foreign` (`productId`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_types_productid_foreign` (`productId`),
  ADD KEY `product_types_typeid_foreign` (`typeId`);

--
-- Indexes for table `review_blogs`
--
ALTER TABLE `review_blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_blogs_blogid_foreign` (`blogId`),
  ADD KEY `review_blogs_userid_foreign` (`userId`);

--
-- Indexes for table `review_products`
--
ALTER TABLE `review_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_products_productid_foreign` (`productId`),
  ADD KEY `review_products_userid_foreign` (`userId`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vouchers_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review_blogs`
--
ALTER TABLE `review_blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_products`
--
ALTER TABLE `review_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attributeid_foreign` FOREIGN KEY (`attributeId`) REFERENCES `attributes` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_colorId` FOREIGN KEY (`colorId`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_sizeId` FOREIGN KEY (`sizeId`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_orderid_foreign` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brandid_foreign` FOREIGN KEY (`brandId`) REFERENCES `brands` (`id`);

--
-- Constraints for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD CONSTRAINT `product_atrribute_attributeid_foreign` FOREIGN KEY (`attributeId`) REFERENCES `attributes` (`id`),
  ADD CONSTRAINT `product_atrribute_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `product_category_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Constraints for table `product_types`
--
ALTER TABLE `product_types`
  ADD CONSTRAINT `product_types_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_types_typeid_foreign` FOREIGN KEY (`typeId`) REFERENCES `types` (`id`);

--
-- Constraints for table `review_blogs`
--
ALTER TABLE `review_blogs`
  ADD CONSTRAINT `review_blogs_blogid_foreign` FOREIGN KEY (`blogId`) REFERENCES `blogs` (`id`),
  ADD CONSTRAINT `review_blogs_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `review_products`
--
ALTER TABLE `review_products`
  ADD CONSTRAINT `review_products_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `review_products_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
