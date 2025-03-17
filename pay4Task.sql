-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2025 at 03:23 PM
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
-- Database: `pay4Task`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_requests`
--

CREATE TABLE `activation_requests` (
  `request_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `receipt_id` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `datetime` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activation_requests`
--

INSERT INTO `activation_requests` (`request_id`, `user_id`, `receipt_id`, `status`, `datetime`) VALUES
(321396561, 461138412, '1LVpC9UQDjaiKpyUBvf72PFLnldZkC_xn', 1, 1741082618);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `name` text DEFAULT NULL,
  `device` longtext DEFAULT NULL,
  `date_added` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `device`, `date_added`, `status`) VALUES
(481849165, '', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Mobile Safari/537.36::1', 1741007040, 1),
(577558168, 'Melvin Chrome (Main)', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36::1', 1738416787, 1),
(715538310, '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15::1', 1739324580, 1),
(965219893, '', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36::1', 1739939279, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_review`
--

CREATE TABLE `admin_review` (
  `request_id` bigint(20) NOT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `expiration_time` bigint(20) DEFAULT NULL,
  `request_date` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` bigint(20) NOT NULL,
  `text` text DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `category` text DEFAULT NULL,
  `datetime` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `text`, `user_id`, `status`, `category`, `datetime`) VALUES
(112334837, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035718),
(123263091, 'Proof successfully submitted task id: 432027992', 461138412, 1, 'task completion', 1740063971),
(126145514, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740834614),
(133798044, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740481993),
(146889621, 'Referral reward + P50 earning', 392745591, 1, 'account earning', 1741018169),
(147602217, 'Upgrade request was declined!', 392745591, 1, 'account', 1741015990),
(154699893, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740673447),
(155955594, 'Task completion declined! task id: 217483574', 461138412, 1, 'task', 1740400196),
(167723930, 'Referral reward + P50 earning', 392745591, 1, 'account earning', 1741018506),
(170850446, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058224),
(175414676, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740408048),
(179193253, 'Account successfully upgraded! +10 energy', 140751437, 1, 'energy account', 1741016653),
(190884568, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035718),
(192418108, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035717),
(197776459, 'Account successfully upgraded! +10 energy', 461138412, 1, 'energy account', 1741018461),
(202361432, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1741016186),
(206931677, 'Task completion approved! task id: 217483574', 461138412, 1, 'wallet earning energy', 1740407248),
(207535054, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058211),
(211009890, 'Referral reward + P50 earning', 392745591, 1, 'account earning', 1741018461),
(218104474, 'Task completion declined! task id: 217483574', 392745591, 1, 'task', 1740407389),
(224042521, 'Referral reward + P50 earning', 392745591, 1, 'account earning', 1741018178),
(232375895, 'Referral reward + P50 earning', 392745591, 1, 'account earning', 1741017945),
(234650772, 'Task completion declined! task id: 217483574', 140751437, 1, 'task', 1740486292),
(240077115, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058653),
(241530000, 'Task completion declined! task id: 432027992', 392745591, 1, 'task', 1740407385),
(252010371, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740057960),
(260545793, 'Account successfully upgraded! +10 energy', 140751437, 1, 'energy account', 1741017945),
(262700036, 'Successfully request for account activation.', 461138412, 1, 'account', 1741007264),
(262811223, 'Daily energy reward succesfully claimed!', 392745591, 1, 'energy accoun', 1740289144),
(264275140, 'Successfully created an account!', 140751437, 1, 'profile account', 1739604716),
(265003148, 'Task completion approved! task id: 217483574', 392745591, 1, 'wallet earning energy', 1740407963),
(274074401, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1741082468),
(275826720, 'Proof successfully submitted task id: 217483574', 140751437, 1, 'task completion', 1740486135),
(282356522, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035717),
(291700427, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740316840),
(338287834, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740530811),
(341958237, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035526),
(377700808, 'Daily energy reward succesfully claimed!', 392745591, 1, 'energy accoun', 1740975831),
(382064384, 'Account successfully upgraded! +10 energy', 461138412, 1, 'energy account', 1741016038),
(384939416, 'Successfully request for account activation.', NULL, 1, 'account', 1740975505),
(390851529, 'Successfully request for account activation.', NULL, 1, 'account', 1740975359),
(401076459, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035568),
(429601125, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058221),
(429669234, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035722),
(440199315, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1741017829),
(441518360, 'Tranfer successfully requested!', 461138412, 1, 'earning transfer', 1740673899),
(442980944, 'Transfer request successfully approved!', 461138412, 1, 'transfer account', 1740835890),
(446655166, 'Transfer request successfully approved!', 461138412, 1, 'transfer account', 1740836106),
(448867310, 'Daily energy reward succesfully claimed!', 392745591, 1, 'energy accoun', 1740488193),
(471014111, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1741082603),
(471639989, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740488246),
(479087721, 'Daily energy reward succesfully claimed!', 392745591, 1, 'energy accoun', 1740401720),
(494730071, 'Proof successfully submitted task id: 432027992', 392745591, 1, 'task completion', 1740407366),
(511982407, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058231),
(524491967, 'Account successfully upgraded! +10 energy', 461138412, 1, 'energy account', 1741082669),
(532298850, 'Successfully request for account activation.', 461138412, 1, 'account', 1741082618),
(537191910, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035719),
(538577817, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035719),
(546770500, 'Task completion approved! task id: 432027992', 392745591, 1, 'wallet earning energy', 1740407957),
(547704424, 'Referral reward + P50 earning', 392745591, 1, 'account earning', 1741082669),
(556279449, 'Successfully request for account activation.', 461138412, 1, 'account', 1740975726),
(559970852, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1741082033),
(565520115, 'Transfer amount refund ₱5.00', 461138412, 1, 'transfer account', 1740835830),
(567809132, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035718),
(572173614, 'Account successfully upgraded! +10 energy', 140751437, 1, 'energy account', 1741018178),
(574101215, 'Proof successfully submitted task id: 217483574', 392745591, 1, 'task completion', 1740407847),
(581998284, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058218),
(588575147, 'Proof successfully submitted task id: 806986011', 461138412, 1, 'task completion', 1740317653),
(596581750, 'Successfully request for account activation.', NULL, 1, 'account', 1740975375),
(601207388, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035722),
(614062282, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035539),
(626700469, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035888),
(626938037, 'Tranfer successfully requested!', 461138412, 1, 'earning transfer', 1740674822),
(629967097, 'Successfully request for account activation.', 392745591, 1, 'account', 1741001019),
(639241726, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035723),
(643927646, 'Account successfully upgraded! +10 energy', 461138412, 1, 'energy account', 1741018169),
(645589686, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058297),
(655690323, 'Task completion approved! task id: 432027992', 461138412, 1, 'wallet earning energy', 1740401434),
(669126161, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058228),
(679658429, 'Daily energy reward succesfully claimed!', 392745591, 1, 'energy accoun', 1741088353),
(680894728, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035714),
(680926568, 'Tranfer successfully requested!', 461138412, 1, 'earning transfer', 1740836090),
(685441106, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740036095),
(718580535, 'Tranfer successfully requested!', 461138412, 1, 'earning transfer', 1740674011),
(744168779, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740635501),
(744182470, 'Tranfer successfully requested!', 461138412, 1, 'earning transfer', 1740673742),
(745860187, 'Daily energy reward succesfully claimed!', 392745591, 1, 'energy accoun', 1740035914),
(749225028, 'Successfully request for account activation.', 392745591, 1, 'account', 1741006027),
(755213720, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035853),
(761322317, 'Account successfully upgraded! +10 energy', 461138412, 1, 'energy account', 1741017613),
(782077726, 'Account successfully upgraded! +10 energy', 140751437, 1, 'energy account', 1741018506),
(810079063, 'Account successfully upgraded! +10 energy', 461138412, 1, 'energy account', 1741016410),
(812599814, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740407093),
(817333406, 'Successfully created an account!', 461138412, 1, 'profile account', 1739622440),
(831633536, 'Thetemplateshoppp use your referral code.', 392745591, 1, 'referral', 1739622440),
(856683089, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740368513),
(884725359, 'Successfully request for account activation.', 392745591, 1, 'account', 1740975855),
(888208767, 'Daily energy reward succesfully claimed!', 140751437, 1, 'energy accoun', 1740035722),
(898318781, 'Account successfully upgraded! +10 energy', 140751437, 1, 'energy account', 1741016270),
(916815712, 'Successfully request for account activation.', 140751437, 1, 'account', 1741016210),
(943759319, 'Proof successfully submitted task id: 217483574', 392745591, 1, 'task completion', 1740407355),
(962450746, 'Proof successfully submitted task id: 432027992', 392745591, 1, 'task completion', 1740407860),
(982730885, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740317555),
(983956049, 'Tranfer successfully requested!', 461138412, 1, 'earning transfer', 1740673950),
(989984359, 'Failed to process transfer request!', 461138412, 1, 'transfer account', 1740835830),
(995777946, 'Daily energy reward succesfully claimed!', 461138412, 1, 'energy accoun', 1740970472),
(996728797, 'Proof successfully submitted task id: 217483574', 461138412, 1, 'task completion', 1740058214);

-- --------------------------------------------------------

--
-- Table structure for table `pending_verification_accounts`
--

CREATE TABLE `pending_verification_accounts` (
  `verification_id` bigint(20) NOT NULL,
  `otp_code` int(11) NOT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `submission` bigint(20) DEFAULT NULL,
  `expired` bigint(20) DEFAULT NULL,
  `user_name` text DEFAULT NULL,
  `referral_used` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_verification_accounts`
--

INSERT INTO `pending_verification_accounts` (`verification_id`, `otp_code`, `email`, `password`, `submission`, `expired`, `user_name`, `referral_used`) VALUES
(128895639, 1345, 'arseniogstn@gmail.com', '', 1739604716, 1739605316, 'MLVN MUSIClife', 333096062),
(210210639, 4861, 'agustinmlvn1230@gmail.com', '', 1739416555, 1739417155, 'Melvin Agustin', 581178718),
(215198130, 5895, 'agustinmlvn1230@gmail.com', '', 1739415741, 1739416341, 'Melvin Agustin', 581178718),
(245516983, 5106, 'agustinmlvn1230@gmail.com', '', 1739327294, 1739327894, 'Melvin Agustin', -1),
(276346056, 3285, 'agustinmlvn1230@gmail.com', '', 1739327359, 1739327959, 'Melvin Agustin', -1),
(287309431, 8826, 'agustinmlvn1230@gmail.com', '', 1739327804, 1739328404, 'Melvin Agustin', -1),
(297632256, 9805, 'agustinmlvn1230@gmail.com', '', 1739327132, 1739327732, 'Melvin Agustin', -1),
(305439988, 3022, 'agustinmlvn1230@gmail.com', '', 1739530862, 1739531462, 'Melvin Agustin', -1),
(370848616, 5565, 'agustinmlvn1230@gmail.com', '', 1739434281, 1739434881, 'Melvin Agustin', -1),
(403228349, 2167, 'agustinmlvn1230@gmail.com', '', 1739326859, 1739327459, 'Melvin Agustin', 847627704),
(413858791, 8104, 'agustinmlvn1230@gmail.com', '', 1739326820, 1739327420, 'Melvin Agustin', -1),
(453306903, 2247, 'agustinmlvn1230@gmail.com', 'Agustin@12', 1739426074, 1739426674, '', -1),
(453951407, 2835, 'agustinmlvn1230@gmail.com', '', 1739327048, 1739327648, 'Melvin Agustin', -1),
(492579351, 3635, 'agustinmlvn1230@gmail.com', '', 1739412372, 1739412972, 'Melvin Agustin', 581178718),
(493628673, 5890, 'thetemplateshoppp@gmail.com', '', 1739602917, 1739603517, 'Thetemplateshoppp', 333096062),
(569118545, 5318, 'arseniogstn@gmail.com', '', 1739412400, 1739413000, 'MLVN MUSIClife', 581178718),
(623851395, 3801, 'arseniogstn@gmail.com', '', 1739457045, 1739457645, 'MLVN MUSIClife', -1),
(645723052, 7245, 'agustinmlvn1230@gmail.com', '', 1739531019, 1739531619, 'Melvin Agustin', -1),
(682027832, 9170, 'agustinarsenio122@gmail.com', 'Agustin@12', 1739327933, 1739328533, '', 581178718),
(718510752, 7330, 'agustinmlvn1230@gmail.com', '', 1739327198, 1739327798, 'Melvin Agustin', -1),
(718753345, 3871, 'thetemplateshoppp@gmail.com', '', 1739449835, 1739450435, 'Thetemplateshoppp', -1),
(721048467, 5423, 'arseniogstn@gmail.com', '', 1739434308, 1739434908, 'MLVN MUSIClife', -1),
(728152855, 1578, 'agustinarsenio122@gmail.com', 'Agustin@12', 1739426120, 1739426720, '', -1),
(743119444, 6699, 'arseniogstn@gmail.com', '', 1739327835, 1739328435, 'MLVN MUSIClife', 581178718),
(745252070, 6191, 'websitetemplate600@gmail.com', 'Agustin@12', 1739449897, 1739450497, '', -1),
(768303081, 1519, 'arseniogstn@gmail.com', '', 1739604628, 1739605228, 'MLVN MUSIClife', 333096062),
(785296093, 8895, 'agustinmlvn1230@gmail.com', '', 1739531438, 1739532038, 'Melvin Agustin', -1),
(786224492, 5233, 'thetemplateshoppp@gmail.com', '', 1739622440, 1739623040, 'Thetemplateshoppp', 333096062),
(956748710, 2637, 'arseniogstn@gmail.com', '', 1739326877, 1739327477, 'MLVN MUSIClife', 847627704);

-- --------------------------------------------------------

--
-- Table structure for table `system_control`
--

CREATE TABLE `system_control` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_control`
--

INSERT INTO `system_control` (`id`, `name`, `value`) VALUES
(1, 'System Maintenance', '0');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` bigint(20) NOT NULL,
  `task_instruction` text DEFAULT NULL,
  `created_datetime` bigint(20) DEFAULT NULL,
  `expiration` bigint(20) DEFAULT NULL,
  `task_app` text DEFAULT NULL,
  `task_link` text DEFAULT NULL,
  `task_img` text DEFAULT NULL,
  `task_reward` decimal(50,2) DEFAULT NULL,
  `max_reward` decimal(50,2) DEFAULT NULL,
  `overall_spent` decimal(50,2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_instruction`, `created_datetime`, `expiration`, `task_app`, `task_link`, `task_img`, `task_reward`, `max_reward`, `overall_spent`, `status`) VALUES
(217483574, 'Like this post', 1739982973, -1, 'facebook', 'https://web.facebook.com/share/v/15Htp9zaXf/', '1iho9MArFHAweST0ON2stqu6EZgr9HfxS', 0.50, 100.00, 0.50, 1),
(432027992, 'Follow a Sporadic Tv', 1739938464, -1, 'facebook', 'https://www.facebook.com/sporadictv', '1S6avhC1IfADLpSuKnaYb5-3t_UwVog4R', 1.00, 100.00, 1.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_submission`
--

CREATE TABLE `task_submission` (
  `submission_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `task_id` bigint(20) DEFAULT NULL,
  `date_submitted` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `proof_file_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_submission`
--

INSERT INTO `task_submission` (`submission_id`, `user_id`, `task_id`, `date_submitted`, `status`, `proof_file_id`) VALUES
(250642949, 392745591, 217483574, 1740407847, 1, '1VBsfZ1zaYfpcnPjNx1na157w4bOe_weL'),
(255089771, 461138412, 432027992, 1740063971, 1, '1g3crf5Tmlko6XTi4xfW0hazC9fu2usnO'),
(281524186, 392745591, 432027992, 1740407860, 1, '12Aqgz5zmhcoVhJzhDCtaSZYf4C_jZy8X'),
(483998405, 392745591, 432027992, 1740407366, -1, '1L2ytpdBf1y9Q-lVeTUOsqYcL4zyAV_wl'),
(659522824, 461138412, 806986011, 1740317653, -1, '1dSorhpMxHWobqYmV70fvt9BzF0hnQSEI'),
(759681176, 461138412, 217483574, 1740407093, 1, '1Ce91dfWpe5R2sINHphHeNRUZgBmFHcti'),
(782171049, 392745591, 217483574, 1740407355, -1, '1xkhN39oOYtwJl3w-v0s2I8qhNNyxenrN'),
(871696392, 461138412, 217483574, 1740058653, -1, '12ExnshtdvLf6TZqcLINvTneiYCHyAVI8'),
(997922546, 140751437, 217483574, 1740486135, -1, '1Qsdl7n3d46QgFVnQTDomzww_-BihPXie');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_request`
--

CREATE TABLE `transfer_request` (
  `request_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `method` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `amount` decimal(50,2) DEFAULT NULL,
  `request_date` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_request`
--

INSERT INTO `transfer_request` (`request_id`, `user_id`, `method`, `account`, `amount`, `request_date`, `status`) VALUES
(148448172, 461138412, 'paypal', 'agustinmlvn1230@gmail.com', 8.00, 1740674822, 1),
(259078612, 461138412, 'gcash', '09664525291 - melvin agustin', 5.00, 1740674011, -1),
(338976661, 461138412, 'paypal', 'agustinmlvn1230@gmail.com', 5.00, 1740836090, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `referral_code` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `registration_date` bigint(20) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `referral_used` bigint(20) DEFAULT NULL,
  `last_claim` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `referral_code`, `status`, `registration_date`, `password`, `referral_used`, `last_claim`) VALUES
(140751437, 'MLVN MUSIClife', 'arseniogstn@gmail.com', 217070297, 0, 1739604716, '', 333096062, 63),
(392745591, 'Melvin Agustin', 'agustinmlvn1230@gmail.com', 333096062, 0, 1739416555, 'Agustin@12', -1, 63),
(461138412, 'Thetemplateshoppp', 'thetemplateshoppp@gmail.com', 747018610, 1, 1739622440, '', 333096062, 63);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `earning` decimal(50,2) DEFAULT NULL,
  `referral_commision` decimal(50,2) DEFAULT NULL,
  `energy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `user_id`, `earning`, `referral_commision`, `energy`) VALUES
(387243568, 392745591, 50.00, 0.00, 3),
(451677842, 461138412, 0.00, 0.00, 13),
(563097201, 140751437, 0.00, 0.00, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_requests`
--
ALTER TABLE `activation_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `device` (`device`(255)) USING HASH;

--
-- Indexes for table `admin_review`
--
ALTER TABLE `admin_review`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `pending_verification_accounts`
--
ALTER TABLE `pending_verification_accounts`
  ADD PRIMARY KEY (`verification_id`),
  ADD UNIQUE KEY `otp_code` (`otp_code`);

--
-- Indexes for table `system_control`
--
ALTER TABLE `system_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `task_submission`
--
ALTER TABLE `task_submission`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `transfer_request`
--
ALTER TABLE `transfer_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `system_control`
--
ALTER TABLE `system_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
