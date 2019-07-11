-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2019 at 09:21 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exercise`
--

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` varchar(50) DEFAULT NULL,
  `location_id` varchar(50) DEFAULT NULL,
  `contractor_id` varchar(50) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `special_project` tinyint(1) UNSIGNED DEFAULT NULL,
  `permanent_works` tinyint(1) UNSIGNED DEFAULT NULL,
  `depth` decimal(13,2) DEFAULT NULL,
  `length` decimal(13,2) DEFAULT NULL,
  `width` decimal(13,2) DEFAULT NULL,
  `design_type_id` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `design_categories`
--

CREATE TABLE `design_categories` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `turnaround_time` varchar(255) NOT NULL,
  `hex_color` varchar(255) NOT NULL,
  `rgb_color` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by_id` varchar(32) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by_id` varchar(32) NOT NULL,
  `deleted_by_id` varchar(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `design_categories`
--

INSERT INTO `design_categories` (`id`, `description`, `turnaround_time`, `hex_color`, `rgb_color`, `created_at`, `created_by_id`, `updated_at`, `updated_by_id`, `deleted_by_id`, `deleted_at`) VALUES
(0, '-', '', '#999999', '153,153,153', '2018-08-13 07:33:37', '419', '2018-07-03 10:26:45', '419', NULL, NULL),
(1, 'Conceptual', 'N/A', '#9933CC', '153,51,204', '2018-08-13 07:33:43', '419', '2018-07-03 10:26:49', '419', '419', '2017-11-03 10:55:04'),
(2, '0', '1 Day', '#0070C0', '0,112,192', '2018-08-13 07:33:48', '419', '2018-07-03 10:26:53', '419', NULL, NULL),
(3, '1', '1 Day', '#92D050', '146,208,80', '2018-08-13 07:33:53', '419', '2018-07-03 10:26:57', '419', NULL, NULL),
(4, '2A', '2 Days', '#FFC000', '255,192,0', '2018-08-13 07:33:58', '419', '2018-07-03 10:27:00', '419', NULL, NULL),
(5, '2B', '3 Days', '#FF7C09', '255,124,9', '2018-08-13 07:34:03', '419', '2018-07-03 10:27:04', '419', NULL, NULL),
(6, '2C', '3/4 Days', '#FF0000', '255,0,0', '2018-08-13 07:34:10', '419', '2018-07-03 10:27:07', '419', NULL, NULL),
(7, '3', '5 Days', '#993366', '153,51,102', '2018-08-13 07:34:15', '419', '2018-07-03 10:27:11', '419', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `design_engineers`
--

CREATE TABLE `design_engineers` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `initial` varchar(5) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `qualifications` varchar(50) DEFAULT NULL,
  `eductaion` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `design_engineers`
--

INSERT INTO `design_engineers` (`id`, `userid`, `name`, `initial`, `grade`, `title`, `qualifications`, `eductaion`) VALUES
(1, 'brian', 'Brian Griffin', '', 'a', 'Mr', 'mEng(2:ii)', NULL),
(2, 'jim', 'Jim Bowen', NULL, 'b', 'Mr', 'bTec', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `design_issues`
--

CREATE TABLE `design_issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `design_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(3) UNSIGNED DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `date_in` datetime DEFAULT NULL,
  `date_out` datetime DEFAULT NULL,
  `designer_id` int(10) DEFAULT NULL,
  `checker_id` int(10) DEFAULT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `drawing_req` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `design_senior_engineers`
--

CREATE TABLE `design_senior_engineers` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `initial` varchar(5) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `qualifications` varchar(50) DEFAULT NULL,
  `eductaion` text,
  `synopsis` text,
  `memberships` text,
  `experience` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `design_senior_engineers`
--

INSERT INTO `design_senior_engineers` (`id`, `userid`, `name`, `initial`, `grade`, `title`, `qualifications`, `eductaion`, `synopsis`, `memberships`, `experience`) VALUES
(10001, 'jane', 'Jane McDonald', 'S', 'r', 'Mrs', NULL, '1st Class BSc Civil Engineering', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In in magna purus. Donec interdum quis est in ultrices. Integer nec ex vitae neque consequat aliquam sed nec neque. In sem purus, egestas at interdum convallis, egestas ut erat. Morbi posuere justo id erat porta consequat. Praesent purus est, eleifend sit amet libero ut, congue venenatis turpis. Curabitur tristique, lorem eget ornare dignissim, lorem sapien bibendum enim, eget fermentum quam ex vel metus. Nam condimentum tellus nec nibh egestas, eu finibus nisl gravida.', 'Chartered Member Institute of Civil Engineers', 'Vivamus efficitur urna nulla, porttitor venenatis leo scelerisque vitae. Cras non turpis magna. Vestibulum laoreet neque lobortis ligula tristique pulvinar. Ut molestie gravida rutrum. Integer sagittis mi mauris, vel interdum ex suscipit vel. Mauris eleifend scelerisque mauris mattis mollis. Mauris urna ante, fringilla eu convallis eget, congue vel tortor. Morbi varius dapibus purus, at imperdiet orci viverra nec. Nulla sit amet vulputate augue. Sed efficitur tincidunt dolor, eu porttitor eros dapibus a. Sed dignissim condimentum ipsum pellentesque maximus. Fusce porta placerat pellentesque. Proin finibus a ipsum vel accumsan. Nulla et eleifend metus, porta tempus magna.'),
(10002, 'bart', 'Bart Simpson', 'H', 's', 'Mr', 'BSc (Hons)', NULL, 'Cras dignissim ipsum suscipit ipsum sagittis, ut luctus justo aliquet. Nam sollicitudin justo cursus pulvinar imperdiet. Aenean in urna dapibus, tincidunt nulla non, volutpat nisl. Etiam posuere eleifend ipsum sed tempor. Proin quis tincidunt massa. Aenean quis volutpat nisl. Quisque eget turpis ut justo aliquet consectetur id nec ante. Phasellus laoreet porttitor orci, eu molestie velit. Sed ornare imperdiet iaculis. Aliquam erat volutpat. Mauris eget urna rhoncus, auctor odio at, ultricies mi. Aenean et massa lobortis, sagittis tellus vitae, dapibus ante. Nunc ac felis nec massa sodales vestibulum. Maecenas luctus fringilla facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut libero mi.', 'Chartered Member of Institution of Structural Engineers', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `design_statuses`
--

CREATE TABLE `design_statuses` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by_id` varchar(32) NOT NULL,
  `modified_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by_id` varchar(32) NOT NULL,
  `deleted_by_id` varchar(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `design_statuses`
--

INSERT INTO `design_statuses` (`id`, `description`, `created_at`, `created_by_id`, `modified_timestamp`, `modified_by_id`, `deleted_by_id`, `deleted_at`) VALUES
(0, 'Awaiting Rep Approval', '2018-07-27 09:53:26', '419', '2018-07-27 09:53:46', '419', NULL, NULL),
(1, 'Awaiting Review', '2016-10-25 14:12:44', '419', '2018-08-13 07:08:50', '419', NULL, NULL),
(2, 'Reviewed', '2018-08-13 07:31:51', '419', '2018-08-13 07:09:01', '419', NULL, NULL),
(3, 'On Hold', '2018-08-13 07:31:58', '419', '2018-08-13 07:09:05', '419', NULL, NULL),
(4, 'Design', '2018-08-13 07:32:02', '419', '2018-08-13 07:09:08', '419', NULL, NULL),
(5, 'Awaiting Check', '2018-08-13 07:32:06', '419', '2018-08-13 07:09:15', '419', NULL, NULL),
(6, 'Check', '2018-08-13 07:32:09', '419', '2018-08-13 07:09:18', '419', NULL, NULL),
(7, 'Approved', '2018-08-13 07:32:13', '419', '2018-08-13 07:09:21', '419', NULL, NULL),
(8, 'Complete', '2018-08-13 07:32:16', '419', '2018-08-13 07:09:25', '419', NULL, NULL),
(9, 'Dead End', '2018-08-13 07:32:19', '419', '2018-08-13 07:09:30', '419', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `design_types`
--

CREATE TABLE `design_types` (
  `id` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by_id` varchar(32) NOT NULL,
  `modified_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by_id` varchar(32) NOT NULL,
  `deleted_by_id` varchar(10) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `design_types`
--

INSERT INTO `design_types` (`id`, `description`, `icon`, `created_at`, `created_by_id`, `modified_timestamp`, `modified_by_id`, `deleted_by_id`, `deleted_at`) VALUES
('ess', 'Excavation Support', 'denac-icon-design-type-excavation-support', '2018-08-13 07:33:14', '419', '2017-01-20 09:29:21', '419', NULL, NULL),
('f', 'Frame Only', 'denac-icon-frame-only', '2017-11-03 10:45:33', '419', '2017-11-07 09:22:08', '419', NULL, NULL),
('mp', 'Basement', 'denac-icon-design-type-basement', '2018-08-13 07:32:56', '419', '2017-01-20 09:29:21', '419', NULL, NULL),
('o', 'Other', 'uk-icon-question', '2018-08-13 07:33:00', '419', '2017-01-20 09:29:21', '419', NULL, NULL),
('pw', 'Permanent Sheet Pile', 'denac-icon-design-type-permanent', '2018-08-13 07:33:04', '419', '2017-01-20 09:29:21', '419', NULL, NULL),
('sss', 'Structural Support', 'denac-icon-design-type-structural-support', '2018-08-13 07:33:09', '419', '2017-01-20 09:29:21', '419', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design_engineers`
--
ALTER TABLE `design_engineers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design_issues`
--
ALTER TABLE `design_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design_senior_engineers`
--
ALTER TABLE `design_senior_engineers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `design_engineers`
--
ALTER TABLE `design_engineers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `design_issues`
--
ALTER TABLE `design_issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `design_senior_engineers`
--
ALTER TABLE `design_senior_engineers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
