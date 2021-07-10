-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2015 at 05:10 PM
-- Server version: 5.5.40
-- PHP Version: 5.4.41

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qc`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`id` int(11) NOT NULL,
  `account_type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_no` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `account_type`, `account_name`, `parent_id`, `created_at`, `updated_at`, `order_no`, `status`) VALUES
(1, 'MANAGER', 'Manager', 0, '2015-05-16 08:34:41', '2015-05-16 01:34:41', 0, 0),
(2, 'ADMIN', 'Administrator', 1, '2015-05-16 08:34:41', '2015-05-16 01:34:41', 0, 0),
(3, 'ADVERTISER', 'Advertiser', 0, '2015-04-20 09:56:32', '2014-12-23 01:41:49', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `adtypes`
--

CREATE TABLE IF NOT EXISTS `adtypes` (
`id` int(11) NOT NULL,
  `zonetype_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preview` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `standard` int(1) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adtypes`
--

INSERT INTO `adtypes` (`id`, `zonetype_id`, `title`, `preview`, `width`, `height`, `order_no`, `created_at`, `updated_at`, `standard`, `status`) VALUES
(24, 1, 'Full Banner (468 x 60)', 'default.png', 468, 60, 1, '2015-05-16 08:36:12', '2015-05-16 01:36:12', 0, 0),
(25, 1, 'Skyscraper (120 x 600)', 'default.png', 120, 600, 2, '2015-05-16 08:36:34', '2015-05-16 01:36:34', 0, 0),
(26, 1, 'Leaderboard (728 x 90)', 'default.png', 728, 90, 3, '2015-05-16 08:36:59', '2015-05-16 01:36:59', 0, 0),
(27, 1, 'Button 1 (120 x 90)', 'default.png', 120, 90, 4, '2015-05-16 08:37:14', '2015-05-16 01:37:14', 0, 0),
(28, 1, 'Button 2 (120 x 60)', 'default.png', 120, 60, 5, '2015-05-16 08:37:30', '2015-05-16 01:37:30', 0, 0),
(29, 1, 'Half Banner (234 x 60)', 'default.png', 234, 60, 6, '2015-05-16 08:37:51', '2015-05-16 01:37:51', 0, 0),
(30, 1, 'Micro Bar (88 x 31)', 'default.png', 88, 31, 7, '2015-05-16 08:38:12', '2015-05-16 01:38:12', 0, 0),
(31, 1, 'Square Button (125 x 125)', 'default.png', 125, 125, 8, '2015-05-16 08:38:31', '2015-05-16 01:38:31', 0, 0),
(32, 1, 'Vertical Banner (120 x 240)', 'default.png', 120, 240, 9, '2015-05-16 08:38:49', '2015-05-16 01:38:49', 0, 0),
(33, 1, 'Rectangle (180 x 150)', 'default.png', 180, 150, 10, '2015-05-16 08:39:07', '2015-05-16 01:39:07', 0, 0),
(34, 1, 'Medium Rectangle (300 x 250)', 'default.png', 300, 250, 11, '2015-05-16 08:39:17', '2015-05-16 01:39:17', 0, 0),
(35, 1, 'Large Rectangle (336 x 280)', 'default.png', 336, 280, 12, '2015-05-16 08:39:33', '2015-05-16 01:39:33', 0, 0),
(36, 1, 'Vertical Rectangle (240 x 400)', 'default.png', 240, 400, 13, '2015-05-16 08:39:49', '2015-05-16 01:39:49', 0, 0),
(37, 1, 'Square Pop-up (250 x 250)', 'default.png', 250, 250, 14, '2015-05-16 08:40:03', '2015-05-16 01:40:03', 0, 0),
(38, 1, 'Wide Skyscraper (160 x 600)', 'default.png', 160, 600, 15, '2015-05-16 08:40:17', '2015-05-16 01:40:17', 0, 0),
(39, 1, 'Half Page (300 x 600)', 'default.png', 300, 600, 16, '2015-05-16 08:40:31', '2015-05-16 01:40:31', 0, 0),
(40, 1, 'HTxx (366 x 90)', 'default.png', 366, 90, 17, '2015-05-16 08:40:43', '2015-05-16 01:40:43', 0, 0),
(41, 1, 'Ads (495 x 90)', 'default.png', 495, 90, 18, '2015-05-16 08:40:56', '2015-05-16 01:40:56', 0, 0),
(42, 1, 'Ads (200 x 600)', 'default.png', 200, 600, 19, '2015-05-16 08:41:09', '2015-05-16 01:41:09', 0, 0),
(43, 1, 'TT Mobile (320x100)', 'default.png', 320, 100, 20, '2015-05-16 08:41:23', '2015-05-16 01:41:23', 0, 0),
(44, 1, 'TT Mobile (320x250)', 'default.png', 320, 250, 21, '2015-05-16 08:41:52', '2015-05-16 01:41:52', 0, 0),
(45, 1, 'TT Mobile Đáp ứng', 'default.png', 0, 0, 22, '2015-05-16 08:42:25', '2015-05-16 01:42:25', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
`id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL DEFAULT '1',
  `zoneid` int(11) NOT NULL,
  `contenttype` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pluginversion` int(9) NOT NULL,
  `storagetype` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `htmltemplate` text COLLATE utf8_unicode_ci NOT NULL,
  `htmlcache` text COLLATE utf8_unicode_ci NOT NULL,
  `width` int(6) NOT NULL,
  `height` int(6) NOT NULL,
  `weight` int(4) NOT NULL,
  `seq` int(4) NOT NULL,
  `target` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statustext` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bannertext` text COLLATE utf8_unicode_ci NOT NULL,
  `imagetext` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adserver` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block` int(11) NOT NULL,
  `capping` int(11) NOT NULL,
  `session_capping` int(11) NOT NULL,
  `compiledlimitation` text COLLATE utf8_unicode_ci NOT NULL,
  `acl_plugins` text COLLATE utf8_unicode_ci NOT NULL,
  `append` int(4) NOT NULL,
  `appendtype` int(4) NOT NULL,
  `bannertype` int(4) NOT NULL,
  `alt_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_imageurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_contenttype` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `views` int(11) NOT NULL,
  `total_clicks` int(11) NOT NULL,
  `unique_click` int(11) NOT NULL,
  `acls_updated` datetime NOT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transparent` int(1) NOT NULL,
  `parameters` text COLLATE utf8_unicode_ci NOT NULL,
  `an_banner_id` int(11) NOT NULL,
  `as_banner_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `mark` int(1) NOT NULL,
  `ad_direct_status` int(4) NOT NULL,
  `ad_direct_rejection_reason_id` int(4) NOT NULL,
  `ext_bannertype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `website_id`, `zoneid`, `contenttype`, `pluginversion`, `storagetype`, `filename`, `imageurl`, `htmltemplate`, `htmlcache`, `width`, `height`, `weight`, `seq`, `target`, `url`, `title`, `alt`, `statustext`, `bannertext`, `imagetext`, `description`, `adserver`, `block`, `capping`, `session_capping`, `compiledlimitation`, `acl_plugins`, `append`, `appendtype`, `bannertype`, `alt_filename`, `alt_imageurl`, `alt_contenttype`, `comments`, `views`, `total_clicks`, `unique_click`, `acls_updated`, `keyword`, `transparent`, `parameters`, `an_banner_id`, `as_banner_id`, `status`, `mark`, `ad_direct_status`, `ad_direct_rejection_reason_id`, `ext_bannertype`, `order_no`, `created_at`, `updated_at`) VALUES
(14, 4, 8, '', 0, 'web', 'uploads/adbanner_images/2014-12-30/av/4q/xk4ljil2ifz0isknwia7378gv056.suckhoe.gif', '', '', '', 732, 90, 0, 0, '', 'http://sacdepvasuckhoe.wordpress.com/2014/12/19/qua-tang-giang-sinh-nam-moi/', 'Tin tức Việt Nam', '', '', '', '', 'Banner top header sacdepvasuckhoe 02', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 1134, 176, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 1, '2015-05-13 15:51:17', '2014-12-30 19:58:21'),
(15, 4, 8, '', 0, 'web', 'uploads/adbanner_images/2014-12-23/cb/1l/dx1st2zd8h0tlf7cq6ljzlbvkcrx.QC-on-tintuc_366x90.jpg', '', '', '', 366, 90, 0, 0, '', 'http://domainday.vn/', 'Tin tức Việt Nam', '', '', '', '', 'Banner HT02', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 680, 116, '0000-00-00 00:00:00', '', 0, '', 0, 0, 0, 0, 0, 0, '', 2, '2015-05-12 09:11:09', '2014-12-30 00:37:10'),
(16, 4, 9, '', 0, 'web', 'files/jY8DoJyv2m.HC01.jpg', '', '', '', 495, 90, 0, 0, '', 'http://tintuc.vn/', 'Tin tức Việt Nam', '', '', '', '', 'Banner HC01', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 7, 1, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 3, '2015-01-12 01:58:30', '2014-11-07 03:33:44'),
(17, 4, 10, '', 0, 'web', 'files/tpKoF3bsvd.HC02.jpg', '', '', '', 495, 90, 0, 0, '', 'http://tintuc.vn/', 'Tin tức Việt Nam', '', '', '', '', 'Banner HC02', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 3, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 4, '2015-01-12 01:58:30', '2014-11-07 03:33:52'),
(18, 4, 11, '', 0, 'web', 'files/NuhR1YSdDC.HC03.jpg', '', '', '', 495, 90, 0, 0, '', 'http://tintuc.vn/', 'Tin tức Việt Nam', '', '', '', '', 'Banner HC03', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 5, '2015-01-12 01:58:30', '2014-11-07 03:34:00'),
(19, 4, 12, '', 0, 'web', 'files/cblXgzVrZb.HC04.jpg', '', '', '', 495, 90, 0, 0, '', 'http://tintuc.vn/', 'Tin tức Việt Nam', '', '', '', '', 'Banner HC04', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 6, '2015-01-12 02:03:08', '2014-11-07 03:34:39'),
(20, 4, 13, '', 0, 'html', '', '', '<div class="ads-space">\r\n         <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n         <ins class="adsbygoogle"\r\n              style="display:inline-block;width:160px;height:600px"\r\n              data-ad-client="ca-pub-5128894772635532"\r\n              data-ad-slot="4229753200"></ins>\r\n         <script>\r\n         (adsbygoogle = window.adsbygoogle || []).push({});\r\n         </script>\r\n        </div>', '', 160, 600, 0, 0, '', 'http://tintuc.vn/', 'Tin tức Việt Nam', '', '', '', '', 'Banner C01', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 468, 141, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 7, '2015-05-15 07:22:04', '2014-12-24 01:18:01'),
(21, 4, 14, '', 0, 'web', 'files/sH3X0wN6f6.DL01.jpg', '', '', '', 160, 600, 0, 0, '', 'http://tintuc.vn/', 'Tin tức Việt Nam', '', '', '', '', 'Banner DL01', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 8, '2015-01-12 02:03:08', '2014-11-07 03:34:58'),
(22, 4, 4, '', 0, 'html', '', '', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:728px;height:90px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="1537409204"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 728, 90, 1, 0, '', 'http://skcd.com.vn/', '', '', '', '', '', '', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', 'sức khỏe, cộng đồng', 0, '', 0, 0, 1, 0, 0, 0, '', 9, '2015-01-12 01:49:22', '2014-11-17 23:32:25'),
(23, 4, 5, '', 0, 'html', '', '', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 1, 0, '', 'http://skcd.com.vn/', '', '', '', '', '', 'Banner Right Top skcd.com.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', 'sức khỏe, cộng đồng', 0, '', 0, 0, 1, 0, 0, 0, '', 10, '2015-01-12 01:49:22', '2014-11-17 23:38:36'),
(24, 4, 6, '', 0, 'html', '', '', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:600px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="4490875609"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 600, 1, 0, '', 'http://skcd.com.vn/', '', '', '', '', '', 'Banner Right Middle skcd.com.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', 'sức khỏe, cộng đồng', 0, '', 0, 0, 1, 0, 0, 0, '', 11, '2015-01-12 01:49:22', '2014-11-17 23:45:19'),
(25, 4, 15, '', 0, 'html', '', '', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:320px;height:100px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="4769966800"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 320, 100, 1, 0, '', '', '', '', '', '', '', 'Banner quảng cáo trên mobile kích thước 320x100px', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 12, '2015-01-12 02:03:08', '2014-11-19 23:35:50'),
(26, 4, 16, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:320px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="6246700000"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 320, 250, 1, 0, '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 13, '2015-01-12 02:03:08', '2014-11-19 23:28:25'),
(27, 4, 17, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:block"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="7723433202"\r\n     data-ad-format="auto"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 1, 0, '', '', '', '', '', '', '', 'Banner quảng cáo trên mobile kích thước tùy chỉnh', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 14, '2015-01-12 02:03:45', '2014-11-19 23:28:05'),
(28, 5, 18, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 0, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị dưới phần comment', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 15, '2015-01-12 01:50:11', '2014-11-24 21:10:28'),
(29, 5, 19, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 0, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị dưới bài nổi bật của trang chuyên mục', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 16, '2015-01-12 01:50:11', '2014-11-24 21:10:15'),
(30, 5, 20, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 0, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị trên trang chủ phiên bản mobile của trang tintuc.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 17, '2015-01-12 01:51:02', '2014-12-02 21:29:48'),
(31, 5, 21, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 0, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị dưới cùng trên trang chuyên mục phiên bản mobile của trang tintuc.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 18, '2015-01-12 01:51:02', '2014-12-02 21:31:19'),
(32, 5, 23, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 0, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị trên trang tag (tiêu điểm) phiên bản mobile của trang tintuc.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 19, '2015-01-12 01:51:02', '2014-12-02 21:59:03'),
(33, 5, 24, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 0, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị trên trang tin hot phiên bản mobile của trang tintuc.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 20, '2015-01-12 01:51:02', '2014-12-02 21:39:22'),
(34, 5, 25, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 0, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị trên trang tin tức 24h phiên bản mobile của trang tintuc.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 21, '2015-01-12 01:52:02', '2014-12-02 21:40:24'),
(35, 5, 22, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 0, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị trang chi tiết trên phiên bản mobile của trang tintuc.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 22, '2015-01-12 01:52:02', '2014-12-02 22:12:46'),
(36, 4, 26, '', 0, 'web', 'uploads/adbanner_images/2014-12-16/6v/xm/qo0ucei1jhcipwoneaosdnnb6gad.timvexekhach.png', '', '', '', 300, 90, 1, 0, '', 'http://oto-xemay.vn/tim-ve-xe-khach-truc-tuyen.html', '', '', '', '', '', 'Banner quảng cáo cột phải chuyên mục ô tô - xe máy', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 168, 157, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 23, '2015-05-15 04:12:45', '2015-05-14 21:12:45'),
(37, 4, 7, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<!-- p-728x90 -->\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:728px;height:90px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="8148167208"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 728, 90, 1, 0, '', '', '', '', '', '', '', 'Banner top header sacdepvasuckhoe 01', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 3242, 2766, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 24, '2015-04-13 04:08:37', '2015-04-12 21:08:37'),
(38, 4, 27, '', 0, 'html', '', '', '<div class="ads-space" style="margin-top: 15px;">\r\n         <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n         <ins class="adsbygoogle"\r\n              style="display:inline-block;width:160px;height:600px"\r\n              data-ad-client="ca-pub-5128894772635532"\r\n              data-ad-slot="4229753200"></ins>\r\n         <script>\r\n         (adsbygoogle = window.adsbygoogle || []).push({});\r\n         </script>\r\n        </div>', '', 160, 600, 1, 0, '', '', '', '', '', '', '', 'Banner Google Adsense hiển thị trên trang tin tức 24h của trang tintuc.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 25, '2015-01-12 02:16:09', '2014-12-24 01:00:59'),
(39, 6, 28, '', 0, 'web', 'uploads/adbanner_images/2015-01-26/rw/vu/k60qhjob43qj35xnwgej75nulg7c.Pho Ong Hung_banner tin tuc moi_26.1.jpg', '', '', '', 300, 500, 1, 0, '', 'http://phoonghung.vn/vi/tin-tuc/hop-bao-chuong-trinh-thach-thuc-pho-khong-lo-nam-2015-92.html', '', 'Banner quảng cáo cho CÔNG TY TNHH THÔNG TIN TRƯỜNG PHÁT', '', '', '', 'Banner quảng cáo cho CÔNG TY TNHH THÔNG TIN TRƯỜNG PHÁT (trên trang chủ)', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 101, 97, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 26, '2015-02-11 19:23:29', '2015-02-11 12:23:29'),
(41, 6, 29, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 1, 0, '', '', '', 'Banner quảng cáo cho CÔNG TY TNHH THÔNG TIN TRƯỜNG PHÁT', '', '', '', 'Banner quảng cáo (trên trang danh mục)', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 1854, 1683, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 28, '2015-02-07 05:25:37', '2015-02-06 22:25:37'),
(42, 4, 30, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 1, 0, '', '', '', '', '', '', '', 'Banner 300 x 250', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 29, '2015-02-05 06:13:04', '2015-02-04 23:13:04'),
(43, 4, 31, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<!-- tt-728x90 -->\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:728px;height:90px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="5707338409"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 728, 90, 1, 0, '', '', '', '', '', '', '', 'Banner 728 x 90', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 30, '2015-02-05 06:21:20', '2015-02-04 23:21:20'),
(44, 4, 32, '', 0, 'html', '', '', '<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>\r\n<ins class="adsbygoogle"\r\n     style="display:inline-block;width:300px;height:250px"\r\n     data-ad-client="ca-pub-5128894772635532"\r\n     data-ad-slot="3014142402"></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', '', 300, 250, 1, 0, '', '', '', '', '', '', '', 'Banner 300 x 250 (lần 2)', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 31, '2015-02-04 22:57:07', '2015-02-04 22:57:07'),
(45, 7, 33, '', 0, 'html', 'uploads/adbanner_images/2015-05-18/tr/xg/gc9e24k4qpzkfxze1rfsjexdw4rm.TintucVN-Tet-thieu-nhi.swf', '', '<object width="728" height="90" data="http://qc.tintuc.vn/uploads/adbanner_images/2015-05-18/tr/xg/gc9e24k4qpzkfxze1rfsjexdw4rm.TintucVN-Tet-thieu-nhi.swf"></object>', '', 728, 90, 0, 0, '', 'http://gohappy.vn/', '', '', '', '', '', 'Banner hiển thị tới trang gohappy.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 1, 1, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 32, '2015-05-18 09:55:51', '2015-05-18 02:55:51'),
(46, 7, 33, '', 0, 'html', 'uploads/adbanner_images/2015-05-18/bd/7z/zzaclangz0gxrpondqgdgow5u0z6.TintucVN-banner-trang-chu.swf', '', '<object width="728" height="90" data="http://qc.tintuc.vn/uploads/adbanner_images/2015-05-18/bd/7z/zzaclangz0gxrpondqgdgow5u0z6.TintucVN-banner-trang-chu.swf"></object>', '', 728, 90, 0, 0, '', 'http://gohappy.vn/', '', '', '', '', '', 'Banner chạy song song hiển thị tới trang gohappy.vn', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 33, '2015-05-18 09:56:58', '2015-05-18 02:56:58'),
(47, 7, 34, '', 0, 'html', 'uploads/adbanner_images/2015-05-15/il/h0/pwtp0b0lqmejoff906ml69ukd91v.TintucVN-do-choi-cho-be-banner-chay-tat-ca-cac-trang-con.swf', '', '<object width="728" height="90" data="http://qc.tintuc.vn/uploads/adbanner_images/2015-05-15/il/h0/pwtp0b0lqmejoff906ml69ukd91v.TintucVN-do-choi-cho-be-banner-chay-tat-ca-cac-trang-con.swf"></object>', '', 728, 90, 0, 0, '', '', '', '', '', '', '', 'Banner ở top hiển thị trên tất cả các trang con đi tới trang goHappy', '', 0, 0, 0, '', '', 0, 0, 0, '', '', '', '', 0, 0, 0, '0000-00-00 00:00:00', '', 0, '', 0, 0, 1, 0, 0, 0, '', 34, '2015-05-15 05:58:42', '2015-05-14 22:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE IF NOT EXISTS `campaigns` (
`id` int(11) NOT NULL,
  `campaignname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `campaign_type` int(1) DEFAULT NULL,
  `clientid` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `clicks` int(11) DEFAULT NULL,
  `conversions` int(11) DEFAULT NULL,
  `expire` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `weight` int(4) DEFAULT NULL,
  `target_impression` int(11) DEFAULT NULL,
  `target_click` int(11) DEFAULT NULL,
  `target_conversion` int(11) DEFAULT NULL,
  `anonymous` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companion` int(1) DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `revenue` float DEFAULT NULL,
  `revenue_type` int(6) NOT NULL,
  `updated` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `capping` int(11) DEFAULT NULL,
  `session_capping` int(11) DEFAULT NULL,
  `an_campaign_id` int(11) DEFAULT NULL,
  `as_campaign_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `an_status` int(11) DEFAULT NULL,
  `as_reject_reason` int(11) DEFAULT NULL,
  `hosted_views` int(11) DEFAULT NULL,
  `hosted_clicks` int(11) DEFAULT NULL,
  `viewwindow` int(9) DEFAULT NULL,
  `clickwindow` int(9) DEFAULT NULL,
  `ecpm` float DEFAULT NULL,
  `min_impressions` int(11) DEFAULT NULL,
  `ecpm_enabled` int(4) DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `campaignname`, `campaign_type`, `clientid`, `views`, `clicks`, `conversions`, `expire`, `active`, `priority`, `weight`, `target_impression`, `target_click`, `target_conversion`, `anonymous`, `companion`, `comments`, `revenue`, `revenue_type`, `updated`, `block`, `capping`, `session_capping`, `an_campaign_id`, `as_campaign_id`, `status`, `an_status`, `as_reject_reason`, `hosted_views`, `hosted_clicks`, `viewwindow`, `clickwindow`, `ecpm`, `min_impressions`, `ecpm_enabled`, `order_no`, `created_at`, `updated_at`) VALUES
(4, 'Chiến dịch quảng cáo cho trang sức khỏe cộng đồng', 1, NULL, NULL, 0, NULL, '', '', 10, NULL, NULL, 0, NULL, NULL, NULL, '', 0, 2, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2015-05-16 07:22:30', '2015-05-16 00:22:30'),
(5, 'Chiến dịch quảng cáo cho trang tin tức Việt Nam', 1, NULL, NULL, 0, NULL, '', '', 10, NULL, NULL, 0, NULL, NULL, NULL, '', 0, 1, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2015-05-16 07:22:54', '2015-05-16 00:22:54'),
(6, 'Reema', 2, 3, NULL, 0, NULL, 'F9Mg15ywQ', 'iYe1DUwHOhL', 10, NULL, NULL, 0, NULL, NULL, NULL, 'Facebook:If you''re a new page, the first thing you should do is to have a nice ininerstteg campaign and promote it via ads.But make sure your ads are highly targeted. Poorly targeted ads will get you a community that is non-responisve.Once you build the initial set of  likes'', you need to back it up with great content. Content that is both relevant, as well as ininerstteg. More often than not, brands tend to publish relevant content that is not packaged properly. So you have to make sure that it is of great quality.You can also tie up with some other pages that bigger than you and tap into their community. But the community has to be similar in nature.Here''s an example that might help you iin uderstanding this better:Suppose you''re a Facebook Apps Developer. You have impeccable knowledge about something that many would want to know about. What you can do is, you can tie up with any FB page that is about social media and ask them to hold special live chat for their community members where they can ask their doubts about FB apps to you.This will help you build and authority and also get you the much required visiblity.Start off with the above things and I am confident you will not be disappointed.Twitter:Conversations. Conversations. Conversations.  +3Was this answer helpful? http://ojlfhrw.com [url=http://ydbzvwxfja.com]ydbzvwxfja[/url] [link=http://bbeqzypvax.com]bbeqzypvax[/link]', 0, 1, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2015-05-12 16:45:56', '2015-05-12 09:45:56'),
(7, 'Chiến dịch quảng cáo cho trang sacdepvasuckhoe.wordpress.com', 1, NULL, NULL, 0, NULL, '2015-02-24', '2014-12-24', 10, NULL, NULL, 0, NULL, NULL, NULL, '', 0, 1, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2015-05-16 07:23:34', '2015-05-16 00:23:34'),
(8, 'Chiến dịch quảng cáo phở ông Hùng trên tintuc.vn', 1, 2, NULL, 0, NULL, '2015-02-26', '', 10, NULL, NULL, 0, NULL, NULL, NULL, '', 0, 1, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2015-05-16 07:23:54', '2015-05-16 00:23:54'),
(9, 'Chiến dịch quảng cáo cho trang web goHappy.vn', 1, 3, NULL, 0, NULL, '', '2015-04-22', 10, NULL, NULL, 0, NULL, NULL, NULL, '', 0, 1, NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2015-05-16 07:24:18', '2015-05-16 00:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_no` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_id`, `created_at`, `updated_at`, `order_no`, `status`) VALUES
(26, 'Videos/Movies', 20, '2015-04-30 14:12:10', '2015-04-30 07:12:10', 1, 1),
(127, 'Domain Registrations', 124, '2015-04-28 11:16:33', '2015-04-28 04:16:33', 1, 0),
(128, 'Email Marketing', 124, '2015-04-28 11:17:14', '2015-04-28 04:17:14', 1, 0),
(129, 'Internet Service Providers', 124, '2015-04-28 11:17:55', '2015-04-28 04:17:55', 1, 0),
(130, 'Search Engine', 124, '2015-04-28 11:18:37', '2015-04-28 04:18:37', 1, 0),
(131, 'Web Design', 124, '2015-04-28 11:18:50', '2015-04-28 04:18:50', 1, 0),
(132, 'Web Hosting/Servers', 124, '2015-04-28 11:19:50', '2015-04-28 04:19:50', 1, 0),
(133, 'Web Tools', 124, '2015-04-28 11:20:28', '2015-04-28 04:20:28', 1, 0),
(134, 'Recreation : Leisure', 0, '2015-04-28 11:22:57', '2015-04-28 04:22:57', 1, 0),
(135, 'Astrology', 134, '2015-04-28 11:24:08', '2015-04-28 04:24:08', 1, 0),
(136, 'Betting/Gaming', 134, '2015-04-28 11:24:23', '2015-04-28 04:24:23', 1, 0),
(137, 'Camping and Hiking', 134, '2015-04-28 11:24:58', '2015-04-28 04:24:58', 1, 0),
(138, 'Communities', 134, '2015-04-28 11:25:39', '2015-04-28 04:25:39', 1, 0),
(139, 'Matchmaking', 134, '2015-04-28 11:26:22', '2015-04-28 04:26:22', 1, 0),
(140, 'Outdoors', 134, '2015-04-28 11:26:36', '2015-04-28 04:26:36', 1, 0),
(141, 'Tobacco', 134, '2015-04-28 11:27:31', '2015-04-28 04:27:31', 1, 0),
(142, 'Seasonal', 0, '2015-04-28 11:29:18', '2015-04-28 04:29:18', 1, 0),
(143, 'Autumn', 142, '2015-04-28 11:29:36', '2015-04-28 04:29:36', 1, 0),
(144, 'Back to School', 142, '2015-04-28 11:30:13', '2015-04-28 04:30:13', 1, 0),
(145, 'Christmas', 142, '2015-04-28 11:30:51', '2015-04-28 04:30:51', 1, 0),
(146, 'Easter', 142, '2015-04-28 11:31:32', '2015-04-28 04:31:32', 1, 0),
(147, 'Father''s Day', 142, '2015-04-28 11:31:51', '2015-04-28 04:31:51', 1, 0),
(148, 'Halloween', 142, '2015-04-28 11:32:29', '2015-04-28 04:32:29', 1, 0),
(149, 'Mother''s Day', 142, '2015-04-28 11:33:08', '2015-04-28 04:33:08', 1, 0),
(150, 'Spring', 142, '2015-04-28 11:33:48', '2015-04-28 04:33:48', 1, 0),
(151, 'Summer', 142, '2015-04-28 11:34:08', '2015-04-28 04:34:08', 1, 0),
(152, 'Tax Season', 142, '2015-04-28 11:34:44', '2015-04-28 04:34:44', 1, 0),
(153, 'Valentine''s Day', 142, '2015-04-28 11:35:24', '2015-04-28 04:35:24', 1, 0),
(154, 'Winter', 142, '2015-04-28 11:36:04', '2015-04-28 04:36:04', 1, 0),
(155, 'Shops/Malls', 0, '2015-04-28 11:36:24', '2015-04-28 04:36:24', 1, 0),
(156, 'Virtual Malls', 155, '2015-04-28 11:37:01', '2015-04-28 04:37:01', 1, 0),
(157, 'Sports : Fitness', 0, '2015-04-28 11:54:05', '2015-04-28 04:54:05', 1, 0),
(158, 'Apparel', 157, '2015-04-28 11:55:24', '2015-04-28 04:55:24', 1, 0),
(159, 'Collectibles and Memorabilia', 157, '2015-04-28 11:55:52', '2015-04-28 04:55:52', 1, 0),
(160, 'Equipment', 157, '2015-04-28 11:56:28', '2015-04-28 04:56:28', 1, 0),
(161, 'Exercise : Health', 157, '2015-04-28 11:56:56', '2015-04-28 04:56:56', 1, 0),
(162, 'Golf', 157, '2015-04-28 11:57:38', '2015-04-28 04:57:38', 1, 0),
(163, 'Professional Sports Organizations', 157, '2015-04-28 12:02:19', '2015-04-28 05:02:19', 1, 0),
(164, 'Sports', 157, '2015-04-28 12:02:55', '2015-04-28 05:02:55', 1, 0),
(165, 'Summer Sports', 157, '2015-04-28 12:03:17', '2015-04-28 05:03:17', 1, 0),
(166, 'Water Sports', 157, '2015-04-28 12:03:55', '2015-04-28 05:03:55', 1, 0),
(167, 'Winter Sports', 157, '2015-04-28 12:04:34', '2015-04-28 05:04:34', 1, 0),
(168, 'Telecommunications', 0, '2015-04-28 12:37:13', '2015-04-28 05:37:13', 1, 0),
(169, 'Online/Wireless', 168, '2015-04-28 12:38:11', '2015-04-28 05:38:11', 1, 0),
(170, 'Phone Card Services', 168, '2015-04-28 12:39:00', '2015-04-28 05:39:00', 1, 0),
(171, 'Telephone Services', 168, '2015-04-28 12:39:48', '2015-04-28 05:39:48', 1, 0),
(172, 'Travel', 0, '2015-04-28 12:51:09', '2015-04-28 05:51:09', 1, 0),
(173, 'Accessories', 172, '2015-04-28 12:51:34', '2015-04-28 05:51:34', 1, 0),
(174, 'Air', 172, '2015-04-28 12:52:12', '2015-04-28 05:52:12', 1, 0),
(175, 'Car', 172, '2015-04-28 12:53:29', '2015-04-28 05:53:29', 1, 0),
(176, 'Hotel', 172, '2015-04-28 12:54:16', '2015-04-28 05:54:16', 1, 0),
(177, 'Luggage', 172, '2015-04-28 12:54:48', '2015-04-28 05:54:48', 1, 0),
(178, 'Vacation', 172, '2015-04-28 12:54:50', '2015-04-28 05:54:50', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cclicks`
--

CREATE TABLE IF NOT EXISTS `cclicks` (
`id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `day` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `click` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cclicks`
--

INSERT INTO `cclicks` (`id`, `website_id`, `day`, `user`, `click`) VALUES
(12, 0, '2014-11-07', 5, 6),
(13, 0, '2014-11-08', 1, 40),
(14, 0, '2014-11-09', 1, 15),
(15, 0, '2014-11-10', 13, 16),
(16, 0, '2014-11-11', 11, 25),
(17, 0, '2014-11-12', 0, 18),
(18, 0, '2014-11-13', 2, 7),
(19, 0, '2014-11-14', 1, 13),
(20, 0, '2014-11-15', 1, 3),
(21, 0, '2014-11-16', 1, 2),
(22, 0, '2014-11-17', 1, 88),
(23, 0, '2014-11-18', 1, 116),
(24, 0, '2014-11-19', 38, 111),
(25, 0, '2014-11-20', 78, 81),
(26, 0, '2014-11-21', 84, 86),
(27, 0, '2014-11-22', 61, 62),
(28, 0, '2014-11-23', 33, 33),
(29, 0, '2014-11-24', 70, 73),
(30, 0, '2014-11-25', 64, 67),
(31, 0, '2014-11-26', 40, 42),
(32, 0, '2014-11-27', 7, 8),
(33, 0, '2014-12-02', 17, 18),
(34, 0, '2014-12-03', 25, 30),
(35, 0, '2014-12-04', 36, 37),
(36, 0, '2014-12-05', 39, 42),
(37, 0, '2014-12-06', 31, 35),
(38, 0, '2014-12-07', 27, 29),
(39, 0, '2014-12-08', 42, 48),
(40, 0, '2014-12-09', 41, 48),
(41, 0, '2014-12-10', 35, 35),
(42, 0, '2014-12-11', 29, 31),
(43, 0, '2014-12-12', 29, 32),
(44, 0, '2014-12-13', 33, 36),
(45, 0, '2014-12-14', 27, 30),
(46, 0, '2014-12-15', 25, 26),
(47, 0, '2014-12-16', 26, 31),
(48, 0, '2014-12-17', 37, 41),
(49, 0, '2014-12-18', 42, 46),
(50, 0, '2014-12-19', 37, 51),
(51, 0, '2014-12-20', 42, 45),
(52, 0, '2014-12-21', 39, 43),
(53, 0, '2014-12-22', 46, 51),
(54, 0, '2014-12-23', 6, 7),
(55, 4, '2014-12-23', 42, 84),
(56, 0, '2014-12-24', 4, 5),
(57, 4, '2014-12-24', 37, 70),
(58, 4, '2014-12-25', 42, 69),
(59, 4, '2014-12-26', 31, 42),
(60, 4, '2014-12-27', 36, 40),
(61, 4, '2014-12-28', 31, 32),
(62, 4, '2014-12-29', 41, 50),
(63, 4, '2014-12-30', 46, 67),
(64, 4, '2014-12-31', 39, 48),
(65, 4, '2015-01-01', 39, 39),
(66, 4, '2015-01-02', 52, 52),
(67, 0, '2015-01-03', 2, 2),
(68, 4, '2015-01-03', 46, 46),
(69, 0, '2015-01-04', 2, 2),
(70, 4, '2015-01-04', 59, 61),
(71, 4, '2015-01-05', 44, 45),
(72, 0, '2015-01-06', 2, 2),
(73, 4, '2015-01-06', 50, 50),
(74, 0, '2015-01-07', 1, 2),
(75, 4, '2015-01-07', 46, 46),
(76, 4, '2015-01-08', 64, 72),
(77, 4, '2015-01-09', 52, 60),
(78, 4, '2015-01-10', 51, 54),
(79, 0, '2015-01-11', 2, 2),
(80, 4, '2015-01-11', 63, 64),
(81, 4, '2015-01-12', 58, 61),
(82, 0, '2015-01-13', 2, 2),
(83, 4, '2015-01-13', 46, 53),
(84, 4, '2015-01-14', 51, 55),
(85, 4, '2015-01-15', 58, 60),
(86, 0, '2015-01-16', 1, 1),
(87, 4, '2015-01-16', 45, 46),
(88, 4, '2015-01-17', 56, 61),
(89, 0, '2015-01-18', 2, 3),
(90, 4, '2015-01-18', 50, 50),
(91, 0, '2015-01-19', 1, 1),
(92, 4, '2015-01-19', 49, 50),
(93, 0, '2015-01-20', 2, 2),
(94, 4, '2015-01-20', 49, 50),
(95, 4, '2015-01-21', 87, 88),
(96, 4, '2015-01-22', 75, 78),
(97, 4, '2015-01-23', 96, 100),
(98, 4, '2015-01-24', 73, 74),
(99, 4, '2015-01-25', 80, 82),
(100, 4, '2015-01-26', 52, 52),
(101, 6, '2015-01-26', 57, 59),
(102, 4, '2015-01-27', 91, 94),
(103, 6, '2015-01-27', 185, 197),
(104, 4, '2015-01-28', 66, 70),
(105, 6, '2015-01-28', 186, 194),
(106, 6, '2015-01-29', 211, 221),
(107, 4, '2015-01-29', 74, 81),
(108, 6, '2015-01-30', 167, 177),
(109, 4, '2015-01-30', 62, 63),
(110, 4, '2015-01-31', 84, 91),
(111, 6, '2015-01-31', 192, 204),
(112, 6, '2015-02-01', 147, 152),
(113, 4, '2015-02-01', 62, 66),
(114, 6, '2015-02-02', 165, 172),
(115, 4, '2015-02-02', 85, 88),
(116, 0, '2015-02-03', 3, 3),
(117, 6, '2015-02-03', 172, 176),
(118, 4, '2015-02-03', 93, 96),
(119, 6, '2015-02-04', 174, 185),
(120, 4, '2015-02-04', 90, 94),
(121, 6, '2015-02-05', 51, 53),
(122, 4, '2015-02-05', 15, 16),
(123, 6, '2015-02-06', 1, 1),
(124, 4, '2015-02-06', 1, 1),
(125, 0, '2015-02-07', 1, 1),
(126, 6, '2015-02-07', 1, 1),
(127, 4, '2015-02-07', 3, 3),
(128, 0, '2015-02-08', 1, 1),
(129, 4, '2015-02-08', 1, 1),
(130, 0, '2015-02-09', 1, 1),
(131, 4, '2015-02-10', 3, 3),
(132, 0, '2015-02-11', 1, 1),
(133, 4, '2015-02-11', 3, 3),
(134, 6, '2015-02-11', 1, 1),
(135, 4, '2015-02-12', 8, 8),
(136, 4, '2015-02-13', 3, 3),
(137, 0, '2015-02-14', 1, 1),
(138, 4, '2015-02-14', 6, 6),
(139, 0, '2015-02-15', 1, 1),
(140, 4, '2015-02-15', 2, 2),
(141, 4, '2015-02-16', 7, 7),
(142, 4, '2015-02-17', 7, 7),
(143, 4, '2015-02-18', 4, 4),
(144, 4, '2015-02-19', 3, 3),
(145, 0, '2015-02-20', 2, 2),
(146, 4, '2015-02-20', 2, 2),
(147, 0, '2015-02-21', 1, 1),
(148, 4, '2015-02-21', 4, 4),
(149, 4, '2015-02-22', 4, 4),
(150, 4, '2015-02-23', 8, 8),
(151, 4, '2015-02-24', 3, 3),
(152, 0, '2015-02-25', 1, 1),
(153, 4, '2015-02-25', 2, 2),
(154, 0, '2015-02-26', 1, 1),
(155, 4, '2015-02-26', 5, 5),
(156, 4, '2015-02-27', 3, 3),
(157, 4, '2015-02-28', 3, 3),
(158, 0, '2015-03-01', 1, 1),
(159, 4, '2015-03-01', 5, 5),
(160, 4, '2015-03-02', 4, 4),
(161, 4, '2015-03-03', 1, 1),
(162, 4, '2015-03-04', 6, 6),
(163, 4, '2015-03-05', 5, 6),
(164, 4, '2015-03-06', 5, 5),
(165, 0, '2015-03-07', 1, 1),
(166, 4, '2015-03-07', 2, 2),
(167, 4, '2015-03-08', 2, 2),
(168, 4, '2015-03-09', 5, 5),
(169, 0, '2015-03-10', 1, 1),
(170, 4, '2015-03-10', 4, 4),
(171, 4, '2015-03-11', 7, 7),
(172, 4, '2015-03-12', 5, 5),
(173, 4, '2015-03-13', 4, 4),
(174, 4, '2015-03-14', 3, 3),
(175, 4, '2015-03-15', 7, 7),
(176, 4, '2015-03-16', 4, 4),
(177, 4, '2015-03-17', 3, 3),
(178, 0, '2015-03-18', 1, 1),
(179, 4, '2015-03-18', 2, 2),
(180, 4, '2015-03-19', 6, 6),
(181, 0, '2015-03-20', 2, 2),
(182, 4, '2015-03-20', 2, 2),
(183, 4, '2015-03-21', 5, 5),
(184, 4, '2015-03-22', 6, 6),
(185, 0, '2015-03-23', 1, 1),
(186, 4, '2015-03-23', 3, 3),
(187, 4, '2015-03-24', 6, 6),
(188, 0, '2015-03-25', 1, 1),
(189, 4, '2015-03-25', 5, 5),
(190, 0, '2015-03-26', 1, 1),
(191, 4, '2015-03-26', 6, 6),
(192, 4, '2015-03-27', 6, 6),
(193, 4, '2015-03-28', 5, 5),
(194, 4, '2015-03-29', 4, 4),
(195, 4, '2015-03-30', 4, 5),
(196, 4, '2015-03-31', 4, 4),
(197, 4, '2015-04-01', 7, 7),
(198, 4, '2015-04-02', 1, 1),
(199, 4, '2015-04-03', 5, 5),
(200, 4, '2015-04-04', 6, 6),
(201, 4, '2015-04-05', 7, 7),
(202, 4, '2015-04-06', 3, 3),
(203, 4, '2015-04-07', 6, 6),
(204, 0, '2015-04-08', 1, 1),
(205, 4, '2015-04-08', 5, 5),
(206, 4, '2015-04-09', 3, 3),
(207, 0, '2015-04-10', 1, 1),
(208, 4, '2015-04-10', 2, 2),
(209, 4, '2015-04-11', 7, 7),
(210, 4, '2015-04-12', 5, 5),
(211, 4, '2015-04-13', 4, 4),
(212, 4, '2015-04-14', 3, 3),
(213, 0, '2015-04-15', 1, 1),
(214, 4, '2015-04-20', 1, 2),
(215, 4, '2015-04-21', 2, 2),
(216, 4, '2015-04-22', 1, 1),
(217, 7, '2015-04-22', 1, 1),
(218, 0, '2015-04-23', 1, 1),
(219, 4, '2015-04-23', 1, 1),
(220, 0, '2015-04-24', 1, 1),
(221, 4, '2015-04-24', 1, 1),
(222, 4, '2015-04-25', 2, 2),
(223, 4, '2015-04-26', 1, 1),
(224, 4, '2015-04-27', 1, 1),
(225, 0, '2015-04-28', 1, 1),
(226, 4, '2015-04-28', 3, 3),
(227, 4, '2015-04-29', 2, 2),
(228, 0, '2015-05-02', 1, 1),
(229, 0, '2015-05-03', 2, 2),
(230, 0, '2015-05-04', 1, 1),
(231, 4, '2015-05-05', 1, 1),
(232, 0, '2015-05-06', 1, 1),
(233, 4, '2015-05-06', 2, 2),
(234, 0, '2015-05-07', 1, 1),
(235, 4, '2015-05-07', 2, 2),
(236, 4, '2015-05-08', 2, 3),
(237, 4, '2015-05-09', 5, 6),
(238, 0, '2015-05-10', 1, 1),
(239, 4, '2015-05-10', 1, 1),
(240, 0, '2015-05-11', 2, 2),
(241, 4, '2015-05-11', 1, 1),
(242, 0, '2015-05-12', 2, 3),
(243, 4, '2015-05-12', 3, 4),
(244, 0, '2015-05-13', 2, 2),
(245, 4, '2015-05-13', 2, 2),
(246, 4, '2015-05-14', 2, 2),
(247, 4, '2015-05-15', 3, 3),
(248, 4, '2015-05-16', 2, 2),
(249, 4, '2015-05-17', 1, 1),
(250, 0, '2015-05-18', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
`id` int(11) NOT NULL,
  `website_id` int(9) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compiledlimitation` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clicks`
--

CREATE TABLE IF NOT EXISTS `clicks` (
`id` int(11) NOT NULL,
  `bannerid` int(11) NOT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `region` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `org` text COLLATE utf8_unicode_ci NOT NULL,
  `click_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4484 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clicks`
--

INSERT INTO `clicks` (`id`, `bannerid`, `ip_address`, `user_agent`, `city`, `region`, `country`, `lat`, `long`, `org`, `click_at`) VALUES
(4432, 36, '171.224.18.251', '', '', '', '', '', '', '', '2015-04-26 08:52:37'),
(4433, 36, '117.7.221.240', '', '', '', '', '', '', '', '2015-04-27 00:36:11'),
(4434, 20, '66.249.79.92', '', '', '', '', '', '', '', '2015-04-28 01:11:58'),
(4435, 36, '27.74.210.16', '', '', '', '', '', '', '', '2015-04-27 22:13:10'),
(4436, 36, '14.176.147.113', '', '', '', '', '', '', '', '2015-04-28 00:59:36'),
(4437, 36, '14.164.80.144', '', '', '', '', '', '', '', '2015-04-28 09:07:44'),
(4438, 36, '113.181.151.224', '', '', '', '', '', '', '', '2015-04-28 18:22:50'),
(4439, 20, '66.249.79.92', '', '', '', '', '', '', '', '2015-04-29 16:03:54'),
(4440, 20, '66.249.79.92', '', '', '', '', '', '', '', '2015-05-02 01:35:53'),
(4441, 14, '104.140.83.180', '', '', '', '', '', '', '', '2015-05-03 10:57:18'),
(4442, 14, '104.250.246.113', '', '', '', '', '', '', '', '2015-05-03 11:20:39'),
(4443, 20, '66.249.79.84', '', '', '', '', '', '', '', '2015-05-04 01:39:03'),
(4444, 36, '113.175.149.28', '', '', '', '', '', '', '', '2015-05-05 02:25:05'),
(4445, 20, '66.249.79.134', '', '', '', '', '', '', '', '2015-05-06 01:50:40'),
(4446, 36, '42.118.206.178', '', '', '', '', '', '', '', '2015-05-05 23:28:44'),
(4447, 36, '1.53.155.57', '', '', '', '', '', '', '', '2015-05-06 04:37:02'),
(4448, 20, '66.249.79.160', '', '', '', '', '', '', '', '2015-05-07 08:37:39'),
(4449, 36, '113.163.123.38', '', '', '', '', '', '', '', '2015-05-07 02:10:34'),
(4450, 36, '222.253.177.36', '', '', '', '', '', '', '', '2015-05-07 07:38:43'),
(4451, 36, '118.71.129.168', '', '', '', '', '', '', '', '2015-05-07 22:47:59'),
(4452, 36, '117.7.141.42', '', '', '', '', '', '', '', '2015-05-07 22:50:50'),
(4453, 36, '118.71.129.168', '', '', '', '', '', '', '', '2015-05-07 22:53:33'),
(4454, 36, '42.115.212.192', '', '', '', '', '', '', '', '2015-05-08 19:32:41'),
(4455, 36, '42.115.136.121', '', '', '', '', '', '', '', '2015-05-08 22:27:22'),
(4456, 36, '14.170.65.238', '', '', '', '', '', '', '', '2015-05-09 02:24:12'),
(4457, 20, '66.249.71.110', '', '', '', '', '', '', '', '2015-05-09 10:20:45'),
(4458, 36, '123.24.111.160', '', '', '', '', '', '', '', '2015-05-09 04:51:54'),
(4459, 15, '66.249.71.110', '', '', '', '', '', '', '', '2015-05-09 14:26:53'),
(4460, 15, '118.70.183.81', '', '', '', '', '', '', '', '2015-05-09 18:12:15'),
(4461, 36, '14.173.43.231', '', '', '', '', '', '', '', '2015-05-10 06:30:57'),
(4462, 20, '66.249.71.110', '', '', '', '', '', '', '', '2015-05-11 10:22:43'),
(4463, 20, '66.249.71.93', '', '', '', '', '', '', '', '2015-05-11 10:22:43'),
(4464, 36, '42.119.47.186', '', '', '', '', '', '', '', '2015-05-11 04:15:49'),
(4465, 15, '118.70.183.81', '', '', '', '', '', '', '', '2015-05-11 20:43:09'),
(4466, 14, '66.249.71.93', '', '', '', '', '', '', '', '2015-05-12 02:17:11'),
(4467, 36, '58.186.68.191', '', '', '', '', '', '', '', '2015-05-11 19:35:49'),
(4468, 36, '180.148.7.106', '', '', '', '', '', '', '', '2015-05-11 20:13:53'),
(4469, 36, '123.28.89.226', '', '', '', '', '', '', '', '2015-05-11 21:32:22'),
(4470, 15, '118.70.183.81', '', '', '', '', '', '', '', '2015-05-12 09:11:09'),
(4471, 20, '66.249.79.134', '', '', '', '', '', '', '', '2015-05-12 20:57:03'),
(4472, 36, '123.27.44.147', '', '', '', '', '', '', '', '2015-05-13 07:32:18'),
(4473, 14, '37.59.7.157', '', '', '', '', '', '', '', '2015-05-13 15:49:23'),
(4474, 36, '42.117.205.116', '', '', '', '', '', '', '', '2015-05-13 22:02:30'),
(4475, 36, '27.74.26.141', '', '', '', '', '', '', '', '2015-05-14 05:23:09'),
(4476, 36, '113.162.221.90', '', '', '', '', '', '', '', '2015-05-14 20:21:38'),
(4477, 36, '42.115.212.192', '', '', '', '', '', '', '', '2015-05-14 21:12:45'),
(4478, 20, '66.249.79.147', '', '', '', '', '', '', '', '2015-05-15 07:22:04'),
(4479, 36, '171.233.93.42', '', '', '', '', '', '', '', '2015-05-16 02:13:51'),
(4480, 36, '123.22.210.21', '', '', '', '', '', '', '', '2015-05-16 06:27:42'),
(4481, 36, '116.100.69.67', '', '', '', '', '', '', '', '2015-05-17 00:38:51'),
(4482, 20, '66.249.71.127', '', '', '', '', '', '', '', '2015-05-17 19:35:54'),
(4483, 15, '118.70.183.81', '', '', '', '', '', '', '', '2015-05-18 03:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
`id` int(11) NOT NULL,
  `clientname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` int(6) NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `account_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `clientname`, `contact`, `email`, `address`, `city`, `country`, `phone`, `comments`, `created_at`, `updated_at`, `account_id`, `order_no`, `status`) VALUES
(1, 'ĐẶNG THỊ CHÂU LOAN (Ms.)', 'Trưởng Phòng Kinh Doanh Quảng Cáo CÔNG TY TNHH PHÁT HÀNH TRƯỜNG PHÁT', 'dtcloan@tpinfo.vn', 'Số 179, Lý Chính Thắng, P.7, Q.3', 'TP.HCM', 247, '(0986) 742-679_', '', '2015-05-16 07:21:21', '2015-05-16 00:21:21', 0, 1, 0),
(2, 'NGUYỄN THỊ THƠM (Ms.)', 'Thư Ký Kinh Doanh', 'ntthom@tpinfo.vn', 'Số 179, Lý Chính Thắng, P.7, Q.3. TP.HCM', '', 247, '(0974) 941-554_', '', '2015-05-16 07:21:46', '2015-05-16 00:21:46', 0, 2, 0),
(3, 'MẠNG BÁN LẺ TRỰC TUYẾN GOHAPPY', 'Khách hàng đặt quảng cáo đến website goHappy.vn', 'sales@gohappy.vn', 'Văn phòng giao dịch: Lô 11-H1 khu đô thị Yên Hòa, quận Cầu Giấy, Hà Nội, Việt Nam', 'Hà Nội', 247, '(8446) 263-5858', '', '2015-05-16 07:23:12', '2015-05-16 00:23:12', 0, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
`id` int(11) NOT NULL,
  `database_default` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hosting` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `database_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `mail_username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `charset` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collection` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prefix_table` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `database_default`, `hosting`, `database_name`, `username`, `password`, `mail_username`, `mail_password`, `charset`, `collection`, `prefix_table`, `created_at`, `updated_at`) VALUES
(1, 'mysql', '127.0.0.1', 'qc', 'root', '', '', '', 'utf8', 'utf8_unicode_ci', '', '2015-02-27 03:13:18', '2015-02-27 03:13:18'),
(4, '', '', '', '', '', 'daotientu@gmail.com', 'daotientu201', '', '', '', '2015-03-16 21:39:45', '2015-03-16 21:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
`id` int(11) NOT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `created_at`, `updated_at`, `status`) VALUES
(33, 'Barbados', '2015-04-28 02:03:15', '2015-04-27 19:03:15', 0),
(34, 'Belarus', '2015-04-28 02:03:43', '2015-04-27 19:03:43', 0),
(35, 'Belgium', '2015-04-28 02:04:09', '2015-04-27 19:04:09', 0),
(36, 'Belize', '2015-04-28 02:04:22', '2015-04-27 19:04:22', 0),
(37, 'Benin', '2015-04-28 02:04:48', '2015-04-27 19:04:48', 0),
(38, 'Bermuda', '2015-04-28 02:05:41', '2015-04-27 19:05:41', 0),
(39, 'Bhutan', '2015-04-28 02:08:47', '2015-04-27 19:08:47', 0),
(40, 'Bolivia', '2015-04-28 02:09:21', '2015-04-27 19:09:21', 0),
(41, 'Bosnia and Herzegovina', '2015-04-28 02:10:18', '2015-04-27 19:10:18', 0),
(42, 'Botswana', '2015-04-28 02:10:40', '2015-04-27 19:10:40', 0),
(43, 'Bouvet Island', '2015-04-28 02:11:06', '2015-04-27 19:11:06', 0),
(44, 'Brazil', '2015-04-28 02:11:35', '2015-04-27 19:11:35', 0),
(45, 'British Indian Ocean Territory', '2015-04-28 02:11:48', '2015-04-27 19:11:48', 0),
(46, 'Brunei Darussalam', '2015-04-28 02:12:12', '2015-04-27 19:12:12', 0),
(47, 'Bulgaria', '2015-04-28 02:12:34', '2015-04-27 19:12:34', 0),
(48, 'Burkina Faso', '2015-04-28 02:13:05', '2015-04-27 19:13:05', 0),
(49, 'Burundi', '2015-04-28 02:14:59', '2015-04-27 19:14:59', 0),
(50, 'Cambodia', '2015-04-28 02:15:20', '2015-04-27 19:15:20', 0),
(51, 'Cameroon', '2015-04-28 02:17:22', '2015-04-27 19:17:22', 0),
(52, 'Canada', '2015-04-28 02:17:57', '2015-04-27 19:17:57', 0),
(53, 'Cape Verde', '2015-04-28 02:18:27', '2015-04-27 19:18:27', 0),
(54, 'Cayman Islands', '2015-04-28 02:18:36', '2015-04-27 19:18:36', 0),
(55, 'Central African Republic', '2015-04-28 02:19:02', '2015-04-27 19:19:02', 0),
(56, 'Chad', '2015-04-28 02:19:25', '2015-04-27 19:19:25', 0),
(57, 'Chile', '2015-04-28 02:19:52', '2015-04-27 19:19:52', 0),
(58, 'China', '2015-04-28 02:20:19', '2015-04-27 19:20:19', 0),
(59, 'Christmas Island', '2015-04-28 02:20:33', '2015-04-27 19:20:33', 0),
(60, 'Cocos (Keeling) Islands', '2015-04-28 02:21:14', '2015-04-27 19:21:14', 0),
(61, 'Colombia', '2015-04-28 02:24:03', '2015-04-27 19:24:03', 0),
(62, 'Comoros', '2015-04-28 02:24:24', '2015-04-27 19:24:24', 0),
(63, 'Congo', '2015-04-28 02:24:35', '2015-04-27 19:24:35', 0),
(64, 'Congo - The Democratic Republic of the', '2015-04-28 02:24:50', '2015-04-27 19:24:50', 0),
(65, 'Cook Islands', '2015-04-28 02:25:02', '2015-04-27 19:25:02', 0),
(66, 'Costa Rica', '2015-04-28 02:25:35', '2015-04-27 19:25:35', 0),
(67, 'Cote D''Ivoire', '2015-04-28 02:26:16', '2015-04-27 19:26:16', 0),
(68, 'Croatia', '2015-04-28 02:26:33', '2015-04-27 19:26:33', 0),
(69, 'Cuba', '2015-04-28 02:27:13', '2015-04-27 19:27:13', 0),
(70, 'Cyprus', '2015-04-28 02:27:54', '2015-04-27 19:27:54', 0),
(71, 'Czech Republic', '2015-04-28 02:30:13', '2015-04-27 19:30:13', 0),
(72, 'Denmark', '2015-04-28 02:30:58', '2015-04-27 19:30:58', 0),
(73, 'Djibouti', '2015-04-28 02:31:08', '2015-04-27 19:31:08', 0),
(74, 'Dominica', '2015-04-28 02:31:55', '2015-04-27 19:31:55', 0),
(75, 'Dominican Republic', '2015-04-28 02:32:34', '2015-04-27 19:32:34', 0),
(76, 'East Timor', '2015-04-28 02:33:22', '2015-04-27 19:33:22', 0),
(77, 'Ecuador', '2015-04-28 02:34:05', '2015-04-27 19:34:05', 0),
(78, 'Egypt', '2015-04-28 02:34:18', '2015-04-27 19:34:18', 0),
(79, 'El Salvador', '2015-04-28 02:35:02', '2015-04-27 19:35:02', 0),
(80, 'Equatorial Guinea', '2015-04-28 02:35:51', '2015-04-27 19:35:51', 0),
(81, 'Eritrea', '2015-04-28 02:39:02', '2015-04-27 19:39:02', 0),
(82, 'Estonia', '2015-04-28 02:39:31', '2015-04-27 19:39:31', 0),
(83, 'Ethiopia', '2015-04-28 02:40:00', '2015-04-27 19:40:00', 0),
(84, 'Europe', '2015-04-28 02:40:33', '2015-04-27 19:40:33', 0),
(85, 'Falkland Islands (Malvinas)', '2015-04-28 02:41:03', '2015-04-27 19:41:03', 0),
(86, 'Faroe Islands', '2015-04-28 02:41:38', '2015-04-27 19:41:38', 0),
(87, 'Fiji', '2015-04-28 02:41:50', '2015-04-27 19:41:50', 0),
(88, 'Finland', '2015-04-28 02:42:20', '2015-04-27 19:42:20', 0),
(89, 'France', '2015-04-28 02:42:36', '2015-04-27 19:42:36', 0),
(90, 'France - Metropolitan', '2015-04-28 02:42:47', '2015-04-27 19:42:47', 0),
(91, 'French Guiana', '2015-04-28 02:42:59', '2015-04-27 19:42:59', 0),
(92, 'French Polynesia', '2015-04-28 02:43:09', '2015-04-27 19:43:09', 0),
(93, 'French Southern Territories', '2015-04-28 02:44:54', '2015-04-27 19:44:54', 0),
(94, 'Gabon', '2015-04-28 02:46:54', '2015-04-27 19:46:54', 0),
(95, 'Gambia', '2015-04-28 02:47:17', '2015-04-27 19:47:17', 0),
(96, 'Georgia', '2015-04-28 02:47:30', '2015-04-27 19:47:30', 0),
(97, 'Germany', '2015-04-28 02:47:57', '2015-04-27 19:47:57', 0),
(98, 'Ghana', '2015-04-28 02:48:15', '2015-04-27 19:48:15', 0),
(99, 'Gibraltar', '2015-04-28 02:48:35', '2015-04-27 19:48:35', 0),
(100, 'Greece', '2015-04-28 02:48:57', '2015-04-27 19:48:57', 0),
(101, 'Greenland', '2015-04-28 02:49:08', '2015-04-27 19:49:08', 0),
(102, 'Grenada', '2015-04-28 02:49:32', '2015-04-27 19:49:32', 0),
(103, 'Guadeloupe', '2015-04-28 02:50:23', '2015-04-27 19:50:23', 0),
(104, 'Guam', '2015-04-28 02:53:05', '2015-04-27 19:53:05', 0),
(105, 'Guatemala', '2015-04-28 02:53:15', '2015-04-27 19:53:15', 0),
(106, 'Guinea', '2015-04-28 02:53:35', '2015-04-27 19:53:35', 0),
(107, 'Guinea-Bissau', '2015-04-28 02:53:45', '2015-04-27 19:53:45', 0),
(108, 'Guyana', '2015-04-28 02:54:05', '2015-04-27 19:54:05', 0),
(109, 'Haiti', '2015-04-28 02:54:24', '2015-04-27 19:54:24', 0),
(110, 'Heard Island and McDonald Islands', '2015-04-28 02:54:29', '2015-04-27 19:54:29', 0),
(111, 'Holy See (Vatican City State)', '2015-04-28 02:54:43', '2015-04-27 19:54:43', 0),
(112, 'Honduras', '2015-04-28 02:59:20', '2015-04-27 19:59:20', 0),
(113, 'Hong Kong', '2015-04-28 03:02:01', '2015-04-27 20:02:01', 0),
(114, 'Hungary', '2015-04-28 03:06:32', '2015-04-27 20:06:32', 0),
(115, 'Iceland', '2015-04-28 03:06:46', '2015-04-27 20:06:46', 0),
(116, 'India', '2015-04-28 03:10:55', '2015-04-27 20:10:55', 0),
(117, 'Indonesia', '2015-04-28 03:11:16', '2015-04-27 20:11:16', 0),
(118, 'Iran - Islamic Republic of', '2015-04-28 03:11:27', '2015-04-27 20:11:27', 0),
(119, 'Iraq', '2015-04-28 03:11:39', '2015-04-27 20:11:39', 0),
(120, 'Ireland', '2015-04-28 03:11:55', '2015-04-27 20:11:55', 0),
(121, 'Israel', '2015-04-28 03:12:10', '2015-04-27 20:12:10', 0),
(122, 'Italy', '2015-04-28 03:12:22', '2015-04-27 20:12:22', 0),
(123, 'Jamaica', '2015-04-28 03:12:34', '2015-04-27 20:12:34', 0),
(124, 'Japan', '2015-04-28 03:12:49', '2015-04-27 20:12:49', 0),
(125, 'Jordan', '2015-04-28 03:14:10', '2015-04-27 20:14:10', 0),
(126, 'Kazakhstan', '2015-04-28 03:16:39', '2015-04-27 20:16:39', 0),
(127, 'Kenya', '2015-04-28 03:16:54', '2015-04-27 20:16:54', 0),
(128, 'Kiribati', '2015-04-28 03:17:09', '2015-04-27 20:17:09', 0),
(129, 'Korea - Democratic People''s Republic of', '2015-04-28 03:17:22', '2015-04-27 20:17:22', 0),
(130, 'Korea - Republic of', '2015-04-28 03:17:34', '2015-04-27 20:17:34', 0),
(131, 'Kuwait', '2015-04-28 03:17:49', '2015-04-27 20:17:49', 0),
(132, 'Kyrgyzstan', '2015-04-28 03:18:04', '2015-04-27 20:18:04', 0),
(133, 'Lao People''s Democratic Republic', '2015-04-28 03:18:18', '2015-04-27 20:18:18', 0),
(134, 'Latvia', '2015-04-28 03:18:29', '2015-04-27 20:18:29', 0),
(135, 'Lebanon', '2015-04-28 03:18:45', '2015-04-27 20:18:45', 0),
(136, 'Lesotho', '2015-04-28 03:21:21', '2015-04-27 20:21:21', 0),
(137, 'Liberia', '2015-04-28 03:24:03', '2015-04-27 20:24:03', 0),
(138, 'Libyan Arab Jamahiriya', '2015-04-28 03:24:40', '2015-04-27 20:24:40', 0),
(139, 'Liechtenstein', '2015-04-28 03:24:52', '2015-04-27 20:24:52', 0),
(140, 'Lithuania', '2015-04-28 03:25:01', '2015-04-27 20:25:01', 0),
(141, 'Luxembourg', '2015-04-28 03:25:17', '2015-04-27 20:25:17', 0),
(142, 'Macau', '2015-04-28 03:25:36', '2015-04-27 20:25:36', 0),
(143, 'Macedonia', '2015-04-28 03:25:46', '2015-04-27 20:25:46', 0),
(144, 'Madagascar', '2015-04-28 03:25:55', '2015-04-27 20:25:55', 0),
(145, 'Malawi', '2015-04-28 03:26:13', '2015-04-27 20:26:13', 0),
(146, 'Malaysia', '2015-04-28 03:26:33', '2015-04-27 20:26:33', 0),
(147, 'Maldives', '2015-04-28 03:26:58', '2015-04-27 20:26:58', 0),
(148, 'Mali', '2015-04-28 03:30:31', '2015-04-27 20:30:31', 0),
(149, 'Malta', '2015-04-28 03:30:48', '2015-04-27 20:30:48', 0),
(150, 'Marshall Islands', '2015-04-28 03:30:58', '2015-04-27 20:30:58', 0),
(151, 'Martinique', '2015-04-28 03:31:11', '2015-04-27 20:31:11', 0),
(152, 'Mauritania', '2015-04-28 03:31:25', '2015-04-27 20:31:25', 0),
(153, 'Mauritius', '2015-04-28 03:31:42', '2015-04-27 20:31:42', 0),
(154, 'Mayotte', '2015-04-28 03:31:53', '2015-04-27 20:31:53', 0),
(155, 'Mexico', '2015-04-28 03:32:04', '2015-04-27 20:32:04', 0),
(156, 'Micronesia - Federated States of', '2015-04-28 03:32:20', '2015-04-27 20:32:20', 0),
(157, 'Moldova - Republic of', '2015-04-28 03:32:37', '2015-04-27 20:32:37', 0),
(158, 'Monaco', '2015-04-28 03:34:37', '2015-04-27 20:34:37', 0),
(159, 'Mongolia', '2015-04-28 03:35:48', '2015-04-27 20:35:48', 0),
(160, 'Montserrat', '2015-04-28 03:36:06', '2015-04-27 20:36:06', 0),
(161, 'Morocco', '2015-04-28 03:36:20', '2015-04-27 20:36:20', 0),
(162, 'Mozambique', '2015-04-28 03:36:34', '2015-04-27 20:36:34', 0),
(163, 'Myanmar', '2015-04-28 03:36:43', '2015-04-27 20:36:43', 0),
(164, 'Namibia', '2015-04-28 03:37:00', '2015-04-27 20:37:00', 0),
(165, 'Nauru', '2015-04-28 03:37:14', '2015-04-27 20:37:14', 0),
(166, 'Nepal', '2015-04-28 03:37:29', '2015-04-27 20:37:29', 0),
(167, 'Netherlands', '2015-04-28 03:37:38', '2015-04-27 20:37:38', 0),
(168, 'Netherlands Antilles', '2015-04-28 03:38:57', '2015-04-27 20:38:57', 0),
(169, 'New Caledonia', '2015-04-28 03:40:51', '2015-04-27 20:40:51', 0),
(170, 'New Zealand', '2015-04-28 03:41:11', '2015-04-27 20:41:11', 0),
(171, 'Nicaragua', '2015-04-28 03:41:28', '2015-04-27 20:41:28', 0),
(172, 'Niger', '2015-04-28 03:41:41', '2015-04-27 20:41:41', 0),
(173, 'Nigeria', '2015-04-28 03:41:48', '2015-04-27 20:41:48', 0),
(174, 'Niue', '2015-04-28 03:42:05', '2015-04-27 20:42:05', 0),
(175, 'Norfolk Island', '2015-04-28 03:42:20', '2015-04-27 20:42:20', 0),
(176, 'Northern Mariana Islands', '2015-04-28 03:42:36', '2015-04-27 20:42:36', 0),
(177, 'Norway', '2015-04-28 03:42:43', '2015-04-27 20:42:43', 0),
(178, 'Oman', '2015-04-28 03:43:34', '2015-04-27 20:43:34', 0),
(179, 'Pakistan', '2015-04-28 03:46:21', '2015-04-27 20:46:21', 0),
(180, 'Palau', '2015-04-28 03:46:55', '2015-04-27 20:46:55', 0),
(181, 'Palestinian Territory - Occupied', '2015-04-28 03:48:47', '2015-04-27 20:48:47', 0),
(182, 'Panama', '2015-04-28 03:49:06', '2015-04-27 20:49:06', 0),
(183, 'Papua New Guinea', '2015-04-28 03:49:12', '2015-04-27 20:49:12', 0),
(184, 'Paraguay', '2015-04-28 03:49:26', '2015-04-27 20:49:26', 0),
(185, 'Peru', '2015-04-28 03:49:43', '2015-04-27 20:49:43', 0),
(186, 'Philippines', '2015-04-28 03:49:59', '2015-04-27 20:49:59', 0),
(187, 'Pitcairn', '2015-04-28 03:50:07', '2015-04-27 20:50:07', 0),
(188, 'Poland', '2015-04-28 03:50:21', '2015-04-27 20:50:21', 0),
(189, 'Portugal', '2015-04-28 03:50:38', '2015-04-27 20:50:38', 0),
(190, 'Puerto Rico', '2015-04-28 03:51:26', '2015-04-27 20:51:26', 0),
(191, 'Qatar', '2015-04-28 03:54:41', '2015-04-27 20:54:41', 0),
(192, 'Reunion', '2015-04-28 03:56:54', '2015-04-27 20:56:54', 0),
(193, 'Romania', '2015-04-28 03:57:14', '2015-04-27 20:57:14', 0),
(194, 'Russian Federation', '2015-04-28 03:57:24', '2015-04-27 20:57:24', 0),
(195, 'Rwanda', '2015-04-28 03:57:38', '2015-04-27 20:57:38', 0),
(196, 'Saint Helena', '2015-04-28 03:57:51', '2015-04-27 20:57:51', 0),
(197, 'Saint Kitts and Nevis', '2015-04-28 03:58:07', '2015-04-27 20:58:07', 0),
(198, 'Saint Lucia', '2015-04-28 03:58:19', '2015-04-27 20:58:19', 0),
(199, 'Saint Pierre and Miquelon', '2015-04-28 03:58:33', '2015-04-27 20:58:33', 0),
(200, 'Saint Vincent and the Grenadines', '2015-04-28 03:58:46', '2015-04-27 20:58:46', 0),
(201, 'Samoa', '2015-04-28 03:59:31', '2015-04-27 20:59:31', 0),
(202, 'San Marino', '2015-04-28 04:00:45', '2015-04-27 21:00:45', 0),
(203, 'Sao Tome and Principe', '2015-04-28 04:01:08', '2015-04-27 21:01:08', 0),
(204, 'Saudi Arabia', '2015-04-28 04:01:22', '2015-04-27 21:01:22', 0),
(205, 'Senegal', '2015-04-28 04:01:39', '2015-04-27 21:01:39', 0),
(206, 'Seychelles', '2015-04-28 04:01:53', '2015-04-27 21:01:53', 0),
(207, 'Sierra Leone', '2015-04-28 04:02:03', '2015-04-27 21:02:03', 0),
(208, 'Singapore', '2015-04-28 04:02:17', '2015-04-27 21:02:17', 0),
(209, 'Slovakia', '2015-04-28 04:02:33', '2015-04-27 21:02:33', 0),
(210, 'Slovenia', '2015-04-28 04:02:48', '2015-04-27 21:02:48', 0),
(211, 'Solomon Islands', '2015-04-28 04:03:30', '2015-04-27 21:03:30', 0),
(212, 'Somalia', '2015-04-28 04:04:02', '2015-04-27 21:04:02', 0),
(213, 'South Africa', '2015-04-28 04:04:36', '2015-04-27 21:04:36', 0),
(214, 'South Georgia and the South Sandwich Islands', '2015-04-28 04:04:53', '2015-04-27 21:04:53', 0),
(215, 'Spain', '2015-04-28 04:04:57', '2015-04-27 21:04:57', 0),
(216, 'Sri Lanka', '2015-04-28 04:05:14', '2015-04-27 21:05:14', 0),
(217, 'Sudan', '2015-04-28 04:05:31', '2015-04-27 21:05:31', 0),
(218, 'Suriname', '2015-04-28 04:05:48', '2015-04-27 21:05:48', 0),
(219, 'Svalbard and Jan Mayen', '2015-04-28 04:05:51', '2015-04-27 21:05:51', 0),
(220, 'Swaziland', '2015-04-28 04:06:09', '2015-04-27 21:06:09', 0),
(221, 'Sweden', '2015-04-28 04:07:14', '2015-04-27 21:07:14', 0),
(222, 'Switzerland', '2015-04-28 04:07:47', '2015-04-27 21:07:47', 0),
(223, 'Syrian Arab Republic', '2015-04-28 04:08:36', '2015-04-27 21:08:36', 0),
(224, 'Taiwan - Province of China', '2015-04-28 04:08:50', '2015-04-27 21:08:50', 0),
(225, 'Tajikistan', '2015-04-28 04:08:57', '2015-04-27 21:08:57', 0),
(226, 'Tanzania - United Republic of', '2015-04-28 04:09:13', '2015-04-27 21:09:13', 0),
(227, 'Thailand', '2015-04-28 04:09:30', '2015-04-27 21:09:30', 0),
(228, 'Togo', '2015-04-28 04:09:45', '2015-04-27 21:09:45', 0),
(229, 'Tokelau', '2015-04-28 04:09:51', '2015-04-27 21:09:51', 0),
(230, 'Tonga', '2015-04-28 04:10:09', '2015-04-27 21:10:09', 0),
(231, 'Trinidad and Tobago', '2015-04-28 04:11:27', '2015-04-27 21:11:27', 0),
(232, 'Tunisia', '2015-04-28 04:11:56', '2015-04-27 21:11:56', 0),
(233, 'Turkey', '2015-04-28 04:12:31', '2015-04-27 21:12:31', 0),
(234, 'Turkmenistan', '2015-04-28 04:12:48', '2015-04-27 21:12:48', 0),
(235, 'Turks and Caicos Islands', '2015-04-28 04:13:02', '2015-04-27 21:13:02', 0),
(236, 'Tuvalu', '2015-04-28 04:13:08', '2015-04-27 21:13:08', 0),
(237, 'Uganda', '2015-04-28 04:13:25', '2015-04-27 21:13:25', 0),
(238, 'Ukraine', '2015-04-28 04:13:41', '2015-04-27 21:13:41', 0),
(239, 'United Arab Emirates', '2015-04-28 04:13:58', '2015-04-27 21:13:58', 0),
(240, 'United Kingdom', '2015-04-28 04:14:03', '2015-04-27 21:14:03', 0),
(241, 'United States', '2015-04-28 04:14:19', '2015-04-27 21:14:19', 0),
(242, 'United States Minor Outlying Islands', '2015-04-28 04:16:10', '2015-04-27 21:16:10', 0),
(243, 'Uruguay', '2015-04-28 04:19:31', '2015-04-27 21:19:31', 0),
(244, 'Uzbekistan', '2015-04-28 04:20:39', '2015-04-27 21:20:39', 0),
(245, 'Vanuatu', '2015-04-28 04:20:58', '2015-04-27 21:20:58', 0),
(246, 'Venezuela', '2015-04-28 04:21:10', '2015-04-27 21:21:10', 0),
(247, 'Vietnam', '2015-04-28 04:21:24', '2015-04-27 21:21:24', 0),
(248, 'Virgin Islands - British', '2015-04-28 04:21:35', '2015-04-27 21:21:35', 0),
(249, 'Virgin Islands - U.S.', '2015-04-28 04:21:50', '2015-04-27 21:21:50', 0),
(250, 'Wallis and Futuna', '2015-04-28 04:22:05', '2015-04-27 21:22:05', 0),
(251, 'Western Sahara', '2015-04-28 04:22:18', '2015-04-27 21:22:18', 0),
(252, 'Yemen', '2015-04-28 04:22:30', '2015-04-27 21:22:30', 0),
(253, 'Yugoslavia', '2015-04-28 04:23:45', '2015-04-27 21:23:45', 0),
(254, 'Zaire', '2015-04-28 04:27:10', '2015-04-27 21:27:10', 0),
(255, 'Zambia', '2015-04-28 04:27:24', '2015-04-27 21:27:24', 0),
(256, 'Zimbabwe', '2015-04-28 04:27:51', '2015-04-27 21:27:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cviews`
--

CREATE TABLE IF NOT EXISTS `cviews` (
`id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `day` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `view` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=312 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cviews`
--

INSERT INTO `cviews` (`id`, `website_id`, `day`, `user`, `view`) VALUES
(3, 0, '2014-11-05', 789, 1596),
(4, 0, '2014-11-06', 652, 1903),
(5, 0, '2014-11-07', 1214, 1576),
(6, 0, '2014-11-08', 4970, 9119),
(7, 0, '2014-11-09', 9373, 13163),
(8, 0, '2014-11-10', 7592, 17443),
(9, 0, '2014-11-11', 0, 529258),
(10, 0, '2014-11-12', 0, 1375127),
(11, 0, '2014-11-13', 43, 415313),
(12, 0, '2014-11-14', 650, 42234),
(13, 0, '2014-11-15', 307, 11285),
(14, 0, '2014-11-16', 49, 1391),
(15, 0, '2014-11-16', 49, 1391),
(16, 0, '2014-11-17', 3835, 218681),
(17, 0, '2014-11-18', 3217, 235121),
(18, 0, '2014-11-19', 157857, 250628),
(19, 0, '2014-11-20', 240868, 241667),
(20, 0, '2014-11-21', 132815, 133484),
(21, 0, '2014-11-22', 92621, 93114),
(22, 0, '2014-11-23', 29372, 30069),
(23, 0, '2014-11-24', 134969, 135908),
(24, 0, '2014-11-25', 144015, 144775),
(25, 0, '2014-11-26', 171813, 172865),
(26, 0, '2014-11-27', 1505, 1508),
(27, 5, '2014-12-23', 23, 38400),
(28, 4, '2014-12-23', 28, 48989),
(29, 4, '2014-12-24', 50, 64210),
(30, 5, '2014-12-24', 22, 52442),
(31, 4, '2014-12-25', 14, 69377),
(32, 5, '2014-12-25', 9, 59052),
(33, 5, '2014-12-26', 25, 70115),
(34, 4, '2014-12-26', 25, 75865),
(35, 5, '2014-12-27', 1, 69604),
(36, 4, '2014-12-27', 8, 68017),
(37, 5, '2014-12-28', 10, 72538),
(38, 4, '2014-12-28', 4, 64827),
(39, 5, '2014-12-29', 5, 76540),
(40, 4, '2014-12-29', 2, 75444),
(41, 3, '2014-12-29', 1, 1),
(42, 4, '2014-12-30', 7, 64130),
(43, 5, '2014-12-30', 2, 70164),
(44, 5, '2014-12-31', 19, 65856),
(45, 4, '2014-12-31', 14, 61014),
(46, 3, '2014-12-31', 1, 1),
(47, 5, '2015-01-01', 11, 65589),
(48, 4, '2015-01-01', 1, 46915),
(49, 4, '2015-01-02', 5, 67246),
(50, 5, '2015-01-02', 9, 74663),
(51, 3, '2015-01-02', 1, 1),
(52, 5, '2015-01-03', 1, 79345),
(53, 4, '2015-01-03', 1, 69414),
(54, 5, '2015-01-04', 8, 78563),
(55, 4, '2015-01-04', 3, 63645),
(56, 4, '2015-01-05', 91, 78016),
(57, 5, '2015-01-05', 85, 80674),
(58, 3, '2015-01-05', 1, 1),
(59, 5, '2015-01-06', 22, 92249),
(60, 4, '2015-01-06', 31, 89183),
(61, 5, '2015-01-07', 19, 94796),
(62, 4, '2015-01-07', 23, 95840),
(63, 3, '2015-01-07', 1, 1),
(64, 5, '2015-01-08', 128, 102823),
(65, 4, '2015-01-08', 143, 100372),
(66, 5, '2015-01-09', 32, 104091),
(67, 4, '2015-01-09', 44, 102026),
(68, 5, '2015-01-10', 139, 99641),
(69, 4, '2015-01-10', 144, 92358),
(70, 4, '2015-01-11', 44, 88341),
(71, 5, '2015-01-11', 33, 109647),
(72, 5, '2015-01-12', 356, 101166),
(73, 4, '2015-01-12', 309, 101041),
(74, 5, '2015-01-13', 4, 97838),
(75, 4, '2015-01-13', 1, 81442),
(76, 4, '2015-01-14', 3, 68154),
(77, 5, '2015-01-14', 6, 95121),
(78, 5, '2015-01-15', 70, 86967),
(79, 4, '2015-01-15', 27, 63964),
(80, 4, '2015-01-16', 7, 59960),
(81, 5, '2015-01-16', 12, 79041),
(82, 4, '2015-01-17', 17, 52444),
(83, 5, '2015-01-17', 28, 80038),
(84, 5, '2015-01-18', 25, 75540),
(85, 4, '2015-01-18', 2, 51325),
(86, 5, '2015-01-19', 31, 85894),
(87, 4, '2015-01-19', 16, 67351),
(88, 5, '2015-01-20', 22, 76506),
(89, 4, '2015-01-20', 4, 64194),
(90, 5, '2015-01-21', 120, 85734),
(91, 4, '2015-01-21', 400, 123564),
(92, 5, '2015-01-22', 176, 80599),
(93, 4, '2015-01-22', 362, 117653),
(94, 4, '2015-01-23', 302, 136357),
(95, 5, '2015-01-23', 172, 99274),
(96, 5, '2015-01-24', 169, 72961),
(97, 4, '2015-01-24', 223, 101180),
(98, 5, '2015-01-25', 135, 62990),
(99, 4, '2015-01-25', 211, 84505),
(100, 5, '2015-01-26', 179, 89569),
(101, 4, '2015-01-26', 351, 118721),
(102, 5, '2015-01-27', 131, 99636),
(103, 4, '2015-01-27', 501, 133130),
(104, 4, '2015-01-28', 830, 100382),
(105, 5, '2015-01-28', 301, 80152),
(106, 5, '2015-01-29', 176, 102948),
(107, 4, '2015-01-29', 196, 133126),
(108, 5, '2015-01-30', 128, 105852),
(109, 4, '2015-01-30', 394, 127129),
(110, 4, '2015-01-31', 338, 123286),
(111, 5, '2015-01-31', 209, 107478),
(112, 4, '2015-02-01', 432, 94666),
(113, 5, '2015-02-01', 182, 84192),
(114, 5, '2015-02-02', 143, 102564),
(115, 4, '2015-02-02', 364, 129466),
(116, 4, '2015-02-03', 387, 136738),
(117, 5, '2015-02-03', 145, 104726),
(118, 4, '2015-02-04', 503, 138301),
(119, 5, '2015-02-04', 187, 104892),
(120, 4, '2015-02-05', 820, 140387),
(121, 5, '2015-02-05', 393, 105543),
(122, 5, '2015-02-06', 124, 98686),
(123, 4, '2015-02-06', 446, 134136),
(124, 4, '2015-02-07', 103, 113067),
(125, 5, '2015-02-07', 47, 89993),
(126, 4, '2015-02-08', 370, 80977),
(127, 5, '2015-02-08', 142, 68280),
(128, 4, '2015-02-09', 307, 133246),
(129, 5, '2015-02-09', 102, 95671),
(130, 5, '2015-02-10', 127, 92176),
(131, 4, '2015-02-10', 351, 126618),
(132, 4, '2015-02-11', 625, 109924),
(133, 5, '2015-02-11', 223, 81625),
(134, 4, '2015-02-12', 171, 114220),
(135, 5, '2015-02-12', 77, 85800),
(136, 4, '2015-02-13', 260, 120785),
(137, 5, '2015-02-13', 51, 97611),
(138, 4, '2015-02-14', 161, 111656),
(139, 5, '2015-02-14', 74, 96594),
(140, 4, '2015-02-15', 96, 99148),
(141, 5, '2015-02-15', 80, 91412),
(142, 4, '2015-02-16', 43, 94544),
(143, 5, '2015-02-16', 29, 86915),
(144, 4, '2015-02-17', 13, 70762),
(145, 5, '2015-02-17', 33, 75193),
(146, 5, '2015-02-18', 2, 73273),
(147, 4, '2015-02-18', 7, 72263),
(148, 4, '2015-02-19', 15, 73614),
(149, 5, '2015-02-19', 1, 73633),
(150, 5, '2015-02-20', 14, 50343),
(151, 4, '2015-02-20', 40, 48961),
(152, 4, '2015-02-21', 11, 79690),
(153, 5, '2015-02-21', 19, 87570),
(154, 4, '2015-02-22', 31, 84019),
(155, 5, '2015-02-22', 41, 92318),
(156, 4, '2015-02-23', 75, 91800),
(157, 5, '2015-02-23', 78, 116273),
(158, 5, '2015-02-24', 71, 116505),
(159, 4, '2015-02-24', 220, 113454),
(160, 5, '2015-02-25', 375, 114028),
(161, 4, '2015-02-25', 541, 116882),
(162, 5, '2015-02-26', 357, 138329),
(163, 4, '2015-02-26', 533, 132305),
(164, 4, '2015-02-27', 456, 135901),
(165, 5, '2015-02-27', 305, 142263),
(166, 4, '2015-02-28', 344, 124543),
(167, 5, '2015-02-28', 516, 160741),
(168, 4, '2015-03-01', 347, 125029),
(169, 5, '2015-03-01', 483, 155698),
(170, 5, '2015-03-02', 643, 158571),
(171, 4, '2015-03-02', 1197, 153145),
(172, 5, '2015-03-03', 365, 143117),
(173, 4, '2015-03-03', 534, 133903),
(174, 5, '2015-03-04', 398, 144770),
(175, 4, '2015-03-04', 623, 144857),
(176, 4, '2015-03-05', 658, 149591),
(177, 5, '2015-03-05', 569, 154348),
(178, 5, '2015-03-06', 466, 134933),
(179, 4, '2015-03-06', 613, 135180),
(180, 5, '2015-03-07', 598, 108920),
(181, 4, '2015-03-07', 796, 95237),
(182, 4, '2015-03-08', 105, 104449),
(183, 5, '2015-03-08', 160, 131913),
(184, 4, '2015-03-09', 540, 134785),
(185, 5, '2015-03-09', 350, 132743),
(186, 5, '2015-03-09', 350, 132743),
(187, 5, '2015-03-10', 759, 93086),
(188, 4, '2015-03-10', 1699, 99471),
(189, 5, '2015-03-11', 1653, 119856),
(190, 4, '2015-03-11', 2826, 123224),
(191, 4, '2015-03-11', 2826, 123224),
(192, 5, '2015-03-12', 1635, 124394),
(193, 4, '2015-03-12', 2949, 124473),
(194, 5, '2015-03-13', 1405, 128073),
(195, 4, '2015-03-13', 2234, 135100),
(196, 5, '2015-03-14', 1745, 129833),
(197, 4, '2015-03-14', 2438, 109447),
(198, 4, '2015-03-15', 1117, 104548),
(199, 5, '2015-03-15', 1396, 136509),
(200, 5, '2015-03-16', 2913, 174501),
(201, 5, '2015-03-16', 2913, 174501),
(202, 4, '2015-03-16', 2348, 125651),
(203, 4, '2015-03-16', 2348, 125651),
(204, 4, '2015-03-17', 1565, 163531),
(205, 5, '2015-03-17', 1526, 193104),
(206, 5, '2015-03-18', 2004, 211882),
(207, 4, '2015-03-18', 1684, 169251),
(208, 4, '2015-03-19', 1464, 166919),
(209, 5, '2015-03-19', 1306, 188110),
(210, 5, '2015-03-20', 2386, 146106),
(211, 4, '2015-03-20', 3041, 146643),
(212, 5, '2015-03-21', 477, 141185),
(213, 4, '2015-03-21', 362, 129476),
(214, 5, '2015-03-22', 440, 153861),
(215, 4, '2015-03-22', 356, 119567),
(216, 4, '2015-03-23', 1936, 172595),
(217, 5, '2015-03-23', 1468, 176481),
(218, 4, '2015-03-24', 2666, 187471),
(219, 5, '2015-03-24', 2111, 189075),
(220, 5, '2015-03-25', 2064, 195619),
(221, 4, '2015-03-25', 2576, 181117),
(222, 5, '2015-03-26', 1973, 215941),
(223, 4, '2015-03-26', 2224, 195426),
(224, 4, '2015-03-27', 2434, 193149),
(225, 5, '2015-03-27', 2408, 230094),
(226, 4, '2015-03-28', 2317, 132954),
(227, 5, '2015-03-28', 2138, 168831),
(228, 5, '2015-03-29', 1963, 187611),
(229, 4, '2015-03-29', 1630, 125553),
(230, 4, '2015-03-30', 2510, 164741),
(231, 5, '2015-03-30', 2500, 177877),
(232, 4, '2015-03-31', 1600, 176417),
(233, 5, '2015-03-31', 1661, 204198),
(234, 5, '2015-04-01', 3021, 228165),
(235, 4, '2015-04-01', 2707, 186223),
(236, 4, '2015-04-02', 2825, 194644),
(237, 5, '2015-04-02', 2893, 236892),
(238, 5, '2015-04-03', 1135, 202787),
(239, 4, '2015-04-03', 1506, 174427),
(240, 4, '2015-04-04', 275, 148773),
(241, 5, '2015-04-04', 429, 197554),
(242, 5, '2015-04-05', 503, 211057),
(243, 4, '2015-04-05', 309, 138873),
(244, 4, '2015-04-06', 1144, 199036),
(245, 5, '2015-04-06', 1407, 233864),
(246, 4, '2015-04-07', 1254, 209362),
(247, 5, '2015-04-07', 1633, 249694),
(248, 5, '2015-04-08', 1476, 241700),
(249, 4, '2015-04-08', 1217, 218170),
(250, 5, '2015-04-09', 1783, 237832),
(251, 4, '2015-04-09', 1635, 208572),
(252, 5, '2015-04-10', 2300, 281762),
(253, 4, '2015-04-10', 1662, 223624),
(254, 5, '2015-04-11', 2184, 243050),
(255, 4, '2015-04-11', 2575, 291174),
(256, 5, '2015-04-12', 4742, 266382),
(257, 4, '2015-04-12', 4502, 282905),
(258, 4, '2015-04-13', 4684, 344072),
(259, 5, '2015-04-13', 3141, 239127),
(260, 5, '2015-04-14', 513, 34892),
(261, 4, '2015-04-14', 1016, 65443),
(262, 4, '2015-04-25', 1175, 187941),
(263, 5, '2015-04-25', 1076, 177254),
(264, 5, '2015-04-25', 1076, 177254),
(265, 5, '2015-04-26', 1466, 216551),
(266, 5, '2015-04-26', 1466, 216551),
(267, 4, '2015-04-26', 1879, 254572),
(268, 4, '2015-04-27', 2307, 276246),
(269, 5, '2015-04-27', 1719, 215533),
(270, 4, '2015-04-28', 833, 211174),
(271, 5, '2015-04-28', 975, 234665),
(272, 5, '2015-04-29', 1636, 239043),
(273, 4, '2015-04-29', 1544, 222932),
(274, 4, '2015-04-30', 728, 210095),
(275, 5, '2015-04-30', 755, 206696),
(276, 5, '2015-05-01', 780, 237186),
(277, 4, '2015-05-01', 380, 122747),
(278, 4, '2015-05-02', 454, 125832),
(279, 5, '2015-05-02', 1012, 264445),
(280, 4, '2015-05-03', 237, 120083),
(281, 5, '2015-05-03', 492, 236499),
(282, 5, '2015-05-04', 1912, 231443),
(283, 4, '2015-05-04', 1568, 166107),
(284, 5, '2015-05-05', 1796, 255108),
(285, 4, '2015-05-05', 1281, 182164),
(286, 5, '2015-05-06', 1706, 246843),
(287, 4, '2015-05-06', 1135, 186558),
(288, 5, '2015-05-07', 3208, 295174),
(289, 4, '2015-05-07', 2804, 253425),
(290, 4, '2015-05-08', 2762, 274359),
(291, 5, '2015-05-08', 3446, 318314),
(292, 5, '2015-05-09', 3497, 297877),
(293, 4, '2015-05-09', 2653, 230863),
(294, 5, '2015-05-10', 2191, 286120),
(295, 4, '2015-05-10', 1492, 195726),
(296, 4, '2015-05-11', 2548, 250541),
(297, 5, '2015-05-11', 2657, 276737),
(298, 4, '2015-05-12', 3174, 251180),
(299, 5, '2015-05-12', 3439, 277442),
(300, 4, '2015-05-13', 2993, 263445),
(301, 5, '2015-05-13', 3808, 346937),
(302, 5, '2015-05-14', 3064, 308156),
(303, 4, '2015-05-14', 2782, 267058),
(304, 5, '2015-05-15', 2859, 292005),
(305, 4, '2015-05-15', 2567, 261286),
(306, 5, '2015-05-16', 2107, 270997),
(307, 4, '2015-05-16', 1790, 218381),
(308, 4, '2015-05-17', 1236, 195616),
(309, 5, '2015-05-17', 1692, 252975),
(310, 5, '2015-05-18', 7437, 97706),
(311, 4, '2015-05-18', 12491, 126370);

-- --------------------------------------------------------

--
-- Table structure for table `data_helper`
--

CREATE TABLE IF NOT EXISTS `data_helper` (
`id` int(11) NOT NULL,
  `uri_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content_helper_en` text COLLATE utf8_unicode_ci NOT NULL,
  `content_helper_vi` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_uri`
--

CREATE TABLE IF NOT EXISTS `data_uri` (
`id` int(11) NOT NULL,
  `helper_id` int(11) NOT NULL,
  `uri_segment` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
`id` int(11) NOT NULL,
  `email_id` text COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` text COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `html_iframe` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `seen` int(1) NOT NULL,
  `type_message` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `folder_banners`
--

CREATE TABLE IF NOT EXISTS `folder_banners` (
`id` int(11) NOT NULL,
  `folder_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `folder_banners`
--

INSERT INTO `folder_banners` (`id`, `folder_name`, `created_at`, `updated_at`) VALUES
(1, '2014-12-23', '2014-12-23 01:26:52', '2014-12-23 01:26:52'),
(2, '2014-12-24', '2014-12-23 18:43:07', '2014-12-23 18:43:07'),
(3, '2014-12-25', '2014-12-24 19:04:32', '2014-12-24 19:04:32'),
(4, '2014-12-26', '2014-12-25 18:52:29', '2014-12-25 18:52:29'),
(5, '2014-12-27', '2014-12-26 22:16:54', '2014-12-26 22:16:54'),
(6, '2014-12-30', '2014-12-30 00:08:54', '2014-12-30 00:08:54'),
(7, '2014-12-31', '2014-12-30 21:51:53', '2014-12-30 21:51:53'),
(8, '2015-01-01', '2014-12-31 18:06:56', '2014-12-31 18:06:56'),
(9, '2015-01-02', '2015-01-01 17:39:09', '2015-01-01 17:39:09'),
(10, '2015-01-03', '2015-01-03 02:12:59', '2015-01-03 02:12:59'),
(11, '2015-01-05', '2015-01-04 18:32:56', '2015-01-04 18:32:56'),
(12, '2015-01-06', '2015-01-05 23:11:39', '2015-01-05 23:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
`id` int(11) NOT NULL,
  `language_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_09_12_083509_create_zones_table', 1),
('2014_09_14_075912_create_posts_table', 1),
('2014_09_14_080124_create_comments_table', 1),
('2014_09_15_044839_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
`id` int(11) NOT NULL,
  `sender` text COLLATE utf8_unicode_ci NOT NULL,
  `title_request` text COLLATE utf8_unicode_ci NOT NULL,
  `content_request` text COLLATE utf8_unicode_ci NOT NULL,
  `attach_file` text COLLATE utf8_unicode_ci NOT NULL,
  `date_sent` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `receiver` text COLLATE utf8_unicode_ci NOT NULL,
  `solverid` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `sender`, `title_request`, `content_request`, `attach_file`, `date_sent`, `receiver`, `solverid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'From: Loan Dang Thi Chau <dtcloan@tpinfo.vn>', 'Banner quảng cáo trên Tintuc.vn', '<p>Dear Cường!</p>\r\n\r\n<div>Chị gửi em Top Banner trang <a href="http://tintuc.vn/">tintuc.vn</a>.&nbsp;</div>\r\n\r\n<div>- Thời gian đăng: 2 th&aacute;ng, bắt đầu từ ng&agrave;y 24/12/2014</div>\r\n\r\n<div>- Vị Tr&iacute; Top Banner, cơ chế chia sẻ</div>\r\n\r\n<div>- Mỗi th&aacute;ng c&oacute; 4 b&agrave;i PR ở chuy&ecirc;n mục ph&ugrave; hợp.</div>\r\n\r\n<div>\r\n<p>Em xem hai banner n&agrave;y v&agrave; add đường link v&agrave;o gi&uacute;p chị nh&eacute;</p>\r\n\r\n<p>Đường link:&nbsp;<a href="http://sacdepvasuckhoe.wordpress.com/2014/12/19/qua-tang-giang-sinh-nam-moi/" target="_blank">http://sacdepvasuckhoe.wordpress.com/2014/12/19/qua-tang-giang-sinh-nam-moi/</a></p>\r\n\r\n<p>Cường xem, c&oacute; thể gi&uacute;p chị l&agrave;m thế n&agrave;o để lượng truy cập v&agrave;o www của kh&aacute;ch cao ch&uacute;t nh&eacute;.</p>\r\n\r\n<p>Tr&acirc;n trọng./.</p>\r\n</div>\r\n', '', '2015-04-01', 'To: cuong@tintuc.vn\r\nCc: Huong Phan <ph.huong77@gmail.com>, Thom Nguyen Thi <ntthom@tpinfo.vn>, Lai Van Thu <vanthu2608@gmail.com>, Tuan Vu Nguyen <ntvu@tpinfo.vn>', 1, 0, '2015-03-31 23:14:29', '2015-04-03 02:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE IF NOT EXISTS `userlogs` (
`id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `usertype` int(4) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `context` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contextid` int(11) NOT NULL,
  `object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userlogs`
--

INSERT INTO `userlogs` (`id`, `account_id`, `usertype`, `userid`, `username`, `action`, `context`, `contextid`, `object`, `details`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 8, 'myads', 'updated', 'Banner', 45, 'Banner hiển thị tới trang gohappy.vn', 'myads updated Banner "Banner hiển thị tới trang gohappy.vn" (#45)', '2015-05-18 02:55:09', '2015-05-18 02:55:09'),
(2, 2, 0, 8, 'myads', 'updated', 'Banner', 45, 'Banner hiển thị tới trang gohappy.vn', 'myads updated Banner "Banner hiển thị tới trang gohappy.vn" (#45)', '2015-05-18 02:55:51', '2015-05-18 02:55:51'),
(3, 2, 0, 8, 'myads', 'updated', 'Banner', 46, 'Banner chạy song song hiển thị tới trang gohappy.vn', 'myads updated Banner "Banner chạy song song hiển thị tới trang gohappy.vn" (#46)', '2015-05-18 02:56:20', '2015-05-18 02:56:20'),
(4, 2, 0, 8, 'myads', 'updated', 'Banner', 46, 'Banner chạy song song hiển thị tới trang gohappy.vn', 'myads updated Banner "Banner chạy song song hiển thị tới trang gohappy.vn" (#46)', '2015-05-18 02:56:59', '2015-05-18 02:56:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password_md5` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password_temp` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `default_account_id` int(11) NOT NULL,
  `permission` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `clientid` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_last_login` datetime NOT NULL,
  `ip_address_last_login` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email_updated` datetime NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `online` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `contact_name`, `email_address`, `username`, `password`, `password_md5`, `password_temp`, `language`, `default_account_id`, `permission`, `clientid`, `comments`, `active`, `code`, `remember_token`, `created_at`, `updated_at`, `date_last_login`, `ip_address_last_login`, `email_updated`, `order_no`, `status`, `online`) VALUES
(8, 'DAO TIEN TU - Default', 'tudt@tintuc.vn', 'myads', '$2y$10$VD8XLVKqy4kkkz1sFFZjo.nvKKorSmZu8CLuqihkEuO1B85miGRUO', 'd41d8cd98f00b204e9800998ecf8427e', '', '52', 2, '', 0, '', 1, 'llmZ5pVMeP7F04WkcsukarzTjTR0cdkwq5zmGWUjKRnzoWmoGhTMBeDMktYb', 'Qp7Fo6b1SAREYVTMhn9rLHanmHecFOqEQ0wJFga81URu0yOqvU1h9TeAquv0', '2015-05-05 01:03:21', '2015-05-18 02:34:39', '2015-05-18 09:34:39', '42.115.211.92', '0000-00-00 00:00:00', 3, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE IF NOT EXISTS `views` (
`id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `region` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `org` text COLLATE utf8_unicode_ci NOT NULL,
  `view_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=37808376 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `website_id`, `ip_address`, `user_agent`, `city`, `region`, `country`, `lat`, `long`, `org`, `view_at`) VALUES
(37808326, 5, '123.22.93.179', 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_6 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B500 Safari/8536.25', '', '', '', '', '', '', '2015-05-18 03:09:04'),
(37808327, 5, '116.111.103.233', 'Mozilla/5.0 (Linux; Android 4.2.2; R831K Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Mobile Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:04'),
(37808328, 5, '64.233.173.178', 'Mozilla/5.0 (Linux; Android 4.4.2; SM-G313HZ Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.135 Mobile Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:07'),
(37808329, 4, '113.165.149.110', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:09'),
(37808330, 5, '171.224.27.64', 'Mozilla/5.0 (Linux; U; Android 4.1.1; vi-vn; HTC_Desire_X Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30', '', '', '', '', '', '', '2015-05-18 03:09:10'),
(37808331, 4, '123.22.180.188', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:12'),
(37808332, 4, '27.3.113.239', 'Mozilla/5.0 (Linux; U; Android 4.0.4; vi-vn; GT-P7500 Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30', '', '', '', '', '', '', '2015-05-18 03:09:13'),
(37808333, 4, '42.112.38.78', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.91 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:14'),
(37808334, 4, '113.189.226.130', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)', '', '', '', '', '', '', '2015-05-18 03:09:17'),
(37808335, 4, '14.169.68.30', 'Mozilla/5.0 (iPad; CPU OS 8_1_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B440 Safari/600.1.4', '', '', '', '', '', '', '2015-05-18 03:09:17'),
(37808336, 5, '113.175.152.27', 'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 520) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537', '', '', '', '', '', '', '2015-05-18 03:09:18'),
(37808337, 5, '113.185.7.38', 'Mozilla/5.0 (Linux; Android 4.4.4; SM-G530H Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.111 Mobile Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:21'),
(37808338, 5, '123.22.53.49', 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_6 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B500 Safari/8536.25', '', '', '', '', '', '', '2015-05-18 03:09:23'),
(37808339, 4, '88.100.128.126', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:23'),
(37808340, 5, '123.17.216.102', 'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 520) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537', '', '', '', '', '', '', '2015-05-18 03:09:23'),
(37808341, 5, '114.76.79.224', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_1_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B440 Safari/600.1.4', '', '', '', '', '', '', '2015-05-18 03:09:23'),
(37808342, 4, '123.18.103.25', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/47.0 Chrome/41.0.2272.127_coc_coc Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:23'),
(37808343, 4, '116.105.112.27', 'Mozilla/5.0 (iPad; CPU OS 8_1_1 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12B435 Safari/600.1.4', '', '', '', '', '', '', '2015-05-18 03:09:24'),
(37808344, 5, '27.74.45.147', 'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 630 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537', '', '', '', '', '', '', '2015-05-18 03:09:25'),
(37808345, 5, '113.167.46.215', 'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; Lumia 630 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537', '', '', '', '', '', '', '2015-05-18 03:09:26'),
(37808346, 5, '171.253.29.201', 'Mozilla/5.0 (Linux; Android 4.2.2; R831K Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Mobile Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:27'),
(37808347, 5, '113.185.6.42', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_1_2 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) GSA/5.1.42378 Mobile/12B440 Safari/600.1.4', '', '', '', '', '', '', '2015-05-18 03:09:30'),
(37808348, 5, '171.254.17.234', 'Mozilla/5.0 (Linux; Android 4.2.2; Lenovo A369i Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.94 Mobile Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:30'),
(37808349, 5, '115.77.2.177', 'Mozilla/5.0 (Linux; U; Android 4.4.2; vi-vn; L-01F Build/KVT49L.A1406613943) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.1599.103 Mobile Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:30'),
(37808350, 5, '171.253.44.57', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 520)', '', '', '', '', '', '', '2015-05-18 03:09:31'),
(37808351, 4, '80.14.87.68', 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET4.0C)', '', '', '', '', '', '', '2015-05-18 03:09:33'),
(37808352, 4, '123.24.246.27', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:34'),
(37808353, 4, '113.163.128.120', 'Mozilla/5.0 (Windows NT 5.1; rv:38.0) Gecko/20100101 Firefox/38.0', '', '', '', '', '', '', '2015-05-18 03:09:35'),
(37808354, 5, '123.23.18.181', 'Mozilla/5.0 (Mobile; Windows Phone 8.1; Android 4.0; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; Microsoft; Lumia 535 Dual SIM) like iPhone OS 7_0_3 Mac OS X AppleWebKit/537 (KHTML, like Gecko) Mobile Safari/537', '', '', '', '', '', '', '2015-05-18 03:09:37'),
(37808355, 4, '116.98.81.46', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/47.0 Chrome/41.0.2272.127_coc_coc Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:37'),
(37808356, 4, '113.170.105.155', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:39'),
(37808357, 4, '1.54.199.110', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:39'),
(37808358, 5, '168.63.200.167', 'Mozilla/5.0 (Windows Phone 8.1; ARM; Trident/7.0; Touch; rv:11.0; IEMobile/11.0; NOKIA; RM-1019) like Gecko', '', '', '', '', '', '', '2015-05-18 03:09:40'),
(37808359, 4, '211.30.165.132', 'Mozilla/5.0 (iPad; CPU OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12F69 Safari/600.1.4', '', '', '', '', '', '', '2015-05-18 03:09:41'),
(37808360, 4, '116.105.198.89', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/47.0 Chrome/41.0.2272.127_coc_coc Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:41'),
(37808361, 4, '113.174.195.202', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.165 CoRom/33.0.1750.165 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:43'),
(37808362, 5, '113.185.5.161', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0_2 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A501 Safari/9537.53', '', '', '', '', '', '', '2015-05-18 03:09:43'),
(37808363, 4, '42.114.61.29', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/47.0 Chrome/41.0.2272.127_coc_coc Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:44'),
(37808364, 5, '116.102.35.82', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Nokia 1320)', '', '', '', '', '', '', '2015-05-18 03:09:45'),
(37808365, 4, '42.116.92.196', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.152 Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:46'),
(37808366, 4, '42.112.237.156', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/47.0 Chrome/41.0.2272.127_coc_coc Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:48'),
(37808367, 5, '113.174.224.167', 'Mozilla/5.0 (Linux; Android 4.1.2; Nokia_X Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.82 Mobile Safari/537.36 NokiaBrowser/1.2.0.12', '', '', '', '', '', '', '2015-05-18 03:09:48'),
(37808368, 5, '113.185.5.255', 'Mozilla/5.0 (Linux; Android 4.2.2; GT-I9500 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96 Mobile Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:48'),
(37808369, 5, '113.187.4.115', 'Mozilla/5.0 (iPhone; CPU iPhone OS 6_1_3 like Mac OS X) AppleWebKit/536.26 (KHTML, like Gecko) Version/6.0 Mobile/10B329 Safari/8536.25', '', '', '', '', '', '', '2015-05-18 03:09:49'),
(37808370, 4, '58.187.84.179', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/47.0 Chrome/41.0.2272.127_coc_coc Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:51'),
(37808371, 5, '123.23.21.57', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; NOKIA; Lumia 820)', '', '', '', '', '', '', '2015-05-18 03:09:53'),
(37808372, 5, '123.19.130.73', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_1_1 like Mac OS X) AppleWebKit/537.51.2 (KHTML, like Gecko) Version/7.0 Mobile/11D201 Safari/9537.53', '', '', '', '', '', '', '2015-05-18 03:09:54'),
(37808373, 4, '113.182.238.123', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/47.0 Chrome/41.0.2272.127_coc_coc Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:56'),
(37808374, 4, '115.79.55.249', 'Mozilla/5.0 (Windows NT 5.1; rv:38.0) Gecko/20100101 Firefox/38.0', '', '', '', '', '', '', '2015-05-18 03:09:57'),
(37808375, 4, '27.77.66.100', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/47.0 Chrome/41.0.2272.127_coc_coc Safari/537.36', '', '', '', '', '', '', '2015-05-18 03:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE IF NOT EXISTS `websites` (
`id` int(11) NOT NULL,
  `campaignid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `domain_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `payee_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `mode_of_payment` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `unique_users` int(11) NOT NULL,
  `total_views` int(11) NOT NULL,
  `unique_views` int(11) NOT NULL,
  `page_rank` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `help_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `account_id` int(11) NOT NULL,
  `order_no` int(11) DEFAULT '1',
  `icp` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '_',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `campaignid`, `name`, `logo`, `comments`, `contact`, `email`, `website`, `domain_name`, `language`, `address`, `city`, `postcode`, `country`, `phone`, `fax`, `payee_name`, `tax_id`, `mode_of_payment`, `currency`, `unique_users`, `total_views`, `unique_views`, `page_rank`, `category`, `help_file`, `created_at`, `updated_at`, `account_id`, `order_no`, `icp`, `status`) VALUES
(3, 4, 'Sức khỏe cộng đồng', '', '', 'Công ty Cổ phần iNews 247 quận Cầu Giấy, Hà Nội', 'info@tintuc.vn', 'http://skcd.com.vn/', '', '52', '', '', '', '247', '', '', '', '', '', '', 0, 97271, 28033, 0, 94, '', '2015-05-16 07:27:13', '2015-05-16 00:27:13', 0, 1, '_', 0),
(4, 5, 'Tin tức Việt Nam', '', '', 'Công ty Cổ phần iNews 247 quận Cầu Giấy, Hà Nội', 'info@tintuc.vn', 'http://tintuc.vn/', '', '52', '', '', '', '247', '', '', '', '', '', '', 0, 28316302, 20447202, 0, 24, '', '2015-05-18 10:10:01', '2015-05-16 00:27:50', 0, 2, '_', 0),
(5, 6, 'Mobile tin tức Việt Nam', '', '', '247 Cầu Giấy, quận Cầu Giấy, Hà Nội', 'info@tintuc.vn', 'http://m.tintuc.vn/', '', '52', '', '', '', '247', '', '', '', '', '', '', 0, 24737131, 20187068, 0, 24, '', '2015-05-18 10:09:57', '2015-05-16 00:26:12', 0, 3, '_', 0),
(6, 8, 'CÔNG TY TNHH THÔNG TIN TRƯỜNG PHÁT', '', '', 'Số 179, Lý Chính Thắng, P.7, Q.3. TP.HCM', 'ntthom@tpinfo.vn', 'http://truongphat.com.vn/', '', '52', '', '', '', '247', '', '', '', '', '', '', 0, 0, 0, 0, 0, '', '2015-05-16 07:25:03', '2015-05-16 00:25:03', 0, 4, '_', 0),
(7, 9, 'MẠNG BÁN LẺ TRỰC TUYẾN GOHAPPY', '', '', 'Văn phòng giao dịch:  Lô 11-H1 khu đô thị Yên Hòa, quận Cầu Giấy, Hà Nội, Việt Nam', 'sales@gohappy.vn', 'http://gohappy.vn/', 'gohappy.vn', '52', '', '', '', '247', '', '', '', '', '', '', 0, 0, 0, 0, NULL, '', '2015-05-16 07:25:35', '2015-05-16 00:25:35', 0, 5, '_', 0);

-- --------------------------------------------------------

--
-- Table structure for table `websites_banners`
--

CREATE TABLE IF NOT EXISTS `websites_banners` (
`id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `adbanner_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagefile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adbanner_link` text COLLATE utf8_unicode_ci NOT NULL,
  `adbanner_description` text COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websites_partners`
--

CREATE TABLE IF NOT EXISTS `websites_partners` (
`id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `topic_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icp` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websites_topics`
--

CREATE TABLE IF NOT EXISTS `websites_topics` (
`id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `feed_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feed_address` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `period` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
`id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL,
  `zonename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery` int(6) NOT NULL,
  `zonetype` int(6) NOT NULL,
  `category` int(6) NOT NULL,
  `width` int(6) NOT NULL,
  `height` int(6) NOT NULL,
  `ad_selection` int(6) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `cost` int(6) NOT NULL,
  `cost_type` int(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `block` int(11) NOT NULL,
  `rate` int(6) NOT NULL,
  `pricing` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `website_id`, `zonename`, `description`, `delivery`, `zonetype`, `category`, `width`, `height`, `ad_selection`, `comments`, `cost`, `cost_type`, `created_at`, `updated_at`, `block`, `rate`, `pricing`, `order_no`, `status`) VALUES
(4, 3, 'zone 1', 'Zone 1', 0, 1, 0, 728, 90, 26, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:28:26', 0, 0, '', 1, 1),
(5, 3, 'zone 2', 'Zone 2', 0, 1, 0, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:31:07', 0, 0, '', 2, 1),
(6, 3, 'zone 3', 'Zone 3', 0, 1, 0, 300, 600, 39, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:33:40', 0, 0, '', 3, 1),
(7, 4, 'HT01', 'Vùng hiển thị header top banner 1', 0, 1, 24, 366, 90, 40, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:36:23', 0, 0, '', 4, 1),
(8, 4, 'HT02', 'Vùng hiển thị header top banner 2', 0, 1, 24, 366, 90, 40, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:40:45', 0, 0, '', 5, 1),
(9, 4, 'HC01', 'Vùng hiển thị ở giữa trang chủ 1', 0, 1, 24, 495, 90, 41, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:44:53', 0, 0, '', 6, 1),
(10, 4, 'HC02', 'Vùng hiển thị ở giữa trang chủ 2', 0, 1, 24, 495, 90, 41, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:50:15', 0, 0, '', 7, 1),
(11, 4, 'HC03', 'Vùng hiển thị ở giữa trang chủ 3', 0, 1, 24, 495, 90, 41, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:52:43', 0, 0, '', 8, 1),
(12, 4, 'HC04', 'Vùng hiển thị ở giữa trang chủ 4', 0, 1, 24, 495, 90, 41, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:55:54', 0, 0, '', 9, 1),
(13, 4, 'C01', 'Vùng hiển thị cho các trang danh mục', 0, 1, 24, 200, 600, 42, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 00:58:33', 0, 0, '', 10, 1),
(14, 4, 'DL01', 'Vùng quảng cáo cho các trang chi tiết phía bên trái', 0, 1, 24, 160, 600, 38, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:01:31', 0, 0, '', 11, 1),
(15, 4, 'Zone mobile 320x100', 'Vùng quảng cáo cho mobile kích thước 320x100px', 0, 1, 24, 320, 100, 43, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:04:05', 0, 0, '', 12, 1),
(16, 4, 'Zone mobile 320x250', 'Vùng quảng cáo cho mobile kích thước 320x250px', 0, 1, 24, 320, 250, 44, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:05:51', 0, 0, '', 13, 1),
(17, 4, 'Zone mobile đáp ứng', 'Vùng quảng cáo cho mobile kích thước tùy chỉnh', 0, 1, 24, 0, 0, 45, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:07:42', 0, 0, '', 14, 1),
(18, 5, 'Vùng hiển thị dưới phần comment trên phiên bản mobile của trang tintuc.vn', 'Vùng hiển thị dưới phần comment trên phiên bản mobile của trang tintuc.vn', 0, 1, 24, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:09:29', 0, 0, '', 15, 1),
(19, 5, 'Vùng hiển thị dưới bài nổi bật của trang chuyên mục trên phiên bản mobile của trang tintuc.vn', 'Vùng hiển thị dưới bài nổi bật của trang chuyên mục trên phiên bản mobile của trang tintuc.vn', 0, 1, 24, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:10:07', 0, 0, '', 16, 1),
(20, 5, 'Vùng hiển thị trên trang chủ phiên bản mobile của trang tintuc.vn', 'Vùng hiển thị trên trang chủ phiên bản mobile của trang tintuc.vn', 0, 1, 24, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:10:50', 0, 0, '', 17, 1),
(21, 5, 'Vùng hiển thị dưới cùng của trang chuyên mục trên phiên bản mobile của trang tintuc.vn', 'Vùng hiển thị dưới cùng của trang chuyên mục trên phiên bản mobile của trang tintuc.vn', 0, 1, 24, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:11:34', 0, 0, '', 18, 1),
(22, 5, 'Vùng hiển thị trên trang chi tiết phiên bản mobile của trang tintuc.vn', 'Vùng hiển thị trên trang chi tiết phiên bản mobile của trang tintuc.vn', 0, 1, 24, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:13:41', 0, 0, '', 19, 1),
(23, 5, 'Vùng hiển thị trên trang tag(tiêu điểm) phiên bản mobile của trang tintuc.vn', 'Vùng hiển thị trên trang tag(tiêu điểm) phiên bản mobile của trang tintuc.vn', 0, 1, 24, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:15:24', 0, 0, '', 20, 1),
(24, 5, 'Vùng hiển thị trên trang tin hot phiên bản mobile của trang tintuc.vn', 'Vùng hiển thị trên trang tin hot phiên bản mobile của trang tintuc.vn', 0, 1, 24, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:16:57', 0, 0, '', 21, 1),
(25, 5, 'Vùng hiển thị trên trang tin tức 24h phiên bản mobile của trang tintuc.vn', 'Vùng hiển thị trên trang tin tức 24h phiên bản mobile của trang tintuc.vn', 0, 1, 24, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:17:37', 0, 0, '', 22, 1),
(26, 4, 'Vùng hiển thị banner cột phải chuyên mục ô tô - xe máy', 'Vùng hiển thị banner cột phải chuyên mục ô tô - xe máy', 0, 1, 11, 300, 90, 40, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:19:28', 0, 0, '', 23, 1),
(27, 4, 'Quảng cáo cho chuyên mục tin tức 24h trên trang tintuc.vn', 'Quảng cáo cho chuyên mục tin tức 24h trên trang tintuc.vn', 0, 1, 24, 160, 600, 38, '', 0, 0, '2015-05-18 08:59:40', '2014-12-23 18:27:29', 0, 0, '', 24, 1),
(28, 6, 'Vùng quảng cáo banner cho CÔNG TY TNHH THÔNG TIN TRƯỜNG PHÁT (trên trang chủ)', '', 0, 1, 0, 300, 500, 39, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:20:58', 0, 0, '', 25, 1),
(29, 6, 'Vùng quảng cáo banner (trên trang danh mục)', '', 0, 1, 0, 300, 250, 34, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:24:14', 0, 0, '', 26, 1),
(30, 4, 'Zone 300 x 250', 'Zone 300 x 250', 0, 1, 0, 300, 250, 0, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:25:50', 0, 0, '', 27, 1),
(31, 4, 'Banner 728 x 90', 'Banner 728 x 90', 0, 1, 0, 728, 90, 0, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:27:39', 0, 0, '', 28, 1),
(32, 4, 'Zone 300 x 250 (lần 2)', 'Zone 300 x 250 (lần 2)', 0, 1, 0, 300, 250, 0, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:29:57', 0, 0, '', 29, 1),
(33, 7, 'Vùng hiển thị Top Banner 728x90', '', 0, 1, 0, 728, 90, 26, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:32:12', 0, 0, '0', 30, 1),
(34, 7, 'Vùng hiển thị top banner trên tất cả các trang con đi tới trang goHappy', 'Vùng hiển thị top banner trên tất cả các trang con đi tới trang goHappy', 0, 1, 0, 728, 85, 26, '', 0, 0, '2015-05-18 08:59:40', '2015-05-16 01:33:59', 0, 0, '0', 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zonetypes`
--

CREATE TABLE IF NOT EXISTS `zonetypes` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zonetypes`
--

INSERT INTO `zonetypes` (`id`, `title`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Banner, Button or Rectangle', 'A banner advertisement image. The image can be a gif, jpg, or png file.', '0000-00-00 00:00:00', '2015-05-16 01:35:16', 0),
(2, 'Text ad', 'A standard HTML text link to an advertiser''s site.', '0000-00-00 00:00:00', '2015-05-16 01:35:33', 0),
(3, 'Email/Newsletter zone ', '', '0000-00-00 00:00:00', '2015-05-16 01:35:52', 0),
(4, 'Video', 'A video advertisement. The video can be a flash swf/flv file, or an HTML5 mp4/webm video. The ad can be displayed as a standalone video or through VAST.', '0000-00-00 00:00:00', '2015-05-16 01:36:14', 0),
(5, 'Free-form', 'Free-form lets you paste in any ad code format, such as from third party ad providers like Google Adsense.', '0000-00-00 00:00:00', '2015-05-16 01:36:35', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adtypes`
--
ALTER TABLE `adtypes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cclicks`
--
ALTER TABLE `cclicks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clicks`
--
ALTER TABLE `clicks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cviews`
--
ALTER TABLE `cviews`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_helper`
--
ALTER TABLE `data_helper`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_uri`
--
ALTER TABLE `data_uri`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folder_banners`
--
ALTER TABLE `folder_banners`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websites_banners`
--
ALTER TABLE `websites_banners`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websites_partners`
--
ALTER TABLE `websites_partners`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websites_topics`
--
ALTER TABLE `websites_topics`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zonetypes`
--
ALTER TABLE `zonetypes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `adtypes`
--
ALTER TABLE `adtypes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=179;
--
-- AUTO_INCREMENT for table `cclicks`
--
ALTER TABLE `cclicks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clicks`
--
ALTER TABLE `clicks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4484;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=257;
--
-- AUTO_INCREMENT for table `cviews`
--
ALTER TABLE `cviews`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=312;
--
-- AUTO_INCREMENT for table `data_helper`
--
ALTER TABLE `data_helper`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_uri`
--
ALTER TABLE `data_uri`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `folder_banners`
--
ALTER TABLE `folder_banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `userlogs`
--
ALTER TABLE `userlogs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37808376;
--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `websites_banners`
--
ALTER TABLE `websites_banners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `websites_partners`
--
ALTER TABLE `websites_partners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `websites_topics`
--
ALTER TABLE `websites_topics`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `zonetypes`
--
ALTER TABLE `zonetypes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
