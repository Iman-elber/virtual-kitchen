-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 05:52 PM
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
-- Database: `virtualkitchendb`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `rid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `type` enum('French','Italian','Chinese','Indian','Mexican','Others') NOT NULL,
  `Cookingtime` int(4) DEFAULT NULL,
  `ingredients` varchar(1000) DEFAULT NULL,
  `instructions` varchar(1000) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `uid` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`rid`, `name`, `description`, `type`, `Cookingtime`, `ingredients`, `instructions`, `image`, `uid`) VALUES
(16, 'Pizza', 'Large crust margherita pizza', 'Italian', 30, 'flour, yeast, milk, salt, egg, tomato sauce, cheese', 'Prepare dough, add toppings, bake for 20 mins.', 'images/pizza.jpg', 4),
(21, 'Pancakes', 'Fluffy and soft pancakes', 'Others', 10, 'flour, milk, sugar, butter', 'Mix ingredients, pour on pan, flip when bubbly, cook until golden.', 'images/pancakes.webp', 3),
(27, 'Legemat', 'Deep-fried crispy dough balls', 'Others', 10, 'flour, water, oil, icing sugar', 'Mix dough, shape into balls, deep fry and dust with sugar.', 'images/legemat.jpg', 1),
(35, 'Tamiya', 'Flavourful deep-fried street food', 'Others', 25, 'chickpeas, oil, water, salt, egg, flour', 'Soak chickpeas, blend with other ingredients, form patties and fry.', 'images/tamiya.jpg', 2),
(50, 'Pasta', 'Cheesy tomato pasta', 'Italian', 20, 'pasta, tomato sauce, cheese, garlic, olive oil', 'Boil pasta, cook sauce, mix together and top with cheese.', 'images/pasta.jpg', 2),
(51, 'Naan', 'Fluffy and chewy naan', 'Indian', 25, 'Yeast, flour, baking powder, butter, yogurt', 'Put 125ml warm water into a bowl and sprinkle over the yeast. Mix flour baking powder, butter and yogurt. Place dough balls flat on a hot pan on both sides.', 'images/naan.webp', 5),
(52, 'Croissant', 'Flaky and soft French croissants', 'French', 18, 'White flour, salt, sugar, yeast, oil, butter, 1 egg', 'Combine white flour, salt, sugar, yeast, and a pinch of oil to form a dough, then knead until smooth and let it rise. Once doubled in size, roll out the dough, layer in chilled butter, fold, and roll several times, then shape into croissants, brush with a beaten egg, and bake until golden.', 'images/Croissant.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`) VALUES
(1, 'JaneSmith', 'Happy123', 'janesmith@outlook.com'),
(2, 'AliIslam', 'Islam456', 'AliI@hotmail.com'),
(3, 'MaryJoe', 'MaryJoe6', 'Joemary@gmail.com'),
(4, 'MohammedAli', '1Mohammed', 'Mohammedali@hotmail.com'),
(5, 'Iman', '$2y$10$.Be5la0U7cDA3iCGzFSHwOncOmbDNyne9.i7smip2A4ygYT5WUI9S', 'Eiman.06@outlook.com'),
(6, 'Bob', '$2y$10$KTvPL9yAueQYECiw5R3iXOBwfd2/Hrc3J1rU31idPTgkhnHzCKXjC', 'Bob@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
