-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 06:20 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `footballhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `went` text NOT NULL,
  `worked` text NOT NULL,
  `lives` text NOT NULL,
  `belong` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `userid`, `went`, `worked`, `lives`, `belong`) VALUES
(1, 3, 'Oxford', 'Football Academy', 'Football Aca', 'Football '),
(2, 4, 'Harvard Law', 'Microsoft', 'Michigan', 'Minnesota'),
(3, 2, 'Football Academy', 'Football Academy', 'Football Academy', 'Football Academy'),
(4, 5, 'The Voice ', 'One Direction', 'England', 'Ireland');

-- --------------------------------------------------------

--
-- Table structure for table `isfollowing`
--

CREATE TABLE `isfollowing` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `isFollowing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `isfollowing`
--

INSERT INTO `isfollowing` (`id`, `follower`, `isFollowing`) VALUES
(2, 3, 2),
(6, 2, 4),
(7, 2, 3),
(8, 6, 2),
(9, 6, 4),
(10, 3, 6),
(11, 7, 2),
(12, 7, 6),
(13, 2, 7),
(14, 5, 7),
(16, 5, 6),
(17, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `userid`, `post`, `datetime`) VALUES
(1, 3, 'Football is Not Just a Game !!', '2021-03-21 17:32:29'),
(2, 2, 'Football is Love', '2021-03-21 20:05:52'),
(3, 2, 'Cristiano should Leave Juventus !!!!! ', '2021-03-21 20:33:09'),
(4, 2, 'Messi should leave Barcelona !!!! ', '2021-03-21 20:34:09'),
(5, 4, 'Forca Barca 🎉🎉🎉 Barca thrash Real Sociedad 6-1 in an away game !!!', '2021-03-21 23:19:08'),
(6, 6, 'Some people think football is a matter of life and death. I assure you, it\'s much more serious than that.', '2021-03-22 05:07:01'),
(7, 6, 'Athletico taking far lead aggaain !!!!😍😍😍😍', '2021-03-22 05:07:29'),
(8, 6, 'Football is like life. It requires perseverance, self-denial, hard work, sacrifice, dedication, and respect for authority.', '2021-03-22 05:08:09'),
(9, 7, 'My lover loves football more than me 😂', '2021-03-22 05:09:38'),
(10, 5, 'I want to own a Football Team !😎🤞', '2021-03-22 05:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `code`) VALUES
(1, 'abra', 'abra@yahoo.com', 'e6d50dac3c87d189876b2f0f9b71579f', ''),
(2, 'adir', 'adir201@gmail.com', 'f7ca8eb5d4c524fcd62101845d6e6f20', ''),
(3, 'amita', 'amita123@hotmail.com', 'b37081ccf038058a7c190b9ede202c80', ''),
(4, 'ashima', 'ashima@g.co', '049f76dc25dfffe37e809099ac5ad883', ''),
(5, 'niall', 'niall@ddc.co.uk', '5519228ab24a6028f9fd2dbf19eeed1f', ''),
(6, 'abhi', 'abhi@vk.com', '4b704a853875945ddacf0d865c0332f6', ''),
(7, 'anushka', 'love@11.co', 'f7ca73fe12ef2e2e9ef6d363d6b8ba4f', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isfollowing`
--
ALTER TABLE `isfollowing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `isfollowing`
--
ALTER TABLE `isfollowing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
