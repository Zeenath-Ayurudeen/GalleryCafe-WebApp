-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 05:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Hafsa', 'hafsa@gallerycafe.com', '$2y$10$hew7WwIVIcB2.GtmeqS3HOO8ojePJEMit.UmdxeVP1XSdNMBEuu7i', '2024-09-25 20:53:26'),
(2, 'Tom', 'tom@gallerycafe.com', '$2y$10$LKnpTj1dGbcReXwcJXTUs.axzUqdQou0/C63ILrPecn6UqzKYBH8m', '2024-09-27 20:09:20'),
(3, 'Selena', 'selena@gallerycafe.com', '$2y$10$/9izE3CANYJgfmM9q0U4DOOOm9cS8kjPGq3HTdqlViOJ08Vfxwzkq', '2024-10-05 14:27:05'),
(4, 'Damon', 'damon@gallerycafe.com', '$2y$10$9E/iGUXr6AJMLYxbfNGgCuP7Fac.a0yPu4IJAUKtvQ76gdeP/hAEi', '2024-10-05 14:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `email`, `message`, `sent_at`) VALUES
(1, 'Mary', 'mary@gmail.com', 'are yall open on poya days?', '2024-09-19 22:03:08'),
(2, 'John', 'john@gmail.com', 'hi there:)', '2024-09-19 22:49:01'),
(3, 'Zain', 'zain@gmail.com', 'is your food halal?', '2024-09-22 19:26:05'),
(4, 'Tom', 'tom@gmail.com', 'hi', '2024-09-22 19:30:10'),
(5, 'anna', 'anna@gmail.com', 'hi are yall available on uber or pickme?', '2024-09-22 20:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `date`, `time`, `description`, `image`) VALUES
(1, 'Live Music Nights', '2024-10-12', '19:00:00', 'Enjoy live performances by local artists every weekend while savoring your favorite dishes.', 'music.jpg'),
(2, 'Themed Dinner Nights', '2024-10-16', '20:30:00', 'Enjoy themed nights with exclusive menus featuring Italian, Sri Lankan, Chinese and Indian cuisines', 'events.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` enum('Sri Lankan','Italian','Chinese','Indian','Beverages','Desserts') NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `price`, `category`, `image`) VALUES
(1, 'Kottu Roti', 1000.00, 'Sri Lankan', 'kottu.jpg'),
(2, 'Egg Hoppers', 150.00, 'Sri Lankan', 'egghoppers.jpg'),
(3, 'Shrimp Dumplings', 1100.00, 'Chinese', 'dumplings.jpg'),
(4, 'Beef Lo Mein', 1125.00, 'Chinese', 'lomein.jpg'),
(5, 'Penne Arrabbiata', 1350.00, 'Italian', 'pasta.jpg'),
(6, 'Cheesy BBQ Pizza', 1050.00, 'Italian', 'pizza.jpg'),
(7, 'Chicken Biryani', 1100.00, 'Indian', 'biryani.jpg'),
(8, 'Chicken with Paratha', 950.00, 'Indian', 'paratha.jpg'),
(14, 'Iced Coffee', 950.00, 'Beverages', 'iced coffee.jpg'),
(15, 'Milkshakes', 975.00, 'Beverages', 'milkshakes.jpg'),
(16, 'Soft Drinks', 300.00, 'Beverages', 'soft drinks.jpg'),
(17, 'Chocolate Brownies', 325.00, 'Desserts', 'brownies.jpg'),
(18, 'Ice-Creams', 550.00, 'Desserts', 'ice creams.jpg'),
(20, 'Cheese Cake', 750.00, 'Desserts', 'cheesecake.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `item_id`, `quantity`, `total_price`, `order_status`, `created_at`) VALUES
(1, NULL, 4, 1, 1125.00, 'Pending', '2024-10-10 13:17:41'),
(2, NULL, 5, 1, 1350.00, 'Pending', '2024-10-10 13:17:41'),
(3, NULL, 6, 1, 1050.00, 'Pending', '2024-10-10 13:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `discount` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `title`, `description`, `discount`, `start_date`, `end_date`) VALUES
(8, 'WEEKDAY LUNCH SPECIAL', 'Enjoy a 15% discount on all Lunch Orders from Monday to Friday between 12 PM and 3 PM.', '15%', '2024-10-29', '2024-10-30'),
(9, 'DINE & WIN', 'Spend over LKR 5,000 and enter a monthly raffle to win a Free Dinner for Two, valid for any cuisine.', '20%', '2024-11-02', '2024-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `res_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `table_selection` varchar(100) NOT NULL,
  `people` varchar(100) NOT NULL,
  `special_requests` text NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `status` enum('pending','approved','cancelled') NOT NULL,
  `res_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`res_id`, `fullname`, `email`, `contact`, `date`, `time`, `table_selection`, `people`, `special_requests`, `parking`, `status`, `res_at`) VALUES
(1, 'Zeenath Ayurudeen', 'hafsa.ayurudeen@gmail.com', '0774758979', '2024-09-30', '12:00', 'private', '2', 'please arrange a birthday cake with some birthday decorations on our reserved table', 1, 'approved', '2024-09-23 14:37:22'),
(2, 'Peter Parker', 'peter@gmail.com', '0771908060', '2024-10-02', '19:00', 'window', '3', '', 0, 'pending', '2024-09-23 14:39:58');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Zeenath', 'zeenath@gallerycafe.com', '$2y$10$DAgvjh6Wv7Lnei6XjzzYO.ms6H.oB0UqXibQ6ZHiDeJh32FGdb1AO', '2024-09-25 20:53:50'),
(2, 'Rose', 'rose@gallerycafe.com', '$2y$10$3EfnJ8VteBfyL1iOIoyDVeqBPNJzyy5vA1.JiXUlR110arFL8bYSi', '2024-09-27 19:57:24'),
(4, 'Ben', 'ben@gallerycafe.com', '$2y$10$o6Qb4vje2nY6tH9uEpqlteZeMG0mcIEAkCr.A7knDq4QT4sT/62M6', '2024-09-28 12:17:30'),
(5, 'Elena', 'elena@gallerycafe.com', '$2y$10$wg21IL5xfflHdZpQ/fskCOVjdDEs17Ic2noUQZzrHMAyfJPeNO0eK', '2024-10-05 14:36:22'),
(6, 'Jerry', 'jerry@gallerycafe.com', '$2y$10$moRKGePcBhG0HNJRmdlZT.z.5IX6XzOQ6MdnOzdzySCD9Fr9fzOVW', '2024-10-05 15:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `login_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `login_at`) VALUES
(1, 'Zeenath Hafsa', 'hafsa.ayurudeen@gmail.com', '$2y$10$siAZOYLj.R6Cf//hahM0eOiVOcJVUaWkh1L3SbsiSJEjn.xkOyQ9u', '2024-09-20 10:48:20'),
(2, 'Ayurudeen', 'ayurudeen@gmail.com', '$2y$10$DJQMxNm5289v.Y1ID/RMGuP6rPFqaWPndhg2rAj18hypZNT3YLTU6', '2024-09-20 10:49:22'),
(3, 'Zeenath Hafsa Ayurudeen', 'hafsa.ayurudeen@gmail.com', '$2y$10$qWjkBBUmjRtKt9PJi00I..PnKqKJIuJFgKNyovASUAwtsXRkmjW.u', '2024-09-20 10:58:54'),
(4, 'Peter Parker', 'peter@gmail.com', '$2y$10$vjBpx4xJlWz3Qet7MpSxSuVBJVkO8bTzferLfq8YRkgnD3VvwlOYK', '2024-09-22 20:10:46'),
(5, 'Mary', 'mary@gmail.com', '$2y$10$QwB7l4WUk3oQB7uif5owAuu59R5XnfYmuz4H9HFpHlgFilbhNMJxy', '2024-09-22 20:22:35'),
(6, 'anna', 'anna@gmail.com', '$2y$10$1OGW6SggHCT.VGvwo.FACOtPWVzu00nt5E5oZPrS7cwQ0J2/8EXzK', '2024-09-22 20:25:35'),
(7, 'Gwen Stacy', 'gwen@gmail.com', '$2y$10$N8xz2eFKmUuvSlojCMzsMOPEtcvSn2gRPlr4Y/KSEmqSPSkXeXlNG', '2024-10-05 12:46:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
