-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(25) NOT NULL,
  `group_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `groups` (`id`, `group_name`, `group_code`) VALUES
(1,	'Developers',	'DVPS'),
(2,	'Managers',	'MNGR'),
(3,	'Engineers',	'ENGE'),
(4,	'Mentors',	'MNTS');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`) VALUES
(1,	'Jane',	'Smith',	'js73@smithfamily.org'),
(2,	'John',	'Doe',	'john@ezmail.com'),
(3,	'George',	'Shoemaker',	'george.72@foomail.com');

-- 2021-12-21 08:48:46
