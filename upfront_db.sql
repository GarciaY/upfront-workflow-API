-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 07:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upfront_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acountingentry_tbl`
--

CREATE TABLE `acountingentry_tbl` (
  `accountingEntry_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `acc_code` text NOT NULL,
  `acc_title` text NOT NULL,
  `debit` text NOT NULL,
  `credit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acountingentry_tbl`
--

INSERT INTO `acountingentry_tbl` (`accountingEntry_id`, `v_id`, `acc_code`, `acc_title`, `debit`, `credit`) VALUES
(1, 2, '11210', 'Loan Receivable - Current (Salary Loan)', '50,000', ' '),
(2, 2, '11210', 'Loan Receivable - Current (Salary Loan)', ' ', ' '),
(3, 2, '40120', 'Service Fee Income ', ' ', '1,000'),
(4, 2, '30110', 'Subscribe Share-Capital Common', ' ', ' '),
(5, 2, '11130', 'Cash in bank(1572-1021-53)', ' ', '49,000');

-- --------------------------------------------------------

--
-- Table structure for table `adminacc_tbl`
--

CREATE TABLE `adminacc_tbl` (
  `admin_id` int(11) NOT NULL,
  `admin_name` text NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminacc_tbl`
--

INSERT INTO `adminacc_tbl` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'YURI ISMAEL R. GARCIA', 'yuri', '$2y$10$5M3fmkp1bN3rw4Zw/Y3UMear9am/MqJUyieUtyGXY2sQ808WP5roe');

-- --------------------------------------------------------

--
-- Table structure for table `loaninformation_tbl`
--

CREATE TABLE `loaninformation_tbl` (
  `loan_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `transactionType` text NOT NULL,
  `loanAmountFigure` int(11) NOT NULL,
  `loanAmountWords` text NOT NULL,
  `loanType` text NOT NULL,
  `loanTerm` text NOT NULL,
  `paymentFrequency` text NOT NULL,
  `loan_status` text NOT NULL DEFAULT 'Pending',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaninformation_tbl`
--

INSERT INTO `loaninformation_tbl` (`loan_id`, `personal_id`, `transactionType`, `loanAmountFigure`, `loanAmountWords`, `loanType`, `loanTerm`, `paymentFrequency`, `loan_status`, `created_at`) VALUES
(1, 1, 'NEW', 10000, 'TEN THOUSAND', 'SECURED LOAN', '6 months', 'SEMI-MONTHLY', 'Release', '2023-04-17'),
(2, 2, 'RENEWAL', 5000, 'FIVE THOUSAND', 'SALARY ASSISTANCE LOAN', '12 months', 'MONTHLY', 'Disapproved', '2023-05-17'),
(3, 3, 'RENEWAL', 4323, 'defgsefg', 'SALARY ASSISTANCE LOAN', '12 months', 'MONTHLY', 'Pending', '2023-04-17'),
(4, 4, 'NEW', 20000, 'Twenty Thousand Pesos', 'SALARY ASSISTANCE LOAN', '6 months', 'MONTHLY', 'Approved', '2023-04-18'),
(5, 5, 'NEW', 30000, 'Thirty Thousand Pesos', 'SALARY ASSISTANCE LOAN', '12 months', 'SEMI-MONTHLY', 'Release', '2023-04-18'),
(6, 6, 'NEW', 30000, 'Thirthy Thousand Pesos Only', 'SALARY ASSISTANCE LOAN', '12 months', 'SEMI-MONTHLY', 'Approved', '2023-04-18'),
(7, 7, 'NEW', 50000, 'Fifty Thousand', 'SALARY ASSISTANCE LOAN', '12 months', 'MONTHLY', 'Approved', '2023-04-18'),
(8, 8, 'NEW', 100000, 'One Hundred Thousand Pesos Only', 'CONSOLIDATED LOAN (CONSOL)', '18 months', 'MONTHLY', 'Pending', '2023-04-18'),
(9, 9, 'NEW', 40000, 'Forty Thousand Pesos Only', 'SALARY ASSISTANCE LOAN', '12 months', 'SEMI-MONTHLY', 'Pending', '2023-04-18'),
(10, 10, 'NEW', 15000, 'Fifteen Thousand Pesos Only', 'SALARY ASSISTANCE LOAN', '12 months', 'MONTHLY', 'Pending', '2023-04-18'),
(11, 11, 'NEW', 30000, 'Thirty Thousand Pesos Only', 'SALARY ASSISTANCE LOAN', '12 months', 'MONTHLY', 'Pending', '2023-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `not_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `title` text DEFAULT 'Pending',
  `content` text DEFAULT '\'Wait for admin to approve the loan.\'',
  `status` text DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notif`
--

INSERT INTO `notif` (`not_id`, `user_id`, `personal_id`, `title`, `content`, `status`, `created_at`) VALUES
(1, 3, 2, 'Disapproved', 'Your loan has been Disapproved. Please try again.', 'read', '2023-04-17 07:49:02'),
(2, 3, 1, 'Approved', 'Your loan has been approved.', 'read', '2023-04-17 07:50:02'),
(3, 3, 1, 'Release', 'Your loan has been released.', 'unread', '2023-04-17 08:20:08'),
(4, 2, 4, 'Approved', 'Your loan has been approved.', 'read', '2023-04-18 00:32:40'),
(5, 4, 5, 'Approved', 'Your loan has been approved.', 'read', '2023-04-18 00:47:32'),
(6, 4, 5, 'Release', 'Your loan has been released.', 'unread', '2023-04-18 00:47:46'),
(7, 5, 6, 'Approved', 'Your loan has been approved.', 'read', '2023-04-18 00:56:10'),
(8, 6, 7, 'Approved', 'Your loan has been approved.', 'unread', '2023-04-18 01:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `particular_tbl`
--

CREATE TABLE `particular_tbl` (
  `particular_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `comment1` text DEFAULT NULL,
  `comment2` text DEFAULT NULL,
  `comment3` text DEFAULT NULL,
  `ammount_due` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `particular_tbl`
--

INSERT INTO `particular_tbl` (`particular_id`, `v_id`, `comment1`, `comment2`, `comment3`, `ammount_due`) VALUES
(1, 1, 'To record replenishment of Petty Cash Fund', '', '', 'EIGHT THOUSAND SIX HUNDRED THIRTY SEVEN PESOS'),
(2, 2, 'To record renewal of salary loan of Jaime H. Menor Jr.', '', '', 'Forty Nine Thousand Pesos Only'),
(3, 3, '', '', '', 'TEN THOUSAND TWO HUNDRED EIGHTY FIVE PESOS AND 93/100 ONLY');

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `payment_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `Type_of_payment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`payment_id`, `v_id`, `Type_of_payment`) VALUES
(1, 1, 'Replenishment'),
(2, 2, 'Loan'),
(3, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `personaldata_tbl`
--

CREATE TABLE `personaldata_tbl` (
  `personal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Firstname` text NOT NULL,
  `Lastname` text NOT NULL,
  `PassbookNo` int(11) NOT NULL,
  `Address` text NOT NULL,
  `Department` text NOT NULL,
  `MobileNo` float NOT NULL,
  `personalMembership` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personaldata_tbl`
--

INSERT INTO `personaldata_tbl` (`personal_id`, `user_id`, `Firstname`, `Lastname`, `PassbookNo`, `Address`, `Department`, `MobileNo`, `personalMembership`) VALUES
(1, 3, 'Algen', 'Carian', 890, ' pinagpala Iram New Cabalan Olongapo City', 'CCS', 9954580000, 'Committee Member'),
(2, 3, 'Algen', 'Carian', 90806, 'hindi na pinagpala olongapo city', 'CHTM', 9587230000, 'Officer'),
(3, 3, 'Algen', 'Carian', 232, 'Pinabayaan ng dyios', 'sfadfg', 904980000, 'Regular Member'),
(4, 2, 'Yuri', 'Garcia', 438, 'Blk 12 Lot 5 Maalam St. FCI Castelliejos', 'CCS', 90623000000, 'Officer'),
(5, 4, 'Johanna D.', 'Munoz', 18010198, '15 National Highway Pamatawan', 'LEGAL', 956879000, 'Committee Member'),
(6, 5, 'Arlene C.', 'Paragwa', 19030225, '#007 Magsaysay St. San Pablo Castillejos Zambales', 'MTD, Transportation Division', 9996990000, 'Regular Member'),
(7, 6, 'Jaime H.', 'Menor', 12050131, 'Purok 6 Bato-Bato St. New Cabalan O.C.', 'OSD', 2524190, 'Officer'),
(8, 7, 'Michelle Angela', 'Lumanta', 16040168, 'Prk. 6 National Highway New Cabalan Olongapo City', 'Public Relations Office', 9190030000, 'Officer'),
(9, 8, 'Agelio C.', 'Sangalang JR.', 10030120, '28 Burgos St. Wawandue Subic, Zambales', 'FPBD', 9094000000, 'Officer'),
(10, 9, 'Raquel R.', 'Garcia', 16040167, 'Blk 12 Lot 5 Maalam St., FCI, Del Pilar Castilliejos Zambales', 'Treasury', 20524400, 'Officer'),
(11, 10, 'Cielito C.', 'Fabros', 99080038, '#150 Lapaz St., Brgy. Santiago, San Antonio, Zambales', 'Associate', 9102210000, 'Regular Member');

-- --------------------------------------------------------

--
-- Table structure for table `signature_tbl`
--

CREATE TABLE `signature_tbl` (
  `signature_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `approved_by` text NOT NULL,
  `received_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signature_tbl`
--

INSERT INTO `signature_tbl` (`signature_id`, `v_id`, `approved_by`, `received_by`) VALUES
(1, 1, 'NORA P. SEVILLEJO', 'RICHARD M. CARINO'),
(2, 2, 'NORA P. SEVILLEJO', 'JAMIE H. MENOR JR.'),
(3, 3, 'JAIME H. MENOR', 'MARILYN R. CAPISTRANO');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `firstname`, `lastname`, `email`, `password`) VALUES
(2, 'Yuri', 'Garcia', 'yuri@gmail.com', '$2y$10$JCXcLGpnNqED7riLEVzufO4iIbc/njy2i3S6VbyN5Ma94Jk5he5nK'),
(3, 'Algen', 'Carian', 'algen@gmail.com', '$2y$10$Z4EY6dtcBnhdpXKoDuKRwuoI2ejgXSGnMWpxbPAln6YH1sOH8HlhG'),
(4, 'Johanna D.', 'Munoz', 'johanna.munoz@gmail.com', '$2y$10$ix7CYU/0IYP7FAg2WhSlC.HtZ4Uwv/UdqUo2hBVt8v4BBLUqK78iu'),
(5, 'Arlene C.', 'Paragwa', 'arlene.paragwa@gmail.com', '$2y$10$8y0pMuaKF2UrIL5kPbcYfubknvzrZx2EUJmKWgqyojW30rxgFj3qS'),
(6, 'Jaime H.', 'Menor', 'jaime.menor@gmail.com', '$2y$10$A6mkBvuppaTpYj0uYKnJW.H0kVrSiwA2kNtwBKszOG2.pomP8UlAO'),
(7, 'Michelle Angela', 'Lumanta', 'michelle.lumanta@gmail.com', '$2y$10$Z6AYB.0zmVWfRA1jFUHz4.jH3kGbL3ZmXBtR07ZvyGUA85rSf60ua'),
(8, 'Agelio C.', 'Sangalang JR.', 'agelio.sangalang@gmail.com', '$2y$10$0DUyQ9ln8ccnlvXXFmcGx.lC0/WtUV11X25CYL0DAY2BnLPrsaWze'),
(9, 'Raquel R.', 'Garcia', 'raqs.garcia@gmail.com', '$2y$10$cyu6wYSUQM/lkabjbHfYf.1BGuae6Qy0c4nczsqcUP1rPiivL4LE6'),
(10, 'Cielito C.', 'Fabros', 'cielito.fabros@gmail.com', '$2y$10$6JMTFCrwnZzoaRAsyH4uaONNBKReU5LCa9eQahq.bFwilF.l5iz1.');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_tbl`
--

CREATE TABLE `voucher_tbl` (
  `voucher_id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `date` text NOT NULL,
  `payee` text NOT NULL,
  `address` text NOT NULL,
  `SoF` text NOT NULL,
  `type` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher_tbl`
--

INSERT INTO `voucher_tbl` (`voucher_id`, `user_id`, `date`, `payee`, `address`, `SoF`, `type`, `status`) VALUES
(1, 'DV2023-019', 'March 31, 2023', 'RICHARD M. CARINO', 'C/O B229, WATERFRONT RD., SBFZ', 'LBP CA# 1572-1021-53', 'DISBURSEMENT VOUCHER CASH/CHECK', 'Pending'),
(2, 'DV2023-021', 'March 22, 2023', 'JAIME H. MENOR JR.', 'Purok 6 Bato-Bato St., New Cabalan, Olongapo City', 'LBP CA# 1572-1021-53', 'DISBURSEMENT VOUCHER CASH/CHECK', 'Pending'),
(3, 'DV2023-018', 'March 21, 2023', 'Marilyn R. Capistrano', '', 'LBP CA# 1572-1021-53', 'DISBURSEMENT VOUCHER CASH/CHECK', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acountingentry_tbl`
--
ALTER TABLE `acountingentry_tbl`
  ADD PRIMARY KEY (`accountingEntry_id`);

--
-- Indexes for table `adminacc_tbl`
--
ALTER TABLE `adminacc_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `loaninformation_tbl`
--
ALTER TABLE `loaninformation_tbl`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`not_id`);

--
-- Indexes for table `particular_tbl`
--
ALTER TABLE `particular_tbl`
  ADD PRIMARY KEY (`particular_id`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `personaldata_tbl`
--
ALTER TABLE `personaldata_tbl`
  ADD PRIMARY KEY (`personal_id`);

--
-- Indexes for table `signature_tbl`
--
ALTER TABLE `signature_tbl`
  ADD PRIMARY KEY (`signature_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `voucher_tbl`
--
ALTER TABLE `voucher_tbl`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acountingentry_tbl`
--
ALTER TABLE `acountingentry_tbl`
  MODIFY `accountingEntry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `adminacc_tbl`
--
ALTER TABLE `adminacc_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loaninformation_tbl`
--
ALTER TABLE `loaninformation_tbl`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `particular_tbl`
--
ALTER TABLE `particular_tbl`
  MODIFY `particular_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personaldata_tbl`
--
ALTER TABLE `personaldata_tbl`
  MODIFY `personal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `signature_tbl`
--
ALTER TABLE `signature_tbl`
  MODIFY `signature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `voucher_tbl`
--
ALTER TABLE `voucher_tbl`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
