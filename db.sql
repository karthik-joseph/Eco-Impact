/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 8.3.0 : Database - ecoimpact
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ecoimpact` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `ecoimpact`;

/*Table structure for table `activities` */

DROP TABLE IF EXISTS `activities`;

CREATE TABLE `activities` (
  `activity_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `activity_type` varchar(100) DEFAULT NULL,
  `activity_date` varchar(100) DEFAULT NULL,
  `quantity` varchar(100) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `activities` */

/*Table structure for table `carbon_emission` */

DROP TABLE IF EXISTS `carbon_emission`;

CREATE TABLE `carbon_emission` (
  `emission_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `total_emmision` varchar(100) DEFAULT NULL,
  `calculation_date` varchar(100) DEFAULT NULL,
  `calculated_emission` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`emission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `carbon_emission` */

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT NULL,
  `emissionFactor` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `category` */

/*Table structure for table `complaints` */

DROP TABLE IF EXISTS `complaints`;

CREATE TABLE `complaints` (
  `complaint_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `complaint` varchar(200) DEFAULT NULL,
  `reply` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `complaints` */

/*Table structure for table `eco-points` */

DROP TABLE IF EXISTS `eco-points`;

CREATE TABLE `eco-points` (
  `point_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `points` varchar(100) DEFAULT NULL,
  `earned_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`point_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `eco-points` */

/*Table structure for table `educational_content` */

DROP TABLE IF EXISTS `educational_content`;

CREATE TABLE `educational_content` (
  `content_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content_type` varchar(100) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `tags` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `educational_content` */

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_title` varchar(100) DEFAULT NULL,
  `event_date` varchar(100) DEFAULT NULL,
  `event_time` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `rsvp_count` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `events` */

/*Table structure for table `expert` */

DROP TABLE IF EXISTS `expert`;

CREATE TABLE `expert` (
  `expert_id` int NOT NULL AUTO_INCREMENT,
  `login_id` int DEFAULT NULL,
  `fname` varchar(200) DEFAULT NULL,
  `lname` varchar(200) DEFAULT NULL,
  `place` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `dob` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`expert_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `expert` */

insert  into `expert`(`expert_id`,`login_id`,`fname`,`lname`,`place`,`phone`,`email`,`dob`) values 
(4,12,'expert','p1','kollam','1234567890','expertp1@gmial.com','2004-10-08');

/*Table structure for table `forum_comments` */

DROP TABLE IF EXISTS `forum_comments`;

CREATE TABLE `forum_comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `comment_content` varchar(100) DEFAULT NULL,
  `comment_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `forum_comments` */

/*Table structure for table `forum_posts` */

DROP TABLE IF EXISTS `forum_posts`;

CREATE TABLE `forum_posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `topic_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `post_content` varchar(100) DEFAULT NULL,
  `post_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `forum_posts` */

/*Table structure for table `forum_topics` */

DROP TABLE IF EXISTS `forum_topics`;

CREATE TABLE `forum_topics` (
  `topic_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `creator_id` int DEFAULT NULL,
  `creation_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `forum_topics` */

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `login_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `login` */

insert  into `login`(`login_id`,`username`,`password`,`user_type`) values 
(1,'admin','admin','admin'),
(12,'expertp1','Expert@p1','expert');

/*Table structure for table `product_review` */

DROP TABLE IF EXISTS `product_review`;

CREATE TABLE `product_review` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `rating` varchar(100) DEFAULT NULL,
  `review_text` varchar(100) DEFAULT NULL,
  `review_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `product_review` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `average_rating` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `products` */

/*Table structure for table `save` */

DROP TABLE IF EXISTS `save`;

CREATE TABLE `save` (
  `save_id` int NOT NULL AUTO_INCREMENT,
  `content_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`save_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `save` */

/*Table structure for table `suggestions` */

DROP TABLE IF EXISTS `suggestions`;

CREATE TABLE `suggestions` (
  `suggestions_id` int NOT NULL AUTO_INCREMENT,
  `suggestion_text` varchar(200) DEFAULT NULL,
  `impact_score` varchar(200) DEFAULT NULL,
  `ease_of_implementation` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`suggestions_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `suggestions` */

/*Table structure for table `transportaion_routes` */

DROP TABLE IF EXISTS `transportaion_routes`;

CREATE TABLE `transportaion_routes` (
  `route_id` int NOT NULL AUTO_INCREMENT,
  `start_location` varchar(100) DEFAULT NULL,
  `end_location` varchar(100) DEFAULT NULL,
  `distance_km` varchar(100) DEFAULT NULL,
  `carbon_emissions` varchar(100) DEFAULT NULL,
  `transport_mode` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `transportaion_routes` */

/*Table structure for table `user_engagement` */

DROP TABLE IF EXISTS `user_engagement`;

CREATE TABLE `user_engagement` (
  `engagement_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `engagement_type` varchar(100) DEFAULT NULL,
  `engagement_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`engagement_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user_engagement` */

/*Table structure for table `user_product_recommendation` */

DROP TABLE IF EXISTS `user_product_recommendation`;

CREATE TABLE `user_product_recommendation` (
  `recommendation_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `recommendation_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`recommendation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user_product_recommendation` */

/*Table structure for table `user_response` */

DROP TABLE IF EXISTS `user_response`;

CREATE TABLE `user_response` (
  `response_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `quest_date` varchar(100) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `response_data` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`response_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user_response` */

/*Table structure for table `user_rsvp` */

DROP TABLE IF EXISTS `user_rsvp`;

CREATE TABLE `user_rsvp` (
  `rsvp_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `event_id` int DEFAULT NULL,
  `rsvp_status` varchar(100) DEFAULT NULL,
  `rsvp_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rsvp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user_rsvp` */

/*Table structure for table `user_suggestion` */

DROP TABLE IF EXISTS `user_suggestion`;

CREATE TABLE `user_suggestion` (
  `user_suggestion_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `suggestions_id` int DEFAULT NULL,
  `implemented` varchar(100) DEFAULT NULL,
  `implementation_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_suggestion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user_suggestion` */

/*Table structure for table `user_transportatoin_choices` */

DROP TABLE IF EXISTS `user_transportatoin_choices`;

CREATE TABLE `user_transportatoin_choices` (
  `choice_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `route_id` int DEFAULT NULL,
  `choice_date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`choice_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `user_transportatoin_choices` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `login_id` int DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
