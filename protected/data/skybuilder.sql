/*
SQLyog Ultimate v8.55 
MySQL - 5.1.46-community : Database - skybuilder
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`skybuilder` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `skybuilder`;

/*Table structure for table `applications` */

DROP TABLE IF EXISTS `applications`;

CREATE TABLE `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `android` tinyint(1) NOT NULL,
  `iphone` tinyint(1) NOT NULL,
  `launch_tab_title` varchar(255) DEFAULT NULL,
  `phone_title` varchar(30) DEFAULT 'Call Us',
  `phone` varchar(255) DEFAULT NULL,
  `email_title` varchar(30) DEFAULT 'Email Us',
  `email` varchar(255) DEFAULT NULL,
  `address_title` varchar(30) DEFAULT 'Directions',
  `address` varchar(255) DEFAULT NULL,
  `launch_image` varchar(255) DEFAULT NULL,
  `master_keyword` varchar(100) DEFAULT NULL,
  `master_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_applications` (`user_id`),
  CONSTRAINT `FK_applications` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `applications` */

insert  into `applications`(`id`,`user_id`,`title`,`description`,`icon`,`android`,`iphone`,`launch_tab_title`,`phone_title`,`phone`,`email_title`,`email`,`address_title`,`address`,`launch_image`,`master_keyword`,`master_address`) values (2,2,'My App','desc','1348173040_HowtoKissPassionately.jpg',0,1,'Launch Tab Title','Call Us','','Email Us','','Directions',NULL,'1348175983_kiss.jpg',NULL,NULL);

/*Table structure for table `authassignment` */

DROP TABLE IF EXISTS `authassignment`;

CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authassignment` */

insert  into `authassignment`(`itemname`,`userid`,`bizrule`,`data`) values ('admin','1',NULL,'N;'),('Authenticated','2',NULL,'N;');

/*Table structure for table `authitem` */

DROP TABLE IF EXISTS `authitem`;

CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authitem` */

insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`) values ('admin',2,NULL,NULL,'N;'),('Application.BuildApp',0,NULL,NULL,'N;'),('Application.CustomizeModuleDetails',0,NULL,NULL,'N;'),('Application.CustomizeModules',0,NULL,NULL,'N;'),('Application.Dashboard',0,NULL,NULL,'N;'),('Application.Details',0,NULL,NULL,'N;'),('Application.FinalPreview',0,NULL,NULL,'N;'),('Application.ModuleOrder',0,NULL,NULL,'N;'),('Application.Modules',0,NULL,NULL,'N;'),('Application.Splash',0,NULL,NULL,'N;'),('Authenticated',2,NULL,NULL,'N;'),('Guest',2,NULL,NULL,'N;'),('Site.Cloud',0,NULL,NULL,'N;'),('Site.Index',0,NULL,NULL,'N;'),('Site.Login',0,NULL,NULL,'N;'),('Site.Signup',0,NULL,NULL,'N;'),('Site.Training',0,NULL,NULL,'N;'),('Site.Welcome',0,NULL,NULL,'N;'),('User.Create',0,NULL,NULL,'N;');

/*Table structure for table `authitemchild` */

DROP TABLE IF EXISTS `authitemchild`;

CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authitemchild` */

insert  into `authitemchild`(`parent`,`child`) values ('Authenticated','Application.BuildApp'),('Authenticated','Application.CustomizeModuleDetails'),('Authenticated','Application.CustomizeModules'),('Authenticated','Application.Dashboard'),('Authenticated','Application.Details'),('Authenticated','Application.FinalPreview'),('Authenticated','Application.ModuleOrder'),('Authenticated','Application.Modules'),('Authenticated','Application.Splash'),('Authenticated','Site.Cloud'),('Authenticated','Site.Index'),('Guest','Site.Index'),('Guest','Site.Login'),('Guest','Site.Signup'),('Authenticated','Site.Training'),('Authenticated','Site.Welcome'),('Guest','User.Create');

/*Table structure for table `form_fields` */

DROP TABLE IF EXISTS `form_fields`;

CREATE TABLE `form_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `type` enum('small_text_box','large_text_box') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_form_fields` (`module_id`),
  CONSTRAINT `FK_form_fields` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `form_fields` */

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `tab_title` varchar(50) DEFAULT NULL,
  `tab_icon` varchar(255) DEFAULT NULL,
  `description` text,
  `flickr_id` varchar(100) DEFAULT NULL,
  `twitter_username` varchar(100) DEFAULT NULL,
  `facebook_username` varchar(100) DEFAULT NULL,
  `youtube_username` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_position` enum('no_image','below_text','above_text') DEFAULT NULL,
  `web_page_url` varchar(255) DEFAULT NULL,
  `contact_form_subject` varchar(100) DEFAULT NULL,
  `form_submit_email` varchar(255) DEFAULT NULL,
  `submit_button_label` varchar(50) DEFAULT NULL,
  `number_of_fields` int(11) DEFAULT NULL,
  `twitter_keyword` varchar(50) DEFAULT NULL,
  `flickr_keyword` varchar(150) DEFAULT NULL,
  `youtube_keyword` varchar(150) DEFAULT NULL,
  `rss_feed_url` varchar(255) DEFAULT NULL,
  `module_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_modules` (`application_id`),
  CONSTRAINT `FK_modules` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `modules` */

/*Table structure for table `rights` */

DROP TABLE IF EXISTS `rights`;

CREATE TABLE `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rights` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('user','admin') NOT NULL,
  `membership_type` enum('yearly','monthly') NOT NULL,
  `payment_system` enum('checkout','paypal') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UN_Username` (`username`),
  UNIQUE KEY `UN_Email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`first_name`,`last_name`,`email`,`password`,`creation_time`,`role`,`membership_type`,`payment_system`) values (1,'admin','','','admin@sky.com','21232f297a57a5a743894a0e4a801fc3','2012-09-06 19:45:40','admin','yearly','checkout'),(2,'tayyabshabab','','','tayyabshabab@yahoo.com','68530ef957798826ae158063776b4c6b','2012-09-06 20:11:59','user','yearly','checkout');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
