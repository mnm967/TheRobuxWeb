-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2020 at 11:41 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `therobux`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE `adminusers` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`id`, `email`, `password`) VALUES
(1, 'admin@therobux.com', '0fe382b687ec622b53be7919604cd847');

-- --------------------------------------------------------

--
-- Table structure for table `admin_earnings`
--

CREATE TABLE `admin_earnings` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `earnId` int(11) NOT NULL,
  `offerwallName` varchar(75) NOT NULL,
  `amount` double NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `currentRobuxStock` int(11) NOT NULL,
  `robuxGroupId` int(11) NOT NULL,
  `cookie` text NOT NULL,
  `isAdgateAvailable` tinyint(1) NOT NULL,
  `isOffertoroAvailable` tinyint(1) NOT NULL,
  `isWannadsAvailable` tinyint(1) NOT NULL,
  `isOffertoroAltAvailable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `currentRobuxStock`, `robuxGroupId`, `cookie`, `isAdgateAvailable`, `isOffertoroAvailable`, `isWannadsAvailable`, `isOffertoroAltAvailable`) VALUES
(1, 1675, 4962734, '_|WARNING:-DO-NOT-SHARE-THIS.--Sharing-this-will-allow-someone-to-log-in-as-you-and-to-steal-your-ROBUX-and-items.|_941BE35055432FAEEAC145C8895D2AD9F8EA896379A9908EF308DC924780914C478F054AD8883E5912F5E6B249D4D6EBEE993D51C75EB5331A230F97521B3247E60254CC96722A493E25242D1A6957355C13B6C7061127DBB9B98F50159822D354AABE320B93A66D1DB5D6D6F2A8BCB838726B3666DAB19C0F81CB069993A28BBDBA38683D692B9C3C103B95951724F367FB41EABE287C92C91865F1BD11EBC83A1B02DA8F5ADAD75BA0DF2887CB770CB066C42682462B25A0C9CFA7B096528CCFB11497B408AEAE668AD600740BD70C028E34381F38C83AEFCB003E0CDC3FFE9C9C00AB66DD6B56E003251A0B2DCA2D5C0945D34D9E7E4E774F1C7EDFE903FA9113D82A8A3282F0724AC7134B9F73805BFF5B0E599CA5B903C579B2F084AE666703311A1A6AE319EC7CF7B1491E167BA42ECA80', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `earnings_history`
--

CREATE TABLE `earnings_history` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `offerwallName` varchar(75) NOT NULL,
  `amountEarned` int(11) NOT NULL,
  `earnedDate` datetime NOT NULL DEFAULT current_timestamp(),
  `offerId` int(11) NOT NULL,
  `ipAddress` varchar(50) NOT NULL,
  `isUserAlerted` tinyint(1) NOT NULL DEFAULT 0,
  `transactionId` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `referrerUserId` int(11) NOT NULL,
  `referredUserId` int(11) NOT NULL,
  `referralDate` datetime NOT NULL DEFAULT current_timestamp(),
  `isPaid` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(75) NOT NULL,
  `username` varchar(75) NOT NULL,
  `ipAddress` varchar(75) NOT NULL,
  `signupDate` datetime NOT NULL DEFAULT current_timestamp(),
  `currentPoints` bigint(20) NOT NULL DEFAULT 0,
  `totalPointsEarned` bigint(20) NOT NULL DEFAULT 0,
  `totalOffersCompleted` bigint(20) NOT NULL DEFAULT 0,
  `isBanned` tinyint(1) NOT NULL DEFAULT 0,
  `bannedReason` text NOT NULL,
  `referralCount` bigint(20) NOT NULL DEFAULT 0,
  `isSteamConnected` tinyint(1) NOT NULL DEFAULT 0,
  `isGoogleConnected` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(75) NOT NULL,
  `google_oauth_id` varchar(75) NOT NULL,
  `steam_oauth_id` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_reset_tokens`
--

CREATE TABLE `user_reset_tokens` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `token_code` text NOT NULL,
  `token_email` text NOT NULL,
  `token_date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawls`
--

CREATE TABLE `withdrawls` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `robuxUsername` varchar(80) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminusers`
--
ALTER TABLE `adminusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_earnings`
--
ALTER TABLE `admin_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings_history`
--
ALTER TABLE `earnings_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reset_tokens`
--
ALTER TABLE `user_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawls`
--
ALTER TABLE `withdrawls`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminusers`
--
ALTER TABLE `adminusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_earnings`
--
ALTER TABLE `admin_earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `earnings_history`
--
ALTER TABLE `earnings_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_reset_tokens`
--
ALTER TABLE `user_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawls`
--
ALTER TABLE `withdrawls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
