-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2020 at 07:47 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `user_email`, `user_pass`) VALUES
(1, 'medicaldirects@gmail.com', 'ee13f51366468526917804d99e857396');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `quantity` int(11) NOT NULL,
  `checkedout` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Flu & Cold', '1'),
(2, 'Vitamins & Supplements', '1'),
(3, 'Chickenpox', '0'),
(4, 'Covid-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `deal`
--

CREATE TABLE `deal` (
  `deal_name` varchar(50) NOT NULL,
  `deal_cost` int(15) NOT NULL,
  `deal_count` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deal`
--

INSERT INTO `deal` (`deal_name`, `deal_cost`, `deal_count`) VALUES
('bigsaving', 5, 11),
('smartdeal', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `resetpass` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `full_name`, `email`, `password`, `phone_number`, `token`, `verified`, `resetpass`) VALUES
(1, 'sanuj', 'sanujkalgutkar@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TE9GM1l5ck9ic2lSV0pvSg$cTNEh8XjbNjATElVQIeZvjyOP3EmCALHY0JKYrWf4qo', '1234567891', '43d483251a27b65df9b0e77a875725a166da9842e927ebc1cc2dd7060e1f0c178068347602f43fc6acfa0b0dab5127361afc', 1, 0),
(2, 'Manjiree', 'mbutkar@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$RWkwWmhOVi4vY2JpY1ZYSQ$QgenpLJNSQv7J46D5cJU6nOBIv6r0ZY4uqHmay9Z7qI', '8779647688', '162a53ae8f63a123123ccf49b02f57fe801f43a0ae6b4cecc09736b020f6d469a2d4286bd8ceff6083d20f495e28de699ae8', 1, 0),
(3, 'Sayli More', 'moresayli28@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$NWJSOWlBMlcyV0pJNWQyNg$RBWGG2r9DqmN+eZl4IkoQqO1e8QVZkR1UCPFRVAMnMQ', '0892548536', '4c530f9a368b9bcf7220e7a2983ebca0a2f216d113d943b0e4b563a1ea4fca000b5946291f833dbd829b156905c32eca19d1', 0, 0),
(4, 'sanuj', 'kalgutkarsanuj26@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Ujk4TVFEbzJzR3hsSFRvcg$loj5xqOjBqN4AterHIG3g2/qNjPeJ5BiV+SJPHysl08', '1234567891', 'a195908b52de355363eab78c19c9f49bd85a3a5a66c39f284d6d6202ea0b69d80b74bd590dbff64cd60039870877f1fb9cc3', 1, 0),
(5, 'sanuj', 'gauravdeo200@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$MHdOQm1vTE5SN1dCc3VrWQ$tr/NnEJWl54qpGlf1HsJYpksceX5arxXfz/Blocca4U', '9638527412', '8a8731304a20313b7f3c927ae08371ff4d403a7a0704290ce2637a227c1c82ac5f09c37e56e2d3ebad893b4226f128ec57fb', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loginattempts`
--

CREATE TABLE `loginattempts` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Attempts` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(5000) NOT NULL,
  `state_country` varchar(50) NOT NULL,
  `postalcode` varchar(6) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `deal_code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `order_id` int(5) NOT NULL,
  `customer_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `total` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_cost` float NOT NULL,
  `product_description` varchar(512) NOT NULL,
  `product_image` varchar(10000) NOT NULL,
  `product_count` int(10) NOT NULL,
  `product_characteristic` varchar(8096) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_cost`, `product_description`, `product_image`, `product_count`, `product_characteristic`, `product_category`, `product_status`) VALUES
(1, 'Crocin', 10, '<p>Crocin is a carotenoid chemical compound that is found in the flowers crocus and gardenia. Crocin is the chemical primarily responsible for the color of saffron. Chemically, crocin is the diester formed from the disaccharide gentiobiose and the dicarboxylic acid crocetin.</p>', 'crocin.jpg', 275, '', 1, '1'),
(2, 'Febrex', 12.5, 'Febrex 500 MG Tablet is used to temporarily relieve fever and mild to moderate pain such as muscle ache, headache, toothache, arthritis, and backache. This medicine should be used with caution in patients with liver diseases due to the increased risk of severe adverse effects.', 'febrex.jpg', 100, '', 1, '0'),
(3, 'Advil', 11.75, 'Make pain a distant memory. Advil® is the #1 selling pain reliever,* providing safe, effective pain relief for over 30 years. So whether you have a headache, muscle aches, backaches, menstrual pain, minor arthritis and other joint pain, or aches and pains from the common cold, nothing\'s stronger or longer lasting. The medicine in Advil® is #1 doctor recommended for pain relief.', 'advil.jpg', 99, '', 1, '1'),
(4, 'Tylenol', 13, 'An estimated 50 million Americans use acetaminophen each week to treat conditions such as pain, fever and aches and pains associated with cold and flu symptoms. To help encourage the safe use of acetaminophen, the makers of TYLENOL® have lowered the maximum daily dose for single-ingredient Extra Strength TYLENOL® (acetaminophen) products sold in the U.S. from 8 pills per day (4,000 mg) to 6 pills per day (3,000 mg). ', 'tylenol.jpg', 8, '', 1, '0'),
(5, 'Sudafed', 11.08, 'Reach for products from the makers of SUDAFED® to rescue you from your sinus symptoms and sinus related problems, like allergies and colds. You can find our products either behind the counter, in the cold and allergy aisle, or online.', 'sudafed.jpg', 8, '', 1, '1'),
(6, 'Benadryl', 14.12, 'Benadryl Dry Cough & Nasal Congestion is used to relieve the symptoms of cold and cough such as runny nose, nasal congestion and dry cough. Dextromethorphan is a cough suppressant that acts on the cough centre in the brain to suppress a dry cough.', 'benadryl.jpg', 7, '', 1, '1'),
(7, 'Mucinex DM', 14, 'Mucinex DM is a cough medicine that contains dextromethorphan, a cough suppressant, and guaifenesin, an expectorant. This combination of two drugs helps loosen mucus and phlegm, and thin out bronchial secretions, making coughs more productive.', 'mucinexdm.jpg', 6, '', 1, '1'),
(8, 'Theraflu', 13.99, 'Theraflu Nighttime Severe Cold And Cough (Acetaminophen / Diphenhydramine / Phenylephrine) is good for treating multiple cold and flu symptoms, but it won\'t relieve coughing. ', 'theraflu.jpg', 6, '', 1, '1'),
(9, 'Omega 3', 18, 'Omega-3 fish oil contains both docosahexaenoic acid (DHA) and eicosapentaenoic acid (EPA). Omega-3 fatty acids are essential nutrients that are important in preventing and managing heart disease. ', 'omega3.jpg', 8, '', 2, '1'),
(10, 'Vitamin', 25.5, 'The health benefits of vitamins include their ability to prevent and treat various diseases including heart problems, high cholesterol levels, and eye and skin disorders. Most vitamins facilitate many of the body’s mechanisms and perform functions which cannot be performed by any other nutrients.\r\n', 'vitamins.jpg', 8, '', 2, '1'),
(11, 'Whey Protein', 34.99, 'Whey is the liquid remaining after milk has been curdled and strained. It is a byproduct of the manufacture of cheese or casein and has several commercial uses. Sweet whey is a byproduct produced during the manufacture of rennet types of hard cheese, like Cheddar or Swiss cheese.', 'wheyprotein.jpeg', 8, '', 2, '1'),
(12, 'BCAA', 21.75, 'Branched-chain amino acids (BCAAs) are a group of three essential amino acids: leucine, isoleucine and valine. BCAA supplements are commonly taken in order to boost muscle growth and enhance exercise performance. They may also help with weight loss and reduce fatigue after exercise.', 'bcaa.jpg', 9, '', 2, '1'),
(13, 'Creatine', 11.2, 'Creatine is an organic compound with the nominal formula CNCH₂CO₂H. This species exists in various modifications in solution. Creatine is found in vertebrates where it facilitates recycling of adenosine triphosphate, the energy currency of the cell, primarily in muscle and brain tissue.', 'creatine.jpg', 8, '', 2, '1'),
(14, 'Glutamine', 9.75, 'Glutamine is an α-amino acid that is used in the biosynthesis of proteins. Its side chain is similar to that of glutamic acid, except the carboxylic acid group is replaced by an amide. It is classified as a charge-neutral, polar amino acid. ', 'glutamine.jpg', 10, '', 2, '1'),
(15, 'Minerals', 7.75, 'A mineral is, broadly speaking, a solid chemical compound that occurs naturally in pure form. A rock may consist of a single mineral, or may be an aggregate of two or more different minerals, spacially segregated into distinct phases.', 'mineral.jpg', 9, '', 2, '1'),
(16, 'Disprin', 4, 'Blood thinners and nonsteroidal anti-inflammatory drug\r\nIt can treat pain, fever, headache, and inflammation. It can also reduce the risk of heart attack.', 'disprin.jpg', 50, 'Ecotrin, Durlaza, Ecotrin Low Strength, Aspir-Trin, Bayer Plus Extra Strength, Lo-Dose Aspirin, Aspirin Childrens, E.C. Prin, Bayer Advanced, Bufferin, and more', 1, '0'),
(17, 'Saridon', 8.99, 'Propyphenazone/paracetamol/caffeine is an analgesic combination indicated for the management of headache. It contains the analgesics propyphenazone and paracetamol and the stimulant caffeine.', 'Saridon.jpg', 23, 'Analgesic', 1, '1'),
(18, 'Oscillo', 30, '<p>Flu</p>', 'panadol.jpg', 50, 'Flu Cold', 2, '0'),
(19, 'Oscillococcinum', 20, 'Flu and Cold ', 'oscillococcinum.jpg', 50, 'Cold', 1, '1'),
(20, 'N 95 Mask', 8, 'N95 respirators and surgical masks (face masks) are examples of personal protective equipment that are used to protect the wearer from airborne particles and from liquid contaminating the face. ', 'N95 Mask.jpg', 10, 'Protective mask', 4, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`deal_name`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `loginattempts`
--
ALTER TABLE `loginattempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `deal_code` (`deal_code`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_category` (`product_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loginattempts`
--
ALTER TABLE `loginattempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
