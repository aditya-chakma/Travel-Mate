-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2019 at 10:58 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travelmatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attatchment`
--

CREATE TABLE `attatchment` (
  `aid` int(11) NOT NULL,
  `attatchment_number` int(11) NOT NULL,
  `attatchment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attatchments`
--

CREATE TABLE `attatchments` (
  `aid` int(11) NOT NULL,
  `total_attatchments` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attatchments`
--

INSERT INTO `attatchments` (`aid`, `total_attatchments`) VALUES
(1, 5),
(2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `current_time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prvds_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `service_date` datetime DEFAULT NULL,
  `auth_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `current_time_stamp`, `prvds_id`, `quantity`, `service_date`, `auth_id`) VALUES
(3, '2019-09-18 09:56:33', 12, 4, '2019-09-30 00:00:00', 29),
(5, '2019-09-18 12:22:07', 6, 3, '2019-09-25 00:00:00', 55);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `cmpn_id` int(11) NOT NULL,
  `cmpn_name` varchar(500) CHARACTER SET utf8 NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `e_mail` varchar(500) NOT NULL,
  `address` varchar(300) CHARACTER SET utf8 NOT NULL,
  `location_id` int(11) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `aid` int(11) DEFAULT NULL,
  `file_name` varchar(200) NOT NULL DEFAULT 'defaultplace.jpg',
  `auth_id` int(11) DEFAULT NULL,
  `enable_access` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`cmpn_id`, `cmpn_name`, `description`, `e_mail`, `address`, `location_id`, `contact_number`, `aid`, `file_name`, `auth_id`, `enable_access`) VALUES
(5, 'TravelMate-Chittagong-Bandarban', 'TravelMate-Bandarban-Keokradong', 'travelmate.Chittagong@gmail.com', 'Chittagong', 10, '123456', 1, 'defaultplace.jpg', NULL, NULL),
(6, 'TravelMate-Chittagong-Khagrachari', 'TravelMate-Khagrachari-Sajek Valley', 'travelmate.Chittagong@gmail.com', 'Chittagong', 10, '123456', 1, 'defaultplace.jpg', NULL, NULL),
(7, 'TravelMate-North Sikkim-Lachung', 'TravelMate-Lachung-Yamthung Valley Zero Point', 'travelmate.North Sikkim@gmail.com', 'North Sikkim', 12, '123456', 1, 'defaultplace.jpg', NULL, NULL),
(8, 'TravelMate-Dhaka-Mirpur-1', 'TravelMate-Mirpur-1-National Zoo & Botanical Graden', 'travelmate.Dhaka@gmail.com', 'Dhaka', 13, '123456', 1, 'defaultplace.jpg', NULL, NULL),
(10, 'Meghpunji Resort', 'It\'s close to sky', 'megh@gmail.com', 'Ruilui para,106/2', 11, '01515269628', 1, 'defaultplace.jpg', 30, NULL),
(11, 'Megh Bala', '5 resort , close to sky', 'meghbala@gmail.com', 'House#05,Keokradong', 10, '01515269682', 1, '1566052180.jpg', 38, NULL),
(12, 'Meghalaya resort', 'We provide room,car and guide also', 'meghalaya@gmail.com', 'House#05,Keokradong', 10, '998989', 1, '1563173399.jpg', 41, NULL),
(13, 'Hakuna Matata barvo', 'It means no worries', 'hama@gmail.com', 'Homeless', 12, '2121212', 1, '1564391645.jpg', 50, NULL),
(14, 'Nation Zoo', '########', 'zoo@gmail.com', 'Mirpur-1', 13, '2121212', 1, '1566757362.jpg', 52, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(32) NOT NULL,
  `contact_number` varchar(32) DEFAULT NULL,
  `auth_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `contact_number`, `auth_id`) VALUES
(9, 'Aditya', 'abc@gmail.com', '0152365895', 29),
(10, 'Somudro', 'abcd@gmail.com', '0123654789', 45),
(11, 'Rouf', 'abcde@gmail.com', '01515269628', 46),
(12, 'Abu Yousuf Siam', 'ysiam@gmail.com', '01632071134', 51),
(13, 'Rouf', 'rouf@gmail.com', '01515269628', 53),
(14, 'AbdurRouf', 'arouf@gmail.com', '015XXXXXXXX', 54),
(15, 'Swarna Khan', 'swarna@gmail.com', '01778022441', 55);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(32) NOT NULL,
  `contact_number` varchar(32) NOT NULL,
  `birth_date` date NOT NULL,
  `pos_id` int(11) NOT NULL,
  `address` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `join_date` date NOT NULL,
  `aid` int(11) DEFAULT NULL,
  `auth_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `name`, `email`, `contact_number`, `birth_date`, `pos_id`, `address`, `join_date`, `aid`, `auth_id`) VALUES
(1, 'Wadud Madhuri', 'wadud@gmail.com', '0123658974', '2019-07-06', 5, 'North,Sikkim', '2019-07-19', 1, 26),
(2, 'Mohammad Salah', 'mosalahemployee@gmail.com', '01523568945', '2019-07-16', 5, 'House#3', '2019-07-13', 1, 27),
(3, 'Lionel Messi', 'messi@gmail.com', '0125478963', '2019-07-20', 6, 'House#05,Spain', '2019-07-13', 1, 28),
(4, 'waqar', 'waqar@gmail.com', '01523658965', '2019-07-25', 5, 'Townhall,Dhaka', '2019-07-11', 1, 31),
(5, 'Tameem', 'tameememployee@gmail.com', '01515269632', '2019-07-20', 5, 'House#01', '2019-07-17', 1, 32),
(6, 'Imran', 'imranemployee@gmail.com', '01515236589', '2019-07-04', 6, 'House#03', '2019-07-24', 1, 33),
(7, 'Saleh Ahmed', 'saleh@gmail.com', '01526968547', '2019-07-20', 5, 'House#01,MG-MARG,Sikkim', '2019-07-24', 1, 39),
(8, 'Lui Ie Khan', 'lui@gmail.com', '0214325659', '2019-07-02', 5, 'House#06,Sikkim', '2019-07-26', 1, 47),
(9, 'Dopa Khan', 'dopa@gmail.com', '0123654789', '2019-07-12', 4, 'House#0', '2019-08-03', 1, 48),
(10, 'Hakuna Matata', 'hm@gmail.com', '01234567890', '2019-07-08', 6, 'ss', '2019-07-17', 1, 49);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `city` varchar(100) CHARACTER SET utf8 NOT NULL,
  `district` varchar(100) CHARACTER SET utf8 NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 NOT NULL,
  `aid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `city`, `district`, `location`, `aid`) VALUES
(10, 'Chittagong', 'Bandarban', 'Keokradong', 1),
(11, 'Chittagong', 'Khagrachari', 'Sajek Valley', 1),
(12, 'North Sikkim', 'Lachung', 'Yamthung', 1),
(13, 'Dhaka', 'Mirpur-1', 'National Zoo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `pkg_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cost` decimal(5,2) DEFAULT NULL,
  `tour_plan` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `location_id` int(11) NOT NULL,
  `aid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('abdurroufsheikh185@gmail.com', '$2y$10$3Xn6jVmdssvSNKHRYwAIRe5LEWz7AJyXE7eNJuWLSvTk5SnOjn7rG', '2019-06-23 22:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `pending_verfication`
--

CREATE TABLE `pending_verfication` (
  `self_id` int(11) NOT NULL,
  `reffered_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `provided_service`
--

CREATE TABLE `provided_service` (
  `prvds_id` int(11) NOT NULL,
  `cmpn_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `quantity` int(11) DEFAULT '0',
  `description` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `cost` decimal(5,2) DEFAULT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `auth_id` int(11) NOT NULL,
  `service_type` varchar(200) NOT NULL,
  `service_enable_bit` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provided_service`
--

INSERT INTO `provided_service` (`prvds_id`, `cmpn_id`, `name`, `quantity`, `description`, `cost`, `file_name`, `discount`, `location_id`, `auth_id`, `service_type`, `service_enable_bit`) VALUES
(3, 10, 'Cottage', 10, 'One balcony', '115.00', '1563172676.jpg', 5, 11, 30, 'Jeep & Guide', 1),
(4, 12, 'Open Cottage', 12, '5 resort , close to sky', '20.00', '1563173435.jpg', 25, 10, 41, 'Jeep & Guide', 1),
(6, 10, 'Peda tingting', 20, 'Fresh food,belcony', '50.00', '1568809179.jpg', 5, 11, 30, 'All', 1),
(7, 10, 'Fibolok', 3, 'It\'s close to sky', '120.00', 'defaultplace.jpg', 30, 11, 30, 'Room Rent', 1),
(8, 12, 'Machang Hut', 5, 'Cottage is built on pond.', '20.00', '1563776592.jpg', 10, 10, 41, 'Room Rent', 1),
(9, 12, 'Single Cottage', 2, 'In the middle of lake and hill', '20.00', '1563776709.jpg', 25, 10, 41, 'Room Rent', 1),
(10, 12, 'DingDong Hut', 3, 'Close to BogaLake', '20.00', '1563776768.jpg', 5, 10, 41, 'Room Rent', 1),
(12, 14, 'Jeep Service', 20, 'from anywhere inside dhaka to zoo', '20.00', '1566757411.jpg', 5, 13, 52, 'Jeep Rent', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(64) DEFAULT NULL,
  `basic_salary` decimal(7,2) DEFAULT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`pos_id`, `pos_name`, `basic_salary`, `role`) VALUES
(1, 'hotel_manager', '50000.00', 'service_provider'),
(2, 'tour_guide', '15000.00', 'service_provider'),
(3, 'driver', '25000.00', 'service_provider'),
(4, 'customer_service_officer', '35000.00', 'employee'),
(5, 'marketing_officer', '40000.00', 'employee'),
(6, 'adviser', '70000.00', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rate_id` int(11) NOT NULL,
  `prvds_id` int(11) DEFAULT NULL,
  `auth_id` int(11) DEFAULT NULL,
  `star` double DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rate_id`, `prvds_id`, `auth_id`, `star`, `comment`) VALUES
(4, 3, 29, 3, '3 Star is much'),
(5, 3, 45, 5, 'So far best place and best service I have ever seen. Best wishes for their further success.'),
(6, 4, 45, 1, 'Baje'),
(8, 7, 29, 2, 'lklklkl'),
(9, 8, 29, 4, 'Satisfactory so far.. But their is some side to be improved'),
(10, 3, 46, 1, 'It\'s Over rated so far'),
(11, 4, 46, 4, 'So far underrated'),
(12, 6, 46, 5, 'walla , this is good af'),
(13, 6, 29, 4, 'Asen asen ase jan'),
(14, 9, 29, 3, 'Muhahahahahhahahahahahahahahhahahahaha');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `srvs_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `cmpn_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `sp_id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(32) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `pos_id` int(11) NOT NULL,
  `address` varchar(300) CHARACTER SET utf8 NOT NULL,
  `aid` int(11) DEFAULT NULL,
  `auth_id` int(11) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`sp_id`, `name`, `email`, `contact_number`, `birth_date`, `pos_id`, `address`, `aid`, `auth_id`, `verified`) VALUES
(1, 'Naser Anjum', 'naser@gmail.com', '015152369875', '2019-07-10', 2, 'House#05', 1, 25, 0),
(2, 'Abdul Alim', 'alim@gmail.com', '01526369845', '2019-08-24', 1, 'House#03', 1, 30, 1),
(3, 'Nihad', 'nihadsp@gmail.com', '0123654789', '2019-07-26', 2, 'House#033', 1, 34, 1),
(4, 'sadat', 'sadatsp@gmail.com', '01515269682', '2018-06-02', 2, 'House#05', 1, 35, 0),
(5, 'Imran', 'imransp@gmail.com', '01515247485', '2019-07-30', 1, 'House#104', 1, 36, 0),
(6, 'brinto bota', 'bota@gmail.com', '01515247412', '2019-07-06', 3, 'House#01,Northsikkim', 1, 37, 0),
(7, 'Shabuj Sharker', 'ssp@gmail.com', '01758867898', '2017-07-06', 1, 'House#05,Keokradong', 1, 38, 1),
(8, 'Siam', 'siam@gmail.com', '0123654789', '2019-07-11', 1, 'House#02,Sikkim', 1, 40, 0),
(9, 'Aditya Larma', 'a@gmail.com', '0147896523', '2019-08-15', 1, 'House#05,Keokradong', 1, 41, 0),
(10, 'Sobuj sarker', 'ss@gmail.com', '01515235689', '2019-07-06', 3, 'House#01,Block#A,North Sikkim', 1, 42, 0),
(11, 'Abu Twasif', 'abu@gmail.com', '012345678945', '1982-06-17', 1, 'Home -1234', 1, 43, 0),
(12, 'Ronaldo de caprio', 'ronaldo@gmail.com', '012345678912', '2010-02-22', 2, 'Home sweet home', 1, 44, 0),
(13, 'Hakuna Matata', 'hmm@gmail.com', '0123654789', '2019-06-30', 2, 'House#02,Bandarban', 1, 50, 0),
(14, 'Nasim Ahmed', 'nasim@gmail.com', '01523665456', '2019-08-24', 1, 'Dhaka', 1, 52, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `svtp_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `enable_access` tinyint(1) DEFAULT NULL,
  `file_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `enable_access`, `file_name`) VALUES
(1, 'Admininstration', 'admin@gmail.com', NULL, '$2y$10$FUIB1Le/DX6En5q4vasvduRPEaSDC963e4V4BNMgQuoHnHRudXj0W', 'jwmNijN0GhczkHb3zuQ26tRMLgMi9GXf1CFZFc07DUhwHbcL5uiw0449layD', '2019-06-23 22:43:02', '2019-06-23 22:43:02', 'admin', 1, NULL),
(25, 'Naser Anjum', 'naser@gmail.com', NULL, '$2y$10$zKAVqYtCRGOpbDSiYUjgLeSpUFeR26aV/YbNrVy6ST0g.S2Zd0qRq', NULL, '2019-06-30 08:21:29', '2019-06-30 08:21:29', 'service_provider', 1, NULL),
(26, 'Wadud Madhuri', 'wadud@gmail.com', NULL, '$2y$10$jTkqU8k38QBFDyHVI5ujgesC/vra8UmqizpUchrZdiadE5KeKaiFm', NULL, '2019-06-30 13:12:19', '2019-06-30 13:12:19', 'employee', 1, '1563113628.jpg'),
(27, 'Mohammad Salah', 'mosalahemployee@gmail.com', NULL, '$2y$10$c2DCcaakT0y1NUEh6UDtPOilnl/YGT6axS5hyMuvcgjObonlTnoMu', NULL, '2019-06-30 15:24:41', '2019-06-30 15:24:41', 'employee', 1, NULL),
(28, 'Lionel Messi', 'messi@gmail.com', NULL, '$2y$10$k6tYuwiX4YaVyRRqgt5GR.jS4Vsb4JE2bPbV2iruFZY6CXQ87hgbq', NULL, '2019-06-30 16:07:08', '2019-06-30 16:07:08', 'employee', 1, NULL),
(29, 'Aditya', 'abc@gmail.com', NULL, '$2y$10$Wm1Ibxv0SfBkE8yksEWuXum9TudRHqaBD0QGMwMGAa8.mACdsKTCe', NULL, '2019-07-01 00:40:01', '2019-07-01 00:40:01', 'customer', 1, '1563775039.jpg'),
(30, 'Abdul Alim', 'alim@gmail.com', NULL, '$2y$10$PD0RaJjjpyW3PTWJApQGcuLO6OwyXPCFY4fk1N2duo5M87iMYFvxu', NULL, '2019-07-01 01:17:22', '2019-07-01 01:17:22', 'service_provider', 1, '1566756908.jpg'),
(31, 'waqar', 'waqar@gmail.com', NULL, '$2y$10$oEW0oTUT8Egk0w7X1f23L.skpj9TaqvFAnbOOKU0r/KP9GTBeg0kO', NULL, '2019-07-01 01:22:20', '2019-07-01 01:22:20', 'employee', 1, '1562507741.jpg'),
(32, 'Tameem', 'tameememployee@gmail.com', NULL, '$2y$10$.ji6gINExt3OrszAlSLx7.1MsEaIiy.tGWLJF1mJ96bu0TDq1JOTi', NULL, '2019-07-01 02:49:18', '2019-07-01 02:49:18', 'employee', 1, NULL),
(33, 'Imran', 'imranemployee@gmail.com', NULL, '$2y$10$XsZEnnUR/LRJM45sTE77/.v7IGEKWJlYwKeSHfQ3.tjl7Y7dcmsRK', NULL, '2019-07-01 02:52:18', '2019-07-01 02:52:18', 'employee', 1, NULL),
(34, 'Nihad', 'nihadsp@gmail.com', NULL, '$2y$10$bGomeQcxoOfgG5cWIsSMqu2a072ymN863NULux2cYuDovfYd0cXme', NULL, '2019-07-01 02:53:56', '2019-07-01 02:53:56', 'service_provider', 1, NULL),
(35, 'sadat', 'sadatsp@gmail.com', NULL, '$2y$10$VYMT6/ExEqJq4cOBhOdSb.s5BnnAfRKzPanQkP7p4SoCao6QLORnW', NULL, '2019-07-02 22:54:33', '2019-07-02 22:54:33', 'service_provider', 1, NULL),
(36, 'Imran', 'imransp@gmail.com', NULL, '$2y$10$omHlrio0nctGMt96FjbPIOfOJdr986CjWkZTSNEKYmfXhAbWjfasK', NULL, '2019-07-06 22:54:17', '2019-07-06 22:54:17', 'service_provider', 1, NULL),
(37, 'brinto bota', 'bota@gmail.com', NULL, '$2y$10$1YcvSFTobPRMu89Ro1RDY.uB.9JgAqkzZp4ELFNBNil.2wcoELGKG', NULL, '2019-07-06 23:00:50', '2019-07-06 23:00:50', 'service_provider', 1, NULL),
(38, 'Shabuj Sharker', 'ssp@gmail.com', NULL, '$2y$10$/y9kM48ZTi08tNRefqr1H.M55L0qrPDs/0nkMRqnh9JhtkNbJojOi', NULL, '2019-07-08 02:40:19', '2019-07-08 02:40:19', 'service_provider', 1, '1562575362.jpg'),
(39, 'Saleh Ahmed', 'saleh@gmail.com', NULL, '$2y$10$pthZptPy3T1b0hs77EpK2eCuNXi37AfDhzsyRupfdMt5Ox7pxNEpG', NULL, '2019-07-14 07:56:35', '2019-07-14 07:56:35', 'employee', 0, '1563112700.jpg'),
(40, 'Siam', 'siam@gmail.com', NULL, '$2y$10$fbH2.zVKdY3A92mreaDYCu47zTcxak09LVOqx6paCw/cu8Ll.q9Ta', NULL, '2019-07-14 08:09:54', '2019-07-14 08:09:54', 'service_provider', 0, '1563113425.jpg'),
(41, 'Aditya Larma', 'a@gmail.com', NULL, '$2y$10$YBqMvQKgviEu73rdtqrTxuZL4NIdCeYgAK0ImDANZx7AIMW1b0WoC', NULL, '2019-07-15 00:41:02', '2019-07-15 00:41:02', 'service_provider', 1, '1563172920.jpeg'),
(42, 'Sobuj sarker', 'ss@gmail.com', NULL, '$2y$10$yFg2gCuMSs3aBazplR5pvOtkxCev6T0qnv9ijxjXMpqI84ZNnmRgG', NULL, '2019-07-15 01:01:54', '2019-07-15 01:01:54', 'service_provider', 1, '1563174190.jpg'),
(43, 'Abu Twasif', 'abu@gmail.com', NULL, '$2y$10$Tlg4ZocH63BkrI2hWoveaOX9CdQ55QBSzyl9Pn9PqZJZOZ5yZh5Rq', NULL, '2019-07-15 02:49:26', '2019-07-15 02:49:26', 'service_provider', 0, '1563180654.jpg'),
(44, 'Ronaldo de caprio', 'ronaldo@gmail.com', NULL, '$2y$10$nQUWspcRBvFbzBtl6vclLO.4gkIINX9tZYs8nrYxG6arTu6Sk8Pbm', NULL, '2019-07-15 02:52:09', '2019-07-15 02:52:09', 'service_provider', 1, '1563180804.jpg'),
(45, 'Somudro', 'abcd@gmail.com', NULL, '$2y$10$7oueNyPhXGCh9gZvPRhhWO5gwbjcOzKAWRfiRaqmjuM5LertSxOGq', NULL, '2019-07-20 11:31:25', '2019-07-20 11:31:25', 'customer', 1, '1563775306.jpg'),
(46, 'Rouf', 'abcde@gmail.com', NULL, '$2y$10$8gaKO3ptRyk7C6jyAah2EOe1q2K14OLMZ2tWY6QSrpPBBG/aPoEZy', NULL, '2019-07-22 01:00:15', '2019-07-22 01:00:15', 'customer', 1, '1567415620.jpg'),
(47, 'Lui Ie Khan', 'lui@gmail.com', NULL, '$2y$10$2.q3mMT4CJk/1eiDLvcZKO7gAOgbxz.Qaav6jMfpBP1uZoFsiFU1S', NULL, '2019-07-29 03:05:27', '2019-07-29 03:05:27', 'employee', 0, '1564391177.jpg'),
(48, 'Dopa Khan', 'dopa@gmail.com', NULL, '$2y$10$IS/TrKWYSJuOGfQHOXEcheDaQznYn5jei3y9zy4dbK6uQNmh6bqk2', NULL, '2019-07-29 03:06:49', '2019-07-29 03:06:49', 'employee', 0, '1564391281.jpg'),
(49, 'Hakuna Matata', 'hm@gmail.com', NULL, '$2y$10$ATLxepoR3rrbOJumtW8JeeeQmbZoj4BlSH8qlBOEjlA1o/95jvNcW', NULL, '2019-07-29 03:10:00', '2019-07-29 03:10:00', 'employee', 0, '1564391493.jpg'),
(50, 'Hakuna Matata', 'hmm@gmail.com', NULL, '$2y$10$4SR1DEDlEkps7/Tu3kAXUeXjid48wMcWBmvDhiz.kB8ClTKOdNRiu', NULL, '2019-07-29 03:12:07', '2019-07-29 03:12:07', 'service_provider', 0, '1564391815.png'),
(51, 'Abu Yousuf Siam', 'ysiam@gmail.com', NULL, '$2y$10$VsHtKFfcnZ0uQ.fdEW/VvOJHAN2lsAAxGMyNZk1mGEVRYYAEPkee6', NULL, '2019-08-17 08:28:26', '2019-08-17 08:28:26', 'customer', 1, '1566052180.jpg'),
(52, 'Nasim Ahmed', 'nasim@gmail.com', NULL, '$2y$10$4xL1Q2l9QxcO0xyf37N.EuCZ3OYmtJ0aWlJxJSTGZbu609daaDBb6', NULL, '2019-08-25 12:20:09', '2019-08-25 12:20:09', 'service_provider', 1, '1566757266.jpg'),
(53, 'Rouf', 'rouf@gmail.com', NULL, '$2y$10$XsHACEHXOExOrpnbdwx0M.4LdMGa8oJ.05Wt2FB7kPj19LDrjYnYO', NULL, '2019-09-02 03:01:07', '2019-09-02 03:01:07', 'customer', 1, '1567415157.jpg'),
(54, 'AbdurRouf', 'arouf@gmail.com', NULL, '$2y$10$aaFkAJk5MNNh60yrFO.HquqyBcq.2hFaxH0tEM976ZnQ5VkG1AS/q', NULL, '2019-09-02 03:11:30', '2019-09-02 03:11:30', 'customer', 1, NULL),
(55, 'Swarna Khan', 'swarna@gmail.com', NULL, '$2y$10$DebDJLfj65PbeAI87es9F.AVW7hcdl73GkA4aVaOWnOROj/yOC.Uq', NULL, '2019-09-18 06:13:09', '2019-09-18 06:13:09', 'customer', 1, '1568808929.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attatchment`
--
ALTER TABLE `attatchment`
  ADD PRIMARY KEY (`aid`,`attatchment_number`);

--
-- Indexes for table `attatchments`
--
ALTER TABLE `attatchments`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`cmpn_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `pos_id` (`pos_id`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`pkg_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `provided_service`
--
ALTER TABLE `provided_service`
  ADD PRIMARY KEY (`prvds_id`,`cmpn_id`),
  ADD KEY `cmpn_id` (`cmpn_id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`srvs_id`,`sp_id`,`cmpn_id`),
  ADD KEY `sp_id` (`sp_id`),
  ADD KEY `cmpn_id` (`cmpn_id`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`sp_id`),
  ADD KEY `pos_id` (`pos_id`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`svtp_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attatchments`
--
ALTER TABLE `attatchments`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `cmpn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `pkg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provided_service`
--
ALTER TABLE `provided_service`
  MODIFY `prvds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `srvs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `svtp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attatchment`
--
ALTER TABLE `attatchment`
  ADD CONSTRAINT `attatchment_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `attatchments` (`aid`);

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `company_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `attatchments` (`aid`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`pos_id`) REFERENCES `ranks` (`pos_id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `attatchments` (`aid`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `attatchments` (`aid`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`),
  ADD CONSTRAINT `packages_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `attatchments` (`aid`);

--
-- Constraints for table `provided_service`
--
ALTER TABLE `provided_service`
  ADD CONSTRAINT `provided_service_ibfk_1` FOREIGN KEY (`cmpn_id`) REFERENCES `company` (`cmpn_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`sp_id`) REFERENCES `service_providers` (`sp_id`),
  ADD CONSTRAINT `services_ibfk_2` FOREIGN KEY (`cmpn_id`) REFERENCES `company` (`cmpn_id`);

--
-- Constraints for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD CONSTRAINT `service_providers_ibfk_1` FOREIGN KEY (`pos_id`) REFERENCES `ranks` (`pos_id`),
  ADD CONSTRAINT `service_providers_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `attatchments` (`aid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
