-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2021 at 05:54 AM
-- Server version: 10.2.38-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devindiit_sharethebrick_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `phone`, `status`, `created_at`) VALUES
(1, 'Admin', 'admin@sharethebrick.com', '$2y$10$FvLqWhR3esmadKjbt0Rg5OG4UKRZE1THRNpU.qAKG1dRtGwMFlPPy', '07507947076', 1, '2020-05-06 07:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Internet', 1, '2020-08-21 04:09:53'),
(2, 'Handicap Accessible', 1, '2020-08-21 04:09:53'),
(3, 'Electricity', 1, '2020-08-21 04:09:53'),
(4, 'Air Conditioning', 1, '2020-08-21 04:09:53'),
(5, 'Heating', 1, '2020-08-21 04:09:53'),
(6, 'Toilets', 1, '2020-08-21 04:09:53'),
(7, 'Kitchen', 1, '2020-08-21 04:09:53'),
(8, 'Security System', 1, '2020-08-21 04:09:53'),
(9, 'Stock Room', 1, '2020-08-21 04:09:53'),
(10, 'Counters', 1, '2020-08-21 04:09:53'),
(11, 'Fitting Rooms', 1, '2020-08-21 04:09:53'),
(12, 'Garment Rack', 1, '2020-08-21 04:09:53'),
(13, 'lighting', 1, '2020-08-21 04:09:53'),
(14, 'Furniture', 1, '2020-08-21 04:09:53'),
(15, 'Street Level', 1, '2020-08-21 04:09:53'),
(16, 'Window Display', 1, '2020-08-21 04:09:53'),
(17, 'Office Equipment', 1, '2020-08-21 04:09:53'),
(18, 'Sound & Video Equipment', 1, '2020-08-21 04:09:53'),
(19, 'Signage', 1, '2020-08-21 04:09:53'),
(20, 'Parking', 1, '2020-08-21 04:09:53'),
(21, 'Vishalss', 2, '2021-01-07 09:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `booking_requests`
--

CREATE TABLE `booking_requests` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `request_from` int(11) NOT NULL DEFAULT 0,
  `request_to` int(11) NOT NULL DEFAULT 0,
  `listing_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1 for accept,2 for reject'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_requests`
--

INSERT INTO `booking_requests` (`id`, `subject`, `request_from`, `request_to`, `listing_id`, `created_at`, `status`) VALUES
(1, NULL, 2, 1, 17, '2020-09-17 06:29:01', 2),
(3, NULL, 2, 1, 1, '2020-09-17 15:44:51', 1),
(4, NULL, 2, 1, 21, '2020-09-18 02:08:00', 0),
(5, NULL, 2, 1, 33, '2020-10-06 03:54:04', 1),
(6, NULL, 1, 2, 23, '2020-09-18 02:08:00', 0),
(7, NULL, 1, 2, 24, '2020-10-06 03:54:04', 0),
(8, 'Inquiry about listing #21', 21, 1, 21, '2021-05-20 18:19:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `calender_events`
--

CREATE TABLE `calender_events` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `invited_to` longtext DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `datetime` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calender_events`
--

INSERT INTO `calender_events` (`id`, `created_by`, `invited_to`, `title`, `datetime`, `created_at`) VALUES
(2, 1, '21,6', 'test meeting tommorrow', '2021-05-22T21:00:00', '2021-05-21 17:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Art', 1, '2020-08-12 05:27:27'),
(2, 'Beauty', 1, '2020-08-12 05:27:27'),
(3, 'Fashion', 1, '2020-08-12 05:27:27'),
(4, 'Home and Living', 1, '2020-08-12 05:27:27'),
(5, 'Jewelry', 1, '2020-08-12 05:27:27'),
(6, 'Accessories', 1, '2020-08-12 05:27:27'),
(7, 'Food and Drink', 1, '2020-08-12 05:27:27'),
(8, 'Footwear', 1, '2020-08-12 05:27:27'),
(9, 'Education', 1, '2020-08-12 05:27:27'),
(10, 'Games and Toys', 1, '2020-08-12 05:27:27'),
(13, 'sssssfff', 2, '2020-12-23 10:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `sent_to` int(11) NOT NULL DEFAULT 0,
  `sent_by` int(11) NOT NULL DEFAULT 0,
  `listing_id` int(11) NOT NULL DEFAULT 0,
  `attachment` varchar(255) DEFAULT NULL,
  `sent_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `read` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `message`, `sent_to`, `sent_by`, `listing_id`, `attachment`, `sent_on`, `read`) VALUES
(1, 'hello', 2, 1, 17, NULL, '2020-09-24 07:18:51', 1),
(2, 'working', 2, 1, 17, NULL, '2020-09-24 21:22:16', 1),
(3, 'lets have fun', 2, 1, 17, NULL, '2020-09-24 21:30:15', 1),
(4, 'Okay sure', 2, 1, 17, NULL, '2020-09-24 21:34:36', 1),
(5, 'then', 2, 1, 17, NULL, '2020-09-24 21:34:45', 1),
(6, 'whats about to do man', 2, 1, 17, NULL, '2020-09-24 21:34:53', 1),
(7, 'Okay chat working fine', 1, 2, 17, NULL, '2020-09-24 21:53:43', 1),
(8, 'that\'s It', 2, 1, 17, NULL, '2020-09-24 21:54:09', 1),
(9, 'Love your coding', 1, 2, 17, NULL, '2020-09-24 21:54:22', 1),
(10, 'Thank you', 2, 1, 17, NULL, '2020-09-24 21:54:40', 1),
(11, 'Thank you', 2, 1, 17, NULL, '2020-09-24 21:54:56', 1),
(12, 'Welcone', 1, 2, 17, NULL, '2020-09-24 21:55:14', 1),
(13, 'Hello', 1, 2, 21, NULL, '2020-09-24 21:56:08', 1),
(14, 'Hey Bo', 2, 1, 21, NULL, '2020-09-24 21:57:27', 1),
(15, 'Thank you', 1, 2, 21, NULL, '2020-09-24 21:57:36', 1),
(16, 'Fine now', 2, 1, 21, NULL, '2020-09-24 21:57:48', 1),
(17, 'hi', 2, 1, 1, NULL, '2021-04-16 10:29:49', 1),
(18, 'hey', 2, 1, 23, NULL, '2021-04-16 10:50:13', 1),
(19, 'testing new desc', 1, 21, 21, NULL, '2021-05-20 18:19:37', 1),
(20, 'testing here', 21, 1, 21, NULL, '2021-05-20 19:54:52', 1),
(21, 'helllo', 21, 1, 21, NULL, '2021-05-20 20:03:23', 1),
(22, 'hiiiiiiiiii', 1, 21, 21, NULL, '2021-05-20 20:12:15', 1),
(23, 'testing', 1, 21, 21, NULL, '2021-05-21 09:15:34', 1),
(24, 'west', 1, 21, 21, NULL, '2021-05-21 09:16:09', 1),
(25, 'test only', 21, 1, 21, NULL, '2021-05-21 09:26:07', 1),
(26, 'hiii there', 21, 1, 21, NULL, '2021-05-21 09:52:56', 1),
(27, 'gelllo', 1, 21, 21, NULL, '2021-05-21 10:00:49', 1),
(28, 'hiii second message', 1, 21, 21, NULL, '2021-05-21 10:03:20', 1),
(29, 'hellllo i read it', 21, 1, 21, NULL, '2021-05-21 10:13:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `name`, `value`, `created_at`) VALUES
(1, 'privacy', '<section class=\"blog-details-area ptb-60\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"col-lg-12 col-md-12\">\r\n                        <div class=\"blog-details-desc\">\r\n                           <div class=\"article-content\">\r\n                                <h3 class=\"double-brdr\">Privacy Policy Heading One</h3>\r\n\r\n                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>\r\n\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>\r\n\r\n                               \r\n\r\n                               <h3 class=\"double-brdr\">Privacy Policy Heading Two</h3>\r\n\r\n                                <ul class=\"features-list\">\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt.</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet.</li>\r\n                                </ul>\r\n\r\n                                 <h3 class=\"double-brdr\">Privacy Policy Heading Three</h3>\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n                                <h3 class=\"double-brdr\">Privacy Policy Heading Four</h3>\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>\r\n                            </div>\r\n\r\n                           \r\n\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>', '2020-10-20 05:20:23'),
(2, 'privacy_page_title', 'Privacy Policy', '2020-10-20 05:22:43'),
(3, 'terms_page_title', 'Terms & Conditions', '2020-10-20 06:10:50'),
(4, 'terms', '<section class=\"blog-details-area ptb-60\">\r\n            <div class=\"container\">\r\n                <div class=\"row\">\r\n                    <div class=\"col-lg-12 col-md-12\">\r\n                        <div class=\"blog-details-desc\">\r\n                           <div class=\"article-content\">\r\n                                <h3 class=\"double-brdr\">Terms &amp; Conditions Heading One</h3>\r\n\r\n                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>\r\n\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>\r\n\r\n                               \r\n\r\n                               <h3 class=\"double-brdr\">Terms &amp; Conditions Heading Two</h3>\r\n\r\n                                <ul class=\"features-list\">\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt.</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet.</li>\r\n                                </ul>\r\n\r\n                                 <h3 class=\"double-brdr\">Terms &amp; Conditions Heading Three</h3>\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n                                <h3 class=\"double-brdr\">Terms &amp; Conditions Heading Four</h3>\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>\r\n                            </div>\r\n\r\n                           \r\n\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </section>', '2020-10-20 06:10:50'),
(5, 'about_page_title', 'About Us', '2020-10-20 08:27:57'),
(6, 'about_left_side', '<div class=\"about-content\">\r\n                            <span class=\"sub-title\">About Us</span>\r\n                            <h2>Sed ut perspiciatis unde</h2>\r\n                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris </p>\r\n\r\n                            <div class=\"features-text\">\r\n                                <p><i class=\"bx bx-arrow-to-right\"></i> Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>\r\n                                <p><i class=\"bx bx-arrow-to-right\"></i> Accusantium doloremque laudantium, totam rem aperiam</p>\r\n                                <p><i class=\"bx bx-arrow-to-right\"></i> Eaque ipsa quae ab illo inventore veritatis et</p>\r\n                                <p><i class=\"bx bx-arrow-to-right\"></i> quasi architecto beatae vitae dicta sunt explicabo</p>\r\n                            </div>\r\n                        </div>', '2020-10-20 08:27:57'),
(7, 'about_right_first_img', '9.jpg', '2020-10-20 08:48:05'),
(8, 'about_right_second_img', '10.png', '2020-10-20 08:48:05'),
(9, 'about_second_section', '<div class=\"about-inner-area\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-lg-4 col-md-6 col-sm-6\">\r\n                            <div class=\"about-text\">\r\n                                <h3>Sed ut perspiciatis</h3>\r\n                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>\r\n                                \r\n                                <ul class=\"features-list\">\r\n                                    <li><i class=\"bx bx-check\"></i> Lorem ipsum dolor sit amet</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Consectetur adipiscing elit</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Sed do eiusmod tempor</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Incididunt ut labore et dolore</li>\r\n                                </ul>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <div class=\"col-lg-4 col-md-6 col-sm-6\">\r\n                            <div class=\"about-text\">\r\n                                <h3>Unde omnis iste</h3>\r\n                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>\r\n                                \r\n                                <ul class=\"features-list\">\r\n                                    <li><i class=\"bx bx-check\"></i> Lorem ipsum dolor sit amet</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Consectetur adipiscing elit</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Sed do eiusmod tempor</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Incididunt ut labore et dolore</li>\r\n                                </ul>\r\n                            </div>\r\n                        </div>\r\n\r\n                        <div class=\"col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3\">\r\n                            <div class=\"about-text\">\r\n                                <h3>Natus error sit</h3>\r\n                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>\r\n                                \r\n                                <ul class=\"features-list\">\r\n                                    <li><i class=\"bx bx-check\"></i> Lorem ipsum dolor sit amet</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Consectetur adipiscing elit</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Sed do eiusmod tempor</li>\r\n                                    <li><i class=\"bx bx-check\"></i> Incididunt ut labore et dolore</li>\r\n                                </ul>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>', '2020-10-20 09:30:18'),
(10, 'home_page_title', 'Retail Edition', '2020-10-21 06:14:47'),
(11, 'home_page_user_signup_section', '<h2>Promote your Brand.&nbsp; Find opportunities.</h2>\r\n                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>', '2020-10-21 06:14:47'),
(12, 'home_page_landlord_signup_section', '<h2>Add Your Commercial Listings with Share The Brick</h2>\r\n                    <p>Consider leasing out your property in a shared arrangement and see the benefits.&nbsp; Lower lease costs increase your business tenants\' chances of success, especially in the earlier years.&nbsp; Reduced lease costs will also reduce your vacancy time by making it more affordable for businesses.</p>', '2020-10-21 06:15:29'),
(13, 'home_page_contact_title', '<h4 class=\"title\">Get In Touch</h4>\r\n                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>', '2020-10-21 06:15:29'),
(14, 'cccsxcscscszxcs', 'dsadggaa', '2020-10-21 06:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `collaboration_type`
--

CREATE TABLE `collaboration_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collaboration_type`
--

INSERT INTO `collaboration_type` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Open to All', 1, '2020-08-12 05:22:59'),
(2, 'Full Space', 1, '2020-08-12 05:22:59'),
(3, 'PopUp Store', 1, '2020-08-12 05:23:47'),
(4, 'Shared Space', 1, '2020-08-12 05:23:47'),
(5, 'Consignment', 1, '2020-08-12 05:24:06'),
(6, 'Collaboration', 1, '2020-08-12 05:24:06');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `plateform` int(11) DEFAULT 0 COMMENT '1 for retail, 2 for office, 3 for residential',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `message`, `user_id`, `plateform`, `created_at`) VALUES
(39, 'Vishal', 'demouser085@gmail.com', '66643546457', 'dddd', 1, 0, '2020-10-05 12:27:37'),
(40, 'Vishal', 'demouser085@gmail.com', '66643546457', 'dddd', 1, 0, '2020-10-05 12:29:15'),
(41, 'Vishal', 'kmac200@me.com', '98678765', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 2, 0, '2020-10-16 05:58:30'),
(42, 'Vishal', 'vishalindiit@gmail.com', '66643546457', 'sasdsadasd', 0, 0, '2020-10-26 06:08:03'),
(43, 'Vishal', 'demouser085@gmail.com', '66643546457', 'xxxx', 0, 0, '2020-10-26 06:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text DEFAULT NULL,
  `queue` text DEFAULT NULL,
  `payload` longtext DEFAULT NULL,
  `exception` longtext DEFAULT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` longtext NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `cat_id`, `status`, `created_at`) VALUES
(1, 'I forgot my password, how can I retrieve it?', 'Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 1, 1, '2020-10-22 05:38:57'),
(2, 'I forgot my email, how can I retrieve it?', 'Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 1, 1, '2020-10-22 07:03:03'),
(3, 'How can I contact you?', 'Call us between 8:30am-8pm EST,\r\n Mon - Fri at 123-356-1303', 3, 1, '2020-10-22 08:24:49'),
(4, 'How can we find best space for rent ?', 'Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 2, 1, '2020-10-22 08:28:38'),
(5, 'Can I search by property address ?', 'Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 2, 1, '2020-10-22 08:28:54'),
(6, 'Can I search by keywords?', 'Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 2, 1, '2020-10-22 08:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Logging In', 1, '2020-10-21 10:17:58'),
(2, 'Search Space For Rent', 1, '2020-10-21 10:17:58'),
(3, 'Need Additional Help?', 1, '2020-10-22 04:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `ideal_uses`
--

CREATE TABLE `ideal_uses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ideal_uses`
--

INSERT INTO `ideal_uses` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Retail', 1, '2020-08-21 03:59:53'),
(2, 'Showroom', 1, '2020-08-21 03:59:53'),
(3, 'Event', 1, '2020-08-21 03:59:53'),
(4, 'Art', 1, '2020-08-21 03:59:53'),
(5, 'Food and Drink', 1, '2020-08-21 03:59:53'),
(6, 'aaaaaa', 2, '2020-12-23 10:22:39'),
(7, 'dddd', 2, '2020-12-23 10:30:58'),
(8, 'ddd', 2, '2021-01-06 08:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `retail_category` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `collaboration_type` text DEFAULT NULL,
  `location_city` varchar(255) DEFAULT NULL,
  `price_from` float NOT NULL DEFAULT 0,
  `price_to` float NOT NULL DEFAULT 0,
  `file_upload_viewer` int(11) NOT NULL COMMENT '0 for public, 1 for private',
  `fblink` varchar(200) DEFAULT NULL,
  `twitterlink` varchar(200) DEFAULT NULL,
  `instalink` varchar(200) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1= brand, 2= brick, 3 for full space, 4 for partial space, 5 for popup landlord, 6 for event fairs markets, 7 for services',
  `lat` varchar(200) DEFAULT NULL,
  `lng` varchar(200) DEFAULT NULL,
  `brand` int(11) NOT NULL DEFAULT 0,
  `space_type` int(11) DEFAULT NULL,
  `looking_for` int(11) NOT NULL DEFAULT 0 COMMENT '1= Share Space, 2=Share Resources, 3=Collaborate, 4=Any',
  `thumbnail` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `invited_members` varchar(255) DEFAULT NULL,
  `floors` int(11) NOT NULL DEFAULT 0,
  `floor_no` varchar(255) DEFAULT NULL,
  `partial_spacetype` varchar(200) DEFAULT NULL,
  `size` float DEFAULT NULL,
  `size_unit` varchar(200) DEFAULT NULL,
  `price_unit` varchar(200) DEFAULT NULL,
  `lease_term` int(11) NOT NULL DEFAULT 0,
  `lease_term_unit` varchar(200) DEFAULT NULL,
  `lease_type` varchar(200) DEFAULT NULL,
  `include_with_lease` text DEFAULT NULL,
  `max_renters` int(11) NOT NULL DEFAULT 0,
  `ideal_uses` text DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `amenities_other_option` varchar(200) DEFAULT NULL,
  `email_listing_owner` varchar(255) DEFAULT NULL,
  `availability_date` date DEFAULT NULL,
  `current_use` int(11) NOT NULL DEFAULT 0 COMMENT '-1= all, -2=Not in use',
  `start_date_time` timestamp NULL DEFAULT NULL,
  `end_date_time` timestamp NULL DEFAULT NULL,
  `additional_fee` text DEFAULT NULL,
  `daily_rate` float NOT NULL DEFAULT 0,
  `monthly_rate` float NOT NULL DEFAULT 0,
  `weekly_rate` float NOT NULL DEFAULT 0,
  `renters_access` varchar(255) DEFAULT NULL,
  `min_rental` int(11) NOT NULL DEFAULT 0,
  `min_rental_unit` varchar(255) DEFAULT NULL,
  `max_rental` int(11) NOT NULL DEFAULT 0,
  `max_rental_unit` varchar(255) DEFAULT NULL,
  `no_of_openings` int(11) NOT NULL DEFAULT 0,
  `open_to_collaborations` int(11) NOT NULL DEFAULT 1,
  `brick_owner` varchar(255) DEFAULT NULL,
  `associated_listing` int(11) DEFAULT NULL,
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `street` varchar(255) DEFAULT NULL,
  `street_no` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 for active, 2 for deleted',
  `link_title` text DEFAULT NULL,
  `link_desc` longtext DEFAULT NULL,
  `link_image` text DEFAULT NULL,
  `link_url` longtext DEFAULT NULL,
  `landlord_email` varchar(255) DEFAULT NULL,
  `is_primary` int(11) NOT NULL DEFAULT 0,
  `plateform` int(11) NOT NULL DEFAULT 0 COMMENT '1 for retail, 2 for office, 3 for residential',
  `title` varchar(255) DEFAULT NULL,
  `selected_edition` int(11) NOT NULL DEFAULT 0,
  `business_category` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `name`, `user_id`, `retail_category`, `description`, `collaboration_type`, `location_city`, `price_from`, `price_to`, `file_upload_viewer`, `fblink`, `twitterlink`, `instalink`, `type`, `lat`, `lng`, `brand`, `space_type`, `looking_for`, `thumbnail`, `link`, `invited_members`, `floors`, `floor_no`, `partial_spacetype`, `size`, `size_unit`, `price_unit`, `lease_term`, `lease_term_unit`, `lease_type`, `include_with_lease`, `max_renters`, `ideal_uses`, `amenities`, `amenities_other_option`, `email_listing_owner`, `availability_date`, `current_use`, `start_date_time`, `end_date_time`, `additional_fee`, `daily_rate`, `monthly_rate`, `weekly_rate`, `renters_access`, `min_rental`, `min_rental_unit`, `max_rental`, `max_rental_unit`, `no_of_openings`, `open_to_collaborations`, `brick_owner`, `associated_listing`, `is_featured`, `street`, `street_no`, `city`, `state`, `country`, `zip`, `created_at`, `updated_at`, `status`, `link_title`, `link_desc`, `link_image`, `link_url`, `landlord_email`, `is_primary`, `plateform`, `title`, `selected_edition`, `business_category`, `website`) VALUES
(1, 'test brand', 1, '4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '2,3,4', 'California City, CA, USA', 100, 500, 0, 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 1, '35.125801', '-117.9859038', 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-25 04:28:37', '2021-02-11 06:01:18', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(17, 'Gauge series Brick', 1, '6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s', '2,6', 'Jakarta, Indonesia', 150, 220, 0, NULL, NULL, NULL, 2, '-6.2087634', '106.845599', 1, 5, 2, '1598952401download.png', 'https://www.youtube.com/watch?v=6veP5V0yfps&feature=youtu.be', '3,2', 0, NULL, NULL, NULL, NULL, NULL, 5, 'Months', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 8, 1, NULL, 24, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-06 10:38:58', '2021-02-11 06:01:20', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(18, 'New test brand', 1, '2', 'it is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text', '4,6', 'Jesolo, Metropolitan City of Venice, Italy', 80, 200, 0, 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 1, '45.5334198', '12.6438498', 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-07 05:32:25', '2021-02-11 06:01:38', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(21, 'Test Full Space Listing', 1, '0', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.', NULL, 'Una, Himachal Pradesh, India', 900, 0, 0, NULL, NULL, NULL, 3, '31.4684649', '76.2708152', 0, 10, 0, NULL, NULL, NULL, 3, '2', NULL, 36, 'sq feet', '/year', 2, NULL, 'Individual Leases', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.', 3, '1,3', '1,2,5,9,10,13,17,19,20', 'test', 'demo@example.coms', '2020-08-28', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 03:56:58', '2021-04-12 09:15:21', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(22, 'new testing', 1, '6', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using', '0', 'Jacksonville, FL, USA', 190, 370, 0, 'https://facebook.com', 'https://www.twitter.com', 'https://www.instagram.com', 1, '30.3321838', '-81.65565099999999', 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-23 11:19:39', '2021-02-11 06:02:07', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(23, 'Partial space', 1, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley.', NULL, 'Jacksonville, FL, USA', 206, 0, 0, NULL, NULL, NULL, 4, '30.3321838', '-81.65565099999999', 0, 0, 0, NULL, NULL, NULL, 2, '2', 'Rent', 8, '/Sq M', '/month', 3, '/month', 'Sublease', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, NULL, '2,13,20', 'dsadsdsf', 'test@gm.com', '2020-09-26', 3, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-07 11:45:59', '2021-02-11 06:02:11', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(24, 'Test partial Space Listing', 1, NULL, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', NULL, 'Kenosha, WI, USA', 400, 0, 0, NULL, NULL, NULL, 4, '42.5847425', '-87.82118539999999', 17, 0, 0, NULL, NULL, NULL, 3, '2', 'Consignment', 10, '/Sq F', '/year', 3, '/year', 'Individual Leases', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 0, NULL, '1,8,10,11,15,18,20', 'test', 'listing@gmail.com', '2020-09-26', 1, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-07 11:50:36', '2021-02-11 06:02:13', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(25, 'Test popup Space Listing', 1, NULL, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', NULL, 'Indian Museum, Jawaharlal Nehru Road, Colootola, New Market Area, Dharmatala, Taltala, Kolkata, West Bengal, India', 0, 0, 0, NULL, NULL, NULL, 5, '22.55788579999999', '88.3511268', 0, 9, 0, NULL, NULL, NULL, 2, '2', NULL, 32, 'sq meters', NULL, 0, NULL, NULL, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 0, '2,4', '2,18', 'test', 'demo@listing.com', NULL, 0, NULL, NULL, NULL, 20, 40, 30, 'Partial', 2, 'Weeks', 3, 'Weeks', 0, 1, NULL, 0, 1, '27', 'Jawaharlal Nehru Road', 'Kolkata', 'West Bengal', 'India', '700016', '2020-09-23 11:19:39', '2021-02-11 06:02:48', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(33, 'test event', 1, '1,2,13', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text', NULL, 'Ulm, Germany', 48, 0, 0, NULL, NULL, NULL, 6, '48.4010822', '9.9876076', 17, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, 600, 'sq feet', 'Weekly', 0, NULL, NULL, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text', 0, NULL, '2,13', 'test', 'demo@list.com', NULL, 0, '2020-09-24 22:30:00', '2020-10-02 16:30:00', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text', 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 10:23:01', '2021-02-11 06:02:51', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(34, 'Vishal', 1, '6', 'sadsadsad', '2,3', 'Fresno, CA, USA', 50, 500, 0, NULL, NULL, NULL, 1, '36.7377981', '-119.7871247', 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-07 05:33:49', '2021-02-11 06:02:54', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(35, 'test full', 1, NULL, 'axsdsadsadsadsad', NULL, 'Facebook, Hacker Way, Menlo Park, CA, USA', 40, 0, 0, NULL, NULL, NULL, 3, '37.48507299999999', '-122.1482824', 0, 6, 0, NULL, NULL, NULL, 2, '1', NULL, 2, 'sq meters', '/month', 3, NULL, 'Sublease', 'AZsadad', 2, '2', '8,14,18', 'test', 'demo@example.com', '2020-09-30', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 1, '1', 'Hacker Way', 'Menlo Park', 'California', 'United States', '94025', '2020-09-30 04:56:54', '2020-12-14 05:38:29', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(36, 'Vishal brand', 1, '2', 'zdsadasdsad', '2,3', 'Facebook, Hacker Way, Menlo Park, CA, USA', 90, 470, 0, NULL, NULL, NULL, 1, '37.48507299999999', '-122.1482824', 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, '1', 'Hacker Way', 'Menlo Park', 'California', 'United States', '94025', '2020-09-30 06:54:11', '2021-02-11 06:03:40', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(37, 'test popup', 1, NULL, 'sasasas', NULL, '123 Wonder Land Drive, Hopewell Junction, New York, USA', 0, 0, 1, NULL, NULL, NULL, 5, '41.50860929999999', '-73.7888059', 17, 10, 0, NULL, NULL, NULL, 2, '1', NULL, 2, 'sq feet', NULL, 0, NULL, NULL, 'asas', 0, '1,2', '7,13,18,19,20', NULL, 'demo@example.com', NULL, 0, NULL, NULL, NULL, 2, 80, 5, 'Partial', 2, 'Weeks', 2, 'Weeks', 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 10:36:16', '2020-10-14 08:59:02', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(38, 'test event rest', 1, '1,2', 'axsadxsads', NULL, 'Facebook, Hacker Way, Menlo Park, CA, USA', 32, 0, 0, NULL, NULL, NULL, 6, '37.48507299999999', '-122.1482824', 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, 40, 'sq feet', 'Onetime', 0, NULL, NULL, 'xsxsx', 0, NULL, '17', NULL, 'demo@example.com', NULL, 0, '2020-10-13 21:30:00', '2020-10-13 21:30:00', 'azxsx', 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, '1', 'Hacker Way', 'Menlo Park', 'California', 'United States', '94025', '2020-10-05 10:22:30', '2020-12-14 04:29:20', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(39, 'tttttt', 1, '6', 'sdsddf', '1,2,3,4,5,6', 'Fresno, CA, USA', 0, 0, 0, NULL, NULL, NULL, 2, '36.7377981', '-119.7871247', 22, 5, 1, '1601981322downloa.jpeg', 'test.com', NULL, 0, NULL, NULL, NULL, NULL, NULL, 3, 'Months', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 8, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-06 11:45:50', '2020-10-19 09:30:49', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(40, 'Gauge series', 1, '13', 'adsad', '2', 'Grand Canyon National Park, Arizona, USA', 0, 0, 0, NULL, NULL, NULL, 2, '36.10692580000001', '-112.1129484', 22, 5, 1, '1601985051downloa.jpeg', 'test.com', NULL, 0, NULL, NULL, NULL, NULL, NULL, 3, 'Years', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 8, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-06 11:51:50', '2020-10-19 09:30:43', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(41, 'Test Full Space Listing', 1, '1', 'zsxscsc', '1,4,5,6', 'Rajasthan India Holidays, Tilak Nagar, Jaipur, Rajasthan, India', 0, 0, 0, NULL, NULL, NULL, 2, '26.8928753', '75.82436539999999', 1, 6, 1, '1602653393downloa.jpeg', 'https://www.youtube.com/watch?v=6veP5V0yfps&feature=youtu.be', NULL, 0, NULL, NULL, NULL, NULL, NULL, 3, 'Years', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 8, 1, NULL, 33, 1, '3', 'testt', 'Rajasthan', 'Rajasthan', 'India', '302004', '2020-10-14 05:29:53', '2021-05-21 10:13:36', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(42, 'Gauge series Brick s', 1, '1', 'saxs', '2', 'Denver, CO, USA', 0, 0, 0, NULL, NULL, NULL, 2, '39.7392358', '-104.990251', 1, 5, 2, '1604377287main-banner4.jpg', 'http://test.com', NULL, 0, NULL, NULL, NULL, NULL, NULL, 3, 'Months', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 8, 1, NULL, 23, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 05:42:34', '2020-11-03 09:29:47', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(43, 'Vishal kkk', 1, '1', 'dsadsa', '2', 'Düsseldorf, Germany', 50, 500, 0, NULL, NULL, NULL, 1, '51.2277411', '6.7734556', 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-14 06:01:02', '2021-02-11 06:03:44', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(46, 'Test Full Space Listing', 1, '3', 'dasdsad', '2', 'Houston, TX, USA', 0, 0, 0, NULL, NULL, NULL, 2, '29.7604267', '-95.3698028', 22, 2, 2, '1604396087screenshot-localhost-2020.10.08-15_19_18.png', 'https://test.com', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 'Months', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 8, 1, NULL, 25, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-11-03 09:34:47', '2020-11-06 06:50:51', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(47, 'Test Full Space Listing', 1, '1', 'sas', '3', 'Facebook, Hacker Way, Menlo Park, CA, USA', 0, 0, 0, NULL, NULL, NULL, 2, '37.48507299999999', '-122.1482824', 18, 5, 1, '1604647434561-708.jpeg', 'https://play.google.com/store/apps/details?id=com.graymatrix.did&hl=en_IN&gl=US', NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 'Months', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 8, 1, NULL, 51, 0, '1', 'Hacker Way', 'Menlo Park', 'California', 'United States', '94025', '2020-11-06 07:23:54', '2021-01-20 09:39:14', 1, 'ZEE5: HiPi, News, Movies, TV Shows, Web Series - Apps on Google Play', 'A platform with over 4500+ Movies, creating fun video content on HiPi, thrilling Original Web Series, Latest News, the excitement of watching TV Serials before TV, Zindagi Originals, exclusive Alt-ZEE5 Web Series and much more; that too, in your language! Create Video content on HiPi, enjoy binge-watching ZEE5 Original Web Series, World Digital Premieres, News, Music Videos & 90+ LIVE TV channels. Also, award-winning stories and super hit Bollywood movies and biopics. What you will enjoy on ZEE5? - HiPi: A unique video platform to express yourself, your way, in a fun and cool environment. - ZEE5 Club: An exclusive privilege of watching content suited to you and catching your favourite TV Serials, in an ad-free experience. - Video content dubbed in 7 languages - 11 display languages & 12 content languages - Offline download - LIVE TV guide for channel programming - Music videos across languages - Latest &...', 'https://play-lh.googleusercontent.com/7dM4filq4Ys2C2v6gV9_QuWCGQ1A2OJL8v5DhNJTNXB7cartSRfAAJjxIf4QHfMeHw', 'https://play.google.com/store/apps/details?id=com.graymatrix.did', NULL, 1, 0, NULL, 0, NULL, NULL),
(48, 'ssss', 1, NULL, 'asas', NULL, 'Surat, Gujarat, India', 0, 0, 0, NULL, NULL, NULL, 3, '21.1702401', '72.83106070000001', 0, 10, 0, NULL, NULL, NULL, 0, NULL, NULL, 2, 'sq feet', '/month', 3, NULL, 'Sublease', NULL, 2, '2,3', '7,18', NULL, 'test@gm.com', '2020-12-25', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-09 05:34:16', '2020-12-09 09:43:37', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(49, 'dsdsd', 1, NULL, 'dsad', NULL, 'DC USA, 14th Street Northwest, Washington D.C., DC, USA', 0, 0, 0, NULL, NULL, NULL, 4, '38.929829', '-77.0328849', 0, NULL, 0, NULL, NULL, NULL, 0, NULL, 'Open To Both', 3, '/Sq F', '/month', 2, '/month', 'Sublease', NULL, 0, NULL, '', NULL, 'demo@example.com', '2020-08-27', 1, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, '3100', '14th Street Northwest', 'Washington', 'District of Columbia', 'United States', '20010s', '2020-12-09 09:32:45', '2020-12-14 05:43:49', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(50, 'testtt', 1, NULL, 'sdsad', NULL, 'Jakarta, Indonesia', 0, 0, 0, NULL, NULL, NULL, 5, '-6.2087634', '106.845599', 0, 10, 0, NULL, NULL, NULL, 0, NULL, NULL, 33, 'sq feet', NULL, 0, NULL, NULL, NULL, 0, '2', '', NULL, 'test@gm.com', NULL, 0, NULL, NULL, NULL, 0, 0, 34, 'Partial', 0, 'Days', 0, 'Days', 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-10 05:40:33', '2020-12-10 06:10:12', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(51, 'restt', 1, '', 'sdsad', NULL, 'Jakarta, Indonesia', 233, 0, 0, NULL, NULL, NULL, 6, '-6.2087634', '106.845599', 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 33, 'sq feet', 'Onetime', 0, NULL, NULL, NULL, 0, NULL, '', NULL, 'test@gm.com', NULL, 0, '2020-12-18 09:09:00', '2020-12-31 09:09:00', NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-12-10 09:09:31', '2020-12-10 09:17:58', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(52, 'Test Full Space Listing 2', 1, '0', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.', NULL, 'Ldh', 100, 0, 0, NULL, NULL, NULL, 3, '30.9010', '75.8573', 0, 8, 0, NULL, NULL, NULL, 2, '1', NULL, 32, 'sq feet', '/year', 2, NULL, 'Individual Leases', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.', 3, '1,3', '1,2,5,9,10,13,17,19,20', 'test', 'demo@example.coms', '2020-08-28', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 03:56:58', '2021-04-12 09:15:10', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(53, 'Test Full Space Listing 3', 1, '0', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.', NULL, 'Mohali', 150, 0, 0, NULL, NULL, NULL, 3, '30.7046', '76.7179', 0, 10, 0, NULL, NULL, NULL, 1, '1', NULL, 40, 'sq feet', '/year', 2, NULL, 'Individual Leases', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.', 3, '1,3', '1,2,5,9,10,13,17,19,20', 'test', 'demo@example.coms', '2020-08-28', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 03:56:58', '2021-04-12 09:15:27', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(54, 'Test popup Space Listing 2', 1, NULL, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', NULL, 'Indian Museum, Jawaharlal Nehru Road, Colootola, New Market Area, Dharmatala, Taltala, Kolkata, West Bengal, India', 0, 0, 0, NULL, NULL, NULL, 5, '22.55788579999999', '88.3511268', 0, 9, 0, NULL, NULL, NULL, 1, '1', NULL, 300, 'sq meters', NULL, 0, NULL, NULL, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 0, '2,4', '2,18', 'test', 'demo@listing.com', NULL, 0, NULL, NULL, NULL, 20, 40, 30, 'Partial', 2, 'Weeks', 3, 'Weeks', 0, 1, NULL, 0, 1, '27', 'Jawaharlal Nehru Road', 'Kolkata', 'West Bengal', 'India', '700016', '2020-09-23 11:19:39', '2021-04-15 05:31:41', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(55, 'test event 2', 1, '1,2,13', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text', NULL, 'Ulm, Germany', 48, 0, 0, NULL, NULL, NULL, 6, '48.4010822', '9.9876076', 17, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, 100, 'sq feet', 'Weekly', 0, NULL, NULL, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text', 0, NULL, '2,13', 'test', 'demo@list.com', NULL, 0, '2020-09-24 22:30:00', '2020-10-02 16:30:00', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text', 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 10:23:01', '2021-02-11 06:02:51', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(56, 'Brand of today', 1, '6', 'A lot of products', '0', 'Mohali, Punjab, India', 50, 500, 0, 'https://www.facebook.com/', 'https://www.twitter.com', 'https://www.instagram.com', 1, '30.7046486', '76.71787259999999', 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, NULL, NULL, 0, '195', 'Phase 8', 'Ludhiana', 'Punjab', 'India', '160071', '2021-04-15 07:15:59', '2021-04-15 07:15:59', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(57, 'testing plateform', 1, '10', 'Testing the platform by adding retail\'s brand', '0', 'Ludhiana', 50, 500, 0, 'https://www.facebook.com/', 'https://www.twitter.com', 'https://www.instagram.com', 1, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, NULL, NULL, 0, '#544/123', 'Ludhiana', 'Ludhiana', 'Punjab', 'India', '141008', '2021-04-15 08:40:48', '2021-04-15 08:40:48', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(58, 'test brand platform', 1, '1', 'The test brand', '0', 'Mohali', 50, 500, 0, 'https://www.facebook.com/', 'https://www.twitter.com', 'https://www.instagram.com', 1, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 0, NULL, NULL, 0, 'Phase 8', 'block 2', 'Mohali', 'Punjab', 'India', '160071', '2021-04-15 08:49:26', '2021-04-15 08:49:26', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(59, 'The brand', 1, '6', 'testing', '6', 'LUDHIANA', 50, 500, 0, 'https://www.facebook.com/', 'https://www.twitter.com', 'https://www.instagram.com', 1, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, '#544/123', 'New Shiv Puri', 'LUDHIANA', 'Punjab', 'India', '141008', '2021-04-15 09:01:55', '2021-04-15 09:01:55', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL),
(60, 'Brand edit', 1, '3', 'the retail brand edited', '6', 'LUDHIANA', 50, 500, 0, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, '#544/123', 'New Shiv Puri', 'Ludhiana', 'Punjab', 'India', '141008', '2021-04-15 09:03:50', '2021-04-15 09:32:50', 2, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(80, 'Test brick edited inside retail', 1, '7', 'the test', '3', 'Mohali, Punjab, India', 0, 0, 0, NULL, NULL, NULL, 2, '30.7046486', '76.71787259999999', 22, 4, 3, '', 'https://woodpecker.co/integrations/', NULL, 0, NULL, NULL, NULL, NULL, NULL, 2, 'Months', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 2, 1, NULL, NULL, 0, 'Phase 8', 'block 2', 'Mohali', 'Punjab', 'India', '160071', '2021-04-16 05:37:02', '2021-04-16 06:09:13', 1, 'Integrations - Woodpecker.co - Integrate Woodpecker with other apps', 'See the list of available Woodpecker.co integrations. Check how to integrate Woodpecker with your CRM, marketing services, sales automation tools and more.', 'https://woodpecker.co/wp-content/uploads/2020/10/cropped-favicon-simple-180x180.png', 'https://woodpecker.co/integrations/', 'shubham.kareer95@gmail.com', 0, 1, NULL, 0, NULL, NULL),
(81, 'brick 2', 1, '3', 'the test store', '3', 'Mohali', 0, 0, 0, NULL, NULL, NULL, 2, NULL, NULL, 18, 2, 2, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 2, 'Months', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 2, 1, NULL, 21, 0, 'Phase 8', 'block 2', 'Mohali', 'Punjab', 'India', '160071', '2021-04-16 06:24:15', '2021-04-16 06:24:16', 1, NULL, NULL, NULL, NULL, 'shubham.kareer95@gmail.com', 0, 1, NULL, 0, NULL, NULL),
(82, 'brick 2', 1, '3', 'the test store', '3', 'Mohali', 0, 0, 0, NULL, NULL, NULL, 2, NULL, NULL, 18, 2, 2, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 2, 'Months', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 2, 1, NULL, 21, 0, 'Phase 8', 'block 2', 'Mohali', 'Punjab', 'India', '160071', '2021-04-16 06:26:43', '2021-04-16 06:27:41', 1, '', 'Invalid response status code (0)', '', '', 'shubham.kareer95@gmail.com', 0, 1, NULL, 0, NULL, NULL),
(83, 'Full space test landlord edit', 1, NULL, 'full space test landlord', NULL, 'Mohali, Punjab, India', 300, 0, 0, NULL, NULL, NULL, 3, '30.7046486', '76.71787259999999', 0, 6, 0, NULL, NULL, NULL, 2, '1', NULL, 100, 'sq feet', '/month', 1, NULL, 'Sublease', NULL, 3, '1', '1,3,6,8,11,13,16,18', NULL, 'shubham.kareer95@gmail.com', '2021-04-17', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, 'block 2', 'XXV', 'Mohali', 'Punjab', 'India', '160071', '2021-04-16 08:25:17', '2021-04-16 08:40:29', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(84, 'Full space test landlord  2', 1, NULL, 'check the place', NULL, 'Mohali, Punjab, India', 233, 0, 0, NULL, NULL, NULL, 3, NULL, NULL, 0, 1, 0, NULL, NULL, NULL, 3, '1', NULL, 100, 'sq feet', '/month', 1, NULL, 'Sublease', NULL, 4, '1', '3,6,7,14', NULL, 'shubham.kareer95@gmail.com', '2021-04-19', 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, 'block 2', 'XXV', 'Mohali', 'Punjab', 'India', '160071', '2021-04-16 08:38:28', '2021-04-16 08:38:28', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(85, 'Partial space test 1 edited', 1, NULL, '##', NULL, 'Mohali, Punjab, India', 100, 0, 0, NULL, NULL, NULL, 4, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, 2, '2', 'Rent', 111, '/Sq F', '/month', 2, '/month', 'Individual Leases', NULL, 0, NULL, '1,5,6,7,12,14,18', NULL, 'shubham.kareer95@gmail.com', '2021-04-21', 9, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, 'block 2', 'XXV', 'Mohali', 'Punjab', 'India', '160071', '2021-04-16 08:48:24', '2021-04-16 08:50:24', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(86, 'popup test 1 edited', 1, NULL, '##', NULL, 'Mohali, Punjab, India', 0, 0, 0, NULL, NULL, NULL, 5, NULL, NULL, 0, 6, 0, NULL, NULL, NULL, 3, '1', NULL, 1212, 'sq feet', NULL, 0, NULL, NULL, NULL, 0, '2', '2,3,8,12,13', NULL, 'shubham.kareer95@gmail.com', NULL, 0, NULL, NULL, NULL, 10, 150, 40, 'Partial', 15, 'Days', 1, 'Months', 0, 1, NULL, NULL, 0, 'block 2', 'XXV', 'Mohali', 'Punjab', 'India', '160071', '2021-04-16 08:58:31', '2021-04-16 09:00:33', 1, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(87, 'delete popup land', 1, NULL, '@', NULL, 'Mohali, Punjab, India', 0, 0, 0, NULL, NULL, NULL, 5, NULL, NULL, 0, 12, 0, NULL, NULL, NULL, 2, '1', NULL, 100, 'sq feet', NULL, 0, NULL, NULL, NULL, 0, '1', '', NULL, 'shubham.kareer95@gmail.com', NULL, 0, NULL, NULL, NULL, 10, 150, 40, 'Partial', 21, 'Days', 21, 'Days', 0, 1, NULL, NULL, 0, 'block 2', 'XXV', 'Mohali', 'Punjab', 'India', '160071', '2021-04-16 09:01:42', '2021-04-16 09:01:53', 2, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, NULL, NULL),
(88, 'fsdfd', 21, NULL, 'fdsfdsf', NULL, 'Frankfurt, Germany', 0, 0, 0, NULL, NULL, NULL, 7, '50.1109221', '8.6821267', 0, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 0, 1, NULL, NULL, 0, 'fdsfdsf', 'fdsfdsf', 'Frankfurt', 'Hessen', 'Germany', 'fdsf', '2021-05-20 18:58:33', '2021-05-20 13:31:41', 2, NULL, NULL, NULL, NULL, NULL, 0, 1, 'fdsfdsf', 1, 'Business Services', 'http://kynhh.com');

-- --------------------------------------------------------

--
-- Table structure for table `listing_files`
--

CREATE TABLE `listing_files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1 for image, 2 for file',
  `extension` varchar(100) DEFAULT NULL,
  `listing_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing_files`
--

INSERT INTO `listing_files` (`id`, `name`, `type`, `extension`, `listing_id`, `created_at`) VALUES
(189, '1599543736images-3-256x256.jpg', 1, 'jpg', 29, '2020-09-08 00:12:22'),
(190, '1599543739sample.pdf', 2, 'pdf', 29, '2020-09-08 00:12:22'),
(287, '1599123654images-3-256x256.jpg', 1, 'jpg', 18, '2020-09-10 01:34:29'),
(288, '1597637886sample.pdf', 2, 'pdf', 18, '2020-09-10 01:34:30'),
(360, '1599125578download.png', 1, 'png', 22, '2020-09-16 07:33:30'),
(361, '1599125583sample.pdf', 2, 'pdf', 22, '2020-09-16 07:33:30'),
(444, '1601981311downloa.jpeg', 1, 'jpeg', 39, '2020-10-12 05:48:06'),
(445, '1601981316sample.pdf', 2, 'pdf', 39, '2020-10-12 05:48:06'),
(460, '1601985039shoes-shop-display-rack-500x500.jpg', 1, 'jpg', 40, '2020-10-14 05:43:15'),
(461, '1601985043sample.pdf', 2, 'pdf', 40, '2020-10-14 05:43:15'),
(502, '1601875514image.png', 1, 'png', 37, '2020-10-14 08:59:03'),
(503, '1601875504sample.pdf', 2, 'pdf', 37, '2020-10-14 08:59:03'),
(517, '2019-04-031554292579cover_img.jpeg', 1, 'jpeg', 1, '2020-11-02 12:31:16'),
(518, 'sampl.pdf', 2, 'pdf', 1, '2020-11-02 12:31:16'),
(574, 'dummy_listing.jpg', 1, 'jpg', 42, '2020-11-03 09:29:47'),
(575, '1602654143new.pdf', 2, 'pdf', 42, '2020-11-03 09:29:47'),
(622, 'dummy_listing.jpg', 1, 'jpg', 46, '2020-11-06 06:50:51'),
(624, 'dummy_listing.jpg', 1, 'jpg', 43, '2020-11-07 05:38:24'),
(625, '1602655253sample.pdf', 2, 'pdf', 43, '2020-11-07 05:38:24'),
(634, '1599458414header.jpg', 1, 'jpg', 24, '2020-11-10 03:44:39'),
(635, '1599457954sample.pdf', 2, 'pdf', 24, '2020-11-10 03:44:39'),
(644, '1599203889eed4c0cc1c3703a9e89dfe8452415d27.png', 1, 'png', 21, '2020-12-07 09:58:31'),
(645, '1599203892sample.pdf', 2, 'pdf', 21, '2020-12-07 09:58:32'),
(646, '1599458445eed4c0cc1c3703a9e89dfe8452415d27.png', 1, 'png', 23, '2020-12-08 06:48:45'),
(647, '1599450823sample.pdf', 2, 'pdf', 23, '2020-12-08 06:48:45'),
(661, 'dummy_listing.jpg', 1, 'jpg', 34, '2020-12-09 05:56:14'),
(662, '1600261439sample.pdf', 2, 'pdf', 34, '2020-12-09 05:56:14'),
(680, 'dummy_listing.jpg', 1, 'jpg', 48, '2020-12-09 09:43:38'),
(686, 'r2.jpg', 1, 'jpg', 17, '2020-12-09 10:19:09'),
(687, 'sample.pdf', 2, 'pdf', 17, '2020-12-09 10:19:09'),
(697, 'dummy_listing.jpg', 1, 'jpg', 50, '2020-12-10 06:10:12'),
(700, '1599544286header.jpg', 1, 'jpg', 33, '2020-12-10 06:30:57'),
(701, '1599544288sample.pdf', 2, 'pdf', 33, '2020-12-10 06:30:57'),
(705, 'dummy_listing.jpg', 1, 'jpg', 51, '2020-12-10 09:17:58'),
(706, '1601889699image.png', 1, 'png', 38, '2020-12-14 04:29:20'),
(707, '1601889702sample.pdf', 2, 'pdf', 38, '2020-12-14 04:29:20'),
(710, 'dummy_listing.jpg', 1, 'jpg', 36, '2020-12-14 04:36:58'),
(711, '1604382920sample.pdf', 2, 'pdf', 36, '2020-12-14 04:36:58'),
(718, 'dummy_listing.jpg', 1, 'jpg', 35, '2020-12-14 05:38:29'),
(719, '1601461605sample.pdf', 2, 'pdf', 35, '2020-12-14 05:38:29'),
(721, 'dummy_listing.jpg', 1, 'jpg', 49, '2020-12-14 05:43:49'),
(722, '1599538044images-3-256x256.jpg', 1, 'jpg', 25, '2020-12-14 05:47:45'),
(723, '1600143636calander.png', 1, 'png', 25, '2020-12-14 05:47:45'),
(724, '1599480382sample.pdf', 2, 'pdf', 25, '2020-12-14 05:47:46'),
(730, 'dummy_listing.jpg', 1, 'jpg', 47, '2021-01-20 09:39:14'),
(731, '1599203889eed4c0cc1c3703a9e89dfe8452415d27.png', 1, 'png', 52, '2020-12-07 09:58:31'),
(732, '1599203892sample.pdf', 2, 'pdf', 52, '2020-12-07 09:58:32'),
(733, '1600143636calander.png', 1, 'png', 53, '2021-01-20 09:39:14'),
(734, '1599480382sample.pdf', 2, 'pdf', 53, '2020-12-14 05:47:46'),
(735, '1600143636calander.png', 1, 'png', 54, '2020-12-14 05:47:45'),
(736, '1599480382sample.pdf', 2, 'pdf', 54, '2020-12-14 05:47:46'),
(737, '1599544286header.jpg', 1, 'jpg', 55, '2020-12-10 06:30:57'),
(738, '1599544288sample.pdf', 2, 'pdf', 55, '2020-12-10 06:30:57'),
(739, '1618470808download.jpeg', 1, 'jpeg', 56, '2021-04-15 07:15:59'),
(740, '1618470822photo-1503023345310-bd7c1de61c7d.jpeg', 1, 'jpeg', 56, '2021-04-15 07:15:59'),
(741, '1618475987download.jpeg', 1, 'jpeg', 57, '2021-04-15 08:40:48'),
(742, '1618476001photo-1503023345310-bd7c1de61c7d.jpeg', 1, 'jpeg', 57, '2021-04-15 08:40:48'),
(743, '1618476556download.jpeg', 1, 'jpeg', 58, '2021-04-15 08:49:26'),
(744, '1618477281download.jpeg', 1, 'jpeg', 59, '2021-04-15 09:01:55'),
(746, 'dummy_listing.jpg', 1, 'jpg', 60, '2021-04-15 09:23:36'),
(749, '1618551413download.jpeg', 1, 'jpeg', 80, '2021-04-16 06:09:13'),
(751, '1618554134photo-1503023345310-bd7c1de61c7d.jpeg', 1, 'jpeg', 82, '2021-04-16 06:27:41'),
(754, '1618562298download.jpeg', 1, 'jpeg', 84, '2021-04-16 08:38:28'),
(756, '1618561493photo-1503023345310-bd7c1de61c7d.jpeg', 1, 'jpeg', 83, '2021-04-16 08:40:29'),
(758, '1618562892photo-1503023345310-bd7c1de61c7d.jpeg', 1, 'jpeg', 85, '2021-04-16 08:50:24'),
(760, '1618563472photo-1503023345310-bd7c1de61c7d.jpeg', 1, 'jpeg', 86, '2021-04-16 09:00:33'),
(761, 'dummy_listing.jpg', 1, 'jpg', 87, '2021-04-16 09:01:42'),
(762, 'dummy_listing.jpg', 1, 'jpg', 88, '2021-05-20 18:58:33'),
(763, '1602654176downloa.jpeg', 1, 'jpeg', 41, '2021-05-21 10:13:36'),
(764, '1602653381new.pdf', 2, 'pdf', 41, '2021-05-21 10:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `listing_resouce_files`
--

CREATE TABLE `listing_resouce_files` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing_resouce_files`
--

INSERT INTO `listing_resouce_files` (`id`, `name`, `type`, `extension`, `resource_id`, `created_at`) VALUES
(1, '1621588886sample.pdf', 1, 'pdf', 2, '2021-05-21 09:24:42'),
(2, '1621588886sample.pdf', 1, 'pdf', 2, '2021-05-21 09:24:42'),
(4, '1621591481dummy.pdf', 1, 'pdf', 1, '2021-05-21 15:35:26'),
(5, '1621591517sample.pdf', 1, 'pdf', 1, '2021-05-21 15:35:26'),
(6, '1621591481dummy.pdf', 1, 'pdf', 1, '2021-05-21 15:48:09'),
(7, '1621592285sample.pdf', 1, 'pdf', 1, '2021-05-21 15:48:09'),
(11, '1621592352sample.pdf', 1, 'pdf', 3, '2021-05-21 18:19:07'),
(12, '1621599363dummy_(1).pdf', 1, 'pdf', 3, '2021-05-21 18:19:07'),
(13, '1621601344sample.pdf', 1, 'pdf', 3, '2021-05-21 18:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `listing_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0= invited, 1= accepted, 2=rejected',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `user_id`, `listing_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 17, 1, '2020-09-09 01:21:56', NULL),
(5, 2, 17, 1, '2020-09-09 01:22:44', NULL),
(6, 3, 39, 0, '2020-10-06 05:18:43', NULL),
(7, 3, 40, 0, '2020-10-06 06:20:52', NULL),
(8, 3, 41, 0, '2020-10-14 05:29:53', NULL),
(9, 3, 42, 0, '2020-10-14 05:42:34', NULL),
(17, 18, 46, 0, '2020-11-05 12:44:35', NULL),
(24, 2, 46, 0, '2020-11-06 06:50:52', NULL),
(25, 8, 46, 0, '2020-11-06 06:51:01', NULL),
(26, 6, 47, 0, '2020-11-06 07:23:54', NULL),
(27, 6, 80, 0, '2021-04-16 05:37:05', NULL),
(28, 10, 82, 0, '2021-04-16 06:26:47', NULL),
(29, 21, 41, 0, '2021-05-21 10:13:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(1020) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(1020) NOT NULL,
  `token` varchar(1020) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `file`, `title`, `description`, `tags`, `status`, `created_at`) VALUES
(1, '6.png', 'Event Space in Hougang Avenue', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n                                <blockquote class=\"wp-block-quote\">\r\n                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n\r\n                                </blockquote>\r\n\r\n                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>\r\n<h3>Lorem ipsum dolor sit amet, consectetur</h3>\r\n\r\n                                <ul class=\"features-list\">\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Sed do eiusmod tempor incididunt ut</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Labore et dolore magna aliqua</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Ut enim ad minim veniam, quis nostrud exercitation</li>\r\n                                </ul>', '1,3,2', 1, '2020-10-29 04:39:52'),
(2, '3.jpg', 'Modern Pop-Up Shop in Trendy', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>\r\n\r\n                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n                                <blockquote class=\"wp-block-quote\">\r\n                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>\r\n\r\n                                </blockquote>\r\n\r\n                                <p>Quuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quia non numquam eius modi tempora incidunt ut labore et dolore magnam dolor sit amet, consectetur adipisicing.</p>\r\n<h3>Lorem ipsum dolor sit amet, consectetur</h3>\r\n\r\n                                <ul class=\"features-list\">\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Sed do eiusmod tempor incididunt ut</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Labore et dolore magna aliqua</li>\r\n                                    <li><i class=\"bx bx-badge-check\"></i> Ut enim ad minim veniam, quis nostrud exercitation</li>\r\n                                </ul>', '4,1', 1, '2020-11-07 07:14:24'),
(3, '1621591498pexels-photomix-company-96620.jpg', 'testnew', '<p>test</p>', '6', 1, '2021-05-21 18:19:07'),
(4, '1622253235Nicolo_borsa.jpg', 'How to use Consignment to lower your inventory costs', '<h1 class=\"western\" style=\"margin-bottom: 0.4cm; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); margin-top: 0cm; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"firasansbold, Helvetica, sans-serif\"><font style=\"font-size: 22pt;\">Office sublease market growing in Toronto, Vancouver</font></font></font></h1><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><br><br></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\"><b>The COVID-19 pandemic has led to an increase in sublease office space in major Canadian cities in recent weeks, particularly Vancouver and Toronto. Market experts expect the trend to continue, and to expand to other cities as occupiers take stock of the coronavirus impact and future work habits.</b></font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">According to a&nbsp;</font></font></font><a href=\"http://www.collierscanada.com/\" target=\"_blank\"><font color=\"#9d0917\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Colliers International</font></font></font></a><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">&nbsp;report, obtained by RENX, Canada’s three largest employment centers – Toronto, Vancouver, and Montreal – had a combined 863,000 square feet of new sublease space become available between March and May, of which 482,000 is considered immediately available.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">The vast majority of that total, about 769,000 square feet, is in Toronto and Vancouver.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Montreal has had about 97,000 square feet added to the sublease market, Colliers says.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Scott Addison, president of Canadian brokerage services for Colliers, believes there are two key reasons for the trend. First, there is a more pessimistic economic view going forward.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">If you’re already bringing things onto the sublet market, you probably had something you recognized before the COVID hit, that you had too much space and you need to re-organize your office,” Addison said.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">That might have accelerated the decision.”</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Second is the sudden, dramatic increase in employees working from home: “There will be an impact from that in the future. How large? We don’t know.”</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">The Colliers report says 47 percent of office tenants believe their space needs will decrease: 56 percent say it will be due to fewer employees, and 44 percent attribute it to employees working from home.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">It also projects a potential reduction in tenant office space needs of 8.5 percent over the next eight years.</font></font></font></p><h3 class=\"western\" style=\"margin-bottom: 0cm; color: rgb(0, 0, 0); margin-top: 0cm; border: none; padding: 0cm; line-height: 0.42cm;\"><font color=\"#000000\"><font face=\"firasansbold, Helvetica, sans-serif\"><font style=\"font-size: 11pt;\">Vancouver, Toronto markets “super strong”</font></font></font></h3><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Addison said companies that took on space anticipating near-term growth are scaling back those plans. He cited tech companies in particular, who are leading the work-from-home trend.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Toronto and Vancouver also both have significant new buildings which will be delivered during the next three years. This creates a sublet market as a flight to quality takes place.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">While the amount of sublet space is growing, he noted Vancouver and Toronto are coming off of “super strong” markets with record-low vacancy.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">It has been difficult to find any tenant space in the downtown cores and large blocks of space remain very scarce in both markets.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Joe Almeida, managing director and principal at&nbsp;</font></font></font><a href=\"http://www.avisonyoung.com/\" target=\"_blank\"><font color=\"#9d0917\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Avison Young</font></font></font></a><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">&nbsp;in Toronto, expects considerably more sublease space to become available.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">No question it’s having an impact. We’re about double the amount of sublease space in the last 12 months,” he said. “But it is rising, I could easily see it double (again) in the next two months as we come out of this.”</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">He also cited several factors, though so far he hasn’t seen major blocks of space opening up.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">One is tenants that took some space and now have rethought that particular requirement, (so) you’re starting to see space that has never even been occupied come to the sublease market,” Almeida said. “Not very large, we’re talking about small- and medium-sized spaces.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Then you’re also seeing smaller tenants who are rethinking their business . . . and either trying to see if they can get out from under a lease or just re-focusing their business into smaller space down the road once they get the sublease.”</font></font></font></p><h3 class=\"western\" style=\"margin-bottom: 0cm; color: rgb(0, 0, 0); margin-top: 0cm; border: none; padding: 0cm; line-height: 0.42cm;\"><font color=\"#000000\"><font face=\"firasansbold, Helvetica, sans-serif\"><font style=\"font-size: 11pt;\">Toronto office market data</font></font></font></h3><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">The Colliers report says 273,000 square feet of new sublease listings came to market in May in Toronto, and a total of 551,000 square feet of new space was listed across the GTA from March to May. Fifty-seven percent was class-A space and 58 percent was in the downtown market.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">With leasing activity also down, the effect is cumulative.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Although this has yet to cause any major ripples for the 250-million-square-foot office market, the addition of new space has resulted in Downtown Toronto’s sublease availability to double within the past three months,” the report states.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">The Downtown West and Downtown South submarkets were the largest contributors of this space, respectively listing 139,000 square feet and 72,000 square feet.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">This new availability is significant to these two submarkets, which had Q1 2020 availability rates of only 2.0 percent and 2.8 percent.”</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">The Altus data is similar, showing a jump from 705,844 square feet of available sublease space in Q1 2020 (20 percent of available space), to its current 1.1 million square feet (26.1 percent of available space).</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">CBRE, in a Q2 report released today, lists the city with 650,000 square feet of vacant office space available for sublet, an 86 percent jump from its Q1 report. It reports a downtown vacancy of 2.7 percent, and a $1.53 reduction in downtown class-A net rents, to $35.38 per square foot.</font></font></font></p><h3 class=\"western\" style=\"margin-bottom: 0cm; color: rgb(0, 0, 0); margin-top: 0cm; border: none; padding: 0cm; line-height: 0.42cm;\"><font color=\"#000000\"><font face=\"firasansbold, Helvetica, sans-serif\"><font style=\"font-size: 11pt;\">Vancouver office market data</font></font></font></h3><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Vancouver is being impacted by the same trends, though some of the data is more disparate.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">In the Greater Vancouver Area between March and May, the Colliers report says 218,000 square feet of sublease space became available.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">The majority of sublease space coming online in Vancouver is attributed to the downtown market, which, like Toronto, has seen its sublease availability double. Unlike Toronto, however, the majority of new space is class-B, representing 67 percent of new sublease square feet,” the report states.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Downtown Vancouver is seeing an increase in sublease availability volume over direct availability and will likely continue this upward trend in the upcoming months. The majority of downtown sublease availabilities fall between the 5,000-to-10,000-square-foot range and 52 percent is comprised of class-B space.”</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">According to&nbsp;</font></font></font><a href=\"http://www.altusgroup.com/\" target=\"_blank\"><font color=\"#9d0917\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Altus Group</font></font></font></a><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">&nbsp;data, the downtown office market went from 215,374 square feet of available sublease space in Q1 2020 (23 percent of the total available space), to 526,154 square feet currently (38 percent of total available space).</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">CBRE’s Tony Quattrin told RENX last week that sublease space in Vancouver was up even more dramatically, to more than 500,000 square feet and from 37 blocks of space to 90.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">In Vancouver and Toronto, we’re definitely seeing it. In the other markets, we will see it but we’re not seeing it yet,” said Ray Wong, the vice-president of data operations with Altus.&nbsp;</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">I think right now with the pause we’ve had in the market over the last three or four months, companies in partnership with their HR departments are reassessing their space requirements.”</font></font></font></p><h3 class=\"western\" style=\"margin-bottom: 0cm; color: rgb(0, 0, 0); margin-top: 0cm; border: none; padding: 0cm; line-height: 0.42cm;\"><font color=\"#000000\"><font face=\"firasansbold, Helvetica, sans-serif\"><font style=\"font-size: 11pt;\">Leasing activity has declined</font></font></font></h3><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">We know that in Toronto the lease activity is off by half and it’s probably the same number in Vancouver,” Wong added.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><br><br></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Wong said the decline in leasing activity could also be attributed, at least in part, to government restrictions that prevented potential tenants from visiting buildings and touring available space.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">He said most of the sublease space is in class-A and class-B buildings. However, so far Wong said it’s not impacting rental rates.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Because of the tightness of the market (in Vancouver and Toronto), some of the tenants believe that they’ll get the full rate . . . The office availability rate is still relatively tight in those two markets,” he explained. “So coming out sooner, they have a better chance of recovering almost all, if not all, of their rental rate obligations.”</font></font><font face=\"firasansbold, Helvetica, sans-serif\"><font style=\"font-size: 6pt;\"><i>Ray Wong, vice-president of data operations for Altus Group’s Data Solutions division. (Courtesy Altus)</i></font></font></font></p><h3 class=\"western\" style=\"margin-bottom: 0cm; color: rgb(0, 0, 0); margin-top: 0cm; border: none; padding: 0cm; line-height: 0.42cm;\"><br></h3><h3 class=\"western\" style=\"margin-bottom: 0cm; color: rgb(0, 0, 0); margin-top: 0cm; border: none; padding: 0cm; line-height: 0.42cm;\"><font color=\"#000000\"><font face=\"firasansbold, Helvetica, sans-serif\"><font style=\"font-size: 11pt;\">Other major Canadian cities</font></font></font></h3><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">Elsewhere, Altus data shows the amount of sublet space on the market compared to total available space has risen in recent weeks, with the exception of Ottawa:</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">* 25.2 percent Calgary (24.7 percent in the first quarter);</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">* 13.1 percent Edmonton (12.6 percent in Q1);</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">* 5.1 percent Ottawa (6.9 percent in Q1);</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">* and 5.9 percent Montreal (5.5 percent in Q1).</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\"><font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">For Calgary, Wong said, there’s also a “shadow” space market due to the extended downturn in the Alberta economy. It represents space that is not being used by tenants but is also not being actively marketed.</font></font></font></p><p style=\"margin-bottom: 0.4cm; font-size: medium; border: none; padding: 0cm; line-height: 0.46cm;\"><font color=\"#000000\">“<font face=\"robotoregular, Helvetica, sans-serif\"><font style=\"font-size: 9pt;\">The downtown availability rate we have at 25.2 percent and that’s probably north of 30 (percent) if you look at the space that people don’t need, but it’s not on the market,” Wong explained.</font></font></font></p>', '1', 1, '2021-05-29 07:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `resources_tags`
--

CREATE TABLE `resources_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources_tags`
--

INSERT INTO `resources_tags` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Full Space', 1, '2020-10-28 04:19:37'),
(2, 'Popup', 1, '2020-10-28 04:19:37'),
(3, 'Partial Space', 1, '2020-10-28 05:21:49'),
(4, 'Consignment', 1, '2020-10-28 05:22:13'),
(5, 'Fairs/Events', 1, '2020-10-28 05:32:02'),
(6, 'Brands', 1, '2020-10-28 05:35:30'),
(7, 'International', 1, '2020-10-28 05:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `resource_comments`
--

CREATE TABLE `resource_comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `resource_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resource_comments`
--

INSERT INTO `resource_comments` (`id`, `name`, `email`, `website`, `comment`, `user_id`, `resource_id`, `status`, `created_at`) VALUES
(1, 'John Smith', 'demouser085@gmail.com', 'https://test.com', 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 1, 1, 1, '2020-10-30 04:49:37'),
(2, 'John Doe', 'ttt@gmail.com', NULL, 'Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', 1, 2, 1, '2020-10-30 05:20:16'),
(3, 'Vishal', 'demouser085@gmail.com', NULL, 'cdxfdsfdsfdsf', 1, 2, 1, '2020-10-30 12:45:42'),
(4, 'dsad', 'ddddd@gmail.com', 'https://test.com', 'dsad', 1, 2, 1, '2020-12-22 10:51:31'),
(5, 'scsdsssss', 'demouser085@gmail.comddd', NULL, 'dfsdf', 1, 2, 1, '2020-12-22 10:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `retail_category`
--

CREATE TABLE `retail_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail_category`
--

INSERT INTO `retail_category` (`id`, `name`, `status`, `created_at`) VALUES
(1, 'Art', 1, '2020-08-12 05:27:27'),
(2, 'Beauty', 1, '2020-08-12 05:27:27'),
(3, 'Fashion', 1, '2020-08-12 05:27:27'),
(4, 'Home and Living', 1, '2020-08-12 05:27:27'),
(5, 'Jewelry', 1, '2020-08-12 05:27:27'),
(6, 'Accessories', 1, '2020-08-12 05:27:27'),
(7, 'Food and Drink', 1, '2020-08-12 05:27:27'),
(8, 'Footwear', 1, '2020-08-12 05:27:27'),
(9, 'Education', 1, '2020-08-12 05:27:27'),
(10, 'Games and Toys', 1, '2020-08-12 05:27:27'),
(12, 'Service Hair/Body', 1, '2020-08-26 05:15:58'),
(13, 'Hair/Body', 1, '2020-09-28 06:45:11'),
(14, 'Other', 1, '2020-11-03 10:38:40'),
(17, 'sssss', 2, '2020-12-23 10:30:20'),
(18, 'Pet/Supplies', 1, '2021-05-29 01:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `saved_search`
--

CREATE TABLE `saved_search` (
  `id` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `results` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_search`
--

INSERT INTO `saved_search` (`id`, `type`, `location`, `category`, `user_id`, `results`, `created_at`) VALUES
(3, 'b', NULL, 1, 1, 4, '2020-10-27 09:43:51'),
(6, 'b', 'Germany', NULL, 1, 1, '2020-10-27 09:46:41'),
(8, 'test', NULL, 3, 1, 2, '2020-10-27 10:10:42'),
(9, 'test', NULL, 4, 1, 1, '2020-10-27 10:49:35'),
(10, NULL, NULL, 2, 1, 5, '2020-10-27 10:51:55'),
(11, 'kmac', NULL, NULL, 1, 0, '2020-10-30 12:56:49'),
(12, 'kmac', 'fdgfd', 2, 1, 0, '2020-10-30 12:58:06'),
(13, 'test', NULL, 2, 1, 1, '2020-10-30 12:58:19'),
(14, 'test', NULL, NULL, 1, 11, '2020-10-30 12:58:24'),
(15, 'kmac', 'fdgfd', 2, 1, 0, '2020-10-30 12:58:26'),
(16, 'kmac', NULL, NULL, 1, 0, '2020-10-30 12:58:48'),
(17, 'test', NULL, NULL, 1, 11, '2020-10-30 12:58:59'),
(18, 'kmac', 'fdgfd', 2, 1, 0, '2020-10-30 12:59:12'),
(19, NULL, NULL, 2, 1, 5, '2020-10-30 13:04:55'),
(20, NULL, NULL, 2, 1, 5, '2020-10-30 13:04:57'),
(21, NULL, NULL, 2, 1, 5, '2020-10-30 13:04:58'),
(22, NULL, NULL, 2, 1, 5, '2020-10-30 13:04:59'),
(23, NULL, NULL, 2, 1, 5, '2020-10-30 13:04:59'),
(24, 'test', NULL, NULL, 1, 11, '2020-10-30 13:05:53'),
(25, 'test', NULL, NULL, 1, 11, '2020-10-30 13:06:08'),
(26, 'test', NULL, NULL, 1, 11, '2020-10-30 13:06:41'),
(27, 'test', NULL, NULL, 1, 11, '2020-10-30 13:06:44'),
(28, 'test', NULL, NULL, 1, 11, '2020-10-30 13:07:42'),
(29, 'test', NULL, NULL, 1, 11, '2020-10-30 13:07:46'),
(30, 'test', NULL, NULL, 1, 11, '2020-10-30 13:07:47'),
(31, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:03'),
(32, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:07'),
(33, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:07'),
(34, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:08'),
(35, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:09'),
(36, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:17'),
(37, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:17'),
(38, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:18'),
(39, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:18'),
(40, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:18'),
(41, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:18'),
(42, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:20'),
(43, 'test', NULL, 2, 1, 1, '2020-10-30 13:08:23'),
(44, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:26'),
(45, 'test', NULL, NULL, 1, 11, '2020-10-30 13:08:31'),
(46, NULL, NULL, 3, 1, 2, '2020-11-02 04:07:17'),
(47, NULL, NULL, 3, 1, 2, '2020-11-02 04:07:19'),
(48, NULL, 'Germany', NULL, 1, 2, '2020-11-02 06:28:19'),
(49, NULL, 'Germany', NULL, 1, 2, '2020-11-02 06:29:43'),
(50, NULL, NULL, 1, 1, 6, '2020-11-03 07:24:15'),
(51, NULL, NULL, 1, 1, 6, '2020-11-03 07:24:35'),
(52, NULL, NULL, 2, 1, 5, '2020-11-03 07:25:12'),
(53, NULL, NULL, 3, 1, 2, '2020-11-03 07:33:28'),
(54, NULL, NULL, 2, 1, 5, '2020-11-03 08:27:32'),
(55, NULL, NULL, 3, 1, 2, '2020-11-03 11:23:41'),
(56, NULL, 'dc', NULL, 1, 0, '2020-11-03 11:25:43'),
(57, NULL, NULL, 1, 1, 6, '2020-11-03 11:28:21'),
(58, 'test', 'dggf', 1, 1, 0, '2020-11-07 08:35:17'),
(59, NULL, NULL, 2, 1, 7, '2020-11-07 09:07:04'),
(60, NULL, NULL, 2, 1, 7, '2020-11-07 09:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `insta_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `pinterest_link` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `location`, `phone`, `email`, `fb_link`, `twitter_link`, `insta_link`, `linkedin_link`, `pinterest_link`, `lat`, `lng`, `created_at`) VALUES
(1, '123 Wonder Land Drive, Hopewell Junction, New York, USA', '+01 123 4567 890', 'admin@sharethebrick.com', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://in.linkedin.com/', 'https://in.pinterest.com/', NULL, NULL, '2020-10-16 06:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `space_type`
--

CREATE TABLE `space_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `brick_status` int(11) NOT NULL DEFAULT 1,
  `full_space_status` int(11) NOT NULL DEFAULT 1,
  `popup_status` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `space_type`
--

INSERT INTO `space_type` (`id`, `name`, `brick_status`, `full_space_status`, `popup_status`, `status`, `created_at`) VALUES
(1, 'Store Front', 1, 1, 1, 1, '2020-08-13 08:06:17'),
(2, 'Industrial', 1, 1, 0, 1, '2020-08-31 05:25:10'),
(3, 'Shopping Mall', 1, 0, 0, 1, '2020-08-31 05:25:16'),
(4, 'Storage', 1, 1, 0, 1, '2020-08-31 05:25:28'),
(5, 'Food and Drink', 1, 1, 0, 1, '2020-08-31 05:25:32'),
(6, 'Alternative', 1, 1, 1, 1, '2020-08-13 08:06:17'),
(7, 'Pop Up', 1, 0, 0, 1, '2020-08-31 05:25:35'),
(8, 'N/A', 1, 0, 0, 1, '2020-08-31 05:25:39'),
(9, 'Mall Shop', 0, 1, 1, 1, '2020-08-31 05:25:45'),
(10, 'Booth', 0, 1, 1, 1, '2020-08-31 05:25:49'),
(11, 'Other', 0, 1, 1, 1, '2020-08-31 05:25:51'),
(12, 'aaaaaa', 1, 1, 1, 2, '2020-12-23 09:15:44'),
(13, 'aaaa', 0, 1, 0, 2, '2020-12-23 10:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(1020) NOT NULL,
  `email` varchar(1020) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(1020) NOT NULL,
  `remember_token` varchar(400) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(1020) DEFAULT NULL,
  `last_name` varchar(800) DEFAULT NULL,
  `company_name` varchar(1020) DEFAULT NULL,
  `company_address` varchar(1020) DEFAULT NULL,
  `business_number` varchar(800) DEFAULT NULL,
  `business_email` varchar(800) DEFAULT NULL,
  `website` varchar(800) DEFAULT NULL,
  `business_desc` varchar(1020) DEFAULT NULL,
  `facebook_lnk` varchar(800) DEFAULT NULL,
  `instagram_lnk` varchar(800) DEFAULT NULL,
  `twitter_lnk` varchar(800) DEFAULT NULL,
  `type_of_business` int(11) NOT NULL DEFAULT 0 COMMENT '1 for service, 2 for retail, 3 for wholesale',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1= active,2=delete',
  `logged_at` timestamp NULL DEFAULT NULL,
  `token` varchar(1020) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `verify_token` text DEFAULT NULL,
  `type_of_busines` varchar(255) DEFAULT NULL,
  `company_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `image`, `last_name`, `company_name`, `company_address`, `business_number`, `business_email`, `website`, `business_desc`, `facebook_lnk`, `instagram_lnk`, `twitter_lnk`, `type_of_business`, `status`, `logged_at`, `token`, `is_verified`, `verify_token`, `type_of_busines`, `company_icon`) VALUES
(1, 'Test', 'demouser085@gmail.com', '2020-10-12 10:39:13', '$2y$10$.xacTLV0S5dzFa6AAVa87e2BUL/j/uqJ40jH4Qz8aiakN1GIqB8Nm', NULL, '2020-10-12 10:39:13', '2021-05-30 00:43:55', '15972288232019-04-031554292579cover_img.jpeg', 'User', 'Indiit', 'Rajasthan India Holidays, Tilak Nagar, Jaipur, Rajasthan, India', '9818727708', 'demouser085@gmail.com', 'www.website.com', 'test description', NULL, 'https://test@west.com', 'https://test@west.com', 1, 1, '2021-05-30 06:13:55', '1686331681506036', 1, 'sas', 'Service', 'side-barlogo.png'),
(2, 'Vishal', 'vishalindiit@gmail.com1', '2020-10-06 09:37:05', '$2y$10$.xacTLV0S5dzFa6AAVa87e2BUL/j/uqJ40jH4Qz8aiakN1GIqB8Nm', NULL, '2020-10-06 09:37:05', '2020-11-07 04:46:55', '1600930443download.png', 'test', 'Indi it', 'h', '981234567', 'business@gmail.com', 'www.website.com', 'test description', 'https://test@west.com', 'https://test@west.com', 'https://test@west.com', 2, 1, '2020-10-27 12:40:12', NULL, 1, NULL, 'Service', NULL),
(3, 'testing', 'restwest@gmail.com', '2020-08-25 07:49:18', '$2y$10$.xacTLV0S5dzFa6AAVa87e2BUL/j/uqJ40jH4Qz8aiakN1GIqB8Nm', NULL, '2020-08-25 07:49:18', '2020-11-07 04:46:55', NULL, 'test', 'Indi it', 'Rajasthan India Holidays, Tilak Nagar, Jaipur, Rajasthan, India', '981234567', 'business@gmail.com', 'r@gm.', 'test description', 'https://test@west.com', 'https://test@west.com', 'https://test@west.com', 2, 1, '2020-08-25 02:19:18', NULL, 1, NULL, 'Service', NULL),
(5, 'testtt', 'testt@gmail.com', '2020-10-13 05:13:25', '$2y$10$3.ym1b/GYRSuuO3MvrgfN.hsk1VlCPObgjjkhBKiANHutAyhERh6m', NULL, '2020-10-13 05:13:25', '2020-11-07 04:46:24', NULL, 'resttt', '123323', NULL, '323223', NULL, NULL, NULL, NULL, '', '', 1, 1, '2020-10-13 05:13:25', NULL, 1, NULL, 'Service', NULL),
(6, 'Vishal', 'demouser085@gmail.com2', '2020-10-13 05:14:56', '$2y$10$aXT8P.R7hWnz4Z61aWCAl.ycWLIherTRUm7DCn/lphSSdA52fsxQ2', NULL, '2020-10-13 05:14:56', '2020-11-07 04:46:55', NULL, 'dsf', 'sdsd', NULL, '4546546546', NULL, NULL, NULL, NULL, '', '', 2, 1, NULL, NULL, 1, NULL, 'Service', NULL),
(7, 'test', '123@gm.com', '2020-10-14 11:53:37', '$2y$10$PYClMH9guXC9OA/qMIbYxOjppmqli4ofsaD9YIXb2nkYrd5zXh082', NULL, '2020-10-14 11:53:37', '2020-11-07 04:46:24', '', 'rest', 'it', 'VDL-Nedcar, Doctor Hub van Doorneweg, Born, Netherlands', '98766655', '123@gmail.com', 'www.website.com', 'ssdsf', 'https://test@west.com', 'https://test@west.com3', 'https://test@west.com', 1, 1, '2020-10-14 11:53:51', NULL, 1, NULL, 'Service', NULL),
(8, 'Vishal', 'aa@gm.com', '2020-10-20 04:31:42', '$2y$10$w339TcerwnW8GZ.RWAmjtej4yP./jkD5.ptGh0ar.j1sM3I.RJ4tW', NULL, '2020-10-20 04:31:42', '2020-11-07 04:46:24', '', 'dsf', 'sdsd', 'San Francisco, CA, USA', '345435634534', 'aa@gm.com', 'xsxsx', 'zXZszxzx', 'https://test@west.com', 'https://test@west.com', 'https://test@west.com', 1, 1, '2020-10-20 04:31:57', NULL, 1, NULL, 'Service', NULL),
(10, 'Vishal', 'demouser085@gmail.comD', '2020-11-02 05:46:14', '$2y$10$dDbgvwqO2JTwut/JX5mPWeHk6Z6ZNqsDDWUzjo/jk.TT/aCUzyyCG', NULL, '2020-11-02 05:46:14', '2020-11-07 04:46:24', '', 'dsf', 'sdsd', 'Denver, CO, USA', '22133213213', NULL, NULL, 'sadsa', NULL, NULL, NULL, 1, 1, '2020-11-02 05:46:48', NULL, 1, NULL, 'Service', NULL),
(18, 'Vishal', 'vishalindiit@gmail12.com1', NULL, '$2y$10$NS9XBra07b1dkfNnXhSX2Ok4HL5oWa/FLuW2/fKOEogVSn5vvWlu.', NULL, '2020-11-02 12:03:58', '2020-11-07 05:28:16', '15972288232019-04-031554292579cover_img.jpeg', 'cena', 'sdsd', 'Denver, CO, USA', '565656756', NULL, NULL, 'cxzcxzc', NULL, NULL, NULL, 2, 1, '2020-11-02 12:05:28', NULL, 1, '', 'Service', NULL),
(19, 'test', 'ytesty@gmail.com', NULL, '$2y$10$1ejntIiLixjnjRe/N6kFv.k6IhpF4TkQ7kU.UEPG2/tdnfVdC.frO', NULL, '2020-11-07 05:09:42', '2020-11-07 05:14:07', NULL, 'rest', 'dsadsad', NULL, '087768657657', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2020-11-07 05:14:07', NULL, 1, NULL, 'test', NULL),
(20, 'ds', 'vishalindiit@gmail.com1234', '2020-11-07 05:29:50', '$2y$10$f3jLNq3IyAgWos9PBq6TruD2CRweT2qLERbMQDP6GIZD1mOGmrXiS', NULL, '2020-11-07 05:29:08', '2020-11-18 03:54:10', '', 'rest', '123323', 'Dubai - United Arab Emirates', '21234324324', 'vishalindiit@gmail.com', NULL, 'dasd', NULL, NULL, NULL, 0, 1, '2020-11-10 04:35:04', NULL, 1, '', 'test rest west', NULL),
(21, 'tests', 'vishalindiit@gmail.com', '2020-11-18 03:54:54', '$2y$10$fMT.wELbSf9R9XxDbYRfvuxIisu9IMquMGDz9myWCnhHuqD71sxea', NULL, '2020-11-18 03:54:34', '2021-05-21 06:36:24', '', 'rest', 'test', 'Jacksonville, FL, USA', '577657567767', NULL, NULL, 'sd', NULL, NULL, NULL, 0, 1, '2021-05-21 12:06:24', NULL, 1, '', 'test rest west', NULL),
(22, 'Shubham', 'shubham.kareer95@gmail.com', '2021-04-21 06:34:51', '$2y$10$/wLMiqHjS6mevO4EX.uSoO.ujlO.obl/ccSNzlkNearjlniZ2arg6', NULL, '2021-04-21 06:30:45', '2021-04-21 09:56:01', '', 'Kareer', NULL, NULL, '783862387', 'shubham.kareer95@gmail.com', NULL, 'THis', NULL, NULL, NULL, 0, 1, '2021-04-21 06:38:22', NULL, 1, '', 'Test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_cards`
--

CREATE TABLE `user_cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `card_number` varchar(255) DEFAULT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `card_holder_name` varchar(255) DEFAULT NULL,
  `stripe_card_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 for active, 2 for delete',
  `platform` int(11) NOT NULL DEFAULT 0 COMMENT '1 for retail, 2 for office, 3 for residential',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_cards`
--

INSERT INTO `user_cards` (`id`, `user_id`, `card_number`, `card_type`, `customer_id`, `card_holder_name`, `stripe_card_id`, `status`, `platform`, `created_at`) VALUES
(1, 1, '4242', 'visa', 'cus_I5Nv5cIIurwXvK', 'Vishal Rajan', 'card_1HVD9mA4FeWnFMo5PxsvgdKA', 1, 1, '2020-09-25 03:53:59'),
(2, 1, '0005', 'american-express', 'cus_I5O0b70ECc4K0d', 'Vishal Rajan', 'card_1HVDEKA4FeWnFMo53haF9vDy', 1, 0, '2020-09-25 03:58:41'),
(3, 1, '4242', 'visa', 'cus_I5OtBUf0tgunRg', 'Vishal Rajan', 'card_1HVE5HA4FeWnFMo5vdHbc9fp', 2, 1, '2020-09-25 04:53:24'),
(4, 1, '4242', 'mastercard', 'cus_JJT9FWMN7CvKOR', 'Shubham', 'card_1IgqDdA4FeWnFMo5lXmjpuLa', 1, 1, '2021-04-16 11:52:18'),
(5, 1, '4242', 'visa', 'cus_JJTOrHpgoSS6N9', 'Shubham Kareer', 'card_1IgqRRA4FeWnFMo52JKP8VPG', 1, 1, '2021-04-16 12:06:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calender_events`
--
ALTER TABLE `calender_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaboration_type`
--
ALTER TABLE `collaboration_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ideal_uses`
--
ALTER TABLE `ideal_uses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing_files`
--
ALTER TABLE `listing_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing_resouce_files`
--
ALTER TABLE `listing_resouce_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources_tags`
--
ALTER TABLE `resources_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resource_comments`
--
ALTER TABLE `resource_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_category`
--
ALTER TABLE `retail_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_search`
--
ALTER TABLE `saved_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `space_type`
--
ALTER TABLE `space_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_cards`
--
ALTER TABLE `user_cards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `booking_requests`
--
ALTER TABLE `booking_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `calender_events`
--
ALTER TABLE `calender_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `collaboration_type`
--
ALTER TABLE `collaboration_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ideal_uses`
--
ALTER TABLE `ideal_uses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `listing_files`
--
ALTER TABLE `listing_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=765;

--
-- AUTO_INCREMENT for table `listing_resouce_files`
--
ALTER TABLE `listing_resouce_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resources_tags`
--
ALTER TABLE `resources_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resource_comments`
--
ALTER TABLE `resource_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `retail_category`
--
ALTER TABLE `retail_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `saved_search`
--
ALTER TABLE `saved_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `space_type`
--
ALTER TABLE `space_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_cards`
--
ALTER TABLE `user_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
