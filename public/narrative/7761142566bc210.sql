-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2020 at 07:59 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activitiesID` int(11) NOT NULL,
  `activitiescategoryID` int(11) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `time_to` varchar(40) DEFAULT NULL,
  `time_from` varchar(40) DEFAULT NULL,
  `time_at` varchar(40) DEFAULT NULL,
  `usertypeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activitiesID`, `activitiescategoryID`, `description`, `create_date`, `modify_date`, `time_to`, `time_from`, `time_at`, `usertypeID`, `userID`, `schoolyearID`) VALUES
(1, 1, 'Logo', '2019-08-08 09:06:44', '2019-08-08 09:06:44', '09:10:00', '09:10:00', '09:10:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `activitiescategory`
--

CREATE TABLE `activitiescategory` (
  `activitiescategoryID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fa_icon` varchar(40) DEFAULT NULL,
  `schoolyearID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activitiescomment`
--

CREATE TABLE `activitiescomment` (
  `activitiescommentID` int(11) NOT NULL,
  `activitiesID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activitiescomment`
--

INSERT INTO `activitiescomment` (`activitiescommentID`, `activitiesID`, `comment`, `schoolyearID`, `userID`, `usertypeID`, `create_date`) VALUES
(1, 1, 'test1 Namibia', 1, 1, 1, '2019-08-29 15:53:31'),
(2, 1, 'we will be the ', 1, 4, 3, '2019-08-29 17:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `activitiesmedia`
--

CREATE TABLE `activitiesmedia` (
  `activitiesmediaID` int(11) NOT NULL,
  `activitiesID` int(11) NOT NULL,
  `attachment` text NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activitiesmedia`
--

INSERT INTO `activitiesmedia` (`activitiesmediaID`, `activitiesID`, `attachment`, `create_date`) VALUES
(1, 1, 'logo.jpg', '2019-08-08 09:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `activitiesstudent`
--

CREATE TABLE `activitiesstudent` (
  `activitiesstudentID` int(11) NOT NULL,
  `activitiesID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `alert`
--

CREATE TABLE `alert` (
  `alertID` int(11) UNSIGNED NOT NULL,
  `itemID` int(128) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `itemname` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alert`
--

INSERT INTO `alert` (`alertID`, `itemID`, `userID`, `usertypeID`, `itemname`) VALUES
(1, 1, 1, 1, 'message'),
(2, 2, 1, 1, 'message'),
(3, 3, 1, 1, 'message'),
(4, 1, 1, 1, 'mark'),
(5, 2, 1, 1, 'mark'),
(6, 3, 1, 1, 'mark'),
(7, 4, 1, 1, 'mark'),
(8, 5, 1, 1, 'mark'),
(9, 6, 1, 1, 'mark'),
(10, 7, 1, 1, 'mark'),
(11, 8, 1, 1, 'mark'),
(12, 9, 1, 1, 'mark'),
(13, 10, 1, 1, 'mark'),
(14, 11, 1, 1, 'mark'),
(15, 12, 1, 1, 'mark'),
(16, 13, 1, 1, 'mark'),
(17, 14, 1, 1, 'mark'),
(18, 15, 1, 1, 'mark'),
(19, 16, 1, 1, 'mark'),
(20, 17, 1, 1, 'mark'),
(21, 18, 1, 1, 'mark'),
(22, 19, 1, 1, 'mark'),
(23, 20, 1, 1, 'mark'),
(24, 21, 1, 1, 'mark'),
(25, 22, 1, 1, 'mark'),
(26, 23, 1, 1, 'mark'),
(27, 24, 1, 1, 'mark'),
(28, 25, 1, 1, 'mark'),
(29, 26, 1, 1, 'mark'),
(30, 27, 1, 1, 'mark'),
(31, 28, 1, 1, 'mark'),
(32, 29, 1, 1, 'mark'),
(33, 30, 1, 1, 'mark'),
(34, 31, 1, 1, 'mark'),
(35, 32, 1, 1, 'mark'),
(36, 33, 1, 1, 'mark'),
(37, 34, 1, 1, 'mark'),
(38, 35, 1, 1, 'mark'),
(39, 36, 1, 1, 'mark'),
(40, 37, 1, 1, 'mark'),
(41, 38, 1, 1, 'mark'),
(42, 39, 1, 1, 'mark'),
(43, 40, 1, 1, 'mark'),
(44, 41, 1, 1, 'mark'),
(45, 42, 1, 1, 'mark'),
(46, 43, 1, 1, 'mark'),
(47, 44, 1, 1, 'mark'),
(48, 45, 1, 1, 'mark'),
(49, 46, 1, 1, 'mark'),
(50, 47, 1, 1, 'mark'),
(51, 48, 1, 1, 'mark'),
(52, 49, 1, 1, 'mark'),
(53, 50, 1, 1, 'mark'),
(54, 51, 1, 1, 'mark'),
(55, 52, 1, 1, 'mark'),
(56, 53, 1, 1, 'mark'),
(57, 54, 1, 1, 'mark'),
(58, 55, 1, 1, 'mark'),
(59, 56, 1, 1, 'mark'),
(60, 57, 1, 1, 'mark'),
(61, 58, 1, 1, 'mark'),
(62, 59, 1, 1, 'mark'),
(63, 60, 1, 1, 'mark'),
(64, 61, 1, 1, 'mark'),
(65, 62, 1, 1, 'mark'),
(66, 63, 1, 1, 'mark'),
(67, 64, 1, 1, 'mark'),
(68, 65, 1, 1, 'mark'),
(69, 66, 1, 1, 'mark'),
(70, 67, 1, 1, 'mark'),
(71, 68, 1, 1, 'mark'),
(72, 69, 1, 1, 'mark'),
(73, 70, 1, 1, 'mark'),
(74, 71, 1, 1, 'mark'),
(75, 72, 1, 1, 'mark'),
(76, 73, 1, 1, 'mark'),
(77, 74, 1, 1, 'mark'),
(78, 75, 1, 1, 'mark'),
(79, 76, 1, 1, 'mark'),
(80, 77, 1, 1, 'mark'),
(81, 78, 1, 1, 'mark'),
(82, 79, 1, 1, 'mark'),
(83, 80, 1, 1, 'mark'),
(84, 81, 1, 1, 'mark'),
(85, 82, 1, 1, 'mark'),
(86, 83, 1, 1, 'mark'),
(87, 84, 1, 1, 'mark'),
(88, 85, 1, 1, 'mark'),
(89, 86, 1, 1, 'mark'),
(90, 87, 1, 1, 'mark'),
(91, 88, 1, 1, 'mark'),
(92, 89, 1, 1, 'mark'),
(93, 90, 1, 1, 'mark'),
(94, 91, 1, 1, 'mark'),
(95, 92, 1, 1, 'mark'),
(96, 93, 1, 1, 'mark'),
(97, 94, 1, 1, 'mark'),
(98, 95, 1, 1, 'mark'),
(99, 96, 1, 1, 'mark'),
(100, 97, 1, 1, 'mark'),
(101, 98, 1, 1, 'mark'),
(102, 99, 1, 1, 'mark'),
(103, 100, 1, 1, 'mark'),
(104, 101, 1, 1, 'mark'),
(105, 102, 1, 1, 'mark'),
(106, 103, 1, 1, 'mark'),
(107, 104, 1, 1, 'mark'),
(108, 105, 1, 1, 'mark'),
(109, 106, 1, 1, 'mark'),
(110, 107, 1, 1, 'mark'),
(111, 108, 1, 1, 'mark'),
(112, 109, 1, 1, 'mark'),
(113, 110, 1, 1, 'mark'),
(114, 111, 1, 1, 'mark'),
(115, 112, 1, 1, 'mark'),
(116, 113, 1, 1, 'mark'),
(117, 114, 1, 1, 'mark'),
(118, 115, 1, 1, 'mark'),
(119, 116, 1, 1, 'mark'),
(120, 117, 1, 1, 'mark'),
(121, 118, 1, 1, 'mark'),
(122, 119, 1, 1, 'mark'),
(123, 120, 1, 1, 'mark'),
(124, 121, 1, 1, 'mark'),
(125, 122, 1, 1, 'mark'),
(126, 123, 1, 1, 'mark'),
(127, 124, 1, 1, 'mark'),
(128, 125, 1, 1, 'mark'),
(129, 126, 1, 1, 'mark'),
(130, 127, 1, 1, 'mark'),
(131, 128, 1, 1, 'mark'),
(132, 129, 1, 1, 'mark'),
(133, 130, 1, 1, 'mark'),
(134, 131, 1, 1, 'mark'),
(135, 132, 1, 1, 'mark'),
(136, 133, 1, 1, 'mark'),
(137, 134, 1, 1, 'mark'),
(138, 135, 1, 1, 'mark'),
(139, 136, 1, 1, 'mark'),
(140, 137, 1, 1, 'mark'),
(141, 138, 1, 1, 'mark'),
(142, 139, 1, 1, 'mark'),
(143, 140, 1, 1, 'mark'),
(144, 141, 1, 1, 'mark'),
(145, 142, 1, 1, 'mark'),
(146, 143, 1, 1, 'mark'),
(147, 144, 1, 1, 'mark'),
(148, 145, 1, 1, 'mark'),
(149, 146, 1, 1, 'mark'),
(150, 147, 1, 1, 'mark'),
(151, 148, 1, 1, 'mark'),
(152, 149, 1, 1, 'mark'),
(153, 150, 1, 1, 'mark'),
(154, 151, 1, 1, 'mark'),
(155, 152, 1, 1, 'mark'),
(156, 153, 1, 1, 'mark'),
(157, 154, 1, 1, 'mark'),
(158, 155, 1, 1, 'mark'),
(159, 156, 1, 1, 'mark'),
(160, 157, 1, 1, 'mark'),
(161, 158, 1, 1, 'mark'),
(162, 159, 1, 1, 'mark'),
(163, 160, 1, 1, 'mark'),
(164, 161, 1, 1, 'mark'),
(165, 162, 1, 1, 'mark'),
(166, 163, 1, 1, 'mark'),
(167, 164, 1, 1, 'mark'),
(168, 165, 1, 1, 'mark'),
(169, 166, 1, 1, 'mark'),
(170, 167, 1, 1, 'mark'),
(171, 168, 1, 1, 'mark'),
(172, 169, 1, 1, 'mark'),
(173, 170, 1, 1, 'mark'),
(174, 171, 1, 1, 'mark'),
(175, 172, 1, 1, 'mark'),
(176, 173, 1, 1, 'mark'),
(177, 174, 1, 1, 'mark'),
(178, 175, 1, 1, 'mark'),
(179, 176, 1, 1, 'mark'),
(180, 177, 1, 1, 'mark'),
(181, 178, 1, 1, 'mark'),
(182, 179, 1, 1, 'mark'),
(183, 180, 1, 1, 'mark'),
(184, 181, 1, 1, 'mark'),
(185, 182, 1, 1, 'mark'),
(186, 183, 1, 1, 'mark'),
(187, 184, 1, 1, 'mark'),
(188, 185, 1, 1, 'mark'),
(189, 186, 1, 1, 'mark'),
(190, 187, 1, 1, 'mark'),
(191, 188, 1, 1, 'mark'),
(192, 189, 1, 1, 'mark'),
(193, 190, 1, 1, 'mark'),
(194, 191, 1, 1, 'mark'),
(195, 192, 1, 1, 'mark'),
(196, 193, 1, 1, 'mark'),
(197, 194, 1, 1, 'mark'),
(198, 195, 1, 1, 'mark'),
(199, 196, 1, 1, 'mark'),
(200, 197, 1, 1, 'mark'),
(201, 198, 1, 1, 'mark'),
(202, 199, 1, 1, 'mark'),
(203, 200, 1, 1, 'mark'),
(204, 201, 1, 1, 'mark'),
(205, 202, 1, 1, 'mark'),
(206, 203, 1, 1, 'mark'),
(207, 204, 1, 1, 'mark'),
(208, 205, 1, 1, 'mark'),
(209, 206, 1, 1, 'mark'),
(210, 207, 1, 1, 'mark'),
(211, 208, 1, 1, 'mark'),
(212, 209, 1, 1, 'mark'),
(213, 210, 1, 1, 'mark'),
(214, 211, 1, 1, 'mark'),
(215, 212, 1, 1, 'mark'),
(216, 213, 1, 1, 'mark'),
(217, 214, 1, 1, 'mark'),
(218, 215, 1, 1, 'mark'),
(219, 216, 1, 1, 'mark'),
(220, 217, 1, 1, 'mark'),
(221, 218, 1, 1, 'mark'),
(222, 219, 1, 1, 'mark'),
(223, 220, 1, 1, 'mark'),
(224, 221, 1, 1, 'mark'),
(225, 222, 1, 1, 'mark'),
(226, 223, 1, 1, 'mark'),
(227, 224, 1, 1, 'mark'),
(228, 225, 1, 1, 'mark'),
(229, 226, 1, 1, 'mark'),
(230, 227, 1, 1, 'mark'),
(231, 228, 1, 1, 'mark'),
(232, 229, 1, 1, 'mark'),
(233, 230, 1, 1, 'mark'),
(234, 231, 1, 1, 'mark'),
(235, 232, 1, 1, 'mark'),
(236, 233, 1, 1, 'mark'),
(237, 234, 1, 1, 'mark'),
(238, 235, 1, 1, 'mark'),
(239, 236, 1, 1, 'mark'),
(240, 237, 1, 1, 'mark'),
(241, 238, 1, 1, 'mark'),
(242, 239, 1, 1, 'mark'),
(243, 240, 1, 1, 'mark'),
(244, 241, 1, 1, 'mark'),
(245, 242, 1, 1, 'mark'),
(246, 243, 1, 1, 'mark'),
(247, 244, 1, 1, 'mark'),
(248, 245, 1, 1, 'mark'),
(249, 246, 1, 1, 'mark'),
(250, 247, 1, 1, 'mark'),
(251, 248, 1, 1, 'mark'),
(252, 249, 1, 1, 'mark'),
(253, 250, 1, 1, 'mark'),
(254, 251, 1, 1, 'mark'),
(255, 252, 1, 1, 'mark'),
(256, 253, 1, 1, 'mark'),
(257, 254, 1, 1, 'mark'),
(258, 255, 1, 1, 'mark'),
(259, 256, 1, 1, 'mark'),
(260, 257, 1, 1, 'mark'),
(261, 258, 1, 1, 'mark'),
(262, 259, 1, 1, 'mark'),
(263, 260, 1, 1, 'mark'),
(264, 261, 1, 1, 'mark'),
(265, 262, 1, 1, 'mark'),
(266, 263, 1, 1, 'mark'),
(267, 264, 1, 1, 'mark'),
(268, 265, 1, 1, 'mark'),
(269, 266, 1, 1, 'mark'),
(270, 267, 1, 1, 'mark'),
(271, 268, 1, 1, 'mark'),
(272, 269, 1, 1, 'mark'),
(273, 270, 1, 1, 'mark'),
(274, 271, 1, 1, 'mark'),
(275, 272, 1, 1, 'mark'),
(276, 273, 1, 1, 'mark'),
(277, 274, 1, 1, 'mark'),
(278, 275, 1, 1, 'mark'),
(279, 276, 1, 1, 'mark'),
(280, 277, 1, 1, 'mark'),
(281, 278, 1, 1, 'mark'),
(282, 279, 1, 1, 'mark'),
(283, 280, 1, 1, 'mark'),
(284, 281, 1, 1, 'mark'),
(285, 282, 1, 1, 'mark'),
(286, 283, 1, 1, 'mark'),
(287, 284, 1, 1, 'mark'),
(288, 285, 1, 1, 'mark'),
(289, 286, 1, 1, 'mark'),
(290, 287, 1, 1, 'mark'),
(291, 288, 1, 1, 'mark'),
(292, 289, 1, 1, 'mark'),
(293, 290, 1, 1, 'mark'),
(294, 291, 1, 1, 'mark'),
(295, 292, 1, 1, 'mark'),
(296, 293, 1, 1, 'mark'),
(297, 294, 1, 1, 'mark'),
(298, 295, 1, 1, 'mark'),
(299, 296, 1, 1, 'mark'),
(300, 297, 1, 1, 'mark'),
(301, 298, 1, 1, 'mark'),
(302, 299, 1, 1, 'mark'),
(303, 300, 1, 1, 'mark'),
(304, 301, 1, 1, 'mark'),
(305, 302, 1, 1, 'mark'),
(306, 303, 1, 1, 'mark'),
(307, 304, 1, 1, 'mark'),
(308, 305, 1, 1, 'mark'),
(309, 306, 1, 1, 'mark'),
(310, 307, 1, 1, 'mark'),
(311, 308, 1, 1, 'mark'),
(312, 309, 1, 1, 'mark'),
(313, 310, 1, 1, 'mark'),
(314, 311, 1, 1, 'mark'),
(315, 312, 1, 1, 'mark'),
(316, 313, 1, 1, 'mark'),
(317, 314, 1, 1, 'mark'),
(318, 315, 1, 1, 'mark'),
(319, 316, 1, 1, 'mark'),
(320, 317, 1, 1, 'mark'),
(321, 318, 1, 1, 'mark'),
(322, 319, 1, 1, 'mark'),
(323, 320, 1, 1, 'mark'),
(324, 321, 1, 1, 'mark'),
(325, 322, 1, 1, 'mark'),
(326, 323, 1, 1, 'mark'),
(327, 324, 1, 1, 'mark'),
(328, 325, 1, 1, 'mark'),
(329, 326, 1, 1, 'mark'),
(330, 327, 1, 1, 'mark'),
(331, 328, 1, 1, 'mark'),
(332, 329, 1, 1, 'mark'),
(333, 330, 1, 1, 'mark'),
(334, 331, 1, 1, 'mark'),
(335, 332, 1, 1, 'mark'),
(336, 333, 1, 1, 'mark'),
(337, 334, 1, 1, 'mark'),
(338, 335, 1, 1, 'mark'),
(339, 336, 1, 1, 'mark'),
(340, 337, 1, 1, 'mark'),
(341, 338, 1, 1, 'mark'),
(342, 339, 1, 1, 'mark'),
(343, 340, 1, 1, 'mark'),
(344, 341, 1, 1, 'mark'),
(345, 342, 1, 1, 'mark'),
(346, 343, 1, 1, 'mark'),
(347, 344, 1, 1, 'mark'),
(348, 345, 1, 1, 'mark'),
(349, 346, 1, 1, 'mark'),
(350, 347, 1, 1, 'mark'),
(351, 348, 1, 1, 'mark'),
(352, 349, 1, 1, 'mark'),
(353, 350, 1, 1, 'mark'),
(354, 1, 1, 1, 'event'),
(355, 351, 1, 1, 'mark'),
(356, 352, 1, 1, 'mark'),
(357, 353, 1, 1, 'mark'),
(358, 354, 1, 1, 'mark'),
(359, 355, 1, 1, 'mark'),
(360, 356, 1, 1, 'mark'),
(361, 357, 1, 1, 'mark'),
(362, 358, 1, 1, 'mark'),
(363, 359, 1, 1, 'mark'),
(364, 360, 1, 1, 'mark'),
(365, 361, 1, 1, 'mark'),
(366, 362, 1, 1, 'mark'),
(367, 363, 1, 1, 'mark'),
(368, 364, 1, 1, 'mark'),
(369, 365, 1, 1, 'mark'),
(370, 366, 1, 1, 'mark'),
(371, 367, 1, 1, 'mark'),
(372, 368, 1, 1, 'mark'),
(373, 369, 1, 1, 'mark'),
(374, 370, 1, 1, 'mark'),
(375, 371, 1, 1, 'mark'),
(376, 372, 1, 1, 'mark'),
(377, 373, 1, 1, 'mark'),
(378, 374, 1, 1, 'mark'),
(379, 375, 1, 1, 'mark'),
(380, 376, 1, 1, 'mark'),
(381, 377, 1, 1, 'mark'),
(382, 378, 1, 1, 'mark'),
(383, 379, 1, 1, 'mark'),
(384, 380, 1, 1, 'mark'),
(385, 381, 1, 1, 'mark'),
(386, 382, 1, 1, 'mark'),
(387, 383, 1, 1, 'mark'),
(388, 384, 1, 1, 'mark'),
(389, 385, 1, 1, 'mark'),
(390, 386, 1, 1, 'mark'),
(391, 387, 1, 1, 'mark'),
(392, 388, 1, 1, 'mark'),
(393, 389, 1, 1, 'mark'),
(394, 390, 1, 1, 'mark'),
(395, 391, 1, 1, 'mark'),
(396, 392, 1, 1, 'mark'),
(397, 393, 1, 1, 'mark'),
(398, 394, 1, 1, 'mark'),
(399, 395, 1, 1, 'mark'),
(400, 396, 1, 1, 'mark'),
(401, 397, 1, 1, 'mark'),
(402, 398, 1, 1, 'mark'),
(403, 399, 1, 1, 'mark'),
(404, 400, 1, 1, 'mark'),
(405, 4, 1, 1, 'message'),
(406, 401, 1, 1, 'mark'),
(407, 402, 1, 1, 'mark'),
(408, 403, 1, 1, 'mark'),
(409, 5, 1, 1, 'message'),
(410, 1, 1, 1, 'notice'),
(411, 2, 1, 1, 'event'),
(412, 1, 1, 1, 'holiday'),
(413, 1, 4, 3, 'notice'),
(414, 1, 4, 3, 'holiday'),
(415, 404, 1, 1, 'mark'),
(416, 6, 1, 1, 'message'),
(417, 2, 1, 1, 'notice'),
(418, 405, 1, 1, 'mark'),
(419, 406, 1, 1, 'mark'),
(420, 407, 1, 1, 'mark'),
(421, 408, 1, 1, 'mark'),
(422, 409, 1, 1, 'mark'),
(423, 410, 1, 1, 'mark'),
(424, 411, 1, 1, 'mark'),
(425, 412, 1, 1, 'mark'),
(426, 2, 2, 4, 'notice'),
(427, 2, 2, 4, 'event'),
(428, 1, 2, 4, 'notice'),
(429, 1, 2, 4, 'holiday'),
(430, 7, 1, 1, 'message'),
(431, 6, 10, 3, 'message'),
(432, 7, 10, 3, 'message'),
(433, 1, 10, 3, 'holiday'),
(434, 2, 10, 3, 'notice'),
(435, 2, 10, 3, 'event'),
(436, 1, 10, 3, 'notice'),
(437, 1, 11, 4, 'notice'),
(438, 1, 11, 4, 'holiday'),
(439, 2, 11, 4, 'notice'),
(440, 413, 1, 1, 'mark'),
(441, 414, 1, 1, 'mark'),
(442, 415, 1, 1, 'mark'),
(443, 8, 1, 1, 'message'),
(444, 9, 1, 1, 'message'),
(445, 2, 1, 1, 'holiday'),
(446, 416, 1, 1, 'mark'),
(447, 417, 1, 1, 'mark'),
(448, 3, 1, 1, 'event'),
(449, 418, 1, 1, 'mark'),
(450, 419, 1, 1, 'mark'),
(451, 420, 1, 1, 'mark'),
(452, 2, 4, 3, 'notice'),
(453, 2, 4, 3, 'holiday'),
(454, 3, 4, 3, 'event'),
(455, 421, 1, 1, 'mark'),
(456, 422, 1, 1, 'mark'),
(457, 423, 1, 1, 'mark'),
(458, 424, 1, 1, 'mark'),
(459, 425, 1, 1, 'mark'),
(460, 426, 1, 1, 'mark'),
(461, 427, 1, 1, 'mark'),
(462, 428, 1, 1, 'mark'),
(463, 429, 1, 1, 'mark'),
(464, 430, 1, 1, 'mark'),
(465, 431, 1, 1, 'mark'),
(466, 432, 1, 1, 'mark'),
(467, 433, 1, 1, 'mark'),
(468, 434, 1, 1, 'mark'),
(469, 435, 1, 1, 'mark'),
(470, 436, 1, 1, 'mark'),
(471, 437, 1, 1, 'mark'),
(472, 438, 1, 1, 'mark'),
(473, 439, 1, 1, 'mark'),
(474, 440, 1, 1, 'mark'),
(475, 441, 1, 1, 'mark'),
(476, 442, 1, 1, 'mark'),
(477, 443, 1, 1, 'mark'),
(478, 444, 1, 1, 'mark'),
(479, 445, 1, 1, 'mark'),
(480, 446, 1, 1, 'mark'),
(481, 447, 1, 1, 'mark'),
(482, 448, 1, 1, 'mark'),
(483, 449, 1, 1, 'mark'),
(484, 450, 1, 1, 'mark'),
(485, 451, 1, 1, 'mark'),
(486, 452, 1, 1, 'mark'),
(487, 453, 1, 1, 'mark'),
(488, 454, 1, 1, 'mark'),
(489, 455, 1, 1, 'mark'),
(490, 1, 1, 1, 'mark'),
(491, 2, 1, 1, 'mark'),
(492, 3, 1, 1, 'mark'),
(493, 4, 1, 1, 'mark'),
(494, 5, 1, 1, 'mark'),
(495, 6, 1, 1, 'mark'),
(496, 7, 1, 1, 'mark'),
(497, 8, 1, 1, 'mark'),
(498, 9, 1, 1, 'mark'),
(499, 10, 1, 1, 'mark'),
(500, 11, 1, 1, 'mark'),
(501, 12, 1, 1, 'mark'),
(502, 13, 1, 1, 'mark'),
(503, 14, 1, 1, 'mark'),
(504, 15, 1, 1, 'mark'),
(505, 16, 1, 1, 'mark'),
(506, 17, 1, 1, 'mark'),
(507, 18, 1, 1, 'mark'),
(508, 19, 1, 1, 'mark'),
(509, 20, 1, 1, 'mark'),
(510, 10, 1, 1, 'message'),
(511, 11, 1, 1, 'message'),
(512, 3, 1, 1, 'holiday'),
(513, 21, 1, 1, 'mark'),
(514, 22, 1, 1, 'mark'),
(515, 1, 36, 2, 'notice'),
(516, 3, 4, 3, 'holiday'),
(517, 5, 4, 3, 'message'),
(518, 6, 4, 3, 'message'),
(519, 2, 4, 3, 'event'),
(520, 2, 9, 3, 'event'),
(521, 3, 9, 3, 'holiday'),
(522, 23, 1, 1, 'mark'),
(523, 2, 9, 3, 'notice'),
(524, 3, 9, 3, 'event'),
(525, 2, 9, 3, 'holiday'),
(526, 1, 9, 3, 'notice'),
(527, 1, 9, 3, 'holiday'),
(528, 24, 1, 1, 'mark'),
(529, 25, 1, 1, 'mark'),
(530, 26, 1, 1, 'mark');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `assetID` int(11) NOT NULL,
  `serial` varchar(255) DEFAULT NULL,
  `description` text COMMENT 'Title',
  `manufacturer` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `asset_number` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `asset_condition` int(11) DEFAULT NULL,
  `attachment` text,
  `originalfile` text,
  `asset_categoryID` int(11) DEFAULT NULL,
  `asset_locationID` int(11) DEFAULT NULL,
  `create_date` date NOT NULL,
  `modify_date` date NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`assetID`, `serial`, `description`, `manufacturer`, `brand`, `asset_number`, `status`, `asset_condition`, `attachment`, `originalfile`, `asset_categoryID`, `asset_locationID`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, '0123456789', 'Computer System - i7', NULL, NULL, NULL, 1, 1, '', '', 1, 2, '2019-11-10', '2019-11-10', 1, 1),
(2, '321', 'Dining Table', NULL, NULL, NULL, 2, 1, '', '', 2, 3, '2020-02-04', '2020-02-04', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `asset_assignment`
--

CREATE TABLE `asset_assignment` (
  `asset_assignmentID` int(11) NOT NULL,
  `assetID` int(11) NOT NULL COMMENT 'Description and title',
  `usertypeID` int(11) DEFAULT NULL,
  `check_out_to` int(11) NOT NULL,
  `due_date` date DEFAULT NULL,
  `note` text,
  `assigned_quantity` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `asset_locationID` int(11) DEFAULT NULL,
  `check_out_date` date DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `create_date` date NOT NULL,
  `modify_date` date NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asset_category`
--

CREATE TABLE `asset_category` (
  `asset_categoryID` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  `modify_date` date NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asset_category`
--

INSERT INTO `asset_category` (`asset_categoryID`, `category`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`, `active`) VALUES
(1, 'Computer', '2019-11-10', '2019-11-10', 1, 1, 1),
(2, 'Table', '2020-02-04', '2020-02-04', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignmentID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `deadlinedate` date NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `originalfile` text NOT NULL,
  `file` text NOT NULL,
  `classesID` longtext NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `sectionID` longtext,
  `subjectID` longtext,
  `assignusertypeID` int(11) DEFAULT NULL,
  `assignuserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignmentID`, `title`, `description`, `deadlinedate`, `usertypeID`, `userID`, `originalfile`, `file`, `classesID`, `schoolyearID`, `sectionID`, `subjectID`, `assignusertypeID`, `assignuserID`) VALUES
(1, 'Test', 'test', '2019-09-10', 1, 1, 'invoice#00006_overdue.pdf', '91ee286a2a67fabb0f9027cbcb41e22a8a2b1469b3a9b5662cdbbb271772424a4d17a421caef92a24fa87ff0e4a0ab7cfd427056673aef2d56d321c5f96f39a7.pdf', '12', 1, '[\"16\",\"17\"]', '4', 0, 0),
(2, '1st assignment', '1st assignment', '2019-11-29', 1, 1, '', '', '1', 1, '[\"8\"]', '33', 0, 0),
(3, 'group assignment', '1st group assignment', '2019-11-20', 1, 1, '', '', '1', 1, '[\"8\"]', '34', 0, 0),
(4, 'Caligraphi', 'write two pages of any urdu book', '2020-01-24', 1, 1, '', '', '19', 1, '[\"25\"]', '108', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assignmentanswer`
--

CREATE TABLE `assignmentanswer` (
  `assignmentanswerID` int(11) NOT NULL,
  `assignmentID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `uploaderID` int(11) NOT NULL,
  `uploadertypeID` int(11) NOT NULL,
  `answerfile` text NOT NULL,
  `answerfileoriginal` text NOT NULL,
  `answerdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(200) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertype` varchar(60) NOT NULL,
  `monthyear` varchar(10) NOT NULL,
  `a1` varchar(3) DEFAULT NULL,
  `a2` varchar(3) DEFAULT NULL,
  `a3` varchar(3) DEFAULT NULL,
  `a4` varchar(3) DEFAULT NULL,
  `a5` varchar(3) DEFAULT NULL,
  `a6` varchar(3) DEFAULT NULL,
  `a7` varchar(3) DEFAULT NULL,
  `a8` varchar(3) DEFAULT NULL,
  `a9` varchar(3) DEFAULT NULL,
  `a10` varchar(3) DEFAULT NULL,
  `a11` varchar(3) DEFAULT NULL,
  `a12` varchar(3) DEFAULT NULL,
  `a13` varchar(3) DEFAULT NULL,
  `a14` varchar(3) DEFAULT NULL,
  `a15` varchar(3) DEFAULT NULL,
  `a16` varchar(3) DEFAULT NULL,
  `a17` varchar(3) DEFAULT NULL,
  `a18` varchar(3) DEFAULT NULL,
  `a19` varchar(3) DEFAULT NULL,
  `a20` varchar(3) DEFAULT NULL,
  `a21` varchar(3) DEFAULT NULL,
  `a22` varchar(3) DEFAULT NULL,
  `a23` varchar(3) DEFAULT NULL,
  `a24` varchar(3) DEFAULT NULL,
  `a25` varchar(3) DEFAULT NULL,
  `a26` varchar(3) DEFAULT NULL,
  `a27` varchar(3) DEFAULT NULL,
  `a28` varchar(3) DEFAULT NULL,
  `a29` varchar(3) DEFAULT NULL,
  `a30` varchar(3) DEFAULT NULL,
  `a31` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `schoolyearID`, `studentID`, `classesID`, `sectionID`, `userID`, `usertype`, `monthyear`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `a13`, `a14`, `a15`, `a16`, `a17`, `a18`, `a19`, `a20`, `a21`, `a22`, `a23`, `a24`, `a25`, `a26`, `a27`, `a28`, `a29`, `a30`, `a31`) VALUES
(1, 1, 5, 4, 4, 1, 'Admin', '07-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 7, 4, 4, 1, 'Admin', '07-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 6, 4, 4, 1, 'Admin', '07-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 8, 4, 4, 1, 'Admin', '07-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 9, 4, 4, 1, 'Admin', '07-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 34, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 11, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 33, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 28, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 13, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 15, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 2, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 25, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 27, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 16, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, 30, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 45, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 24, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, 19, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, 42, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, 8, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 39, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, 21, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, 32, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, 12, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, 6, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, 22, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, 41, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 1, 7, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 1, 40, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 1, 20, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, 35, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 1, 3, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 1, 26, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 1, 5, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 1, 18, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 1, 17, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 1, 47, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 1, 44, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 1, 38, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 1, 31, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 1, 37, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 1, 43, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 1, 23, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 1, 14, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 1, 46, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 1, 4, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 1, 36, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 1, 10, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 1, 29, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 1, 9, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 1, 116, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 1, 117, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 1, 118, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 1, 119, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 1, 120, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 1, 121, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 1, 122, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 1, 123, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 1, 124, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 1, 125, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 1, 126, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 1, 127, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 1, 128, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 1, 129, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 1, 130, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 1, 131, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 1, 132, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 1, 133, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 1, 134, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 1, 135, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 1, 136, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 1, 137, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 1, 138, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 1, 139, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 1, 140, 12, 16, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 1, 356, 8, 15, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 1, 357, 8, 15, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 1, 358, 8, 15, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 1, 359, 8, 15, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 1, 360, 8, 15, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 1, 361, 8, 15, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 1, 362, 8, 15, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 1, 166, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 1, 167, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 1, 168, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 1, 169, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 1, 170, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 1, 171, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 1, 172, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 1, 173, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 1, 174, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 1, 175, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 1, 176, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 1, 177, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 1, 178, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 1, 179, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 1, 180, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 1, 181, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 1, 182, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, 1, 183, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, 1, 184, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 1, 185, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, 1, 186, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, 1, 187, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, 1, 188, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, 1, 189, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, 1, 190, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, 1, 191, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 1, 192, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, 1, 193, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 1, 194, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 1, 195, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, 1, 196, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 1, 197, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 1, 198, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, 1, 199, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, 1, 200, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 1, 201, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 1, 202, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 1, 203, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 1, 204, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 1, 205, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 1, 206, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 1, 207, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 1, 208, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 1, 209, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 1, 210, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 1, 211, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 1, 212, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 1, 213, 1, 8, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 1, 1, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 1, 7, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 1, 8, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 1, 6, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 1, 6, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 1, 5, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 1, 3, 2, 9, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 1, 10, 1, 8, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 1, 11, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 1, 12, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 1, 13, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 1, 18, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 1, 19, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 1, 21, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 1, 21, 12, 16, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(147, 1, 24, 12, 16, 1, 'Admin', '01-2020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 1, 1, 19, 25, 1, 'Admin', '02-2020', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 1, 2, 19, 25, 1, 'Admin', '02-2020', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 1, 3, 12, 16, 1, 'Admin', '02-2020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 1, 4, 1, 8, 1, 'Admin', '02-2020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL),
(152, 1, 5, 1, 8, 1, 'Admin', '02-2020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL),
(153, 1, 4, 1, 8, 1, 'Admin', '03-2020', NULL, 'P', NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 1, 5, 1, 8, 1, 'Admin', '03-2020', NULL, 'P', NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 1, 3, 12, 16, 1, 'Admin', '04-2020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `automation_rec`
--

CREATE TABLE `automation_rec` (
  `automation_recID` int(11) UNSIGNED NOT NULL,
  `studentID` int(11) NOT NULL,
  `date` date NOT NULL,
  `day` varchar(3) NOT NULL,
  `month` varchar(3) NOT NULL,
  `year` year(4) NOT NULL,
  `nofmodule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `automation_shudulu`
--

CREATE TABLE `automation_shudulu` (
  `automation_shuduluID` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `day` varchar(3) NOT NULL,
  `month` varchar(3) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `automation_shudulu`
--

INSERT INTO `automation_shudulu` (`automation_shuduluID`, `date`, `day`, `month`, `year`) VALUES
(1, '2019-07-04', '04', '07', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookID` int(11) UNSIGNED NOT NULL,
  `book` varchar(60) NOT NULL,
  `subject_code` tinytext NOT NULL,
  `author` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `due_quantity` int(11) NOT NULL,
  `rack` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookID`, `book`, `subject_code`, `author`, `price`, `quantity`, `due_quantity`, `rack`) VALUES
(1, 'TestBook', '232323', 'Trev', 4, 2, 0, '123'),
(2, 'New test book', 'cc', 'test user', 111, 2, 2, '2'),
(3, '1st edition khs', '1st', '1st', 0, 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) UNSIGNED NOT NULL,
  `hostelID` int(11) NOT NULL,
  `class_type` varchar(60) NOT NULL,
  `hbalance` varchar(20) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `hostelID`, `class_type`, `hbalance`, `note`) VALUES
(1, 1, 'jkjkjkj', '1000', '');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_template`
--

CREATE TABLE `certificate_template` (
  `certificate_templateID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `theme` int(11) NOT NULL,
  `top_heading_title` text,
  `top_heading_left` text,
  `top_heading_right` text,
  `top_heading_middle` text,
  `main_middle_text` text NOT NULL,
  `template` text NOT NULL,
  `footer_left_text` text,
  `footer_right_text` text,
  `footer_middle_text` text,
  `background_image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certificate_template`
--

INSERT INTO `certificate_template` (`certificate_templateID`, `usertypeID`, `name`, `theme`, `top_heading_title`, `top_heading_left`, `top_heading_right`, `top_heading_middle`, `main_middle_text`, `template`, `footer_left_text`, `footer_right_text`, `footer_middle_text`, `background_image`) VALUES
(1, 3, 'English', 1, 'Test2', 'Test3', 'Test5', 'Test4', 'Test1', 'Test6', '', '', '', '3f641bb6e54bc0f0e893c5ed7fa9875a3f5879449d77ab8df204fd85c4b218457dc453973e411c9a7e85a3adfcbd7a961f4b8ec7ce501a5464de52c63f4f5c0a.jpg'),
(2, 3, 'sadi', 1, 'jijm', ';lo', 'hfhfh', 'vhf', 'nuibnk', 'fhfh', 'fhfh', '', '', 'certificate-default.jpg'),
(3, 3, 'Tanzeel ru rehman', 1, 'Qila Didar Singh', 'School Management System', 'Pakistan', 'Goshi', 'Pakistan Zinda bad', 'Oye H0oy', 'Footger Left Text', 'Footer Right Text[Hello]', 'Middle Textg', '628dfd550953638b2c9d424d1177aa65649e8f0d4ee7b4ed75718c1bf4d43b52bef2b0989fd4bfd28ca516387ca2f11976190ec3b22709d443b50b7b994304f0.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `childcare`
--

CREATE TABLE `childcare` (
  `childcareID` int(11) NOT NULL,
  `dropped_at` datetime DEFAULT NULL,
  `received_at` datetime DEFAULT NULL,
  `usertypeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `parentID` int(11) NOT NULL,
  `signature` text,
  `classesID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `comment` text,
  `received_status` int(11) NOT NULL DEFAULT '0',
  `receiver_name` varchar(40) NOT NULL,
  `phone` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classesID` int(11) UNSIGNED NOT NULL,
  `classes` varchar(60) NOT NULL,
  `classes_numeric` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `studentmaxID` int(11) DEFAULT NULL,
  `note` text,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classesID`, `classes`, `classes_numeric`, `teacherID`, `studentmaxID`, `note`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(1, 'II', 2, 1, 999999999, '', '2019-08-01 11:35:29', '2019-08-01 11:35:29', 1, 'ctech', 'Admin'),
(2, 'III', 3, 1, 999999999, '', '2019-08-01 11:35:46', '2019-08-01 11:35:46', 1, 'ctech', 'Admin'),
(3, 'IV', 4, 1, 999999999, '', '2019-08-01 11:36:18', '2019-08-01 11:36:18', 1, 'ctech', 'Admin'),
(4, 'V', 5, 1, 999999999, '', '2019-08-01 11:36:50', '2019-08-01 11:36:50', 1, 'ctech', 'Admin'),
(5, 'VI', 6, 1, 999999999, '', '2019-08-01 11:37:06', '2019-08-01 11:37:06', 1, 'ctech', 'Admin'),
(6, 'VII', 7, 27, 999999999, '', '2019-08-01 11:37:28', '2019-08-29 03:08:55', 1, 'ctech', 'Admin'),
(7, 'VIII', 8, 1, 999999999, '', '2019-08-01 11:37:48', '2019-08-01 11:37:48', 1, 'ctech', 'Admin'),
(8, 'IX', 9, 1, 999999999, '', '2019-08-01 11:38:11', '2019-08-01 11:38:11', 1, 'ctech', 'Admin'),
(10, 'K.G.II', 10, 1, 999999999, '', '2019-08-01 11:40:35', '2019-08-05 08:57:32', 1, 'ctech', 'Admin'),
(11, 'Nursery', 11, 28, 999999999, '', '2019-08-01 11:40:54', '2019-11-10 10:43:25', 1, 'ctech', 'Admin'),
(12, 'I', 1, 26, 999999999, '', '2019-08-01 11:41:24', '2019-08-29 03:09:12', 1, 'ctech', 'Admin'),
(13, 'Montessori', 12, 1, 999999999, '', '2019-08-01 11:41:51', '2019-08-01 11:41:51', 1, 'ctech', 'Admin'),
(14, 'KG-1', 15, 1, 999999999, '', '2019-08-03 12:07:24', '2019-08-05 10:10:11', 1, 'ctech', 'Admin'),
(15, 'Coaching', 16, 20, 999999999, '', '2019-08-05 09:55:31', '2019-08-05 10:09:39', 1, 'ctech', 'Admin'),
(16, 'Basic 2', 20, 26, 999999999, 'Allamandas', '2019-08-27 10:09:08', '2019-08-27 10:09:08', 1, 'ctech', 'Admin'),
(17, 'Анги', 99, 28, 999999999, 'Анги 99', '2019-11-10 02:24:30', '2019-11-10 02:24:30', 1, 'ctech', 'Admin'),
(18, '11th', 123, 29, 999999999, '', '2019-12-08 08:06:39', '2019-12-08 08:06:39', 1, 'ctech', 'Admin'),
(19, 'Prep', 21, 31, 999999999, '', '2020-01-23 09:15:05', '2020-01-23 09:15:05', 1, 'ctech', 'Admin'),
(20, '3', 31, 37, 999999999, '', '2020-04-13 04:44:03', '2020-04-13 04:44:03', 1, 'ctech', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `complainID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `schoolyearID` int(11) DEFAULT NULL,
  `description` text,
  `attachment` text,
  `originalfile` text,
  `create_userID` int(11) NOT NULL DEFAULT '0',
  `create_usertypeID` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complainID`, `title`, `usertypeID`, `userID`, `schoolyearID`, `description`, `attachment`, `originalfile`, `create_userID`, `create_usertypeID`, `create_date`, `modify_date`) VALUES
(1, 'Student home work', 2, 0, 1, 'this complain regartding for the student homework', NULL, NULL, 1, 1, '2019-10-21 13:24:39', '2019-10-21 13:24:39'),
(2, 'Hello', 3, 0, 1, 'Complaint', NULL, NULL, 1, 1, '2019-11-06 14:46:23', '2019-11-06 14:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `conversation_message_info`
--

CREATE TABLE `conversation_message_info` (
  `id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `draft` int(11) DEFAULT '0',
  `fav_status` int(11) DEFAULT '0',
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation_message_info`
--

INSERT INTO `conversation_message_info` (`id`, `status`, `draft`, `fav_status`, `create_date`, `modify_date`) VALUES
(1, 0, 0, 0, '2019-07-04 22:45:50', '2019-07-04 22:45:50'),
(2, 0, 0, 0, '2019-07-04 22:47:21', '2019-07-04 22:47:21'),
(3, 0, 0, 0, '2019-07-04 22:48:21', '2019-07-04 22:48:21'),
(4, 0, 0, 0, '2019-08-27 18:23:35', '2019-08-27 18:23:35'),
(5, 0, 0, 0, '2019-08-29 15:40:46', '2019-08-29 15:40:46'),
(6, 0, 0, 0, '2019-11-14 14:13:40', '2019-11-14 14:13:40'),
(7, 0, 0, 0, '2020-02-04 17:11:50', '2020-02-04 17:11:50'),
(8, 0, 0, 0, '2020-03-04 16:29:28', '2020-03-04 16:29:28'),
(9, 0, 0, 0, '2020-03-04 16:29:31', '2020-03-04 16:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `conversation_msg`
--

CREATE TABLE `conversation_msg` (
  `msg_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `msg` text NOT NULL,
  `attach` text,
  `attach_file_name` text,
  `usertypeID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `start` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation_msg`
--

INSERT INTO `conversation_msg` (`msg_id`, `conversation_id`, `user_id`, `subject`, `msg`, `attach`, `attach_file_name`, `usertypeID`, `create_date`, `modify_date`, `start`) VALUES
(1, 1, 1, 'Trial Email', 'This is first Trial Email Sent to Admin | Noman Ahmed.', NULL, NULL, 1, '2019-07-04 22:45:50', '2019-07-04 22:45:50', 1),
(2, 2, 1, 'Trial Email 2', 'This is trial email sent to Admin | Noman Ahmed', NULL, NULL, 1, '2019-07-04 22:47:21', '2019-07-04 22:47:21', 1),
(3, 3, 1, 'Trial Email 3', 'This is email sent to admin superadmin.', NULL, NULL, 1, '2019-07-04 22:48:21', '2019-07-04 22:48:21', 1),
(4, 4, 1, 'Test', 'This is a test', NULL, NULL, 1, '2019-08-27 18:23:35', '2019-08-27 18:23:35', 1),
(5, 5, 1, 'test', 'test', NULL, NULL, 1, '2019-08-29 15:40:46', '2019-08-29 15:40:46', 1),
(6, 5, 1, NULL, 'dgdgd', NULL, NULL, 1, '2019-11-01 16:25:45', '2019-11-01 16:25:45', NULL),
(7, 6, 1, 'gghhghgh', 'hghghhgh', NULL, NULL, 1, '2019-11-14 14:13:40', '2019-11-14 14:13:40', 1),
(8, 7, 1, 'helloo', 'pakistan zinda bad', NULL, NULL, 1, '2020-02-04 17:11:50', '2020-02-04 17:11:50', 1),
(9, 7, 1, NULL, '', 'aik_hajj_aur_aik_umrah_ki_saadat.jpg', '5371634578592486979.jpg', 1, '2020-02-04 17:12:34', '2020-02-04 17:12:34', NULL),
(10, 8, 1, 'uyfytdt', 'gfghftrdfgxdtztz', NULL, NULL, 1, '2020-03-04 16:29:28', '2020-03-04 16:29:28', 1),
(11, 9, 1, 'uyfytdt', 'gfghftrdfgxdtztz', NULL, NULL, 1, '2020-03-04 16:29:31', '2020-03-04 16:29:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conversation_user`
--

CREATE TABLE `conversation_user` (
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `is_sender` int(11) DEFAULT '0',
  `trash` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation_user`
--

INSERT INTO `conversation_user` (`conversation_id`, `user_id`, `usertypeID`, `is_sender`, `trash`) VALUES
(1, 1, 1, 1, 2),
(1, 2, 1, 0, 0),
(2, 1, 1, 1, 2),
(2, 2, 1, 0, 0),
(3, 1, 1, 1, 2),
(3, 1, 1, 0, 2),
(4, 1, 1, 1, 1),
(4, 1, 3, 0, 0),
(4, 1, 3, 0, 0),
(5, 1, 1, 1, 1),
(5, 4, 3, 0, 0),
(5, 4, 3, 0, 0),
(6, 1, 1, 1, 1),
(6, 10, 3, 0, 0),
(6, 10, 3, 0, 0),
(7, 1, 1, 1, 1),
(7, 3, 3, 0, 0),
(8, 1, 1, 1, 1),
(8, 7, 4, 0, 0),
(8, 8, 4, 0, 0),
(8, 9, 4, 0, 0),
(8, 11, 4, 0, 0),
(8, 12, 4, 0, 0),
(9, 1, 1, 1, 1),
(9, 7, 4, 0, 0),
(9, 8, 4, 0, 0),
(9, 9, 4, 0, 0),
(9, 11, 4, 0, 0),
(9, 12, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `documentID` int(11) NOT NULL,
  `title` varchar(128) CHARACTER SET utf8 NOT NULL,
  `file` varchar(200) CHARACTER SET utf8 NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`documentID`, `title`, `file`, `userID`, `usertypeID`, `create_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 'School Management System', '', 2, 1, '2019-07-05 05:52:29', 1, 1),
(2, 'School Management System', '2e1779e8d56a2a44a629d80cdbac1aa82f4d90937d2b98b41d90eb8d2026c0a473329166854a0a8b0044327983164a6ee30ddf3e98832aca092470d1c69e3b21.pdf', 2, 1, '2019-07-05 05:52:32', 1, 1),
(3, 'Certificate', '29bd60d2b6e0935eaca27e508ad954b95f5fff67233af5d6118ec39a5c5f1437e67329d81c2c0be75bfb30799126d62bc48c0f589a7fc867ac85a78f5eba575c.docx', 1, 9, '2019-07-06 08:14:28', 1, 1),
(4, 'Certificate', 'd9910b946ccb953e3602745fe4323fd63401da67344410a35208ca82f0e7d39d9cf00f1dbb4e0601bf30be65ac060deee54d3590ea9389af1083105b48564b74.docx', 1, 3, '2019-07-06 08:15:13', 1, 1),
(5, 'vbj', '57af6da5a04eb9f8532c5943a272a348af4b3e759152732edf0f0a8910e3fe18aab5f6269f799cd7682abc8de98caa026d199e3d175f94dc164e2ac797320401.txt', 1, 4, '2019-08-27 22:39:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `eattendance`
--

CREATE TABLE `eattendance` (
  `eattendanceID` int(200) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `examID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `date` date NOT NULL,
  `studentID` int(11) DEFAULT NULL,
  `s_name` varchar(60) DEFAULT NULL,
  `eattendance` varchar(20) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `eextra` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eattendance`
--

INSERT INTO `eattendance` (`eattendanceID`, `schoolyearID`, `examID`, `classesID`, `sectionID`, `subjectID`, `date`, `studentID`, `s_name`, `eattendance`, `year`, `eextra`) VALUES
(1, 1, 1, 12, 16, 1, '2019-08-10', 116, 'Omer', NULL, 2019, NULL),
(2, 1, 1, 12, 16, 1, '2019-08-10', 117, 'Saffa', NULL, 2019, NULL),
(3, 1, 1, 12, 16, 1, '2019-08-10', 118, 'Shan', NULL, 2019, NULL),
(4, 1, 1, 12, 16, 1, '2019-08-10', 119, 'Asma', NULL, 2019, NULL),
(5, 1, 1, 12, 16, 1, '2019-08-10', 120, 'Iqra', NULL, 2019, NULL),
(6, 1, 1, 12, 16, 1, '2019-08-10', 121, 'Noor - Ul - Ain', NULL, 2019, NULL),
(7, 1, 1, 12, 16, 1, '2019-08-10', 122, 'Uzair', NULL, 2019, NULL),
(8, 1, 1, 12, 16, 1, '2019-08-10', 123, 'Huzaifa', NULL, 2019, NULL),
(9, 1, 1, 12, 16, 1, '2019-08-10', 124, 'Safia', NULL, 2019, NULL),
(10, 1, 1, 12, 16, 1, '2019-08-10', 125, 'Rehan', NULL, 2019, NULL),
(11, 1, 1, 12, 16, 1, '2019-08-10', 126, 'Muhammad Adeel', NULL, 2019, NULL),
(12, 1, 1, 12, 16, 1, '2019-08-10', 127, 'Aliha', NULL, 2019, NULL),
(13, 1, 1, 12, 16, 1, '2019-08-10', 128, 'Muhammad Bilal', NULL, 2019, NULL),
(14, 1, 1, 12, 16, 1, '2019-08-10', 129, 'Ahmed', NULL, 2019, NULL),
(15, 1, 1, 12, 16, 1, '2019-08-10', 130, 'Bisma', NULL, 2019, NULL),
(16, 1, 1, 12, 16, 1, '2019-08-10', 131, 'Junaid', NULL, 2019, NULL),
(17, 1, 1, 12, 16, 1, '2019-08-10', 132, 'Mursaleen', NULL, 2019, NULL),
(18, 1, 1, 12, 16, 1, '2019-08-10', 133, 'Sawira', NULL, 2019, NULL),
(19, 1, 1, 12, 16, 1, '2019-08-10', 134, 'Sameer', NULL, 2019, NULL),
(20, 1, 1, 12, 16, 1, '2019-08-10', 135, 'Dua  Noor', NULL, 2019, NULL),
(21, 1, 1, 12, 16, 1, '2019-08-10', 136, 'Afshan', NULL, 2019, NULL),
(22, 1, 1, 12, 16, 1, '2019-08-10', 137, 'Haris', NULL, 2019, NULL),
(23, 1, 1, 12, 16, 1, '2019-08-10', 138, 'Kashif  Mehmoud', NULL, 2019, NULL),
(24, 1, 1, 12, 16, 1, '2019-08-10', 139, 'Abdul  Hannan', NULL, 2019, NULL),
(25, 1, 1, 12, 16, 1, '2019-08-10', 140, 'Areeba Hanif', NULL, 2019, NULL),
(26, 1, 2, 12, 16, 1, '2019-11-25', 1, 'Kwesi Mampong', NULL, 2019, NULL),
(27, 1, 2, 12, 16, 1, '2019-11-25', 7, 'student', NULL, 2019, NULL),
(28, 1, 2, 12, 16, 1, '2019-11-25', 11, 'jalal', NULL, 2019, NULL),
(29, 1, 2, 12, 16, 1, '2019-11-25', 12, 'Zain', NULL, 2019, NULL),
(30, 1, 2, 12, 16, 1, '2019-11-25', 13, 'Zain', NULL, 2019, NULL),
(31, 1, 2, 12, 16, 1, '2019-11-25', 18, 'Zain', NULL, 2019, NULL),
(32, 1, 2, 12, 16, 1, '2019-11-25', 19, 'Zain', NULL, 2019, NULL),
(33, 1, 2, 12, 16, 1, '2019-11-25', 21, 'Zain', NULL, 2019, NULL),
(34, 1, 2, 12, 16, 1, '2019-11-25', 21, 'Zain', NULL, 2019, NULL),
(35, 1, 2, 12, 16, 1, '2019-11-25', 8, 'tt', NULL, 2019, NULL),
(36, 1, 2, 12, 16, 1, '2019-11-25', 6, 'STUDENT', NULL, 2019, NULL),
(37, 1, 2, 12, 16, 1, '2019-11-25', 6, 'STUDENT', NULL, 2019, NULL),
(38, 1, 2, 12, 16, 1, '2019-11-25', 5, 'lesly shu', NULL, 2019, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `ebooksID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 NOT NULL,
  `classesID` int(11) NOT NULL,
  `authority` tinyint(4) NOT NULL DEFAULT '0',
  `cover_photo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `file` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`ebooksID`, `name`, `author`, `classesID`, `authority`, `cover_photo`, `file`) VALUES
(1, 'test ebook 2', 'tset user', 1, 0, 'ca9d96cf79391e22f4e184746a0c036a185e05a2cac97f5a4fd948503e4b99902d3839af0f48988f20f89024037e9ffbb6b3d65b4f86d3e9b03461260c98dd0b.jpg', '7ea9db96d5b342cce23a635b13af26ef034706d536b81d1e01df870434d56158958b183d474ac7ab257c42e39e134ae2a6cadad0db1b3df147072f5e525f8858.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `emailsetting`
--

CREATE TABLE `emailsetting` (
  `fieldoption` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emailsetting`
--

INSERT INTO `emailsetting` (`fieldoption`, `value`) VALUES
('email_engine', 'sendmail'),
('smtp_password', ''),
('smtp_port', ''),
('smtp_security', ''),
('smtp_server', ''),
('smtp_username', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventID` int(11) UNSIGNED NOT NULL,
  `fdate` date NOT NULL,
  `ftime` time NOT NULL,
  `tdate` date NOT NULL,
  `ttime` time NOT NULL,
  `title` varchar(128) NOT NULL,
  `details` text NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `create_userID` int(11) NOT NULL DEFAULT '0',
  `create_usertypeID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `fdate`, `ftime`, `tdate`, `ttime`, `title`, `details`, `photo`, `create_date`, `schoolyearID`, `create_userID`, `create_usertypeID`) VALUES
(2, '2019-09-11', '00:00:00', '2019-10-13', '00:00:00', 'Exam', 'Exam', 'ddd14d2240be298f10428efa2bbfc11cd9fa9dd664f372fe4d318c002d3a88bc6453b0edae883c882d1dd98e06edcd4ce4899b5ba9b5e54d6e2999983dbe98aa.jpg', '2019-08-29 16:01:46', 1, 1, 1),
(3, '2020-02-12', '00:00:00', '2020-02-12', '23:59:00', 'Gala  Day', 'Students will come with fruits', '25fd7d6d68a70d43035766df6314656645f08c6977d0bc8d77e1142a98c05bcf7dc773e7c550bf444d37d725a8f88377a9d91dacd9492a65125e034d265434b3.jpg', '2020-02-12 10:55:45', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventcounter`
--

CREATE TABLE `eventcounter` (
  `eventcounterID` int(11) UNSIGNED NOT NULL,
  `eventID` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(128) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventcounter`
--

INSERT INTO `eventcounter` (`eventcounterID`, `eventID`, `username`, `type`, `name`, `photo`, `status`, `create_date`) VALUES
(1, 2, 'zoya', 'Student', 'goshi', 'default.png', 1, '2020-05-09 15:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `examID` int(11) UNSIGNED NOT NULL,
  `exam` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`examID`, `exam`, `date`, `note`) VALUES
(1, 'Mid Term', '2019-10-02', ''),
(2, 'Second Term', '2020-05-09', 'Must Appear'),
(3, 'Third Semester', '2020-06-08', ''),
(4, 'Quizz', '2020-07-09', 'online quizz demo');

-- --------------------------------------------------------

--
-- Table structure for table `examschedule`
--

CREATE TABLE `examschedule` (
  `examscheduleID` int(11) UNSIGNED NOT NULL,
  `examID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `edate` date NOT NULL,
  `examfrom` varchar(10) NOT NULL,
  `examto` varchar(10) NOT NULL,
  `room` tinytext,
  `schoolyearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `examschedule`
--

INSERT INTO `examschedule` (`examscheduleID`, `examID`, `classesID`, `sectionID`, `subjectID`, `edate`, `examfrom`, `examto`, `room`, `schoolyearID`) VALUES
(1, 1, 13, 19, 6, '2019-10-01', '8:15 PM', '9:30 PM', '9', 1),
(2, 1, 13, 19, 7, '2019-10-03', '8:15 PM', '9:30 AM', '9', 1),
(3, 1, 13, 19, 8, '2019-10-05', '8:15 AM', '9:30 AM', '9', 1),
(4, 1, 13, 19, 9, '2019-10-07', '8:15 AM', '9:30 AM', '9', 1),
(5, 1, 13, 19, 10, '2019-10-09', '8:15 AM', '9:30 AM', '9', 1),
(6, 1, 13, 19, 11, '2019-10-11', '8:15 AM', '9:30 AM', '9', 1),
(7, 1, 11, 22, 13, '2019-10-01', '8:15 AM', '9:30 AM', '', 1),
(8, 1, 11, 22, 15, '2019-10-03', '8:30 AM', '10:30 AM', '', 1),
(9, 1, 11, 22, 14, '2019-10-05', '8:30 AM', '10:30 AM', '8', 1),
(10, 1, 11, 22, 12, '2019-10-08', '8:30 AM', '9:30 AM', '8', 1),
(11, 1, 11, 22, 17, '2019-10-10', '8:30 AM', '8:30 AM', '8', 1),
(12, 1, 11, 22, 16, '2019-10-12', '8:15 AM', '10:30 AM', '8', 1),
(13, 1, 14, 24, 19, '2019-10-01', '8:15 AM', '10:30 AM', '3', 1),
(14, 1, 14, 24, 21, '2019-10-03', '8:30 AM', '9:30 AM', '3', 1),
(15, 1, 14, 24, 20, '2019-10-05', '8:15 AM', '10:30 AM', '3', 1),
(16, 1, 14, 24, 18, '2019-10-08', '10:15 PM', '10:15 AM', '', 1),
(17, 1, 14, 24, 23, '2019-10-10', '10:15 AM', '10:15 AM', '', 1),
(18, 1, 14, 24, 22, '2019-10-12', '10:30 AM', '10:30 AM', '', 1),
(19, 1, 10, 20, 25, '2019-10-01', '10:30 AM', '10:30 AM', '', 1),
(20, 1, 10, 20, 27, '2019-10-03', '10:30 AM', '10:30 AM', '', 1),
(21, 1, 10, 20, 26, '2019-10-05', '10:30 AM', '10:30 AM', '', 1),
(22, 1, 10, 20, 24, '2019-10-08', '10:30 AM', '10:30 AM', '', 1),
(23, 1, 10, 20, 29, '2019-10-10', '10:30 AM', '10:30 AM', '', 1),
(24, 1, 10, 20, 28, '2019-10-12', '10:30 AM', '10:30 AM', '', 1),
(25, 1, 12, 16, 2, '2019-10-01', '10:30 AM', '10:30 AM', '', 1),
(26, 1, 12, 16, 4, '2019-10-03', '10:30 AM', '10:30 AM', '', 1),
(27, 1, 12, 16, 3, '2019-10-05', '10:30 AM', '10:30 AM', '', 1),
(28, 1, 12, 16, 1, '2019-10-08', '10:30 AM', '10:30 AM', '', 1),
(29, 1, 12, 16, 31, '2019-10-10', '10:45 AM', '10:45 AM', '', 1),
(30, 1, 12, 16, 30, '2019-10-12', '10:45 AM', '10:45 AM', '', 1),
(31, 1, 1, 8, 33, '2019-10-01', '10:45 AM', '10:45 AM', '', 1),
(32, 1, 1, 8, 35, '2019-10-03', '10:45 AM', '10:45 AM', '', 1),
(33, 1, 1, 8, 34, '2019-10-05', '10:45 AM', '10:45 AM', '', 1),
(34, 1, 1, 8, 32, '2019-10-08', '10:45 AM', '10:45 AM', '', 1),
(35, 1, 1, 8, 40, '2019-10-10', '11:00 AM', '11:00 AM', '', 1),
(36, 1, 1, 8, 39, '2019-10-12', '11:00 AM', '11:00 AM', '', 1),
(37, 1, 1, 8, 37, '2019-10-15', '11:00 AM', '11:00 AM', '', 1),
(38, 1, 1, 8, 47, '2019-10-17', '11:00 AM', '11:00 AM', '', 1),
(39, 1, 2, 9, 42, '2019-10-02', '11:00 AM', '11:00 AM', '', 1),
(40, 1, 2, 9, 44, '2019-10-04', '11:00 AM', '11:00 AM', '', 1),
(41, 1, 2, 9, 43, '2019-10-07', '11:00 AM', '11:00 AM', '', 1),
(42, 1, 2, 9, 41, '2019-10-09', '11:15 AM', '11:15 AM', '', 1),
(43, 1, 2, 9, 49, '2019-10-11', '11:15 AM', '11:15 AM', '', 1),
(44, 1, 2, 9, 46, '2019-10-14', '11:15 AM', '11:15 AM', '', 1),
(45, 1, 2, 9, 50, '2019-10-16', '11:15 AM', '11:15 AM', '', 1),
(46, 1, 2, 9, 52, '2019-10-18', '11:15 AM', '11:15 AM', '', 1),
(47, 1, 2, 9, 51, '2019-10-21', '11:15 AM', '11:15 AM', '', 1),
(48, 1, 3, 10, 54, '2019-10-02', '11:15 AM', '11:15 AM', '', 1),
(49, 1, 3, 10, 56, '2019-10-04', '11:15 AM', '11:15 AM', '', 1),
(50, 1, 3, 10, 55, '2019-10-07', '11:15 AM', '11:15 AM', '', 1),
(51, 1, 3, 10, 53, '2019-10-09', '11:30 AM', '11:30 AM', '', 1),
(52, 1, 3, 10, 59, '2019-10-11', '11:30 AM', '11:30 AM', '', 1),
(53, 1, 3, 10, 58, '2019-10-14', '11:30 AM', '11:30 AM', '', 1),
(54, 1, 3, 10, 60, '2019-10-16', '11:30 AM', '11:30 AM', '', 1),
(55, 1, 3, 10, 62, '2019-10-18', '11:30 AM', '11:30 AM', '', 1),
(56, 1, 3, 10, 61, '2019-10-21', '11:30 AM', '11:30 AM', '', 1),
(57, 1, 4, 11, 64, '2019-10-02', '11:45 AM', '11:45 AM', '', 1),
(58, 1, 3, 10, 56, '2019-10-04', '11:45 AM', '11:45 PM', '', 1),
(59, 1, 4, 11, 66, '2019-10-04', '11:45 AM', '11:45 AM', '', 1),
(60, 1, 4, 11, 65, '2019-10-07', '11:45 AM', '11:45 AM', '', 1),
(61, 1, 4, 11, 63, '2019-10-09', '11:45 AM', '11:45 AM', '', 1),
(62, 1, 4, 11, 69, '2019-10-11', '11:45 AM', '11:45 AM', '', 1),
(63, 1, 4, 11, 68, '2019-10-14', '11:45 AM', '11:45 AM', '', 1),
(64, 1, 4, 11, 70, '2019-10-16', '11:45 AM', '11:45 AM', '', 1),
(65, 1, 4, 11, 72, '2019-10-18', '11:45 AM', '11:45 AM', '', 1),
(66, 1, 4, 11, 71, '2019-10-21', '11:45 AM', '11:45 AM', '', 1),
(67, 1, 5, 12, 74, '2019-10-02', '12:00 PM', '12:00 PM', '', 1),
(68, 1, 5, 12, 76, '2019-10-04', '12:00 PM', '12:00 PM', '', 1),
(69, 2, 5, 12, 75, '2019-10-07', '12:00 PM', '12:00 PM', '', 1),
(70, 1, 5, 12, 73, '2019-10-09', '12:00 PM', '12:00 PM', '', 1),
(71, 1, 5, 12, 79, '2019-10-11', '12:00 PM', '12:00 PM', '', 1),
(72, 1, 5, 12, 78, '2019-10-14', '12:00 PM', '12:00 PM', '', 1),
(73, 1, 5, 12, 80, '2019-10-16', '12:00 PM', '12:00 PM', '', 1),
(74, 1, 5, 12, 82, '2019-10-18', '12:00 PM', '12:00 PM', '', 1),
(75, 1, 5, 12, 81, '2019-10-21', '12:00 PM', '12:00 PM', '', 1),
(76, 1, 6, 13, 84, '2019-10-02', '12:00 PM', '12:00 PM', '', 1),
(77, 1, 6, 13, 86, '2019-10-04', '12:00 PM', '12:00 PM', '', 1),
(78, 1, 6, 13, 85, '2019-10-07', '12:00 PM', '12:00 PM', '', 1),
(79, 1, 6, 13, 83, '2019-10-09', '12:15 PM', '12:15 PM', '', 1),
(80, 1, 6, 13, 89, '2019-10-11', '12:15 PM', '12:15 PM', '', 1),
(81, 1, 6, 13, 88, '2019-10-14', '12:15 PM', '12:15 PM', '', 1),
(82, 1, 6, 13, 90, '2019-10-16', '12:15 PM', '12:15 PM', '', 1),
(83, 1, 6, 13, 92, '2019-10-18', '12:15 PM', '12:15 PM', '', 1),
(84, 1, 6, 13, 91, '2019-10-21', '12:15 PM', '12:15 PM', '', 1),
(85, 1, 7, 14, 94, '2019-10-02', '12:15 PM', '12:15 PM', '', 1),
(86, 1, 7, 14, 96, '2019-10-04', '12:15 PM', '12:15 PM', '', 1),
(87, 1, 7, 14, 95, '2019-10-07', '12:15 PM', '12:15 PM', '', 1),
(88, 1, 7, 14, 93, '2019-10-09', '12:15 PM', '12:15 PM', '', 1),
(89, 1, 7, 14, 98, '2019-10-11', '12:15 PM', '12:15 PM', '', 1),
(90, 1, 7, 14, 99, '2019-10-14', '12:30 PM', '12:30 PM', '', 1),
(91, 1, 7, 14, 100, '2019-10-16', '12:30 PM', '12:30 PM', '', 1),
(92, 1, 8, 15, 101, '2019-10-15', '12:30 PM', '12:30 PM', '', 1),
(93, 1, 8, 15, 106, '2019-10-17', '12:30 PM', '12:30 PM', '', 1),
(94, 1, 8, 15, 104, '2019-10-19', '12:30 PM', '12:30 PM', '', 1),
(95, 1, 8, 15, 102, '2019-10-22', '12:30 PM', '12:30 PM', '', 1),
(96, 1, 8, 15, 107, '2019-10-23', '12:30 PM', '12:30 PM', '', 1),
(97, 1, 10, 21, 25, '2019-10-01', '12:30 PM', '12:30 PM', '', 1),
(98, 1, 10, 21, 27, '2019-10-03', '12:30 PM', '12:30 PM', '', 1),
(99, 1, 10, 21, 26, '2019-10-05', '12:45 PM', '12:45 PM', '', 1),
(101, 1, 10, 21, 29, '2019-10-10', '12:45 PM', '12:45 PM', '', 1),
(102, 1, 10, 21, 28, '2019-10-12', '12:45 PM', '12:45 PM', '', 1),
(103, 1, 10, 21, 24, '2019-10-08', '12:45 PM', '12:45 PM', '', 1),
(104, 1, 12, 17, 2, '2019-10-01', '12:45 PM', '12:45 PM', '', 1),
(105, 1, 12, 17, 4, '2019-10-03', '1:00 PM', '1:00 PM', '', 1),
(106, 1, 12, 17, 3, '2019-10-05', '1:00 PM', '1:00 PM', '', 1),
(107, 1, 12, 17, 1, '2019-10-08', '1:00 PM', '1:00 PM', '', 1),
(108, 1, 12, 17, 31, '2019-10-10', '1:00 PM', '1:00 PM', '', 1),
(109, 1, 12, 17, 30, '2019-10-12', '1:00 PM', '1:00 PM', '', 1),
(110, 3, 12, 16, 2, '2019-10-31', '1:45 PM', '1:45 PM', '2', 1),
(111, 2, 12, 16, 3, '2020-10-31', '7:00 PM', '7:00 PM', '', 2),
(112, 2, 12, 16, 5, '2020-02-20', '4:45 PM', '5:15 PM', '', 1),
(113, 2, 19, 25, 109, '2020-02-20', '10:15 AM', '11:00 AM', '9', 1),
(114, 2, 1, 8, 33, '2020-05-09', '8:45 PM', '12:15 AM', '9', 1),
(115, 2, 1, 8, 32, '2020-05-15', '7:45 PM', '8:45 PM', '32', 1),
(116, 4, 1, 8, 33, '2020-07-09', '10:45 AM', '11:00 AM', '4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expenseID` int(11) UNSIGNED NOT NULL,
  `create_date` date NOT NULL,
  `date` date NOT NULL,
  `expenseday` varchar(11) NOT NULL,
  `expensemonth` varchar(11) NOT NULL,
  `expenseyear` year(4) NOT NULL,
  `expense` varchar(128) NOT NULL,
  `amount` double NOT NULL,
  `file` varchar(200) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `uname` varchar(60) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feetypes`
--

CREATE TABLE `feetypes` (
  `feetypesID` int(11) UNSIGNED NOT NULL,
  `feetypes` varchar(60) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feetypes`
--

INSERT INTO `feetypes` (`feetypesID`, `feetypes`, `note`) VALUES
(51, 'Admision fee [Jan]', ''),
(52, 'Monthly fee [Feb]', ''),
(53, 'Admision fee [Mar]', ''),
(54, 'Admision fee [Apr]', ''),
(55, 'Admision fee [May]', ''),
(56, 'Admision fee [Jun]', ''),
(57, 'Admision fee [Jul]', ''),
(58, 'Admision fee [Aug]', ''),
(59, 'Admision fee [Sep]', ''),
(60, 'Admision fee [Oct]', ''),
(61, 'Admision fee [Nov]', ''),
(62, 'Admision fee [Dec]', ''),
(63, 'sport fee [Jan]', 'we  collect sport fee to all student'),
(64, 'sport fee [Feb]', 'we  collect sport fee to all student'),
(65, 'sport fee [Mar]', 'we  collect sport fee to all student'),
(66, 'sport fee [Apr]', 'we  collect sport fee to all student'),
(67, 'sport fee [May]', 'we  collect sport fee to all student'),
(68, 'sport fee [Jun]', 'we  collect sport fee to all student'),
(69, 'sport fee [Jul]', 'we  collect sport fee to all student'),
(70, 'sport fee [Aug]', 'we  collect sport fee to all student'),
(71, 'sport fee [Sep]', 'we  collect sport fee to all student'),
(72, 'sport fee [Oct]', 'we  collect sport fee to all student'),
(73, 'sport fee [Nov]', 'we  collect sport fee to all student'),
(74, 'sport fee [Dec]', 'we  collect sport fee to all student'),
(75, 'rtrtrt [Jan]', 'rtrr'),
(76, 'rtrtrt [Feb]', 'rtrr'),
(77, 'rtrtrt [Mar]', 'rtrr'),
(78, 'rtrtrt [Apr]', 'rtrr'),
(79, 'rtrtrt [May]', 'rtrr'),
(80, 'rtrtrt [Jun]', 'rtrr'),
(81, 'rtrtrt [Jul]', 'rtrr'),
(82, 'rtrtrt [Aug]', 'rtrr'),
(83, 'rtrtrt [Sep]', 'rtrr'),
(84, 'rtrtrt [Oct]', 'rtrr'),
(85, 'rtrtrt [Nov]', 'rtrr'),
(86, 'rtrtrt [Dec]', 'rtrr'),
(87, 'Monthly [Feb] [Jan]', ''),
(88, 'Monthly [Feb] [Feb]', ''),
(89, 'Monthly [Feb] [Mar]', ''),
(90, 'Monthly [Feb] [Apr]', ''),
(91, 'Monthly [Feb] [May]', ''),
(92, 'Monthly [Feb] [Jun]', ''),
(93, 'Monthly [Feb] [Jul]', ''),
(94, 'Monthly [Feb] [Aug]', ''),
(95, 'Monthly [Feb] [Sep]', ''),
(96, 'Monthly [Feb] [Oct]', ''),
(97, 'Monthly [Feb] [Nov]', ''),
(98, 'Monthly [Feb] [Dec]', ''),
(99, 'Monthly [Mar] [Jan]', ''),
(100, 'Monthly [Mar] [Feb]', ''),
(101, 'Monthly [Mar] [Mar]', ''),
(102, 'Monthly [Mar] [Apr]', ''),
(103, 'Monthly [Mar] [May]', ''),
(104, 'Monthly [Mar] [Jun]', ''),
(105, 'Monthly [Mar] [Jul]', ''),
(106, 'Monthly [Mar] [Aug]', ''),
(107, 'Monthly [Mar] [Sep]', ''),
(108, 'Monthly [Mar] [Oct]', ''),
(109, 'Monthly [Mar] [Nov]', ''),
(110, 'Monthly [Mar] [Dec]', '');

-- --------------------------------------------------------

--
-- Table structure for table `fmenu`
--

CREATE TABLE `fmenu` (
  `fmenuID` int(11) NOT NULL,
  `menu_name` varchar(128) NOT NULL,
  `status` int(11) NOT NULL COMMENT 'Only for active',
  `topbar` int(11) NOT NULL,
  `social` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fmenu`
--

INSERT INTO `fmenu` (`fmenuID`, `menu_name`, `status`, `topbar`, `social`) VALUES
(1, 'Home', 1, 1, 0),
(2, 'main menu', 0, 0, 0),
(4, 'tanzeel', 0, 0, 0),
(5, 'Teacher Gallery', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fmenu_relation`
--

CREATE TABLE `fmenu_relation` (
  `fmenu_relationID` int(11) NOT NULL,
  `fmenuID` int(11) DEFAULT NULL,
  `menu_typeID` int(11) DEFAULT NULL COMMENT '1 => Pages, 2 => Post, 3 => Links',
  `menu_parentID` varchar(128) DEFAULT NULL,
  `menu_orderID` int(11) DEFAULT NULL,
  `menu_pagesID` int(11) DEFAULT NULL,
  `menu_label` varchar(254) DEFAULT NULL,
  `menu_link` text NOT NULL,
  `menu_rand` varchar(128) DEFAULT NULL,
  `menu_rand_parentID` varchar(128) DEFAULT NULL,
  `menu_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fmenu_relation`
--

INSERT INTO `fmenu_relation` (`fmenu_relationID`, `fmenuID`, `menu_typeID`, `menu_parentID`, `menu_orderID`, `menu_pagesID`, `menu_label`, `menu_link`, `menu_rand`, `menu_rand_parentID`, `menu_status`) VALUES
(12, 4, 1, '0', 1, 2, 'Тухай', '#', '3bcb9ebae678cecfc9b10b93cf12797d', '0', 1),
(13, 4, 1, '0', 2, 2, 'Тухай', '#', 'cb3b32c13872cba5af9212fe65bb8051', '0', 1),
(14, 4, 1, '0', 3, 3, 'Home', '#', 'b6b482b55d58950c6d2b0431da2c8b50', '0', 1),
(15, 2, 1, '0', 1, 3, 'Home', '#', 'fb6f3aaf3b613ac9cf20cec939a659a3', '0', 1),
(16, 2, 1, '0', 2, 2, 'About', '#', '44e9be8123c6d652a6177a5b94c1eb21', '0', 1),
(31, 1, 1, '0', 1, 9, 'About', '#', 'a46ff4a86b4db92cb97c42c7152ad902', '0', 1),
(32, 1, 1, '0', 2, 5, 'Gallery', '#', 'c3a5404255466bd339f899fa65bd841c', '0', 1),
(33, 1, 1, '0', 3, 6, 'Admissions', '#', 'e6178aec4830e8a73ea5c04a7bafa762', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frontend_setting`
--

CREATE TABLE `frontend_setting` (
  `fieldoption` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `frontend_setting`
--

INSERT INTO `frontend_setting` (`fieldoption`, `value`) VALUES
('description', 'Ayyan Software Development | School Management Software |'),
('facebook', 'https://www.facebook.com'),
('google', 'www.google.com'),
('linkedin', 'www.linkedin.com'),
('login_menu_status', '1'),
('online_admission_status', '1'),
('teacher_email_status', '1'),
('teacher_phone_status', '1'),
('twitter', 'www.twitter.com'),
('youtube', 'www.youtube.com');

-- --------------------------------------------------------

--
-- Table structure for table `frontend_template`
--

CREATE TABLE `frontend_template` (
  `frontend_templateID` int(11) NOT NULL,
  `template_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `frontend_template`
--

INSERT INTO `frontend_template` (`frontend_templateID`, `template_name`) VALUES
(1, 'home'),
(2, 'about'),
(3, 'event'),
(4, 'teacher'),
(5, 'gallery'),
(6, 'notice'),
(7, 'blog'),
(8, 'contact'),
(9, 'admission');

-- --------------------------------------------------------

--
-- Table structure for table `globalpayment`
--

CREATE TABLE `globalpayment` (
  `globalpaymentID` int(11) NOT NULL,
  `classesID` int(11) DEFAULT NULL,
  `sectionID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `clearancetype` varchar(40) NOT NULL,
  `invoicename` varchar(128) NOT NULL,
  `invoicedescription` varchar(128) NOT NULL,
  `paymentyear` varchar(5) NOT NULL,
  `schoolyearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `globalpayment`
--

INSERT INTO `globalpayment` (`globalpaymentID`, `classesID`, `sectionID`, `studentID`, `clearancetype`, `invoicename`, `invoicedescription`, `paymentyear`, `schoolyearID`) VALUES
(3, 2, 2, 2, 'paid', '2-Khubaib Kashif', '', '2019', 1),
(32, 13, 19, 1, 'partial', '2-Abdul Hadi Fayaz', '', '2019', 1),
(33, 12, 16, 6, 'paid', '26-STUDENT', '', '2019', 1),
(34, 13, 19, 1, 'partial', '2-Abdul Hadi Fayaz', '', '2019', 1),
(35, 13, 19, 5, 'paid', '6-Waqas', '', '2019', 1),
(36, 1, 8, 10, 'partial', '30-Umer jan', '', '2019', 1),
(37, 1, 8, 10, 'partial', '30-Umer jan', '', '2019', 1),
(38, 13, 19, 10, 'partial', '11-Faiza  Ali', '', '2019', 1),
(39, 13, 19, 3, 'paid', '4-Saad Akbar', '', '2019', 1),
(40, 13, 19, 3, 'paid', '4-Saad Akbar', '', '2019', 1),
(41, 12, 16, 3, 'paid', '3-Asjad Hafeez', '', '2020', 1),
(42, 12, 16, 3, 'paid', '3-Asjad Hafeez', '', '2020', 1),
(43, 19, 25, 2, 'paid', '2-Fatima iqbal', '', '2020', 1),
(44, 12, 16, 3, 'paid', '3-Asjad Hafeez', '', '2020', 1),
(45, 1, 8, 4, 'paid', '4-Qashood Hafeez', '', '2020', 1),
(46, 1, 8, 4, 'paid', '4-Qashood Hafeez', '', '2020', 1),
(47, 1, 8, 5, 'partial', '5-Nashit Hafeez', '', '2020', 1),
(48, 19, 25, 2, 'paid', '2-Fatima iqbal', '', '2020', 1),
(49, 1, 8, 5, 'paid', '5-Nashit Hafeez', '', '2020', 1),
(50, 1, 8, 5, 'partial', '5-Nashit Hafeez', '', '2020', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `gradeID` int(11) UNSIGNED NOT NULL,
  `grade` varchar(60) NOT NULL,
  `point` varchar(11) NOT NULL,
  `gradefrom` int(11) NOT NULL,
  `gradeupto` int(11) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`gradeID`, `grade`, `point`, `gradefrom`, `gradeupto`, `note`) VALUES
(8, 'B', '3.5', 80, 90, ''),
(9, 'A - Highest', '4.0', 91, 100, 'A is Highest Grade'),
(10, 'C', '3.0', 70, 79, ''),
(11, 'D', '2.5', 60, 69, ''),
(12, 'E', '2.0', 50, 59, ''),
(13, 'F', '1.5', 40, 49, '');

-- --------------------------------------------------------

--
-- Table structure for table `hmember`
--

CREATE TABLE `hmember` (
  `hmemberID` int(11) UNSIGNED NOT NULL,
  `hostelID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `hbalance` varchar(20) DEFAULT NULL,
  `hjoindate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hmember`
--

INSERT INTO `hmember` (`hmemberID`, `hostelID`, `categoryID`, `studentID`, `hbalance`, `hjoindate`) VALUES
(1, 1, 1, 7, '1000', '2019-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `holidayID` int(11) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `fdate` date NOT NULL,
  `tdate` date NOT NULL,
  `title` varchar(128) NOT NULL,
  `details` text NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL DEFAULT '0',
  `create_usertypeID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`holidayID`, `schoolyearID`, `fdate`, `tdate`, `title`, `details`, `photo`, `create_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 1, '2019-09-10', '2019-09-10', 'African child day', 'day of the african child', '7c470449c64a1383f5e75f073970d0fda913ceae8bfb3f950dffba1f83bb563a84b11d9281b8a613f622b7325a2201f3c0bb3fc834076088e066174e47304279.jpg', '2019-08-29 16:03:12', 1, 1),
(2, 1, '2020-02-05', '2020-02-07', 'Kashmir Solidarity dat', 'school will remain close', '4670480aecf8d86c549f9743b31aadde9b3c9642faca02035ce5aa783cf7cd580e33f32e0d81660725f518d485e4a7510e8b4ad3fe7d8b07961c73873f0892e6.jpg', '2020-02-07 09:27:18', 1, 1),
(3, 1, '2020-03-07', '2020-03-17', 'winter', 'winter&nbsp; vacations', 'holiday.png', '2020-03-07 10:08:12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

CREATE TABLE `hostel` (
  `hostelID` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `htype` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`hostelID`, `name`, `htype`, `address`, `note`) VALUES
(1, 'aaa', 'Boys', 'hhhhhhhhhhh', '');

-- --------------------------------------------------------

--
-- Table structure for table `hourly_template`
--

CREATE TABLE `hourly_template` (
  `hourly_templateID` int(11) NOT NULL,
  `hourly_grades` varchar(128) NOT NULL,
  `hourly_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hourly_template`
--

INSERT INTO `hourly_template` (`hourly_templateID`, `hourly_grades`, `hourly_rate`) VALUES
(1, '3', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `idmanager`
--

CREATE TABLE `idmanager` (
  `idmanagerID` int(11) NOT NULL,
  `schooltype` varchar(20) NOT NULL,
  `idtitle` varchar(128) NOT NULL,
  `idtype` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `idmanager`
--

INSERT INTO `idmanager` (`idmanagerID`, `schooltype`, `idtitle`, `idtype`) VALUES
(1, 'semesterbase', 'Year+Semester Code+Department Code+Student Max ID', 'schoolyear+semestercode+classes_numeric+studentmaxID'),
(2, 'semesterbase', 'Year+Department Code+Semester Code+Student Max ID', 'schoolyear+classes_numeric+semestercode+studentmaxID'),
(3, 'semesterbase', 'Year+Semester Code+Student Max ID', 'schoolyear+semestercode+studentmaxID'),
(4, 'semesterbase', 'Year+Department Code+Student Max ID', 'schoolyear+classes_numeric+studentmaxID'),
(5, 'semesterbase', 'Student Max ID+Year+Semester Code+Department Code', 'studentmaxID+schoolyear+semestercode+classes_numeric'),
(6, 'semesterbase', 'Student Max ID+Semester Code+Department Code+Year', 'studentmaxID+semestercode+classes_numeric+schoolyear'),
(7, 'semesterbase', 'Student Max ID+Semester Code+Department Code', 'studentmaxID+semestercode+classes_numeric'),
(8, 'semesterbase', 'Student Max ID+Department Code+Semester Code', 'studentmaxID+classes_numeric+semestercode'),
(9, 'semesterbase', 'Semester Code+Department Code+Student Max ID', 'semestercode+classes_numeric+studentmaxID'),
(10, 'semesterbase', 'Department Code+Semester Code+Student Max ID', 'classes_numeric+semestercode+studentmaxID'),
(11, 'semesterbase', 'Semester Code+Student Max ID', 'semestercode+studentmaxID'),
(12, 'semesterbase', 'Department Code+Student Max ID', 'classes_numeric+studentmaxID'),
(13, 'semesterbase', 'Student Max ID', 'studentmaxID'),
(14, 'classbase', 'Year+Class Numeric+Student Max ID', 'schoolyear+classes_numeric+studentmaxID'),
(15, 'Classbase', 'Class Numeric+Year+Student Max ID', 'classes_numeric+schoolyear+studentmaxID'),
(16, 'classbase', 'Year+Student Max ID', 'schoolyear+studentmaxID'),
(17, 'classbase', 'Class Numeric+Student Max ID', 'classes_numeric+studentmaxID'),
(18, 'classbase', 'Student Max ID', 'studentmaxID'),
(19, 'semesterbase', 'None', 'none'),
(20, 'classbase', 'None', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `incomeID` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `incomeday` varchar(11) NOT NULL,
  `incomemonth` varchar(11) NOT NULL,
  `incomeyear` year(4) NOT NULL,
  `amount` double NOT NULL,
  `file` varchar(200) NOT NULL,
  `note` text NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`incomeID`, `name`, `date`, `incomeday`, `incomemonth`, `incomeyear`, `amount`, `file`, `note`, `schoolyearID`, `create_date`, `userID`, `usertypeID`) VALUES
(1, 'tanzeel', '2020-02-12', '12', '02', 2020, 300000, '', '', 1, '2020-02-12', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ini_config`
--

CREATE TABLE `ini_config` (
  `configID` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `config_key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ini_config`
--

INSERT INTO `ini_config` (`configID`, `type`, `config_key`, `value`) VALUES
(1, 'paypal', 'paypal_api_username', ''),
(2, 'paypal', 'paypal_api_password', ''),
(3, 'paypal', 'paypal_api_signature', ''),
(4, 'paypal', 'paypal_email', ''),
(5, 'paypal', 'paypal_demo', ''),
(6, 'stripe', 'stripe_secret', ''),
(8, 'stripe', 'stripe_demo', ''),
(9, 'payumoney', 'payumoney_key', ''),
(10, 'payumoney', 'payumoney_salt', ''),
(11, 'payumoney', 'payumoney_demo', ''),
(12, 'paypal', 'paypal_status', ''),
(13, 'stripe', 'stripe_status', ''),
(14, 'payumoney', 'payumoney_status', ''),
(15, 'voguepay', 'voguepay_merchant_id', ''),
(16, 'voguepay', 'voguepay_merchant_ref', ''),
(17, 'voguepay', 'voguepay_developer_code', ''),
(18, 'voguepay', 'voguepay_demo', ''),
(19, 'voguepay', 'voguepay_status', '');

-- --------------------------------------------------------

--
-- Table structure for table `instruction`
--

CREATE TABLE `instruction` (
  `instructionID` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instruction`
--

INSERT INTO `instruction` (`instructionID`, `title`, `content`) VALUES
(1, 'tt', '&nbsp;ttftutu6t 6 t&nbsp; y u');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(11) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `feetypeID` int(11) DEFAULT NULL,
  `feetype` varchar(128) NOT NULL,
  `amount` double NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `userID` int(11) DEFAULT NULL,
  `usertypeID` int(11) DEFAULT NULL,
  `uname` varchar(60) DEFAULT NULL,
  `date` date NOT NULL,
  `create_date` date NOT NULL,
  `day` varchar(20) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `paidstatus` int(11) DEFAULT NULL,
  `deleted_at` int(11) NOT NULL DEFAULT '1',
  `maininvoiceID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `schoolyearID`, `classesID`, `studentID`, `feetypeID`, `feetype`, `amount`, `discount`, `userID`, `usertypeID`, `uname`, `date`, `create_date`, `day`, `month`, `year`, `paidstatus`, `deleted_at`, `maininvoiceID`) VALUES
(1, 1, 1, 1, 2, 'Library Fee', 2840, 13.5, 1, 1, 'superadmin', '2019-07-09', '2019-07-05', '05', '07', 2019, 0, 0, 1),
(2, 1, 1, 1, 1, 'Books Fine', 2450, 0, 1, 1, 'superadmin', '2019-07-09', '2019-07-05', '05', '07', 2019, 0, 0, 2),
(3, 1, 1, 1, 3, 'Transport Fee', 1000, 0, 1, 1, 'superadmin', '2019-03-31', '2019-07-15', '15', '07', 2019, 0, 0, 3),
(4, 1, 2, 2, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-10', '2019-07-15', '15', '07', 2019, 0, 1, 4),
(5, 1, 2, 2, 17, 'Admission Fee', 6000, 100, 1, 1, 'superadmin', '2019-07-10', '2019-07-15', '15', '07', 2019, 2, 1, 4),
(6, 1, 2, 2, 19, 'Tuition Fee', 2850, 0, 1, 1, 'superadmin', '2019-07-10', '2019-07-15', '15', '07', 2019, 1, 1, 4),
(7, 1, 2, 2, 20, 'Annual Charges', 2850, 0, 1, 1, 'superadmin', '2019-07-10', '2019-07-15', '15', '07', 2019, 1, 1, 4),
(8, 1, 2, 3, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-03-20', '2019-07-15', '15', '07', 2019, 2, 1, 5),
(9, 1, 2, 3, 17, 'Admission Fee', 4000, 0, 1, 1, 'superadmin', '2019-03-20', '2019-07-15', '15', '07', 2019, 2, 1, 5),
(10, 1, 2, 3, 19, 'Tuition Fee', 1500, 0, 1, 1, 'superadmin', '2019-03-20', '2019-07-15', '15', '07', 2019, 2, 1, 5),
(11, 1, 2, 3, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-03-20', '2019-07-15', '15', '07', 2019, 2, 1, 5),
(12, 1, 2, 4, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 6),
(13, 1, 2, 4, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 6),
(14, 1, 2, 4, 20, 'Annual Charges', 2850, 100, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 6),
(15, 1, 4, 5, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 7),
(16, 1, 4, 5, 20, 'Annual Charges', 2850, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 7),
(17, 1, 4, 5, 19, 'Tuition Fee', 1300, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 7),
(18, 1, 4, 5, 19, 'Tuition Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 8),
(19, 1, 4, 5, 19, 'Tuition Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 9),
(20, 1, 4, 6, 19, 'Tuition Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1, 10),
(21, 1, 4, 5, 22, 'Registration Fee', 100, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 11),
(22, 1, 4, 5, 19, 'Tuition Fee', 1200, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 11),
(23, 1, 4, 5, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 11),
(27, 1, 4, 6, 22, 'Registration Fee', 100, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1, 13),
(28, 1, 4, 6, 19, 'Tuition Fee', 1200, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1, 13),
(29, 1, 4, 6, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1, 13),
(30, 1, 4, 7, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 12),
(31, 1, 4, 7, 19, 'Tuition Fee', 1200, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 12),
(32, 1, 4, 7, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 12),
(33, 1, 4, 5, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 14),
(34, 1, 4, 7, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 15),
(35, 1, 4, 6, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1, 16),
(36, 1, 4, 8, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 17),
(37, 1, 4, 5, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 18),
(38, 1, 4, 5, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 18),
(39, 1, 4, 5, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 18),
(40, 1, 4, 7, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 19),
(41, 1, 4, 7, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 19),
(42, 1, 4, 7, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 19),
(43, 1, 4, 6, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1, 20),
(44, 1, 4, 6, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1, 20),
(45, 1, 4, 6, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1, 20),
(46, 1, 4, 8, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 21),
(47, 1, 4, 8, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 21),
(48, 1, 4, 8, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 21),
(49, 1, 4, 9, 22, 'Registration Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 22),
(50, 1, 4, 9, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 22),
(51, 1, 4, 9, 20, 'Annual Charges', 2000, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 22),
(52, 1, 2, 10, 19, 'Tuition Fee', 1200, 0, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1, 23),
(53, 1, 1, 1, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 24),
(54, 1, 1, 1, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 24),
(55, 1, 1, 1, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 24),
(56, 1, 1, 1, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 24),
(57, 1, 1, 1, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 24),
(58, 1, 1, 1, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 24),
(59, 1, 2, 2, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 25),
(60, 1, 2, 2, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 25),
(61, 1, 2, 2, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 25),
(62, 1, 2, 2, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 25),
(63, 1, 2, 2, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 25),
(64, 1, 2, 2, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 25),
(65, 1, 2, 3, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 26),
(66, 1, 2, 3, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 26),
(67, 1, 2, 3, 19, 'Tuition Fee', 1500, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 26),
(68, 1, 2, 3, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 26),
(69, 1, 2, 3, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 26),
(70, 1, 2, 3, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 26),
(71, 1, 2, 4, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 27),
(72, 1, 2, 4, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 27),
(73, 1, 2, 4, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 27),
(74, 1, 2, 4, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 27),
(75, 1, 2, 4, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 27),
(76, 1, 2, 4, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 27),
(77, 1, 4, 5, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 28),
(78, 1, 4, 5, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 28),
(79, 1, 4, 5, 19, 'Tuition Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 28),
(80, 1, 4, 5, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 28),
(81, 1, 4, 5, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 28),
(82, 1, 4, 5, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 28),
(83, 1, 4, 6, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 29),
(84, 1, 4, 6, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 29),
(85, 1, 4, 6, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 29),
(86, 1, 4, 6, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 29),
(87, 1, 4, 6, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 29),
(88, 1, 4, 6, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0, 29),
(155, 1, 5, 22, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 38),
(156, 1, 5, 22, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 38),
(157, 1, 5, 22, 19, 'Tuition Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 38),
(158, 1, 5, 22, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 38),
(159, 1, 5, 22, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 38),
(160, 1, 5, 22, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 38),
(161, 1, 5, 21, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 37),
(162, 1, 5, 21, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 37),
(163, 1, 5, 21, 19, 'Tuition Fee', 1800, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 37),
(164, 1, 5, 21, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 37),
(165, 1, 5, 21, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 37),
(166, 1, 5, 21, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 37),
(167, 1, 5, 20, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 36),
(168, 1, 5, 20, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 36),
(169, 1, 5, 20, 19, 'Tuition Fee', 1500, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 36),
(170, 1, 5, 20, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 36),
(171, 1, 5, 20, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 36),
(172, 1, 5, 20, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 36),
(173, 1, 5, 19, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 35),
(174, 1, 5, 19, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 35),
(175, 1, 5, 19, 19, 'Tuition Fee', 2450, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 35),
(176, 1, 5, 19, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 35),
(177, 1, 5, 19, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 35),
(178, 1, 5, 19, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 35),
(179, 1, 5, 18, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 34),
(180, 1, 5, 18, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 34),
(181, 1, 5, 18, 19, 'Tuition Fee', 2200, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 34),
(182, 1, 5, 18, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 34),
(183, 1, 5, 18, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 34),
(184, 1, 5, 18, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 34),
(185, 1, 2, 10, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 33),
(186, 1, 2, 10, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 33),
(187, 1, 2, 10, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 33),
(188, 1, 2, 10, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 33),
(189, 1, 2, 10, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 33),
(190, 1, 2, 10, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 33),
(191, 1, 4, 9, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 32),
(192, 1, 4, 9, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 32),
(193, 1, 4, 9, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 32),
(194, 1, 4, 9, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 32),
(195, 1, 4, 9, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 32),
(196, 1, 4, 9, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 32),
(197, 1, 4, 8, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 31),
(198, 1, 4, 8, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 31),
(199, 1, 4, 8, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 31),
(200, 1, 4, 8, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 31),
(201, 1, 4, 8, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 31),
(202, 1, 4, 8, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 31),
(203, 1, 4, 7, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 30),
(204, 1, 4, 7, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 30),
(205, 1, 4, 7, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 30),
(206, 1, 4, 7, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 30),
(207, 1, 4, 7, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 30),
(208, 1, 4, 7, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 30),
(209, 1, 5, 23, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 39),
(210, 1, 5, 23, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 39),
(211, 1, 5, 23, 19, 'Tuition Fee', 1500, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 39),
(212, 1, 5, 23, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 39),
(213, 1, 5, 23, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 39),
(214, 1, 5, 23, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 0, 39),
(215, 1, 1, 1, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 40),
(216, 1, 1, 1, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 40),
(217, 1, 1, 1, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 40),
(218, 1, 1, 1, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 40),
(219, 1, 1, 1, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 40),
(220, 1, 1, 1, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 40),
(221, 1, 2, 2, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 41),
(222, 1, 2, 2, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 41),
(223, 1, 2, 2, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 41),
(224, 1, 2, 2, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 41),
(225, 1, 2, 2, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 41),
(226, 1, 2, 2, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 41),
(227, 1, 2, 3, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 42),
(228, 1, 2, 3, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 42),
(229, 1, 2, 3, 19, 'Tuition Fee', 1500, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 42),
(230, 1, 2, 3, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 42),
(231, 1, 2, 3, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 42),
(232, 1, 2, 3, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 42),
(233, 1, 2, 4, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 43),
(234, 1, 2, 4, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 43),
(235, 1, 2, 4, 19, 'Tuition Fee', 2000, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 43),
(236, 1, 2, 4, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 43),
(237, 1, 2, 4, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 43),
(238, 1, 2, 4, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 43),
(239, 1, 4, 5, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 44),
(240, 1, 4, 5, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 44),
(241, 1, 4, 5, 19, 'Tuition Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 44),
(242, 1, 4, 5, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 44),
(243, 1, 4, 5, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 44),
(244, 1, 4, 5, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 44),
(245, 1, 4, 6, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 45),
(246, 1, 4, 6, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 45),
(247, 1, 4, 6, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 45),
(248, 1, 4, 6, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 45),
(249, 1, 4, 6, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 45),
(250, 1, 4, 6, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 45),
(251, 1, 4, 7, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 46),
(252, 1, 4, 7, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 46),
(253, 1, 4, 7, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 46),
(254, 1, 4, 7, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 46),
(255, 1, 4, 7, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 46),
(256, 1, 4, 7, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 46),
(257, 1, 4, 8, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 47),
(258, 1, 4, 8, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 47),
(259, 1, 4, 8, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 47),
(260, 1, 4, 8, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 47),
(261, 1, 4, 8, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 47),
(262, 1, 4, 8, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 47),
(263, 1, 4, 9, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 48),
(264, 1, 4, 9, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 48),
(265, 1, 4, 9, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 48),
(266, 1, 4, 9, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 48),
(267, 1, 4, 9, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 48),
(268, 1, 4, 9, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 48),
(269, 1, 2, 10, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 49),
(270, 1, 2, 10, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 49),
(271, 1, 2, 10, 19, 'Tuition Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 49),
(272, 1, 2, 10, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 49),
(273, 1, 2, 10, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 49),
(274, 1, 2, 10, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 49),
(275, 1, 5, 18, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 50),
(276, 1, 5, 18, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 50),
(277, 1, 5, 18, 19, 'Tuition Fee', 2200, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 50),
(278, 1, 5, 18, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 50),
(279, 1, 5, 18, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 50),
(280, 1, 5, 18, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 50),
(281, 1, 5, 19, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 51),
(282, 1, 5, 19, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 51),
(283, 1, 5, 19, 19, 'Tuition Fee', 2450, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 51),
(284, 1, 5, 19, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 51),
(285, 1, 5, 19, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 51),
(286, 1, 5, 19, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 51),
(287, 1, 5, 20, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 52),
(288, 1, 5, 20, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 52),
(289, 1, 5, 20, 19, 'Tuition Fee', 1500, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 52),
(290, 1, 5, 20, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 52),
(291, 1, 5, 20, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 52),
(292, 1, 5, 20, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 52),
(293, 1, 5, 21, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 53),
(294, 1, 5, 21, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 53),
(295, 1, 5, 21, 19, 'Tuition Fee', 1800, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 53),
(296, 1, 5, 21, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 53),
(297, 1, 5, 21, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 53),
(298, 1, 5, 21, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 53),
(299, 1, 5, 22, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 54),
(300, 1, 5, 22, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 54),
(301, 1, 5, 22, 19, 'Tuition Fee', 1000, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 54),
(302, 1, 5, 22, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 54),
(303, 1, 5, 22, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 54),
(304, 1, 5, 22, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 54),
(305, 1, 5, 23, 17, 'Admission Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 55),
(306, 1, 5, 23, 18, 'Security Deposit', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 55),
(307, 1, 5, 23, 19, 'Tuition Fee', 1500, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1, 55),
(308, 1, 5, 23, 20, 'Annual Charges', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 55),
(309, 1, 5, 23, 23, 'Examination Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 55),
(310, 1, 5, 23, 24, 'Computer Fee', 0, 0, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1, 55),
(311, 1, 1, 34, 19, 'Tuition Fee', 600, 0, 1, 1, 'superadmin', '2019-07-25', '2019-08-02', '02', '08', 2019, 0, 1, 56),
(312, 1, 3, 119, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-08-03', '2019-08-04', '04', '08', 2019, 0, 1, 57),
(313, 1, 6, 170, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-08-03', '2019-08-04', '04', '08', 2019, 0, 1, 58),
(314, 1, 6, 170, 25, 'Coaching Fee [Jan]', 500, 40, 1, 1, 'superadmin', '2019-08-03', '2019-08-04', '04', '08', 2019, 0, 1, 58),
(315, 1, 6, 170, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-09-24', '2019-08-04', '04', '08', 2019, 0, 1, 59),
(316, 1, 6, 170, 33, 'Coaching Fee [Sep]', 300, 0, 1, 1, 'superadmin', '2019-09-24', '2019-08-04', '04', '08', 2019, 0, 1, 59),
(317, 1, 6, 174, 19, 'Monthly Fees', 600, 0, 1, 1, 'superadmin', '2019-08-10', '2019-08-04', '04', '08', 2019, 0, 1, 60),
(318, 1, 6, 174, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-08-10', '2019-08-04', '04', '08', 2019, 0, 1, 60),
(319, 1, 7, 181, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-12-07', '2019-08-04', '04', '08', 2019, 0, 1, 61),
(322, 1, 6, 170, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-10-03', '2019-08-04', '04', '08', 2019, 0, 1, 62),
(323, 1, 6, 170, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-10-03', '2019-08-04', '04', '08', 2019, 0, 1, 62),
(324, 1, 6, 170, 23, 'Examination Fee', 200, 0, 1, 1, 'superadmin', '2019-10-03', '2019-08-04', '04', '08', 2019, 0, 1, 62),
(325, 1, 6, 170, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-11-03', '2019-08-04', '04', '08', 2019, 0, 1, 63),
(326, 1, 6, 170, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-11-03', '2019-08-04', '04', '08', 2019, 0, 1, 63),
(327, 1, 6, 170, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-12-03', '2019-08-04', '04', '08', 2019, 0, 1, 64),
(328, 1, 6, 170, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-12-03', '2019-08-04', '04', '08', 2019, 0, 1, 64),
(329, 1, 14, 364, 19, 'Monthly Fees', 2000, 0, 1, 1, 'superadmin', '2019-08-25', '2019-08-05', '05', '08', 2019, 0, 0, 65),
(330, 1, 12, 116, 19, 'Monthly Fees', 600, 0, 1, 1, 'superadmin', '2019-07-25', '2019-08-06', '06', '08', 2019, 0, 0, 66),
(331, 1, 12, 116, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-07-25', '2019-08-06', '06', '08', 2019, 0, 0, 66),
(334, 1, 12, 118, 19, 'Monthly Fees', 600, 0, 1, 1, 'superadmin', '2019-07-25', '2019-08-06', '06', '08', 2019, 0, 0, 68),
(335, 1, 12, 117, 19, 'Monthly Fees', 600, 0, 1, 1, 'superadmin', '2019-07-25', '2019-08-06', '06', '08', 2019, 0, 0, 67),
(336, 1, 12, 117, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-07-25', '2019-08-06', '06', '08', 2019, 0, 0, 67),
(337, 1, 5, 319, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-08-04', '2019-08-07', '07', '08', 2019, 0, 0, 69),
(338, 1, 5, 319, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-08-04', '2019-08-07', '07', '08', 2019, 0, 0, 69),
(339, 1, 5, 319, 19, 'Monthly Fees', 650, 7.6923076923076925, 1, 1, 'superadmin', '2019-08-07', '2019-08-07', '07', '08', 2019, 0, 0, 70),
(340, 1, 5, 319, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-08-07', '2019-08-07', '07', '08', 2019, 0, 0, 70),
(341, 1, 4, 304, 50, 'Arrears', 35000, 0, 1, 1, 'superadmin', '2019-07-31', '2019-08-19', '19', '08', 2019, 0, 0, 71),
(342, 1, 12, 116, 19, 'Monthly Fees', 600, 0, 1, 1, 'superadmin', '2019-08-17', '2019-08-19', '19', '08', 2019, 0, 0, 72),
(343, 1, 12, 116, 49, 'Coaching Fee', 300, 0, 1, 1, 'superadmin', '2019-08-17', '2019-08-19', '19', '08', 2019, 0, 0, 72),
(344, 1, 12, 116, 50, 'Arrears', 5000, 0, 1, 1, 'superadmin', '2019-07-31', '2019-08-19', '19', '08', 2019, 0, 0, 73),
(345, 1, 12, 116, 19, 'Monthly Fees', 1000, 0, 1, 1, 'superadmin', '2019-06-24', '2019-08-21', '21', '08', 2019, 0, 0, 74),
(347, 1, 12, 1, 51, 'Admision fee [Jan]', 5000, 0, 1, 1, 'Owner', '2019-09-18', '2019-08-27', '27', '08', 2019, 1, 1, 75),
(348, 1, 12, 5, 60, 'Admision fee [Oct]', 5000, 20, 1, 1, 'Owner', '2019-10-10', '2019-10-14', '14', '10', 2019, 2, 1, 76),
(349, 1, 1, 10, 82, 'rtrtrt [Aug]', 10000, 0, 1, 1, 'Owner', '2019-11-08', '2019-11-14', '14', '11', 2019, 1, 1, 77),
(350, 1, 1, 10, 54, 'Admision fee [Apr]', 1000, 0, 1, 1, 'Owner', '2019-11-20', '2019-11-14', '14', '11', 2019, 1, 1, 78),
(351, 1, 12, 3, 53, 'Admision fee [Mar]', 2000, 25, 1, 1, 'Tanzeel', '2020-02-07', '2020-02-07', '07', '02', 2020, 2, 1, 79),
(352, 1, 19, 1, 52, 'Admision fee [Feb]', 2000, 0, 1, 1, 'Tanzeel', '2020-02-07', '2020-02-07', '07', '02', 2020, 0, 0, 80),
(353, 1, 19, 2, 52, 'Admision fee [Feb]', 2000, 0, 1, 1, 'Tanzeel', '2020-02-07', '2020-02-07', '07', '02', 2020, 0, 0, 81),
(354, 1, 12, 3, 52, 'Admision fee [Feb]', 200, 0, 1, 1, 'Admin', '2020-02-08', '2020-02-09', '09', '02', 2020, 2, 1, 82),
(355, 1, 19, 1, 52, 'Admision fee [Feb]', 2000, 0, 1, 1, 'Admin', '2020-02-09', '2020-02-09', '09', '02', 2020, 0, 0, 83),
(356, 1, 19, 2, 52, 'Admision fee [Feb]', 2000, 0, 1, 1, 'Admin', '2020-02-09', '2020-02-09', '09', '02', 2020, 2, 1, 84),
(358, 1, 19, 1, 52, 'Admision fee [Feb]', 2000, 0, 1, 1, 'Admin', '2020-02-01', '2020-02-10', '10', '02', 2020, 0, 1, 85),
(359, 1, 19, 2, 52, 'Admision fee [Feb]', 1500, 0, 1, 1, 'Admin', '2020-02-02', '2020-02-10', '10', '02', 2020, 0, 1, 86),
(360, 1, 12, 3, 52, 'Monthly fee [Feb]', 3000, 0, 1, 1, 'Admin', '2020-02-10', '2020-02-10', '10', '02', 2020, 2, 1, 87),
(361, 1, 1, 4, 52, 'Monthly fee [Feb]', 200000, 0, 1, 1, 'Admin', '2020-02-12', '2020-02-12', '12', '02', 2020, 2, 1, 88),
(362, 1, 1, 4, 52, 'Monthly fee [Feb]', 1500, 33.33333333333333, 1, 1, 'Admin', '2020-02-19', '2020-02-24', '24', '02', 2020, 0, 1, 89),
(363, 1, 19, 1, 52, 'Monthly fee [Feb]', 1500, 20, 1, 1, 'Admin', '2020-02-17', '2020-02-26', '26', '02', 2020, 0, 1, 90),
(364, 1, 19, 2, 52, 'Monthly fee [Feb]', 1500, 20, 1, 1, 'Admin', '2020-02-17', '2020-02-26', '26', '02', 2020, 2, 1, 91),
(365, 1, 1, 4, 53, 'Admision fee [Mar]', 2000, 5, 1, 1, 'Admin', '2020-03-02', '2020-03-02', '02', '03', 2020, 2, 1, 92),
(366, 1, 1, 5, 53, 'Admision fee [Mar]', 2000, 0, 1, 1, 'Admin', '2020-03-06', '2020-03-06', '06', '03', 2020, 1, 1, 93),
(367, 1, 1, 5, 52, 'Monthly fee [Feb]', 1000, 0, 1, 1, 'Admin', '2020-03-07', '2020-03-07', '07', '03', 2020, 0, 1, 94),
(368, 1, 1, 5, 53, 'Admision fee [Mar]', 1000, 0, 1, 1, 'Admin', '2020-03-07', '2020-03-07', '07', '03', 2020, 2, 1, 95),
(369, 1, 1, 4, 52, 'Monthly fee [Feb]', 1000, 0, 1, 1, 'Admin', '2020-03-08', '2020-03-07', '07', '03', 2020, 0, 1, 96),
(370, 1, 1, 5, 52, 'Monthly fee [Feb]', 1000, 0, 1, 1, 'Admin', '2020-03-08', '2020-03-07', '07', '03', 2020, 1, 1, 97);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `issueID` int(11) UNSIGNED NOT NULL,
  `lID` varchar(128) NOT NULL,
  `bookID` int(11) NOT NULL,
  `serial_no` varchar(40) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issueID`, `lID`, `bookID`, `serial_no`, `issue_date`, `due_date`, `return_date`, `note`) VALUES
(1, '201902', 2, '353535', '2019-11-20', '2019-11-28', NULL, ''),
(2, '201903', 2, '201903', '2019-11-20', '2019-11-26', NULL, 'test'),
(3, '201903', 3, '201903', '2019-11-20', '2019-11-20', NULL, '201903');

-- --------------------------------------------------------

--
-- Table structure for table `leaveapplications`
--

CREATE TABLE `leaveapplications` (
  `leaveapplicationID` int(10) UNSIGNED NOT NULL,
  `leavecategoryID` int(10) UNSIGNED NOT NULL,
  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `od_status` tinyint(1) NOT NULL DEFAULT '0',
  `from_date` date NOT NULL,
  `from_time` time DEFAULT NULL,
  `to_date` date NOT NULL,
  `to_time` time DEFAULT NULL,
  `leave_days` int(11) NOT NULL,
  `reason` text,
  `attachment` varchar(200) DEFAULT NULL,
  `attachmentorginalname` varchar(200) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) UNSIGNED NOT NULL,
  `applicationto_userID` int(11) UNSIGNED DEFAULT NULL,
  `applicationto_usertypeID` int(11) UNSIGNED DEFAULT NULL,
  `approver_userID` int(11) UNSIGNED DEFAULT NULL,
  `approver_usertypeID` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `schoolyearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `leaveassign`
--

CREATE TABLE `leaveassign` (
  `leaveassignID` int(10) UNSIGNED NOT NULL,
  `leavecategoryID` int(10) UNSIGNED NOT NULL,
  `usertypeID` int(11) UNSIGNED NOT NULL,
  `leaveassignday` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leaveassign`
--

INSERT INTO `leaveassign` (`leaveassignID`, `leavecategoryID`, `usertypeID`, `leaveassignday`, `schoolyearID`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 2, 6, 3, 1, '2019-11-06 12:45:00', '2019-11-06 12:45:00', 1, 1),
(2, 2, 2, 4, 1, '2020-02-12 10:32:59', '2020-02-12 10:32:59', 1, 1),
(3, 3, 2, 3, 1, '2020-02-12 10:35:17', '2020-02-12 10:35:17', 1, 1),
(4, 3, 9, 3, 1, '2020-02-12 10:44:45', '2020-02-12 10:44:45', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `leavecategory`
--

CREATE TABLE `leavecategory` (
  `leavecategoryID` int(10) UNSIGNED NOT NULL,
  `leavecategory` varchar(255) NOT NULL,
  `leavegender` int(11) DEFAULT '0' COMMENT '1 = General, 2 = Male, 3 = Femele',
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leavecategory`
--

INSERT INTO `leavecategory` (`leavecategoryID`, `leavecategory`, `leavegender`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(2, 'hvh', 2, '2019-11-04 23:07:04', '2019-11-04 23:07:04', 1, 1),
(3, 'Ilness', 2, '2020-02-12 10:34:37', '2020-02-12 10:34:37', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lmember`
--

CREATE TABLE `lmember` (
  `lmemberID` int(11) UNSIGNED NOT NULL,
  `lID` varchar(40) NOT NULL,
  `studentID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `lbalance` varchar(20) DEFAULT NULL,
  `ljoindate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationID` int(11) UNSIGNED NOT NULL,
  `location` varchar(128) NOT NULL,
  `description` text,
  `create_date` date NOT NULL,
  `modify_date` date NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationID`, `location`, `description`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`, `active`) VALUES
(2, 'Library Main', '', '2019-11-10', '2019-11-10', 1, 1, 1),
(3, 'Library', '', '2020-02-04', '2020-02-04', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `loginlog`
--

CREATE TABLE `loginlog` (
  `loginlogID` int(11) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `browser` varchar(128) DEFAULT NULL,
  `operatingsystem` varchar(128) DEFAULT NULL,
  `login` int(11) UNSIGNED DEFAULT NULL,
  `logout` int(11) UNSIGNED DEFAULT NULL,
  `usertypeID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loginlog`
--

INSERT INTO `loginlog` (`loginlogID`, `ip`, `browser`, `operatingsystem`, `login`, `logout`, `usertypeID`, `userID`) VALUES
(1, '127.0.0.1', 'Google Chrome', 'windows', 1582851191, 1582851491, 1, 1),
(2, '127.0.0.1', 'Google Chrome', 'windows', 1582956703, 1582957003, 1, 1),
(3, '127.0.0.1', 'Google Chrome', 'windows', 1583128748, 1583131013, 1, 1),
(4, '127.0.0.1', 'Google Chrome', 'windows', 1583131060, 1583131360, 1, 1),
(5, '127.0.0.1', 'Google Chrome', 'windows', 1583276229, 1583276529, 1, 1),
(6, '127.0.0.1', 'Google Chrome', 'windows', 1583468473, 1583468773, 1, 1),
(7, '127.0.0.1', 'Google Chrome', 'windows', 1583555035, 1583557923, 1, 1),
(8, '127.0.0.1', 'Google Chrome', 'windows', 1583557939, 1583558241, 3, 4),
(9, '127.0.0.1', 'Google Chrome', 'windows', 1583558273, 1583558573, 1, 1),
(10, '127.0.0.1', 'Google Chrome', 'windows', 1583901724, 1583902622, 1, 1),
(11, '127.0.0.1', 'Google Chrome', 'windows', 1583902652, 1583903484, 3, 4),
(12, '127.0.0.1', 'Google Chrome', 'windows', 1583903498, 1583903723, 1, 1),
(13, '127.0.0.1', 'Google Chrome', 'windows', 1583903747, 1583904380, 2, 36),
(14, '127.0.0.1', 'Google Chrome', 'windows', 1583904416, 1583904716, 1, 1),
(15, '127.0.0.1', 'Google Chrome', 'windows', 1583963587, 1583964834, 1, 1),
(16, '127.0.0.1', 'Google Chrome', 'windows', 1583964868, 1583964966, 2, 36),
(17, '127.0.0.1', 'Google Chrome', 'windows', 1583964975, 1583964987, 2, 36),
(18, '127.0.0.1', 'Google Chrome', 'windows', 1583965012, 1583965312, 1, 1),
(19, '127.0.0.1', 'Google Chrome', 'windows', 1584048688, 1584048988, 1, 1),
(20, '127.0.0.1', 'Google Chrome', 'windows', 1584077448, 1584078000, 1, 1),
(21, '127.0.0.1', 'Google Chrome', 'windows', 1584078021, 1584078492, 3, 4),
(22, '127.0.0.1', 'Google Chrome', 'windows', 1584134824, 1584135124, 1, 1),
(23, '127.0.0.1', 'Google Chrome', 'windows', 1584422638, 1584422966, 1, 1),
(24, '127.0.0.1', 'Google Chrome', 'windows', 1584422994, 1584423116, 1, 1),
(25, '127.0.0.1', 'Google Chrome', 'windows', 1584423150, 1584423188, 1, 1),
(26, '127.0.0.1', 'Google Chrome', 'windows', 1584423219, 1584423366, 1, 1),
(27, '127.0.0.1', 'Google Chrome', 'windows', 1584423382, 1584423423, 1, 1),
(28, '127.0.0.1', 'Google Chrome', 'windows', 1584423436, 1584423492, 1, 1),
(29, '127.0.0.1', 'Google Chrome', 'windows', 1584423509, 1584423569, 1, 1),
(30, '127.0.0.1', 'Google Chrome', 'windows', 1584423583, 1584423631, 1, 1),
(31, '127.0.0.1', 'Google Chrome', 'windows', 1584423643, 1584423685, 1, 1),
(32, '127.0.0.1', 'Google Chrome', 'windows', 1584501760, 1584502322, 1, 1),
(33, '127.0.0.1', 'Google Chrome', 'windows', 1584505341, 1584505641, 1, 1),
(34, '127.0.0.1', 'Google Chrome', 'windows', 1584593834, 1584594976, 1, 1),
(35, '127.0.0.1', 'Google Chrome', 'windows', 1584597319, 1584597619, 1, 1),
(36, '127.0.0.1', 'Google Chrome', 'windows', 1584756299, 1584756599, 1, 1),
(37, '127.0.0.1', 'Google Chrome', 'windows', 1584938544, 1584940698, 1, 1),
(38, '127.0.0.1', 'Google Chrome', 'windows', 1584940719, 1584941277, 1, 1),
(39, '127.0.0.1', 'Google Chrome', 'windows', 1584941489, 1584941789, 1, 1),
(40, '127.0.0.1', 'Google Chrome', 'windows', 1584933310, 1584935658, 1, 1),
(41, '127.0.0.1', 'Google Chrome', 'windows', 1584935675, 1584936404, 1, 1),
(42, '127.0.0.1', 'Google Chrome', 'windows', 1584936416, 1584936497, 1, 1),
(43, '127.0.0.1', 'Google Chrome', 'windows', 1584936508, 1584936871, 1, 1),
(44, '127.0.0.1', 'Google Chrome', 'windows', 1584937574, 1584937620, 1, 1),
(45, '127.0.0.1', 'Google Chrome', 'windows', 1585018596, 1585018636, 1, 1),
(46, '127.0.0.1', 'Google Chrome', 'windows', 1586733553, 1586734212, 1, 1),
(47, '127.0.0.1', 'Google Chrome', 'windows', 1586734247, 1586734389, 2, 37),
(48, '127.0.0.1', 'Google Chrome', 'windows', 1586734416, 1586734769, 1, 1),
(49, '127.0.0.1', 'Google Chrome', 'windows', 1586734796, 1586734949, 2, 37),
(50, '127.0.0.1', 'Google Chrome', 'windows', 1586734979, 1586735141, 1, 1),
(51, '127.0.0.1', 'Google Chrome', 'windows', 1586735170, 1586735210, 2, 37),
(52, '127.0.0.1', 'Google Chrome', 'windows', 1586735233, 1586735464, 1, 1),
(53, '127.0.0.1', 'Google Chrome', 'windows', 1586735502, 1586735758, 2, 37),
(54, '127.0.0.1', 'Google Chrome', 'windows', 1586735785, 1586737050, 1, 1),
(55, '127.0.0.1', 'Google Chrome', 'windows', 1587070009, 1587070086, 1, 1),
(56, '127.0.0.1', 'Google Chrome', 'windows', 1587070129, 1587070178, 1, 1),
(57, '127.0.0.1', 'Google Chrome', 'windows', 1587070318, 1587070618, 1, 1),
(58, '127.0.0.1', 'Google Chrome', 'windows', 1587246531, 1587246831, 1, 1),
(59, '127.0.0.1', 'Google Chrome', 'windows', 1587437013, 1587437313, 1, 1),
(60, '127.0.0.1', 'Google Chrome', 'windows', 1587534149, 1587534449, 1, 1),
(61, '127.0.0.1', 'Google Chrome', 'windows', 1587534710, 1587534769, 1, 1),
(62, '127.0.0.1', 'Google Chrome', 'windows', 1587596697, 1587598048, 1, 1),
(63, '127.0.0.1', 'Google Chrome', 'windows', 1587598069, 1587598212, 1, 1),
(64, '127.0.0.1', 'Google Chrome', 'windows', 1587598235, 1587598308, 1, 1),
(65, '127.0.0.1', 'Google Chrome', 'windows', 1587598332, 1587599156, 1, 1),
(66, '127.0.0.1', 'Google Chrome', 'windows', 1587599199, 1587599457, 1, 1),
(67, '127.0.0.1', 'Google Chrome', 'windows', 1587599606, 1587600074, 1, 1),
(68, '127.0.0.1', 'Google Chrome', 'windows', 1587600126, 1587600135, 1, 1),
(69, '127.0.0.1', 'Google Chrome', 'windows', 1587932484, 1587932784, 1, 1),
(70, '127.0.0.1', 'Google Chrome', 'windows', 1587954512, 1587954812, 1, 1),
(71, '127.0.0.1', 'Google Chrome', 'windows', 1588136660, 1588137039, 1, 1),
(72, '127.0.0.1', 'Google Chrome', 'windows', 1588137089, 1588137258, 1, 1),
(73, '127.0.0.1', 'Google Chrome', 'windows', 1588137327, 1588139700, 1, 1),
(74, '127.0.0.1', 'Google Chrome', 'windows', 1588139726, 1588140026, 1, 1),
(75, '127.0.0.1', 'Google Chrome', 'windows', 1588308138, 1588308438, 1, 1),
(76, '127.0.0.1', 'Google Chrome', 'windows', 1589002956, 1589004858, 1, 1),
(77, '127.0.0.1', 'Google Chrome', 'windows', 1589005003, 1589005225, 1, 1),
(78, '127.0.0.1', 'Google Chrome', 'windows', 1589005003, 1589005303, 1, 1),
(79, '127.0.0.1', 'Google Chrome', 'windows', 1589005279, 1589005290, 1, 1),
(80, '127.0.0.1', 'Google Chrome', 'windows', 1589005279, 1589005579, 1, 1),
(81, '127.0.0.1', 'Google Chrome', 'windows', 1589005279, 1589005377, 1, 1),
(82, '127.0.0.1', 'Google Chrome', 'windows', 1589005321, 1589005621, 1, 1),
(83, '127.0.0.1', 'Google Chrome', 'windows', 1589005322, 1588993071, 1, 1),
(84, '127.0.0.1', 'Google Chrome', 'windows', 1588991375, 1588991675, 1, 1),
(85, '127.0.0.1', 'Google Chrome', 'windows', 1588991375, 1588995423, 1, 1),
(86, '127.0.0.1', 'Google Chrome', 'windows', 1588993618, 1588993918, 1, 1),
(87, '127.0.0.1', 'Google Chrome', 'windows', 1588995435, 1588996092, 3, 9),
(88, '127.0.0.1', 'Google Chrome', 'windows', 1588996121, 1588996256, 1, 1),
(89, '127.0.0.1', 'Google Chrome', 'windows', 1588996277, 1588996481, 3, 9),
(90, '127.0.0.1', 'Google Chrome', 'windows', 1588996641, 1588999678, 3, 9),
(91, '127.0.0.1', 'Google Chrome', 'windows', 1588999702, 1588999912, 1, 1),
(92, '127.0.0.1', 'Google Chrome', 'windows', 1588999928, 1589000228, 3, 9),
(93, '127.0.0.1', 'Google Chrome', 'windows', 1589073102, 1589079546, 1, 1),
(94, '127.0.0.1', 'Google Chrome', 'windows', 1589079583, 1589079938, 3, 9),
(95, '127.0.0.1', 'Google Chrome', 'windows', 1589510251, 1589510551, 1, 1),
(96, '127.0.0.1', 'Google Chrome', 'windows', 1589683736, 1589683842, 1, 1),
(97, '127.0.0.1', 'Google Chrome', 'windows', 1589683963, 1589684263, 1, 1),
(98, '127.0.0.1', 'Google Chrome', 'windows', 1589756497, 1589756509, 1, 1),
(99, '127.0.0.1', 'Google Chrome', 'windows', 1589756616, 1589756916, 1, 1),
(100, '127.0.0.1', 'Google Chrome', 'windows', 1590043442, 1590043742, 1, 1),
(101, '127.0.0.1', 'Google Chrome', 'windows', 1591067536, 1591067836, 1, 1),
(102, '127.0.0.1', 'Google Chrome', 'windows', 1591743426, 1591745615, 1, 1),
(103, '127.0.0.1', 'Google Chrome', 'windows', 1592113472, 1592113772, 1, 1),
(104, '127.0.0.1', 'Google Chrome', 'windows', 1593240936, 1593241995, 1, 1),
(105, '127.0.0.1', 'Google Chrome', 'windows', 1593242040, 1593242340, 1, 1),
(106, '127.0.0.1', 'Google Chrome', 'windows', 1593300319, 1593301256, 1, 1),
(107, '127.0.0.1', 'Google Chrome', 'windows', 1593301268, 1593303820, 1, 1),
(108, '127.0.0.1', 'Google Chrome', 'windows', 1593303837, 1593304137, 1, 1),
(109, '127.0.0.1', 'Google Chrome', 'windows', 1593581666, 1593585518, 1, 1),
(110, '127.0.0.1', 'Google Chrome', 'windows', 1593723184, 1593723484, 1, 1),
(111, '127.0.0.1', 'Google Chrome', 'windows', 1593994446, 1593995538, 1, 1),
(112, '127.0.0.1', 'Google Chrome', 'windows', 1593995577, 1593995877, 1, 1),
(113, '127.0.0.1', 'Google Chrome', 'windows', 1594159050, 1594159350, 1, 1),
(114, '127.0.0.1', 'Google Chrome', 'windows', 1594272455, 1594274698, 1, 1),
(115, '127.0.0.1', 'Google Chrome', 'windows', 1594332525, 1594332825, 1, 1),
(116, '127.0.0.1', 'Google Chrome', 'windows', 1595397458, 1595397537, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mailandsms`
--

CREATE TABLE `mailandsms` (
  `mailandsmsID` int(11) UNSIGNED NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `users` text NOT NULL,
  `type` varchar(16) NOT NULL,
  `senderusertypeID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `message` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mailandsms`
--

INSERT INTO `mailandsms` (`mailandsmsID`, `usertypeID`, `users`, `type`, `senderusertypeID`, `senderID`, `message`, `create_date`, `year`) VALUES
(1, 0, 'Noman', 'Other Email', 1, 1, 'Trial', '2019-07-05 20:17:24', 2019),
(2, 4, 'Sohail', 'Sms', 1, 1, 'dfdsfsd', '2019-07-13 07:43:29', 2019),
(3, 0, 'Rana', 'Other SMS', 1, 1, 'hello', '2019-08-28 06:01:27', 2019),
(4, 0, 'jabar', 'Other SMS', 1, 1, 'test', '2019-08-28 08:49:19', 2019),
(5, 0, 'Nakajima', 'Other Email', 1, 1, 'This is test massage from nakajima', '2019-08-29 00:20:00', 2019),
(6, 3, 'Gareth Kabuku', 'Email', 1, 1, 'test', '2019-08-29 12:44:36', 2019),
(7, 3, 'Gareth Kabuku', 'Sms', 1, 1, 'test', '2019-08-29 12:46:00', 2019),
(8, 1, 'Owner', 'Email', 1, 1, 'as', '2019-11-17 13:34:57', 2019),
(9, 3, 'Muhammad Ayyan ,Fatima iqbal ,Asjad Hafeez ,Qashood Hafeez ,', 'Email', 1, 1, 'yjdytxyx', '2020-02-12 12:58:33', 2020),
(10, 4, 'Hafeez ur rehman ,John Kabuku Malumani ,Malumani Malumani ,Pervez Bhaa ,Tanzeel ur rehman ,', 'Email', 1, 1, 'hgfghdfdtrs', '2020-03-04 11:30:52', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `mailandsmstemplate`
--

CREATE TABLE `mailandsmstemplate` (
  `mailandsmstemplateID` int(11) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `template` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mailandsmstemplate`
--

INSERT INTO `mailandsmstemplate` (`mailandsmstemplateID`, `name`, `usertypeID`, `type`, `template`, `create_date`) VALUES
(1, 'goshi', 4, 'sms', '[name][name]', '2020-03-04 11:24:46'),
(2, 'tanzeellllllll', 4, 'sms', '[name] \r\nPlease send the Fee on Due date.', '2020-03-04 11:28:08'),
(3, 'ayyan', 3, 'email', '[dob][dob][blood_group][blood_group][phone]', '2020-03-12 10:32:23'),
(4, 'PAK', 3, 'sms', '[register_no][extra_curricular_activities]', '2020-03-12 11:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `mailandsmstemplatetag`
--

CREATE TABLE `mailandsmstemplatetag` (
  `mailandsmstemplatetagID` int(11) UNSIGNED NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `tagname` varchar(128) NOT NULL,
  `mailandsmstemplatetag_extra` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mailandsmstemplatetag`
--

INSERT INTO `mailandsmstemplatetag` (`mailandsmstemplatetagID`, `usertypeID`, `tagname`, `mailandsmstemplatetag_extra`, `create_date`) VALUES
(1, 1, '[name]', NULL, '2016-12-11 04:36:33'),
(2, 1, '[dob]', NULL, '2016-12-11 04:37:31'),
(3, 1, '[gender]', NULL, '2016-12-11 04:37:31'),
(4, 1, '[religion]', NULL, '2016-12-11 04:39:51'),
(5, 1, '[email]', NULL, '2016-12-11 04:39:51'),
(6, 1, '[phone]', NULL, '2016-12-11 04:39:51'),
(7, 1, '[address]', NULL, '2016-12-11 04:39:51'),
(8, 1, '[jod]', NULL, '2016-12-11 04:39:51'),
(9, 1, '[username]', NULL, '2016-12-11 04:39:51'),
(10, 2, '[name]', NULL, '2016-12-11 04:40:50'),
(11, 2, '[designation]', NULL, '2016-12-11 04:43:27'),
(12, 2, '[dob]', NULL, '2016-12-11 04:46:21'),
(13, 2, '[gender]', NULL, '2016-12-11 04:46:21'),
(14, 2, '[religion]', NULL, '2016-12-11 04:46:21'),
(15, 2, '[email]', NULL, '2016-12-11 04:46:21'),
(16, 2, '[phone]', NULL, '2016-12-11 04:46:21'),
(17, 2, '[address]', NULL, '2016-12-11 04:46:21'),
(18, 2, '[jod]', NULL, '2016-12-11 04:46:21'),
(19, 2, '[username]', NULL, '2016-12-11 04:46:21'),
(20, 3, '[name]', NULL, '2016-12-11 04:47:09'),
(21, 3, '[dob]', NULL, '2016-12-11 04:55:54'),
(22, 3, '[gender]', NULL, '2016-12-11 04:55:54'),
(23, 3, '[blood_group]', NULL, '2016-12-11 04:55:54'),
(24, 3, '[religion]', NULL, '2016-12-11 04:55:54'),
(25, 3, '[email]', NULL, '2016-12-11 04:55:54'),
(26, 3, '[phone]', NULL, '2016-12-11 04:55:54'),
(27, 3, '[address]', NULL, '2016-12-11 04:55:54'),
(28, 3, '[state]', NULL, '2017-02-12 02:21:49'),
(29, 3, '[country]', NULL, '2017-02-12 02:21:27'),
(30, 3, '[class]', NULL, '2016-12-19 05:34:20'),
(31, 3, '[section]', NULL, '2016-12-11 04:55:54'),
(32, 3, '[group]', NULL, '2016-12-11 04:55:54'),
(33, 3, '[optional_subject]', NULL, '2016-12-11 04:55:54'),
(34, 3, '[register_no]', NULL, '2017-02-12 02:21:27'),
(35, 3, '[roll]', NULL, '2017-02-12 02:22:56'),
(36, 3, '[extra_curricular_activities]', NULL, '2017-02-12 02:22:56'),
(37, 3, '[remarks]', NULL, '2017-02-12 02:22:56'),
(38, 3, '[username]', NULL, '2016-12-11 04:55:54'),
(39, 3, '[result_table]', NULL, '2016-12-11 04:55:54'),
(40, 4, '[name]', NULL, '2016-12-11 04:57:31'),
(41, 4, '[father\'s_name]', NULL, '2016-12-11 05:04:19'),
(42, 4, '[mother\'s_name]', NULL, '2016-12-11 05:04:19'),
(43, 4, '[father\'s_profession]', NULL, '2016-12-11 05:04:19'),
(44, 4, '[mother\'s_profession]', NULL, '2016-12-11 05:04:19'),
(45, 4, '[email]', NULL, '2016-12-11 05:04:19'),
(46, 4, '[phone]', NULL, '2016-12-11 05:04:19'),
(47, 4, '[address]', NULL, '2016-12-11 05:04:19'),
(48, 4, '[username]', NULL, '2016-12-11 05:04:19'),
(49, 1, '[date]', NULL, '2018-05-11 17:12:12'),
(50, 2, '[date]', NULL, '2018-05-11 17:12:27'),
(51, 3, '[date]', NULL, '2018-05-11 17:12:36'),
(52, 4, '[date]', NULL, '2018-05-11 17:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `maininvoice`
--

CREATE TABLE `maininvoice` (
  `maininvoiceID` int(11) UNSIGNED NOT NULL,
  `maininvoiceschoolyearID` int(11) NOT NULL,
  `maininvoiceclassesID` int(11) NOT NULL,
  `maininvoicestudentID` int(11) NOT NULL,
  `maininvoiceuserID` int(11) DEFAULT NULL,
  `maininvoiceusertypeID` int(11) DEFAULT NULL,
  `maininvoiceuname` varchar(60) DEFAULT NULL,
  `maininvoicedate` date NOT NULL,
  `maininvoicecreate_date` date NOT NULL,
  `maininvoiceday` varchar(20) DEFAULT NULL,
  `maininvoicemonth` varchar(20) DEFAULT NULL,
  `maininvoiceyear` year(4) NOT NULL,
  `maininvoicestatus` int(11) DEFAULT NULL,
  `maininvoicedeleted_at` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maininvoice`
--

INSERT INTO `maininvoice` (`maininvoiceID`, `maininvoiceschoolyearID`, `maininvoiceclassesID`, `maininvoicestudentID`, `maininvoiceuserID`, `maininvoiceusertypeID`, `maininvoiceuname`, `maininvoicedate`, `maininvoicecreate_date`, `maininvoiceday`, `maininvoicemonth`, `maininvoiceyear`, `maininvoicestatus`, `maininvoicedeleted_at`) VALUES
(1, 1, 1, 1, 1, 1, 'superadmin', '2019-07-09', '2019-07-05', '05', '07', 2019, 0, 0),
(2, 1, 1, 1, 1, 1, 'superadmin', '2019-07-09', '2019-07-05', '05', '07', 2019, 0, 0),
(3, 1, 1, 1, 1, 1, 'superadmin', '2019-03-31', '2019-07-15', '15', '07', 2019, 0, 0),
(4, 1, 2, 2, 1, 1, 'superadmin', '2019-07-10', '2019-07-15', '15', '07', 2019, 1, 1),
(5, 1, 2, 3, 1, 1, 'superadmin', '2019-03-20', '2019-07-15', '15', '07', 2019, 2, 1),
(6, 1, 2, 4, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(7, 1, 4, 5, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(8, 1, 4, 5, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(9, 1, 4, 5, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(10, 1, 4, 6, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1),
(11, 1, 4, 5, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(12, 1, 4, 7, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(13, 1, 4, 6, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1),
(14, 1, 4, 5, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(15, 1, 4, 7, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(16, 1, 4, 6, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1),
(17, 1, 4, 8, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(18, 1, 4, 5, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(19, 1, 4, 7, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(20, 1, 4, 6, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 1, 1),
(21, 1, 4, 8, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(22, 1, 4, 9, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(23, 1, 2, 10, 1, 1, 'superadmin', '2019-07-01', '2019-07-15', '15', '07', 2019, 0, 1),
(24, 1, 1, 1, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(25, 1, 2, 2, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(26, 1, 2, 3, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(27, 1, 2, 4, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(28, 1, 4, 5, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(29, 1, 4, 6, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(30, 1, 4, 7, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(31, 1, 4, 8, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(32, 1, 4, 9, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(33, 1, 2, 10, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(34, 1, 5, 18, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(35, 1, 5, 19, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(36, 1, 5, 20, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(37, 1, 5, 21, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(38, 1, 5, 22, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(39, 1, 5, 23, 1, 1, 'superadmin', '2019-07-24', '2019-07-24', '24', '07', 2019, 0, 0),
(40, 1, 1, 1, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(41, 1, 2, 2, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(42, 1, 2, 3, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1),
(43, 1, 2, 4, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(44, 1, 4, 5, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(45, 1, 4, 6, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 2, 1),
(46, 1, 4, 7, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(47, 1, 4, 8, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(48, 1, 4, 9, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(49, 1, 2, 10, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(50, 1, 5, 18, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(51, 1, 5, 19, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(52, 1, 5, 20, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(53, 1, 5, 21, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(54, 1, 5, 22, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(55, 1, 5, 23, 1, 1, 'superadmin', '2019-07-25', '2019-07-25', '25', '07', 2019, 0, 1),
(56, 1, 1, 34, 1, 1, 'superadmin', '2019-07-25', '2019-08-02', '02', '08', 2019, 0, 1),
(57, 1, 3, 119, 1, 1, 'superadmin', '2019-08-03', '2019-08-04', '04', '08', 2019, 0, 1),
(58, 1, 6, 170, 1, 1, 'superadmin', '2019-08-03', '2019-08-04', '04', '08', 2019, 0, 1),
(59, 1, 6, 170, 1, 1, 'superadmin', '2019-09-24', '2019-08-04', '04', '08', 2019, 0, 1),
(60, 1, 6, 174, 1, 1, 'superadmin', '2019-08-10', '2019-08-04', '04', '08', 2019, 0, 1),
(61, 1, 7, 181, 1, 1, 'superadmin', '2019-12-07', '2019-08-04', '04', '08', 2019, 0, 1),
(62, 1, 6, 170, 1, 1, 'superadmin', '2019-10-03', '2019-08-04', '04', '08', 2019, 0, 1),
(63, 1, 6, 170, 1, 1, 'superadmin', '2019-11-03', '2019-08-04', '04', '08', 2019, 0, 1),
(64, 1, 6, 170, 1, 1, 'superadmin', '2019-12-03', '2019-08-04', '04', '08', 2019, 0, 1),
(65, 1, 14, 364, 1, 1, 'superadmin', '2019-08-25', '2019-08-05', '05', '08', 2019, 0, 0),
(66, 1, 12, 116, 1, 1, 'superadmin', '2019-07-25', '2019-08-06', '06', '08', 2019, 0, 0),
(67, 1, 12, 117, 1, 1, 'superadmin', '2019-07-25', '2019-08-06', '06', '08', 2019, 0, 0),
(68, 1, 12, 118, 1, 1, 'superadmin', '2019-07-25', '2019-08-06', '06', '08', 2019, 0, 0),
(69, 1, 5, 319, 1, 1, 'superadmin', '2019-08-04', '2019-08-07', '07', '08', 2019, 0, 0),
(70, 1, 5, 319, 1, 1, 'superadmin', '2019-08-07', '2019-08-07', '07', '08', 2019, 0, 0),
(71, 1, 4, 304, 1, 1, 'superadmin', '2019-07-31', '2019-08-19', '19', '08', 2019, 0, 0),
(72, 1, 12, 116, 1, 1, 'superadmin', '2019-08-17', '2019-08-19', '19', '08', 2019, 0, 0),
(73, 1, 12, 116, 1, 1, 'superadmin', '2019-07-31', '2019-08-19', '19', '08', 2019, 0, 0),
(74, 1, 12, 116, 1, 1, 'superadmin', '2019-06-24', '2019-08-21', '21', '08', 2019, 0, 0),
(75, 1, 12, 1, 1, 1, 'Owner', '2019-09-18', '2019-08-27', '27', '08', 2019, 1, 1),
(76, 1, 12, 5, 1, 1, 'Owner', '2019-10-10', '2019-10-14', '14', '10', 2019, 2, 1),
(77, 1, 1, 10, 1, 1, 'Owner', '2019-11-08', '2019-11-14', '14', '11', 2019, 1, 1),
(78, 1, 1, 10, 1, 1, 'Owner', '2019-11-20', '2019-11-14', '14', '11', 2019, 1, 1),
(79, 1, 12, 3, 1, 1, 'Tanzeel', '2020-02-07', '2020-02-07', '07', '02', 2020, 2, 1),
(80, 1, 19, 1, 1, 1, 'Tanzeel', '2020-02-07', '2020-02-07', '07', '02', 2020, 0, 0),
(81, 1, 19, 2, 1, 1, 'Tanzeel', '2020-02-07', '2020-02-07', '07', '02', 2020, 0, 0),
(82, 1, 12, 3, 1, 1, 'Admin', '2020-02-08', '2020-02-09', '09', '02', 2020, 2, 1),
(83, 1, 19, 1, 1, 1, 'Admin', '2020-02-09', '2020-02-09', '09', '02', 2020, 0, 0),
(84, 1, 19, 2, 1, 1, 'Admin', '2020-02-09', '2020-02-09', '09', '02', 2020, 2, 1),
(85, 1, 19, 1, 1, 1, 'Admin', '2020-02-01', '2020-02-09', '09', '02', 2020, 0, 1),
(86, 1, 19, 2, 1, 1, 'Admin', '2020-02-02', '2020-02-10', '10', '02', 2020, 0, 1),
(87, 1, 12, 3, 1, 1, 'Admin', '2020-02-10', '2020-02-10', '10', '02', 2020, 2, 1),
(88, 1, 1, 4, 1, 1, 'Admin', '2020-02-12', '2020-02-12', '12', '02', 2020, 2, 1),
(89, 1, 1, 4, 1, 1, 'Admin', '2020-02-19', '2020-02-24', '24', '02', 2020, 0, 1),
(90, 1, 19, 1, 1, 1, 'Admin', '2020-02-17', '2020-02-26', '26', '02', 2020, 0, 1),
(91, 1, 19, 2, 1, 1, 'Admin', '2020-02-17', '2020-02-26', '26', '02', 2020, 2, 1),
(92, 1, 1, 4, 1, 1, 'Admin', '2020-03-02', '2020-03-02', '02', '03', 2020, 2, 1),
(93, 1, 1, 5, 1, 1, 'Admin', '2020-03-06', '2020-03-06', '06', '03', 2020, 1, 1),
(94, 1, 1, 5, 1, 1, 'Admin', '2020-03-07', '2020-03-07', '07', '03', 2020, 0, 1),
(95, 1, 1, 5, 1, 1, 'Admin', '2020-03-07', '2020-03-07', '07', '03', 2020, 2, 1),
(96, 1, 1, 4, 1, 1, 'Admin', '2020-03-08', '2020-03-07', '07', '03', 2020, 0, 1),
(97, 1, 1, 5, 1, 1, 'Admin', '2020-03-08', '2020-03-07', '07', '03', 2020, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `make_payment`
--

CREATE TABLE `make_payment` (
  `make_paymentID` int(11) NOT NULL,
  `month` text NOT NULL,
  `gross_salary` text NOT NULL,
  `total_deduction` text NOT NULL,
  `net_salary` text NOT NULL,
  `payment_amount` text NOT NULL,
  `payment_method` int(11) NOT NULL,
  `comments` text,
  `templateID` int(11) NOT NULL,
  `salaryID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `schoolyearID` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL,
  `total_hours` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `make_payment`
--

INSERT INTO `make_payment` (`make_paymentID`, `month`, `gross_salary`, `total_deduction`, `net_salary`, `payment_amount`, `payment_method`, `comments`, `templateID`, `salaryID`, `usertypeID`, `userID`, `schoolyearID`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `total_hours`) VALUES
(3, '08-2019', '0', '0', '6500', '6500', 1, '', 1, 1, 2, 20, 1, '2019-08-07 10:25:45', '2019-08-07 10:25:45', 1, 'ctech', 'Admin', NULL),
(6, '07-2019', '0', '0', '6000', '6000', 1, '', 2, 1, 2, 4, 1, '2019-08-07 10:56:47', '2019-08-07 10:56:47', 1, 'ctech', 'Admin', NULL),
(7, '07-2019', '0', '0', '2500', '2500', 1, '', 9, 1, 2, 16, 1, '2019-08-07 11:00:50', '2019-08-07 11:00:50', 1, 'ctech', 'Admin', NULL),
(8, '07-2019', '0', '0', '2000', '2000', 1, '', 10, 1, 2, 15, 1, '2019-08-07 11:01:41', '2019-08-07 11:01:41', 1, 'ctech', 'Admin', NULL),
(9, '07-2019', '0', '0', '5000', '5000', 1, '', 4, 1, 2, 5, 1, '2019-08-07 11:06:42', '2019-08-07 11:06:42', 1, 'ctech', 'Admin', NULL),
(10, '07-2019', '0', '0', '6000', '6000', 1, '', 2, 1, 2, 3, 1, '2019-08-07 11:08:01', '2019-08-07 11:08:01', 1, 'ctech', 'Admin', NULL),
(11, '07-2019', '0', '0', '6000', '6000', 1, '', 2, 1, 2, 2, 1, '2019-08-07 11:08:37', '2019-08-07 11:08:37', 1, 'ctech', 'Admin', NULL),
(13, '07-2019', '0', '0', '3500', '3500', 1, '', 7, 1, 2, 7, 1, '2019-08-07 11:15:02', '2019-08-07 11:15:02', 1, 'ctech', 'Admin', NULL),
(14, '07-2019', '0', '0', '4000', '4000', 1, '', 6, 1, 2, 6, 1, '2019-08-07 11:15:27', '2019-08-07 11:15:27', 1, 'ctech', 'Admin', NULL),
(15, '07-2019', '0', '0', '6000', '6000', 1, '', 2, 1, 2, 8, 1, '2019-08-07 11:16:05', '2019-08-07 11:16:05', 1, 'ctech', 'Admin', NULL),
(16, '07-2019', '0', '0', '6000', '6000', 1, '', 2, 1, 2, 9, 1, '2019-08-07 11:17:40', '2019-08-07 11:17:40', 1, 'ctech', 'Admin', NULL),
(17, '07-2019', '0', '0', '5000', '5000', 1, '', 4, 1, 2, 10, 1, '2019-08-07 11:18:28', '2019-08-07 11:18:28', 1, 'ctech', 'Admin', NULL),
(18, '07-2019', '0', '0', '5000', '5000', 1, '', 4, 1, 2, 12, 1, '2019-08-07 11:18:58', '2019-08-07 11:18:58', 1, 'ctech', 'Admin', NULL),
(19, '07-2019', '0', '0', '4500', '4500', 1, '', 5, 1, 2, 13, 1, '2019-08-07 11:20:01', '2019-08-07 11:20:01', 1, 'ctech', 'Admin', NULL),
(20, '07-2019', '0', '0', '4000', '4000', 1, '', 6, 1, 2, 14, 1, '2019-08-07 11:23:00', '2019-08-07 11:23:00', 1, 'ctech', 'Admin', NULL),
(21, '07-2019', '0', '0', '6000', '6000', 1, '', 2, 1, 2, 18, 1, '2019-08-07 11:24:46', '2019-08-07 11:24:46', 1, 'ctech', 'Admin', NULL),
(22, '07-2019', '0', '0', '4000', '4000', 1, '', 6, 1, 2, 19, 1, '2019-08-07 11:25:23', '2019-08-07 11:25:23', 1, 'ctech', 'Admin', NULL),
(23, '07-2019', '0', '0', '3000', '3000', 1, '', 8, 1, 2, 23, 1, '2019-08-14 15:47:58', '2019-08-14 15:47:58', 1, 'ctech', 'Admin', NULL),
(24, '07-2019', '0', '0', '6500', '6500', 1, '', 1, 1, 2, 26, 1, '2019-08-14 15:48:39', '2019-08-14 15:48:39', 1, 'ctech', 'Admin', NULL),
(25, '07-2019', '0', '0', '3500', '3500', 1, '', 7, 1, 2, 24, 1, '2019-08-14 15:49:16', '2019-08-14 15:49:16', 1, 'ctech', 'Admin', NULL),
(26, '07-2019', '0', '0', '5000', '5000', 1, '', 4, 1, 2, 17, 1, '2019-08-17 13:11:00', '2019-08-17 13:11:00', 1, 'ctech', 'Admin', NULL),
(27, '10-2019', '0', '0', '200', '200', 2, '', 12, 1, 9, 1, 1, '2019-10-19 14:50:42', '2019-10-19 14:50:42', 1, 'ctech', 'Admin', NULL),
(28, '02-2020', '0', '0', '200', '1500', 2, '', 12, 1, 6, 7, 1, '2020-02-04 18:05:57', '2020-02-04 18:05:57', 1, 'ctech', 'Admin', NULL),
(29, '02-2020', '0', '0', '200', '200', 1, '', 12, 1, 6, 7, 1, '2020-02-07 09:06:34', '2020-02-07 09:06:34', 1, 'ctech', 'Admin', NULL),
(30, '02-2020', '200', '0', '2700', '2700', 1, '', 13, 1, 2, 32, 1, '2020-02-09 18:53:21', '2020-02-09 18:53:21', 1, 'ctech', 'Admin', NULL),
(31, '02-2020', '5000', '0', '20000', '15000', 1, '', 15, 1, 9, 8, 1, '2020-02-12 10:29:47', '2020-02-12 10:29:47', 1, 'ctech', 'Admin', NULL),
(32, '02-2020', '5000', '0', '20000', '200000', 1, '', 15, 1, 9, 8, 1, '2020-02-12 18:35:53', '2020-02-12 18:35:53', 1, 'ctech', 'Admin', NULL),
(35, '03-2020', '200', '0', '2700', '2700', 1, '', 13, 1, 2, 32, 1, '2020-03-07 10:29:54', '2020-03-07 10:29:54', 1, 'ctech', 'Admin', NULL),
(36, '03-2020', '200', '0', '2700', '2700', 1, '', 13, 1, 2, 32, 1, '2020-03-07 10:32:12', '2020-03-07 10:32:12', 1, 'ctech', 'Admin', NULL),
(37, '02-2020', '200', '0', '2700', '2700', 1, '', 13, 1, 2, 32, 1, '2020-03-07 10:33:18', '2020-03-07 10:33:18', 1, 'ctech', 'Admin', NULL),
(39, '03-2020', '100', '0', '12100', '12100', 1, '', 17, 1, 2, 35, 1, '2020-03-12 14:59:32', '2020-03-12 14:59:32', 1, 'ctech', 'Admin', NULL),
(40, '03-2020', '200', '0', '2700', '2700', 1, '', 13, 1, 2, 32, 1, '2020-03-12 15:05:46', '2020-03-12 15:05:46', 1, 'ctech', 'Admin', NULL),
(41, '05-2020', '200', '0', '2700', '2700', 1, '', 13, 1, 2, 32, 1, '2020-05-10 19:57:37', '2020-05-10 19:57:37', 1, 'ctech', 'Admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manage_salary`
--

CREATE TABLE `manage_salary` (
  `manage_salaryID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manage_salary`
--

INSERT INTO `manage_salary` (`manage_salaryID`, `userID`, `usertypeID`, `salary`, `template`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(2, 4, 2, 1, 2, '2019-08-03 20:45:43', '2019-08-06 15:19:59', 1, 'ctech', 'Admin'),
(3, 19, 2, 1, 6, '2019-08-05 11:58:06', '2019-08-06 15:20:35', 1, 'ctech', 'Admin'),
(5, 16, 2, 1, 9, '2019-08-06 11:01:25', '2019-08-06 15:20:56', 1, 'ctech', 'Admin'),
(6, 15, 2, 1, 10, '2019-08-06 11:03:15', '2019-08-06 15:22:01', 1, 'ctech', 'Admin'),
(7, 5, 2, 1, 4, '2019-08-06 11:04:20', '2019-08-06 11:04:37', 1, 'ctech', 'Admin'),
(8, 8, 2, 1, 2, '2019-08-06 11:05:07', '2019-08-06 11:05:07', 1, 'ctech', 'Admin'),
(9, 14, 2, 1, 6, '2019-08-06 11:05:33', '2019-08-06 11:05:33', 1, 'ctech', 'Admin'),
(10, 9, 2, 1, 2, '2019-08-06 11:06:10', '2019-08-06 11:06:10', 1, 'ctech', 'Admin'),
(11, 6, 2, 1, 6, '2019-08-06 11:06:47', '2019-08-06 11:06:47', 1, 'ctech', 'Admin'),
(12, 7, 2, 1, 7, '2019-08-06 11:07:40', '2019-08-06 11:07:40', 1, 'ctech', 'Admin'),
(13, 10, 2, 1, 4, '2019-08-06 11:08:20', '2019-08-06 11:08:20', 1, 'ctech', 'Admin'),
(14, 13, 2, 1, 5, '2019-08-06 11:10:10', '2019-08-06 11:10:10', 1, 'ctech', 'Admin'),
(15, 3, 2, 1, 2, '2019-08-06 11:12:24', '2019-08-06 11:12:24', 1, 'ctech', 'Admin'),
(16, 18, 2, 1, 2, '2019-08-06 11:13:57', '2019-08-06 11:13:57', 1, 'ctech', 'Admin'),
(17, 12, 2, 1, 4, '2019-08-06 11:16:34', '2019-08-06 11:16:34', 1, 'ctech', 'Admin'),
(18, 17, 2, 1, 4, '2019-08-06 11:18:03', '2019-08-06 11:18:03', 1, 'ctech', 'Admin'),
(19, 2, 2, 1, 2, '2019-08-06 11:18:57', '2019-08-06 11:18:57', 1, 'ctech', 'Admin'),
(20, 26, 2, 1, 1, '2019-08-14 15:43:13', '2019-08-14 15:43:13', 1, 'ctech', 'Admin'),
(21, 24, 2, 1, 7, '2019-08-14 15:44:33', '2019-08-14 15:44:33', 1, 'ctech', 'Admin'),
(22, 25, 2, 1, 1, '2019-08-14 15:44:48', '2019-08-14 15:44:48', 1, 'ctech', 'Admin'),
(23, 23, 2, 1, 8, '2019-08-14 15:45:15', '2019-08-14 15:45:15', 1, 'ctech', 'Admin'),
(24, 11, 2, 1, 7, '2019-08-14 15:45:47', '2019-08-14 15:45:47', 1, 'ctech', 'Admin'),
(25, 1, 9, 1, 12, '2019-10-19 14:49:54', '2019-10-19 14:49:54', 1, 'ctech', 'Admin'),
(26, 2, 9, 1, 12, '2019-11-01 16:19:37', '2019-11-01 16:19:37', 1, 'ctech', 'Admin'),
(27, 28, 2, 1, 12, '2019-11-04 23:03:53', '2019-11-04 23:03:53', 1, 'ctech', 'Admin'),
(28, 5, 9, 1, 12, '2019-11-06 12:41:10', '2019-11-06 12:41:10', 1, 'ctech', 'Admin'),
(29, 7, 6, 1, 12, '2019-11-27 11:15:01', '2019-11-27 11:15:01', 1, 'ctech', 'Admin'),
(31, 32, 2, 1, 13, '2020-02-09 18:52:39', '2020-02-09 18:52:39', 1, 'ctech', 'Admin'),
(32, 8, 9, 1, 15, '2020-02-12 10:27:49', '2020-02-12 18:34:14', 1, 'ctech', 'Admin'),
(33, 35, 2, 1, 17, '2020-03-07 10:31:04', '2020-03-07 10:31:04', 1, 'ctech', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE `mark` (
  `markID` int(200) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `examID` int(11) NOT NULL,
  `exam` varchar(60) NOT NULL,
  `studentID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `year` year(4) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL DEFAULT '0',
  `create_usertypeID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`markID`, `schoolyearID`, `examID`, `exam`, `studentID`, `classesID`, `subjectID`, `subject`, `year`, `create_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 1, 1, 'Mid Term', 4, 1, 32, 'Islamiat', 2020, '2020-02-28 15:09:03', 1, 1),
(2, 1, 1, 'Mid Term', 5, 1, 32, 'Islamiat', 2020, '2020-02-28 15:09:03', 1, 1),
(3, 1, 1, 'Mid Term', 4, 1, 33, 'English', 2020, '2020-02-28 15:10:04', 1, 1),
(4, 1, 1, 'Mid Term', 5, 1, 33, 'English', 2020, '2020-02-28 15:10:04', 1, 1),
(5, 1, 1, 'Mid Term', 4, 1, 34, 'Math', 2020, '2020-02-28 15:10:28', 1, 1),
(6, 1, 1, 'Mid Term', 5, 1, 34, 'Math', 2020, '2020-02-28 15:10:28', 1, 1),
(7, 1, 1, 'Mid Term', 4, 1, 35, 'Urdu', 2020, '2020-02-28 15:10:58', 1, 1),
(8, 1, 1, 'Mid Term', 5, 1, 35, 'Urdu', 2020, '2020-02-28 15:10:58', 1, 1),
(9, 1, 1, 'Mid Term', 4, 1, 36, 'Nazra', 2020, '2020-02-28 15:11:20', 1, 1),
(10, 1, 1, 'Mid Term', 5, 1, 36, 'Nazra', 2020, '2020-02-28 15:11:20', 1, 1),
(11, 1, 1, 'Mid Term', 4, 1, 37, 'Science', 2020, '2020-02-28 15:11:46', 1, 1),
(12, 1, 1, 'Mid Term', 5, 1, 37, 'Science', 2020, '2020-02-28 15:11:46', 1, 1),
(13, 1, 1, 'Mid Term', 4, 1, 39, 'Computer', 2020, '2020-02-28 15:13:08', 1, 1),
(14, 1, 1, 'Mid Term', 5, 1, 39, 'Computer', 2020, '2020-02-28 15:13:08', 1, 1),
(15, 1, 1, 'Mid Term', 4, 1, 40, 'Drawing', 2020, '2020-02-28 15:13:35', 1, 1),
(16, 1, 1, 'Mid Term', 5, 1, 40, 'Drawing', 2020, '2020-02-28 15:13:35', 1, 1),
(17, 1, 1, 'Mid Term', 4, 1, 47, 'Social Studies', 2020, '2020-02-28 15:14:00', 1, 1),
(18, 1, 1, 'Mid Term', 5, 1, 47, 'Social Studies', 2020, '2020-02-28 15:14:00', 1, 1),
(19, 1, 1, 'Mid Term', 4, 1, 110, 'Pakistan Studies', 2020, '2020-02-28 15:14:24', 1, 1),
(20, 1, 1, 'Mid Term', 5, 1, 110, 'Pakistan Studies', 2020, '2020-02-28 15:14:24', 1, 1),
(21, 1, 1, 'Mid Term', 3, 12, 112, 'Pak Sudies', 2020, '2020-03-11 22:33:01', 1, 1),
(22, 1, 1, 'Mid Term', 6, 12, 112, 'Pak Sudies', 2020, '2020-03-11 22:33:01', 1, 1),
(23, 1, 1, 'Mid Term', 9, 1, 33, 'English', 2020, '2020-05-10 19:40:02', 1, 1),
(24, 1, 3, 'Third Semester', 4, 1, 34, 'Math', 2020, '2020-06-10 16:00:52', 1, 1),
(25, 1, 3, 'Third Semester', 9, 1, 34, 'Math', 2020, '2020-06-10 16:00:52', 1, 1),
(26, 1, 3, 'Third Semester', 5, 1, 34, 'Math', 2020, '2020-06-10 16:00:52', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `markpercentage`
--

CREATE TABLE `markpercentage` (
  `markpercentageID` int(11) NOT NULL,
  `markpercentagetype` varchar(100) NOT NULL,
  `percentage` double NOT NULL,
  `examID` int(11) DEFAULT NULL,
  `classesID` int(11) DEFAULT NULL,
  `subjectID` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `markpercentage`
--

INSERT INTO `markpercentage` (`markpercentageID`, `markpercentagetype`, `percentage`, `examID`, `classesID`, `subjectID`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(1, 'Mid Term Exam', 100, NULL, NULL, NULL, '2017-01-05 06:11:54', '2020-02-27 08:43:52', 1, 'admin', 'Admin'),
(2, 'Final Term', 100, NULL, NULL, NULL, '2020-02-04 04:50:17', '2020-02-24 09:06:39', 1, 'ctech', 'Admin'),
(3, 'Third Term', 50, NULL, NULL, NULL, '2020-05-10 06:14:26', '2020-05-10 06:14:26', 1, 'ctech', 'Admin'),
(4, 'Semester one', 50, NULL, NULL, NULL, '2020-05-10 07:36:20', '2020-05-10 07:36:20', 1, 'ctech', 'Admin'),
(5, 'goshi', 100, NULL, NULL, NULL, '2020-06-10 03:58:11', '2020-06-10 03:58:11', 1, 'goshi', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `markrelation`
--

CREATE TABLE `markrelation` (
  `markrelationID` int(11) UNSIGNED NOT NULL,
  `markID` int(11) NOT NULL,
  `markpercentageID` int(11) NOT NULL,
  `mark` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `markrelation`
--

INSERT INTO `markrelation` (`markrelationID`, `markID`, `markpercentageID`, `mark`) VALUES
(1, 1, 1, '75'),
(2, 1, 2, NULL),
(3, 2, 1, '85'),
(4, 2, 2, NULL),
(5, 3, 1, '96'),
(6, 3, 2, NULL),
(7, 4, 1, '95'),
(8, 4, 2, NULL),
(9, 5, 1, '65'),
(10, 5, 2, NULL),
(11, 6, 1, '55'),
(12, 6, 2, NULL),
(13, 7, 1, '85'),
(14, 7, 2, NULL),
(15, 8, 1, '84'),
(16, 8, 2, NULL),
(17, 9, 1, '69'),
(18, 9, 2, NULL),
(19, 10, 1, '54'),
(20, 10, 2, NULL),
(21, 11, 1, '87'),
(22, 11, 2, NULL),
(23, 12, 1, '98'),
(24, 12, 2, NULL),
(25, 13, 1, '95'),
(26, 13, 2, NULL),
(27, 14, 1, '94'),
(28, 14, 2, NULL),
(29, 15, 1, '90'),
(30, 15, 2, NULL),
(31, 16, 1, '90'),
(32, 16, 2, NULL),
(33, 17, 1, '68'),
(34, 17, 2, NULL),
(35, 18, 1, '69'),
(36, 18, 2, NULL),
(37, 19, 1, '56'),
(38, 19, 2, NULL),
(39, 20, 1, '94'),
(40, 20, 2, NULL),
(41, 21, 1, NULL),
(42, 21, 2, NULL),
(43, 22, 1, NULL),
(44, 22, 2, NULL),
(45, 23, 1, NULL),
(46, 23, 2, NULL),
(47, 23, 3, NULL),
(48, 23, 4, NULL),
(49, 3, 3, NULL),
(50, 3, 4, NULL),
(51, 4, 3, NULL),
(52, 4, 4, NULL),
(53, 24, 1, NULL),
(54, 24, 2, NULL),
(55, 24, 3, NULL),
(56, 24, 4, NULL),
(57, 24, 5, NULL),
(58, 25, 1, NULL),
(59, 25, 2, NULL),
(60, 25, 3, NULL),
(61, 25, 4, NULL),
(62, 25, 5, NULL),
(63, 26, 1, NULL),
(64, 26, 2, NULL),
(65, 26, 3, NULL),
(66, 26, 4, NULL),
(67, 26, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `mediaID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `mcategoryID` int(11) NOT NULL DEFAULT '0',
  `file_name` varchar(255) NOT NULL,
  `file_name_display` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`mediaID`, `userID`, `usertypeID`, `mcategoryID`, `file_name`, `file_name_display`) VALUES
(2, 1, 1, 2, '3231914747933941501.pdf', 'Combined Ad No.02-2018 without APS_0.pdf'),
(4, 1, 1, 0, '7615658001149307342.mp4', 'school management 1.mp4'),
(5, 1, 1, 0, '3605442988581678621.mp4', 'pos.mp4'),
(6, 1, 1, 0, '8963798200007807733.mp4', 'pos.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `media_category`
--

CREATE TABLE `media_category` (
  `mcategoryID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `media_gallery`
--

CREATE TABLE `media_gallery` (
  `media_galleryID` int(11) NOT NULL,
  `media_gallery_type` int(11) NOT NULL,
  `file_type` varchar(40) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_original_name` varchar(255) DEFAULT NULL,
  `file_title` text NOT NULL,
  `file_size` varchar(40) DEFAULT NULL,
  `file_width_height` varchar(40) DEFAULT NULL,
  `file_upload_date` datetime DEFAULT NULL,
  `file_caption` text,
  `file_alt_text` varchar(255) DEFAULT NULL,
  `file_description` text,
  `file_length` varchar(128) DEFAULT NULL,
  `file_artist` varchar(128) DEFAULT NULL,
  `file_album` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_gallery`
--

INSERT INTO `media_gallery` (`media_galleryID`, `media_gallery_type`, `file_type`, `file_name`, `file_original_name`, `file_title`, `file_size`, `file_width_height`, `file_upload_date`, `file_caption`, `file_alt_text`, `file_description`, `file_length`, `file_artist`, `file_album`) VALUES
(1, 1, 'jpg', '3ddf9402a1e5029a832060ad7c980b072a6f0b584c888e250143fc5cc666a96ed67c980db4b0aaf9dbbfe154f07c1a602db55cc6e67536546fc725f2ba6dc558.jpg', 'lingo school longo.jpg', 'Lingo School ', '37.52 KB', '1147 x 160', '2019-07-16 01:00:20', 'Lingo School ', 'Lingo School ', 'Lingo School ', NULL, '', ''),
(2, 1, 'jpg', 'c281f356476fabd400d0f3ae072515dc57c11acf413530bf82c8f366d8e23daf5fa9fb5cc30f742a66d69adf885f20cb919905b8658554a18c4e49330f9d71d5.jpg', 'lingo school log small.jpg', 'lingo school log small', '14.76 KB', '200 x 28', '2019-07-16 01:00:32', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'jpg', 'db0ccc470e24e96a149e5d36dc9de34457cf92bcf6bea54990823394ec674c74f96635f9a4b1ad1fb45f665b72125376b8853886ac282999d9821fb7a9d22f45.jpg', 'googleapple.jpg', 'googleapple', '21.89 KB', '640 x 266', '2019-08-27 02:53:07', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'jpg', 'cb4f42799723907a97e9e33d626eb912533aac7da75db38dd11fa21e00f85a891ce502ad8210c1f14f05d69bddd8bf5a9819680e94554127153cd1142c1ea0c4.jpg', 'download.jpg', 'download', '13.41 KB', '211 x 238', '2019-08-29 05:06:45', '', '', '', NULL, '', ''),
(5, 1, 'jpg', '07284244de6c978e16903316648c576e0d85b67b7508ab55d8e678eb317862bbf869e035341916ec3f43c7717f0c271c6ace575d331866b30fa50616c8cad714.jpg', 'aisa shakhs jo bghair neki.jpg', 'aisa shakhs jo bghair neki', '835.25 KB', '1323 x 733', '2020-02-09 06:18:12', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 'jpg', '209bfb657c59782c7d03f225429675bf02e1629e08e73b1ceff19336216188443b374fe56177ac6a94efc4baf7e1dea330d8e946c9e6cbbaff886da006065039.jpg', 'download.jpg', 'Tanzeel ur Rehman', '9.78 KB', '358 x 141', '2020-04-23 04:23:07', '', '', 'Enter to Learn and Leave to Serve', NULL, '', ''),
(7, 1, 'jpg', '40c7dcc555bf65da030e2275ac35b60366a784b60a5770a7b4ce6c004ba8b8e4e3f9e3f0cc5addf27ada25651c703701c4832a673c3f226cb3eae8f4cf29b34b.jpg', 'download (1).jpg', 'Enter To Learn Leave to Serve', '11.60 KB', '275 x 183', '2020-04-23 04:25:02', '', '', '', NULL, '', ''),
(8, 1, 'jpg', '2123384b7bba4d1097fe255ae4eb9706f0b7852012c5bfad597b5056ffba6d47af19c00af5df7b012a0c97799402d9f4b83428a16a56ff71ae399d6e626f80d3.jpg', 'images (1).jpg', 'We Welcome All Children', '10.78 KB', '342 x 147', '2020-04-23 04:26:23', '', '', 'School is good place to learn', NULL, '', ''),
(9, 1, 'jpg', '5f9c2d5575a52d44af540359a0cef35efd230063e6a2c2d1c5720759a01d42894d4447ed795a60f473398b893bd2889ebe6b067742f98aaef02b3583750dfc2e.jpg', 'download.jpg', 'download', '9.78 KB', '358 x 141', '2020-04-23 04:28:55', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 'jpg', 'cc1a630889e04859cde6a7354352c944d7d2e960fb2ccb5417dc96f59d20dbba517495d3c2840c132faa62a7e015d05fad9b21e372ea95cbba9b887c6a225a8b.jpg', 'images.jpg', 'images', '10.90 KB', '317 x 159', '2020-04-23 04:42:14', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 'jpg', '556be9eda3c91c3d961e1ca1ac98320456e1b76c7fc9888ea91cb1f8dab9e4a67c9277c2edadfcce5b912b3e3413202734df8b4ce427e30b424f5612e4d9e2ac.jpg', 'download (2).jpg', 'download (2)', '11.21 KB', '269 x 187', '2020-04-23 04:44:09', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 'jpg', '82b2f05445e5870bf16cfdbbe9146ffc78789c0d478bffc33611fbda99a9ef82975f7a2f81427e4a77917b503c0a0089e4ba8fa18ead857d6f3e7ed386f43219.jpg', 'download.jpg', 'download', '9.78 KB', '358 x 141', '2020-04-23 04:48:24', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 'jpg', 'a791af2a1f1c4fe34aafbd9a6b01b677fa28b040bed71428dc16717810dfd1bde39aacacf95e593959e0ea45f100d743d98982b74fc3fcf35a87fd5670787da2.jpg', 'download (2).jpg', 'download (2)', '11.21 KB', '269 x 187', '2020-04-29 10:18:37', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 'jpg', '4a481fef2f83c7f6d10eff97ba89d87ff97d51d3a825f8123b3e90b338321572dc7a45fc36f08aae57710f1cf772d928c53b7b864df18d33f8ceacee70e503d5.jpg', 'download.jpg', 'download', '9.78 KB', '358 x 141', '2020-04-29 10:23:23', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 'png', 'ee9e572e85083fb1983cdcc1a5ae1dfc74234241f4f75fb1ace4300f1931c7b7487bf2c443393bae551e37a8e5b1413b7372afab3af33b91fc3a299582f99f1f.png', 'about.png', 'about us', '254.75 KB', '424 x 316', '2020-05-09 11:09:00', '', '', '', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `media_share`
--

CREATE TABLE `media_share` (
  `shareID` int(11) UNSIGNED NOT NULL,
  `classesID` int(11) NOT NULL DEFAULT '0',
  `public` int(11) NOT NULL,
  `file_or_folder` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(11) NOT NULL,
  `menuName` varchar(128) NOT NULL,
  `link` varchar(512) NOT NULL,
  `icon` varchar(128) DEFAULT NULL,
  `pullRight` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `parentID` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '1000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `menuName`, `link`, `icon`, `pullRight`, `status`, `parentID`, `priority`) VALUES
(1, 'dashboard', 'dashboard', 'fa-laptop', '', 1, 0, 10000),
(2, 'student', 'student', 'icon-student', NULL, 1, 0, 1000),
(3, 'parents', 'parents', 'fa-user', NULL, 1, 0, 1000),
(4, 'teacher', 'teacher', 'icon-teacher', NULL, 1, 0, 1000),
(5, 'user', 'user', 'fa-users', NULL, 1, 0, 1000),
(6, 'main_academic', '#', 'icon-academicmain', '', 1, 0, 1000),
(7, 'main_attendance', '#', 'icon-attendance', NULL, 1, 0, 1000),
(8, 'main_exam', '#', 'icon-exam', NULL, 1, 0, 1000),
(9, 'main_mark', '#', 'icon-markmain', NULL, 1, 0, 1000),
(10, 'conversation', 'conversation', 'fa-envelope', NULL, 1, 0, 1000),
(11, 'media', 'media', 'fa-film', NULL, 1, 0, 1000),
(12, 'mailandsms', 'mailandsms', 'icon-mailandsms', NULL, 1, 0, 1000),
(13, 'main_library', '#', 'icon-library', '', 1, 0, 390),
(14, 'main_transport', '#', 'icon-bus', '', 1, 0, 350),
(15, 'main_hostel', '#', 'icon-hhostel', '', 1, 0, 320),
(16, 'main_account', '#', 'icon-account', '', 1, 0, 280),
(17, 'main_announcement', '#', 'icon-noticemain', '', 1, 0, 230),
(18, 'main_report', '#', 'fa-clipboard', '', 1, 0, 190),
(19, 'visitorinfo', 'visitorinfo', 'icon-visitorinfo', '', 1, 0, 150),
(20, 'main_administrator', '#', 'icon-administrator', '', 1, 0, 140),
(21, 'main_settings', '#', 'fa-gavel', '', 1, 0, 30),
(22, 'classes', 'classes', 'fa-sitemap', NULL, 1, 6, 5000),
(23, 'section', 'section', 'fa-star', '', 1, 6, 4500),
(24, 'subject', 'subject', 'icon-subject', '', 1, 6, 4000),
(25, 'routine', 'routine', 'icon-routine', NULL, 1, 6, 1000),
(26, 'syllabus', 'syllabus', 'icon-syllabus', NULL, 1, 6, 3500),
(27, 'assignment', 'assignment', 'icon-assignment', NULL, 1, 6, 3000),
(28, 'sattendance', 'sattendance', 'icon-sattendance', NULL, 1, 7, 1000),
(29, 'tattendance', 'tattendance', 'icon-tattendance', NULL, 1, 7, 1000),
(30, 'exam', 'exam', 'fa-pencil', NULL, 1, 8, 1000),
(31, 'examschedule', 'examschedule', 'fa-puzzle-piece', NULL, 1, 8, 1000),
(32, 'grade', 'grade', 'fa-signal', NULL, 1, 8, 1000),
(33, 'eattendance', 'eattendance', 'icon-eattendance', NULL, 1, 8, 1000),
(34, 'mark', 'mark', 'fa-flask', NULL, 1, 9, 1000),
(35, 'markpercentage', 'markpercentage', 'icon-markpercentage', NULL, 1, 9, 1000),
(36, 'promotion', 'promotion', 'icon-promotion', NULL, 1, 9, 1000),
(37, 'notice', 'notice', 'fa-calendar', '', 1, 17, 220),
(38, 'event', 'event', 'fa-calendar-check-o', '', 1, 17, 210),
(39, 'holiday', 'holiday', 'icon-holiday', '', 1, 17, 200),
(40, 'classreport', 'classesreport', 'icon-classreport', '', 1, 18, 1000),
(41, 'attendancereport', 'attendancereport', 'icon-attendancereport', '', 1, 18, 940),
(42, 'studentreport', 'studentreport', 'icon-studentreport', '', 1, 18, 990),
(43, 'schoolyear', 'schoolyear', 'fa fa-calendar-plus-o', '', 1, 20, 130),
(44, 'mailandsmstemplate', 'mailandsmstemplate', 'icon-template', '', 1, 20, 100),
(46, 'backup', 'backup', 'fa-download', '', 1, 20, 80),
(47, 'systemadmin', 'systemadmin', 'icon-systemadmin', '', 1, 20, 120),
(48, 'resetpassword', 'resetpassword', 'icon-reset_password', '', 1, 20, 110),
(49, 'permission', 'permission', 'icon-permission', '', 1, 20, 60),
(50, 'usertype', 'usertype', 'icon-role', '', 1, 20, 70),
(51, 'setting', 'setting', 'fa-gears', '', 1, 21, 30),
(52, 'paymentsettings', 'paymentsettings', 'icon-paymentsettings', '', 1, 21, 20),
(53, 'smssettings', 'smssettings', 'fa-wrench', '', 1, 21, 10),
(54, 'invoice', 'invoice', 'icon-invoice', '', 1, 16, 260),
(55, 'paymenthistory', 'paymenthistory', 'icon-payment', '', 1, 16, 250),
(56, 'transport', 'transport', 'icon-sbus', '', 1, 14, 340),
(57, 'member', 'tmember', 'icon-member', '', 1, 14, 330),
(58, 'hostel', 'hostel', 'icon-hostel', '', 1, 15, 310),
(59, 'category', 'category', 'fa-leaf', '', 1, 15, 300),
(61, 'member', 'hmember', 'icon-member', '', 1, 15, 290),
(62, 'feetypes', 'feetypes', 'icon-feetypes', '', 1, 16, 270),
(63, 'expense', 'expense', 'icon-expense', '', 1, 16, 240),
(64, 'member', 'lmember', 'icon-member', '', 1, 13, 380),
(65, 'books', 'book', 'icon-lbooks', '', 1, 13, 370),
(66, 'issue', 'issue', 'icon-issue', '', 1, 13, 360),
(69, 'import', 'bulkimport', 'fa-upload', '', 1, 20, 90),
(70, 'update', 'update', 'fa-refresh', '', 1, 20, 50),
(71, 'main_child', '#', 'fa-child', '', 1, 0, 430),
(72, 'activitiescategory', 'activitiescategory', 'fa-pagelines', '', 1, 71, 420),
(73, 'activities', 'activities', 'fa-fighter-jet', '', 1, 71, 410),
(74, 'childcare', 'childcare', 'fa-wheelchair', '', 1, 71, 400),
(75, 'uattendance', 'uattendance', 'fa-user-secret', NULL, 1, 7, 1000),
(76, 'studentgroup', 'studentgroup', 'fa-object-group', '', 1, 20, 129),
(77, 'vendor', 'vendor', 'fa-rss', '', 1, 96, 1000),
(78, 'location', 'location', 'fa-newspaper-o', '', 1, 96, 1000),
(79, 'asset_category', 'asset_category', 'fa-life-ring', '', 1, 96, 1000),
(80, 'asset', 'asset', 'fa-fax', '', 1, 96, 1000),
(81, 'complain', 'complain', 'fa-commenting', '', 1, 20, 128),
(82, 'question_group', 'question_group', 'fa-question-circle', '', 1, 88, 1000),
(83, 'question_level', 'question_level', 'fa-level-up', '', 1, 88, 1000),
(84, 'question_bank', 'question_bank', 'fa-qrcode', '', 1, 88, 1000),
(85, 'online_exam', 'online_exam', 'fa-slideshare', '', 1, 88, 1000),
(86, 'instruction', 'instruction', 'fa-map-signs', '', 1, 88, 1000),
(87, 'take_exam', 'take_exam', 'fa-user-secret', '', 1, 88, 1000),
(88, 'online_exam', '#', 'fa-graduation-cap', '', 1, 0, 1000),
(89, 'certificatereport', 'certificatereport', 'fa-diamond', '', 1, 18, 860),
(90, 'certificate_template', 'certificate_template', 'fa-certificate', '', 1, 20, 128),
(91, 'main_payroll', '#', 'fa-usd', NULL, 1, 0, 1000),
(92, 'salary_template', 'salary_template', 'fa-calculator', '', 1, 91, 1000),
(93, 'hourly_template', 'hourly_template', 'fa fa-clock-o', '', 1, 91, 1000),
(94, 'manage_salary', 'manage_salary', 'fa-beer', '', 1, 91, 1000),
(95, 'make_payment', 'make_payment', 'fa-money', NULL, 1, 91, 1000),
(96, 'main_asset_management', '#', 'fa-archive', NULL, 1, 0, 1000),
(97, 'asset_assignment', 'asset_assignment', 'fa-plug', NULL, 1, 96, 1000),
(98, 'purchase', 'purchase', 'fa-cart-plus', NULL, 1, 96, 1000),
(99, 'main_frontend', '#', 'fa-home', '', 1, 0, 40),
(100, 'pages', 'pages', 'fa-connectdevelop', '', 1, 99, 1000),
(101, 'frontend_setting', 'frontend_setting', 'fa-asterisk', '', 1, 21, 25),
(102, 'routinereport', 'routinereport', 'iniicon-routinereport', '', 1, 18, 960),
(103, 'examschedulereport', 'examschedulereport', 'iniicon-examschedulereport', '', 1, 18, 950),
(104, 'feesreport', 'feesreport', 'iniicon-feesreport', '', 1, 18, 850),
(105, 'duefeesreport', 'duefeesreport', 'iniicon-duefeesreport', '', 1, 18, 840),
(106, 'balancefeesreport', 'balancefeesreport', 'iniicon-balancefeesreport', '', 1, 18, 830),
(107, 'transactionreport', 'transactionreport', 'iniicon-transactionreport', '', 1, 18, 820),
(108, 'sociallink', 'sociallink', 'iniicon-sociallink', '', 1, 20, 109),
(109, 'idcardreport', 'idcardreport', 'iniicon-idcardreport', '', 1, 18, 980),
(110, 'admitcardreport', 'admitcardreport', 'iniicon-admitcardreport', '', 1, 18, 970),
(111, 'studentfinereport', 'studentfinereport', 'iniicon-studentfinereport', '', 1, 18, 810),
(112, 'attendanceoverviewreport', 'attendanceoverviewreport', 'iniicon-attendanceoverviewreport', '', 1, 18, 930),
(113, 'income', 'income', 'iniicon-income', '', 1, 16, 239),
(114, 'global_payment', 'global_payment', 'fa-balance-scale', '', 1, 16, 238),
(115, 'terminalreport', 'terminalreport', 'iniicon-terminalreport', '', 1, 18, 920),
(116, 'tabulationsheetreport', 'tabulationsheetreport', 'iniicon-tabulationsheetreport', '', 1, 18, 900),
(117, 'marksheetreport', 'marksheetreport', 'iniicon-marksheetreport', '', 1, 18, 890),
(118, 'meritstagereport', 'meritstagereport', 'iniicon-meritstagereport', '', 1, 18, 910),
(119, 'progresscardreport', 'progresscardreport', 'iniicon-progresscardreport', '', 1, 18, 880),
(120, 'onlineexamreport', 'onlineexamreport', 'iniicon-onlineexamreport', '', 1, 18, 870),
(121, 'main_inventory', '#', 'iniicon-maininventory', '', 1, 0, 1000),
(122, 'productcategory', 'productcategory', 'iniicon-productcategory', '', 1, 121, 1000),
(123, 'product', 'product', 'iniicon-product', '', 1, 121, 1000),
(124, 'productwarehouse', 'productwarehouse', 'iniicon-productwarehouse', '', 1, 121, 1000),
(125, 'productsupplier', 'productsupplier', 'iniicon-productsupplier', '', 1, 121, 1000),
(126, 'productpurchase', 'productpurchase', 'iniicon-productpurchase', '', 1, 121, 1000),
(127, 'productsale', 'productsale', 'iniicon-productsale', '', 1, 121, 1000),
(128, 'main_leaveapplication', '#', 'iniicon-mainleaveapplication', '', 1, 0, 1000),
(129, 'leavecategory', 'leavecategory', 'iniicon-leavecategory', '', 1, 128, 1000),
(130, 'leaveassign', 'leaveassign', 'iniicon-leaveassign', '', 1, 128, 1000),
(131, 'leaveapply', 'leaveapply', 'iniicon-leaveapply', '', 1, 128, 1000),
(132, 'leaveapplication', 'leaveapplication', 'iniicon-leaveapplication', '', 1, 128, 1000),
(133, 'librarybooksreport', 'librarybooksreport', 'iniicon-librarybooksreport', '', 1, 18, 925),
(134, 'searchpaymentfeesreport', 'searchpaymentfeesreport', 'iniicon-searchpaymentfeesreport', '', 1, 18, 852),
(135, 'salaryreport', 'salaryreport', 'iniicon-salaryreport', '', 1, 18, 805),
(136, 'productpurchasereport', 'productpurchasereport', 'iniicon-productpurchasereport', '', 1, 18, 854),
(137, 'productsalereport', 'productsalereport', 'iniicon-productsalereport', '', 1, 18, 853),
(138, 'leaveapplicationreport', 'leaveapplicationreport', 'iniicon-leaveapplicationreport', '', 1, 18, 855),
(139, 'posts', 'posts', 'fa-thumb-tack', '', 1, 99, 1005),
(140, 'posts_categories', 'posts_categories', 'fa-anchor', NULL, 1, 99, 1010),
(141, 'menu', 'frontendmenu', 'iniicon-fmenu', '', 1, 99, 1000),
(142, 'librarycardreport', 'librarycardreport', 'iniicon-librarycardreport', '', 1, 18, 924),
(143, 'librarybookissuereport', 'librarybookissuereport', 'iniicon-librarybookissuereport', '', 1, 18, 923),
(144, 'onlineexamquestionreport', 'onlineexamquestionreport', 'iniicon-onlineexamquestionreport', '', 1, 18, 865),
(145, 'ebooks', 'ebooks', 'iniicon-ebook', '', 1, 13, 350),
(146, 'accountledgerreport', 'accountledgerreport', 'iniicon-accountledgerreport', '', 1, 18, 800),
(147, 'onlineclass', 'onlineclass', 'iniicon-onlineadmission', '', 1, 0, 160),
(148, 'emailsetting', 'emailsetting', 'iniicon-ini-emailsetting', '', 1, 21, 5),
(149, 'onlineadmissionreport', 'onlineadmissionreport', 'iniicon-onlineadmissionreport', '', 1, 18, 863),
(150, 'onlineclass', 'onlineclass', 'iniicon-ini-emailsetting', NULL, 1, 99, 10000),
(151, 'goshi', 'goshi', NULL, NULL, 1, 0, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `noticeID` int(11) UNSIGNED NOT NULL,
  `title` varchar(128) NOT NULL,
  `notice` text NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `date` date NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_userID` int(11) NOT NULL DEFAULT '0',
  `create_usertypeID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`noticeID`, `title`, `notice`, `schoolyearID`, `date`, `create_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 'Parents meeting', 'Meeting', 1, '2019-09-27', '2019-08-29 22:00:30', 1, 1),
(2, 'asdsad', 'asdasdasd', 1, '2019-11-02', '2019-11-02 23:22:53', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `onlineadmission`
--

CREATE TABLE `onlineadmission` (
  `onlineadmissionID` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` varchar(200) DEFAULT NULL,
  `classesID` int(11) DEFAULT NULL,
  `bloodgroup` varchar(5) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `schoolyearID` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `studentID` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '0' COMMENT '0 = New, 1=Approved, 2 = Waiting, 3 = Declined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online_exam`
--

CREATE TABLE `online_exam` (
  `onlineExamID` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` text,
  `classID` int(11) DEFAULT '0',
  `sectionID` int(11) DEFAULT '0',
  `studentGroupID` int(11) DEFAULT '0',
  `subjectID` int(11) DEFAULT '0',
  `userTypeID` int(11) DEFAULT '0',
  `instructionID` int(11) DEFAULT '0',
  `examStatus` varchar(11) NOT NULL,
  `schoolYearID` int(11) NOT NULL,
  `examTypeNumber` int(11) DEFAULT NULL,
  `startDateTime` datetime DEFAULT NULL,
  `endDateTime` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT '0',
  `random` int(11) DEFAULT '0',
  `public` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `markType` int(11) NOT NULL,
  `negativeMark` int(11) DEFAULT '0',
  `bonusMark` int(11) DEFAULT '0',
  `point` int(11) DEFAULT '0',
  `percentage` int(11) DEFAULT '0',
  `showMarkAfterExam` int(11) DEFAULT '0',
  `judge` int(11) DEFAULT '1' COMMENT 'Auto Judge = 1, Manually Judge = 0',
  `paid` int(11) DEFAULT '0' COMMENT '0 = Unpaid, 1 = Paid',
  `validDays` int(11) DEFAULT '0',
  `cost` int(11) DEFAULT '0',
  `img` varchar(512) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL,
  `published` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_exam`
--

INSERT INTO `online_exam` (`onlineExamID`, `name`, `description`, `classID`, `sectionID`, `studentGroupID`, `subjectID`, `userTypeID`, `instructionID`, `examStatus`, `schoolYearID`, `examTypeNumber`, `startDateTime`, `endDateTime`, `duration`, `random`, `public`, `status`, `markType`, `negativeMark`, `bonusMark`, `point`, `percentage`, `showMarkAfterExam`, `judge`, `paid`, `validDays`, `cost`, `img`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`, `published`) VALUES
(1, '6556', NULL, 12, 16, 1, 2, 3, 1, '2', 1, 2, NULL, NULL, 20, 0, 0, 1, 5, 1, 0, 0, 50, 0, 0, 0, 0, 0, NULL, '2019-10-13 00:58:14', '2019-11-17 16:32:59', 1, 1, 1),
(2, 'Tanzeel ur rehman', 'Exam will held in room no 9', 1, 8, 1, 33, 3, 1, '2', 1, 5, '2020-09-05 20:45:00', '2020-09-05 21:12:00', 15, 0, 0, 1, 10, 0, 0, 0, 5, 0, 0, 0, 0, 0, NULL, '2020-05-09 20:16:37', '2020-05-09 20:49:43', 1, 1, 1),
(3, 'goshi', NULL, 1, 8, 2, 32, 3, 1, '1', 1, 2, NULL, NULL, 2, 0, 0, 1, 10, 0, 0, 0, 10, 0, 0, 0, 0, 0, NULL, '2020-05-15 19:41:53', '2020-07-09 11:00:31', 1, 1, 2),
(4, 'demo quizz', 'IT IS A DEMO  QUIZZ', 1, 8, 2, 33, 3, 1, '1', 1, 2, NULL, NULL, 15, 0, 0, 1, 5, 0, 0, 0, 10, 0, 0, 0, 0, 0, NULL, '2020-07-09 10:37:00', '2020-07-09 11:04:36', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_question`
--

CREATE TABLE `online_exam_question` (
  `onlineExamQuestionID` int(11) NOT NULL,
  `onlineExamID` int(11) NOT NULL,
  `questionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_exam_question`
--

INSERT INTO `online_exam_question` (`onlineExamQuestionID`, `onlineExamID`, `questionID`) VALUES
(1, 1, 1),
(2, 1, 2),
(5, 2, 3),
(6, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_type`
--

CREATE TABLE `online_exam_type` (
  `onlineExamTypeID` int(11) NOT NULL,
  `title` varchar(512) DEFAULT NULL,
  `examTypeNumber` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_exam_type`
--

INSERT INTO `online_exam_type` (`onlineExamTypeID`, `title`, `examTypeNumber`, `status`) VALUES
(1, 'Date , Time and Duration', 5, 1),
(2, 'Date and Duration', 4, 1),
(3, 'Only Date', 3, 0),
(4, 'Only Duration', 2, 1),
(5, 'None', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_user_answer`
--

CREATE TABLE `online_exam_user_answer` (
  `onlineExamUserAnswerID` int(11) NOT NULL,
  `onlineExamQuestionID` int(11) NOT NULL,
  `onlineExamRegisteredUserID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_exam_user_answer`
--

INSERT INTO `online_exam_user_answer` (`onlineExamUserAnswerID`, `onlineExamQuestionID`, `onlineExamRegisteredUserID`, `userID`) VALUES
(1, 1, NULL, 7),
(2, 2, NULL, 7),
(3, 1, NULL, 8),
(4, 2, NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_user_answer_option`
--

CREATE TABLE `online_exam_user_answer_option` (
  `onlineExamUserAnswerOptionID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `optionID` int(11) DEFAULT NULL,
  `typeID` int(11) NOT NULL,
  `text` text,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_exam_user_answer_option`
--

INSERT INTO `online_exam_user_answer_option` (`onlineExamUserAnswerOptionID`, `questionID`, `optionID`, `typeID`, `text`, `time`) VALUES
(1, 2, 12, 1, NULL, '2019-11-04 19:11:03'),
(2, 2, 12, 1, NULL, '2019-11-05 17:19:45');

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_user_status`
--

CREATE TABLE `online_exam_user_status` (
  `onlineExamUserStatus` int(11) NOT NULL,
  `onlineExamID` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `totalQuestion` int(11) NOT NULL,
  `totalAnswer` int(11) NOT NULL,
  `nagetiveMark` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  `classesID` int(11) DEFAULT NULL,
  `sectionID` int(11) DEFAULT NULL,
  `examtimeID` int(11) DEFAULT NULL,
  `totalCurrectAnswer` int(11) DEFAULT NULL,
  `totalMark` varchar(40) DEFAULT NULL,
  `totalObtainedMark` int(11) DEFAULT NULL,
  `totalPercentage` double DEFAULT NULL,
  `statusID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_exam_user_status`
--

INSERT INTO `online_exam_user_status` (`onlineExamUserStatus`, `onlineExamID`, `duration`, `score`, `totalQuestion`, `totalAnswer`, `nagetiveMark`, `time`, `userID`, `classesID`, `sectionID`, `examtimeID`, `totalCurrectAnswer`, `totalMark`, `totalObtainedMark`, `totalPercentage`, `statusID`) VALUES
(1, 1, 20, 0, 2, 2, 1, '2019-11-04 19:11:03', 7, 12, 16, 1, 0, '8', 0, 0, 10),
(2, 1, 20, 0, 2, 2, 1, '2019-11-05 17:19:45', 8, 12, 16, 1, 0, '8', 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pagesID` int(11) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `content` text,
  `status` int(11) DEFAULT NULL COMMENT '1 => active, 2 => draft, 3 => trash, 4 => review  ',
  `visibility` int(11) DEFAULT NULL COMMENT '1 => public 2 => protected 3 => private ',
  `publish_date` datetime DEFAULT NULL,
  `parentID` int(11) NOT NULL DEFAULT '0',
  `pageorder` int(11) NOT NULL DEFAULT '0',
  `template` varchar(250) DEFAULT NULL,
  `featured_image` varchar(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `create_userID` int(11) DEFAULT NULL,
  `create_username` varchar(60) DEFAULT NULL,
  `create_usertypeID` int(11) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pagesID`, `title`, `url`, `content`, `status`, `visibility`, `publish_date`, `parentID`, `pageorder`, `template`, `featured_image`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertypeID`, `password`) VALUES
(3, 'Home', 'home', '', 1, 1, '2019-08-27 21:20:01', 0, 0, 'home', '', '2019-08-27 09:21:18', '2019-08-28 11:22:38', 1, 'ctech', 1, NULL),
(5, 'Gallery', 'gallery', '<img src=\"http://localhost/schoolmanagement/uploads/gallery/209bfb657c59782c7d03f225429675bf02e1629e08e73b1ceff19336216188443b374fe56177ac6a94efc4baf7e1dea330d8e946c9e6cbbaff886da006065039.jpg\" alt=\"School  Management System\">', 1, 1, '2020-04-23 16:35:01', 0, 0, 'gallery', '', '2020-04-23 04:43:04', '2020-04-23 04:43:04', 1, 'ctech', 1, NULL),
(6, 'Admissions', 'admissions', '', 1, 1, '2020-04-23 16:47:01', 0, 0, 'admission', '12', '2020-04-23 04:48:39', '2020-04-23 04:48:39', 1, 'ctech', 1, NULL),
(8, 'Goshi', 'goshi', 'Hi This is Blog<img src=\"http://localhost/schoolmanagement/uploads/gallery/40c7dcc555bf65da030e2275ac35b60366a784b60a5770a7b4ce6c004ba8b8e4e3f9e3f0cc5addf27ada25651c703701c4832a673c3f226cb3eae8f4cf29b34b.jpg\" alt=\"\">', 2, 1, '2020-04-29 10:56:01', 0, 0, 'blog', '', '2020-04-29 10:57:36', '2020-04-29 10:58:37', 1, 'ctech', 1, NULL),
(9, 'About', 'about', '<blockquote style=\"font-size: 14px;\"><p><span style=\"color: rgb(0, 0, 255);\"><font style=\"\" face=\"Courier New\"><b style=\"\"><br></b></font></span></p><p><span style=\"color: rgb(0, 0, 255);\"><font style=\"\" face=\"Courier New\"><b style=\"\">It is unavoidably obvious that this generation of learners are global. They Are digitally inclined and we can not but accept the fact that they are also digitally Mobile.&nbsp; Education is no longer a thing that can only be gotten in the four walls of the classroom. It has evolved and gone digital.&nbsp; &nbsp;<br></b></font><b style=\"\"><font face=\"Courier New\">This however will stimulate the learners of this generation. This is no longer the era of STEM ( Science, Technology, Engineering and Mathematics). A new phase has come and we have developed a platform, a digital classroom that will revolve around STREAM (Science, Technology, Reading,Engineering, Art and Mathematics). Our curriculum is highly accredited and also in line with the regular school. We offer nothing but the best.&nbsp;&nbsp;<br></font></b><b style=\"\"><font face=\"Courier New\">Furthermore, it accommodates students from around the world therefore giving your child an opportunity to interact with different students and learn about different cultures from the comfort of their home. Gone are the days when we needed to travel to see the world, a new era has come and we are bringing the world close to our students.&nbsp; &nbsp;<br></font></b><font style=\"\" face=\"Courier New\"><b style=\"\">Our Virtual classroom is one that is computer and mobile friendly. We offer nothing but good values that your children will&nbsp; crave for. It will also interest you that we have taken so much time&nbsp;</b><b style=\"\">scrutinizing</b><b style=\"\">&nbsp;and screening all our Teachers so well and we can assure you that we have Certificated Literate Teachers who are STREAM conscious.&nbsp; &nbsp;</b></font></span></p></blockquote>', 1, 1, '2020-05-09 10:45:01', 0, 0, 'about', '15', '2020-05-09 10:48:57', '2020-05-09 11:12:07', 1, 'ctech', 1, NULL),
(10, 'Teddy', 'teddy', '<p><iframe allowfullscreen=\"\" frameborder=\"0\" src=\"//www.youtube.com/embed/TvdYoPEDlKM\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p>', 2, 1, '2020-07-06 17:33:01', 0, 0, 'none', '', '2020-07-06 05:37:04', '2020-07-06 05:37:04', 1, 'goshi', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `parentsID` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `father_name` varchar(60) NOT NULL,
  `mother_name` varchar(60) NOT NULL,
  `father_profession` varchar(40) NOT NULL,
  `mother_profession` varchar(40) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `guardian_realation_with_child` varchar(60) DEFAULT NULL,
  `guardian_nationality` varchar(60) DEFAULT NULL,
  `guardian_office_addresss` varchar(200) DEFAULT NULL,
  `guardian_qualification` varchar(60) DEFAULT NULL,
  `guardian_cnic` varchar(60) DEFAULT NULL,
  `guardian_address` varchar(200) DEFAULT NULL,
  `guardian_phone` varchar(60) DEFAULT NULL,
  `guardian_profession` varchar(60) DEFAULT NULL,
  `mother_nationality` varchar(60) DEFAULT NULL,
  `mother_office_addresss` varchar(200) DEFAULT NULL,
  `mother_qualification` varchar(60) DEFAULT NULL,
  `mother_cnic` varchar(60) DEFAULT NULL,
  `mother_address` varchar(200) DEFAULT NULL,
  `mother_phone` varchar(60) DEFAULT NULL,
  `father_nationality` varchar(60) DEFAULT NULL,
  `father_office_addresss` varchar(200) DEFAULT NULL,
  `father_qualification` varchar(60) DEFAULT NULL,
  `father_cnic` varchar(60) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parentsID`, `name`, `father_name`, `mother_name`, `father_profession`, `mother_profession`, `email`, `phone`, `address`, `guardian_realation_with_child`, `guardian_nationality`, `guardian_office_addresss`, `guardian_qualification`, `guardian_cnic`, `guardian_address`, `guardian_phone`, `guardian_profession`, `mother_nationality`, `mother_office_addresss`, `mother_qualification`, `mother_cnic`, `mother_address`, `mother_phone`, `father_nationality`, `father_office_addresss`, `father_qualification`, `father_cnic`, `photo`, `username`, `password`, `usertypeID`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `active`) VALUES
(7, 'Hafeez ur rehman', 'Hafeez ur Rehman', 'Humaira Hafeez', 'Software ENgineer', 'House wife', 'zain.cwf@gmail.com', '03016697211', 'Gujranwala', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 'BS', '', 'default.png', 'father', '07b5baae3ccae0d974fc25d3f76b28a71d9f8abab013e0e55b2b9c38d61ed2331dc869e6461545bfa6177afe90b8afbcbe4d18f0a8d5e8695e0130dee4709f81', 4, '2019-11-19 04:56:12', '2020-01-28 09:45:22', 1, 'ctech', 'Admin', 1),
(8, 'John Kabuku Malumani', '', '', '', '', '', '', '', '', 'Namibian', '', '', '', '526 cleopatra street', NULL, 'Director', '', '', '', '', '', '', '', '', '', '', 'default.png', 'JohnM', 'f7971b6b1bdf95359be0b7c80a25b76274898121ecf44544a3f543cf2f4507ae6fc66bcd5b74538f6ad46a1e3a8f3c41d3dff5fe83443d57ff8518cfb3ee37d9', 4, '2019-11-20 09:05:16', '2019-11-20 09:06:01', 1, 'ctech', 'Admin', 1),
(9, 'Malumani Malumani', 'Malumani Malumani', '', 'driller', '', 'gmkabukiu@gmail.com', '264814068582', 'gfg', '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', '', '', 'default.png', 'Malumani', '33e49f87dc3ca28548beee4ef17c8777f7ce56acebd319c409d095766d23951f620608794e4aad88ec92a097bd7102e373dcb1a97e05846e4948d63f908c074e', 4, '2019-11-20 09:22:50', '2019-11-20 09:22:50', 1, 'ctech', 'Admin', 1),
(11, 'Pervez Bhaa', 'pervez BHaa', 'Mammi', 'Car Dealer', 'House Wife', 'Ponka@gmail.com', '03212563987', 'Gulshan Iqbal', '', '', '', '', '', '', NULL, '', 'pakistan', 'non', 'Matric', '4210147458747', 'Gulshan Iqbal', '00000000', 'Pakistan', 'Khalid bin Waleed', 'b.com', '42101568741255', 'default.png', 'owner', '2a43e7235a5c6d811b42ba4c0e9efbd1afc1583ce349f844f9c1e6ad8cdd007fb80fc64c7d3666954c64d97673e6edeb5a3747023181bbcaeb36066447fc6a95', 4, '2019-12-06 02:36:49', '2019-12-06 02:36:49', 1, 'ctech', 'Admin', 1),
(12, 'Tanzeel ur rehman', 'Tanzeel ur rehman', 'Sumaira Hanif', 'Software Engineer', '', 'deeni.masail12@gmail.com', '03007476412', '', 'Father', 'Pakistani', '', 'BS', '3410114806547', 'Rawalpindi', NULL, 'Government Employee', '', '', 'MA', '3410114806547', 'Rawalpindi', '', 'Islam', 'Islamabad', 'BS', '3410114806547', 'default.png', 'goshii', 'ddafe77db7c10eb75607edc38c3fd571aac1031275c37cb14ced9acb343529058f1a0b6bb0ce79daf5d58e079f612aac32ce39dff372e03eaf26ae86f4d3d23e', 4, '2020-01-23 09:35:24', '2020-01-23 09:35:24', 1, 'ctech', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(11) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `paymentamount` double DEFAULT NULL,
  `paymenttype` varchar(128) NOT NULL,
  `paymentdate` date NOT NULL,
  `paymentday` varchar(11) NOT NULL,
  `paymentmonth` varchar(10) NOT NULL,
  `paymentyear` year(4) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `uname` varchar(60) NOT NULL,
  `transactionID` text,
  `globalpaymentID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `schoolyearID`, `invoiceID`, `studentID`, `paymentamount`, `paymenttype`, `paymentdate`, `paymentday`, `paymentmonth`, `paymentyear`, `userID`, `usertypeID`, `uname`, `transactionID`, `globalpaymentID`) VALUES
(3, 1, 4, 2, NULL, 'Cash', '2019-07-15', '15', '07', 2019, 1, 1, 'superadmin', 'CASHANDCHEQUE2301171701300732616', 3),
(4, 1, 5, 2, NULL, 'Cash', '2019-07-15', '15', '07', 2019, 1, 1, 'superadmin', 'CASHANDCHEQUE7380582163335920068', 3),
(5, 1, 6, 2, NULL, 'Cash', '2019-07-15', '15', '07', 2019, 1, 1, 'superadmin', 'CASHANDCHEQUE7617891873238387713', 3),
(6, 1, 7, 2, NULL, 'Cash', '2019-07-15', '15', '07', 2019, 1, 1, 'superadmin', 'CASHANDCHEQUE7407842997134038062', 3),
(73, 1, 347, 1, 200, 'Cheque', '2019-10-20', '27', '08', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE2594813272726425706', 32),
(74, 1, 20, 6, 120, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE3727475490596009410', 33),
(75, 1, 27, 6, 21, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE6494600832786966512', 33),
(76, 1, 28, 6, 2, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE9297626010620384807', 33),
(77, 1, 29, 6, 1, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE5224445229001171457', 33),
(78, 1, 35, 6, 12, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE9319885561585065337', 33),
(79, 1, 43, 6, 12, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE5338161475067760531', 33),
(80, 1, 44, 6, 21, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE6757076835839041452', 33),
(81, 1, 45, 6, 200, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE6086518515071069014', 33),
(82, 1, 245, 6, NULL, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE5916944851354009052', 33),
(83, 1, 246, 6, NULL, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE6151275682620248856', 33),
(84, 1, 247, 6, NULL, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE2198121453447613850', 33),
(85, 1, 248, 6, NULL, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE1094208486368448599', 33),
(86, 1, 249, 6, NULL, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE8400398371513526477', 33),
(87, 1, 250, 6, NULL, 'Cash', '2019-10-21', '21', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE8793416134052495920', 33),
(88, 1, 347, 1, 500, 'Cash', '2019-10-23', '23', '10', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE6402492089535421533', 34),
(89, 1, 348, 5, 4000, 'Cash', '2019-11-14', '14', '11', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE8989361964357829390', 35),
(90, 1, 349, 10, 500, 'Cash', '2019-11-14', '14', '11', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE3601194044510536616', 36),
(91, 1, 350, 10, 100, 'Cash', '2019-11-14', '14', '11', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE4994640755358462841', 37),
(92, 1, 350, 10, 500, 'Cash', '2019-11-14', '14', '11', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE2907747315410192695', 38),
(93, 1, 227, 3, NULL, 'Cash', '2019-12-09', '09', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE7377958694096161349', 39),
(94, 1, 228, 3, NULL, 'Cash', '2019-12-09', '09', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE8933804731172550476', 39),
(95, 1, 229, 3, 1500, 'Cash', '2019-12-09', '09', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE6214560062203121830', 39),
(96, 1, 230, 3, NULL, 'Cash', '2019-12-09', '09', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE1941751664320262266', 39),
(97, 1, 231, 3, NULL, 'Cash', '2019-12-09', '09', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE1971536223295158876', 39),
(98, 1, 232, 3, NULL, 'Cash', '2019-12-09', '09', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE8339205168040478517', 39),
(99, 1, 8, 3, 1000, 'Cash', '2019-12-11', '11', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE3989687474197975654', 40),
(100, 1, 9, 3, 4000, 'Cash', '2019-12-11', '11', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE5360363808953519763', 40),
(101, 1, 10, 3, 1500, 'Cash', '2019-12-11', '11', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE2199735866222412846', 40),
(102, 1, 11, 3, 2000, 'Cash', '2019-12-11', '11', '12', 2019, 1, 1, 'Owner', 'CASHANDCHEQUE1522029083605235026', 40),
(103, 1, 351, 3, 1500, 'Cash', '2020-02-07', '07', '02', 2020, 1, 1, 'Tanzeel', 'CASHANDCHEQUE6551293851124994504', 41),
(104, 1, 354, 3, 200, 'Cash', '2020-02-09', '09', '02', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE5969023777659305935', 42),
(105, 1, 356, 2, 2000, 'Cash', '2020-02-09', '09', '02', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE2423569739104566312', 43),
(106, 1, 360, 3, 3000, 'Cash', '2020-02-12', '12', '02', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE1809269465564950726', 44),
(107, 1, 361, 4, 200000, 'Cash', '2020-02-12', '12', '02', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE6897369935814268863', 45),
(108, 1, 365, 4, 1900, 'Cash', '2020-03-02', '02', '03', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE3190104487119763691', 46),
(109, 1, 366, 5, 1500, 'Cash', '2020-03-06', '06', '03', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE2793775511943751957', 47),
(110, 1, 364, 2, 1000, 'Cash', '2020-03-06', '06', '03', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE5223758681955934315', 48),
(111, 1, 368, 5, 500, 'Cash', '2020-03-07', '07', '03', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE1847319692843532617', 49),
(112, 1, 370, 5, 500, 'Cash', '2020-03-07', '07', '03', 2020, 1, 1, 'Admin', 'CASHANDCHEQUE8515608595417510355', 50);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permissionID` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'In most cases, this should be the name of the module (e.g. news)',
  `active` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permissionID`, `description`, `name`, `active`) VALUES
(501, 'Dashboard', 'dashboard', 'yes'),
(502, 'Student', 'student', 'yes'),
(503, 'Student Add', 'student_add', 'yes'),
(504, 'Student Edit', 'student_edit', 'yes'),
(505, 'Student Delete', 'student_delete', 'yes'),
(506, 'Student View', 'student_view', 'yes'),
(507, 'Parents', 'parents', 'yes'),
(508, 'Parents Add', 'parents_add', 'yes'),
(509, 'Parents Edit', 'parents_edit', 'yes'),
(510, 'Parents Delete', 'parents_delete', 'yes'),
(511, 'Parents View', 'parents_view', 'yes'),
(512, 'Teacher', 'teacher', 'yes'),
(513, 'Teacher Add', 'teacher_add', 'yes'),
(514, 'Teacher Edit', 'teacher_edit', 'yes'),
(515, 'Teacher Delete', 'teacher_delete', 'yes'),
(516, 'Teacher View', 'teacher_view', 'yes'),
(517, 'User', 'user', 'yes'),
(518, 'User Add', 'user_add', 'yes'),
(519, 'User Edit', 'user_edit', 'yes'),
(520, 'User Delete', 'user_delete', 'yes'),
(521, 'User View', 'user_view', 'yes'),
(522, 'Class', 'classes', 'yes'),
(523, 'Class Add', 'classes_add', 'yes'),
(524, 'Class Edit', 'classes_edit', 'yes'),
(525, 'Class Delete', 'classes_delete', 'yes'),
(526, 'Section', 'section', 'yes'),
(527, 'Section Add', 'section_add', 'yes'),
(528, 'Section Edit', 'section_edit', 'yes'),
(529, 'Semester Delete', 'semester_delete', 'yes'),
(530, 'Section Delete', 'section_delete', 'yes'),
(531, 'Subject', 'subject', 'yes'),
(532, 'Subject Add', 'subject_add', 'yes'),
(533, 'Subject Edit', 'subject_edit', 'yes'),
(534, 'Subject Delete', 'subject_delete', 'yes'),
(535, 'Syllabus', 'syllabus', 'yes'),
(536, 'Syllabus Add', 'syllabus_add', 'yes'),
(537, 'Syllabus Edit', 'syllabus_edit', 'yes'),
(538, 'Syllabus Delete', 'syllabus_delete', 'yes'),
(539, 'Assignment', 'assignment', 'yes'),
(540, 'Assignment Add', 'assignment_add', 'yes'),
(541, 'Assignment Edit', 'assignment_edit', 'yes'),
(542, 'Assignment Delete', 'assignment_delete', 'yes'),
(543, 'Assignment View', 'assignment_view', 'yes'),
(544, 'Routine', 'routine', 'yes'),
(545, 'Routine Add', 'routine_add', 'yes'),
(546, 'Routine Edit', 'routine_edit', 'yes'),
(547, 'Routine Delete', 'routine_delete', 'yes'),
(548, 'Student Attendance', 'sattendance', 'yes'),
(549, 'Student Attendance Add', 'sattendance_add', 'yes'),
(550, 'Student Attendance View', 'sattendance_view', 'yes'),
(551, 'Teacher Attendance', 'tattendance', 'yes'),
(552, 'Teacher Attendance Add', 'tattendance_add', 'yes'),
(553, 'Teacher Attendance View', 'tattendance_view', 'yes'),
(554, 'User Attendance', 'uattendance', 'yes'),
(555, 'User Attendance Add', 'uattendance_add', 'yes'),
(556, 'User Attendance View', 'uattendance_view', 'yes'),
(557, 'Exam', 'exam', 'yes'),
(558, 'Exam Add', 'exam_add', 'yes'),
(559, 'Exam Edit', 'exam_edit', 'yes'),
(560, 'Exam Delete', 'exam_delete', 'yes'),
(561, 'Examschedule', 'examschedule', 'yes'),
(562, 'Examschedule Add', 'examschedule_add', 'yes'),
(563, 'Examschedule Edit', 'examschedule_edit', 'yes'),
(564, 'Examschedule Delete', 'examschedule_delete', 'yes'),
(565, 'Grade', 'grade', 'yes'),
(566, 'Grade Add', 'grade_add', 'yes'),
(567, 'Grade Edit', 'grade_edit', 'yes'),
(568, 'Grade Delete', 'grade_delete', 'yes'),
(569, 'Exam Attendance', 'eattendance', 'yes'),
(570, 'Exam Attendance Add', 'eattendance_add', 'yes'),
(571, 'Mark', 'mark', 'yes'),
(572, 'Mark Add', 'mark_add', 'yes'),
(573, 'Mark View', 'mark_view', 'yes'),
(574, 'Mark Distribution', 'markpercentage', 'yes'),
(575, 'Mark Distribution Add', 'markpercentage_add', 'yes'),
(576, 'Mark Distribution Edit', 'markpercentage_edit', 'yes'),
(577, 'Mark Distribution Delete', 'markpercentage_delete', 'yes'),
(578, 'Promotion', 'promotion', 'yes'),
(579, 'Message', 'conversation', 'yes'),
(580, 'Media', 'media', 'yes'),
(581, 'Media Add', 'media_add', 'yes'),
(582, 'Media Delete', 'media_delete', 'yes'),
(583, 'Mail / SMS', 'mailandsms', 'yes'),
(584, 'Mail / SMS Add', 'mailandsms_add', 'yes'),
(585, 'Mail / SMS View', 'mailandsms_view', 'yes'),
(586, 'Question Group', 'question_group', 'yes'),
(587, 'Question Group Add', 'question_group_add', 'yes'),
(588, 'Question Group Edit', 'question_group_edit', 'yes'),
(589, 'Question Group Delete', 'question_group_delete', 'yes'),
(590, 'Question Level', 'question_level', 'yes'),
(591, 'Question Level Add', 'question_level_add', 'yes'),
(592, 'Question Level Edit', 'question_level_edit', 'yes'),
(593, 'Question Level Delete', 'question_level_delete', 'yes'),
(594, 'Question Bank', 'question_bank', 'yes'),
(595, 'Question Bank Add', 'question_bank_add', 'yes'),
(596, 'Question Bank Edit', 'question_bank_edit', 'yes'),
(597, 'Question Bank Delete', 'question_bank_delete', 'yes'),
(598, 'Question Bank View', 'question_bank_view', 'yes'),
(599, 'Online Exam', 'online_exam', 'yes'),
(600, 'Online Exam Add', 'online_exam_add', 'yes'),
(601, 'Online Exam Edit', 'online_exam_edit', 'yes'),
(602, 'Online Exam Delete', 'online_exam_delete', 'yes'),
(603, 'Instruction', 'instruction', 'yes'),
(604, 'Instruction Add', 'instruction_add', 'yes'),
(605, 'Instruction Edit', 'instruction_edit', 'yes'),
(606, 'Instruction Delete', 'instruction_delete', 'yes'),
(607, 'Instruction View', 'instruction_view', 'yes'),
(608, 'Salary Template', 'salary_template', 'yes'),
(609, 'Salary Template Add', 'salary_template_add', 'yes'),
(610, 'Salary Template Edit', 'salary_template_edit', 'yes'),
(611, 'Salary Template Delete', 'salary_template_delete', 'yes'),
(612, 'Salary Template View', 'salary_template_view', 'yes'),
(613, 'Hourly Template', 'hourly_template', 'yes'),
(614, 'Hourly Template Add', 'hourly_template_add', 'yes'),
(615, 'Hourly Template Edit', 'hourly_template_edit', 'yes'),
(616, 'Hourly Template Delete', 'hourly_template_delete', 'yes'),
(617, 'Manage Salary', 'manage_salary', 'yes'),
(618, 'Manage Salary Add', 'manage_salary_add', 'yes'),
(619, 'Manage Salary Edit', 'manage_salary_edit', 'yes'),
(620, 'Manage Salary Delete', 'manage_salary_delete', 'yes'),
(621, 'Manage Salary View', 'manage_salary_view', 'yes'),
(622, 'Make Payment', 'make_payment', 'yes'),
(623, 'Vendor', 'vendor', 'yes'),
(624, 'Vendor Add', 'vendor_add', 'yes'),
(625, 'Vendor Edit', 'vendor_edit', 'yes'),
(626, 'Vendor Delete', 'vendor_delete', 'yes'),
(627, 'Location', 'location', 'yes'),
(628, 'Location Add', 'location_add', 'yes'),
(629, 'Location Edit', 'location_edit', 'yes'),
(630, 'Location Delete', 'location_delete', 'yes'),
(631, 'Asset Category', 'asset_category', 'yes'),
(632, 'Asset Category Add', 'asset_category_add', 'yes'),
(633, 'Asset Category Edit', 'asset_category_edit', 'yes'),
(634, 'Asset Category Delete', 'asset_category_delete', 'yes'),
(635, 'Asset', 'asset', 'yes'),
(636, 'Asset Add', 'asset_add', 'yes'),
(637, 'Asset Edit', 'asset_edit', 'yes'),
(638, 'Asset Delete', 'asset_delete', 'yes'),
(639, 'Asset View', 'asset_view', 'yes'),
(640, 'Asset Assignment', 'asset_assignment', 'yes'),
(641, 'Asset Assignment Add', 'asset_assignment_add', 'yes'),
(642, 'Asset Assignment Edit', 'asset_assignment_edit', 'yes'),
(643, 'Asset Assignment Delete', 'asset_assignment_delete', 'yes'),
(644, 'Asset Assignment View', 'asset_assignment_view', 'yes'),
(645, 'Purchase', 'purchase', 'yes'),
(646, 'Purchase Add', 'purchase_add', 'yes'),
(647, 'Purchase Edit', 'purchase_edit', 'yes'),
(648, 'Purchase Delete', 'purchase_delete', 'yes'),
(649, 'Product Category', 'productcategory', 'yes'),
(650, 'Product Category Add', 'productcategory_add', 'yes'),
(651, 'Product Category Edit', 'productcategory_edit', 'yes'),
(652, 'Product Category Delete', 'productcategory_delete', 'yes'),
(653, 'Product', 'product', 'yes'),
(654, 'Product Add', 'product_add', 'yes'),
(655, 'Product Edit', 'product_edit', 'yes'),
(656, 'Product Delete', 'product_delete', 'yes'),
(657, 'Warehouse', 'productwarehouse', 'yes'),
(658, 'Warehouse Add', 'productwarehouse_add', 'yes'),
(659, 'Warehouse Edit', 'productwarehouse_edit', 'yes'),
(660, 'Warehouse Delete', 'productwarehouse_delete', 'yes'),
(661, 'Supplier', 'productsupplier', 'yes'),
(662, 'Supplier Add', 'productsupplier_add', 'yes'),
(663, 'Supplier Edit', 'productsupplier_edit', 'yes'),
(664, 'Supplier Delete', 'productsupplier_delete', 'yes'),
(665, 'Purchase', 'productpurchase', 'yes'),
(666, 'Purchase Add', 'productpurchase_add', 'yes'),
(667, 'Purchase Edit', 'productpurchase_edit', 'yes'),
(668, 'Purchase Delete', 'productpurchase_delete', 'yes'),
(669, 'Purchase View', 'productpurchase_view', 'yes'),
(670, 'Sale', 'productsale', 'yes'),
(671, 'Sale Add', 'productsale_add', 'yes'),
(672, 'Sale Edit', 'productsale_edit', 'yes'),
(673, 'Sale Delete', 'productsale_delete', 'yes'),
(674, 'Sale View', 'productsale_view', 'yes'),
(675, 'Leave Category', 'leavecategory', 'yes'),
(676, 'Leave Category Add', 'leavecategory_add', 'yes'),
(677, 'Leave Category Edit', 'leavecategory_edit', 'yes'),
(678, 'Leave Category Delete', 'leavecategory_delete', 'yes'),
(679, 'Leave Assign', 'leaveassign', 'yes'),
(680, 'Leave Assign Add', 'leaveassign_add', 'yes'),
(681, 'Leave Assign Edit', 'leaveassign_edit', 'yes'),
(682, 'Leave Assign Delete', 'leaveassign_delete', 'yes'),
(683, 'Leave Apply', 'leaveapply', 'yes'),
(684, 'Leave Apply Add', 'leaveapply_add', 'yes'),
(685, 'Leave Apply Edit', 'leaveapply_edit', 'yes'),
(686, 'Leave Apply Delete', 'leaveapply_delete', 'yes'),
(687, 'Leave Apply View', 'leaveapply_view', 'yes'),
(688, 'Leave Application', 'leaveapplication', 'yes'),
(689, 'Activities Category', 'activitiescategory', 'yes'),
(690, 'Activities Category Add', 'activitiescategory_add', 'yes'),
(691, 'Activities Category Edit', 'activitiescategory_edit', 'yes'),
(692, 'Activities Category Delete', 'activitiescategory_delete', 'yes'),
(693, 'Activities', 'activities', 'yes'),
(694, 'Activities Add', 'activities_add', 'yes'),
(695, 'Activities Delete', 'activities_delete', 'yes'),
(696, 'Child Care', 'childcare', 'yes'),
(697, 'Child Care Add', 'childcare_add', 'yes'),
(698, 'Child Care Edit', 'childcare_edit', 'yes'),
(699, 'Child Care Delete', 'childcare_delete', 'yes'),
(700, 'Library Member', 'lmember', 'yes'),
(701, 'Library Member Add', 'lmember_add', 'yes'),
(702, 'Library Member Edit', 'lmember_edit', 'yes'),
(703, 'Library Member Delete', 'lmember_delete', 'yes'),
(704, 'Library Member View', 'lmember_view', 'yes'),
(705, 'Books', 'book', 'yes'),
(706, 'Books Add', 'book_add', 'yes'),
(707, 'Books Edit', 'book_edit', 'yes'),
(708, 'Books Delete', 'book_delete', 'yes'),
(709, 'Issue Book', 'issue', 'yes'),
(710, 'Issue Book Add', 'issue_add', 'yes'),
(711, 'Issue Book Edit', 'issue_edit', 'yes'),
(712, 'Issue Book View', 'issue_view', 'yes'),
(713, 'E-Books', 'ebooks', 'yes'),
(714, 'E-Books Add', 'ebooks_add', 'yes'),
(715, 'E-Books Edit', 'ebooks_edit', 'yes'),
(716, 'E-Books Delete', 'ebooks_delete', 'yes'),
(717, 'E-Books View', 'ebooks_view', 'yes'),
(718, 'Transport', 'transport', 'yes'),
(719, 'Transport Add', 'transport_add', 'yes'),
(720, 'Transport Edit', 'transport_edit', 'yes'),
(721, 'Transport Delete', 'transport_delete', 'yes'),
(722, 'Transport Member', 'tmember', 'yes'),
(723, 'Transport Member Add', 'tmember_add', 'yes'),
(724, 'Transport Member Edit', 'tmember_edit', 'yes'),
(725, 'Transport Member Delete', 'tmember_delete', 'yes'),
(726, 'Transport Member View', 'tmember_view', 'yes'),
(727, 'Hostel', 'hostel', 'yes'),
(728, 'Hostel Add', 'hostel_add', 'yes'),
(729, 'Hostel Edit', 'hostel_edit', 'yes'),
(730, 'Hostel Delete', 'hostel_delete', 'yes'),
(731, 'Hostel Category', 'category', 'yes'),
(732, 'Hostel Category Add', 'category_add', 'yes'),
(733, 'Hostel Category Edit', 'category_edit', 'yes'),
(734, 'Hostel Category Delete', 'category_delete', 'yes'),
(735, 'Hostel Member', 'hmember', 'yes'),
(736, 'Hostel Member Add', 'hmember_add', 'yes'),
(737, 'Hostel Member Edit', 'hmember_edit', 'yes'),
(738, 'Hostel Member Delete', 'hmember_delete', 'yes'),
(739, 'Hostel Member View', 'hmember_view', 'yes'),
(740, 'Fee Types', 'feetypes', 'yes'),
(741, 'Fee Types Add', 'feetypes_add', 'yes'),
(742, 'Fee Types Edit', 'feetypes_edit', 'yes'),
(743, 'Fee Types Delete', 'feetypes_delete', 'yes'),
(744, 'Invoice', 'invoice', 'yes'),
(745, 'Invoice Add', 'invoice_add', 'yes'),
(746, 'Invoice Edit', 'invoice_edit', 'yes'),
(747, 'Invoice Delete', 'invoice_delete', 'yes'),
(748, 'Invoice View', 'invoice_view', 'yes'),
(749, 'Payment History', 'paymenthistory', 'yes'),
(750, 'Payment History Edit', 'paymenthistory_edit', 'yes'),
(751, 'Payment History Delete', 'paymenthistory_delete', 'yes'),
(752, 'Expense', 'expense', 'yes'),
(753, 'Expense Add', 'expense_add', 'yes'),
(754, 'Expense Edit', 'expense_edit', 'yes'),
(755, 'Expense Delete', 'expense_delete', 'yes'),
(756, 'Income', 'income', 'yes'),
(757, 'Income Add', 'income_add', 'yes'),
(758, 'Income Edit', 'income_edit', 'yes'),
(759, 'Income Delete', 'income_delete', 'yes'),
(760, 'Global Payment', 'global_payment', 'yes'),
(761, 'Notice', 'notice', 'yes'),
(762, 'Notice Add', 'notice_add', 'yes'),
(763, 'Notice Edit', 'notice_edit', 'yes'),
(764, 'Notice Delete', 'notice_delete', 'yes'),
(765, 'Notice View', 'notice_view', 'yes'),
(766, 'Event', 'event', 'yes'),
(767, 'Event Add', 'event_add', 'yes'),
(768, 'Event Edit', 'event_edit', 'yes'),
(769, 'Event Delete', 'event_delete', 'yes'),
(770, 'Event View', 'event_view', 'yes'),
(771, 'Holiday', 'holiday', 'yes'),
(772, 'Holiday Add', 'holiday_add', 'yes'),
(773, 'Holiday Edit', 'holiday_edit', 'yes'),
(774, 'Holiday Delete', 'holiday_delete', 'yes'),
(775, 'Holiday View', 'holiday_view', 'yes'),
(776, 'Classes Report', 'classesreport', 'yes'),
(777, 'Student Report', 'studentreport', 'yes'),
(778, 'ID Card Report', 'idcardreport', 'yes'),
(779, 'Admit Card Report', 'admitcardreport', 'yes'),
(780, 'Routine Report', 'routinereport', 'yes'),
(781, 'Exam Schedule Report', 'examschedulereport', 'yes'),
(782, 'Attendance Report', 'attendancereport', 'yes'),
(783, 'Attendance Overview Report', 'attendanceoverviewreport', 'yes'),
(784, 'Library Books Report', 'librarybooksreport', 'yes'),
(785, 'Library Card Report', 'librarycardreport', 'yes'),
(786, 'Library Book Issue Report', 'librarybookissuereport', 'yes'),
(787, 'Terminal Report', 'terminalreport', 'yes'),
(788, 'Merit Stage Report', 'meritstagereport', 'yes'),
(789, 'Tabulation Sheet Report', 'tabulationsheetreport', 'yes'),
(790, 'Mark Sheet Report', 'marksheetreport', 'yes'),
(791, 'Progress Card Report', 'progresscardreport', 'yes'),
(792, 'Online Exam Report', 'onlineexamreport', 'yes'),
(793, 'Online Exam Question Report', 'onlineexamquestionreport', 'yes'),
(794, 'Online Admission Report', 'onlineadmissionreport', 'yes'),
(795, 'Certificate Report', 'certificatereport', 'yes'),
(796, 'Leave Application Report', 'leaveapplicationreport', 'yes'),
(797, 'Product Purchase Report', 'productpurchasereport', 'yes'),
(798, 'Product Sale Report', 'productsalereport', 'yes'),
(799, 'Search Payment Fees Report', 'searchpaymentfeesreport', 'yes'),
(800, 'Fees Report', 'feesreport', 'yes'),
(801, 'Due Fees Report', 'duefeesreport', 'yes'),
(802, 'Balance Fees Report', 'balancefeesreport', 'yes'),
(803, 'Transaction', 'transactionreport', 'yes'),
(804, 'Student Fine Report', 'studentfinereport', 'yes'),
(805, 'Salary Report', 'salaryreport', 'yes'),
(806, 'Account Ledger Report', 'accountledgerreport', 'yes'),
(807, 'Online Admission', 'onlineadmission', 'yes'),
(808, 'Visitor Information', 'visitorinfo', 'yes'),
(809, 'Visitor Information Delete', 'visitorinfo_delete', 'yes'),
(810, 'Visitor Infomation View', 'visitorinfo_view', 'yes'),
(811, 'Academic Year', 'schoolyear', 'yes'),
(812, 'Academic Year Add', 'schoolyear_add', 'yes'),
(813, 'Academic Year Edit', 'schoolyear_edit', 'yes'),
(814, 'Academic Year Delete', 'schoolyear_delete', 'yes'),
(815, 'Student Group', 'studentgroup', 'yes'),
(816, 'Student Group Add', 'studentgroup_add', 'yes'),
(817, 'Student Group Edit', 'studentgroup_edit', 'yes'),
(818, 'Student Group Delete', 'studentgroup_delete', 'yes'),
(819, 'Complain', 'complain', 'yes'),
(820, 'Complain Add', 'complain_add', 'yes'),
(821, 'Complain Edit', 'complain_edit', 'yes'),
(822, 'Complain Delete', 'complain_delete', 'yes'),
(823, 'Complain View', 'complain_view', 'yes'),
(824, 'Certificate Template', 'certificate_template', 'yes'),
(825, 'Certificate Template Add', 'certificate_template_add', 'yes'),
(826, 'Certificate Template Edit', 'certificate_template_edit', 'yes'),
(827, 'Certificate Template Delete', 'certificate_template_delete', 'yes'),
(828, 'Certificate Template View', 'certificate_template_view', 'yes'),
(829, 'System Admin', 'systemadmin', 'yes'),
(830, 'System Admin Add', 'systemadmin_add', 'yes'),
(831, 'System Admin Edit', 'systemadmin_edit', 'yes'),
(832, 'System Admin Delete', 'systemadmin_delete', 'yes'),
(833, 'System Admin View', 'systemadmin_view', 'yes'),
(834, 'Reset Password', 'resetpassword', 'yes'),
(835, 'Social Link', 'sociallink', 'yes'),
(836, 'Social Link Add', 'sociallink_add', 'yes'),
(837, 'Social Link Edit', 'sociallink_edit', 'yes'),
(838, 'Social Link Delete', 'sociallink_delete', 'yes'),
(839, 'Mail / SMS Template', 'mailandsmstemplate', 'yes'),
(840, 'Mail / SMS Template Add', 'mailandsmstemplate_add', 'yes'),
(841, 'Mail / SMS Template Edit', 'mailandsmstemplate_edit', 'yes'),
(842, 'Mail / SMS Template Delete', 'mailandsmstemplate_delete', 'yes'),
(843, 'Mail / SMS Template View', 'mailandsmstemplate_view', 'yes'),
(844, 'Import', 'bulkimport ', 'yes'),
(845, 'Backup', 'backup', 'yes'),
(846, 'Role', 'usertype', 'yes'),
(847, 'Role Add', 'usertype_add', 'yes'),
(848, 'Role Edit', 'usertype_edit', 'yes'),
(849, 'Role Delete', 'usertype_delete', 'yes'),
(850, 'Permission', 'permission', 'yes'),
(851, 'Auto Update', 'update', 'yes'),
(852, 'Posts Categories', 'posts_categories', 'yes'),
(853, 'Posts Categories Add', 'posts_categories_add', 'yes'),
(854, 'Posts Categories Edit', 'posts_categories_edit', 'yes'),
(855, 'Posts Categories Delete', 'posts_categories_delete', 'yes'),
(856, 'Posts', 'posts', 'yes'),
(857, 'Posts Add', 'posts_add', 'yes'),
(858, 'Posts Edit', 'posts_edit', 'yes'),
(859, 'Posts Delete', 'posts_delete', 'yes'),
(860, 'Pages', 'pages', 'yes'),
(861, 'Pages Add', 'pages_add', 'yes'),
(862, 'Pages Edit', 'pages_edit', 'yes'),
(863, 'Pages Delete', 'pages_delete', 'yes'),
(864, 'Menu', 'frontendmenu', 'yes'),
(865, 'General Setting', 'setting', 'yes'),
(866, 'Frontend Setting', 'frontend_setting', 'yes'),
(867, 'Payment Settings', 'paymentsettings', 'yes'),
(868, 'SMS Settings', 'smssettings', 'yes'),
(869, 'Email Setting', 'emailsetting', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `permission_relationships`
--

CREATE TABLE `permission_relationships` (
  `permission_id` int(11) NOT NULL,
  `usertype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_relationships`
--

INSERT INTO `permission_relationships` (`permission_id`, `usertype_id`) VALUES
(501, 2),
(502, 2),
(506, 2),
(507, 2),
(511, 2),
(512, 2),
(516, 2),
(531, 2),
(535, 2),
(536, 2),
(537, 2),
(538, 2),
(539, 2),
(540, 2),
(541, 2),
(542, 2),
(543, 2),
(544, 2),
(548, 2),
(549, 2),
(550, 2),
(551, 2),
(553, 2),
(554, 2),
(556, 2),
(561, 2),
(569, 2),
(570, 2),
(571, 2),
(572, 2),
(573, 2),
(579, 2),
(580, 2),
(581, 2),
(582, 2),
(586, 2),
(587, 2),
(588, 2),
(590, 2),
(591, 2),
(592, 2),
(594, 2),
(595, 2),
(596, 2),
(598, 2),
(599, 2),
(600, 2),
(601, 2),
(603, 2),
(604, 2),
(605, 2),
(607, 2),
(683, 2),
(684, 2),
(685, 2),
(686, 2),
(687, 2),
(688, 2),
(693, 2),
(694, 2),
(695, 2),
(705, 2),
(713, 2),
(717, 2),
(718, 2),
(727, 2),
(731, 2),
(761, 2),
(765, 2),
(766, 2),
(770, 2),
(771, 2),
(775, 2),
(777, 2),
(780, 2),
(781, 2),
(782, 2),
(783, 2),
(787, 2),
(788, 2),
(789, 2),
(790, 2),
(791, 2),
(792, 2),
(793, 2),
(819, 2),
(820, 2),
(823, 2),
(501, 4),
(502, 4),
(506, 4),
(512, 4),
(516, 4),
(531, 4),
(535, 4),
(544, 4),
(548, 4),
(550, 4),
(561, 4),
(571, 4),
(573, 4),
(579, 4),
(580, 4),
(693, 4),
(696, 4),
(700, 4),
(704, 4),
(705, 4),
(709, 4),
(712, 4),
(718, 4),
(722, 4),
(726, 4),
(727, 4),
(731, 4),
(735, 4),
(739, 4),
(744, 4),
(748, 4),
(749, 4),
(761, 4),
(765, 4),
(766, 4),
(770, 4),
(771, 4),
(775, 4),
(819, 4),
(820, 4),
(823, 4),
(501, 5),
(512, 5),
(516, 5),
(554, 5),
(556, 5),
(579, 5),
(580, 5),
(608, 5),
(609, 5),
(610, 5),
(611, 5),
(612, 5),
(613, 5),
(614, 5),
(615, 5),
(616, 5),
(617, 5),
(618, 5),
(619, 5),
(620, 5),
(621, 5),
(622, 5),
(649, 5),
(650, 5),
(651, 5),
(652, 5),
(653, 5),
(654, 5),
(655, 5),
(656, 5),
(657, 5),
(658, 5),
(659, 5),
(660, 5),
(661, 5),
(662, 5),
(663, 5),
(664, 5),
(665, 5),
(666, 5),
(667, 5),
(668, 5),
(669, 5),
(670, 5),
(671, 5),
(672, 5),
(673, 5),
(674, 5),
(683, 5),
(684, 5),
(685, 5),
(686, 5),
(687, 5),
(718, 5),
(722, 5),
(723, 5),
(724, 5),
(725, 5),
(726, 5),
(727, 5),
(731, 5),
(735, 5),
(736, 5),
(737, 5),
(738, 5),
(739, 5),
(740, 5),
(741, 5),
(742, 5),
(743, 5),
(744, 5),
(745, 5),
(746, 5),
(747, 5),
(748, 5),
(749, 5),
(750, 5),
(751, 5),
(752, 5),
(753, 5),
(754, 5),
(755, 5),
(756, 5),
(757, 5),
(758, 5),
(759, 5),
(760, 5),
(761, 5),
(765, 5),
(766, 5),
(770, 5),
(771, 5),
(775, 5),
(797, 5),
(798, 5),
(799, 5),
(800, 5),
(801, 5),
(802, 5),
(803, 5),
(804, 5),
(805, 5),
(819, 5),
(820, 5),
(823, 5),
(501, 6),
(512, 6),
(516, 6),
(531, 6),
(554, 6),
(556, 6),
(579, 6),
(580, 6),
(683, 6),
(684, 6),
(685, 6),
(686, 6),
(687, 6),
(700, 6),
(701, 6),
(702, 6),
(703, 6),
(704, 6),
(705, 6),
(706, 6),
(707, 6),
(708, 6),
(709, 6),
(710, 6),
(711, 6),
(712, 6),
(713, 6),
(714, 6),
(715, 6),
(716, 6),
(717, 6),
(718, 6),
(727, 6),
(731, 6),
(761, 6),
(765, 6),
(766, 6),
(770, 6),
(771, 6),
(775, 6),
(777, 6),
(784, 6),
(785, 6),
(786, 6),
(819, 6),
(820, 6),
(823, 6),
(501, 7),
(502, 7),
(506, 7),
(507, 7),
(511, 7),
(512, 7),
(516, 7),
(517, 7),
(521, 7),
(548, 7),
(550, 7),
(551, 7),
(553, 7),
(554, 7),
(556, 7),
(579, 7),
(580, 7),
(683, 7),
(684, 7),
(685, 7),
(686, 7),
(687, 7),
(727, 7),
(731, 7),
(761, 7),
(765, 7),
(766, 7),
(770, 7),
(771, 7),
(775, 7),
(808, 7),
(809, 7),
(810, 7),
(819, 7),
(820, 7),
(823, 7),
(501, 1),
(502, 1),
(503, 1),
(504, 1),
(505, 1),
(506, 1),
(507, 1),
(508, 1),
(509, 1),
(510, 1),
(511, 1),
(512, 1),
(513, 1),
(514, 1),
(515, 1),
(516, 1),
(517, 1),
(518, 1),
(519, 1),
(520, 1),
(521, 1),
(522, 1),
(523, 1),
(524, 1),
(525, 1),
(526, 1),
(527, 1),
(528, 1),
(530, 1),
(531, 1),
(532, 1),
(533, 1),
(534, 1),
(548, 1),
(549, 1),
(550, 1),
(551, 1),
(552, 1),
(553, 1),
(554, 1),
(555, 1),
(556, 1),
(557, 1),
(558, 1),
(559, 1),
(560, 1),
(561, 1),
(562, 1),
(563, 1),
(564, 1),
(565, 1),
(566, 1),
(567, 1),
(568, 1),
(569, 1),
(570, 1),
(571, 1),
(572, 1),
(573, 1),
(574, 1),
(575, 1),
(576, 1),
(577, 1),
(578, 1),
(580, 1),
(581, 1),
(582, 1),
(608, 1),
(609, 1),
(610, 1),
(611, 1),
(612, 1),
(613, 1),
(614, 1),
(615, 1),
(616, 1),
(617, 1),
(618, 1),
(619, 1),
(620, 1),
(621, 1),
(622, 1),
(627, 1),
(628, 1),
(629, 1),
(630, 1),
(675, 1),
(676, 1),
(677, 1),
(678, 1),
(679, 1),
(680, 1),
(681, 1),
(682, 1),
(683, 1),
(684, 1),
(685, 1),
(686, 1),
(687, 1),
(688, 1),
(740, 1),
(741, 1),
(742, 1),
(743, 1),
(744, 1),
(745, 1),
(746, 1),
(747, 1),
(748, 1),
(749, 1),
(750, 1),
(751, 1),
(752, 1),
(753, 1),
(754, 1),
(755, 1),
(756, 1),
(757, 1),
(758, 1),
(759, 1),
(760, 1),
(761, 1),
(762, 1),
(763, 1),
(764, 1),
(765, 1),
(766, 1),
(767, 1),
(768, 1),
(769, 1),
(770, 1),
(771, 1),
(772, 1),
(773, 1),
(774, 1),
(775, 1),
(776, 1),
(777, 1),
(779, 1),
(781, 1),
(782, 1),
(783, 1),
(787, 1),
(788, 1),
(789, 1),
(790, 1),
(791, 1),
(795, 1),
(796, 1),
(797, 1),
(799, 1),
(800, 1),
(801, 1),
(802, 1),
(803, 1),
(804, 1),
(805, 1),
(806, 1),
(811, 1),
(812, 1),
(813, 1),
(814, 1),
(815, 1),
(816, 1),
(817, 1),
(818, 1),
(819, 1),
(820, 1),
(821, 1),
(822, 1),
(823, 1),
(824, 1),
(825, 1),
(826, 1),
(827, 1),
(828, 1),
(829, 1),
(830, 1),
(831, 1),
(832, 1),
(833, 1),
(834, 1),
(839, 1),
(840, 1),
(841, 1),
(842, 1),
(843, 1),
(844, 1),
(845, 1),
(846, 1),
(847, 1),
(848, 1),
(849, 1),
(850, 1),
(851, 1),
(852, 1),
(853, 1),
(854, 1),
(855, 1),
(865, 1),
(866, 1),
(867, 1),
(868, 1),
(869, 1),
(808, 1),
(809, 1),
(810, 1),
(835, 1),
(836, 1),
(837, 1),
(838, 1),
(856, 1),
(857, 1),
(858, 1),
(859, 1),
(860, 1),
(861, 1),
(862, 1),
(863, 1),
(864, 1),
(501, 3),
(502, 3),
(512, 3),
(516, 3),
(531, 3),
(539, 3),
(543, 3),
(544, 3),
(548, 3),
(561, 3),
(571, 3),
(579, 3),
(580, 3),
(683, 3),
(684, 3),
(685, 3),
(686, 3),
(687, 3),
(693, 3),
(700, 3),
(705, 3),
(709, 3),
(712, 3),
(713, 3),
(717, 3),
(718, 3),
(722, 3),
(727, 3),
(731, 3),
(744, 3),
(748, 3),
(749, 3),
(761, 3),
(765, 3),
(766, 3),
(770, 3),
(771, 3),
(775, 3),
(819, 3),
(820, 3),
(823, 3),
(594, 3),
(595, 3),
(596, 3),
(597, 3),
(598, 3),
(599, 3),
(600, 3),
(601, 3),
(602, 3);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postsID` int(11) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `content` text,
  `status` int(11) DEFAULT NULL COMMENT '1 => active, 2 => draft, 3 => trash, 4 => review  ',
  `visibility` int(11) DEFAULT NULL COMMENT '1 => public 2 => protected 3 => private ',
  `publish_date` datetime DEFAULT NULL,
  `parentID` int(11) NOT NULL DEFAULT '0',
  `postorder` int(11) NOT NULL DEFAULT '0',
  `featured_image` varchar(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `create_userID` int(11) DEFAULT NULL,
  `create_username` varchar(60) DEFAULT NULL,
  `create_usertypeID` int(11) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postsID`, `title`, `url`, `content`, `status`, `visibility`, `publish_date`, `parentID`, `postorder`, `featured_image`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertypeID`, `password`) VALUES
(1, 'Welcome To Lingo School', 'welcome-to-lingo-school', '<p></p><h2 style=\"text-align: center; \">Text Area</h2><h2 style=\"text-align: center; \"><img src=\"http://irex.pk/lingo-school/uploads/gallery/3ddf9402a1e5029a832060ad7c980b072a6f0b584c888e250143fc5cc666a96ed67c980db4b0aaf9dbbfe154f07c1a602db55cc6e67536546fc725f2ba6dc558.jpg\" alt=\"Lingo School \" style=\"color: rgb(0, 0, 0); font-family: Raleway, sans-serif; font-size: 12px; width: 100%;\"><br></h2><p></p>', 1, 1, '2019-07-16 00:59:01', 0, 0, '', '2019-07-16 01:01:36', '2019-07-16 01:14:58', 1, 'ctech', 1, NULL),
(2, 'Ioug', 'ioug', '<p>lkjhgjk</p>', 1, 1, '2019-08-27 16:24:01', 0, 0, '', '2019-08-27 04:24:53', '2019-08-27 04:24:53', 1, 'ctech', 1, NULL),
(3, 'Welcome To School Management Software', 'welcome-to-school-management-software', '<p><font face=\"Arial Black\">Tanzeel ur rehman is very nice person and hard working</font></p>', 2, 1, '2020-02-09 18:16:01', 0, 0, '5', '2020-02-09 06:20:37', '2020-03-19 10:13:15', 1, 'ctech', 1, NULL),
(4, 'Tanzeel', 'tanzeel', '<section id=\"gallery\" class=\"gallery-area area-padding\">\r\n    <div class=\"container foredit-container\">\r\n        <div class=\"row text-center\">\r\n            <div class=\"gallery-item\">\r\n\r\n<div class=\"single-gallery\">\r\n    <img src=\"http://localhost/schoolmanagement/uploads/gallery/209bfb657c59782c7d03f225429675bf02e1629e08e73b1ceff19336216188443b374fe56177ac6a94efc4baf7e1dea330d8e946c9e6cbbaff886da006065039.jpg\" alt=\"\">\r\n    <div class=\"overlay\">\r\n        <a class=\"venobox_custom\" data-gall=\"myGellary\" href=\"http://localhost/schoolmanagement/uploads/gallery/209bfb657c59782c7d03f225429675bf02e1629e08e73b1ceff19336216188443b374fe56177ac6a94efc4baf7e1dea330d8e946c9e6cbbaff886da006065039.jpg\"><i class=\"fa fa-link\"></i></a>\r\n    </div>\r\n</div>			\r\n			</div>\r\n        </div>\r\n    </div>\r\n</section>&nbsp;', 2, 1, '2020-04-23 16:28:01', 0, 0, '', '2020-04-23 04:29:14', '2020-04-23 04:29:57', 1, 'ctech', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts_categories`
--

CREATE TABLE `posts_categories` (
  `posts_categoriesID` int(11) NOT NULL,
  `posts_categories` varchar(40) DEFAULT NULL,
  `posts_slug` varchar(250) DEFAULT NULL,
  `posts_parent` int(11) DEFAULT '0',
  `posts_description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts_categories`
--

INSERT INTO `posts_categories` (`posts_categoriesID`, `posts_categories`, `posts_slug`, `posts_parent`, `posts_description`) VALUES
(1, 'Welcome to MS. School', '#', 0, 'Welcome to MS. School'),
(2, 'jkh', '#', 0, 'jvb'),
(3, 'tanzeel', '#', 0, ''),
(4, 'Goshi', '#', 0, 'The Owner of the School');

-- --------------------------------------------------------

--
-- Table structure for table `posts_category`
--

CREATE TABLE `posts_category` (
  `posts_categoryID` int(11) NOT NULL,
  `postsID` int(11) NOT NULL,
  `posts_categoriesID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts_category`
--

INSERT INTO `posts_category` (`posts_categoryID`, `postsID`, `posts_categoriesID`) VALUES
(4, 1, 1),
(6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productcategoryID` int(11) NOT NULL,
  `productname` varchar(128) NOT NULL,
  `productbuyingprice` double NOT NULL,
  `productsellingprice` double NOT NULL,
  `productdesc` text NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productcategoryID`, `productname`, `productbuyingprice`, `productsellingprice`, `productdesc`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 2, 'class x science', 260, 300, '', '2019-11-04 14:07:06', '2019-11-04 14:07:06', 1, 1),
(2, 3, 'new sweaters', 300, 400, '', '2020-02-07 09:12:05', '2020-02-07 09:12:05', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `productcategoryID` int(11) NOT NULL,
  `productcategoryname` varchar(128) NOT NULL,
  `productcategorydesc` text NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`productcategoryID`, `productcategoryname`, `productcategorydesc`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 'Text Books', '', '2019-08-27 18:42:57', '2019-08-27 18:42:57', 1, 1),
(2, 'books', 'science', '2019-11-04 14:05:50', '2019-11-04 14:05:50', 1, 1),
(3, 'sweaters', 'winter collection', '2020-02-07 09:11:21', '2020-02-07 09:11:21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productpurchase`
--

CREATE TABLE `productpurchase` (
  `productpurchaseID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `productsupplierID` int(11) NOT NULL,
  `productwarehouseID` int(11) NOT NULL,
  `productpurchasereferenceno` varchar(100) NOT NULL,
  `productpurchasedate` date NOT NULL,
  `productpurchasefile` varchar(200) DEFAULT NULL,
  `productpurchasefileorginalname` varchar(200) DEFAULT NULL,
  `productpurchasedescription` text,
  `productpurchasestatus` int(11) NOT NULL COMMENT '0 = pending, 1 = partial_paid,  2 = fully_paid',
  `productpurchaserefund` int(11) NOT NULL DEFAULT '0' COMMENT '0 = not refund, 1 = refund ',
  `productpurchasetaxID` int(11) NOT NULL DEFAULT '0',
  `productpurchasetaxamount` double NOT NULL DEFAULT '0',
  `productpurchasediscount` double NOT NULL DEFAULT '0',
  `productpurchaseshipping` double NOT NULL DEFAULT '0',
  `productpurchasepaymentterm` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productpurchase`
--

INSERT INTO `productpurchase` (`productpurchaseID`, `schoolyearID`, `productsupplierID`, `productwarehouseID`, `productpurchasereferenceno`, `productpurchasedate`, `productpurchasefile`, `productpurchasefileorginalname`, `productpurchasedescription`, `productpurchasestatus`, `productpurchaserefund`, `productpurchasetaxID`, `productpurchasetaxamount`, `productpurchasediscount`, `productpurchaseshipping`, `productpurchasepaymentterm`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 1, 1, 1, '12344', '2020-02-07', '', '', '', 1, 0, 0, 0, 0, 0, 0, '2020-02-07 09:16:41', '2020-02-07 09:16:41', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productpurchaseitem`
--

CREATE TABLE `productpurchaseitem` (
  `productpurchaseitemID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `productpurchaseID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productpurchaseunitprice` double NOT NULL,
  `productpurchasequantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productpurchaseitem`
--

INSERT INTO `productpurchaseitem` (`productpurchaseitemID`, `schoolyearID`, `productpurchaseID`, `productID`, `productpurchaseunitprice`, `productpurchasequantity`) VALUES
(1, 1, 1, 2, 400, 5);

-- --------------------------------------------------------

--
-- Table structure for table `productpurchasepaid`
--

CREATE TABLE `productpurchasepaid` (
  `productpurchasepaidID` int(11) NOT NULL,
  `productpurchasepaidschoolyearID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `productpurchaseID` int(11) NOT NULL,
  `productpurchasepaiddate` date NOT NULL,
  `productpurchasepaidreferenceno` varchar(100) NOT NULL,
  `productpurchasepaidamount` double NOT NULL,
  `productpurchasepaidpaymentmethod` int(11) NOT NULL COMMENT '1 = cash, 2 = cheque, 3 = crediit card, 4 = other',
  `productpurchasepaidfile` varchar(200) DEFAULT NULL,
  `productpurchasepaidorginalname` varchar(200) DEFAULT NULL,
  `productpurchasepaiddescription` text,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productpurchasepaid`
--

INSERT INTO `productpurchasepaid` (`productpurchasepaidID`, `productpurchasepaidschoolyearID`, `schoolyearID`, `productpurchaseID`, `productpurchasepaiddate`, `productpurchasepaidreferenceno`, `productpurchasepaidamount`, `productpurchasepaidpaymentmethod`, `productpurchasepaidfile`, `productpurchasepaidorginalname`, `productpurchasepaiddescription`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 1, 1, 1, '2020-02-07', '1456', 1000, 1, '', '', '', '2020-02-07 09:18:05', '2020-02-07 09:18:05', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productsale`
--

CREATE TABLE `productsale` (
  `productsaleID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `productsalecustomertypeID` int(11) NOT NULL,
  `productsalecustomerID` int(11) NOT NULL,
  `productsalereferenceno` varchar(100) NOT NULL,
  `productsaledate` date NOT NULL,
  `productsalefile` varchar(200) DEFAULT NULL,
  `productsalefileorginalname` varchar(200) DEFAULT NULL,
  `productsaledescription` text,
  `productsalestatus` int(11) NOT NULL COMMENT '0 = select_payment_status, 1 = due,  2 = partial, 3 = Paid',
  `productsalerefund` int(11) NOT NULL DEFAULT '0' COMMENT '0 = not refund, 1 = refund ',
  `productsaletaxID` int(11) NOT NULL DEFAULT '0',
  `productsaletaxamount` double NOT NULL DEFAULT '0',
  `productsalediscount` double NOT NULL DEFAULT '0',
  `productsaleshipping` double NOT NULL DEFAULT '0',
  `productsalepaymentterm` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productsale`
--

INSERT INTO `productsale` (`productsaleID`, `schoolyearID`, `productsalecustomertypeID`, `productsalecustomerID`, `productsalereferenceno`, `productsaledate`, `productsalefile`, `productsalefileorginalname`, `productsaledescription`, `productsalestatus`, `productsalerefund`, `productsaletaxID`, `productsaletaxamount`, `productsalediscount`, `productsaleshipping`, `productsalepaymentterm`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 1, 6, 7, '321', '2019-12-06', '', '', '', 1, 0, 0, 0, 0, 0, 0, '2020-02-07 09:22:08', '2020-02-07 09:22:08', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productsaleitem`
--

CREATE TABLE `productsaleitem` (
  `productsaleitemID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `productsaleID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `productsaleserialno` varchar(100) DEFAULT '0',
  `productsaleunitprice` double NOT NULL,
  `productsalequantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productsaleitem`
--

INSERT INTO `productsaleitem` (`productsaleitemID`, `schoolyearID`, `productsaleID`, `productID`, `productsaleserialno`, `productsaleunitprice`, `productsalequantity`) VALUES
(1, 1, 1, 2, '0', 400, 5);

-- --------------------------------------------------------

--
-- Table structure for table `productsalepaid`
--

CREATE TABLE `productsalepaid` (
  `productsalepaidID` int(11) NOT NULL,
  `productsalepaidschoolyearID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `productsaleID` int(11) NOT NULL,
  `productsalepaiddate` date NOT NULL,
  `productsalepaidreferenceno` varchar(100) NOT NULL,
  `productsalepaidamount` double NOT NULL,
  `productsalepaidpaymentmethod` int(11) NOT NULL COMMENT '1 = cash, 2 = cheque, 3 = crediit card, 4 = other',
  `productsalepaidfile` varchar(200) DEFAULT NULL,
  `productsalepaidorginalname` varchar(200) DEFAULT NULL,
  `productsalepaiddescription` text,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `productsupplier`
--

CREATE TABLE `productsupplier` (
  `productsupplierID` int(11) NOT NULL,
  `productsuppliercompanyname` varchar(128) NOT NULL,
  `productsuppliername` varchar(40) NOT NULL,
  `productsupplieremail` varchar(40) DEFAULT NULL,
  `productsupplierphone` varchar(20) DEFAULT NULL,
  `productsupplieraddress` text,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productsupplier`
--

INSERT INTO `productsupplier` (`productsupplierID`, `productsuppliercompanyname`, `productsuppliername`, `productsupplieremail`, `productsupplierphone`, `productsupplieraddress`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 'Detto', 'pakistan', '', '', '', '2020-02-07 09:14:38', '2020-02-07 09:14:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productwarehouse`
--

CREATE TABLE `productwarehouse` (
  `productwarehouseID` int(11) NOT NULL,
  `productwarehousename` varchar(128) NOT NULL,
  `productwarehousecode` varchar(128) NOT NULL,
  `productwarehouseemail` varchar(40) DEFAULT NULL,
  `productwarehousephone` varchar(20) DEFAULT NULL,
  `productwarehouseaddress` text,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productwarehouse`
--

INSERT INTO `productwarehouse` (`productwarehouseID`, `productwarehousename`, `productwarehousecode`, `productwarehouseemail`, `productwarehousephone`, `productwarehouseaddress`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 'sweaters', '123', '', '', '', '2020-02-07 09:14:02', '2020-02-07 09:14:02', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotionlog`
--

CREATE TABLE `promotionlog` (
  `promotionLogID` int(11) UNSIGNED NOT NULL,
  `promotionType` varchar(50) DEFAULT NULL,
  `classesID` int(11) NOT NULL,
  `jumpClassID` int(11) NOT NULL,
  `schoolYearID` int(11) NOT NULL,
  `jumpSchoolYearID` int(11) NOT NULL,
  `subjectandsubjectcodeandmark` longtext,
  `exams` longtext,
  `markpercentages` longtext,
  `promoteStudents` longtext,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `create_userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotionlog`
--

INSERT INTO `promotionlog` (`promotionLogID`, `promotionType`, `classesID`, `jumpClassID`, `schoolYearID`, `jumpSchoolYearID`, `subjectandsubjectcodeandmark`, `exams`, `markpercentages`, `promoteStudents`, `status`, `created_at`, `create_userID`) VALUES
(1, 'normal', 12, 1, 1, 2, '{\"1\":\"25\",\"2\":\"25\",\"3\":\"25\",\"4\":\"25\",\"5\":\"9\",\"30\":\"25\",\"31\":\"16\"}', '{\"2\":\"on\",\"3\":\"on\",\"1\":\"on\"}', '{\"1\":\"on\"}', NULL, 0, '2019-10-28 12:11:54', 1),
(2, 'normal', 1, 2, 1, 2, '{\"32\":\"25\",\"33\":\"25\",\"34\":\"25\",\"35\":\"25\",\"36\":\"9\",\"37\":\"25\",\"39\":\"25\",\"40\":\"16\",\"47\":\"25\"}', '{\"2\":\"on\",\"3\":\"on\",\"1\":\"on\"}', '{\"1\":\"on\"}', NULL, 0, '2019-11-01 04:16:52', 1),
(3, 'advance', 12, 1, 1, 2, '{\"1\":\"25\",\"2\":\"25\",\"3\":\"25\",\"4\":\"25\",\"5\":\"9\",\"30\":\"25\",\"31\":\"16\"}', '{\"2\":\"on\",\"3\":\"on\",\"1\":\"on\",\"4\":\"on\"}', '{\"1\":\"on\",\"2\":\"on\",\"3\":\"on\"}', '[{\"studentID\":\"3\",\"roll\":1,\"enroll\":null,\"sectionID\":8}]', 1, '2020-02-26 07:39:47', 1),
(4, 'advance', 1, 12, 1, 2, '{\"32\":\"25\",\"33\":\"25\",\"34\":\"25\",\"35\":\"25\",\"36\":\"9\",\"37\":\"25\",\"39\":\"25\",\"40\":\"16\",\"47\":\"25\",\"110\":\"33\",\"111\":\"33\"}', 'null', 'null', NULL, 0, '2020-02-26 07:42:24', 1),
(5, 'normal', 1, 12, 1, 2, '{\"32\":\"25\",\"33\":\"25\",\"34\":\"25\",\"35\":\"25\",\"36\":\"9\",\"37\":\"25\",\"39\":\"25\",\"40\":\"16\",\"47\":\"25\",\"110\":\"33\",\"111\":\"33\"}', '{\"2\":\"on\",\"3\":\"on\",\"1\":\"on\",\"4\":\"on\"}', '{\"1\":\"on\",\"2\":\"on\",\"3\":\"on\"}', '[{\"studentID\":\"4\",\"roll\":1,\"enroll\":null,\"sectionID\":16}]', 1, '2020-02-26 07:43:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseID` int(11) NOT NULL,
  `assetID` int(11) NOT NULL,
  `vendorID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `purchase_price` double NOT NULL,
  `purchased_by` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `expire_date` date DEFAULT NULL,
  `create_date` date NOT NULL,
  `modify_date` date NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseID`, `assetID`, `vendorID`, `quantity`, `unit`, `purchase_date`, `service_date`, `purchase_price`, `purchased_by`, `usertypeID`, `status`, `expire_date`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, 2, 1, 3, 2, '2020-02-03', NULL, 7000, 7, 6, 1, NULL, '2020-02-04', '2020-02-04', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_answer`
--

CREATE TABLE `question_answer` (
  `answerID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `optionID` int(11) DEFAULT NULL,
  `typeNumber` int(11) NOT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_answer`
--

INSERT INTO `question_answer` (`answerID`, `questionID`, `optionID`, `typeNumber`, `text`) VALUES
(1, 1, 1, 2, NULL),
(2, 1, 2, 2, NULL),
(3, 2, 11, 1, NULL),
(4, 3, 21, 2, NULL),
(5, 4, 31, 2, NULL),
(6, 5, NULL, 3, '1934'),
(7, 5, NULL, 3, '1947'),
(8, 6, NULL, 3, 'serch engine'),
(9, 6, NULL, 3, 'WEBSITE');

-- --------------------------------------------------------

--
-- Table structure for table `question_bank`
--

CREATE TABLE `question_bank` (
  `questionBankID` int(11) NOT NULL,
  `question` text NOT NULL,
  `explanation` text,
  `levelID` int(11) DEFAULT NULL,
  `groupID` int(11) DEFAULT NULL,
  `totalQuestion` int(11) DEFAULT '0',
  `totalOption` int(11) DEFAULT NULL,
  `typeNumber` int(11) DEFAULT NULL,
  `parentID` int(11) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `mark` int(11) DEFAULT '0',
  `hints` text,
  `upload` varchar(512) DEFAULT NULL,
  `subjectID` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_usertypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_bank`
--

INSERT INTO `question_bank` (`questionBankID`, `question`, `explanation`, `levelID`, `groupID`, `totalQuestion`, `totalOption`, `typeNumber`, `parentID`, `time`, `mark`, `hints`, `upload`, `subjectID`, `create_date`, `modify_date`, `create_userID`, `create_usertypeID`) VALUES
(1, '67u7', '67u67u', 1, 3, 0, 3, 2, 0, 0, 4, '67u', '', NULL, '2019-10-13 00:55:35', '2019-11-04 19:08:16', 1, 1),
(2, 'erer', 'erer', 1, 3, 0, 3, 1, 0, 0, 4, 'er', '', NULL, '2019-10-13 00:57:01', '2019-11-04 19:08:08', 1, 1),
(3, 'What is Google?', 'Google is a search engine', 4, 5, 0, 2, 2, 0, 0, 1, 'engine', '', NULL, '2020-05-09 20:22:38', '2020-05-09 20:22:38', 1, 1),
(4, 'What is Human', 'Human is Mankind', 4, 5, 0, 2, 2, 0, 0, 1, 'human', '', NULL, '2020-05-09 20:24:19', '2020-05-09 20:24:19', 1, 1),
(5, '<b><i><span xss=removed>When Pakistan Came into Being</span></i></b>', 'what is date when pakistan came into being', 5, 6, 0, 2, 3, 0, 0, 100, 'solved', '1ba2caa50b9e2b330f653cfc93d0dd000ccf68ad9e0b41aa31fd1290ef0556f3ce247e11f082e42b89f1cb7a57acc93e0422c1e9cf47beebf003899dc57c38ce.png', NULL, '2020-07-09 10:47:39', '2020-07-09 11:03:01', 1, 1),
(6, 'what is google?', 'to look in to question', 5, 6, 0, 2, 3, 0, 0, 50, 'seo', '', NULL, '2020-07-09 10:50:53', '2020-07-09 11:02:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_group`
--

CREATE TABLE `question_group` (
  `questionGroupID` int(11) NOT NULL,
  `title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_group`
--

INSERT INTO `question_group` (`questionGroupID`, `title`) VALUES
(3, 'General'),
(4, 'First Group'),
(5, 'Tanzeel'),
(6, 'Demo quizz Question Group');

-- --------------------------------------------------------

--
-- Table structure for table `question_level`
--

CREATE TABLE `question_level` (
  `questionLevelID` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_level`
--

INSERT INTO `question_level` (`questionLevelID`, `name`) VALUES
(1, 'Easy'),
(2, 'Medium'),
(3, 'Hard'),
(4, 'very easy'),
(5, 'demo quizz question Level');

-- --------------------------------------------------------

--
-- Table structure for table `question_option`
--

CREATE TABLE `question_option` (
  `optionID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `img` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_option`
--

INSERT INTO `question_option` (`optionID`, `questionID`, `name`, `img`) VALUES
(1, 1, '34334', NULL),
(2, 1, '343', NULL),
(3, 1, '3434', NULL),
(4, 1, '', NULL),
(5, 1, '', NULL),
(6, 1, '', NULL),
(7, 1, '', NULL),
(8, 1, '', NULL),
(9, 1, '', NULL),
(10, 1, '', NULL),
(11, 2, 'ere', ''),
(12, 2, 'rere', ''),
(13, 2, 'rere', ''),
(14, 2, '', NULL),
(15, 2, '', NULL),
(16, 2, '', NULL),
(17, 2, '', NULL),
(18, 2, '', NULL),
(19, 2, '', NULL),
(20, 2, '', NULL),
(21, 3, 'Engine', ''),
(22, 3, 'website', ''),
(23, 3, '', NULL),
(24, 3, '', NULL),
(25, 3, '', NULL),
(26, 3, '', NULL),
(27, 3, '', NULL),
(28, 3, '', NULL),
(29, 3, '', NULL),
(30, 3, '', NULL),
(31, 4, 'Man', ''),
(32, 4, 'Animal', ''),
(33, 4, '', NULL),
(34, 4, '', NULL),
(35, 4, '', NULL),
(36, 4, '', NULL),
(37, 4, '', NULL),
(38, 4, '', NULL),
(39, 4, '', NULL),
(40, 4, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE `question_type` (
  `questionTypeID` int(11) NOT NULL,
  `typeNumber` int(11) NOT NULL,
  `name` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`questionTypeID`, `typeNumber`, `name`) VALUES
(1, 1, 'Single Answer'),
(2, 2, 'Multi Answer'),
(3, 3, 'Fill in the blanks');

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

CREATE TABLE `reset` (
  `resetID` int(11) UNSIGNED NOT NULL,
  `keyID` varchar(128) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE `routine` (
  `routineID` int(11) UNSIGNED NOT NULL,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `day` varchar(60) NOT NULL,
  `start_time` varchar(10) NOT NULL,
  `end_time` varchar(10) NOT NULL,
  `room` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`routineID`, `classesID`, `sectionID`, `subjectID`, `schoolyearID`, `teacherID`, `day`, `start_time`, `end_time`, `room`) VALUES
(1, 6, 13, 84, 1, 27, 'MONDAY', '2:15 PM', '3:15 PM', 'tm'),
(2, 19, 25, 108, 1, 31, 'MONDAY', '9:30 AM', '11:00 AM', '2'),
(3, 12, 16, 1, 1, 34, 'TUESDAY', '9:15 AM', '10:15 AM', '6'),
(4, 19, 25, 109, 1, 32, 'WEDNESDAY', '10:15 AM', '11:00 AM', '6'),
(5, 1, 8, 113, 1, 32, 'TUESDAY', '12:30 PM', '12:30 PM', '1'),
(6, 1, 8, 113, 1, 34, 'MONDAY', '1:30 PM', '2:30 PM', '1');

-- --------------------------------------------------------

--
-- Table structure for table `salary_option`
--

CREATE TABLE `salary_option` (
  `salary_optionID` int(11) NOT NULL,
  `salary_templateID` int(11) NOT NULL,
  `option_type` int(11) NOT NULL COMMENT 'Allowances =1, Dllowances = 2, Increment = 3',
  `label_name` varchar(128) DEFAULT NULL,
  `label_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary_option`
--

INSERT INTO `salary_option` (`salary_optionID`, `salary_templateID`, `option_type`, `label_name`, `label_amount`) VALUES
(3, 13, 1, '100', 200),
(4, 14, 1, 'House Rent', 2000),
(5, 15, 1, 'House Rent', 5000),
(6, 16, 1, 'House Rent', 2000),
(7, 17, 1, 'House Rent', 100),
(8, 18, 1, 'rent', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `salary_template`
--

CREATE TABLE `salary_template` (
  `salary_templateID` int(11) NOT NULL,
  `salary_grades` varchar(128) NOT NULL,
  `basic_salary` text NOT NULL,
  `overtime_rate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary_template`
--

INSERT INTO `salary_template` (`salary_templateID`, `salary_grades`, `basic_salary`, `overtime_rate`) VALUES
(12, '10', '200', '6'),
(13, '12', '2500', '150'),
(14, '20', '30000', '0'),
(15, 'Director', '15000', '0'),
(16, 'Librarian', '15000', '0'),
(17, 'Senior Teacher', '12000', '0'),
(18, '10 grades', '20000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyear`
--

CREATE TABLE `schoolyear` (
  `schoolyearID` int(11) NOT NULL,
  `schooltype` varchar(40) DEFAULT NULL,
  `schoolyear` varchar(128) NOT NULL,
  `schoolyeartitle` varchar(128) DEFAULT NULL,
  `startingdate` date NOT NULL,
  `endingdate` date NOT NULL,
  `semestercode` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(100) NOT NULL,
  `create_usertype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schoolyear`
--

INSERT INTO `schoolyear` (`schoolyearID`, `schooltype`, `schoolyear`, `schoolyeartitle`, `startingdate`, `endingdate`, `semestercode`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(1, 'classbase', '2019-2020', '', '2019-09-10', '2020-07-30', NULL, '2019-01-01 12:35:25', '2019-08-27 09:32:47', 1, 'admin', 'Admin'),
(2, 'classbase', '2020', '2020- 2021', '2020-10-26', '2021-10-20', NULL, '2019-10-26 05:35:54', '2019-10-26 05:35:54', 1, 'ctech', 'Admin'),
(3, 'classbase', '2021', 'This Year', '2020-08-05', '2021-01-21', NULL, '2020-02-24 07:36:18', '2020-02-24 07:36:18', 1, 'ctech', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `school_sessions`
--

CREATE TABLE `school_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school_sessions`
--

INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('dpu1n9ijdvqgrelvnn4f6p8lldj3abn4', '::1', 1594202254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343230323234393b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d),
('1e85s7mrs3r82ko9p2q81cbrro0qg5n0', '::1', 1594203389, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343230333039333b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('m0tph7lt1oo6nmattrfkcrrnu00p3jm7', '::1', 1594203438, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343230333339353b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d6572726f727c733a37393a223c703e5468652066696c6520796f752061726520617474656d7074696e6720746f2075706c6f6164206973206c6172676572207468616e20746865207065726d69747465642073697a652e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('s2iuu1djdti8uaub7g4c7gctmtgrdtc5', '::1', 1594204314, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343230343031383b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('vbe4clgegfr4ta3j11eft780dcjhimgt', '::1', 1594204573, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343230343338383b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d),
('c31j4tk0dskc7g45ka9eorvanjbi83lr', '::1', 1594204885, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343230343835303b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d6572726f727c733a37393a223c703e5468652066696c6520796f752061726520617474656d7074696e6720746f2075706c6f6164206973206c6172676572207468616e20746865207065726d69747465642073697a652e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('u8fks4aevnr9hbnfjgjikau9djut7i1d', '::1', 1594205165, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343230353136353b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d),
('reg8sngcvsgim224n2qkqf57bgmpd0oo', '::1', 1594272709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343237323435343b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d737563636573737c733a373a2253756363657373223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('iqej4dn4prak2khmgc5r41vnkk9fjdok', '::1', 1594273094, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343237323739393b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d),
('5gjhpcsfjc84musdtvi6b2c89ul8jooa', '::1', 1594273240, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343237333133303b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('83jtqjcg015sic71e6c21f5sf8art6tv', '::1', 1594273759, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343237333438313b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d),
('h7kms2f17gmbsg2gj5vro4sgj580mar5', '::1', 1594273977, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343237333835333b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('u5e0o47qg69i2m311jr1ob8vbnjo5bq3', '::1', 1594274676, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343237343337383b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d737563636573737c733a373a2253756363657373223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('qn51r79mhdt2pso98m6gdrv0g98a6pkn', '::1', 1594274699, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343237343639383b),
('jjhbr25ku8gd0p905our11763t9f9940', '::1', 1594298661, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343239383636303b),
('3iequ878c2ljv40sdl94seoehrq4bm1d', '::1', 1594375738, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343337353732343b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('3458fo868l30tjh8tb0thmr42ajnmd5d', '::1', 1594376343, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343337363037393b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d),
('caedhhhvr5chmf3r4kti7ji2qrr72tae', '::1', 1594376667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343337363437393b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('smksfmbk8tlo5tn4971jcf4adpqj9jeu', '::1', 1594377029, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343337363831323b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d6572726f727c733a37393a223c703e5468652066696c6520796f752061726520617474656d7074696e6720746f2075706c6f6164206973206c6172676572207468616e20746865207065726d69747465642073697a652e3c2f703e223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('7tf7ed2j1ner58ie2vhbake9vpdrca5j', '::1', 1594377218, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343337373133373b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d);
INSERT INTO `school_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1oouv661mn9vde1090pnfpallodkfp4c', '::1', 1594379802, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539343337393532353b6c616e677c733a373a22656e676c697368223b6c6f67696e7573657249447c733a313a2231223b6e616d657c733a353a2241646d696e223b656d61696c7c733a32333a226a616764616d61747970696e6740676d61696c2e636f6d223b757365727479706549447c733a313a2231223b75736572747970657c733a353a2241646d696e223b757365726e616d657c733a353a22676f736869223b70686f746f7c733a3133323a2234313065666632366364353762656165383463613239383834383965663634646636613237613666626463396662663061313366663262336135386130646438346462373934363935393437626661396230306664383838363933623832376265393830323964316264613131623062333232303138663935653663353238372e6a7067223b64656661756c747363686f6f6c7965617249447c733a313a2231223b76617269667976616c6964757365727c623a313b6c6f67676564696e7c623a313b6765745f7065726d697373696f6e7c623a313b6d61737465725f7065726d697373696f6e5f7365747c613a3337303a7b733a393a2264617368626f617264223b733a333a22796573223b733a373a2273747564656e74223b733a333a22796573223b733a31313a2273747564656e745f616464223b733a333a22796573223b733a31323a2273747564656e745f65646974223b733a333a22796573223b733a31343a2273747564656e745f64656c657465223b733a333a22796573223b733a31323a2273747564656e745f76696577223b733a333a22796573223b733a373a22706172656e7473223b733a333a22796573223b733a31313a22706172656e74735f616464223b733a333a22796573223b733a31323a22706172656e74735f65646974223b733a333a22796573223b733a31343a22706172656e74735f64656c657465223b733a333a22796573223b733a31323a22706172656e74735f76696577223b733a333a22796573223b733a373a2274656163686572223b733a333a22796573223b733a31313a22746561636865725f616464223b733a333a22796573223b733a31323a22746561636865725f65646974223b733a333a22796573223b733a31343a22746561636865725f64656c657465223b733a333a22796573223b733a31323a22746561636865725f76696577223b733a333a22796573223b733a343a2275736572223b733a333a22796573223b733a383a22757365725f616464223b733a333a22796573223b733a393a22757365725f65646974223b733a333a22796573223b733a31313a22757365725f64656c657465223b733a333a22796573223b733a393a22757365725f76696577223b733a333a22796573223b733a373a22636c6173736573223b733a333a22796573223b733a31313a22636c61737365735f616464223b733a333a22796573223b733a31323a22636c61737365735f65646974223b733a333a22796573223b733a31343a22636c61737365735f64656c657465223b733a333a22796573223b733a373a2273656374696f6e223b733a333a22796573223b733a31313a2273656374696f6e5f616464223b733a333a22796573223b733a31323a2273656374696f6e5f65646974223b733a333a22796573223b733a31353a2273656d65737465725f64656c657465223b733a333a22796573223b733a31343a2273656374696f6e5f64656c657465223b733a333a22796573223b733a373a227375626a656374223b733a333a22796573223b733a31313a227375626a6563745f616464223b733a333a22796573223b733a31323a227375626a6563745f65646974223b733a333a22796573223b733a31343a227375626a6563745f64656c657465223b733a333a22796573223b733a383a2273796c6c61627573223b733a333a22796573223b733a31323a2273796c6c616275735f616464223b733a333a22796573223b733a31333a2273796c6c616275735f65646974223b733a333a22796573223b733a31353a2273796c6c616275735f64656c657465223b733a333a22796573223b733a31303a2261737369676e6d656e74223b733a333a22796573223b733a31343a2261737369676e6d656e745f616464223b733a333a22796573223b733a31353a2261737369676e6d656e745f65646974223b733a333a22796573223b733a31373a2261737369676e6d656e745f64656c657465223b733a333a22796573223b733a31353a2261737369676e6d656e745f76696577223b733a333a22796573223b733a373a22726f7574696e65223b733a333a22796573223b733a31313a22726f7574696e655f616464223b733a333a22796573223b733a31323a22726f7574696e655f65646974223b733a333a22796573223b733a31343a22726f7574696e655f64656c657465223b733a333a22796573223b733a31313a2273617474656e64616e6365223b733a333a22796573223b733a31353a2273617474656e64616e63655f616464223b733a333a22796573223b733a31363a2273617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2274617474656e64616e6365223b733a333a22796573223b733a31353a2274617474656e64616e63655f616464223b733a333a22796573223b733a31363a2274617474656e64616e63655f76696577223b733a333a22796573223b733a31313a2275617474656e64616e6365223b733a333a22796573223b733a31353a2275617474656e64616e63655f616464223b733a333a22796573223b733a31363a2275617474656e64616e63655f76696577223b733a333a22796573223b733a343a226578616d223b733a333a22796573223b733a383a226578616d5f616464223b733a333a22796573223b733a393a226578616d5f65646974223b733a333a22796573223b733a31313a226578616d5f64656c657465223b733a333a22796573223b733a31323a226578616d7363686564756c65223b733a333a22796573223b733a31363a226578616d7363686564756c655f616464223b733a333a22796573223b733a31373a226578616d7363686564756c655f65646974223b733a333a22796573223b733a31393a226578616d7363686564756c655f64656c657465223b733a333a22796573223b733a353a226772616465223b733a333a22796573223b733a393a2267726164655f616464223b733a333a22796573223b733a31303a2267726164655f65646974223b733a333a22796573223b733a31323a2267726164655f64656c657465223b733a333a22796573223b733a31313a2265617474656e64616e6365223b733a333a22796573223b733a31353a2265617474656e64616e63655f616464223b733a333a22796573223b733a343a226d61726b223b733a333a22796573223b733a383a226d61726b5f616464223b733a333a22796573223b733a393a226d61726b5f76696577223b733a333a22796573223b733a31343a226d61726b70657263656e74616765223b733a333a22796573223b733a31383a226d61726b70657263656e746167655f616464223b733a333a22796573223b733a31393a226d61726b70657263656e746167655f65646974223b733a333a22796573223b733a32313a226d61726b70657263656e746167655f64656c657465223b733a333a22796573223b733a393a2270726f6d6f74696f6e223b733a333a22796573223b733a31323a22636f6e766572736174696f6e223b733a333a22796573223b733a353a226d65646961223b733a333a22796573223b733a393a226d656469615f616464223b733a333a22796573223b733a31323a226d656469615f64656c657465223b733a333a22796573223b733a31303a226d61696c616e64736d73223b733a333a22796573223b733a31343a226d61696c616e64736d735f616464223b733a333a22796573223b733a31353a226d61696c616e64736d735f76696577223b733a333a22796573223b733a31343a227175657374696f6e5f67726f7570223b733a333a22796573223b733a31383a227175657374696f6e5f67726f75705f616464223b733a333a22796573223b733a31393a227175657374696f6e5f67726f75705f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f67726f75705f64656c657465223b733a333a22796573223b733a31343a227175657374696f6e5f6c6576656c223b733a333a22796573223b733a31383a227175657374696f6e5f6c6576656c5f616464223b733a333a22796573223b733a31393a227175657374696f6e5f6c6576656c5f65646974223b733a333a22796573223b733a32313a227175657374696f6e5f6c6576656c5f64656c657465223b733a333a22796573223b733a31333a227175657374696f6e5f62616e6b223b733a333a22796573223b733a31373a227175657374696f6e5f62616e6b5f616464223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f65646974223b733a333a22796573223b733a32303a227175657374696f6e5f62616e6b5f64656c657465223b733a333a22796573223b733a31383a227175657374696f6e5f62616e6b5f76696577223b733a333a22796573223b733a31313a226f6e6c696e655f6578616d223b733a333a22796573223b733a31353a226f6e6c696e655f6578616d5f616464223b733a333a22796573223b733a31363a226f6e6c696e655f6578616d5f65646974223b733a333a22796573223b733a31383a226f6e6c696e655f6578616d5f64656c657465223b733a333a22796573223b733a31313a22696e737472756374696f6e223b733a333a22796573223b733a31353a22696e737472756374696f6e5f616464223b733a333a22796573223b733a31363a22696e737472756374696f6e5f65646974223b733a333a22796573223b733a31383a22696e737472756374696f6e5f64656c657465223b733a333a22796573223b733a31363a22696e737472756374696f6e5f76696577223b733a333a22796573223b733a31353a2273616c6172795f74656d706c617465223b733a333a22796573223b733a31393a2273616c6172795f74656d706c6174655f616464223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a2273616c6172795f74656d706c6174655f64656c657465223b733a333a22796573223b733a32303a2273616c6172795f74656d706c6174655f76696577223b733a333a22796573223b733a31353a22686f75726c795f74656d706c617465223b733a333a22796573223b733a31393a22686f75726c795f74656d706c6174655f616464223b733a333a22796573223b733a32303a22686f75726c795f74656d706c6174655f65646974223b733a333a22796573223b733a32323a22686f75726c795f74656d706c6174655f64656c657465223b733a333a22796573223b733a31333a226d616e6167655f73616c617279223b733a333a22796573223b733a31373a226d616e6167655f73616c6172795f616464223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f65646974223b733a333a22796573223b733a32303a226d616e6167655f73616c6172795f64656c657465223b733a333a22796573223b733a31383a226d616e6167655f73616c6172795f76696577223b733a333a22796573223b733a31323a226d616b655f7061796d656e74223b733a333a22796573223b733a363a2276656e646f72223b733a333a22796573223b733a31303a2276656e646f725f616464223b733a333a22796573223b733a31313a2276656e646f725f65646974223b733a333a22796573223b733a31333a2276656e646f725f64656c657465223b733a333a22796573223b733a383a226c6f636174696f6e223b733a333a22796573223b733a31323a226c6f636174696f6e5f616464223b733a333a22796573223b733a31333a226c6f636174696f6e5f65646974223b733a333a22796573223b733a31353a226c6f636174696f6e5f64656c657465223b733a333a22796573223b733a31343a2261737365745f63617465676f7279223b733a333a22796573223b733a31383a2261737365745f63617465676f72795f616464223b733a333a22796573223b733a31393a2261737365745f63617465676f72795f65646974223b733a333a22796573223b733a32313a2261737365745f63617465676f72795f64656c657465223b733a333a22796573223b733a353a226173736574223b733a333a22796573223b733a393a2261737365745f616464223b733a333a22796573223b733a31303a2261737365745f65646974223b733a333a22796573223b733a31323a2261737365745f64656c657465223b733a333a22796573223b733a31303a2261737365745f76696577223b733a333a22796573223b733a31363a2261737365745f61737369676e6d656e74223b733a333a22796573223b733a32303a2261737365745f61737369676e6d656e745f616464223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f65646974223b733a333a22796573223b733a32333a2261737365745f61737369676e6d656e745f64656c657465223b733a333a22796573223b733a32313a2261737365745f61737369676e6d656e745f76696577223b733a333a22796573223b733a383a227075726368617365223b733a333a22796573223b733a31323a2270757263686173655f616464223b733a333a22796573223b733a31333a2270757263686173655f65646974223b733a333a22796573223b733a31353a2270757263686173655f64656c657465223b733a333a22796573223b733a31353a2270726f6475637463617465676f7279223b733a333a22796573223b733a31393a2270726f6475637463617465676f72795f616464223b733a333a22796573223b733a32303a2270726f6475637463617465676f72795f65646974223b733a333a22796573223b733a32323a2270726f6475637463617465676f72795f64656c657465223b733a333a22796573223b733a373a2270726f64756374223b733a333a22796573223b733a31313a2270726f647563745f616464223b733a333a22796573223b733a31323a2270726f647563745f65646974223b733a333a22796573223b733a31343a2270726f647563745f64656c657465223b733a333a22796573223b733a31363a2270726f6475637477617265686f757365223b733a333a22796573223b733a32303a2270726f6475637477617265686f7573655f616464223b733a333a22796573223b733a32313a2270726f6475637477617265686f7573655f65646974223b733a333a22796573223b733a32333a2270726f6475637477617265686f7573655f64656c657465223b733a333a22796573223b733a31353a2270726f64756374737570706c696572223b733a333a22796573223b733a31393a2270726f64756374737570706c6965725f616464223b733a333a22796573223b733a32303a2270726f64756374737570706c6965725f65646974223b733a333a22796573223b733a32323a2270726f64756374737570706c6965725f64656c657465223b733a333a22796573223b733a31353a2270726f647563747075726368617365223b733a333a22796573223b733a31393a2270726f6475637470757263686173655f616464223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f65646974223b733a333a22796573223b733a32323a2270726f6475637470757263686173655f64656c657465223b733a333a22796573223b733a32303a2270726f6475637470757263686173655f76696577223b733a333a22796573223b733a31313a2270726f6475637473616c65223b733a333a22796573223b733a31353a2270726f6475637473616c655f616464223b733a333a22796573223b733a31363a2270726f6475637473616c655f65646974223b733a333a22796573223b733a31383a2270726f6475637473616c655f64656c657465223b733a333a22796573223b733a31363a2270726f6475637473616c655f76696577223b733a333a22796573223b733a31333a226c6561766563617465676f7279223b733a333a22796573223b733a31373a226c6561766563617465676f72795f616464223b733a333a22796573223b733a31383a226c6561766563617465676f72795f65646974223b733a333a22796573223b733a32303a226c6561766563617465676f72795f64656c657465223b733a333a22796573223b733a31313a226c6561766561737369676e223b733a333a22796573223b733a31353a226c6561766561737369676e5f616464223b733a333a22796573223b733a31363a226c6561766561737369676e5f65646974223b733a333a22796573223b733a31383a226c6561766561737369676e5f64656c657465223b733a333a22796573223b733a31303a226c656176656170706c79223b733a333a22796573223b733a31343a226c656176656170706c795f616464223b733a333a22796573223b733a31353a226c656176656170706c795f65646974223b733a333a22796573223b733a31373a226c656176656170706c795f64656c657465223b733a333a22796573223b733a31353a226c656176656170706c795f76696577223b733a333a22796573223b733a31363a226c656176656170706c69636174696f6e223b733a333a22796573223b733a31383a226163746976697469657363617465676f7279223b733a333a22796573223b733a32323a226163746976697469657363617465676f72795f616464223b733a333a22796573223b733a32333a226163746976697469657363617465676f72795f65646974223b733a333a22796573223b733a32353a226163746976697469657363617465676f72795f64656c657465223b733a333a22796573223b733a31303a2261637469766974696573223b733a333a22796573223b733a31343a22616374697669746965735f616464223b733a333a22796573223b733a31373a22616374697669746965735f64656c657465223b733a333a22796573223b733a393a226368696c6463617265223b733a333a22796573223b733a31333a226368696c64636172655f616464223b733a333a22796573223b733a31343a226368696c64636172655f65646974223b733a333a22796573223b733a31363a226368696c64636172655f64656c657465223b733a333a22796573223b733a373a226c6d656d626572223b733a333a22796573223b733a31313a226c6d656d6265725f616464223b733a333a22796573223b733a31323a226c6d656d6265725f65646974223b733a333a22796573223b733a31343a226c6d656d6265725f64656c657465223b733a333a22796573223b733a31323a226c6d656d6265725f76696577223b733a333a22796573223b733a343a22626f6f6b223b733a333a22796573223b733a383a22626f6f6b5f616464223b733a333a22796573223b733a393a22626f6f6b5f65646974223b733a333a22796573223b733a31313a22626f6f6b5f64656c657465223b733a333a22796573223b733a353a226973737565223b733a333a22796573223b733a393a2269737375655f616464223b733a333a22796573223b733a31303a2269737375655f65646974223b733a333a22796573223b733a31303a2269737375655f76696577223b733a333a22796573223b733a363a2265626f6f6b73223b733a333a22796573223b733a31303a2265626f6f6b735f616464223b733a333a22796573223b733a31313a2265626f6f6b735f65646974223b733a333a22796573223b733a31333a2265626f6f6b735f64656c657465223b733a333a22796573223b733a31313a2265626f6f6b735f76696577223b733a333a22796573223b733a393a227472616e73706f7274223b733a333a22796573223b733a31333a227472616e73706f72745f616464223b733a333a22796573223b733a31343a227472616e73706f72745f65646974223b733a333a22796573223b733a31363a227472616e73706f72745f64656c657465223b733a333a22796573223b733a373a22746d656d626572223b733a333a22796573223b733a31313a22746d656d6265725f616464223b733a333a22796573223b733a31323a22746d656d6265725f65646974223b733a333a22796573223b733a31343a22746d656d6265725f64656c657465223b733a333a22796573223b733a31323a22746d656d6265725f76696577223b733a333a22796573223b733a363a22686f7374656c223b733a333a22796573223b733a31303a22686f7374656c5f616464223b733a333a22796573223b733a31313a22686f7374656c5f65646974223b733a333a22796573223b733a31333a22686f7374656c5f64656c657465223b733a333a22796573223b733a383a2263617465676f7279223b733a333a22796573223b733a31323a2263617465676f72795f616464223b733a333a22796573223b733a31333a2263617465676f72795f65646974223b733a333a22796573223b733a31353a2263617465676f72795f64656c657465223b733a333a22796573223b733a373a22686d656d626572223b733a333a22796573223b733a31313a22686d656d6265725f616464223b733a333a22796573223b733a31323a22686d656d6265725f65646974223b733a333a22796573223b733a31343a22686d656d6265725f64656c657465223b733a333a22796573223b733a31323a22686d656d6265725f76696577223b733a333a22796573223b733a383a226665657479706573223b733a333a22796573223b733a31323a2266656574797065735f616464223b733a333a22796573223b733a31333a2266656574797065735f65646974223b733a333a22796573223b733a31353a2266656574797065735f64656c657465223b733a333a22796573223b733a373a22696e766f696365223b733a333a22796573223b733a31313a22696e766f6963655f616464223b733a333a22796573223b733a31323a22696e766f6963655f65646974223b733a333a22796573223b733a31343a22696e766f6963655f64656c657465223b733a333a22796573223b733a31323a22696e766f6963655f76696577223b733a333a22796573223b733a31343a227061796d656e74686973746f7279223b733a333a22796573223b733a31393a227061796d656e74686973746f72795f65646974223b733a333a22796573223b733a32313a227061796d656e74686973746f72795f64656c657465223b733a333a22796573223b733a373a22657870656e7365223b733a333a22796573223b733a31313a22657870656e73655f616464223b733a333a22796573223b733a31323a22657870656e73655f65646974223b733a333a22796573223b733a31343a22657870656e73655f64656c657465223b733a333a22796573223b733a363a22696e636f6d65223b733a333a22796573223b733a31303a22696e636f6d655f616464223b733a333a22796573223b733a31313a22696e636f6d655f65646974223b733a333a22796573223b733a31333a22696e636f6d655f64656c657465223b733a333a22796573223b733a31343a22676c6f62616c5f7061796d656e74223b733a333a22796573223b733a363a226e6f74696365223b733a333a22796573223b733a31303a226e6f746963655f616464223b733a333a22796573223b733a31313a226e6f746963655f65646974223b733a333a22796573223b733a31333a226e6f746963655f64656c657465223b733a333a22796573223b733a31313a226e6f746963655f76696577223b733a333a22796573223b733a353a226576656e74223b733a333a22796573223b733a393a226576656e745f616464223b733a333a22796573223b733a31303a226576656e745f65646974223b733a333a22796573223b733a31323a226576656e745f64656c657465223b733a333a22796573223b733a31303a226576656e745f76696577223b733a333a22796573223b733a373a22686f6c69646179223b733a333a22796573223b733a31313a22686f6c696461795f616464223b733a333a22796573223b733a31323a22686f6c696461795f65646974223b733a333a22796573223b733a31343a22686f6c696461795f64656c657465223b733a333a22796573223b733a31323a22686f6c696461795f76696577223b733a333a22796573223b733a31333a22636c61737365737265706f7274223b733a333a22796573223b733a31333a2273747564656e747265706f7274223b733a333a22796573223b733a31323a226964636172647265706f7274223b733a333a22796573223b733a31353a2261646d6974636172647265706f7274223b733a333a22796573223b733a31333a22726f7574696e657265706f7274223b733a333a22796573223b733a31383a226578616d7363686564756c657265706f7274223b733a333a22796573223b733a31363a22617474656e64616e63657265706f7274223b733a333a22796573223b733a32343a22617474656e64616e63656f766572766965777265706f7274223b733a333a22796573223b733a31383a226c696272617279626f6f6b737265706f7274223b733a333a22796573223b733a31373a226c696272617279636172647265706f7274223b733a333a22796573223b733a32323a226c696272617279626f6f6b69737375657265706f7274223b733a333a22796573223b733a31343a227465726d696e616c7265706f7274223b733a333a22796573223b733a31363a226d6572697473746167657265706f7274223b733a333a22796573223b733a32313a22746162756c6174696f6e73686565747265706f7274223b733a333a22796573223b733a31353a226d61726b73686565747265706f7274223b733a333a22796573223b733a31383a2270726f6772657373636172647265706f7274223b733a333a22796573223b733a31363a226f6e6c696e656578616d7265706f7274223b733a333a22796573223b733a32343a226f6e6c696e656578616d7175657374696f6e7265706f7274223b733a333a22796573223b733a32313a226f6e6c696e6561646d697373696f6e7265706f7274223b733a333a22796573223b733a31373a2263657274696669636174657265706f7274223b733a333a22796573223b733a32323a226c656176656170706c69636174696f6e7265706f7274223b733a333a22796573223b733a32313a2270726f6475637470757263686173657265706f7274223b733a333a22796573223b733a31373a2270726f6475637473616c657265706f7274223b733a333a22796573223b733a32333a227365617263687061796d656e74666565737265706f7274223b733a333a22796573223b733a31303a22666565737265706f7274223b733a333a22796573223b733a31333a22647565666565737265706f7274223b733a333a22796573223b733a31373a2262616c616e6365666565737265706f7274223b733a333a22796573223b733a31373a227472616e73616374696f6e7265706f7274223b733a333a22796573223b733a31373a2273747564656e7466696e657265706f7274223b733a333a22796573223b733a31323a2273616c6172797265706f7274223b733a333a22796573223b733a31393a226163636f756e746c65646765727265706f7274223b733a333a22796573223b733a31353a226f6e6c696e6561646d697373696f6e223b733a333a22796573223b733a31313a2276697369746f72696e666f223b733a333a22796573223b733a31383a2276697369746f72696e666f5f64656c657465223b733a333a22796573223b733a31363a2276697369746f72696e666f5f76696577223b733a333a22796573223b733a31303a227363686f6f6c79656172223b733a333a22796573223b733a31343a227363686f6f6c796561725f616464223b733a333a22796573223b733a31353a227363686f6f6c796561725f65646974223b733a333a22796573223b733a31373a227363686f6f6c796561725f64656c657465223b733a333a22796573223b733a31323a2273747564656e7467726f7570223b733a333a22796573223b733a31363a2273747564656e7467726f75705f616464223b733a333a22796573223b733a31373a2273747564656e7467726f75705f65646974223b733a333a22796573223b733a31393a2273747564656e7467726f75705f64656c657465223b733a333a22796573223b733a383a22636f6d706c61696e223b733a333a22796573223b733a31323a22636f6d706c61696e5f616464223b733a333a22796573223b733a31333a22636f6d706c61696e5f65646974223b733a333a22796573223b733a31353a22636f6d706c61696e5f64656c657465223b733a333a22796573223b733a31333a22636f6d706c61696e5f76696577223b733a333a22796573223b733a32303a2263657274696669636174655f74656d706c617465223b733a333a22796573223b733a32343a2263657274696669636174655f74656d706c6174655f616464223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f65646974223b733a333a22796573223b733a32373a2263657274696669636174655f74656d706c6174655f64656c657465223b733a333a22796573223b733a32353a2263657274696669636174655f74656d706c6174655f76696577223b733a333a22796573223b733a31313a2273797374656d61646d696e223b733a333a22796573223b733a31353a2273797374656d61646d696e5f616464223b733a333a22796573223b733a31363a2273797374656d61646d696e5f65646974223b733a333a22796573223b733a31383a2273797374656d61646d696e5f64656c657465223b733a333a22796573223b733a31363a2273797374656d61646d696e5f76696577223b733a333a22796573223b733a31333a22726573657470617373776f7264223b733a333a22796573223b733a31303a22736f6369616c6c696e6b223b733a333a22796573223b733a31343a22736f6369616c6c696e6b5f616464223b733a333a22796573223b733a31353a22736f6369616c6c696e6b5f65646974223b733a333a22796573223b733a31373a22736f6369616c6c696e6b5f64656c657465223b733a333a22796573223b733a31383a226d61696c616e64736d7374656d706c617465223b733a333a22796573223b733a32323a226d61696c616e64736d7374656d706c6174655f616464223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f65646974223b733a333a22796573223b733a32353a226d61696c616e64736d7374656d706c6174655f64656c657465223b733a333a22796573223b733a32333a226d61696c616e64736d7374656d706c6174655f76696577223b733a333a22796573223b733a31303a2262756c6b696d706f7274223b733a333a22796573223b733a363a226261636b7570223b733a333a22796573223b733a383a227573657274797065223b733a333a22796573223b733a31323a2275736572747970655f616464223b733a333a22796573223b733a31333a2275736572747970655f65646974223b733a333a22796573223b733a31353a2275736572747970655f64656c657465223b733a333a22796573223b733a31303a227065726d697373696f6e223b733a333a22796573223b733a363a22757064617465223b733a333a22796573223b733a31363a22706f7374735f63617465676f72696573223b733a333a22796573223b733a32303a22706f7374735f63617465676f726965735f616464223b733a333a22796573223b733a32313a22706f7374735f63617465676f726965735f65646974223b733a333a22796573223b733a32333a22706f7374735f63617465676f726965735f64656c657465223b733a333a22796573223b733a353a22706f737473223b733a333a22796573223b733a393a22706f7374735f616464223b733a333a22796573223b733a31303a22706f7374735f65646974223b733a333a22796573223b733a31323a22706f7374735f64656c657465223b733a333a22796573223b733a353a227061676573223b733a333a22796573223b733a393a2270616765735f616464223b733a333a22796573223b733a31303a2270616765735f65646974223b733a333a22796573223b733a31323a2270616765735f64656c657465223b733a333a22796573223b733a31323a2266726f6e74656e646d656e75223b733a333a22796573223b733a373a2273657474696e67223b733a333a22796573223b733a31363a2266726f6e74656e645f73657474696e67223b733a333a22796573223b733a31353a227061796d656e7473657474696e6773223b733a333a22796573223b733a31313a22736d7373657474696e6773223b733a333a22796573223b733a31323a22656d61696c73657474696e67223b733a333a22796573223b733a393a2274616b655f6578616d223b733a333a22796573223b7d),
('6mfhe09tnn04jsq27mn9j2kkfgvofjvl', '::1', 1595397539, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539353339373533383b);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sectionID` int(11) UNSIGNED NOT NULL,
  `section` varchar(60) NOT NULL,
  `category` varchar(128) NOT NULL,
  `capacity` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `note` text,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionID`, `section`, `category`, `capacity`, `classesID`, `teacherID`, `note`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(8, 'A', 'A', 500, 1, 1, '', '2019-08-02 12:27:01', '2019-08-02 12:27:01', 1, 'ctech', 'Admin'),
(9, 'A', 'A', 500, 2, 1, '', '2019-08-02 09:28:07', '2019-08-02 09:28:07', 1, 'ctech', 'Admin'),
(10, 'A', 'A', 500, 3, 1, '', '2019-08-02 09:42:38', '2019-08-02 09:42:38', 1, 'ctech', 'Admin'),
(11, 'A', 'A', 500, 4, 1, '', '2019-08-03 12:12:25', '2019-08-03 12:12:25', 1, 'ctech', 'Admin'),
(12, 'A', 'A', 500, 5, 1, '', '2019-08-03 12:16:32', '2019-08-03 12:16:32', 1, 'ctech', 'Admin'),
(13, 'A', 'A', 500, 6, 27, '', '2019-08-03 12:21:13', '2019-08-29 02:32:16', 1, 'ctech', 'Admin'),
(14, 'A', 'A', 500, 7, 1, '', '2019-08-03 12:21:41', '2019-08-03 12:21:41', 1, 'ctech', 'Admin'),
(15, 'A', 'A', 400, 8, 1, '', '2019-08-03 12:22:13', '2019-08-03 12:22:13', 1, 'ctech', 'Admin'),
(16, 'A', 'A', 500, 12, 1, '', '2019-08-03 12:35:17', '2019-08-03 12:35:17', 1, 'ctech', 'Admin'),
(17, 'B', 'B', 500, 12, 1, '', '2019-08-03 12:35:43', '2019-08-03 12:35:43', 1, 'ctech', 'Admin'),
(18, 'A', 'A', 600, 9, 1, '', '2019-08-03 12:47:32', '2019-08-03 12:47:32', 1, 'ctech', 'Admin'),
(19, 'A', 'A', 500, 13, 21, '', '2019-08-05 08:54:50', '2019-08-05 08:54:50', 1, 'ctech', 'Admin'),
(20, 'A', 'A', 500, 10, 1, '', '2019-08-05 08:55:51', '2019-08-05 08:55:51', 1, 'ctech', 'Admin'),
(21, 'B', 'B', 500, 10, 1, '', '2019-08-05 08:56:17', '2019-08-05 08:56:17', 1, 'ctech', 'Admin'),
(22, 'A', 'A', 500, 11, 1, '', '2019-08-05 08:56:41', '2019-08-05 08:56:41', 1, 'ctech', 'Admin'),
(23, 'A', 'A', 500, 15, 18, '', '2019-08-05 09:59:18', '2019-08-05 09:59:18', 1, 'ctech', 'Admin'),
(24, 'A', 'A', 500, 14, 20, '', '2019-08-05 10:08:24', '2019-08-05 10:08:24', 1, 'ctech', 'Admin'),
(25, 'Orange', 'A', 50, 19, 31, '', '2020-01-23 09:16:30', '2020-01-23 09:16:30', 1, 'ctech', 'Admin'),
(26, 'B', 'b', 20, 1, 34, '', '2020-03-07 09:50:59', '2020-03-07 09:50:59', 1, 'ctech', 'Admin'),
(27, 'Yellow', 'yellow', 25, 12, 36, '', '2020-03-11 10:29:16', '2020-03-11 10:29:16', 1, 'ctech', 'Admin'),
(28, 'blue', 'blue', 45, 12, 37, '', '2020-04-13 04:44:49', '2020-04-13 04:44:49', 1, 'ctech', 'Admin'),
(29, 'section Ghanna', 'five', 56, 20, 37, '', '2020-04-13 04:49:21', '2020-04-13 04:49:21', 1, 'ctech', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `fieldoption` varchar(100) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`fieldoption`, `value`) VALUES
('absent_auto_sms', '1'),
('address', 'Punjab Pakistan'),
('attendance', 'day'),
('attendance_notification', 'none'),
('attendance_notification_template', '0'),
('attendance_smsgateway', '0'),
('automation', '5'),
('auto_invoice_generate', '0'),
('auto_update_notification', '1'),
('backend_theme', 'red'),
('captcha_status', '1'),
('currency_code', 'Rs'),
('currency_symbol', 'Rs.'),
('email', 'goshi.bh@gmail.com'),
('ex_class', '8'),
('footer', 'Copyright &copy; Ayyan Software | 2020'),
('frontendorbackend', 'YES'),
('frontend_theme', 'default'),
('google_analytics', ''),
('language', 'english'),
('language_status', '0'),
('mark_1', '1'),
('mark_2', '1'),
('mark_3', '1'),
('mark_4', '1'),
('mark_5', '1'),
('note', '1'),
('phone', '12345678'),
('photo', ''),
('profile_edit', '1'),
('purchase_code', 'e427758a-e3c9-41ca-b31c-ff68ad3309e4'),
('purchase_username', 'jawadkhan511'),
('recaptcha_secret_key', 'tanzee123'),
('recaptcha_site_key', 'tanzeel123'),
('school_type', 'classbase'),
('school_year', '1'),
('sname', 'School Management'),
('student_ID_format', '1'),
('s_registration_no_auto', '57'),
('time_zone', 'Europe/Moscow'),
('updateversion', '4.2'),
('weekends', '0');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `sliderID` int(11) NOT NULL,
  `pagesID` int(11) NOT NULL,
  `slider` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`sliderID`, `pagesID`, `slider`) VALUES
(1, 5, 10),
(14, 9, 6),
(15, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `smssettings`
--

CREATE TABLE `smssettings` (
  `smssettingsID` int(11) UNSIGNED NOT NULL,
  `types` varchar(255) DEFAULT NULL,
  `field_names` varchar(255) DEFAULT NULL,
  `field_values` varchar(255) DEFAULT NULL,
  `smssettings_extra` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smssettings`
--

INSERT INTO `smssettings` (`smssettingsID`, `types`, `field_names`, `field_values`, `smssettings_extra`) VALUES
(1, 'clickatell', 'clickatell_username', '', NULL),
(2, 'clickatell', 'clickatell_password', '', NULL),
(3, 'clickatell', 'clickatell_api_key', '', NULL),
(4, 'twilio', 'twilio_accountSID', '', NULL),
(5, 'twilio', 'twilio_authtoken', '', NULL),
(6, 'twilio', 'twilio_fromnumber', '', NULL),
(7, 'bulk', 'bulk_username', '', NULL),
(8, 'bulk', 'bulk_password', '', NULL),
(9, 'msg91', 'msg91_authKey', '', NULL),
(10, 'msg91', 'msg91_senderID', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sociallink`
--

CREATE TABLE `sociallink` (
  `sociallinkID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `linkedin` varchar(200) NOT NULL,
  `googleplus` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `dob` date DEFAULT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `roll` varchar(50) DEFAULT NULL,
  `bloodgroup` varchar(5) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `registerNO` int(11) DEFAULT NULL,
  `state` varchar(128) DEFAULT NULL,
  `library` int(11) NOT NULL,
  `hostel` int(11) NOT NULL,
  `transport` int(11) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `parentID` int(11) DEFAULT NULL,
  `createschoolyearID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `admission_status` text,
  `education_detail` text,
  `admission_fee` varchar(10) DEFAULT NULL,
  `registration_fee` varchar(10) DEFAULT NULL,
  `admission_result` varchar(20) DEFAULT NULL,
  `emergency_contact_relation` varchar(150) DEFAULT NULL,
  `emergency_contact_no` varchar(150) DEFAULT NULL,
  `student_pob` varchar(150) DEFAULT NULL,
  `monthly_tuttion_fee` varchar(10) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL,
  `active` int(11) NOT NULL,
  `ethnicity` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `name`, `dob`, `sex`, `religion`, `email`, `phone`, `address`, `classesID`, `sectionID`, `roll`, `bloodgroup`, `country`, `registerNO`, `state`, `library`, `hostel`, `transport`, `photo`, `parentID`, `createschoolyearID`, `schoolyearID`, `admission_status`, `education_detail`, `admission_fee`, `registration_fee`, `admission_result`, `emergency_contact_relation`, `emergency_contact_no`, `student_pob`, `monthly_tuttion_fee`, `username`, `password`, `usertypeID`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `active`, `ethnicity`) VALUES
(1, 'Muhammad Ayyan', '2014-01-28', 'Male', 'Islam', '', '03007476412', '', 19, 25, '1', '0', '0', 1, 'Punjab', 0, 0, 0, 'default.png', 12, 1, 1, 'TRUE', '[]', '', '', 'pass', '03007476412', '03007476412', 'Gujranwala', '2000', 'ayyan', '0f752261c42b3f940cb590c6d94559f5b128988ef58081a6e9611e20b05495c5b39ba6a79b1d5a253433e31140d318ed1d606f2caea052be80bbd263e93c69af', 3, '2020-01-28 09:41:14', '2020-01-28 09:41:14', 1, 'ctech', 'Admin', 1, NULL),
(2, 'Fatima iqbal', '2015-01-28', 'Male', 'Islam', '', '', '', 19, 25, '2', '0', '0', 2, '', 0, 0, 0, 'default.png', 12, 1, 1, 'TRUE', '[]', '', '', 'pass', 'father', '03007476412', 'qila didar singh', '2000', 'fatima', '053389896013b3eb34d054f981f51842e1365843e813e4424f548a9bd686cc0d9c40812395e653b9183e483f578e8510b10c909c6f94151343ce7e130cb50748', 3, '2020-01-29 09:57:22', '2020-01-29 09:57:22', 1, 'ctech', 'Admin', 1, NULL),
(3, 'Asjad Hafeez', '2000-02-01', 'Male', 'Islam', '', '', '', 1, 8, '1', 'O+', '0', 3, '', 0, 0, 0, 'default.png', 7, 1, 2, 'TRUE', '[]', '', '', 'pass', 'Father', '03016697211', 'Gujranwala', '2000', 'ctechh', '2a43e7235a5c6d811b42ba4c0e9efbd1afc1583ce349f844f9c1e6ad8cdd007fb80fc64c7d3666954c64d97673e6edeb5a3747023181bbcaeb36066447fc6a95', 3, '2020-02-03 09:02:10', '2020-02-03 09:02:10', 1, 'ctech', 'Admin', 1, NULL),
(4, 'Qashood Hafeez', '2010-02-02', 'Male', 'islam', '', '03016697211', 'qila didar singh', 12, 16, '1', 'A+', '0', 4, 'Punjab', 0, 0, 0, 'bc41ad973b74f37ce7237b12fbe973aacfdd3f9d92b1a44b6f76d3f0c1d8f26061944b9d10c1a01759ed5d0a3a8cf74c550847d9904bbbc99479ade024230765.png', 7, 1, 2, 'TRUE', '[]', '', '', 'pass', 'Father', '03016697211', 'gujranwala', '2000', 'qashood', '527ac5f2a91e1df423ae9c2459e1615ce54e9ba15564cae5813374771f704651e425630f2a37382585c983f5751bf464b0f92831db9ba14a3ed02c806f3ab004', 3, '2020-02-12 17:30:34', '2020-02-12 17:30:34', 1, 'ctech', 'Admin', 1, NULL),
(5, 'Nashit Hafeez', '2018-10-30', 'Male', 'Islam', 'pct.tanzeel@gmail.com', '', 'Qila didar singh', 1, 8, '5', 'A+', '0', 5, 'Punjab', 0, 0, 0, 'default.png', 7, 1, 1, 'TRUE', '[]', '', '', 'pass', '03016697211', '03016697211', 'Gujranwala', '2000', 'nashit', 'e3a3d6973b01a7f00563ca8d05eef52e400a176bb2adf8adea927e2659276320ef541117cb51b405c007d4f4268c850ffada63a1f748b4900c6f3216d3155694', 3, '2020-02-27 10:03:56', '2020-02-27 10:03:56', 1, 'ctech', 'Admin', 1, NULL),
(6, 'Anas Khalid', '2018-12-31', 'Male', '', '', '', '', 12, 27, '6', 'B+', 'PK', 6, '', 0, 0, 0, 'default.png', 12, 1, 1, 'TRUE', '[]', '', '', 'pass', '', '', '', '2000', 'anas', '1115bb2c614cd3eab4c96e4d5c86c31b2d6885a760901c951b2a424d7c5807db6daec577447610080f5b29d17d90365122548fdee82546d78fba0d2039fb28ad', 3, '2020-03-11 22:32:20', '2020-03-11 22:32:20', 1, 'ctech', 'Admin', 1, NULL),
(7, 'kris', '2010-02-02', 'Male', '', 'kennb@gmail.com', '236598', '', 12, 27, '12', 'O+', 'GH', 7, '', 0, 0, 0, '51f33e8228ec68e1bbff41ed86a02b41c4e92458ad70544f6943c9396d80b4298f7f97efd877b8ed3755e3e0c1b61dbbbe60ae13ebbe98c7e0f2bc140bde360a.JPG', 11, 1, 1, 'TRUE', '[]', '1000', '', 'pass', '2314656698', '2314656698', 'Ghanna', '2000', 'kris', '93b20c40e479702890ad28a724190bc2093820416252df27728bebb407d3eae7c1714570c2095c3a34ff5f7e2693dc7526355ca8abbbd11fab3044d269b42127', 3, '2020-04-13 16:38:53', '2020-04-13 16:38:53', 1, 'ctech', 'Admin', 1, NULL),
(8, 'Kris2', '2008-12-29', 'Male', '', '', '', '', 20, 29, '13', '0', '0', 8, '', 0, 0, 0, 'default.png', 8, 1, 1, 'TRUE', '[]', '', '', 'pass', '', '', '', '', 'Kris2', '93b20c40e479702890ad28a724190bc2093820416252df27728bebb407d3eae7c1714570c2095c3a34ff5f7e2693dc7526355ca8abbbd11fab3044d269b42127', 3, '2020-04-13 16:50:53', '2020-04-13 16:50:53', 1, 'ctech', 'Admin', 1, NULL),
(9, 'goshi', '2013-06-11', 'Male', '', '', '', '', 1, 8, '45', '0', '0', 9, '', 0, 0, 0, 'default.png', 7, 1, 1, 'TRUE', '[]', '', '', 'pass', '', '', '', '', 'zoya', '0f752261c42b3f940cb590c6d94559f5b128988ef58081a6e9611e20b05495c5b39ba6a79b1d5a253433e31140d318ed1d606f2caea052be80bbd263e93c69af', 3, '2020-05-09 20:36:50', '2020-05-09 20:36:50', 1, 'ctech', 'Admin', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentextend`
--

CREATE TABLE `studentextend` (
  `studentextendID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `studentgroupID` int(11) NOT NULL,
  `optionalsubjectID` int(11) NOT NULL,
  `extracurricularactivities` text,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentextend`
--

INSERT INTO `studentextend` (`studentextendID`, `studentID`, `studentgroupID`, `optionalsubjectID`, `extracurricularactivities`, `remarks`) VALUES
(1, 1, 0, 0, '', ''),
(2, 2, 1, 0, '', ''),
(3, 3, 1, 0, '', ''),
(4, 4, 1, 0, '', ''),
(5, 5, 1, 0, '', ''),
(6, 6, 1, 0, 'no', ''),
(7, 7, 2, 0, '', ''),
(8, 8, 1, 0, '', ''),
(9, 9, 0, 111, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `studentgroup`
--

CREATE TABLE `studentgroup` (
  `studentgroupID` int(11) NOT NULL,
  `group` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentgroup`
--

INSERT INTO `studentgroup` (`studentgroupID`, `group`) VALUES
(1, 'Science'),
(2, 'Arts'),
(3, 'Commerce');

-- --------------------------------------------------------

--
-- Table structure for table `studentrelation`
--

CREATE TABLE `studentrelation` (
  `studentrelationID` int(11) NOT NULL,
  `srstudentID` int(11) DEFAULT NULL,
  `srname` varchar(40) NOT NULL,
  `srclassesID` int(11) DEFAULT NULL,
  `srclasses` varchar(40) DEFAULT NULL,
  `srroll` varchar(50) DEFAULT NULL,
  `srregisterNO` varchar(128) DEFAULT NULL,
  `srsectionID` int(11) DEFAULT NULL,
  `srsection` varchar(40) DEFAULT NULL,
  `srstudentgroupID` int(11) NOT NULL,
  `sroptionalsubjectID` int(11) NOT NULL,
  `srschoolyearID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `studentrelation`
--

INSERT INTO `studentrelation` (`studentrelationID`, `srstudentID`, `srname`, `srclassesID`, `srclasses`, `srroll`, `srregisterNO`, `srsectionID`, `srsection`, `srstudentgroupID`, `sroptionalsubjectID`, `srschoolyearID`) VALUES
(1, 1, 'Muhammad Ayyan', 19, 'Prep', '1', '1', 25, 'Orange', 0, 0, 1),
(2, 2, 'Fatima iqbal', 19, 'Prep', '2', '2', 25, 'Orange', 1, 0, 1),
(3, 3, 'Asjad Hafeez', 12, 'I', '3', '3', 16, 'A', 1, 0, 1),
(4, 4, 'Qashood Hafeez', 1, 'II', '4', '4', 8, 'A', 1, 0, 1),
(5, 3, 'Asjad Hafeez', 1, 'II', '1', '3', 8, 'A', 1, 0, 2),
(6, 4, 'Qashood Hafeez', 12, 'I', '1', '4', 16, 'A', 1, 0, 2),
(7, 5, 'Nashit Hafeez', 1, 'II', '5', '5', 8, 'A', 1, 0, 1),
(8, 6, 'Anas Khalid', 12, 'I', '6', '6', 27, 'Yellow', 1, 0, 1),
(9, 7, 'kris', 12, 'I', '12', '7', 27, 'Yellow', 2, 0, 1),
(10, 8, 'Kris2', 20, '3', '13', '8', 29, 'section Ghanna', 1, 0, 1),
(11, 9, 'goshi', 1, 'II', '45', '9', 8, 'A', 0, 111, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectID` int(11) UNSIGNED NOT NULL,
  `classesID` int(11) NOT NULL,
  `type` int(100) NOT NULL,
  `passmark` int(11) NOT NULL,
  `finalmark` int(11) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `subject_author` varchar(100) DEFAULT NULL,
  `subject_code` tinytext NOT NULL,
  `teacher_name` varchar(60) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `classesID`, `type`, `passmark`, `finalmark`, `subject`, `subject_author`, `subject_code`, `teacher_name`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(1, 12, 1, 25, 75, 'Islamiat', '', 'I 501', '', '2019-08-10 11:30:21', '2020-02-03 09:04:19', 1, 'ctech', 'Admin'),
(2, 12, 1, 25, 75, 'English', '', 'I 502', '', '2019-08-10 11:31:23', '2019-08-10 12:23:28', 1, 'ctech', 'Admin'),
(3, 12, 1, 25, 75, 'Math', '', 'I 503', '', '2019-08-10 11:32:11', '2019-08-10 12:25:03', 1, 'ctech', 'Admin'),
(4, 12, 1, 25, 75, 'Urdu', '', 'I 504', '', '2019-08-10 11:33:01', '2019-08-10 12:25:32', 1, 'ctech', 'Admin'),
(5, 12, 1, 9, 25, 'Nazra', '', 'I 505', '', '2019-08-10 11:33:57', '2019-08-10 12:26:52', 1, 'ctech', 'Admin'),
(6, 13, 1, 25, 75, 'Islamiat', '', 'Mon 101', '', '2019-08-10 11:38:33', '2019-08-10 11:54:43', 1, 'ctech', 'Admin'),
(7, 13, 1, 25, 75, 'English', '', 'Mon 102', '', '2019-08-10 11:39:28', '2019-08-10 11:45:02', 1, 'ctech', 'Admin'),
(8, 13, 1, 25, 75, 'Math', '', 'Mon 103', '', '2019-08-10 11:40:15', '2019-08-10 11:40:15', 1, 'ctech', 'Admin'),
(9, 13, 1, 25, 75, 'Urdu', '', 'Mon 104', '', '2019-08-10 11:41:09', '2019-08-10 11:54:27', 1, 'ctech', 'Admin'),
(10, 13, 1, 16, 50, 'General Knowledge', '', 'Mon 105', '', '2019-08-10 11:43:27', '2019-08-10 11:43:27', 1, 'ctech', 'Admin'),
(11, 13, 1, 16, 50, 'Drawing', '', 'Mon 106', '', '2019-08-10 11:44:29', '2019-08-10 11:44:29', 1, 'ctech', 'Admin'),
(12, 11, 1, 25, 75, 'Islamiat', '', 'Nur 201', '', '2019-08-10 12:01:37', '2019-08-10 12:01:37', 1, 'ctech', 'Admin'),
(13, 11, 1, 25, 75, 'English', '', 'Nur 202', '', '2019-08-10 12:02:28', '2019-08-10 12:02:28', 1, 'ctech', 'Admin'),
(14, 11, 1, 25, 75, 'Math', '', 'Nur 203', '', '2019-08-10 12:03:08', '2019-08-10 12:03:08', 1, 'ctech', 'Admin'),
(15, 11, 1, 25, 75, 'Urdu', '', 'Nur 204', '', '2019-08-10 12:03:56', '2019-08-10 12:03:56', 1, 'ctech', 'Admin'),
(16, 11, 1, 16, 50, 'General Knowledge', '', 'Nur 205', '', '2019-08-10 12:05:09', '2019-08-10 12:05:09', 1, 'ctech', 'Admin'),
(17, 11, 1, 16, 50, 'Drawing', '', 'Nur 206', '', '2019-08-10 12:06:04', '2019-08-10 12:06:04', 1, 'ctech', 'Admin'),
(18, 14, 1, 25, 75, 'Islamiat', '', 'K.G 301', '', '2019-08-10 12:07:27', '2019-08-10 12:07:27', 1, 'ctech', 'Admin'),
(19, 14, 1, 25, 75, 'English', '', 'K.G 302', '', '2019-08-10 12:08:58', '2019-08-10 12:08:58', 1, 'ctech', 'Admin'),
(20, 14, 1, 25, 75, 'Math', '', 'K.G 303', '', '2019-08-10 12:10:10', '2019-08-10 12:10:10', 1, 'ctech', 'Admin'),
(21, 14, 1, 25, 75, 'Urdu', '', 'K.G 304', '', '2019-08-10 12:11:27', '2019-08-10 12:11:27', 1, 'ctech', 'Admin'),
(22, 14, 1, 16, 50, 'General Knowledge', '', 'K.G 305', '', '2019-08-10 12:12:18', '2019-08-10 12:12:18', 1, 'ctech', 'Admin'),
(23, 14, 1, 16, 50, 'Drawing', '', 'K.G 306', '', '2019-08-10 12:13:04', '2019-08-10 12:13:04', 1, 'ctech', 'Admin'),
(24, 10, 1, 25, 75, 'Islamiat', '', 'K.G 401', '', '2019-08-10 12:14:09', '2019-08-10 12:14:09', 1, 'ctech', 'Admin'),
(25, 10, 1, 25, 75, 'English', '', 'K.G 402', '', '2019-08-10 12:14:56', '2019-08-10 12:14:56', 1, 'ctech', 'Admin'),
(26, 10, 1, 25, 75, 'Math', '', 'K.G 403', '', '2019-08-10 12:15:57', '2019-08-10 12:15:57', 1, 'ctech', 'Admin'),
(27, 10, 1, 25, 75, 'Urdu', '', 'K.G 404', '', '2019-08-10 12:17:02', '2019-08-10 12:19:28', 1, 'ctech', 'Admin'),
(28, 10, 1, 16, 50, 'General Knowledge', '', 'K.G 405', '', '2019-08-10 12:17:50', '2019-08-10 12:19:55', 1, 'ctech', 'Admin'),
(29, 10, 1, 16, 50, 'Drawing', '', 'K.G 406', '', '2019-08-10 12:18:50', '2019-08-10 12:18:50', 1, 'ctech', 'Admin'),
(30, 12, 1, 25, 75, 'Science', '', 'I 506', '', '2019-08-10 12:27:57', '2019-08-10 12:27:57', 1, 'ctech', 'Admin'),
(31, 12, 1, 16, 50, 'Drawing', '', 'I 507', '', '2019-08-10 12:28:56', '2019-08-10 12:28:56', 1, 'ctech', 'Admin'),
(32, 1, 1, 25, 75, 'Islamiat', '', 'II 601', '', '2019-08-10 12:32:07', '2019-08-10 12:32:07', 1, 'ctech', 'Admin'),
(33, 1, 1, 25, 75, 'English', '', 'II 602', '', '2019-08-10 12:32:47', '2019-08-10 12:32:47', 1, 'ctech', 'Admin'),
(34, 1, 1, 25, 75, 'Math', '', 'II 603', '', '2019-08-10 12:36:15', '2019-08-10 12:36:15', 1, 'ctech', 'Admin'),
(35, 1, 1, 25, 75, 'Urdu', '', 'II 604', '', '2019-08-10 12:36:46', '2019-08-10 12:36:46', 1, 'ctech', 'Admin'),
(36, 1, 1, 9, 25, 'Nazra', '', 'II 605', '', '2019-08-10 12:37:35', '2019-08-10 12:37:35', 1, 'ctech', 'Admin'),
(37, 1, 1, 25, 75, 'Science', '', 'II 606', '', '2019-08-10 12:38:24', '2019-08-10 12:38:24', 1, 'ctech', 'Admin'),
(39, 1, 1, 25, 75, 'Computer', '', 'II 607', '', '2019-08-10 12:40:52', '2019-08-11 08:26:51', 1, 'ctech', 'Admin'),
(40, 1, 1, 16, 50, 'Drawing', '', 'II 608', '', '2019-08-10 12:41:31', '2019-08-11 08:27:30', 1, 'ctech', 'Admin'),
(41, 2, 1, 25, 75, 'Islamiat', '', 'III 701', '', '2019-08-10 12:49:56', '2019-08-10 12:49:56', 1, 'ctech', 'Admin'),
(42, 2, 1, 25, 75, 'English', '', 'III 702', '', '2019-08-10 12:50:56', '2019-08-10 12:50:56', 1, 'ctech', 'Admin'),
(43, 2, 1, 25, 75, 'Math', '', 'III 703', '', '2019-08-10 12:51:55', '2019-08-10 12:51:55', 1, 'ctech', 'Admin'),
(44, 2, 1, 25, 75, 'Urdu', '', 'III 704', '', '2019-08-10 12:52:28', '2019-08-10 12:52:28', 1, 'ctech', 'Admin'),
(45, 2, 1, 9, 25, 'Nazra', '', 'III 705', '', '2019-08-10 12:53:21', '2019-08-10 12:53:21', 1, 'ctech', 'Admin'),
(46, 2, 1, 25, 75, 'Science', '', 'III 706', '', '2019-08-10 12:54:05', '2019-08-10 12:54:05', 1, 'ctech', 'Admin'),
(47, 1, 1, 25, 75, 'Social Studies', '', 'II 609', '', '2019-08-10 12:54:44', '2019-08-11 08:28:10', 1, 'ctech', 'Admin'),
(49, 2, 1, 25, 75, 'Social Studies', '', 'III 708', '', '2019-08-10 01:00:28', '2019-08-10 01:00:28', 1, 'ctech', 'Admin'),
(50, 2, 1, 25, 75, 'Computer', '', 'III 709', '', '2019-08-10 01:01:23', '2019-08-10 01:01:23', 1, 'ctech', 'Admin'),
(51, 2, 1, 16, 50, 'Drawing', '', 'III 710', '', '2019-08-10 01:02:10', '2019-08-10 01:02:10', 1, 'ctech', 'Admin'),
(52, 2, 1, 25, 75, 'Sindhi', '', 'III 711', '', '2019-08-10 01:03:11', '2019-08-10 01:03:11', 1, 'ctech', 'Admin'),
(53, 3, 1, 25, 75, 'Islamiat', '', 'IV 801', '', '2019-08-10 01:04:18', '2019-08-10 01:04:18', 1, 'ctech', 'Admin'),
(54, 3, 1, 25, 75, 'English', '', 'IV 802', '', '2019-08-10 01:04:51', '2019-08-10 01:04:51', 1, 'ctech', 'Admin'),
(55, 3, 1, 25, 75, 'Math', '', 'IV 803', '', '2019-08-10 01:05:32', '2019-08-10 01:05:32', 1, 'ctech', 'Admin'),
(56, 3, 1, 25, 75, 'Urdu', '', 'IV 804', '', '2019-08-10 01:06:18', '2019-08-10 01:06:18', 1, 'ctech', 'Admin'),
(57, 3, 1, 9, 25, 'Nazra', '', 'IV 805', '', '2019-08-10 01:07:12', '2019-08-10 01:07:12', 1, 'ctech', 'Admin'),
(58, 3, 1, 25, 75, 'Science', '', 'IV 806', '', '2019-08-10 01:08:00', '2019-08-10 01:08:00', 1, 'ctech', 'Admin'),
(59, 3, 1, 25, 75, 'Social Studies', '', 'IV 807', '', '2019-08-10 01:08:46', '2019-08-10 01:08:46', 1, 'ctech', 'Admin'),
(60, 3, 1, 25, 75, 'Computer', '', 'IV 808', '', '2019-08-10 01:09:32', '2019-08-10 01:09:32', 1, 'ctech', 'Admin'),
(61, 3, 1, 16, 50, 'Drawing', '', 'IV 809', '', '2019-08-10 01:10:21', '2019-08-10 01:10:21', 1, 'ctech', 'Admin'),
(62, 3, 1, 25, 75, 'Sindhi', '', 'IV 810', '', '2019-08-10 01:11:00', '2019-08-10 01:11:00', 1, 'ctech', 'Admin'),
(63, 4, 1, 25, 75, 'Islamiat', '', 'V 901', '', '2019-08-10 01:12:42', '2019-08-10 01:12:42', 1, 'ctech', 'Admin'),
(64, 4, 1, 25, 75, 'English', '', 'V 902', '', '2019-08-10 01:13:15', '2019-08-10 01:13:15', 1, 'ctech', 'Admin'),
(65, 4, 1, 25, 75, 'Math', '', 'V 903', '', '2019-08-10 01:13:47', '2019-08-10 01:13:47', 1, 'ctech', 'Admin'),
(66, 4, 1, 25, 75, 'Urdu', '', 'V 904', '', '2019-08-10 01:16:25', '2019-08-10 01:16:25', 1, 'ctech', 'Admin'),
(67, 4, 1, 9, 25, 'Nazra', '', 'V 905', '', '2019-08-10 01:19:09', '2019-08-10 01:19:09', 1, 'ctech', 'Admin'),
(68, 4, 1, 25, 75, 'Science', '', 'V 906', '', '2019-08-10 01:19:56', '2019-08-10 01:19:56', 1, 'ctech', 'Admin'),
(69, 4, 1, 25, 75, 'Social Studies', '', 'V 907', '', '2019-08-10 01:20:36', '2019-08-10 01:20:36', 1, 'ctech', 'Admin'),
(70, 4, 1, 25, 75, 'Computer', '', 'V 908', '', '2019-08-10 01:21:55', '2019-08-10 01:21:55', 1, 'ctech', 'Admin'),
(71, 4, 1, 16, 50, 'Drawing', '', 'V 909', '', '2019-08-10 01:23:34', '2019-08-10 01:23:34', 1, 'ctech', 'Admin'),
(72, 4, 1, 25, 75, 'Sindhi', '', 'V 910', '', '2019-08-10 01:24:38', '2019-08-10 01:24:38', 1, 'ctech', 'Admin'),
(73, 5, 1, 25, 75, 'Islamiat', '', 'VI 1001', '', '2019-08-10 01:26:24', '2019-08-10 01:26:24', 1, 'ctech', 'Admin'),
(74, 5, 1, 25, 75, 'English', '', 'VI 1002', '', '2019-08-10 01:27:31', '2019-08-10 01:27:31', 1, 'ctech', 'Admin'),
(75, 5, 1, 25, 75, 'Math', '', 'Vi 1003', '', '2019-08-10 01:27:58', '2019-08-10 01:27:58', 1, 'ctech', 'Admin'),
(76, 5, 1, 25, 75, 'Urdu', '', 'VI 1004', '', '2019-08-10 01:28:33', '2019-08-10 01:28:33', 1, 'ctech', 'Admin'),
(77, 5, 1, 9, 25, 'Nazra', '', 'VI 1005', '', '2019-08-10 01:29:35', '2019-08-10 01:29:35', 1, 'ctech', 'Admin'),
(78, 5, 1, 25, 75, 'Science', '', 'VI 1006', '', '2019-08-10 01:30:07', '2019-08-10 01:30:07', 1, 'ctech', 'Admin'),
(79, 5, 1, 25, 75, 'Social Studies', '', 'VI 1007', '', '2019-08-10 01:30:52', '2019-08-10 01:30:52', 1, 'ctech', 'Admin'),
(80, 5, 1, 25, 75, 'Computer', '', 'VI 1008', '', '2019-08-10 01:31:32', '2019-08-10 01:31:32', 1, 'ctech', 'Admin'),
(81, 5, 1, 16, 50, 'Drawing', '', 'VI 1009', '', '2019-08-10 01:32:22', '2019-08-10 01:32:22', 1, 'ctech', 'Admin'),
(82, 5, 1, 25, 75, 'Sindhi', '', 'VI 1010', '', '2019-08-10 01:33:10', '2019-08-10 01:33:10', 1, 'ctech', 'Admin'),
(83, 6, 1, 25, 75, 'Islamiat', '', 'VII 1101', '', '2019-08-10 02:24:12', '2019-08-10 02:24:12', 1, 'ctech', 'Admin'),
(84, 6, 1, 25, 75, 'English', '', 'VII 1102', '', '2019-08-10 02:24:46', '2019-08-29 03:10:05', 1, 'ctech', 'Admin'),
(85, 6, 1, 25, 75, 'Math', '', 'VII 1003', '', '2019-08-10 02:25:31', '2019-08-10 02:25:31', 1, 'ctech', 'Admin'),
(86, 6, 1, 25, 75, 'Urdu', '', 'VII 1004', '', '2019-08-10 02:25:59', '2019-08-10 02:25:59', 1, 'ctech', 'Admin'),
(87, 6, 1, 9, 25, 'Nazra', '', 'VII 1005', '', '2019-08-10 02:26:37', '2019-08-10 02:29:33', 1, 'ctech', 'Admin'),
(88, 6, 1, 25, 75, 'Science', '', 'VII 1006', '', '2019-08-10 02:27:11', '2019-08-10 02:27:11', 1, 'ctech', 'Admin'),
(89, 6, 1, 25, 75, 'Social Studies', '', 'VII 1007', '', '2019-08-10 02:27:58', '2019-08-10 02:27:58', 1, 'ctech', 'Admin'),
(90, 6, 1, 25, 75, 'Computer', '', 'VII 1008', '', '2019-08-10 02:29:10', '2019-08-10 02:29:10', 1, 'ctech', 'Admin'),
(91, 6, 1, 16, 50, 'Drawing', '', 'VII 1009', '', '2019-08-10 02:30:26', '2019-08-10 02:31:51', 1, 'ctech', 'Admin'),
(92, 6, 1, 25, 75, 'Sindhi', '', 'VII 1010', '', '2019-08-10 02:31:17', '2019-08-10 02:31:17', 1, 'ctech', 'Admin'),
(93, 7, 1, 25, 75, 'Islamiat', '', 'VIII 2001', '', '2019-08-10 02:33:33', '2019-08-10 02:33:33', 1, 'ctech', 'Admin'),
(94, 7, 1, 25, 75, 'English', '', 'VIII 2002', '', '2019-08-10 02:34:25', '2019-08-10 02:34:25', 1, 'ctech', 'Admin'),
(95, 7, 1, 25, 75, 'Math', '', 'VIII 2003', '', '2019-08-10 02:35:12', '2019-08-10 02:35:41', 1, 'ctech', 'Admin'),
(96, 7, 1, 25, 75, 'Urdu', '', 'VIII 2004', '', '2019-08-10 02:36:27', '2019-08-10 02:36:27', 1, 'ctech', 'Admin'),
(97, 7, 1, 16, 25, 'Nazra', '', 'VIII 2005', '', '2019-08-10 02:37:06', '2019-08-10 02:37:06', 1, 'ctech', 'Admin'),
(98, 7, 1, 25, 75, 'Science', '', 'VIII 2006', '', '2019-08-10 02:37:42', '2019-08-10 02:37:42', 1, 'ctech', 'Admin'),
(99, 7, 1, 25, 75, 'Computer', '', 'VIII 2007', '', '2019-08-10 02:38:22', '2019-08-10 02:38:22', 1, 'ctech', 'Admin'),
(100, 7, 1, 16, 50, 'Drawing', '', 'VIII 2008', '', '2019-08-10 02:39:09', '2019-08-10 02:39:09', 1, 'ctech', 'Admin'),
(101, 8, 1, 25, 75, 'English', '', 'IX 3001', '', '2019-08-10 02:40:13', '2019-08-10 02:40:13', 1, 'ctech', 'Admin'),
(102, 8, 1, 25, 75, 'Chemistry (Theory)', '', 'IX 3002', '', '2019-08-10 03:00:08', '2019-08-10 03:06:00', 1, 'ctech', 'Admin'),
(103, 8, 1, 8, 25, 'Chemistry (Practical)', '', 'IX 3003', '', '2019-08-10 03:01:39', '2019-08-10 03:07:07', 1, 'ctech', 'Admin'),
(104, 8, 1, 25, 75, 'Biology (Theory)', '', 'IX 3004', '', '2019-08-10 03:03:08', '2019-08-10 03:03:08', 1, 'ctech', 'Admin'),
(105, 8, 1, 8, 25, 'Biology (Practical)', '', 'IX 3005', '', '2019-08-10 03:04:07', '2019-08-10 03:04:07', 1, 'ctech', 'Admin'),
(106, 8, 1, 25, 75, 'Pakistan Studies', '', 'IX 3006', '', '2019-08-10 03:04:56', '2019-08-10 03:06:35', 1, 'ctech', 'Admin'),
(107, 8, 1, 25, 75, 'Sindhi', '', 'IX 3007', '', '2019-08-10 03:05:35', '2019-08-10 03:05:35', 1, 'ctech', 'Admin'),
(108, 19, 0, 33, 100, 'Computer Sciences', '', '101', '', '2020-01-23 09:19:20', '2020-01-23 09:19:39', 1, 'ctech', 'Admin'),
(109, 19, 1, 25, 100, 'Oxford Learning', '', '201', '', '2020-02-12 10:07:50', '2020-02-12 10:07:50', 1, 'ctech', 'Admin'),
(110, 1, 1, 33, 100, 'Pakistan Studies', '', '210', '', '2020-02-12 05:34:08', '2020-02-12 05:34:08', 1, 'ctech', 'Admin'),
(111, 1, 0, 33, 100, 'General Know', '', 'II 211', '', '2020-02-12 05:37:30', '2020-02-12 05:37:30', 1, 'ctech', 'Admin'),
(112, 12, 1, 30, 100, 'Pak Sudies', '', '0145', '', '2020-03-11 10:30:21', '2020-03-11 10:30:21', 1, 'ctech', 'Admin'),
(113, 1, 1, 33, 100, 'Pakistan', '', '631', '', '2020-05-21 12:23:37', '2020-05-21 12:23:37', 1, 'goshi', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `subjectteacher`
--

CREATE TABLE `subjectteacher` (
  `subjectteacherID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjectteacher`
--

INSERT INTO `subjectteacher` (`subjectteacherID`, `subjectID`, `classesID`, `teacherID`) VALUES
(15, 8, 13, 16),
(16, 8, 13, 6),
(19, 10, 13, 16),
(20, 10, 13, 6),
(21, 11, 13, 16),
(22, 11, 13, 6),
(25, 7, 13, 16),
(26, 7, 13, 6),
(29, 9, 13, 16),
(30, 9, 13, 6),
(31, 6, 13, 16),
(32, 6, 13, 6),
(33, 12, 11, 15),
(34, 12, 11, 24),
(35, 13, 11, 15),
(36, 13, 11, 24),
(37, 14, 11, 15),
(38, 14, 11, 24),
(39, 15, 11, 15),
(40, 15, 11, 24),
(41, 16, 11, 15),
(42, 16, 11, 24),
(43, 17, 11, 15),
(44, 17, 11, 24),
(45, 18, 14, 10),
(46, 18, 14, 11),
(47, 19, 14, 10),
(48, 19, 14, 11),
(49, 20, 14, 10),
(50, 20, 14, 11),
(51, 21, 14, 10),
(52, 21, 14, 11),
(53, 22, 14, 10),
(54, 22, 14, 11),
(55, 23, 14, 10),
(56, 23, 14, 11),
(57, 24, 10, 19),
(58, 24, 10, 7),
(59, 25, 10, 19),
(60, 25, 10, 7),
(61, 26, 10, 19),
(62, 26, 10, 7),
(67, 29, 10, 19),
(68, 29, 10, 7),
(69, 27, 10, 19),
(70, 27, 10, 7),
(71, 28, 10, 19),
(72, 28, 10, 7),
(83, 2, 12, 23),
(84, 2, 12, 13),
(89, 3, 12, 23),
(90, 3, 12, 13),
(91, 4, 12, 23),
(92, 4, 12, 13),
(93, 5, 12, 23),
(94, 5, 12, 13),
(95, 30, 12, 23),
(96, 30, 12, 13),
(97, 31, 12, 23),
(98, 31, 12, 13),
(99, 32, 1, 8),
(100, 33, 1, 5),
(101, 34, 1, 25),
(102, 35, 1, 4),
(103, 36, 1, 8),
(104, 37, 1, 9),
(109, 41, 2, 4),
(110, 42, 2, 5),
(111, 43, 2, 25),
(112, 44, 2, 4),
(113, 45, 2, 4),
(114, 46, 2, 9),
(117, 49, 2, 14),
(118, 50, 2, 2),
(119, 51, 2, 4),
(120, 52, 2, 8),
(121, 53, 3, 8),
(122, 54, 3, 5),
(123, 55, 3, 25),
(124, 56, 3, 4),
(125, 57, 3, 8),
(126, 58, 3, 9),
(127, 59, 3, 14),
(128, 60, 3, 2),
(129, 61, 3, 8),
(130, 62, 3, 8),
(131, 63, 4, 14),
(132, 64, 4, 5),
(133, 65, 4, 25),
(134, 66, 4, 4),
(135, 67, 4, 14),
(136, 68, 4, 9),
(137, 69, 4, 14),
(138, 70, 4, 2),
(139, 71, 4, 14),
(140, 72, 4, 8),
(141, 73, 5, 4),
(142, 74, 5, 5),
(143, 75, 5, 25),
(144, 76, 5, 4),
(145, 77, 5, 4),
(146, 78, 5, 9),
(147, 79, 5, 14),
(148, 80, 5, 2),
(149, 81, 5, 8),
(150, 82, 5, 8),
(151, 83, 6, 2),
(153, 85, 6, 14),
(154, 86, 6, 4),
(156, 88, 6, 9),
(157, 89, 6, 25),
(158, 90, 6, 2),
(159, 87, 6, 2),
(161, 92, 6, 8),
(162, 91, 6, 2),
(163, 93, 7, 4),
(164, 94, 7, 5),
(165, 94, 7, 12),
(167, 95, 7, 4),
(168, 95, 7, 25),
(169, 96, 7, 4),
(170, 97, 7, 4),
(171, 98, 7, 9),
(172, 99, 7, 2),
(173, 100, 7, 9),
(174, 101, 8, 12),
(177, 104, 8, 17),
(178, 105, 8, 17),
(180, 107, 8, 8),
(181, 102, 8, 20),
(182, 106, 8, 4),
(183, 103, 8, 20),
(184, 39, 1, 2),
(185, 40, 1, 5),
(186, 47, 1, 14),
(187, 84, 6, 27),
(188, 84, 6, 26),
(191, 108, 19, 34),
(192, 108, 19, 31),
(193, 1, 12, 34),
(194, 109, 19, 32),
(195, 109, 19, 33),
(196, 110, 1, 35),
(197, 110, 1, 33),
(198, 111, 1, 31),
(199, 112, 12, 36),
(200, 113, 1, 32),
(201, 113, 1, 34);

-- --------------------------------------------------------

--
-- Table structure for table `sub_attendance`
--

CREATE TABLE `sub_attendance` (
  `attendanceID` int(200) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `classesID` int(11) NOT NULL,
  `sectionID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertype` varchar(60) NOT NULL,
  `monthyear` varchar(10) NOT NULL,
  `a1` varchar(3) DEFAULT NULL,
  `a2` varchar(3) DEFAULT NULL,
  `a3` varchar(3) DEFAULT NULL,
  `a4` varchar(3) DEFAULT NULL,
  `a5` varchar(3) DEFAULT NULL,
  `a6` varchar(3) DEFAULT NULL,
  `a7` varchar(3) DEFAULT NULL,
  `a8` varchar(3) DEFAULT NULL,
  `a9` varchar(3) DEFAULT NULL,
  `a10` varchar(3) DEFAULT NULL,
  `a11` varchar(3) DEFAULT NULL,
  `a12` varchar(3) DEFAULT NULL,
  `a13` varchar(3) DEFAULT NULL,
  `a14` varchar(3) DEFAULT NULL,
  `a15` varchar(3) DEFAULT NULL,
  `a16` varchar(3) DEFAULT NULL,
  `a17` varchar(3) DEFAULT NULL,
  `a18` varchar(3) DEFAULT NULL,
  `a19` varchar(3) DEFAULT NULL,
  `a20` varchar(3) DEFAULT NULL,
  `a21` varchar(3) DEFAULT NULL,
  `a22` varchar(3) DEFAULT NULL,
  `a23` varchar(3) DEFAULT NULL,
  `a24` varchar(3) DEFAULT NULL,
  `a25` varchar(3) DEFAULT NULL,
  `a26` varchar(3) DEFAULT NULL,
  `a27` varchar(3) DEFAULT NULL,
  `a28` varchar(3) DEFAULT NULL,
  `a29` varchar(3) DEFAULT NULL,
  `a30` varchar(3) DEFAULT NULL,
  `a31` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_attendance`
--

INSERT INTO `sub_attendance` (`attendanceID`, `schoolyearID`, `studentID`, `classesID`, `sectionID`, `subjectID`, `userID`, `usertype`, `monthyear`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `a13`, `a14`, `a15`, `a16`, `a17`, `a18`, `a19`, `a20`, `a21`, `a22`, `a23`, `a24`, `a25`, `a26`, `a27`, `a28`, `a29`, `a30`, `a31`) VALUES
(1, 1, 4, 6, 13, 84, 1, 'Admin', '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL),
(2, 1, 1, 12, 16, 1, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 6, 12, 16, 1, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 6, 12, 16, 1, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, 12, 16, 1, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 1, 12, 16, 1, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 1, 12, 16, 2, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 1, 12, 16, 3, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 1, 12, 16, 4, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 1, 12, 16, 5, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 1, 12, 16, 30, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 1, 12, 16, 31, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 1, 13, 16, 6, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 1, 13, 16, 7, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 1, 13, 16, 8, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, 1, 13, 16, 9, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 1, 13, 16, 10, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 1, 13, 16, 11, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, 1, 12, 16, 1, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, 1, 12, 16, 2, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, 1, 12, 16, 3, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 1, 12, 16, 4, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, 1, 12, 16, 5, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, 1, 12, 16, 30, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, 1, 12, 16, 31, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, 1, 13, 16, 6, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, 1, 13, 16, 7, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, 1, 13, 16, 8, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 1, 1, 13, 16, 9, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 1, 1, 13, 16, 10, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 1, 1, 13, 16, 11, 1, 'Admin', '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, 1, 12, 16, 2, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 1, 6, 12, 16, 2, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 1, 6, 12, 16, 2, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 1, 5, 12, 16, 2, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 1, 1, 12, 16, 1, 1, 'Admin', '11-2019', NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 1, 7, 12, 16, 1, 1, 'Admin', '11-2019', NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 1, 6, 12, 16, 1, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 1, 6, 12, 16, 1, 1, 'Admin', '11-2019', NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 1, 5, 12, 16, 1, 1, 'Admin', '11-2019', NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 1, 7, 12, 16, 2, 1, 'Admin', '11-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `syllabusID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text,
  `date` date NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `originalfile` text NOT NULL,
  `file` text,
  `classesID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`syllabusID`, `title`, `description`, `date`, `usertypeID`, `userID`, `originalfile`, `file`, `classesID`, `schoolyearID`) VALUES
(1, 'Islamiyat', 'Class 1', '2019-08-13', 1, 1, 'logo.jpg', '0fe5253e240421532c84f7ed57462d42e71cfdf2e3a501414121a34511d886b85511b04bcf4b653ed8c789057c31ce89cc2353d9f5aff598413a2a41d1ba2e3c.jpg', 12, 1),
(2, 'Oral', 'some short questions of islamyat and english', '2020-01-23', 1, 1, 'BIODATA FORM.pdf', 'cd1cf5d0107d6ce0a72f13e0500cf2e0afa697475ce1444bc4173ab69e2934fac7b54174fa44a1740a5d00cccb3ea1de1bf120187844d910901f8bcaa96b8b84.pdf', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `systemadmin`
--

CREATE TABLE `systemadmin` (
  `systemadminID` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `jod` date NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL,
  `active` int(11) NOT NULL,
  `systemadminextra1` varchar(128) DEFAULT NULL,
  `systemadminextra2` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `systemadmin`
--

INSERT INTO `systemadmin` (`systemadminID`, `name`, `dob`, `sex`, `religion`, `email`, `phone`, `address`, `jod`, `photo`, `username`, `password`, `usertypeID`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `active`, `systemadminextra1`, `systemadminextra2`) VALUES
(1, 'Admin', '2019-08-26', 'Male', 'ISLAM', 'jagdamatyping@gmail.com', '03007476412', 'Rawalpindi', '2019-07-04', '410eff26cd57beae84ca2988489ef64df6a27a6fbdc9fbf0a13ff2b3a58a0dd84db794695947bfa9b00fd888693b827be98029d1bda11b0b322018f95e6c5287.jpg', 'goshi', '2a43e7235a5c6d811b42ba4c0e9efbd1afc1583ce349f844f9c1e6ad8cdd007fb80fc64c7d3666954c64d97673e6edeb5a3747023181bbcaeb36066447fc6a95', 1, '2019-07-04 10:44:21', '2019-07-04 10:44:21', 0, 'goshi', 'Admin', 1, '', ''),
(2, 'Jagdamba', '1994-01-16', 'Male', 'Hindu', 'jagdambatypingcenter@gmail.com', '88888888888', 'Sirsa', '2019-08-26', '6d24656ac0f8a99ff070d4c825f1a54d5d557f0f0f232ddea996266c5a23e8de8a2a633b56b50a1370ef7c78b86116986612d01364408497d4f02fc69ee9a7bd.png', 'superadmin', '2a43e7235a5c6d811b42ba4c0e9efbd1afc1583ce349f844f9c1e6ad8cdd007fb80fc64c7d3666954c64d97673e6edeb5a3747023181bbcaeb36066447fc6a95', 1, '2019-07-04 10:34:14', '2019-11-05 07:16:12', 1, 'ctech', 'Admin', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tattendance`
--

CREATE TABLE `tattendance` (
  `tattendanceID` int(200) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `monthyear` varchar(10) NOT NULL,
  `a1` varchar(3) DEFAULT NULL,
  `a2` varchar(3) DEFAULT NULL,
  `a3` varchar(3) DEFAULT NULL,
  `a4` varchar(3) DEFAULT NULL,
  `a5` varchar(3) DEFAULT NULL,
  `a6` varchar(3) DEFAULT NULL,
  `a7` varchar(3) DEFAULT NULL,
  `a8` varchar(3) DEFAULT NULL,
  `a9` varchar(3) DEFAULT NULL,
  `a10` varchar(3) DEFAULT NULL,
  `a11` varchar(3) DEFAULT NULL,
  `a12` varchar(3) DEFAULT NULL,
  `a13` varchar(3) DEFAULT NULL,
  `a14` varchar(3) DEFAULT NULL,
  `a15` varchar(3) DEFAULT NULL,
  `a16` varchar(3) DEFAULT NULL,
  `a17` varchar(3) DEFAULT NULL,
  `a18` varchar(3) DEFAULT NULL,
  `a19` varchar(3) DEFAULT NULL,
  `a20` varchar(3) DEFAULT NULL,
  `a21` varchar(3) DEFAULT NULL,
  `a22` varchar(3) DEFAULT NULL,
  `a23` varchar(3) DEFAULT NULL,
  `a24` varchar(3) DEFAULT NULL,
  `a25` varchar(3) DEFAULT NULL,
  `a26` varchar(3) DEFAULT NULL,
  `a27` varchar(3) DEFAULT NULL,
  `a28` varchar(3) DEFAULT NULL,
  `a29` varchar(3) DEFAULT NULL,
  `a30` varchar(3) DEFAULT NULL,
  `a31` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tattendance`
--

INSERT INTO `tattendance` (`tattendanceID`, `schoolyearID`, `teacherID`, `usertypeID`, `monthyear`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `a13`, `a14`, `a15`, `a16`, `a17`, `a18`, `a19`, `a20`, `a21`, `a22`, `a23`, `a24`, `a25`, `a26`, `a27`, `a28`, `a29`, `a30`, `a31`) VALUES
(1, 1, 20, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 4, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 19, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 16, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 15, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 5, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 8, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 14, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 9, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 6, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 7, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 10, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 11, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 13, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 3, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, 18, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, 12, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 17, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, 2, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 1, 21, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, 22, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 1, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, 26, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, 23, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, 24, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 1, 25, 2, '08-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 1, 27, 2, '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 1, 26, 2, '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 1, 28, 2, '11-2019', NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 1, 27, 2, '11-2019', NULL, NULL, NULL, 'LE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 1, 26, 2, '11-2019', NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 1, 32, 2, '02-2020', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 1, 34, 2, '02-2020', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 1, 33, 2, '02-2020', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, 'LE', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 1, 31, 2, '02-2020', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, 'L', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 1, 35, 2, '02-2020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherID` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `designation` varchar(128) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `jod` date NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `name`, `designation`, `dob`, `sex`, `religion`, `email`, `phone`, `address`, `jod`, `photo`, `username`, `password`, `usertypeID`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `active`) VALUES
(31, 'Tanzeel ur Rehman', 'Teacher', '1985-11-11', 'Male', 'Islam', 'pcst.tanzeel@gmail.com', '03007476412', 'Qila Didar Singh', '2019-09-02', 'default.png', 'tanzeel', 'ddafe77db7c10eb75607edc38c3fd571aac1031275c37cb14ced9acb343529058f1a0b6bb0ce79daf5d58e079f612aac32ce39dff372e03eaf26ae86f4d3d23e', 2, '2020-01-23 09:02:59', '2020-01-23 09:02:59', 1, 'ctech', 'Admin', 1),
(32, 'Hafeez ur Rehman', 'Teacher', '1989-01-01', 'Male', 'Islam', 'hafeez@gmail.co', '03016697211', 'Gujranwala', '2019-02-04', 'default.png', 'Hafeez', '6fd050fe8b892d1dbcf959e52a0c937684b79172749aa351247c332d8428056e3f4899077ef2f7ba05b62934f30897d6fb279780ab11d4e343bc2cb11f9d29dd', 2, '2020-01-23 09:05:53', '2020-01-23 09:05:53', 1, 'ctech', 'Admin', 1),
(33, 'Samee ur Rehman', 'Principal', '1970-01-06', 'Male', 'Islam', 'samee@gmail.com', '', 'Qila Didar Singh', '2018-12-03', 'fa6f8fd20c60f870548dd2c89bea8224aabe7a35ffe0a540030406ff1d0b0689de077b8d8384426f4c76684c7e73d789749119d8da770dd0a6a2c97c74ade102.jpg', 'samee', 'da83c99966d26384c316850c4e76eab593eda9b4b3a2034053ccbeb03bf3a07aea10572d705ec03ee5e537afca7d7dd8be1bf7417c15abcf13a8a0dce52e47cb', 2, '2020-01-23 09:08:36', '2020-01-23 09:08:36', 1, 'ctech', 'Admin', 1),
(34, 'Muti ur  Rehman', 'Teacher', '1998-10-27', 'Male', '', 'muti@gmail.com', '03016609328', '', '2019-07-07', 'e5206269618f420658648590ed22ed3cb1be15d21ee869912743749862c3e194c23369facfd189985d97a0b3c92ba5d4d799c1f9f6532a0460e1bca8fb70246d.jpg', 'muti', '60312274919a0c51ee71adc10fc5007e65dbbc709f7bb322cdcb0846604e2584e2e814454249e3b99b8ff0443aaa8d0f9b3a316c2d02496fff181e32d5d8d6b1', 2, '2020-01-23 09:10:56', '2020-01-23 09:10:56', 1, 'ctech', 'Admin', 1),
(35, 'Attiq ur rehman', 'Teacher', '2007-09-24', 'Male', 'Islam', 'attique@gmail.com', '03007476412', '', '2020-02-03', 'default.png', 'ctechhh', '2a43e7235a5c6d811b42ba4c0e9efbd1afc1583ce349f844f9c1e6ad8cdd007fb80fc64c7d3666954c64d97673e6edeb5a3747023181bbcaeb36066447fc6a95', 2, '2020-02-04 04:38:38', '2020-02-04 04:38:38', 1, 'ctech', 'Admin', 1),
(36, 'Tanzeel', 'Teacher', '2008-12-29', 'Male', 'Islam', 'st_assiduity@yahoo.com', '03007476412', 'Islamabad', '2020-03-01', 'default.png', 'tanzeel123', 'b981b665c5355a6c19ad3f0cb3e98b011cc622928662edbc13b6a40368ed4597f9d9101e8aee738936265bcd9edf143ce5ac1fa6b17a96efcbb6abd029750259', 2, '2020-03-11 10:15:09', '2020-03-11 10:15:09', 1, 'ctech', 'Admin', 1),
(37, 'Kenn Annor Sergio', 'Teacher', '2000-02-01', 'Male', '', 'kenn@gmail.com', '326598741', 'Ghanna', '2020-04-05', 'da866e04e52c6c71a121cd7541a891c88f6d45e14eb52da5d4a09d59713b04586dc160ab3c4ef47878d35bf1244128428d9087598bdda5cc2c10150ec14847d6.JPG', 'kenn', '2a9f6466cd2ec780a5e5b0eb037303d527b7a8dc63d5fbbac7cec3ebb522db9576593f21372e19c41f6a04f709cd4d5641fc5519bd577405cfa46a3161bb2fb8', 2, '2020-04-13 04:29:20', '2020-04-13 04:29:20', 1, 'ctech', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `themesID` int(11) NOT NULL,
  `sortID` int(11) NOT NULL DEFAULT '1',
  `themename` varchar(128) NOT NULL,
  `backend` int(11) NOT NULL DEFAULT '1',
  `frontend` int(11) NOT NULL DEFAULT '1',
  `topcolor` text NOT NULL,
  `leftcolor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`themesID`, `sortID`, `themename`, `backend`, `frontend`, `topcolor`, `leftcolor`) VALUES
(1, 1, 'Default', 1, 1, '#FFFFFF', '#2d353c'),
(2, 0, 'Blue', 0, 1, '#3c8dbc', '#2d353c'),
(3, 3, 'Black', 1, 1, '#fefefe', '#222222'),
(4, 4, 'Purple', 1, 1, '#605ca8', '#2d353c'),
(5, 5, 'Green', 1, 1, '#00a65a', '#2d353c'),
(6, 6, 'Red', 1, 1, '#dd4b39', '#2d353c'),
(7, 0, 'Yellow', 0, 1, '#f39c12', '#d9534f'),
(8, 7, 'Blue Light', 1, 1, '#3c8dbc', '#f9fafc'),
(9, 8, 'Black Light', 1, 1, '#fefefe', '#f9fafc'),
(10, 9, 'Purple Light', 1, 1, '#605ca8', '#f9fafc'),
(11, 10, 'Green Light', 1, 1, '#00a65a', '#f9fafc'),
(12, 11, 'Red Light', 1, 1, '#dd4b39', '#f9fafc'),
(13, 12, 'Yellow Light', 1, 1, '#f39c12', '#f9fafc'),
(14, 2, 'White Blue', 1, 1, '#ffffff', '#132035');

-- --------------------------------------------------------

--
-- Table structure for table `tmember`
--

CREATE TABLE `tmember` (
  `tmemberID` int(11) UNSIGNED NOT NULL,
  `studentID` int(11) NOT NULL,
  `transportID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `tbalance` varchar(11) DEFAULT NULL,
  `tjoindate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `transportID` int(11) UNSIGNED NOT NULL,
  `route` text NOT NULL,
  `vehicle` int(11) NOT NULL,
  `fare` varchar(11) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `uattendance`
--

CREATE TABLE `uattendance` (
  `uattendanceID` int(200) UNSIGNED NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `monthyear` varchar(10) NOT NULL,
  `a1` varchar(3) DEFAULT NULL,
  `a2` varchar(3) DEFAULT NULL,
  `a3` varchar(3) DEFAULT NULL,
  `a4` varchar(3) DEFAULT NULL,
  `a5` varchar(3) DEFAULT NULL,
  `a6` varchar(3) DEFAULT NULL,
  `a7` varchar(3) DEFAULT NULL,
  `a8` varchar(3) DEFAULT NULL,
  `a9` varchar(3) DEFAULT NULL,
  `a10` varchar(3) DEFAULT NULL,
  `a11` varchar(3) DEFAULT NULL,
  `a12` varchar(3) DEFAULT NULL,
  `a13` varchar(3) DEFAULT NULL,
  `a14` varchar(3) DEFAULT NULL,
  `a15` varchar(3) DEFAULT NULL,
  `a16` varchar(3) DEFAULT NULL,
  `a17` varchar(3) DEFAULT NULL,
  `a18` varchar(3) DEFAULT NULL,
  `a19` varchar(3) DEFAULT NULL,
  `a20` varchar(3) DEFAULT NULL,
  `a21` varchar(3) DEFAULT NULL,
  `a22` varchar(3) DEFAULT NULL,
  `a23` varchar(3) DEFAULT NULL,
  `a24` varchar(3) DEFAULT NULL,
  `a25` varchar(3) DEFAULT NULL,
  `a26` varchar(3) DEFAULT NULL,
  `a27` varchar(3) DEFAULT NULL,
  `a28` varchar(3) DEFAULT NULL,
  `a29` varchar(3) DEFAULT NULL,
  `a30` varchar(3) DEFAULT NULL,
  `a31` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uattendance`
--

INSERT INTO `uattendance` (`uattendanceID`, `schoolyearID`, `userID`, `usertypeID`, `monthyear`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `a12`, `a13`, `a14`, `a15`, `a16`, `a17`, `a18`, `a19`, `a20`, `a21`, `a22`, `a23`, `a24`, `a25`, `a26`, `a27`, `a28`, `a29`, `a30`, `a31`) VALUES
(1, 1, 1, 9, '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, 9, '10-2019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `update`
--

CREATE TABLE `update` (
  `updateID` int(11) NOT NULL,
  `version` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `log` longtext NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(25) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` tinytext,
  `address` text,
  `jod` date NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(128) NOT NULL,
  `usertypeID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `dob`, `sex`, `religion`, `email`, `phone`, `address`, `jod`, `photo`, `username`, `password`, `usertypeID`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`, `active`) VALUES
(7, 'librarian', '2010-02-09', 'Male', '', 'gmkabuku1@gmail.com', '264814068582', 'sfgfd', '2019-11-19', 'default.png', 'librarian', '11ee8fbd880a625d481b0d0b312a934829e958c84beed6107bdf2bb86029ccd245b58857fef7cb1da022fa680d57824b7f294ea34b5be29faff6541414b6ca57', 6, '2019-11-20 03:13:49', '2019-12-06 02:42:09', 1, 'tanzeel', 'Admin', 1),
(8, 'Tanzeel', '2008-10-28', 'Male', '', 'admin@gmail.com', '03007476412', '', '2020-02-04', 'default.png', 'director', 'f33e14d1050f98a6dd25ac18e465225c9978c41b00a7cc72ac9cc4f0eaa5ce101be0ea05b9e43d5cfc750140eb76e4dcd5653d55f6cb1dd90189f6151704f1a2', 9, '2020-02-12 10:24:31', '2020-02-12 10:24:31', 1, 'tanzeel', 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `usertypeID` int(11) UNSIGNED NOT NULL,
  `usertype` varchar(60) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `create_userID` int(11) NOT NULL,
  `create_username` varchar(60) NOT NULL,
  `create_usertype` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`usertypeID`, `usertype`, `create_date`, `modify_date`, `create_userID`, `create_username`, `create_usertype`) VALUES
(1, 'Admin', '2016-06-24 07:12:49', '2016-06-24 07:12:49', 1, 'admin', 'Super Admin'),
(2, 'Teacher', '2016-06-24 07:13:13', '2020-03-12 03:24:39', 1, 'admin', 'Super Admin'),
(3, 'Student', '2016-06-24 07:13:27', '2020-05-09 08:31:55', 1, 'admin', 'Super Admin'),
(4, 'Parents', '2016-06-24 07:13:42', '2016-10-25 01:12:52', 1, 'admin', 'Super Admin'),
(5, 'Accountant', '2016-06-24 07:13:54', '2016-06-24 07:13:54', 1, 'admin', 'Super Admin'),
(6, 'Librarian', '2016-06-24 09:09:43', '2016-06-24 09:09:43', 1, 'admin', 'Super Admin'),
(7, 'Receptionist', '2016-10-30 06:24:41', '2016-10-30 06:24:41', 1, 'admin', 'Admin'),
(9, 'Director', '2019-07-04 02:53:30', '2019-10-13 01:00:18', 1, 'tanzeel', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorID`, `name`, `email`, `phone`, `contact_name`, `date`) VALUES
(1, 'Hafeez ur rehman', 'pcst@gmail.com', '03007476412', 'Saeed', '2020-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `visitorinfo`
--

CREATE TABLE `visitorinfo` (
  `visitorID` bigint(12) UNSIGNED NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `email_id` varchar(128) DEFAULT NULL,
  `phone` text NOT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `company_name` varchar(128) DEFAULT NULL,
  `coming_from` varchar(128) DEFAULT NULL,
  `representing` varchar(128) DEFAULT NULL,
  `to_meet_personID` int(11) NOT NULL,
  `to_meet_usertypeID` int(11) NOT NULL,
  `check_in` timestamp NULL DEFAULT NULL,
  `check_out` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitorinfo`
--

INSERT INTO `visitorinfo` (`visitorID`, `name`, `email_id`, `phone`, `photo`, `company_name`, `coming_from`, `representing`, `to_meet_personID`, `to_meet_usertypeID`, `check_in`, `check_out`, `status`, `schoolyearID`) VALUES
(1, 'uyfuyf', 'adn@gmail.com', '236548', 'visitor1874995406949939309.jpeg', 'fxxzr', 'klhkhfgf', 'family', 4, 3, '2020-06-27 23:34:59', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `weaverandfine`
--

CREATE TABLE `weaverandfine` (
  `weaverandfineID` int(11) NOT NULL,
  `globalpaymentID` int(11) NOT NULL,
  `invoiceID` int(11) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `schoolyearID` int(11) NOT NULL,
  `weaver` double NOT NULL,
  `fine` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weaverandfine`
--

INSERT INTO `weaverandfine` (`weaverandfineID`, `globalpaymentID`, `invoiceID`, `paymentID`, `studentID`, `schoolyearID`, `weaver`, `fine`) VALUES
(1, 3, 6, 5, 2, 1, 850, 0),
(2, 3, 7, 6, 2, 1, 850, 0),
(3, 33, 20, 74, 6, 1, 12, 1),
(4, 33, 27, 75, 6, 1, 2, 1),
(5, 33, 28, 76, 6, 1, 1, 2),
(6, 33, 29, 77, 6, 1, 1, 2),
(7, 33, 35, 78, 6, 1, 1, 2),
(8, 33, 43, 79, 6, 1, 1, 21),
(9, 33, 44, 80, 6, 1, 1, 21),
(10, 33, 45, 81, 6, 1, 1, 21),
(11, 48, 364, 110, 2, 1, 200, 0),
(12, 49, 368, 111, 5, 1, 500, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activitiesID`);

--
-- Indexes for table `activitiescategory`
--
ALTER TABLE `activitiescategory`
  ADD PRIMARY KEY (`activitiescategoryID`);

--
-- Indexes for table `activitiescomment`
--
ALTER TABLE `activitiescomment`
  ADD PRIMARY KEY (`activitiescommentID`);

--
-- Indexes for table `activitiesmedia`
--
ALTER TABLE `activitiesmedia`
  ADD PRIMARY KEY (`activitiesmediaID`);

--
-- Indexes for table `activitiesstudent`
--
ALTER TABLE `activitiesstudent`
  ADD PRIMARY KEY (`activitiesstudentID`);

--
-- Indexes for table `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`alertID`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`assetID`);

--
-- Indexes for table `asset_assignment`
--
ALTER TABLE `asset_assignment`
  ADD PRIMARY KEY (`asset_assignmentID`);

--
-- Indexes for table `asset_category`
--
ALTER TABLE `asset_category`
  ADD PRIMARY KEY (`asset_categoryID`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignmentID`);

--
-- Indexes for table `assignmentanswer`
--
ALTER TABLE `assignmentanswer`
  ADD PRIMARY KEY (`assignmentanswerID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`);

--
-- Indexes for table `automation_rec`
--
ALTER TABLE `automation_rec`
  ADD PRIMARY KEY (`automation_recID`);

--
-- Indexes for table `automation_shudulu`
--
ALTER TABLE `automation_shudulu`
  ADD PRIMARY KEY (`automation_shuduluID`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `certificate_template`
--
ALTER TABLE `certificate_template`
  ADD PRIMARY KEY (`certificate_templateID`);

--
-- Indexes for table `childcare`
--
ALTER TABLE `childcare`
  ADD PRIMARY KEY (`childcareID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classesID`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`complainID`);

--
-- Indexes for table `conversation_message_info`
--
ALTER TABLE `conversation_message_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversation_msg`
--
ALTER TABLE `conversation_msg`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`documentID`);

--
-- Indexes for table `eattendance`
--
ALTER TABLE `eattendance`
  ADD PRIMARY KEY (`eattendanceID`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`ebooksID`);

--
-- Indexes for table `emailsetting`
--
ALTER TABLE `emailsetting`
  ADD PRIMARY KEY (`fieldoption`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `eventcounter`
--
ALTER TABLE `eventcounter`
  ADD PRIMARY KEY (`eventcounterID`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`examID`);

--
-- Indexes for table `examschedule`
--
ALTER TABLE `examschedule`
  ADD PRIMARY KEY (`examscheduleID`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expenseID`);

--
-- Indexes for table `feetypes`
--
ALTER TABLE `feetypes`
  ADD PRIMARY KEY (`feetypesID`);

--
-- Indexes for table `fmenu`
--
ALTER TABLE `fmenu`
  ADD PRIMARY KEY (`fmenuID`);

--
-- Indexes for table `fmenu_relation`
--
ALTER TABLE `fmenu_relation`
  ADD PRIMARY KEY (`fmenu_relationID`);

--
-- Indexes for table `frontend_setting`
--
ALTER TABLE `frontend_setting`
  ADD PRIMARY KEY (`fieldoption`);

--
-- Indexes for table `frontend_template`
--
ALTER TABLE `frontend_template`
  ADD PRIMARY KEY (`frontend_templateID`);

--
-- Indexes for table `globalpayment`
--
ALTER TABLE `globalpayment`
  ADD PRIMARY KEY (`globalpaymentID`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`gradeID`);

--
-- Indexes for table `hmember`
--
ALTER TABLE `hmember`
  ADD PRIMARY KEY (`hmemberID`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`holidayID`);

--
-- Indexes for table `hostel`
--
ALTER TABLE `hostel`
  ADD PRIMARY KEY (`hostelID`);

--
-- Indexes for table `hourly_template`
--
ALTER TABLE `hourly_template`
  ADD PRIMARY KEY (`hourly_templateID`);

--
-- Indexes for table `idmanager`
--
ALTER TABLE `idmanager`
  ADD PRIMARY KEY (`idmanagerID`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`incomeID`);

--
-- Indexes for table `ini_config`
--
ALTER TABLE `ini_config`
  ADD PRIMARY KEY (`configID`);

--
-- Indexes for table `instruction`
--
ALTER TABLE `instruction`
  ADD PRIMARY KEY (`instructionID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`issueID`);

--
-- Indexes for table `leaveapplications`
--
ALTER TABLE `leaveapplications`
  ADD PRIMARY KEY (`leaveapplicationID`),
  ADD KEY `leave_categoryID` (`leavecategoryID`),
  ADD KEY `from_date` (`from_date`),
  ADD KEY `to_date` (`to_date`),
  ADD KEY `approver_userID` (`approver_userID`),
  ADD KEY `approver_usertypeID` (`approver_usertypeID`),
  ADD KEY `applicationto_usertypeID` (`applicationto_usertypeID`),
  ADD KEY `applicationto_userID` (`applicationto_userID`);

--
-- Indexes for table `leaveassign`
--
ALTER TABLE `leaveassign`
  ADD PRIMARY KEY (`leaveassignID`),
  ADD KEY `leave_categoryID` (`leavecategoryID`),
  ADD KEY `usertypeID` (`usertypeID`);

--
-- Indexes for table `leavecategory`
--
ALTER TABLE `leavecategory`
  ADD PRIMARY KEY (`leavecategoryID`);

--
-- Indexes for table `lmember`
--
ALTER TABLE `lmember`
  ADD PRIMARY KEY (`lmemberID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `loginlog`
--
ALTER TABLE `loginlog`
  ADD PRIMARY KEY (`loginlogID`);

--
-- Indexes for table `mailandsms`
--
ALTER TABLE `mailandsms`
  ADD PRIMARY KEY (`mailandsmsID`);

--
-- Indexes for table `mailandsmstemplate`
--
ALTER TABLE `mailandsmstemplate`
  ADD PRIMARY KEY (`mailandsmstemplateID`);

--
-- Indexes for table `mailandsmstemplatetag`
--
ALTER TABLE `mailandsmstemplatetag`
  ADD PRIMARY KEY (`mailandsmstemplatetagID`);

--
-- Indexes for table `maininvoice`
--
ALTER TABLE `maininvoice`
  ADD PRIMARY KEY (`maininvoiceID`);

--
-- Indexes for table `make_payment`
--
ALTER TABLE `make_payment`
  ADD PRIMARY KEY (`make_paymentID`);

--
-- Indexes for table `manage_salary`
--
ALTER TABLE `manage_salary`
  ADD PRIMARY KEY (`manage_salaryID`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`markID`);

--
-- Indexes for table `markpercentage`
--
ALTER TABLE `markpercentage`
  ADD PRIMARY KEY (`markpercentageID`);

--
-- Indexes for table `markrelation`
--
ALTER TABLE `markrelation`
  ADD PRIMARY KEY (`markrelationID`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mediaID`);

--
-- Indexes for table `media_category`
--
ALTER TABLE `media_category`
  ADD PRIMARY KEY (`mcategoryID`);

--
-- Indexes for table `media_gallery`
--
ALTER TABLE `media_gallery`
  ADD PRIMARY KEY (`media_galleryID`);

--
-- Indexes for table `media_share`
--
ALTER TABLE `media_share`
  ADD PRIMARY KEY (`shareID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`noticeID`);

--
-- Indexes for table `onlineadmission`
--
ALTER TABLE `onlineadmission`
  ADD PRIMARY KEY (`onlineadmissionID`);

--
-- Indexes for table `online_exam`
--
ALTER TABLE `online_exam`
  ADD PRIMARY KEY (`onlineExamID`);

--
-- Indexes for table `online_exam_question`
--
ALTER TABLE `online_exam_question`
  ADD PRIMARY KEY (`onlineExamQuestionID`);

--
-- Indexes for table `online_exam_type`
--
ALTER TABLE `online_exam_type`
  ADD PRIMARY KEY (`onlineExamTypeID`);

--
-- Indexes for table `online_exam_user_answer`
--
ALTER TABLE `online_exam_user_answer`
  ADD PRIMARY KEY (`onlineExamUserAnswerID`);

--
-- Indexes for table `online_exam_user_answer_option`
--
ALTER TABLE `online_exam_user_answer_option`
  ADD PRIMARY KEY (`onlineExamUserAnswerOptionID`);

--
-- Indexes for table `online_exam_user_status`
--
ALTER TABLE `online_exam_user_status`
  ADD PRIMARY KEY (`onlineExamUserStatus`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pagesID`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`parentsID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissionID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postsID`);

--
-- Indexes for table `posts_categories`
--
ALTER TABLE `posts_categories`
  ADD PRIMARY KEY (`posts_categoriesID`);

--
-- Indexes for table `posts_category`
--
ALTER TABLE `posts_category`
  ADD PRIMARY KEY (`posts_categoryID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`productcategoryID`);

--
-- Indexes for table `productpurchase`
--
ALTER TABLE `productpurchase`
  ADD PRIMARY KEY (`productpurchaseID`);

--
-- Indexes for table `productpurchaseitem`
--
ALTER TABLE `productpurchaseitem`
  ADD PRIMARY KEY (`productpurchaseitemID`);

--
-- Indexes for table `productpurchasepaid`
--
ALTER TABLE `productpurchasepaid`
  ADD PRIMARY KEY (`productpurchasepaidID`);

--
-- Indexes for table `productsale`
--
ALTER TABLE `productsale`
  ADD PRIMARY KEY (`productsaleID`);

--
-- Indexes for table `productsaleitem`
--
ALTER TABLE `productsaleitem`
  ADD PRIMARY KEY (`productsaleitemID`);

--
-- Indexes for table `productsalepaid`
--
ALTER TABLE `productsalepaid`
  ADD PRIMARY KEY (`productsalepaidID`);

--
-- Indexes for table `productsupplier`
--
ALTER TABLE `productsupplier`
  ADD PRIMARY KEY (`productsupplierID`);

--
-- Indexes for table `productwarehouse`
--
ALTER TABLE `productwarehouse`
  ADD PRIMARY KEY (`productwarehouseID`);

--
-- Indexes for table `promotionlog`
--
ALTER TABLE `promotionlog`
  ADD PRIMARY KEY (`promotionLogID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseID`);

--
-- Indexes for table `question_answer`
--
ALTER TABLE `question_answer`
  ADD PRIMARY KEY (`answerID`);

--
-- Indexes for table `question_bank`
--
ALTER TABLE `question_bank`
  ADD PRIMARY KEY (`questionBankID`);

--
-- Indexes for table `question_group`
--
ALTER TABLE `question_group`
  ADD PRIMARY KEY (`questionGroupID`);

--
-- Indexes for table `question_level`
--
ALTER TABLE `question_level`
  ADD PRIMARY KEY (`questionLevelID`);

--
-- Indexes for table `question_option`
--
ALTER TABLE `question_option`
  ADD PRIMARY KEY (`optionID`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`questionTypeID`);

--
-- Indexes for table `reset`
--
ALTER TABLE `reset`
  ADD PRIMARY KEY (`resetID`);

--
-- Indexes for table `routine`
--
ALTER TABLE `routine`
  ADD PRIMARY KEY (`routineID`);

--
-- Indexes for table `salary_option`
--
ALTER TABLE `salary_option`
  ADD PRIMARY KEY (`salary_optionID`);

--
-- Indexes for table `salary_template`
--
ALTER TABLE `salary_template`
  ADD PRIMARY KEY (`salary_templateID`);

--
-- Indexes for table `schoolyear`
--
ALTER TABLE `schoolyear`
  ADD PRIMARY KEY (`schoolyearID`);

--
-- Indexes for table `school_sessions`
--
ALTER TABLE `school_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`fieldoption`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`sliderID`);

--
-- Indexes for table `smssettings`
--
ALTER TABLE `smssettings`
  ADD PRIMARY KEY (`smssettingsID`);

--
-- Indexes for table `sociallink`
--
ALTER TABLE `sociallink`
  ADD PRIMARY KEY (`sociallinkID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `studentextend`
--
ALTER TABLE `studentextend`
  ADD PRIMARY KEY (`studentextendID`);

--
-- Indexes for table `studentgroup`
--
ALTER TABLE `studentgroup`
  ADD PRIMARY KEY (`studentgroupID`);

--
-- Indexes for table `studentrelation`
--
ALTER TABLE `studentrelation`
  ADD PRIMARY KEY (`studentrelationID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectID`);

--
-- Indexes for table `subjectteacher`
--
ALTER TABLE `subjectteacher`
  ADD PRIMARY KEY (`subjectteacherID`);

--
-- Indexes for table `sub_attendance`
--
ALTER TABLE `sub_attendance`
  ADD PRIMARY KEY (`attendanceID`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`syllabusID`);

--
-- Indexes for table `systemadmin`
--
ALTER TABLE `systemadmin`
  ADD PRIMARY KEY (`systemadminID`);

--
-- Indexes for table `tattendance`
--
ALTER TABLE `tattendance`
  ADD PRIMARY KEY (`tattendanceID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`themesID`);

--
-- Indexes for table `tmember`
--
ALTER TABLE `tmember`
  ADD PRIMARY KEY (`tmemberID`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`transportID`);

--
-- Indexes for table `uattendance`
--
ALTER TABLE `uattendance`
  ADD PRIMARY KEY (`uattendanceID`);

--
-- Indexes for table `update`
--
ALTER TABLE `update`
  ADD PRIMARY KEY (`updateID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`usertypeID`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorID`);

--
-- Indexes for table `visitorinfo`
--
ALTER TABLE `visitorinfo`
  ADD PRIMARY KEY (`visitorID`);

--
-- Indexes for table `weaverandfine`
--
ALTER TABLE `weaverandfine`
  ADD PRIMARY KEY (`weaverandfineID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activitiesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `activitiescategory`
--
ALTER TABLE `activitiescategory`
  MODIFY `activitiescategoryID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activitiescomment`
--
ALTER TABLE `activitiescomment`
  MODIFY `activitiescommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `activitiesmedia`
--
ALTER TABLE `activitiesmedia`
  MODIFY `activitiesmediaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `activitiesstudent`
--
ALTER TABLE `activitiesstudent`
  MODIFY `activitiesstudentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alert`
--
ALTER TABLE `alert`
  MODIFY `alertID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;
--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `assetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `asset_assignment`
--
ALTER TABLE `asset_assignment`
  MODIFY `asset_assignmentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asset_category`
--
ALTER TABLE `asset_category`
  MODIFY `asset_categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `assignmentanswer`
--
ALTER TABLE `assignmentanswer`
  MODIFY `assignmentanswerID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;
--
-- AUTO_INCREMENT for table `automation_rec`
--
ALTER TABLE `automation_rec`
  MODIFY `automation_recID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `automation_shudulu`
--
ALTER TABLE `automation_shudulu`
  MODIFY `automation_shuduluID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `certificate_template`
--
ALTER TABLE `certificate_template`
  MODIFY `certificate_templateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `childcare`
--
ALTER TABLE `childcare`
  MODIFY `childcareID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classesID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `complainID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `conversation_message_info`
--
ALTER TABLE `conversation_message_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `conversation_msg`
--
ALTER TABLE `conversation_msg`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `documentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `eattendance`
--
ALTER TABLE `eattendance`
  MODIFY `eattendanceID` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `ebooksID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `eventcounter`
--
ALTER TABLE `eventcounter`
  MODIFY `eventcounterID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `examID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `examschedule`
--
ALTER TABLE `examschedule`
  MODIFY `examscheduleID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expenseID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feetypes`
--
ALTER TABLE `feetypes`
  MODIFY `feetypesID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `fmenu`
--
ALTER TABLE `fmenu`
  MODIFY `fmenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fmenu_relation`
--
ALTER TABLE `fmenu_relation`
  MODIFY `fmenu_relationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `frontend_template`
--
ALTER TABLE `frontend_template`
  MODIFY `frontend_templateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `globalpayment`
--
ALTER TABLE `globalpayment`
  MODIFY `globalpaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `gradeID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `hmember`
--
ALTER TABLE `hmember`
  MODIFY `hmemberID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `holidayID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hostel`
--
ALTER TABLE `hostel`
  MODIFY `hostelID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hourly_template`
--
ALTER TABLE `hourly_template`
  MODIFY `hourly_templateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `idmanager`
--
ALTER TABLE `idmanager`
  MODIFY `idmanagerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `incomeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ini_config`
--
ALTER TABLE `ini_config`
  MODIFY `configID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `instruction`
--
ALTER TABLE `instruction`
  MODIFY `instructionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;
--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `issueID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `leaveapplications`
--
ALTER TABLE `leaveapplications`
  MODIFY `leaveapplicationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leaveassign`
--
ALTER TABLE `leaveassign`
  MODIFY `leaveassignID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `leavecategory`
--
ALTER TABLE `leavecategory`
  MODIFY `leavecategoryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lmember`
--
ALTER TABLE `lmember`
  MODIFY `lmemberID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loginlog`
--
ALTER TABLE `loginlog`
  MODIFY `loginlogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `mailandsms`
--
ALTER TABLE `mailandsms`
  MODIFY `mailandsmsID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `mailandsmstemplate`
--
ALTER TABLE `mailandsmstemplate`
  MODIFY `mailandsmstemplateID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mailandsmstemplatetag`
--
ALTER TABLE `mailandsmstemplatetag`
  MODIFY `mailandsmstemplatetagID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `maininvoice`
--
ALTER TABLE `maininvoice`
  MODIFY `maininvoiceID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `make_payment`
--
ALTER TABLE `make_payment`
  MODIFY `make_paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `manage_salary`
--
ALTER TABLE `manage_salary`
  MODIFY `manage_salaryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
  MODIFY `markID` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `markpercentage`
--
ALTER TABLE `markpercentage`
  MODIFY `markpercentageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `markrelation`
--
ALTER TABLE `markrelation`
  MODIFY `markrelationID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `mediaID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `media_category`
--
ALTER TABLE `media_category`
  MODIFY `mcategoryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media_gallery`
--
ALTER TABLE `media_gallery`
  MODIFY `media_galleryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `media_share`
--
ALTER TABLE `media_share`
  MODIFY `shareID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `noticeID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `onlineadmission`
--
ALTER TABLE `onlineadmission`
  MODIFY `onlineadmissionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `online_exam`
--
ALTER TABLE `online_exam`
  MODIFY `onlineExamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `online_exam_question`
--
ALTER TABLE `online_exam_question`
  MODIFY `onlineExamQuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `online_exam_type`
--
ALTER TABLE `online_exam_type`
  MODIFY `onlineExamTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `online_exam_user_answer`
--
ALTER TABLE `online_exam_user_answer`
  MODIFY `onlineExamUserAnswerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `online_exam_user_answer_option`
--
ALTER TABLE `online_exam_user_answer_option`
  MODIFY `onlineExamUserAnswerOptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `online_exam_user_status`
--
ALTER TABLE `online_exam_user_status`
  MODIFY `onlineExamUserStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pagesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `parentsID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permissionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=870;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts_categories`
--
ALTER TABLE `posts_categories`
  MODIFY `posts_categoriesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts_category`
--
ALTER TABLE `posts_category`
  MODIFY `posts_categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `productcategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `productpurchase`
--
ALTER TABLE `productpurchase`
  MODIFY `productpurchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productpurchaseitem`
--
ALTER TABLE `productpurchaseitem`
  MODIFY `productpurchaseitemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productpurchasepaid`
--
ALTER TABLE `productpurchasepaid`
  MODIFY `productpurchasepaidID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productsale`
--
ALTER TABLE `productsale`
  MODIFY `productsaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productsaleitem`
--
ALTER TABLE `productsaleitem`
  MODIFY `productsaleitemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productsalepaid`
--
ALTER TABLE `productsalepaid`
  MODIFY `productsalepaidID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productsupplier`
--
ALTER TABLE `productsupplier`
  MODIFY `productsupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `productwarehouse`
--
ALTER TABLE `productwarehouse`
  MODIFY `productwarehouseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `promotionlog`
--
ALTER TABLE `promotionlog`
  MODIFY `promotionLogID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `question_answer`
--
ALTER TABLE `question_answer`
  MODIFY `answerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `question_bank`
--
ALTER TABLE `question_bank`
  MODIFY `questionBankID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `question_group`
--
ALTER TABLE `question_group`
  MODIFY `questionGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `question_level`
--
ALTER TABLE `question_level`
  MODIFY `questionLevelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `question_option`
--
ALTER TABLE `question_option`
  MODIFY `optionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
  MODIFY `questionTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reset`
--
ALTER TABLE `reset`
  MODIFY `resetID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `routine`
--
ALTER TABLE `routine`
  MODIFY `routineID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `salary_option`
--
ALTER TABLE `salary_option`
  MODIFY `salary_optionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `salary_template`
--
ALTER TABLE `salary_template`
  MODIFY `salary_templateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `schoolyear`
--
ALTER TABLE `schoolyear`
  MODIFY `schoolyearID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sectionID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `sliderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `smssettings`
--
ALTER TABLE `smssettings`
  MODIFY `smssettingsID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sociallink`
--
ALTER TABLE `sociallink`
  MODIFY `sociallinkID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `studentextend`
--
ALTER TABLE `studentextend`
  MODIFY `studentextendID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `studentgroup`
--
ALTER TABLE `studentgroup`
  MODIFY `studentgroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `studentrelation`
--
ALTER TABLE `studentrelation`
  MODIFY `studentrelationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `subjectteacher`
--
ALTER TABLE `subjectteacher`
  MODIFY `subjectteacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
--
-- AUTO_INCREMENT for table `sub_attendance`
--
ALTER TABLE `sub_attendance`
  MODIFY `attendanceID` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `syllabusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `systemadmin`
--
ALTER TABLE `systemadmin`
  MODIFY `systemadminID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tattendance`
--
ALTER TABLE `tattendance`
  MODIFY `tattendanceID` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `themesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tmember`
--
ALTER TABLE `tmember`
  MODIFY `tmemberID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `transportID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uattendance`
--
ALTER TABLE `uattendance`
  MODIFY `uattendanceID` int(200) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `update`
--
ALTER TABLE `update`
  MODIFY `updateID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `usertypeID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `visitorinfo`
--
ALTER TABLE `visitorinfo`
  MODIFY `visitorID` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `weaverandfine`
--
ALTER TABLE `weaverandfine`
  MODIFY `weaverandfineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
