/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.6.20 : Database - mvc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mvc` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `mvc`;

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ife` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `client` */

insert  into `client`(`id`,`name`,`last_name`,`email`,`ife`,`status`) values (1,'pepe','pecas','pepe@gmail.com','1234567890',1);

/*Table structure for table `client_has_movie` */

DROP TABLE IF EXISTS `client_has_movie`;

CREATE TABLE `client_has_movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `rented_units` int(11) NOT NULL,
  `total` double NOT NULL,
  `date` date NOT NULL,
  `devolution_date` date NOT NULL,
  `is_rented` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`,`client_id`,`movie_id`),
  KEY `fk_client_has_movie_movie1_idx` (`movie_id`),
  KEY `fk_client_has_movie_client1_idx` (`client_id`),
  CONSTRAINT `fk_client_has_movie_client1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_client_has_movie_movie1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `client_has_movie` */

insert  into `client_has_movie`(`id`,`client_id`,`movie_id`,`rented_units`,`total`,`date`,`devolution_date`,`is_rented`) values (1,1,2,4,40,'2015-02-04','2015-02-13',0),(2,1,2,2,20,'2015-02-04','2015-02-07',0),(3,1,2,1,10,'2015-02-05','2015-02-06',0),(4,1,2,4,40,'2015-02-05','2015-02-06',1);

/*Table structure for table `gender` */

DROP TABLE IF EXISTS `gender`;

CREATE TABLE `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `gender` */

insert  into `gender`(`id`,`name`) values (1,'ACCIÓN'),(2,'COMEDIA'),(3,'TERROR'),(4,'SUSPENSO'),(5,'DRAMA'),(6,'INFANTIL');

/*Table structure for table `movie` */

DROP TABLE IF EXISTS `movie`;

CREATE TABLE `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `format` varchar(255) NOT NULL,
  `total_units` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `price` double NOT NULL,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `rented_units` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_movie_gender1_idx` (`gender_id`),
  CONSTRAINT `fk_movie_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `movie` */

insert  into `movie`(`id`,`title`,`format`,`total_units`,`year`,`price`,`code`,`photo`,`gender_id`,`status`,`rented_units`) values (1,'peli1 ','dvd',3,2014,10,'456','hanal_pixan_icon.png',3,0,0),(2,'peli 1','dvd',12,1987,10,'qweqwe','juanito_icon.png',3,1,9);

/*Table structure for table `type_user` */

DROP TABLE IF EXISTS `type_user`;

CREATE TABLE `type_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `type_user` */

insert  into `type_user`(`id`,`name`) values (1,'ADMINISTRADOR'),(2,'EMPLEADO');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type_user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_User_type_user_idx` (`type_user_id`),
  CONSTRAINT `fk_User_type_user` FOREIGN KEY (`type_user_id`) REFERENCES `type_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`type_user_id`,`email`,`name`,`last_name`,`status`) values (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997',1,'jaime@gmail.com','jaime','negrete',1),(2,'user','12dea96fec20593566ab75692c9949596833adc9',2,'jaime@gmail.com','josé','negrete',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
