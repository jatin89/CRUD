-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 26, 2016 at 12:57 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `testDB`
--
CREATE DATABASE IF NOT EXISTS `testDB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `testDB`;

-- --------------------------------------------------------

--
-- Table structure for table `jqm_categories`
--

DROP TABLE IF EXISTS `jqm_categories`;
CREATE TABLE IF NOT EXISTS `jqm_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jqm_categories`
--

INSERT INTO `jqm_categories` (`id`, `name`) VALUES
(1, 'Notebooks'),
(2, 'Tablets'),
(3, 'Smartphones');

-- --------------------------------------------------------

--
-- Table structure for table `jqm_notebooks`
--

DROP TABLE IF EXISTS `jqm_notebooks`;
CREATE TABLE IF NOT EXISTS `jqm_notebooks` (
  `id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `price` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jqm_notebooks`
--

INSERT INTO `jqm_notebooks` (`id`, `category`, `name`, `manufacturer`, `price`) VALUES
(1, 'Notebooks', 'Macbook Pro', 'Apple', '2310'),
(2, 'Notebooks', 'HP HDX 1354 CA', 'HP', '1300');

-- --------------------------------------------------------

--
-- Table structure for table `jqm_smartphones`
--

DROP TABLE IF EXISTS `jqm_smartphones`;
CREATE TABLE IF NOT EXISTS `jqm_smartphones` (
  `id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `price` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jqm_smartphones`
--

INSERT INTO `jqm_smartphones` (`id`, `category`, `name`, `manufacturer`, `price`) VALUES
(1, 'Smartphones', 'iPhone 6', 'Apple', '599'),
(2, 'Smartphones', 'Xperia Arc', 'Sony', '599'),
(3, 'Smartphones', 'Nexus', 'Google', '299');

-- --------------------------------------------------------

--
-- Table structure for table `jqm_tablets`
--

DROP TABLE IF EXISTS `jqm_tablets`;
CREATE TABLE IF NOT EXISTS `jqm_tablets` (
  `id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `price` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jqm_tablets`
--

INSERT INTO `jqm_tablets` (`id`, `category`, `name`, `manufacturer`, `price`) VALUES
(1, 'Tablets', 'iPad 2', 'Apple', '499'),
(2, 'Tablets', 'Tab 2', 'Samsung', '180');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jqm_categories`
--
ALTER TABLE `jqm_categories`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `jqm_notebooks`
--
ALTER TABLE `jqm_notebooks`
  ADD PRIMARY KEY (`id`,`category`),
  ADD KEY `fk_cat1` (`category`);

--
-- Indexes for table `jqm_smartphones`
--
ALTER TABLE `jqm_smartphones`
  ADD PRIMARY KEY (`id`,`category`),
  ADD KEY `fk_cat2` (`category`);

--
-- Indexes for table `jqm_tablets`
--
ALTER TABLE `jqm_tablets`
  ADD PRIMARY KEY (`id`,`category`),
  ADD KEY `fk_cat3` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jqm_categories`
--
ALTER TABLE `jqm_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jqm_notebooks`
--
ALTER TABLE `jqm_notebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jqm_smartphones`
--
ALTER TABLE `jqm_smartphones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jqm_tablets`
--
ALTER TABLE `jqm_tablets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jqm_notebooks`
--
ALTER TABLE `jqm_notebooks`
  ADD CONSTRAINT `fk_cat1` FOREIGN KEY (`category`) REFERENCES `jqm_categories` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jqm_smartphones`
--
ALTER TABLE `jqm_smartphones`
  ADD CONSTRAINT `fk_cat2` FOREIGN KEY (`category`) REFERENCES `jqm_categories` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jqm_tablets`
--
ALTER TABLE `jqm_tablets`
  ADD CONSTRAINT `fk_cat3` FOREIGN KEY (`category`) REFERENCES `jqm_categories` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
