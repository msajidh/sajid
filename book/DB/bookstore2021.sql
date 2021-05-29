-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 24, 2021 at 12:39 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secondName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookauthors`
--

CREATE TABLE `bookauthors` (
  `bookId` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `authorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookdiscounts`
--

CREATE TABLE `bookdiscounts` (
  `bookId` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `discountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookgenre`
--

CREATE TABLE `bookgenre` (
  `bookId` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `genreId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `categoryId` int(11) NOT NULL,
  `previewLink` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publicationDate` date DEFAULT NULL,
  `edition` int(2) DEFAULT NULL,
  `publisherId` int(11) NOT NULL,
  `displayImage` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `customerId` int(11) NOT NULL,
  `bookId` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customerdiscounts`
--

CREATE TABLE `customerdiscounts` (
  `customerId` int(11) NOT NULL,
  `discountId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postalCode` int(6) DEFAULT NULL,
  `street` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addessLine1` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressLine2` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `passwordencrypted` varchar(42) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `emailVerified` tinyint(1) NOT NULL DEFAULT '0',
  `phoneVerified` tinyint(1) NOT NULL DEFAULT '0',
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastOnline` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `referralCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `referredBy` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dataStoragePermission` tinyint(1) NOT NULL DEFAULT '0',
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` float DEFAULT NULL,
  `maxDiscount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guestcart`
--

CREATE TABLE `guestcart` (
  `sessionId` int(11) NOT NULL,
  `bookId` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '1',
  `bookId` varchar(13) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `orderDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extraDetails` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `promoCode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paymentMethod` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalPrice` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `finalPrice` float DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `rating` float NOT NULL,
  `bookId` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `customerId` int(11) NOT NULL,
  `dateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `ratingId` int(11) NOT NULL,
  `review` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `customerId` int(11) NOT NULL,
  `bookId` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD KEY `authorId` (`bookId`,`authorId`);

--
-- Indexes for table `bookdiscounts`
--
ALTER TABLE `bookdiscounts`
  ADD KEY `bookId` (`bookId`),
  ADD KEY `discountId` (`discountId`);

--
-- Indexes for table `bookgenre`
--
ALTER TABLE `bookgenre`
  ADD KEY `bookId` (`bookId`),
  ADD KEY `genreId` (`genreId`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `publisherId` (`publisherId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`customerId`,`bookId`),
  ADD KEY `bookId` (`bookId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customerdiscounts`
--
ALTER TABLE `customerdiscounts`
  ADD KEY `discountId` (`discountId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guestcart`
--
ALTER TABLE `guestcart`
  ADD PRIMARY KEY (`sessionId`,`bookId`),
  ADD KEY `bookId` (`bookId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookId` (`bookId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `bookId` (`bookId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratingId` (`ratingId`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`customerId`,`bookId`),
  ADD KEY `bookId` (`bookId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookdiscounts`
--
ALTER TABLE `bookdiscounts`
  ADD CONSTRAINT `bookdiscounts_ibfk_1` FOREIGN KEY (`bookId`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `bookdiscounts_ibfk_2` FOREIGN KEY (`discountId`) REFERENCES `discounts` (`id`);

--
-- Constraints for table `bookgenre`
--
ALTER TABLE `bookgenre`
  ADD CONSTRAINT `bookgenre_ibfk_1` FOREIGN KEY (`bookId`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `bookgenre_ibfk_2` FOREIGN KEY (`genreId`) REFERENCES `genre` (`id`);

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `books_ibfk_3` FOREIGN KEY (`publisherId`) REFERENCES `publisher` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`bookId`) REFERENCES `books` (`isbn`);

--
-- Constraints for table `contactus`
--
ALTER TABLE `contactus`
  ADD CONSTRAINT `contactus_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`);
