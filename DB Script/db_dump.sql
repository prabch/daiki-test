SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `daikitest` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `daikitest`;

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `course_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `course_name` varchar(198) NOT NULL,
  `course_description` varchar(198) DEFAULT NULL,
  `user_id` int(5) unsigned NOT NULL,
  `status` varchar(198) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `courses` (`course_id`, `created`, `modified`, `course_name`, `course_description`, `user_id`, `status`) VALUES
(1,	'2021-09-23 07:12:38',	'2021-09-23 07:12:38',	'Sample Course',	'Sample course description',	2,	'active');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`version`) VALUES
(2);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(198) NOT NULL,
  `username` varchar(198) NOT NULL,
  `password` varchar(198) NOT NULL,
  `user_level` varchar(198) NOT NULL,
  `status` varchar(198) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `created`, `modified`, `name`, `username`, `password`, `user_level`, `status`) VALUES
(1,	'2021-09-23 07:11:47',	'2021-09-23 07:11:47',	'admin',	'admin',	'$2y$10$nsr4jJ5EXTp.7uAGHRqweupN6wmk5omlbXt8NDkevAR4ODF.Y8MUG',	'admin',	'active'),
(2,	'2021-09-23 07:12:10',	'2021-09-23 07:12:10',	'Lecturer one',	'lecturer',	'$2y$10$wpvqEepZ/acX5O5zsOWI5OnZHGK7fYYQSD90VurVKYBreHnRvJJ.q',	'lecturer',	'active');

-- 2021-09-23 07:13:19
