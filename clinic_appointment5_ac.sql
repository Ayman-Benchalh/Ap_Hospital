-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2024 at 11:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_pass` varchar(255) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_token` varchar(255) NOT NULL,
  `admin_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_pass`, `admin_email`, `admin_token`, `admin_registered`) VALUES
(3, 'Ayman', 'NCdeQIuc4GXxO3xFGTtSoFqp9vbCsHMRgt259n5OpEPNLzfhQ1+VQnRuFIfwVgLY', 'Aymanbenchalh53@gmail.com', '2717633276573949455342', '2024-08-15 18:42:50'),
(4, 'Ritechco', 'smCWlOyHioH1YqhU3sCNYVTrWfKk4U1+ds7zoEmBTYLDeDXY3oWL8/5uID0DUxei', 'Ritechco.ma@gmail.com', '5314421797875317192795', '2024-08-19 07:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `ann_id` int NOT NULL,
  `ann_title` varchar(255) NOT NULL,
  `ann_content` text NOT NULL,
  `date_created` datetime NOT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `app_id` int NOT NULL,
  `app_date` date NOT NULL,
  `app_time` varchar(255) NOT NULL,
  `treatment_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `patient_id` varchar(50) NOT NULL,
  `doctor_id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `doctor_ext` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` int NOT NULL COMMENT '1: Confirm, 0: Not Confirm',
  `consult_status` int NOT NULL COMMENT '1: Visited 0: None',
  `arrive_status` int NOT NULL COMMENT '1: Arrived 0: None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`app_id`, `app_date`, `app_time`, `treatment_type`, `patient_id`, `doctor_id`, `clinic_id`, `doctor_ext`, `status`, `consult_status`, `arrive_status`) VALUES
(89, '2024-09-24', '09:00 AM', NULL, 'XA78555', 4, 6, NULL, 1, 0, 0),
(90, '2024-09-24', '09:30 AM', NULL, 'XA755224', 4, 6, NULL, 1, 0, 0),
(91, '2024-09-24', '1:00 PM', NULL, 'XA78555', 4, 6, NULL, 1, 0, 0),
(92, '2024-09-24', '3:00 PM', NULL, 'XA78555', 4, 6, NULL, 1, 0, 0),
(93, '2024-09-24', '11:30 AM', NULL, '', 4, 6, NULL, 1, 0, 0),
(94, '2024-09-24', '12:00 PM', NULL, 'XA700444', 4, 6, NULL, 1, 0, 0),
(95, '2024-09-24', '3:30 PM', NULL, 'XA44111', 4, 6, NULL, 1, 0, 0),
(96, '2024-09-25', '1:30 PM', NULL, 'XA139303', 4, 6, NULL, 1, 0, 0),
(97, '2024-09-25', '10:00 AM', NULL, 'XA100452', 4, 6, NULL, 1, 0, 1),
(98, '2024-09-25', '3:00 PM', NULL, 'XA178546', 4, 6, NULL, 1, 0, 1),
(99, '2024-10-01', '1:00 PM', NULL, 'XA178546', 4, 6, NULL, 1, 0, 0),
(100, '2024-10-01', '12:30 PM', NULL, 'XA78555', 4, 6, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `business_hour`
--

CREATE TABLE `business_hour` (
  `businesshour_id` int NOT NULL,
  `open_week` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `close_week` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `open_sat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `close_sat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `open_sun` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `close_sun` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_hour`
--

INSERT INTO `business_hour` (`businesshour_id`, `open_week`, `close_week`, `open_sat`, `close_sat`, `open_sun`, `close_sun`, `clinic_id`) VALUES
(4, '9:00 PM', '6:00 AM', '9:00 PM', '3:00 AM', '9:00 PM', '3:00 PM', 6);

-- --------------------------------------------------------

--
-- Table structure for table `clinics`
--

CREATE TABLE `clinics` (
  `clinic_id` int NOT NULL,
  `clinic_name` varchar(255) NOT NULL,
  `clinic_email` varchar(255) NOT NULL,
  `clinic_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `clinic_contact` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `clinic_address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `clinic_city` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `clinic_state` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `clinic_zipcode` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `clinic_status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinics`
--

INSERT INTO `clinics` (`clinic_id`, `clinic_name`, `clinic_email`, `clinic_url`, `clinic_contact`, `clinic_address`, `clinic_city`, `clinic_state`, `clinic_zipcode`, `clinic_status`, `date_created`) VALUES
(5, 'RAHMA', 'RahmaClinic@gmail.com', 'https://www.rahmaClinic.com', '0710317523', 'amical andalouse sud n 529 tiflet', 'Tiflat, Rabat-Sale-Zammour-Zaer, Morocco', 'Johor', '15400', '1', '2024-08-15 19:02:46'),
(6, 'CabinetChaibi', 'chaibikine@gmail.com', 'www.cabinetchaibi.ma', '0666741666', 'Cabinet Chaibi', 'Tiflet', 'Johor', '15400', '1', '2024-08-18 23:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `clinic_images`
--

CREATE TABLE `clinic_images` (
  `clinicimg_id` int NOT NULL,
  `clinicimg_filename` varchar(255) NOT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic_images`
--

INSERT INTO `clinic_images` (`clinicimg_id`, `clinicimg_filename`, `clinic_id`) VALUES
(1, '2150010125.jpg', 5),
(2, 'png-logo-89380-01.png', 6),
(3, 'PP_05.jpg', 6),
(4, 'PP_04.jpg', 6),
(5, 'PP_03.jpg', 6),
(6, 'PP_09.jpg', 6),
(7, 'PP_02.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_manager`
--

CREATE TABLE `clinic_manager` (
  `clinicadmin_id` int NOT NULL,
  `clinicadmin_name` varchar(255) NOT NULL,
  `clinicadmin_password` varchar(255) NOT NULL,
  `clinicadmin_token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `clinicadmin_email` varchar(255) NOT NULL,
  `clinicadmin_contact` varchar(15) NOT NULL,
  `date_created` datetime NOT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic_manager`
--

INSERT INTO `clinic_manager` (`clinicadmin_id`, `clinicadmin_name`, `clinicadmin_password`, `clinicadmin_token`, `clinicadmin_email`, `clinicadmin_contact`, `date_created`, `clinic_id`) VALUES
(4, 'RahmaCLinic', '$2y$10$DZ2vtHDAxEirKKwye1D9Wu1uBlRMJtHbA4GQvOXKD4VZRGLE6rh/a', NULL, 'RahmaClinic@gmail.com', '0710317523', '2024-08-15 19:02:46', 5),
(5, 'CabinetChaibi', '$2y$10$Jql8z9Omw6G96RYm2V.48uemSGUTxkH9WU/O7iTilFaiGhh71PPYC', NULL, 'chaibikine@gmail.com', '0666741666', '2024-08-18 23:39:49', 6);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_reset`
--

CREATE TABLE `clinic_reset` (
  `reset_id` int NOT NULL,
  `reset_email` varchar(255) NOT NULL,
  `reset_selector` text NOT NULL,
  `reset_token` longtext NOT NULL,
  `reset_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clinic_service`
--

CREATE TABLE `clinic_service` (
  `id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `Nom_Servic` varchar(255) NOT NULL,
  `Price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clinic_service`
--

INSERT INTO `clinic_service` (`id`, `clinic_id`, `Nom_Servic`, `Price`) VALUES
(1, 6, 'Rééducation Post-Opératoire', 150),
(2, 6, 'Traitement des blessures sportives', 207),
(3, 6, 'Thérapie manuelle', 141),
(4, 6, 'Rééducation neurologique', 144),
(5, 6, 'Rééducation respiratoire', 143),
(6, 6, 'Rééducation périnéale', 150),
(7, 6, 'Traitement des douleurs chroniques', 270);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int NOT NULL,
  `doctor_avatar` varchar(255) NOT NULL,
  `doctor_firstname` varchar(255) NOT NULL,
  `doctor_lastname` varchar(255) NOT NULL,
  `doctor_speciality` varchar(255) NOT NULL,
  `doctor_experience` varchar(10) NOT NULL,
  `doctor_desc` text NOT NULL,
  `doctor_password` varchar(255) NOT NULL,
  `doctor_token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `doctor_spoke` varchar(255) NOT NULL,
  `doctor_gender` varchar(10) NOT NULL,
  `doctor_dob` date NOT NULL,
  `doctor_email` varchar(255) NOT NULL,
  `doctor_contact` varchar(15) NOT NULL,
  `consult_fee` int NOT NULL,
  `date_created` datetime NOT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_avatar`, `doctor_firstname`, `doctor_lastname`, `doctor_speciality`, `doctor_experience`, `doctor_desc`, `doctor_password`, `doctor_token`, `doctor_spoke`, `doctor_gender`, `doctor_dob`, `doctor_email`, `doctor_contact`, `consult_fee`, `date_created`, `clinic_id`) VALUES
(3, 'Ayman2.jpg', 'Benchalh', 'Benchalh', '6', '20', 'good', '$2y$10$OTOVaMWF/5mZI1uVPnnZ9e4p4YwzabiVL6vAMm9w86OSXXrYAvCHG', NULL, '0', 'male', '2024-08-15', 'BenchalhBenchalh@gmail.com', '0710317523', 200, '2024-08-15 19:05:12', 5),
(4, 'codifyformatter.jpg', 'Soufiyan', 'Chaibi', '7', '20', 'Cabinet Chaibi, Propose des services de kinésithérapie et de physiothérapie axés sur la correction du mouvement et l’adoption d’un mode de vie actif.', '$2y$10$ZhqWAwqeqx5KdnESmeNLieKuTiWc6yg/wSRK3ymr.RW25j5/iHenS', NULL, '0', 'male', '1986-06-17', 'chaibikine@gmail.com', '0666741666', 100, '2024-08-19 07:38:19', 6);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_reset`
--

CREATE TABLE `doctor_reset` (
  `reset_id` int NOT NULL,
  `reset_email` varchar(255) NOT NULL,
  `reset_selector` text NOT NULL,
  `reset_token` longtext NOT NULL,
  `reset_expires` text NOT NULL,
  `activate_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_reset`
--

INSERT INTO `doctor_reset` (`reset_id`, `reset_email`, `reset_selector`, `reset_token`, `reset_expires`, `activate_token`) VALUES
(3, 'BenchalhBenchalh@gmail.com', '8878fd4ad5070a13', '$2y$10$IIyVHkzhBuVBd.r6bKWe2.4U3WDDjMxdnSBbnejN6rF8lIAQeeU2e', '1723806312', '711ed549ba407702a547956d43f9a5d3'),
(4, 'chaibikine@gmail.com', '1f7b547efc11fd48', '$2y$10$XY4apoW7aDLdGP0I7E3CXOrkV.FJ2F96352gK.3AjXWV1GDnXOlJe', '1724110700', 'e0e95f2913913d7629aad0d19791445a');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` varchar(20) NOT NULL,
  `clinic_id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `invoice_date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `tva` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `clinic_id`, `doctor_id`, `customer_name`, `phone`, `invoice_date`, `address`, `city`, `total`, `net_amount`, `tva`) VALUES
('INV202409152965', 6, 4, 'ayman', '0710317523', '2024-09-15', 'amical andalouse sud n 529 tiflet', 'Tiflat, Rabat-Sale-Zammour-Zaer, Morocco', '200.00', '33.33', '20.00'),
('INV202409156791', 6, 4, 'ayman', '0710317523', '2024-09-15', 'amical andalouse sud n 529 tiflet', 'Tiflat, Rabat-Sale-Zammour-Zaer, Morocco', '200.00', '33.33', '20.00'),
('INV202409165830', 6, 4, 'ayman', '0710317523', '2024-09-16', 'amical andalouse sud n 529 tiflet', 'Tiflat, Rabat-Sale-Zammour-Zaer, Morocco', '400.00', '66.67', '20.00'),
('INV202409189293', 6, 4, 'ayman', '0710317523', '2024-09-18', 'amical andalouse sud n 529 tiflet', 'Tiflat, Rabat-Sale-Zammour-Zaer, Morocco', '150.00', '25.00', '20.00'),
('INV202409204541', 6, 4, 'Benchalh Ayman', '0710317523', '2024-09-19', 'amical andalouse sud n 529 tiflet', 'Tiflet', '300.00', '50.00', '20.00'),
('INV202409207249', 6, 4, 'dddddddddddssss', '057812356', '2024-09-20', 'amical andalouse sud n 529 tiflet', 'Tiflat, Rabat-Sale-Zammour-Zaer, Morocco', '270.00', '45.00', '20.00'),
('INV202409253894', 6, 4, 'Benchalh Ayman', '0710317523', '2024-09-25', 'amical andalouse sud n 529 tiflet', 'Tiflet', '144.00', '24.00', '20.00'),
('INV202410013736', 6, 4, 'Benchalh Ayman', '0710317523', '2024-10-01', 'amical andalouse sud n 529 tiflet', 'Tiflet', '207.00', '34.50', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `service_nom` varchar(50) NOT NULL,
  `seance` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `service_nom`, `seance`, `price`) VALUES
(44, 'INV202409156791', 'Rééducation Post-Opératoire', 1, '200.00'),
(45, 'INV202409152965', 'Rééducation Post-Opératoire', 1, '200.00'),
(46, 'INV202409165830', 'Traitement des blessures sportives', 2, '400.00'),
(47, 'INV202409189293', 'Rééducation Post-Opératoire', 1, '150.00'),
(48, 'INV202409207249', 'Rééducation Post-Opératoire', 1, '270.00'),
(49, 'INV202409204541', 'Traitement des blessures sportives', 2, '300.00'),
(50, 'INV202409253894', 'Rééducation Post-Opératoire', 1, '144.00'),
(51, 'INV202410013736', 'Rééducation Post-Opératoire', 1, '207.00');

-- --------------------------------------------------------

--
-- Table structure for table `medical_record`
--

CREATE TABLE `medical_record` (
  `med_id` int NOT NULL,
  `med_sympton` text NOT NULL,
  `med_diagnosis` text NOT NULL,
  `med_date` datetime NOT NULL,
  `med_advice` text NOT NULL,
  `patient_id` varchar(50) DEFAULT NULL,
  `clinic_id` int NOT NULL,
  `doctor_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_record`
--

INSERT INTO `medical_record` (`med_id`, `med_sympton`, `med_diagnosis`, `med_date`, `med_advice`, `patient_id`, `clinic_id`, `doctor_id`) VALUES
(1, 'www', 'www', '2024-08-30 18:16:23', 'www', 'XA100452', 6, 4),
(2, 'sss', 'sss', '2024-09-02 23:19:01', 'sss', 'XA139303', 6, 4),
(3, 'ss', 'sss', '2024-09-19 18:31:31', 'ss', 'XA139303', 6, 4),
(4, 'qqswd', 'eee', '2024-09-20 19:34:45', 'ddd', 'XA139303', 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` varchar(50) NOT NULL,
  `patient_firstname` varchar(255) NOT NULL,
  `patient_identity` varchar(255) NOT NULL,
  `montent_p` int DEFAULT NULL,
  `patient_Seance` int NOT NULL,
  `patient_age` varchar(11) NOT NULL,
  `patient_contact` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `patient_firstname`, `patient_identity`, `montent_p`, `patient_Seance`, `patient_age`, `patient_contact`, `date_created`) VALUES
('XA100452', 'hamza', 'XA100452', NULL, 2, '22', '0645789444', '2024-08-29 10:08:25'),
('XA13335', 'houssam', 'XA13335', NULL, 0, '22', '0645789444', '2024-08-29 11:08:40'),
('XA139303', 'ayman benchalh', 'XA139303', NULL, 7, '25', '0645789652', '2024-08-29 10:08:55'),
('XA14458', 'khalid mansouri', 'XA14458', NULL, 0, '25', '0645789444', '2024-08-29 11:08:22'),
('XA178546', 'Ayman77889', 'XA178546', NULL, 1, '22', '0710317523', '2024-09-25 19:53:30'),
('XA44111', 'KHallidddddd', 'XA44111', NULL, 0, '22', '0710317523', '2024-09-24 21:53:12'),
('XA700444', 'Houssamwwww', 'XA700444', NULL, 0, '22', '0710317523', '2024-09-24 21:54:14'),
('XA755224', 'Aymanqqwsderfr', 'XA755224', NULL, 0, '25', '0710317523', '2024-09-24 21:46:54'),
('XA7788554', 'Aymansss', 'XA7788554', NULL, 0, '22', '0710317523', '2024-09-24 21:31:50'),
('XA7845', 'Aymanqqqqq', 'XA7845', NULL, 0, '25', '0710317523', '2024-09-24 21:32:26'),
('XA78555', 'Ayman', 'XA78555', NULL, 0, '25', '0710317523', '2024-09-24 20:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `patient_reset`
--

CREATE TABLE `patient_reset` (
  `reset_id` int NOT NULL,
  `reset_email` varchar(255) NOT NULL,
  `reset_selector` text NOT NULL,
  `reset_token` longtext NOT NULL,
  `reset_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL,
  `rating` int NOT NULL,
  `review` text NOT NULL,
  `date` date NOT NULL,
  `doctor_id` int NOT NULL,
  `patient_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `schedule_week` varchar(255) NOT NULL,
  `status` int NOT NULL COMMENT '1=Active | 0= Inactive',
  `doctor_id` int NOT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `date_from`, `date_to`, `schedule_week`, `status`, `doctor_id`, `clinic_id`) VALUES
(4, '2024-08-20', '2024-08-21', 'Monday', 1, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_detail`
--

CREATE TABLE `schedule_detail` (
  `schdetail_id` int NOT NULL,
  `time_slot` varchar(255) NOT NULL,
  `duration` int NOT NULL,
  `status` int NOT NULL COMMENT '1= Active 0 = Inactive',
  `schedule_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_detail`
--

INSERT INTO `schedule_detail` (`schdetail_id`, `time_slot`, `duration`, `status`, `schedule_id`) VALUES
(6, '7:58 PM', 60, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `doctor_id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `doctor_id`, `clinic_id`, `start_datetime`, `end_datetime`) VALUES
(2, 'benbe2022', 'heloo', 4, 6, '2024-08-26 17:13:00', '2024-08-30 17:13:00'),
(7, 'ffff', 'heloo', 4, 6, '2024-08-26 16:03:00', '2024-08-26 16:03:00'),
(8, 'dd2', 'heloo', 4, 6, '2024-08-30 11:00:00', '2024-08-30 11:30:00'),
(9, 'sppp75', 'good test', 4, 6, '2024-09-02 18:28:00', '2024-09-02 13:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE `speciality` (
  `speciality_id` int NOT NULL,
  `speciality_name` varchar(255) NOT NULL,
  `speciality_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`speciality_id`, `speciality_name`, `speciality_icon`) VALUES
(1, 'GP/Family', 'family.png'),
(2, 'Dentist', 'dentist.png'),
(3, 'Acupuncturist', 'acupuncture.png'),
(4, 'Audiologist', 'hearing.png'),
(5, 'Anaesthetist', 'anaesthetist.png'),
(6, 'Optometrist', 'optometrist.png'),
(7, 'physiothérapie', 'massage.png');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` int NOT NULL,
  `time_slot` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `time_slot`) VALUES
(1, '09:00 AM'),
(2, '09:30 AM'),
(3, '10:00 AM'),
(4, '10:30 AM'),
(5, '11:00 AM'),
(6, '11:30 AM'),
(7, '12:00 PM'),
(8, '12:30 PM'),
(9, '01:00 PM'),
(10, '01:30 PM'),
(11, '03:00 PM'),
(12, '03:30 PM'),
(13, '04:00 PM'),
(14, '04:30 PM'),
(15, '05:00 PM'),
(16, '05:30 PM'),
(17, '06:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_type`
--

CREATE TABLE `treatment_type` (
  `treatment_id` int NOT NULL,
  `treatment_name` varchar(255) NOT NULL,
  `doctor_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment_type`
--

INSERT INTO `treatment_type` (`treatment_id`, `treatment_name`, `doctor_id`) VALUES
(1, 'New Patient', 1),
(2, 'New Patient', 2),
(3, 'New Patient', 3),
(4, 'test', 3),
(5, 'New Patient', 4),
(6, 'test', 4),
(7, 'ssss', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ann_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `business_hour`
--
ALTER TABLE `business_hour`
  ADD PRIMARY KEY (`businesshour_id`);

--
-- Indexes for table `clinics`
--
ALTER TABLE `clinics`
  ADD PRIMARY KEY (`clinic_id`),
  ADD UNIQUE KEY `clinic_email` (`clinic_email`);

--
-- Indexes for table `clinic_images`
--
ALTER TABLE `clinic_images`
  ADD PRIMARY KEY (`clinicimg_id`);

--
-- Indexes for table `clinic_manager`
--
ALTER TABLE `clinic_manager`
  ADD PRIMARY KEY (`clinicadmin_id`),
  ADD UNIQUE KEY `clinicadmin_email` (`clinicadmin_email`);

--
-- Indexes for table `clinic_reset`
--
ALTER TABLE `clinic_reset`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `clinic_service`
--
ALTER TABLE `clinic_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `doctor_email` (`doctor_email`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `doctor_reset`
--
ALTER TABLE `doctor_reset`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `patient_identity` (`patient_identity`),
  ADD UNIQUE KEY `patient_id` (`patient_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `schedule_detail`
--
ALTER TABLE `schedule_detail`
  ADD PRIMARY KEY (`schdetail_id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`speciality_id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatment_type`
--
ALTER TABLE `treatment_type`
  ADD PRIMARY KEY (`treatment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ann_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `business_hour`
--
ALTER TABLE `business_hour`
  MODIFY `businesshour_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `clinic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clinic_images`
--
ALTER TABLE `clinic_images`
  MODIFY `clinicimg_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clinic_manager`
--
ALTER TABLE `clinic_manager`
  MODIFY `clinicadmin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clinic_service`
--
ALTER TABLE `clinic_service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_reset`
--
ALTER TABLE `doctor_reset`
  MODIFY `reset_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `med_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule_detail`
--
ALTER TABLE `schedule_detail`
  MODIFY `schdetail_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `speciality_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `treatment_type`
--
ALTER TABLE `treatment_type`
  MODIFY `treatment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`clinic_id`);

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
