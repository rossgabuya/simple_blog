-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2017 at 05:20 AM
-- Server version: 10.0.29-MariaDB-0ubuntu0.16.10.1
-- PHP Version: 7.0.18-0ubuntu0.16.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(12) NOT NULL,
  `menu_name` varchar(128) NOT NULL,
  `cat_slug` varchar(128) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `menu_name`, `cat_slug`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'Hello World', 'hello-world', 1, '2017-07-25 04:37:13', '2017-07-25 04:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `cat_id` int(12) NOT NULL,
  `post_name` varchar(128) NOT NULL,
  `post_slug` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `cat_id`, `post_name`, `post_slug`, `content`, `visible`, `created_at`, `updated_at`) VALUES
(1, 1, 'Brand New Life', 'brand-new-life', 'Masaya ako dahil nasa school na ulit ako :)Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi debitis nam placeat, a tempore. Nobis, eligendi quis aliquid. Illum esse mollitia, vero deleniti eligendi minima a laboriosam! Illo, cumque dolores.', 1, '2017-07-25 04:41:14', '2017-07-25 04:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` int(11) NOT NULL,
  `last_name` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`post_slug`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
