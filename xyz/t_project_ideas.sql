-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.35-community - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for t_project_ideas
CREATE DATABASE IF NOT EXISTS `t_project_ideas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `t_project_ideas`;

-- Dumping structure for table t_project_ideas.attachements
CREATE TABLE IF NOT EXISTS `attachements` (
  `attachement_id` int(11) NOT NULL AUTO_INCREMENT,
  `inbox_id` int(11) DEFAULT NULL,
  `file_path` text NOT NULL,
  PRIMARY KEY (`attachement_id`),
  KEY `FK__inbox` (`inbox_id`),
  CONSTRAINT `FK__inbox` FOREIGN KEY (`inbox_id`) REFERENCES `inbox` (`inbox_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table t_project_ideas.attachements: ~0 rows (approximately)
/*!40000 ALTER TABLE `attachements` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachements` ENABLE KEYS */;

-- Dumping structure for table t_project_ideas.inbox
CREATE TABLE IF NOT EXISTS `inbox` (
  `inbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `message` text,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`inbox_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table t_project_ideas.inbox: ~0 rows (approximately)
/*!40000 ALTER TABLE `inbox` DISABLE KEYS */;
/*!40000 ALTER TABLE `inbox` ENABLE KEYS */;

-- Dumping structure for table t_project_ideas.members
CREATE TABLE IF NOT EXISTS `members` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT '',
  `phone` varchar(13) DEFAULT '',
  `password` varchar(50) DEFAULT '',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table t_project_ideas.members: ~0 rows (approximately)
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;

-- Dumping structure for table t_project_ideas.project_ideas
CREATE TABLE IF NOT EXISTS `project_ideas` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `proposal` text NOT NULL,
  `proposal_attachement` varchar(50) DEFAULT '',
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`project_id`),
  KEY `FK1` (`user_id`),
  CONSTRAINT `FK1` FOREIGN KEY (`user_id`) REFERENCES `members` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table t_project_ideas.project_ideas: ~0 rows (approximately)
/*!40000 ALTER TABLE `project_ideas` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_ideas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
