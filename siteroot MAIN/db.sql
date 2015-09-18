-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2015 at 03:14 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `korfball_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `highscores`
--

CREATE TABLE `highscores` (
  `PK_Highscores` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `score` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `authentication` text NOT NULL,
  `archived_0active_1removed` tinyint(1) NOT NULL,
  `country` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`PK_Highscores`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `highscores`
--

INSERT INTO `highscores` (`PK_Highscores`, `name`, `score`, `added_on`, `updated_on`, `authentication`, `archived_0active_1removed`, `country`) VALUES
(2, 'Senne', 1923, '2015-03-02 00:00:00', '2015-03-02 00:00:00', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'Belgium'),
(3, 'Didier', 1101, '2015-03-02 00:00:00', '2015-03-02 00:11:00', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'South-Africa'),
(4, 'Ruben', 1000, '2015-03-02 00:00:00', '2015-03-02 00:10:00', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'Belgium'),
(40, 'Tine', 10, '2015-03-03 01:07:53', '2015-03-03 01:08:33', 'a13bb4a7210f2e721f99ca47dcbcf12996f8dc7571a967a81dbb5ec870450386760099d563c2bf59736488dd0b1b1f3c3650542811c70ec431ff05173de2fa09', 0, 'The Netherlands'),
(41, 'Tim', 30, '2015-03-03 19:49:43', '2015-03-03 19:49:43', '23dab83f841ac39ad6f74a92e7782f81867d060c1e18f0f2543ef15a4f8a3b1be74a9590ccd70b56cdf551e30ed4008a281bd02b1d02a5b647ffd66437a1712c', 0, 'Germany'),
(45, 'Jane', 1038, '2015-03-03 20:51:06', '2015-03-03 20:51:06', '183e2165b332ed5cf929f5f06ec1bcaf7810a558e9a95835907975247ceefadf8cf489a616ecbc171f9e73dd4a225a63bc78d059361ae3ec343ebcb07070023a', 0, 'China'),
(46, 'John', 1931, '2015-03-03 20:51:14', '2015-03-03 20:51:14', 'c566d49c4f51c0dc94da964c414b13bb3885a450a461f1e50e6f1b52e51f2d26319569a8733518e768d458e11680004d821babcbefd686e860aa85030db8fe05', 0, 'Poland'),
(47, 'Tom', 3723, '2015-03-03 20:51:29', '2015-03-03 20:51:34', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'Brazil'),
(48, 'Marie', 313, '2015-03-03 20:51:29', '2015-03-03 20:51:34', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'Australia'),
(49, 'Ellen', 1374, '2015-03-03 20:51:29', '2015-03-03 20:51:34', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'France'),
(50, 'Thomas', 1373, '2015-03-03 20:51:29', '2015-03-03 20:51:34', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'Czech Republic'),
(51, 'Jelle', 3764, '2015-03-03 20:51:29', '2015-03-03 20:51:34', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'France'),
(52, 'Wim', 1032, '2015-03-03 20:51:29', '2015-03-03 20:51:34', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'England'),
(53, 'Astrid', 1625, '2015-03-03 20:51:29', '2015-03-03 20:51:34', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'Catalonia'),
(54, 'George', 1893, '2015-03-03 20:51:29', '2015-03-03 20:51:34', '5c7da1349a44b6d81b555b9cae6fdfd2becff9e00bba862e61f16ebc5e74ddbc02dcd49bb95971fd24a857468154c8bd510555cfba92d29f0a70147225a4641e', 0, 'The Netherlands'),
(63, 'John', 900, '2015-03-04 02:28:06', '2015-03-04 02:28:06', '663b822ec288861ab9c2f1caaf6dfa8495ed2d505a947ae313d762156f16893c314ea13d6aa52a7aca8b20bd7b6e4a0ea18fdbc7c97b4f4a62c4584d39c98b69', 0, 'England');
