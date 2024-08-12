-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 11, 2024 at 10:36 PM
-- Server version: 8.0.30
-- PHP Version: 7.3.5

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
(1, 'Admin', '3cVaxePSLtU0JOrUNCgvbxFaSMgH9+lJSOZCR1DHfnSMUo4LNff3bMwLqCg5PS4j', 'admin@admin.com', '1488714734152752384749', '2020-01-15 03:28:10'),
(3, 'Ayman Benchalh', '$2y$10$aPn/TbG1ACVM4AJ5qn8JZeCkBKvcwYDe0ZCdhUI22xGwoaeCLwdle', 'Aymanbenchalh53@gmail.com', '7521129341752281662368', '2024-08-08 22:56:06');

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
  `treatment_type` varchar(255) NOT NULL,
  `patient_id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `status` int NOT NULL COMMENT '1: Confirm, 0: Not Confirm',
  `consult_status` int NOT NULL COMMENT '1: Visited 0: None',
  `arrive_status` int NOT NULL COMMENT '1: Arrived 0: None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, '1:24 PM', '1:24 PM', '1:24 PM', '1:24 PM', '1:24 PM', '1:24 PM', 11),
(4, '8:48 PM', '8:48 PM', '8:48 PM', '8:48 PM', '8:48 PM', '8:48 PM', 12);

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
(11, 'RAHMA', 'rahmaClinic@gmail.com', 'https://www.rahmaClinic.com', '0710317523', 'amical andalouse sud n 529 tiflet', 'Tiflat, Rabat-Sale-Zammour-Zaer, Morocco', 'Kuala Lumpur', '15400', '1', '2024-08-10 20:24:29'),
(12, 'Naser', 'NaserClinic@gmail.con', 'https://www.NaserClinic.com', '0711452345', 'amical andalouse sud n 529 tiflet', 'Tiflet', 'Johor', '15400', '0', '2024-08-12 03:48:40');

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
(4, 'WhatsApp Image 2024-08-02 at 00.13.02_46b29bca.jpg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `clinic_manager`
--

CREATE TABLE `clinic_manager` (
  `clinicadmin_id` int NOT NULL,
  `clinicadmin_name` varchar(255) NOT NULL,
  `clinicadmin_password` varchar(255) NOT NULL,
  `clinicadmin_token` varchar(255) NOT NULL,
  `clinicadmin_email` varchar(255) NOT NULL,
  `clinicadmin_contact` varchar(15) NOT NULL,
  `date_created` datetime NOT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinic_manager`
--

INSERT INTO `clinic_manager` (`clinicadmin_id`, `clinicadmin_name`, `clinicadmin_password`, `clinicadmin_token`, `clinicadmin_email`, `clinicadmin_contact`, `date_created`, `clinic_id`) VALUES
(8, 'RahmaCLinic', '$2y$10$hhj7sV40/TKkyXtC2iarIOq5vTWf4mA8pX5XtQhh8A7cXEtWL0v0q', '2488797246034500202745', 'rahmaClinic@gmail.com', '0710317523', '2024-08-10 20:24:29', 11),
(9, 'NaserClinic', '$2y$10$zA663r.QwAnzi4xxB9gF.ODPjf4/H8d9EX5bbS8DA91anfVw3l8Qa', '5110859691107227287033', 'NaserClinic@gmail.con', '0711452345', '2024-08-12 03:48:40', 12);

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
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int NOT NULL,
  `doctor_avatar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `doctor_firstname` varchar(255) NOT NULL,
  `doctor_lastname` varchar(255) NOT NULL,
  `doctor_speciality` varchar(255) NOT NULL,
  `doctor_experience` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `doctor_desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `doctor_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `doctor_token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `doctor_spoke` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `doctor_gender` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `doctor_dob` date DEFAULT NULL,
  `doctor_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `doctor_contact` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `consult_fee` int DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `clinic_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_avatar`, `doctor_firstname`, `doctor_lastname`, `doctor_speciality`, `doctor_experience`, `doctor_desc`, `doctor_password`, `doctor_token`, `doctor_spoke`, `doctor_gender`, `doctor_dob`, `doctor_email`, `doctor_contact`, `consult_fee`, `date_created`, `clinic_id`) VALUES
(8, 'Ayman2.jpg', 'Benchalh', 'Benchalh', '6', '20', 'sdsf', NULL, NULL, 'English', 'male', '2024-08-06', 'BenchalhBenchalh@gmail.com', '0710317523', 200, '2024-08-10 20:27:27', 11);

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
(7, 'BenchalhBenchalh@gmail.com', 'b37303658e63d1fc', '$2y$10$unfV/7R5F7j1ie8JAm8JuOVNC.q1LI5Gbr6MJd43WlWBdXRVZucoC', '1723379247', 'f95999a0f1664d833a3c0cf5e0c19779');

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
  `patient_id` int NOT NULL,
  `clinic_id` int NOT NULL,
  `doctor_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int NOT NULL,
  `patient_avatar` varchar(255) NOT NULL,
  `patient_firstname` varchar(255) NOT NULL,
  `patient_lastname` varchar(255) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `patient_password` varchar(255) NOT NULL,
  `patient_token` varchar(255) NOT NULL,
  `patient_identity` varchar(255) NOT NULL,
  `patient_nationality` varchar(255) NOT NULL,
  `patient_gender` varchar(255) NOT NULL,
  `patient_maritalstatus` varchar(255) NOT NULL,
  `patient_dob` date NOT NULL,
  `patient_age` varchar(11) NOT NULL,
  `patient_contact` varchar(255) NOT NULL,
  `patient_address` varchar(255) NOT NULL,
  `patient_city` varchar(255) NOT NULL,
  `patient_state` varchar(255) NOT NULL,
  `patient_zipcode` varchar(255) NOT NULL,
  `patient_country` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE `speciality` (
  `speciality_id` int NOT NULL,
  `speciality_name` varchar(255) NOT NULL,
  `speciality_icon` varchar(255) NOT NULL
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
(6, 'Optometrist', 'optometrist.png');

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
(7, 'New Patient', 8);

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
  ADD PRIMARY KEY (`clinic_id`);

--
-- Indexes for table `clinic_images`
--
ALTER TABLE `clinic_images`
  ADD PRIMARY KEY (`clinicimg_id`);

--
-- Indexes for table `clinic_manager`
--
ALTER TABLE `clinic_manager`
  ADD PRIMARY KEY (`clinicadmin_id`);

--
-- Indexes for table `clinic_reset`
--
ALTER TABLE `clinic_reset`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `clinic_id` (`clinic_id`);

--
-- Indexes for table `doctor_reset`
--
ALTER TABLE `doctor_reset`
  ADD PRIMARY KEY (`reset_id`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

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
-- Indexes for table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`speciality_id`);

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
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ann_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_hour`
--
ALTER TABLE `business_hour`
  MODIFY `businesshour_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clinics`
--
ALTER TABLE `clinics`
  MODIFY `clinic_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `clinic_images`
--
ALTER TABLE `clinic_images`
  MODIFY `clinicimg_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clinic_manager`
--
ALTER TABLE `clinic_manager`
  MODIFY `clinicadmin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor_reset`
--
ALTER TABLE `doctor_reset`
  MODIFY `reset_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `med_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_detail`
--
ALTER TABLE `schedule_detail`
  MODIFY `schdetail_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `speciality_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
