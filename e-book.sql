-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2020 at 12:01 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-book`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `GroupID` tinyint(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `fullname`, `password`, `image`, `GroupID`, `date`) VALUES
(2, 'منى', 'منى احمد علي', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '226-2260470_transparent-admin-icon-png-admin-logo-png-png.png', 0, '2020-06-21'),
(3, 'احمد', 'احمد علي', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'avatar2_big@2x.png', 0, '2020-06-21'),
(4, 'admin', 'فيصل فيصل', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin-settings-male.png', 1, '2020-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_book` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_price` int(11) NOT NULL,
  `book_aouther` varchar(255) NOT NULL,
  `pub_house` varchar(255) NOT NULL,
  `no_copies` int(11) NOT NULL,
  `desc_book` text NOT NULL,
  `lang_book` varchar(3) NOT NULL,
  `age_book` varchar(255) NOT NULL,
  `image_book` varchar(255) NOT NULL,
  `cat_ID` int(11) NOT NULL,
  `statuss` int(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_book`, `book_name`, `book_price`, `book_aouther`, `pub_house`, `no_copies`, `desc_book`, `lang_book`, `age_book`, `image_book`, `cat_ID`, `statuss`, `date`) VALUES
(1, 'قصص الأنبياء', 100, 'ابن كثير', 'دار الشروق', 3, 'قصص الأنبياء لإبن كثير', 'ar', '[3-5]', 'c.jpg', 1, 1, '2020-06-21'),
(2, 'هاري بوتر وحجرالفيلسوف', 7, 'رولينح', 'دار النهضة', 3, 'هاري بوتر وحجرالفيلسوف هاري بوتر وحجرالفيلسوف', 'ar', '[5-8]', '9002718.jpg', 1, 1, '2020-06-22'),
(5, 'سبل السلام', 12, 'أبي إبراهيم محمد', 'دار الكتب العلمية', 10, 'أبي إبراهيم محمد بن إسماعيل/الأمير الصنعاني', 'ar', '[5-8]', '230224_{C460851A-A4B9-402B-83D0-C53DC6ADFE3A}.png', 4, 1, '2020-06-23'),
(6, 'The Room Where ', 19, 'John Bolton', 'House Memoir', 12, 'The result is a White House memoir that is the most comprehensive', 'en', '[+13]', '73695_41l9MHTOfDL._AC_SY400_.jpg', 2, 1, '2020-06-23'),
(7, 'Saint X: A Novel', 25, 'Alexis Schaitkin', 'Oyinkan Braithwaite', 4, '\"\'Saint X\' is hypnotic. Schaitkin\'s characters', 'en', '[+13]', '151078_51Ys5yejqML._SY177_.jpg', 1, 1, '2020-06-23'),
(8, 'التدريب التشاركي', 8, 'حسين حسنين', 'دار مجدلاوي للنشر والتوزيع', 8, 'ان محتوى هذا الكتاب قد صمم بطريقة تخدم كلا من المدرب والمتدرب', 'ar', '[8-12]', '852140_{9B8B4309-7439-4C02-BA00-D8D7D9F936BD}.png', 6, 1, '2020-06-23'),
(9, 'The Guest List', 18, 'Lucy Foley', 'Housekeeping', 4, 'On an island off the coast of Ireland', 'en', '[+13]', '615361_51HNh-eI7CL._AC_SY400_.jpg', 2, 1, '2020-06-23'),
(10, 'فن الحرب', 10, 'سن تزو', 'دار الرافدين', 3, 'لقد استطاع \"سون تزو\" أنْ يؤكّد من خلال كتابه  ', 'ar', '[8-12]', '896734_3096553.jpg', 6, 1, '2020-06-23'),
(11, 'السكرية', 13, 'نجيب محفوظ', 'دار الشروق', 5, 'لسكرية وهي الرواية - الجزء - الثالث والاخير من ثلاثية نجيب محفوظ', 'ar', '[8-12]', '726133_{07FF5A18-42A3-4DC6-89D0-C3AE9C8851FD}.png', 2, 1, '2020-06-23'),
(12, 'حوار مع صديقي الملحد', 4, 'مصطفى محمود', 'مكتبة مصر', 3, 'حوار مع صديقي الملحد مصطفى محمود', 'ar', '[+13]', '153779_{B184DFA8-FB89-4DAF-9DB1-1BCA69DDD66E}.png', 4, 1, '2020-06-23'),
(13, 'لأنك الله', 17, 'علي الفيفي', 'دار الحضارة', 4, 'كلمات عن بعض أسماء الله كتبتها بضعفي عن القوي سبحانه وبعجزي', 'ar', '[5-8]', '737182_5000966.jpg', 4, 1, '2020-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `buy_transaction`
--

CREATE TABLE `buy_transaction` (
  `buy_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `phone` int(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `book_id` int(11) NOT NULL,
  `buy_type` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_transaction`
--

INSERT INTO `buy_transaction` (`buy_id`, `name`, `adress`, `phone`, `quantity`, `total_price`, `book_id`, `buy_type`, `date`) VALUES
(9, 'احمد علي', 'الدمام', 2345321, 3, 300, 1, 'عند الأستلام', '2020-06-23'),
(10, 'احمد محمد', 'الرياض', 2345321, 3, 21, 2, 'عند الأستلام', '2020-06-23'),
(11, 'فيصل علي', 'الرياض', 2345321, 3, 21, 2, 'عند الأستلام', '2020-06-23'),
(12, 'فيصل علي', 'الدمام', 2345321, 2, 14, 2, '1686353686', '2020-06-23'),
(13, 'احمد علي', 'الرياض', 2345321, 2, 50, 7, 'عند الأستلام', '2020-06-23'),
(14, 'فيصل علي', 'الدمام', 2345321, 3, 30, 10, 'عند الأستلام', '2020-06-23'),
(15, 'احمد علي محمد', 'جده', 12346548, 2, 34, 13, '1686353686', '2020-06-24'),
(16, 'منى احمد صالح', 'جازان', 2345321, 1, 17, 13, '5456346460', '2020-06-24'),
(17, 'احمد علي', 'الرياض', 2345321, 3, 12, 12, '12365468453', '2020-06-24'),
(18, 'احمد علي', 'الدمام', 12346548, 1, 17, 13, '789743512', '2020-06-24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Cat_id` int(11) NOT NULL,
  `Cat_name` varchar(255) NOT NULL,
  `Cat_desc` text NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `ordering` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Cat_id`, `Cat_name`, `Cat_desc`, `Status`, `ordering`, `date`) VALUES
(1, 'قصص', 'قسم خاص لكتب القصص', 1, 1, '2020-06-18'),
(2, 'الشعر', 'قسم خاص لكتب الشعر', 1, 2, '2020-06-24'),
(4, 'اسلاميات', 'اسلاميات واشياء', 1, 6, '2020-06-20'),
(6, 'روايات', 'روايات واشياء', 1, 5, '2020-06-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `cat_1` (`cat_ID`);

--
-- Indexes for table `buy_transaction`
--
ALTER TABLE `buy_transaction`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `book_` (`book_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `buy_transaction`
--
ALTER TABLE `buy_transaction`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`cat_ID`) REFERENCES `categories` (`Cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buy_transaction`
--
ALTER TABLE `buy_transaction`
  ADD CONSTRAINT `book_` FOREIGN KEY (`book_id`) REFERENCES `book` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
