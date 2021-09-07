-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2021 at 11:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicalstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_image`, `created_date`, `updated_date`, `status`) VALUES
(1, 'Diagnostic Medical Equipment', 'Equipment or supplies that are used to diagnose, test, or find patientâ€™s conditions.', 'diagnostic_equipment_1598978481.jpg', '2020-09-01 22:11:21', '2020-09-01 22:11:21', 1),
(2, 'Surgical Equipment', 'A surgical instrument is a tool or device for performing specific actions or carrying out desired effects during a surgery or operation. ', 'surgical_equipment_1598979548.jpg', '2020-09-01 22:29:08', '2020-09-01 22:29:08', 1),
(3, 'Medical Devices', 'A medical device is any device intended to be used for medical purposes.', 'Medical_Device_1599381250.jpg', '2020-09-06 14:04:10', '2020-09-06 14:04:10', 1),
(4, 'Durable Medical Equipment (DME)', 'Durable Medical Equipment (DME) provides therapeutic benefits to a patient in need because of certain medical conditions and/or illnesses. ', 'Durable_Equipment_1599381690.jpg', '2020-09-06 14:11:30', '2020-09-06 14:11:30', 1),
(5, 'Treatment equipment', 'Treatment equipment is any type of medical device or tool that is designed to treat a specific condition.', 'Treatment_Equipment_1599382021.jpg', '2020-09-06 14:17:01', '2020-09-06 14:17:01', 1),
(6, 'Life Support Equipment', 'As the name implies, life support equipment are those medical devices intended to maintain the bodily function of a patient.', 'Life_Support_Equipment_1599382722.jpg', '2020-09-06 14:28:42', '2020-09-06 14:28:42', 1),
(7, 'Medical Laboratory Equipment', 'The use of medical laboratory equipment is often seen in medical clinics or diagnostic laboratories.', 'Laboratory_Equipment_1599382868.jpg', '2020-09-06 14:31:08', '2020-09-06 14:31:08', 1),
(8, 'COVID-19 Supplies', 'The use of COVID-19 supplies in hospitals and clinics is of utmost importance. ', 'COVID_19_Supplies_1599383112.jpg', '2020-09-06 14:35:12', '2020-09-06 14:35:12', 1),
(9, 'Drops', 'Drops are often used where the active part of the medicine works best if it reaches the affected area directly. ', 'Medical_Drops_1599383400.jpg', '2020-09-06 14:40:00', '2020-09-06 14:40:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `contact_id` int(5) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `contact_subject` varchar(150) NOT NULL,
  `contact_message` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`contact_id`, `contact_name`, `contact_email`, `contact_subject`, `contact_message`, `created_date`) VALUES
(2, 'test name', 'testing subject', 'testing@gmail.com', 'testing subject', '2020-09-30 03:12:29'),
(3, 'user', 'user subject', 'user123@gmail.com', 'message', '2020-09-30 04:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `forum_tbl`
--

CREATE TABLE `forum_tbl` (
  `forum_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `forum_title` varchar(5000) NOT NULL,
  `forum_description` varchar(5000) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_tbl`
--

INSERT INTO `forum_tbl` (`forum_id`, `product_id`, `user_id`, `forum_title`, `forum_description`, `created_date`, `updated_date`, `status`) VALUES
(1, 6, 6, '10 Kids Unaware of Their Halloween Costume', 'It is one thing to subject yourself to a Halloween costume mishap because , hey that is your prerogative. ', '2020-11-25 21:40:43', '2020-11-25 21:40:43', 1),
(2, 6, 6, 'What Instagram Ads Will Look Like', 'Instagram offered a first glimpse at what its ads will look like in a blog post Thursday. The sample ad, which you can see below.', '2020-11-25 21:45:36', '2020-11-25 21:45:36', 1),
(3, 6, 6, 'The Future of Magazines Is on Tablets', 'Eric Schmidt has seen the future of magazines, and it is on the tablet. At a Magazine Publishers Association.\r\n\r\n', '2020-11-25 21:53:40', '2020-11-25 21:53:40', 1),
(4, 3, 6, 'Pinterest Now Worth $3.8 Billion', 'Pinterest\'s valuation is closing in on $4 billion after its latest funding round of $225 million, according to a report.', '2020-11-25 21:54:45', '2020-11-25 21:54:45', 1),
(5, 4, 6, '10 Kids Unaware of Their Halloween Costume', '  It\"s one thing to subject yourself to a Halloween costume mishap because, hey, that\"s your prerogative.', '2020-11-26 21:57:27', '2020-11-26 21:57:27', 1),
(6, 12, 6, 'test', 'test description', '2021-03-06 12:29:34', '2021-03-06 12:29:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(5) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_image` text NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `user_name`, `user_password`, `user_image`, `user_email`, `created_date`, `updated_date`, `status`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'user_default.png', 'admin@medical.eq', '2020-08-23 16:56:24', '2020-08-23 16:56:24', 1),
(3, 'abdul', '428a78b4fee47253898d7918c0a09160', 'user_default.png', 'tname3186@gmail.com', '2020-11-27 22:08:34', '2020-11-27 22:08:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grand_total` int(20) NOT NULL,
  `order_status` varchar(50) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(50) NOT NULL DEFAULT 'cod',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `grand_total`, `order_status`, `payment_method`, `created_date`, `updated_date`, `status`) VALUES
(1, 6, 3100, 'pending', 'cod', '2020-11-18 15:56:53', '2020-11-18 15:56:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(50) NOT NULL,
  `product_total_price` int(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `order_id`, `product_id`, `quantity`, `product_total_price`, `created_date`, `updated_date`, `status`) VALUES
(1, 1, 12, 2, 1600, '2020-11-18 15:56:53', '2020-11-18 15:56:53', 1),
(2, 1, 13, 3, 1500, '2020-11-18 15:56:53', '2020-11-18 15:56:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `pw_reset_id` int(11) NOT NULL,
  `pw_reset_email` text NOT NULL,
  `pw_reset_selector` text NOT NULL,
  `pw_reset_token` text NOT NULL,
  `pw_reset_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(5) NOT NULL,
  `category_p_id` int(5) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(1500) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_p_id`, `product_name`, `product_description`, `product_price`, `product_image`, `created_date`, `updated_date`, `status`) VALUES
(1, 1, 'Patient Scale', 'Patient Scales are essential diagnostic tools that aid with proper medication dosing and treatment plans.', 1000, 'Patient_Scale_1599758929.png', '2020-09-10 22:58:49', '2020-09-10 22:58:49', 1),
(2, 1, 'Otoscope', 'An otoscope is a tool which shines a beam of light to help visualize and examine the condition of the ear canal and eardrum.', 900, 'Otoscope_1600101233.jpg', '2020-09-14 22:03:53', '2020-09-14 22:03:53', 1),
(3, 1, 'Sonography Machine', 'Ultrasound is an imaging modality that utilizes high-frequency sound waves to provide cross-sectional images of the body. ', 9000, 'Sonography_Machine_1600101679.jpg', '2020-09-14 22:11:19', '2020-09-17 19:18:03', 1),
(4, 1, 'MRI machine', 'MRI is a medical imaging technique that uses a magnetic field and computer-generated radio waves to create detailed images of the organs and tissues in your body.', 43000, 'MRI_machine_1600357113.jpg', '2020-09-17 21:08:33', '2020-09-17 19:18:53', 1),
(5, 1, 'Ct Scan Machine', 'A CT scan combines a series of X-ray images taken from different angles and uses computer processing to create cross-sectional images of  bones, blood vessels ,soft tissues inside your body.', 470000, 'CT_Scan_Machine_1600357439.jpg', '2020-09-17 21:13:59', '2020-09-17 21:13:59', 1),
(6, 2, 'Scalpel', 'A scalpel, or lancet, or bistoury, is a small and extremely sharp bladed instrument used for surgery, anatomical dissection, podiatry and various arts and crafts (called a hobby knife). Scalpels may be single-use disposable or re-usable.', 1000, 'Scalpel_1600428354.jpg', '2020-09-18 16:55:54', '2020-09-18 16:55:54', 1),
(7, 2, 'Scissors', 'Surgeons use surgical scissors during an operation in order to cut tissues at the surface or inside the human body. The blades can be either curved or straight. The effect of tissue dissection is achieved when the sharpened edges slide against each other.', 700, 'Scissors_1600429117.jpg', '2020-09-18 17:08:37', '2020-09-18 13:39:44', 1),
(8, 2, 'Surgical Forceps', 'Medical Forceps are grasping-type surgical instruments. Forceps are used for tweezing, clamping, and applying pressure, holding or removing tissue or for placing or removing gauze, sponges, or wipes.', 1250, 'Surgical_forceps_1600431258.jpg', '2020-09-18 17:44:18', '2020-09-18 17:44:18', 1),
(9, 2, 'Tissue Forceps', 'Tissue forceps are used in surgical procedures for grasping tissue.Often, the tips have \"teeth\" to securely hold a tissue.Tissue forceps are designed to minimize damage to biological tissue.', 400, 'Tissue_forceps_1601010258.jpg', '2020-09-24 23:04:18', '2020-09-24 23:04:18', 0),
(10, 3, 'Blood Pressure Monitor', 'Blood Pressure Monitor device used to measure blood pressure, composed of an inflatable cuff to collapse and then release the artery under the cuff in a controlled manner, and a mercury or aneroid manometer to measure the pressure.', 2000, 'Blood_Pressure_Monitor_1601010550.jpg', '2020-09-24 23:09:10', '2020-09-24 23:09:10', 1),
(11, 3, 'Stethoscope', 'Stethoscope, medical instrument used in listening to sounds produced within the body, chiefly in the heart or lungs. It was invented by the French physician R.T.H. Laënnec,  in 1819.', 5000, 'stethoscope_1601011070.jpg', '2020-09-24 23:17:50', '2020-09-24 23:17:50', 1),
(12, 3, 'Thermometer', 'An instrument for measuring temperature, often a sealed glass tube that contains a column of liquid, as mercury, that expands and contracts, or rises and falls, with temperature changes.', 800, 'thermometer_1601013982.jpg', '2020-09-25 00:06:22', '2020-09-25 00:06:22', 1),
(13, 3, 'Syringe', 'A syringe is a pump consisting of a sliding plunger that fits tightly in a tube. The plunger can be pulled and pushed inside the precise cylindrical tube, letting the syringe draw in or expel a liquid or gas through an orifice at the open end of the tube.', 500, 'Syringe_1601014942.jpg', '2020-09-25 00:22:22', '2020-09-25 00:22:22', 1),
(14, 3, 'Glucose meter', 'A glucose meter is a medical device for determining the approximate concentration of glucose in the blood. It can also be a strip of glucose paper dipped into a substance and measured to the glucose chart. ', 1380, 'Glucose_meter_1601027384.jpg', '2020-09-25 03:49:44', '2020-09-25 03:49:44', 1),
(15, 4, 'Nebulizer', 'A nebulizer is an electrically powered machine that turns liquid medication into a mist so that it can be breathed directly into the lungs through a face mask or mouthpiece. ', 1755, 'Nebulizer_1601027747.jpg', '2020-09-25 03:55:47', '2020-09-25 03:55:47', 1),
(16, 4, 'Breast pumps', 'A breast pump is a mechanical device that lactating women use to extract milk from their breasts. They may be manual devices powered by hand or foot movements or automatic devices powered by electricity.', 12000, 'Breast_pumps_1601096112.jpg', '2020-09-25 22:55:12', '2020-09-25 22:55:12', 1),
(17, 4, 'Wheelchair', 'A wheelchair is a chair with wheels, used when walking is difficult or impossible due to illness, injury, old age related problems, or disability.', 6000, 'Wheelchair_1601096764.jpg', '2020-09-25 23:06:04', '2020-09-25 23:06:04', 1),
(18, 4, 'Walker ', 'A walker or walking frame is a tool for disabled people, who need additional support to maintain balance or stability while walking, most commonly due to age-related physical restrictions.', 1670, 'Medical_Walker_1601311437.jpg', '2020-09-28 10:43:57', '2020-09-28 10:43:57', 1),
(19, 4, 'Catheter', 'A catheter is a soft hollow tube, which is passed into the bladder to drain urine. Catheters are sometimes necessary for people, who for a variety of reasons, cannot empty their bladder in the usual way, i.e. passing urine into a toilet or urinal.', 690, 'Catheter_1601452193.jpg', '2020-09-30 01:49:53', '2020-09-30 01:49:53', 1),
(20, 5, 'Sphygmomanometer', 'A sphygmomanometer is a device that measures blood pressure.It is composes of an inflatable rubber cuff, which is wrapped around the arm.', 920, 'Sphygmomanometer_1601452923.jpg', '2020-09-30 02:02:03', '2020-09-30 10:05:14', 1),
(21, 5, 'Reflex Hammer', 'The reflex hammer is an important diagnostic tool used by physicians to test deep tendon reflexes, an essential part of the neurological physical examination in order to assess the peripheral and central nervous system.', 350, 'Reflex_hammer_1602761534.jpg', '2020-10-15 17:02:14', '2020-10-15 14:00:11', 1),
(22, 5, 'Endoscope', 'Endoscopy is a nonsurgical procedure used to examine a persons digestive tract. Using an endoscope, a flexible tube with a light and camera attached to it.', 175000, 'Endoscope_1602763425.jpg', '2020-10-15 17:33:45', '2020-10-15 14:07:51', 1),
(24, 5, 'Surgeon Cap', 'Surgical caps are a part of medical protective clothing and should prevent germs from the hair or scalp of surgical personnel from contaminating the operating area.', 400, 'Surgeon_Cap_1603265428.jpg', '2020-10-21 13:00:28', '2020-10-21 13:00:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(70) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_phone` text NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_delivery_address` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_address`, `user_image`, `user_delivery_address`, `created_date`, `updated_date`, `status`) VALUES
(1, 'test name', 'test@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', '127', 'Test address', 'defaul-profile-img.jpg', 'Test address', '2020-10-01 04:13:45', '2020-10-01 04:13:45', 1),
(2, 'abdulrahim', 'abdul123@gmail.com', 'abdul123', '127', 'gujarat surat', 'defaul-profile-img.jpg', 'gujarat surat', '2020-10-01 04:41:54', '2020-10-01 04:41:54', 1),
(6, 'mike ', 'mike123@gmail.com', '4c3e1ec04215f69d6a8e9c023c9e4572', '127', 'indiana usa', '1091819_1606712645.jpg', 'North America', '2020-10-01 05:09:31', '2020-10-01 05:09:31', 1),
(10, 'dummy123', 'dummy@gmail.com', '851fdee206c1eec10cee5ec8e8962af2', '8899776655', 'dummy address', 'defaul-profile-img.jpg', 'dummy delivery address', '2020-11-20 13:56:30', '2020-11-20 13:56:30', 1),
(11, 'bro123', 'bro123@gmail.com', 'e1dc3f127b005d94ed22d7c5e48b0f61', '8877665554', 'bro address', 'defaul-profile-img.jpg', 'bro address', '2020-11-20 14:06:36', '2020-11-20 14:06:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `website_global`
--

CREATE TABLE `website_global` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `field_value` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website_global`
--

INSERT INTO `website_global` (`field_id`, `field_name`, `field_value`, `created_date`, `updated_date`, `status`) VALUES
(3, 'site_title', 'Medical Store', '2020-10-30 17:11:00', '2020-10-30 17:11:00', 1),
(8, 'default-currency ', '$', '2020-11-01 14:09:59', '2020-11-01 14:09:59', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `forum_tbl`
--
ALTER TABLE `forum_tbl`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`pw_reset_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `foreign_key` (`category_p_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `website_global`
--
ALTER TABLE `website_global`
  ADD PRIMARY KEY (`field_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `contact_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forum_tbl`
--
ALTER TABLE `forum_tbl`
  MODIFY `forum_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `pw_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `website_global`
--
ALTER TABLE `website_global`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum_tbl`
--
ALTER TABLE `forum_tbl`
  ADD CONSTRAINT `forum_tbl_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_tbl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`category_p_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
