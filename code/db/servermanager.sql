-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 �?04 �?13 �?21:04
-- 服务器版本: 5.5.40
-- PHP 版本: 5.5.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `servermanager`
--

-- --------------------------------------------------------

--
-- 表的结构 `server_info`
--

CREATE TABLE IF NOT EXISTS `server_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_port` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to_connect` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_connect` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `server_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_400940B71844E6B7` (`server_id`),
  UNIQUE KEY `UNIQ_400940B7D5A30FE6` (`server_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `server_info`
--

INSERT INTO `server_info` (`id`, `server_id`, `server_name`, `server_ip`, `server_port`, `server_status`, `to_connect`, `from_connect`, `server_info`) VALUES
(1, 'T1', 'T1Server', '', '', '', 'T2', '', ''),
(2, 'T2', 'T2Server', '127.0.0.1', '6554', '1', '', '', ''),
(3, 'L1', 'L1Server', '', '', '', 'T1', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
