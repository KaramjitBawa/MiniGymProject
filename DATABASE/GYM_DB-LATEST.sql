/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.40-MariaDB : Database - gym_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gym_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `gym_db`;

/*Table structure for table `tbl_cities` */

DROP TABLE IF EXISTS `tbl_cities`;

CREATE TABLE `tbl_cities` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `state_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_cities` */

insert  into `tbl_cities`(`id`,`city_name`,`state_id`) values (1,'Calgary',1),(2,'Toronto',4),(3,'London',4);

/*Table structure for table `tbl_countries` */

DROP TABLE IF EXISTS `tbl_countries`;

CREATE TABLE `tbl_countries` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `country_code` varchar(5) DEFAULT '+1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_countries` */

insert  into `tbl_countries`(`id`,`name`,`country_code`) values (1,'India','+91'),(2,'Canada','+1');

/*Table structure for table `tbl_locations` */

DROP TABLE IF EXISTS `tbl_locations`;

CREATE TABLE `tbl_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(60) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `state_id` smallint(5) DEFAULT NULL,
  `city_id` smallint(5) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `Logo` varchar(50) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tbl_locations` */

insert  into `tbl_locations`(`id`,`location_name`,`address`,`postal_code`,`state_id`,`city_id`,`contact`,`email`,`longitude`,`latitude`,`Logo`,`datetime`,`status`) values (1,'East York Town Centre','B24- 45 Overlea Blvd. Toronto,ON','M4H 1C3',4,2,'(416)467-4902',NULL,NULL,NULL,NULL,'2021-11-23 01:43:12',1),(2,'Calgary Macleod Plaza','180 94th Ave SE,Calgary,AB','T2J 3G8',1,1,'(403)255-8455','sdffsdf@wrew.retr','24234535','435345',NULL,NULL,1),(3,'Calgary Pacific Place','999 36th Street NE,Calgary,AB','T2A 7X6',1,1,'(403)569 6816','dfgdfg@sf.fsdfs','4646','46645645',NULL,NULL,1);

/*Table structure for table `tbl_states` */

DROP TABLE IF EXISTS `tbl_states`;

CREATE TABLE `tbl_states` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `country_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_states` */

insert  into `tbl_states`(`id`,`name`,`country_id`) values (1,'Alberta',2),(2,'British Columbia',2),(3,'Manitoba',2),(4,'Ontario',2);

/*Table structure for table `tbl_users` */

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `contact` int(12) DEFAULT NULL,
  `registerCode` int(6) DEFAULT '0',
  `datetime` datetime DEFAULT NULL,
  `user_type` varchar(20) DEFAULT 'customer',
  `flag` smallint(2) DEFAULT '0',
  `current_plan` varchar(20) DEFAULT NULL,
  `diet_plan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_users` */

insert  into `tbl_users`(`id`,`name`,`email`,`password`,`contact`,`registerCode`,`datetime`,`user_type`,`flag`,`current_plan`,`diet_plan`) values (1,'Admin','admin@admin.com','admin123',346546457,0,'2021-11-23 04:52:38','admin',0,'Standard Card',NULL),(3,'sahil','sahil@gmail.com','567890',2147483647,385968,'2021-11-22 22:29:11','customer',0,'','<table>\n	<thead>\n		<tr>\n			<th>Food item</th>\n			<th>Protien content</th>\n			<th>Carbohydrates</th>\n			<th>Fat</th>\n			<th>Total calories</th>\n		</tr>\n	</thead>\n	<tbody>\n		<tr>\n			<td>EGGS</td>\n			<td>4gms</td>\n			<td>0.1gms</td>\n			<td>2gms</td>\n			<td>120cal</td>\n		</tr>\n		<tr>\n			<td>MILK</td>\n			<td>1.2gms</td>\n			<td>6gm</td>\n			<td>10gms</td>\n			<td>100cal</td>\n		</tr>\n		<tr>\n			<td>PANEER</td>\n			<td>18gms</td>\n			<td>34gms</td>\n			<td>50gms</td>\n			<td>350cal</td>\n		</tr>\n		<tr>\n			<td>YOGURT</td>\n			<td>12gms</td>\n			<td>38gms</td>\n			<td>15gms</td>\n			<td>280cal</td>\n		</tr>\n		<tr>\n			<td>CHICKEN</td>\n			<td>20gms</td>\n			<td>43gms</td>\n			<td>25gms</td>\n			<td>500cal</td>\n		</tr>\n		<tr>\n			<td>OATS</td>\n			<td>5gms</td>\n			<td>32gms</td>\n			<td>12gms</td>\n			<td>200cal</td>\n		</tr>\n		<tr>\n			<td>FISH</td>\n			<td>40gms</td>\n			<td>3gms</td>\n			<td>22gms</td>\n			<td>340cal</td>\n		</tr>\n		<tr>\n			<td>PEANUT BUTTER</td>\n			<td>18gms</td>\n			<td>28gms</td>\n			<td>13gms</td>\n			<td>280cal</td>\n		</tr>\n	</tbody>\n</table>\n'),(4,'Kushal','karam354e64@gmail.com','123456',2147483647,362056,'2021-11-23 00:13:26','customer',0,'',NULL),(5,'Karam','karam999@gmail.com','123456',2147483647,223554,'2021-11-22 14:07:11','customer',0,'Standard Card',NULL),(6,'Anshu','adanshu123@admin.com','123456',2147483647,338996,'2021-11-23 18:52:24','customer',0,'Black Card','<table>\n	<thead>\n		<tr>\n			<th>Food item</th>\n			<th>Protien content</th>\n			<th>Carbohydrates</th>\n			<th>Fat</th>\n			<th>Total calories</th>\n		</tr>\n	</thead>\n	<tbody>\n		<tr>\n			<td>EGGS</td>\n			<td>4gms</td>\n			<td>0.1gms</td>\n			<td>2gms</td>\n			<td>120cal</td>\n		</tr>\n		<tr>\n			<td>MILK</td>\n			<td>1.2gms</td>\n			<td>6gm</td>\n			<td>10gms</td>\n			<td>100cal</td>\n		</tr>\n		<tr>\n			<td>PANEER</td>\n			<td>18gms</td>\n			<td>34gms</td>\n			<td>50gms</td>\n			<td>350cal</td>\n		</tr>\n		<tr>\n			<td>YOGURT</td>\n			<td>12gms</td>\n			<td>38gms</td>\n			<td>15gms</td>\n			<td>280cal</td>\n		</tr>\n		<tr>\n			<td>CHICKEN</td>\n			<td>20gms</td>\n			<td>43gms</td>\n			<td>25gms</td>\n			<td>500cal</td>\n		</tr>\n		<tr>\n			<td>OATS</td>\n			<td>5gms</td>\n			<td>32gms</td>\n			<td>12gms</td>\n			<td>200cal</td>\n		</tr>\n		<tr>\n			<td>FISH</td>\n			<td>40gms</td>\n			<td>3gms</td>\n			<td>22gms</td>\n			<td>340cal</td>\n		</tr>\n		<tr>\n			<td>PEANUT BUTTER</td>\n			<td>18gms</td>\n			<td>28gms</td>\n			<td>13gms</td>\n			<td>280cal</td>\n		</tr>\n	</tbody>\n</table>\n'),(7,'SUmit','sumit123@admin.com','123456',2147483647,633455,'2021-11-23 19:05:10','customer',0,'Standard Card',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
