-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: 192.168.2.26
-- Generation Time: 2017-09-19 18:38:33
-- 服务器版本： 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ymanage`
--

-- --------------------------------------------------------

--
-- 表的结构 `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL COMMENT '任务id',
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '名称',
  `descript` varchar(1024) COLLATE utf8_bin DEFAULT NULL COMMENT '说明',
  `cmd` varchar(1024) COLLATE utf8_bin DEFAULT NULL COMMENT '执行命令',
  `source` longtext COLLATE utf8_bin COMMENT '源代码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `taskstatus`
--

CREATE TABLE `taskstatus` (
  `id` int(11) NOT NULL,
  `uuid` text COLLATE utf8_bin COMMENT '此任务唯一ID，用于多次提交信息时辨认同一任务',
  `hostname` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '主机名',
  `username` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT '用户名',
  `taskid` int(11) NOT NULL DEFAULT '0' COMMENT '任务id',
  `starttime` datetime DEFAULT NULL COMMENT '任务开始时间',
  `endtime` datetime DEFAULT NULL COMMENT '任务结束时间',
  `status` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT '简短的结果标识',
  `retcode` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '返回码',
  `outputtext` longtext COLLATE utf8_bin COMMENT '执行结果',
  `outputfile` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '结果文件如有',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '数据提交时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taskstatus`
--
ALTER TABLE `taskstatus`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '任务id';
--
-- 使用表AUTO_INCREMENT `taskstatus`
--
ALTER TABLE `taskstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
