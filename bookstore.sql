-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 05:41 PM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_isbn` varchar(20) NOT NULL,
  `book_title` varchar(60) DEFAULT NULL,
  `book_author` varchar(60) DEFAULT NULL,
  `book_image` varchar(40) DEFAULT NULL,
  `book_descr` longtext DEFAULT NULL,
  `book_price` decimal(6,2) NOT NULL,
  `publisherid` int(10) UNSIGNED NOT NULL,
  `categoryid` int(10) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_isbn`, `book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `publisherid`, `categoryid`, `stock`) VALUES
('222220000', 'Hello World', 'The Finnish Man', '1740550524_67beb17ccea01.png', 'Saving the children is the best to please god', 50.00, 29, 23, 200),
('3243243243242342', 'HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHQQQQ', 'a', '1740239768_67b9f398d68f4.png', 'SDFDSF', 10.00, 28, 21, 0),
('34324324', 'Binayak', 'binayak', 'becoming.jpg', 'This is the book written by binayak', 50.00, 15, 15, 0),
('6999', 'The water', 'Yellow', '1740140649_67b870695f7fd.jpg', 'lkjljl', 45.00, 15, 12, 0),
('7890', 'The world of dragon', 'Binayak Ronaldo', '1740239665_67b9f33182223.png', 'Where the dragons are the world of creatures', 45.00, 27, 22, 0),
('978-0-321-94786-4', 'THE FAST 800 RECIPE BOOK: AUSTRALIAN AND NEW ZEALAND EDITION', 'Dr Clare Bailey', 'the 800 fast recipe book.jpg', 'The companion to the No.1 bestseller The Fast 800. 150 delicious new recipes to help you.\n', 23.99, 8, 1, 0),
('978-0-7303-1484-4', 'THE FAST DIET RECIPE BOOK (THE OFFICIAL 5:2 DIET)', 'Mimi Spencer, Sarah Schenker', 'the fast diet recipe book.jpg', 'Following the #1 bestselling The Fast Diet, this fabulous cookbook offers 150 carefully crafted, nutritious, low-calorie recipes to enable you to incorporate the 5:2 weight-loss system into your daily life.\n', 24.99, 8, 1, 9),
('978-1-118-94924-5', 'The Good Thieves', 'Katherine Rundell', 'the good theives.jpg', 'An amazing adventure story, told with sparkling style and sleight of hand JACQUELINE WILSON\n\n', 11.99, 7, 2, 0),
('978-1-1180-2669-4', 'Five feet apart', 'Rachael Lippincott, Mikki Daughtry, Tobias Iaconis', 'five feet apart.jpg', 'In this moving story thats perfect for fans of John Greens The Fault in Our Stars, two teens fall in love with just one minor complication-they cant get within a few feet of each other without risking their lives. ', 16.99, 7, 4, 0),
('978-1-44937-019-0', 'Kingdom of Ash', 'Sarah J. Maas', 'kingdom if ash.jpg', 'Aelin Galathynius s journey from slave to assassin to queen reaches its heart-rending finale as war erupts across her world -\n', 19.99, 2, 6, 5),
('978-1-4571-0402-2', 'Atlas of Mountains and ghosts', 'Lonely Planet', 'monsters and ghosts.jpg', 'If you believe that all you need to fight an evil bloodthirsty fiend is garlic or holy water, think again. What you need is to keep a cool head and reach for your copy of Atlas of Monsters and Ghosts!\n\n', 26.99, 11, 2, 0),
('978-1-484217-26-9', 'Good Night Stories for Rebel Girls 2', 'Elena Favilli & Francesca Cavallo, Elena Favilli', 'goodnight stories for rebel girls.jpg', '100 new bedtime stories, each inspired by the life and adventures of extraordinary women from Nefertiti to Beyonce. ', 49.99, 7, 2, 0),
('9780575081406', 'The Name of the Wind', 'Patrick Rothfuss', 'the name of the wind.jpg', 'The Name of the Wind is fantasy at its very best, and an astounding must-read title.\n\n', 19.99, 7, 1, 24),
('9781409178811', 'Broken Throne', 'Victoria Aveyard', 'broken throne.jpg', 'The stunning sequel to Sarah J. Maas New York Times bestselling A Court of Thorns and Roses and a No.1 New York Times bestseller.', 17.99, 10, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customerid`, `date`) VALUES
(23, 7, '2019-07-05 15:21:55'),
(24, 7, '2019-07-05 15:22:25'),
(25, 7, '2019-07-05 15:22:55'),
(26, 6, '2019-07-05 16:32:04'),
(27, 8, '2024-11-27 22:25:20'),
(28, 8, '2024-12-03 23:11:02'),
(29, 8, '2024-12-04 00:25:05'),
(30, 8, '2025-02-19 12:37:38'),
(31, 8, '2025-02-19 12:38:47'),
(32, 8, '2025-02-20 04:16:46'),
(33, 8, '2025-02-20 04:17:42'),
(34, 8, '2025-02-20 04:18:02'),
(35, 8, '2025-02-20 04:43:46'),
(36, 16, '2025-02-20 05:04:51'),
(37, 16, '2025-02-20 05:05:27'),
(38, 16, '2025-02-20 05:06:17'),
(39, 8, '2025-02-20 13:53:40'),
(40, 26, '2025-02-21 10:19:03'),
(41, 26, '2025-02-21 10:25:20'),
(42, 26, '2025-02-21 21:16:08'),
(43, 26, '2025-02-21 21:39:39'),
(44, 26, '2025-02-21 21:57:17'),
(45, 26, '2025-02-21 21:58:39'),
(46, 26, '2025-02-21 22:00:19'),
(47, 26, '2025-02-22 00:00:40'),
(48, 26, '2025-02-22 00:16:14'),
(49, 26, '2025-02-22 00:16:30'),
(50, 26, '2025-02-22 01:14:35'),
(51, 26, '2025-02-22 01:36:16'),
(52, 26, '2025-02-23 02:29:50'),
(53, 26, '2025-02-23 02:58:41'),
(54, 26, '2025-02-23 02:59:18'),
(55, 26, '2025-02-23 03:32:27'),
(56, 26, '2025-02-23 03:33:34'),
(57, 26, '2025-02-23 03:37:49'),
(58, 26, '2025-02-23 03:37:56'),
(59, 26, '2025-02-23 03:38:43'),
(60, 26, '2025-02-23 03:39:53'),
(61, 26, '2025-02-23 03:40:53'),
(62, 26, '2025-02-23 03:41:03'),
(63, 26, '2025-02-23 03:41:26'),
(64, 26, '2025-02-23 03:42:01'),
(65, 0, '2025-02-23 03:42:11'),
(66, 26, '2025-02-23 03:43:13'),
(67, 26, '2025-02-23 03:44:31'),
(68, 26, '2025-02-23 03:44:59'),
(69, 26, '2025-02-23 03:45:13'),
(70, 26, '2025-02-23 03:45:23'),
(71, 26, '2025-02-23 03:45:32'),
(72, 0, '2025-02-23 04:19:21'),
(73, 0, '2025-02-23 04:20:03'),
(74, 0, '2025-02-23 04:20:09'),
(75, 26, '2025-02-23 04:20:22'),
(76, 26, '2025-02-23 04:20:51'),
(77, 0, '2025-02-23 04:21:03'),
(78, 26, '2025-02-23 04:21:31'),
(79, 26, '2025-02-23 04:21:52'),
(80, 26, '2025-02-23 04:22:01'),
(81, 26, '2025-02-23 04:22:12'),
(82, 26, '2025-02-23 04:22:25'),
(83, 26, '2025-02-23 04:23:19'),
(84, 26, '2025-02-23 04:23:33'),
(85, 26, '2025-02-23 04:23:37'),
(86, 26, '2025-02-23 04:23:46'),
(87, 26, '2025-02-23 04:23:59'),
(88, 26, '2025-02-23 04:26:00'),
(89, 26, '2025-02-23 04:26:09'),
(90, 26, '2025-02-23 04:29:29'),
(91, 26, '2025-02-23 04:29:43'),
(92, 26, '2025-02-23 04:30:29'),
(93, 26, '2025-02-23 04:32:31'),
(94, 26, '2025-02-23 04:34:05'),
(95, 26, '2025-02-23 04:38:55'),
(96, 26, '2025-02-23 04:40:55'),
(97, 26, '2025-02-23 04:41:14'),
(98, 26, '2025-02-23 04:41:35'),
(99, 26, '2025-02-23 04:41:51'),
(100, 26, '2025-02-23 04:43:42'),
(101, 26, '2025-02-23 04:44:33'),
(102, 26, '2025-02-23 04:57:46'),
(103, 26, '2025-02-23 05:02:34'),
(104, 26, '2025-02-23 05:08:16'),
(105, 26, '2025-02-24 02:59:48'),
(106, 26, '2025-02-24 03:02:38'),
(107, 26, '2025-02-24 03:03:21'),
(108, 26, '2025-02-24 03:15:47'),
(109, 26, '2025-02-24 03:27:04'),
(110, 26, '2025-02-24 03:27:11'),
(111, 26, '2025-02-24 03:27:11'),
(112, 26, '2025-02-24 03:27:11'),
(113, 26, '2025-02-24 03:27:11'),
(114, 26, '2025-02-24 03:27:11'),
(115, 26, '2025-02-24 03:27:11'),
(116, 26, '2025-02-24 03:27:18'),
(117, 26, '2025-02-24 04:29:17'),
(118, 26, '2025-02-24 04:29:56'),
(119, 26, '2025-02-24 04:30:02'),
(120, 26, '2025-02-24 04:30:36'),
(121, 26, '2025-02-24 04:31:15'),
(122, 26, '2025-02-24 04:32:17'),
(123, 26, '2025-02-24 04:33:09'),
(124, 31, '2025-02-24 04:42:30'),
(125, 31, '2025-02-24 04:43:18'),
(126, 31, '2025-02-24 04:43:43'),
(127, 31, '2025-02-24 04:44:07'),
(128, 31, '2025-02-24 04:45:19'),
(129, 31, '2025-02-24 04:46:03'),
(130, 31, '2025-02-24 04:46:04'),
(131, 31, '2025-02-24 04:48:45'),
(132, 31, '2025-02-24 04:49:11'),
(133, 31, '2025-02-24 04:49:41'),
(134, 31, '2025-02-24 04:53:26'),
(135, 31, '2025-02-24 04:53:28'),
(136, 31, '2025-02-24 04:53:31'),
(137, 31, '2025-02-24 04:53:59'),
(138, 0, '2025-02-24 10:22:10'),
(139, 0, '2025-02-24 10:22:24'),
(140, 31, '2025-02-24 10:28:31'),
(141, 31, '2025-02-24 10:28:39'),
(142, 31, '2025-02-24 10:28:45'),
(143, 31, '2025-02-24 10:33:17'),
(144, 31, '2025-02-24 10:34:18'),
(145, 26, '2025-02-24 10:35:29'),
(146, 26, '2025-02-24 10:35:36'),
(147, 26, '2025-02-24 10:40:09'),
(148, 26, '2025-02-24 10:41:50'),
(149, 26, '2025-02-25 00:54:29'),
(150, 26, '2025-02-25 05:49:19'),
(151, 32, '2025-02-25 10:48:47'),
(152, 26, '2025-02-25 12:03:22'),
(153, 26, '2025-02-25 23:55:10'),
(154, 26, '2025-02-26 00:04:31'),
(155, 26, '2025-02-26 00:05:10'),
(156, 26, '2025-02-26 00:17:40'),
(157, 26, '2025-02-26 00:20:28'),
(158, 26, '2025-02-26 00:21:10'),
(159, 26, '2025-02-26 00:43:40'),
(160, 26, '2025-02-26 00:44:24'),
(161, 26, '2025-02-26 01:16:43'),
(162, 26, '2025-02-26 01:26:27'),
(163, 26, '2025-02-26 01:27:42'),
(164, 26, '2025-02-26 01:39:46'),
(165, 26, '2025-02-26 05:44:00'),
(166, 26, '2025-03-08 13:10:32'),
(167, 26, '2025-03-08 23:41:31'),
(168, 26, '2025-03-08 23:43:49'),
(169, 33, '2025-03-09 00:12:24'),
(170, 26, '2025-03-09 00:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `id` int(10) NOT NULL,
  `cartid` int(10) UNSIGNED NOT NULL,
  `productid` varchar(20) NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`id`, `cartid`, `productid`, `quantity`) VALUES
(24, 23, '978-0-321-94786-4', 1),
(25, 23, '9781409178811', 1),
(26, 23, '978-1-484217-26-9', 5),
(27, 26, '978-1-44937-019-0', 10),
(28, 27, '978-0-7303-1484-4', 1),
(29, 27, '978-0-321-94786-4', 1),
(30, 27, '10-101-01', 2),
(31, 27, '978-1-484216-40-8', 1),
(32, 27, '978-1-484216-40-8', 1),
(33, 27, '2152121966651', 1),
(34, 27, '9781409178811', 4),
(35, 27, '978-1-4571-0402-2', 1),
(36, 27, '978-0-321-94786-4', 1),
(37, 27, '978-0-321-94786-4', 1),
(38, 27, '9781409178811', 1),
(39, 36, '978-1-484217-26-9', 5),
(40, 36, '978-0-7303-1484-4', 1),
(41, 36, '978-0-7303-1484-4', 5),
(42, 36, '978-1-118-94924-5', 2),
(43, 27, '978-0-321-94786-4', 1),
(44, 40, '978-1-44937-019-0', 1),
(45, 40, '978-1-484217-26-9', 2),
(46, 40, '978-1-484217-26-9', 2),
(47, 40, '978-1-484216-40-8', 1),
(48, 40, '34', 1),
(49, 40, '978-1-44937-019-0', 1),
(50, 40, '34', 1),
(51, 40, '978-1-484217-26-9', 1),
(52, 40, '34324324', 1),
(53, 40, '34', 4),
(54, 40, '9780575081406', 1),
(55, 40, '978-1-118-94924-5', 1),
(56, 40, '1234dddd', 1),
(57, 40, '978-1-484217-26-9', 1),
(58, 40, '9781409178811', 1),
(59, 40, '978-0-7303-1484-4', 1),
(60, 40, '9780575081406', 100),
(61, 40, '1234dddd', 200),
(62, 40, '1234567', 1),
(63, 40, '7890', 1),
(64, 40, '7890', 7),
(65, 40, '7890', 10),
(66, 40, '1234567', 255),
(67, 40, '7890', 8),
(68, 40, '7890', 4),
(69, 40, '7890', 3),
(70, 40, '7890', 1),
(71, 40, '7890', 5),
(72, 40, '7890', 4),
(73, 40, '7890', 2),
(74, 40, '7890', 6),
(75, 40, '7890', 1),
(76, 40, '7890', 1),
(77, 40, '7890', 1),
(78, 40, '1234567', 10),
(79, 40, '7890', 3),
(80, 40, '7890', 3),
(81, 40, '978-0-7303-1484-4', 1),
(82, 40, '7890', 3),
(83, 40, '978-0-7303-1484-4', 1),
(84, 40, '7890', 3),
(85, 40, '978-0-7303-1484-4', 1),
(86, 40, '7890', 3),
(87, 40, '978-0-7303-1484-4', 1),
(88, 40, '7890', 3),
(89, 40, '978-0-7303-1484-4', 1),
(90, 40, '7890', 3),
(91, 40, '978-0-7303-1484-4', 1),
(92, 40, '7890', 3),
(93, 40, '978-0-7303-1484-4', 1),
(94, 40, '7890', 3),
(95, 40, '978-0-7303-1484-4', 1),
(96, 40, '7890', 3),
(97, 40, '978-0-7303-1484-4', 1),
(98, 40, '7890', 3),
(99, 40, '978-0-7303-1484-4', 1),
(100, 40, '7890', 3),
(101, 40, '978-0-7303-1484-4', 1),
(102, 40, '7890', 3),
(103, 40, '978-0-7303-1484-4', 1),
(104, 40, '7890', 3),
(105, 40, '978-0-7303-1484-4', 1),
(106, 40, '7890', 3),
(107, 40, '978-0-7303-1484-4', 1),
(108, 40, '7890', 3),
(109, 40, '978-0-7303-1484-4', 1),
(110, 40, '1234567', 9),
(111, 40, '7890', 3),
(112, 40, '978-0-7303-1484-4', 1),
(113, 40, '1234567', 9),
(114, 40, '7890', 3),
(115, 40, '978-0-7303-1484-4', 1),
(116, 40, '1234567', 9),
(117, 40, '7890', 3),
(118, 40, '978-0-7303-1484-4', 1),
(119, 40, '1234567', 9),
(120, 124, '7890', 5),
(121, 124, '7890', 5),
(122, 124, '7890', 5),
(123, 124, '7890', 5),
(124, 124, '7890', 5),
(125, 124, '7890', 5),
(126, 124, '7890', 5),
(127, 124, '7890', 5),
(128, 124, '7890', 5),
(129, 124, '7890', 6),
(130, 124, '7890', 6),
(131, 124, '7890', 6),
(132, 124, '7890', 6),
(133, 124, '7890', 6),
(134, 124, '7890', 7),
(135, 124, '7890', 1),
(136, 124, '7890', 1),
(137, 40, '7890', 1),
(138, 40, '7890', 1),
(139, 40, '1234567', 1),
(140, 40, '7890', 5),
(141, 40, '978-0-7303-1484-4', 60),
(142, 151, '7890', 50),
(143, 40, '978-0-7303-1484-4', 50),
(144, 40, '978-0-7303-1484-4', 50),
(145, 40, '7890', 50),
(146, 40, '7890', 1),
(147, 40, '3243243243242342', 50),
(148, 40, '3243243243242342', 2),
(149, 40, '3243243243242342', 2),
(150, 40, '1234567', 100),
(151, 40, '1234567', 168),
(152, 40, '1234567', 255),
(153, 40, '978-0-7303-1484-4', 10),
(154, 40, '9780575081406', 10),
(155, 40, '1234567', 10),
(156, 40, '9781409178811', 10),
(157, 40, '978-1-44937-019-0', 30),
(158, 40, '9781409178811', 10),
(159, 40, '9780575081406', 10),
(160, 40, '9780575081406', 6),
(161, 40, '978-1-44937-019-0', 5),
(162, 40, '978-1-44937-019-0', 1),
(163, 169, '978-0-7303-1484-4', 20),
(164, 40, '978-0-7303-1484-4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(10) NOT NULL,
  `category_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `category_name`) VALUES
(1, 'Fiction'),
(2, 'Children'),
(3, 'Education'),
(4, 'Health And Diet'),
(5, 'Arts And Entertainments'),
(6, 'Cooking,Food And Drink'),
(7, 'Nepali'),
(9, 'Non-Fiction'),
(12, 'Computer science'),
(14, 'Hello'),
(15, 'Sports'),
(16, 'd'),
(17, 'a'),
(20, 'Food'),
(21, 'Spo'),
(22, 'Adventure'),
(23, 'Social');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zipcode` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `password`, `address`, `city`, `zipcode`) VALUES
(8, 'bin', 'rl', 'abc@gmail.com', '123456', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(9, 'abcd', 'upa', 'abcd@gmail.com', 'abcd', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(10, 'bidhan', 'uphadayaya', 'bidhan@gmail.com', '123456', 'nepal', 'ktm', '134354'),
(11, 'bin', 'rl', 'abcsdsd@gmail.com', '$2y$10$nWFl7oe8KbWxMaseUqYzYOhmwxA2PztOo', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(12, 'bin', 'rl', 'absdsadasdc@gmail.com', '$2y$10$712OL5DrVpi5x9GqcIrVveI.9FTwiAl3J', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(13, 'bin', 'rl', 'abce@gmail.com', '$2y$10$tyaVHY8i4IxBvcweMgTEzOYWNnai7zjxQ', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(14, 'bin', 'rl', 'aabc@gmail.com', '$2y$10$MEyJjRNi2kRxH0z3.S//D.N5Q91r351CH', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(15, 'bin', 'rl', 'ac@gmail.com', '$2y$10$doPsvCxRJpslPhF.LUrnpukackzwN5gHt', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(16, 'Hector', 'Acosta', 'xyz@gmail.com', 'Hello@1234', 'Los Angeles, CA', 'Los A NGELES', '90026'),
(17, 'bin', 'rl', 'c@gmail.com', 'sdfsdfsdfsdf', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(18, 'bin', 'rl', 'v@gmail.com', 'jdsfdsfsdfds', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(19, 'bin', 'rl', 'z@gmail.com', 'fbbvbnbvvbbvcvvc', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(20, 'a', 'm', 'a@m.e', '12345678', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(21, 'bin', 'rl', 'asdasc@gmail.com', 'k', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(22, 'bin', 'rl', 'abdsfsdfc@gmail.com', 'd', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(23, 'bin', 'rl', 'abcddddd@gmail.com', 'a', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(24, 'bidhan', 'uphadayaya', 'bidhannn@gmail.com', 'Hello@1234', 'nepal', 'ktm', '13435'),
(25, 'Hector', 'Acosta', 'm@c.co', 'Hello@1234', 'Los Angeles, CA', 'Los A NGELES', '90026'),
(26, 'bin', 'rl', 'binayak1239@gmail.com', '26b5c3f86027614d7c3bbec4238a97f8', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(27, 'bin', 'rl', 'ASDASD@gmail.com', 'd02dfc849f7c25d5ef994fe9517b5d3c', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(28, 'bin', 'rl', 'hellloooooo@gmail.com', '26b5c3f86027614d7c3bbec4238a97f8', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(29, 'Achs', 'College', 'achscollege@gmail.com', '0ed5d98439da450164a9a88c259869c2', 'Ekantakuna', 'Lalitpur', '44600'),
(30, 'jiwan', 'khadka', 'jiwan@gmail.com', '26b5c3f86027614d7c3bbec4238a97f8', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(31, 'Binayak', 'Chhetri', 'binayakac@gmail.com', '9c241d3f2ae9b3ab2531a8efb8cf609a', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(32, 'abcde', 'rl', 'abcde@gmail.com', '26b5c3f86027614d7c3bbec4238a97f8', 'Kirtipur, Kathmandu', 'HELL0O', '44600'),
(33, 'Hello', 'Hi', 'hello@gmail.com', '26b5c3f86027614d7c3bbec4238a97f8', 'Kirtipur, Kathmandu', 'HELL0O', '44600');

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`name`, `pass`) VALUES
('expert', 'expert');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`name`, `pass`) VALUES
('manager', 'manager'),
('binayak', 'binayak'),
('binayak@gmail.com', 'f08b95aee39cd54c228383c006c33405');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `book_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`book_info`)),
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `total_price` decimal(10,2) NOT NULL,
  `order_status` enum('placed','confirmed','processing','shipping','delivered','Cancelled','pending') NOT NULL DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `book_info`, `quantity`, `total_price`, `order_status`, `order_date`) VALUES
(38, 26, '{\"9780575081406\":\"10\"}', 10, 219.90, 'delivered', '2025-02-26 10:29:00'),
(39, 26, '{\"9780575081406\":\"6\"}', 6, 139.94, 'delivered', '2025-03-08 17:55:32'),
(40, 26, '{\"978-1-44937-019-0\":\"5\"}', 5, 119.95, 'delivered', '2025-03-09 04:26:31'),
(41, 26, '{\"978-1-44937-019-0\":1}', 1, 39.99, 'Cancelled', '2025-03-09 04:28:49'),
(42, 33, '{\"978-0-7303-1484-4\":\"20\"}', 20, 519.80, 'delivered', '2025-03-09 04:57:24'),
(43, 26, '{\"978-0-7303-1484-4\":\"1\"}', 1, 44.99, 'delivered', '2025-03-09 05:03:30');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisherid` int(10) UNSIGNED NOT NULL,
  `publisher_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisherid`, `publisher_name`) VALUES
(2, 'Wiley'),
(7, 'OReilly Media'),
(10, 'Bloomsbury Publishing PLC'),
(11, 'Wrox'),
(14, 'uthrf'),
(17, 'Ronaldo'),
(21, 'Hungry productions'),
(24, 'The jungle'),
(25, 'David beckham'),
(27, 'The thunder'),
(28, 'HEAVAN'),
(29, 'The mini publication');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_isbn`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisherid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisherid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
