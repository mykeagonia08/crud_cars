SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `myCars`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
`car_id` int(11) NOT NULL,
  `car_name` varchar(30) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `color_id`) VALUES
(1, 'Car A', 1),
(2, 'Car B', 2),
(3, 'Car C', 1),
(4, 'Car D', 2),
(5, 'Car E', 1),
(6, 'Car F', 2),
(7, 'Car G', 1),
(8, 'Car H', 2);

-- --------------------------------------------------------

--
-- Table structure for table `car_color`
--

CREATE TABLE `car_color` (
`color_id` int(11) NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_color`
--

INSERT INTO `car_color` (`color_id`, `color`) VALUES
(1, 'Blue'),
(2, 'Red');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
 ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `car_color`
--
ALTER TABLE `car_color`
 ADD PRIMARY KEY (`color_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `car_color`
--
ALTER TABLE `car_color`
MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
