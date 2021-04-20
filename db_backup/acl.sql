-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2021 at 05:54 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acl`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_user`
--

DROP TABLE IF EXISTS `api_user`;
CREATE TABLE IF NOT EXISTS `api_user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_user`
--

INSERT INTO `api_user` (`id`, `name`, `password`) VALUES
(1, 'abhi', 521),
(2, 'abhishek sharma', 123),
(19, 'test', 1112),
(18, 'test', 1112);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `comment_title` varchar(100) NOT NULL,
  `comment_description` text NOT NULL,
  `task_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `comment_status` int(50) NOT NULL DEFAULT '0',
  `parent_id` int(20) NOT NULL DEFAULT '0',
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment_title`, `comment_description`, `task_id`, `user_id`, `comment_status`, `parent_id`, `comment_date`) VALUES
(66, 'new cmt', 'soem issue in task', 26, 3, 0, 0, '2021-04-15 11:06:22'),
(67, 'new cmt', 'soem issue in task', 26, 3, 0, 0, '2021-04-15 11:06:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `contact_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `message`, `contact_date`) VALUES
(1, 'abhishek', 'abhisheks.fsm@gmail.com', '1234', 'kmjynhtbgrvfecdwx', '2021-04-14 17:10:26'),
(10, 't', 't@gmail.com', '12e24r312t', '3tqf', '2021-04-14 17:46:59'),
(9, 'abhishek', 'abhisheks.fsm@gmail.com', '121', 'w1dsde', '2021-04-14 17:32:28'),
(8, 'guest', '32fd1', 'f31cvc', 'ewvew', '2021-04-14 17:28:42'),
(11, 'abhishek', 'abhi@gmail.com', 't6y8t12233', 'wfw4fw', '2021-04-14 18:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `methods`
--

DROP TABLE IF EXISTS `methods`;
CREATE TABLE IF NOT EXISTS `methods` (
  `method_id` int(20) NOT NULL AUTO_INCREMENT,
  `method_name` varchar(50) NOT NULL,
  PRIMARY KEY (`method_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `methods`
--

INSERT INTO `methods` (`method_id`, `method_name`) VALUES
(1, 'edit_project'),
(2, 'delete_project'),
(3, 'view'),
(9, 'add_project'),
(10, 'add_task'),
(11, 'edit_task'),
(12, 'delete_task');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(20) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(50) NOT NULL,
  `project_description` text NOT NULL,
  `status1` varchar(50) NOT NULL,
  `status2` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `project_image` varchar(250) NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_name`, `project_description`, `status1`, `status2`, `start_date`, `end_date`, `project_image`) VALUES
(21, 'library management system', 'here we create a system application for maintain library record.', 'enable', 'current', '2021-04-08', '2021-04-14', 'http://[::1]/ACL/uploads/projects_image/librarry2.jpg'),
(22, 'hospital management', 'create hospital managemnet system for handel the record for hospital acrtivity.', 'enable', 'current', '2021-04-20', '2021-04-20', 'http://[::1]/ACL/uploads/projects_image/hms.jpg'),
(40, 'weather prediction app', 'Weather forecast detects weather in your current location automatically. ... Real-time temperature, rain, snow, humidity, pressure, wind force and wind direction are all in this weather application based. Features: - All is free, weekly, daily, hourly update with real time.', 'disable', 'delay', '2021-03-30', '2021-05-06', 'http://[::1]/ACL/uploads/projects_image/weather.png'),
(43, 'Home automation (IOT)', 'Smart homes and Internet of Things\r\nSuch systems depend on the collection of data. The data is then used for monitoring, controlling and transferring information to other devices via the internet. This allows specific actions to be automatically activated whenever certain situations arise.', 'enable', 'current', '2021-04-14', '2021-05-07', 'http://[::1]/ACL/uploads/projects_image/home.jpg'),
(44, 'face recognition app', 'Facial recognition is a way of identifying or confirming an individual’s identity using their face. Facial recognition systems can be used to identify people in photos, videos, or in real-time', 'enable', 'current', '2021-04-28', '2021-04-30', 'http://[::1]/ACL/uploads/projects_image/face.png'),
(45, 'school management system ', 'The main purpose using School Management System Project is to avoid manual problems and also documentation storage problem we can’t maintain long period data that’s why we used computerized system to overcome all problem related to school’s data storing and other arias.', 'enable', 'current', '2021-05-01', '2021-04-20', 'http://[::1]/ACL/uploads/projects_image/DBIT.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project_assign`
--

DROP TABLE IF EXISTS `project_assign`;
CREATE TABLE IF NOT EXISTS `project_assign` (
  `project_assign_id` int(50) NOT NULL AUTO_INCREMENT,
  `project_id` int(50) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `project_assign_manager_id` int(50) NOT NULL,
  `project_assign_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_assign_id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_assign`
--

INSERT INTO `project_assign` (`project_assign_id`, `project_id`, `project_name`, `project_assign_manager_id`, `project_assign_date`) VALUES
(90, 22, 'hospital management', 7, '2021-04-07 16:16:31'),
(86, 21, 'library management', 5, '2021-04-07 10:28:21'),
(105, 40, 'test_project', 1, '2021-04-12 17:25:31'),
(111, 43, 'Home automation (IOT)', 1, '2021-04-14 13:13:56'),
(49, 21, 'library mamagement', 1, '2021-04-03 12:32:39'),
(54, 21, 'library management', 2, '2021-04-05 16:17:41'),
(85, 22, 'hospital management', 2, '2021-04-06 19:27:59'),
(47, 22, 'hospital management', 1, '2021-04-03 12:14:53'),
(110, 43, 'Home automation (IOT)', 2, '2021-04-14 13:13:56'),
(103, 40, 'test_project', 2, '2021-04-12 17:25:31'),
(112, 44, 'face recognition app', 2, '2021-04-14 13:23:11'),
(113, 44, 'face recognition app', 1, '2021-04-14 13:23:11'),
(114, 45, 'school management system ', 2, '2021-04-14 13:26:57'),
(115, 45, 'school management system ', 1, '2021-04-14 13:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(20) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(29, 'guest'),
(33, 'administrator'),
(34, 'project manager'),
(35, 'developer');

-- --------------------------------------------------------

--
-- Table structure for table `role_method`
--

DROP TABLE IF EXISTS `role_method`;
CREATE TABLE IF NOT EXISTS `role_method` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `role_id` int(50) NOT NULL,
  `method_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_method`
--

INSERT INTO `role_method` (`id`, `role_id`, `method_id`) VALUES
(93, 33, 3),
(104, 34, 11),
(103, 33, 11),
(97, 33, 9),
(91, 33, 1),
(102, 33, 10),
(90, 29, 3),
(92, 33, 2),
(101, 34, 10),
(95, 34, 3),
(96, 35, 3),
(105, 33, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(50) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(50) NOT NULL,
  `task_description` text NOT NULL,
  `task_project_id` int(50) NOT NULL,
  `task_status1` varchar(50) NOT NULL,
  `task_priority` varchar(50) NOT NULL,
  `task_start_date` date NOT NULL,
  `task_end_date` date NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_name`, `task_description`, `task_project_id`, `task_status1`, `task_priority`, `task_start_date`, `task_end_date`) VALUES
(40, 'hospital task', 'task', 22, 'disable', 'low', '2021-04-16', '2021-04-29'),
(26, 'issue book', 'here we do iaaue  book', 21, 'enable', 'high', '2021-04-05', '2021-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `task_assign`
--

DROP TABLE IF EXISTS `task_assign`;
CREATE TABLE IF NOT EXISTS `task_assign` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `project_id` int(50) NOT NULL,
  `task_id` int(50) NOT NULL,
  `task_name` varchar(50) NOT NULL,
  `task_assign_developer_id` int(50) NOT NULL,
  `task_assign_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_assign`
--

INSERT INTO `task_assign` (`id`, `project_id`, `task_id`, `task_name`, `task_assign_developer_id`, `task_assign_date`) VALUES
(54, 22, 40, 'hospital task', 3, '2021-04-07 16:17:42'),
(28, 21, 26, 'issue book', 6, '2021-04-06 12:07:26'),
(22, 21, 26, 'issue book', 3, '2021-04-05 17:01:11'),
(55, 22, 40, 'hospital task', 6, '2021-04-07 16:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_role_id` int(50) NOT NULL DEFAULT '29',
  `user_image` varchar(250) NOT NULL DEFAULT 'http://[::1]/ACL/uploads/users_image/defalut_profile.png',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_role_id`, `user_image`) VALUES
(1, 'abhi', 'abhi@gmail.com', '1234', 33, 'http://[::1]/ACL/uploads/users_image/profile.png'),
(2, 'abhishek', 'abhisheks.fsm@gmail.com', '1234', 34, 'http://[::1]/ACL/uploads/users_image/default_profile.png'),
(3, 'chandan kashyap', 'c@gmail.com', '1234', 35, 'http://[::1]/ACL/uploads/users_image/default_profile.png'),
(5, 'saksham chauhan', 's@gmail.com', '1234', 34, 'http://[::1]/ACL/uploads/users_image/fb2.jpg'),
(6, 'ravi', 'r@gmail.com', '1234', 35, 'http://[::1]/ACL/uploads/users_image/default_profile.png'),
(7, 'sunny', 'sunny@gmail.com', '1234', 34, 'http://[::1]/ACL/uploads/users_image/default_profile.png'),
(8, 'new test', 'n@gmail.com', '1234', 29, 'http://[::1]/ACL/uploads/users_image/fb.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
