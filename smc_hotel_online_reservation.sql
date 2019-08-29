-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2014 at 01:54 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smc_hotel_online_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE IF NOT EXISTS `amenities` (
  `Amenities_id` int(11) NOT NULL AUTO_INCREMENT,
  `Room_id` int(11) NOT NULL,
  `Amenities_name` varchar(30) NOT NULL,
  `Amenities_description` varchar(150) NOT NULL,
  PRIMARY KEY (`Amenities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `Guest_id` int(11) NOT NULL AUTO_INCREMENT,
  `Guest_email` varchar(30) NOT NULL,
  `Guest_name` varchar(30) NOT NULL,
  `Guest_address` varchar(30) NOT NULL,
  `Guest_contact_number` int(11) NOT NULL,
  `Company_Group` varchar(30) NOT NULL,
  `Guest_joindate` datetime NOT NULL,
  PRIMARY KEY (`Guest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`Guest_id`, `Guest_email`, `Guest_name`, `Guest_address`, `Guest_contact_number`, `Company_Group`, `Guest_joindate`) VALUES
(1, 'mrjesuserwinsuarez@gmai.com', 'Jesus Erwin Suarez', 'Buru un Iligan City', 2147483647, 'no', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `Reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `Guest_id` int(11) NOT NULL,
  `Reservation_date` datetime NOT NULL,
  PRIMARY KEY (`Reservation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Reservation_id`, `Guest_id`, `Reservation_date`) VALUES
(1, 1, '2013-12-03 11:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_line`
--

CREATE TABLE IF NOT EXISTS `reservation_line` (
  `Reservation_line_id` int(11) NOT NULL AUTO_INCREMENT,
  `Reservation_id` int(11) NOT NULL,
  `Room_id` int(11) NOT NULL,
  `ETA` time NOT NULL,
  `Check_in_date` date NOT NULL,
  `Check_out_date` date NOT NULL,
  PRIMARY KEY (`Reservation_line_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `reservation_line`
--

INSERT INTO `reservation_line` (`Reservation_line_id`, `Reservation_id`, `Room_id`, `ETA`, `Check_in_date`, `Check_out_date`) VALUES
(1, 1, 1, '09:20:00', '2014-01-11', '2014-01-11'),
(4, 1, 2, '09:20:00', '2014-01-15', '2014-01-16'),
(5, 1, 3, '09:20:00', '2014-01-24', '2014-01-25'),
(6, 1, 4, '09:20:00', '2014-01-26', '2014-01-28'),
(7, 1, 5, '09:20:00', '2014-01-26', '2014-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `Room_id` int(11) NOT NULL AUTO_INCREMENT,
  `Room_number` int(11) NOT NULL,
  `room_desc` text NOT NULL,
  `Room_type` varchar(20) NOT NULL,
  PRIMARY KEY (`Room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`Room_id`, `Room_number`, `room_desc`, `Room_type`) VALUES
(1, 101, '1077 sqft, master bedroom, living & powder room. WiFi access, buffet breakfast, ipod docking station, access to Lounge with its benefits, Plasma TV, DVD player, electronic safe. Read More  ', 'Presidential'),
(2, 102, '432 sq ft, the room gives a holistic view of the city with an I-Pod docking station, this is a space that you cannot resist, WiFi access, buffet breakfast, access to LaLiT Luxury Lounge & lounge benefits, Plasma TV with DVD player, tea-coffee maker, electronic safe, mini-bar, writing desk with lamp, seasonal fruits & alarm clock. Read More    ', 'Standard/Dormitory'),
(3, 103, 'With a bouquet of 461 hotels accommodation spread over 18 residential guest floors, The LaLiT New Delhi welcomes all its guests to it limitless hospitality. Our vision at The LaLiT Delhi hotels, which is one of the best amongst 5 stars hotels in Delhi, is to provide world class services to all our guests and to put ourselves as the executive hotel choice amongst the business traveler. Contemporary and uber-stylish, all hotel accommodations at The LaLiT Luxury hotels, offer comfort and luxury for a discerning business executive on the move or a family on a vacation.\n', 'Sweet Room'),
(4, 104, 'Spread across six different category of rooms at hotel, including four categories of suites, guests have an option of choosing the mode of Delhi accommodation, from fully furnished suites to the rooms catering to the need of all types of traveler. Suites are generously spaced & have bed room along with a living room. These Room Types are a perfect blend of Luxury & comfort with a touch of ultra modern fixtures & facilities. Having been recently modified, the hotel suites are fitted with all the contemporary amenities while the hotel rooms are luxuriously accommodated with the needs of a business traveler on move – all aimed to make hotel stay more comfortable.', 'Delux 1'),
(5, 105, 'Guests have an option of choosing from a range of luxury accommodations option, from king size bed to twin beds and from smoking room to non-smoking room. Guests can also connect to the world outside with the power of wireless internet access at all our guest’s hotel accomodation while guests opting for hotel accommodation at LaLiT Luxury room onwards can enjoy the lounge benefits where they can connect with team or even friends, grab your favorite drink as you watch your favorite TV channel. At all our accommodations at hotels we provide our guests with a unique blend of Indian hospitality, modern comfort and sumptuous meals', 'Delux 2'),
(6, 106, 'With an elegant business like décor, this standard deluxe 432 sqft room is the most spacious in the city, option of a king size or a twin bed, WiFi access, complementary tea and coffee maker, mineral water, magazines, newspaper, plasma television with DVD player, large wardrobe, electronic safe, mini bar and writing desk with lamp. Read More    ', 'Function Hall'),
(7, 107, 'With an elegant business like décor, the LaLiT view room is a pool facing 432 sqft room and comes with an option of king or a twin size bed, WiFi access and breakfast. LaLiT View Room offers panoramic view of the famous landmarks in the city along with modern facilities such as complementary tea and coffee maker, newspaper, plasma television with DVD player, electronic safe, mini bar and writing desk with lamp. Read More     ', 'Conference Hall'),
(8, 110, '432 sq ft, the room at the higher floors of the hotel  gives a holistic view of the city with an I-Pod docking station, this is a space that you cannot resist, WiFi access, buffet breakfast, exclusive access to LaLiT Luxury Lounge & lounge benefits, Plasma TV with DVD player, tea-coffee maker, electronic safe, mini-bar, writing desk with lamp, seasonal fruits & alarm clock. Read More    Take a Virtual Tour of the Club Lounge', 'Lafarge');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
