/*
 Navicat MySQL Data Transfer

 Source Server         : true-local
 Source Server Version : 50625
 Source Host           : localhost
 Source Database       : fglportal

 Target Server Version : 50625
 File Encoding         : utf-8

 Date: 02/12/2016 16:06:36 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `alert_types`
-- ----------------------------
DROP TABLE IF EXISTS `alert_types`;
CREATE TABLE `alert_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `alert_types`
-- ----------------------------
BEGIN;
INSERT INTO `alert_types` VALUES ('1', 'Correction Notice', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'Subs', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', 'Footwear Product Launch', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('4', 'Hardgoods Product Launch', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('5', 'Recalls', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('6', 'Regroups', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('7', 'Retickets', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('8', 'RTV', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `alerts`
-- ----------------------------
DROP TABLE IF EXISTS `alerts`;
CREATE TABLE `alerts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `document_id` int(10) unsigned NOT NULL,
  `alert_type_id` int(10) unsigned NOT NULL,
  `alert_start` date NOT NULL,
  `alert_end` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `alerts_banner_id_foreign` (`banner_id`),
  KEY `alerts_document_id_foreign` (`document_id`),
  KEY `alerts_alert_type_id_foreign` (`alert_type_id`),
  CONSTRAINT `alerts_alert_type_id_foreign` FOREIGN KEY (`alert_type_id`) REFERENCES `alert_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alerts_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alerts_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `alerts`
-- ----------------------------
BEGIN;
INSERT INTO `alerts` VALUES ('1', '1', '24', '1', '2016-12-25', '2017-01-01', '2016-02-12 22:00:59', '2016-02-12 22:00:59');
COMMIT;

-- ----------------------------
--  Table structure for `alerts_target`
-- ----------------------------
DROP TABLE IF EXISTS `alerts_target`;
CREATE TABLE `alerts_target` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alert_id` int(10) unsigned NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `alerts_target_alert_id_foreign` (`alert_id`),
  CONSTRAINT `alerts_target_alert_id_foreign` FOREIGN KEY (`alert_id`) REFERENCES `alerts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `alerts_target`
-- ----------------------------
BEGIN;
INSERT INTO `alerts_target` VALUES ('1', '1', '392', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `banner_user`
-- ----------------------------
DROP TABLE IF EXISTS `banner_user`;
CREATE TABLE `banner_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banner_user_banner_id_foreign` (`banner_id`),
  KEY `banner_user_user_id_foreign` (`user_id`),
  CONSTRAINT `banner_user_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `banner_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `banner_user`
-- ----------------------------
BEGIN;
INSERT INTO `banner_user` VALUES ('1', '1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('2', '2', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
COMMIT;

-- ----------------------------
--  Table structure for `banners`
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_type_id` int(10) unsigned NOT NULL,
  `update_window_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `banners`
-- ----------------------------
BEGIN;
INSERT INTO `banners` VALUES ('1', 'Sport Chek', 'Sportchek', 'Week 2 (Feb 8 - 14)', 'reclaimedwood_6-2015-05-12-1539_jpg_4991844f8df6d37f955e3e9f739d82f5afb12a58.jpg', '0000-00-00 00:00:00', '2016-02-12 16:48:06', '2', '8'), ('2', 'Atmosphere', '', '', 'atmo-bg.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '10');
COMMIT;

-- ----------------------------
--  Table structure for `communication_document`
-- ----------------------------
DROP TABLE IF EXISTS `communication_document`;
CREATE TABLE `communication_document` (
  `id` int(10) unsigned NOT NULL,
  `communication_id` int(10) unsigned NOT NULL,
  `document_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `communication_document_communication_id_foreign` (`communication_id`),
  KEY `communication_document_document_id_foreign` (`document_id`),
  CONSTRAINT `communication_document_communication_id_foreign` FOREIGN KEY (`communication_id`) REFERENCES `communications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `communication_document_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communication_document`
-- ----------------------------
BEGIN;
INSERT INTO `communication_document` VALUES ('0', '20', '23', '2016-02-12 20:24:46', '2016-02-12 20:24:46', null), ('0', '20', '24', '2016-02-12 20:24:46', '2016-02-12 20:24:46', null), ('0', '20', '28', '2016-02-12 20:24:46', '2016-02-12 20:24:46', null), ('0', '20', '29', '2016-02-12 20:24:46', '2016-02-12 20:24:46', null);
COMMIT;

-- ----------------------------
--  Table structure for `communication_importance_levels`
-- ----------------------------
DROP TABLE IF EXISTS `communication_importance_levels`;
CREATE TABLE `communication_importance_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communication_importance_levels`
-- ----------------------------
BEGIN;
INSERT INTO `communication_importance_levels` VALUES ('1', 'High', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'Normal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', 'Low', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `communication_package`
-- ----------------------------
DROP TABLE IF EXISTS `communication_package`;
CREATE TABLE `communication_package` (
  `id` int(10) unsigned NOT NULL,
  `communication_id` int(10) unsigned NOT NULL,
  `package_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `communication_package_communication_id_foreign` (`communication_id`),
  KEY `communication_package_package_id_foreign` (`package_id`),
  CONSTRAINT `communication_package_communication_id_foreign` FOREIGN KEY (`communication_id`) REFERENCES `communications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `communication_package_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communication_package`
-- ----------------------------
BEGIN;
INSERT INTO `communication_package` VALUES ('0', '20', '2', '2016-02-12 20:24:46', '2016-02-12 20:24:46', null);
COMMIT;

-- ----------------------------
--  Table structure for `communication_types`
-- ----------------------------
DROP TABLE IF EXISTS `communication_types`;
CREATE TABLE `communication_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `communication_type` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `colour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `communication_types_banner_id_foreign` (`banner_id`),
  CONSTRAINT `communication_types_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communication_types`
-- ----------------------------
BEGIN;
INSERT INTO `communication_types` VALUES ('1', 'no category', '', '1', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('8', 'Weekly Planning', 'primary', '1', null, '2016-02-09 20:21:58', '2016-02-09 20:21:58'), ('9', 'Jumpstart', 'danger', '1', null, '2016-02-09 20:25:07', '2016-02-09 20:25:07'), ('10', 'Curry Recipes', 'warning', '1', null, '2016-02-09 20:26:52', '2016-02-09 20:26:52');
COMMIT;

-- ----------------------------
--  Table structure for `communications`
-- ----------------------------
DROP TABLE IF EXISTS `communications`;
CREATE TABLE `communications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `importance` int(10) unsigned NOT NULL,
  `communication_type_id` int(10) unsigned NOT NULL,
  `send_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `archive_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_draft` tinyint(1) NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `communications_importance_foreign` (`importance`),
  KEY `communications_banner_id_foreign` (`banner_id`),
  KEY `communications_communication_type_id_foreign` (`communication_type_id`),
  CONSTRAINT `communications_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `communications_communication_type_id_foreign` FOREIGN KEY (`communication_type_id`) REFERENCES `communication_types` (`id`),
  CONSTRAINT `communications_importance_foreign` FOREIGN KEY (`importance`) REFERENCES `communication_importance_levels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communications`
-- ----------------------------
BEGIN;
INSERT INTO `communications` VALUES ('12', 'asdasd', '<p>adfd dsf adsf das fsa</p>\r\n', '', '1', '8', '2016-02-09 00:00:00', '2016-02-23 00:00:00', '0', '1', '2016-02-10 19:20:17', '2016-02-10 19:20:17', null), ('13', 'this is a message', '<p>bv rsgvefve</p>\n', '', '1', '9', '2016-02-10 00:00:00', '2016-02-22 00:00:00', '0', '1', '2016-02-10 21:42:48', '2016-02-10 21:42:48', null), ('14', 'this is a message', '<p>daf adf adf adf adf ad fs</p>\n', '', '1', '10', '2016-02-09 00:00:00', '2016-02-15 00:00:00', '0', '1', '2016-02-10 21:45:21', '2016-02-10 21:45:21', null), ('16', 'dadfasd', '<p>asdasdasd</p>\n', '', '1', '1', '2016-02-02 00:00:00', '0000-00-00 00:00:00', '0', '1', '2016-02-11 20:51:14', '2016-02-11 20:51:14', null), ('17', 'dadfasd', '<p>asdasdasd</p>\n', '', '1', '1', '2016-02-02 00:00:00', '0000-00-00 00:00:00', '0', '1', '2016-02-11 20:51:50', '2016-02-11 20:51:50', null), ('18', 'this is a message', '<h2 style=\"font-style:italic\">This is a fancy message lorem</h2>\n\n<p><span class=\"marker\"><big>Lorem ipsum dolor</big> sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>\n\n<div style=\"background:#eee;border:1px solid #ccc;padding:5px 10px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n', '', '1', '1', '2016-02-11 00:00:00', '2016-03-28 00:00:00', '0', '1', '2016-02-11 23:06:23', '2016-02-11 23:40:22', null), ('19', 'hello out there', '<blockquote>\n<p><del>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</del> sed do eiusmod tempor <small>incididunt</small> ut labore et dolore magna aliqua. Ut enim ad minim <ins>veniam, quis nostrud exercitation ullamco laboris nisi ut </ins>aliquip ex ea <span class=\"marker\">commodo consequat</span>. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non <big>proident</big>, sunt in c<q>ulpa qui officia deserunt mollit anim id est laborum</q></p>\n</blockquote>\n\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\n	<tbody>\n		<tr>\n			<td>hello</td>\n			<td>this</td>\n		</tr>\n		<tr>\n			<td>is</td>\n			<td>my</td>\n		</tr>\n		<tr>\n			<td>crqazy</td>\n			<td>table</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n\n<p><tt>&diams;►Lorem ipsum <a href=\"http://google.com\">dolor sit amet</a>, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore</tt> et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n', '', '1', '10', '2016-02-09 00:00:00', '0000-00-00 00:00:00', '0', '1', '2016-02-11 23:57:01', '2016-02-11 23:57:01', null), ('20', 'testing the docs', '<p>dks ldsf kldsf ldskf sldkf ldskf lkdsf lkds flkds flkds flkds flkds flsdkf ds</p>\n', '', '1', '1', '2016-02-02 00:00:00', '2016-03-01 00:00:00', '0', '1', '2016-02-12 20:24:45', '2016-02-12 20:24:45', null);
COMMIT;

-- ----------------------------
--  Table structure for `communications_target`
-- ----------------------------
DROP TABLE IF EXISTS `communications_target`;
CREATE TABLE `communications_target` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `communication_id` int(11) NOT NULL,
  `store_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `is_read` binary(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communications_target`
-- ----------------------------
BEGIN;
INSERT INTO `communications_target` VALUES ('15', '13', '0392', null, '2016-02-10 21:45:21', '2016-02-11 22:40:59', null), ('16', '14', '0392', 0x31, '2016-02-10 21:45:21', '2016-02-12 18:22:51', null), ('17', '12', '0392', 0x31, '2016-02-10 21:45:21', '2016-02-12 18:22:24', null), ('19', '18', '0392', 0x31, '2016-02-11 20:51:50', '2016-02-11 23:42:09', null), ('213', '19', '0392', 0x31, '2016-02-11 23:57:01', '2016-02-11 23:57:26', null), ('214', '20', '0392', null, '2016-02-12 20:24:46', '2016-02-12 20:24:46', null);
COMMIT;

-- ----------------------------
--  Table structure for `content_tag`
-- ----------------------------
DROP TABLE IF EXISTS `content_tag`;
CREATE TABLE `content_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `content_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `content_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `content_tag`
-- ----------------------------
BEGIN;
INSERT INTO `content_tag` VALUES ('4', '3', 'event', '2', '2016-01-06 20:32:26', '2016-01-06 20:32:26', null), ('5', '4', 'event', '1', '2016-01-06 23:17:26', '2016-01-06 23:17:26', null), ('6', '5', 'event', '2', '2016-01-06 23:19:25', '2016-01-06 23:19:25', null), ('7', '2', 'event', '2', '2016-01-06 23:21:47', '2016-01-06 23:21:47', null), ('8', '6', 'event', '1', '2016-01-07 00:10:13', '2016-01-07 00:10:13', null), ('11', '3', 'folder', '2', '2016-01-08 23:07:59', '2016-01-08 23:07:59', null), ('12', '2', 'document', '2', '2016-01-12 17:12:40', '2016-01-12 17:12:40', null), ('13', '242', 'folder', '1', '2016-01-25 16:47:24', '2016-01-25 16:47:24', null), ('14', '242', 'folder', '2', '2016-01-25 16:47:24', '2016-01-25 16:47:24', null), ('15', '13', 'event', '1', '2016-02-04 20:16:46', '2016-02-04 20:16:46', null);
COMMIT;

-- ----------------------------
--  Table structure for `dashboard_branding`
-- ----------------------------
DROP TABLE IF EXISTS `dashboard_branding`;
CREATE TABLE `dashboard_branding` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard_branding_banner_id_foreign` (`banner_id`),
  CONSTRAINT `dashboard_branding_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `dashboard_branding`
-- ----------------------------
BEGIN;
INSERT INTO `dashboard_branding` VALUES ('1', '1', 'hockey.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
COMMIT;

-- ----------------------------
--  Table structure for `document_package`
-- ----------------------------
DROP TABLE IF EXISTS `document_package`;
CREATE TABLE `document_package` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) unsigned NOT NULL,
  `package_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `document_package_document_id_index` (`document_id`),
  KEY `document_package_package_id_index` (`package_id`),
  CONSTRAINT `document_package_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `document_package_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `document_package`
-- ----------------------------
BEGIN;
INSERT INTO `document_package` VALUES ('1', '23', '1', null, '2016-02-08 18:40:21', '2016-02-08 18:40:21'), ('2', '29', '1', null, '2016-02-08 18:40:21', '2016-02-08 18:40:21'), ('3', '30', '1', null, '2016-02-08 18:40:21', '2016-02-08 18:40:21'), ('4', '31', '1', null, '2016-02-08 18:40:21', '2016-02-08 18:40:21'), ('5', '29', '2', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('6', '30', '2', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('7', '23', '2', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('9', '19', '2', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('10', '22', '2', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `documents`
-- ----------------------------
DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `upload_package_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_banner_id_foreign` (`banner_id`),
  CONSTRAINT `documents_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `documents`
-- ----------------------------
BEGIN;
INSERT INTO `documents` VALUES ('19', '428fc664627b18336864676159b95256c914dd6f', 'BTS_webapp_2015-12-23.sql', 'sql', 'BTS_webapp_2015-12-23_sql_bbbc405f6cbce450a1866ca37d2da66963199f54.sql', 'no title', 'no description', '1', '2013-06-27 23:24:07', '2013-07-01 23:24:07', '', ''), ('22', '428fc664627b18336864676159b95256c914dd6f', 'mountains.jpg', 'jpg', 'mountains_jpg_56e8981ea17497ba8b384ed06f9d5d364a04a09f.jpg', 'no title', 'no description', '1', '2016-01-25 23:24:08', '2016-01-25 23:24:08', '', ''), ('23', '98100b13b4b92e614f585f53406e2cef1f7a0bf8', 'placeholder.pdf', 'pdf', 'placeholder_pdf_1a75de24861e8b2128f58e1f0fec7cfdbdfbf69a.pdf', 'placeholder', 'aefsdgs', '1', '2016-01-26 16:27:31', '2016-01-26 16:59:34', '2016-01-26 09:59:23', ''), ('24', '18d6bd08a072a6151086d6c81d6e0ac2c84f1ea1', 'TCE_Behaviors Assessment_Cash 2013.pdf', 'pdf', 'TCE_Behaviors_Assessment_Cash_2013_pdf_9d09f9a503c1b135e0ffd4eabb151014aed95264.pdf', 'TCE_Behaviors Assessment_Cash 2013', 'this si sometinigsag wig', '1', '2016-01-26 17:01:23', '2016-01-26 17:02:13', '2016-12-25 10:01:27', '2017-01-01 00:00:00'), ('26', '6878d6193497c7f75d48a5a9084aa7f414f624f9', 'placeholder.pdf', 'pdf', 'placeholder_pdf_dbf7ec6b6248c07cdb586a297f312ed94d104af5.pdf', 'placeholder', '', '1', '2016-01-26 20:56:38', '2016-01-26 20:56:46', '2016-01-26 13:56:44', ''), ('27', '6878d6193497c7f75d48a5a9084aa7f414f624f9', 'ManagerWeb_Content_Overview.pdf', 'pdf', 'ManagerWeb_Content_Overview_pdf_db0b2b997759e2b46d0c0ae1a73bdd61db9569af.pdf', 'ManagerWeb_Content_Overview', '', '1', '2016-01-26 20:56:41', '2016-01-26 20:56:47', '2016-01-26 13:56:44', ''), ('28', 'aa55a70e461b9943f6180ff4e4409d8608c1a263', 'CBV_Softgoods_1.mp4', 'mp4', 'CBV_Softgoods_1_mp4_c05979bc41e3d3154bb2e78fb18280a1393298cf.mp4', 'CBV_Softgoods_1', 'Katie talks about Keeping your head up', '1', '2016-01-29 00:14:07', '2016-01-29 00:14:21', '2016-01-28 17:14:09', ''), ('29', '806b7c0fda20e8466b50a2b244975436e2f6d4e6', 'CBV_Atmo_1.mp4', 'mp4', 'CBV_Atmo_1_mp4_d3a30ada72b98087badc236f75ebce1cd69ac159.mp4', 'CBV_Atmo_1', 'goran', '1', '2016-01-29 16:18:46', '2016-01-29 16:18:55', '2016-01-29 09:18:50', ''), ('30', 'c67a9690d81dab864ba1d9c12ec325880676c43c', 'placeholder2.pdf', 'pdf', 'placeholder2_pdf_9ae5de33a3d4dcbd663fd6aec8c1555fe2f6fc44.pdf', 'lkdflk dlfk dlskf ldskf', 'klkf adlk af laf lkf', '1', '2016-01-29 19:56:34', '2016-01-29 19:56:53', '2016-01-29 12:56:38', ''), ('31', 'ac2f8f7a249183ae81083f265396b55ccf886806', 'placeholder2.pdf', 'pdf', 'placeholder2_pdf_fb5d9e131bc3a69c0f9abdec932228c3960e1378.pdf', 'placeholder2', '', '1', '2016-01-29 19:57:32', '2016-01-29 19:57:39', '2016-01-29 12:57:37', '');
COMMIT;

-- ----------------------------
--  Table structure for `event_types`
-- ----------------------------
DROP TABLE IF EXISTS `event_types`;
CREATE TABLE `event_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_type` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `event_types_banner_id_foreign` (`banner_id`),
  CONSTRAINT `event_types_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `event_types`
-- ----------------------------
BEGIN;
INSERT INTO `event_types` VALUES ('10', 'sc some type of event', '1', '2016-01-07 17:16:37', '2016-01-06 20:30:54', '2016-01-07 17:16:37'), ('11', 'dfsdfasdf', '2', null, '2016-01-06 22:54:21', '2016-01-06 22:54:21'), ('12', 'sc wgrafsfagfsag', '1', '2016-01-07 00:07:39', '2016-01-06 22:54:31', '2016-01-07 00:07:39'), ('13', 'this is atmo only', '2', null, '2016-01-06 23:05:12', '2016-01-06 23:05:12'), ('14', 'hadhfladf', '1', null, '2016-01-07 17:16:44', '2016-01-07 17:16:44'), ('15', 'adasdas', '1', null, '2016-01-07 17:16:48', '2016-01-07 17:16:48'), ('16', 'sadasd', '1', null, '2016-01-07 17:16:51', '2016-01-07 17:16:51'), ('17', 'asdsad', '1', null, '2016-01-07 17:16:54', '2016-01-07 17:16:54'), ('18', 'Change Over', '1', null, '2016-02-04 20:14:44', '2016-02-04 20:14:44');
COMMIT;

-- ----------------------------
--  Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `event_type` int(10) unsigned NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `events_banner_id_foreign` (`banner_id`),
  KEY `events_event_type_foreign` (`event_type`),
  CONSTRAINT `events_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`),
  CONSTRAINT `events_event_type_foreign` FOREIGN KEY (`event_type`) REFERENCES `event_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `events`
-- ----------------------------
BEGIN;
INSERT INTO `events` VALUES ('2', '1', 'Colours', 'this is a better desc', '10', '2016-01-13', '2016-01-14', '2016-01-25 16:48:39', '2016-01-06 20:31:15', '2016-01-25 16:48:39'), ('3', '1', 'ad', 'ads asd sad as', '10', '2016-01-13', '2016-01-20', null, '2016-01-06 20:32:26', '2016-01-07 00:08:34'), ('4', '2', 'this is a test event atmo', 'adfadf', '13', '2016-01-28', '2016-01-05', null, '2016-01-06 23:17:26', '2016-01-06 23:17:26'), ('6', '1', 'sc event', 'this is something that’s happening', '10', '2016-01-14', '2016-01-20', null, '2016-01-07 00:10:12', '2016-01-07 17:11:33'), ('7', '1', 'vadcads', 'sda', '14', '2016-01-06', '2016-01-19', null, '2016-01-08 18:33:21', '2016-01-08 18:33:21'), ('10', '1', 'Spring Change Over', 'this is thdkf lkd flkad flka flka f', '18', '2016-02-29', '2016-03-14', null, '2016-02-04 20:16:31', '2016-02-04 20:16:31'), ('11', '1', 'Spring Change Over', 'this is thdkf lkd flkad flka flka f', '18', '2016-02-29', '2016-03-14', '2016-02-04 20:17:27', '2016-02-04 20:16:33', '2016-02-04 20:17:27'), ('12', '1', 'Spring Change Over', 'this is thdkf lkd flkad flka flka f', '18', '2016-02-29', '2016-03-14', '2016-02-04 20:17:24', '2016-02-04 20:16:39', '2016-02-04 20:17:24'), ('13', '1', 'Spring Change Over', 'this is thdkf lkd flkad flka flka f', '18', '2016-02-29', '2016-03-14', '2016-02-04 20:17:13', '2016-02-04 20:16:46', '2016-02-04 20:17:13');
COMMIT;

-- ----------------------------
--  Table structure for `feature_document`
-- ----------------------------
DROP TABLE IF EXISTS `feature_document`;
CREATE TABLE `feature_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) unsigned NOT NULL,
  `feature_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `feature_document_document_id_foreign` (`document_id`),
  KEY `feature_document_feature_id_foreign` (`feature_id`),
  CONSTRAINT `feature_document_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `feature_document_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `feature_document`
-- ----------------------------
BEGIN;
INSERT INTO `feature_document` VALUES ('1', '23', '13', '2016-02-04 20:09:46', '2016-02-04 20:09:46'), ('2', '24', '13', '2016-02-04 20:09:46', '2016-02-04 20:09:46'), ('3', '28', '13', '2016-02-04 20:09:46', '2016-02-04 20:09:46'), ('4', '30', '13', '2016-02-04 20:09:46', '2016-02-04 20:09:46');
COMMIT;

-- ----------------------------
--  Table structure for `feature_latest_update_types`
-- ----------------------------
DROP TABLE IF EXISTS `feature_latest_update_types`;
CREATE TABLE `feature_latest_update_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `feature_latest_update_types`
-- ----------------------------
BEGIN;
INSERT INTO `feature_latest_update_types` VALUES ('1', 'By Days', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'By Document Count', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `feature_package`
-- ----------------------------
DROP TABLE IF EXISTS `feature_package`;
CREATE TABLE `feature_package` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int(10) unsigned NOT NULL,
  `feature_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `feature_package_package_id_foreign` (`package_id`),
  KEY `feature_package_feature_id_foreign` (`feature_id`),
  CONSTRAINT `feature_package_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  CONSTRAINT `feature_package_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `feature_package`
-- ----------------------------
BEGIN;
INSERT INTO `feature_package` VALUES ('1', '1', '20', '2016-02-08 18:42:13', '2016-02-08 18:42:13'), ('2', '2', '20', '2016-02-08 11:46:06', '2016-02-10 11:46:12');
COMMIT;

-- ----------------------------
--  Table structure for `features`
-- ----------------------------
DROP TABLE IF EXISTS `features`;
CREATE TABLE `features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `tile_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `background_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `update_type_id` int(10) unsigned NOT NULL,
  `update_frequency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `features_banner_id_foreign` (`banner_id`),
  KEY `features_update_type_id_foreign` (`update_type_id`),
  CONSTRAINT `features_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `features_update_type_id_foreign` FOREIGN KEY (`update_type_id`) REFERENCES `feature_latest_update_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `features`
-- ----------------------------
BEGIN;
INSERT INTO `features` VALUES ('9', '1', '4', 'My test', 'This is a test', '', 'calgary-flames_jpg_bb3267ea75911e570f9e6215074bf55decdd0b4b.jpg', '2016-02-02', '2016-03-01', null, '2016-02-03 21:08:33', '2016-02-08 18:42:24', '635879112155223228-319755513_635861833670816810507191518_6670-perfect-snow-1920x1080-nature-wallpaper_jpg_fe16c358c68c34cb5f37066848930b8bcea25024.jpg', '1', '10'), ('10', '1', '0', 'moutain test', 'some mountain page', '', 'K2,_Mount_Godwin_Austen,_Chogori,_Savage_Mountain_jpg_e97a7aea9be33de0287d51088e37822ebaef0b9b.jpg', '2016-02-02', '2016-03-01', '2016-02-04 20:13:43', '2016-02-03 22:13:38', '2016-02-04 20:13:43', 'CZtM0eVWwAMCE0H_jpg_e97a7aea9be33de0287d51088e37822ebaef0b9b.jpg', '1', '10'), ('12', '1', '1', 'snow test', 'sdfdas', '', '635879112155223228-319755513_635861833670816810507191518_6670-perfect-snow-1920x1080-nature-wallpaper_jpg_c917f9e4e852cb1ccb3ce1ead90a34b279db057d.jpg', '2016-02-01', '2016-02-29', null, '2016-02-03 22:19:53', '2016-02-08 18:42:24', 'K2,_Mount_Godwin_Austen,_Chogori,_Savage_Mountain_jpg_c917f9e4e852cb1ccb3ce1ead90a34b279db057d.jpg', '1', '10'), ('13', '1', '0', 'Test for D', '', '', 'K2,_Mount_Godwin_Austen,_Chogori,_Savage_Mountain_jpg_491401ad2559f1542f6968e4c433812117c5a084.jpg', '2016-02-01', '2016-02-29', '2016-02-04 20:13:39', '2016-02-04 20:09:46', '2016-02-04 20:13:39', 'CZtM0eVWwAMCE0H_jpg_491401ad2559f1542f6968e4c433812117c5a084.jpg', '1', '10'), ('14', '1', '5', 'test trees', '', '', 'fader2-1080x400_jpg_fe16c358c68c34cb5f37066848930b8bcea25024.jpg', '0000-00-00', '0000-00-00', null, '2016-02-04 20:22:50', '2016-02-08 18:42:24', '635879112155223228-319755513_635861833670816810507191518_6670-perfect-snow-1920x1080-nature-wallpaper_jpg_fe16c358c68c34cb5f37066848930b8bcea25024.jpg', '1', '10'), ('15', '1', '6', 'k2', '', '', 'K2,_Mount_Godwin_Austen,_Chogori,_Savage_Mountain_jpg_b061793be50c1af8dcbc4a0d0933c4423203a2de.jpg', '0000-00-00', '0000-00-00', null, '2016-02-04 20:23:52', '2016-02-08 18:42:25', 'K2,_Mount_Godwin_Austen,_Chogori,_Savage_Mountain_jpg_b061793be50c1af8dcbc4a0d0933c4423203a2de.jpg', '1', '10'), ('17', '1', '2', 'Square test', '', '', 'cubic2-2015-03-26-2045_jpg_2c2db9dd2cb3a9cad44bc96809a374b20fc993e9.jpg', '0000-00-00', '0000-00-00', null, '2016-02-05 20:01:56', '2016-02-08 18:42:24', '1FB31573-F028-CA93-222D200AC89C6BCE_jpg_2c2db9dd2cb3a9cad44bc96809a374b20fc993e9.jpg', '1', '10'), ('18', '1', '3', 'salty', '', '', '________10138_-2016-01-12-1719_jpg_be2a74ce7f93a8742fdc294cd2e56ee8be955789.jpg', '0000-00-00', '0000-00-00', '2016-02-12 16:45:12', '2016-02-05 20:14:15', '2016-02-12 16:45:12', 'CZtM0eVWwAMCE0H_jpg_be2a74ce7f93a8742fdc294cd2e56ee8be955789.jpg', '1', '10'), ('20', '1', '0', 'Sample Feature', 'so excited', '', '9329667985_1fc36ce96d_o-2015-11-04-1942_jpg_44bba4d8933d94b5baff667155ae9a9fe78c7f27.jpg', '2016-02-02', '2016-02-23', null, '2016-02-08 18:42:13', '2016-02-08 18:42:13', 'mount_fuji_japan-wide-2016-01-22-1637_jpg_44bba4d8933d94b5baff667155ae9a9fe78c7f27.jpg', '2', '5');
COMMIT;

-- ----------------------------
--  Table structure for `file_folder`
-- ----------------------------
DROP TABLE IF EXISTS `file_folder`;
CREATE TABLE `file_folder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `document_id` int(10) unsigned NOT NULL,
  `folder_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `file_folder_document_id_foreign` (`document_id`),
  CONSTRAINT `file_folder_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `file_folder`
-- ----------------------------
BEGIN;
INSERT INTO `file_folder` VALUES ('19', '19', '239', '2016-01-25 23:24:07', '2016-01-25 23:24:07'), ('22', '22', '239', '2016-01-25 23:24:08', '2016-01-25 23:24:08'), ('23', '23', '248', '2016-01-26 16:27:31', '2016-01-26 16:27:31'), ('24', '24', '248', '2016-01-26 17:01:23', '2016-01-26 17:01:23'), ('26', '26', '219', '2016-01-26 20:56:38', '2016-01-26 20:56:38'), ('27', '27', '219', '2016-01-26 20:56:41', '2016-01-26 20:56:41'), ('28', '28', '248', '2016-01-29 00:14:07', '2016-01-29 00:14:07'), ('29', '29', '248', '2016-01-29 16:18:47', '2016-01-29 16:18:47'), ('30', '30', '248', '2016-01-29 19:56:34', '2016-01-29 19:56:34'), ('31', '31', '248', '2016-01-29 19:57:32', '2016-01-29 19:57:32');
COMMIT;

-- ----------------------------
--  Table structure for `folder_ids`
-- ----------------------------
DROP TABLE IF EXISTS `folder_ids`;
CREATE TABLE `folder_ids` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `folder_id` int(11) NOT NULL,
  `folder_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folder_ids`
-- ----------------------------
BEGIN;
INSERT INTO `folder_ids` VALUES ('1', '1', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', '2', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', '3', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('54', '6', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('56', '49', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('57', '50', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('58', '51', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('59', '52', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('60', '53', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('61', '54', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('62', '55', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('63', '56', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('64', '57', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('65', '58', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('66', '59', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('67', '60', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('68', '61', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('69', '62', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('70', '63', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('71', '64', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('72', '65', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('73', '66', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('74', '67', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('75', '68', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('76', '69', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('77', '70', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('78', '71', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('79', '72', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('80', '73', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('81', '74', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('82', '75', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('83', '76', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('84', '77', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('85', '78', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('86', '79', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('87', '80', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('88', '81', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('89', '82', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('90', '83', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('91', '84', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('92', '85', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('93', '86', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('94', '87', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('95', '88', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('96', '89', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('97', '90', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('98', '91', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('99', '92', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('100', '93', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('101', '94', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('102', '95', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('103', '96', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('104', '8', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('105', '9', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('106', '10', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('107', '11', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('111', '97', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('112', '98', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('113', '99', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('114', '100', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('115', '101', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('116', '102', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('117', '103', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('118', '104', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('119', '105', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('120', '106', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('121', '107', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('122', '108', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('123', '109', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('124', '110', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('125', '111', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('126', '112', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('127', '113', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('128', '114', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('129', '115', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('130', '116', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('131', '117', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('132', '118', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('133', '119', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('134', '120', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('135', '121', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('136', '122', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('137', '123', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('138', '124', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('139', '125', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('140', '126', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('141', '127', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('142', '128', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('143', '129', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('144', '130', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('145', '131', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('146', '132', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('147', '133', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('148', '134', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('149', '135', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('150', '136', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('151', '137', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('152', '138', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('153', '139', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('154', '140', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('155', '141', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('156', '142', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('157', '143', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('158', '144', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('160', '145', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('161', '146', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('162', '147', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('163', '148', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('164', '149', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('165', '150', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('166', '151', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('167', '152', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('168', '153', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('169', '154', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('170', '155', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('171', '156', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('172', '157', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('173', '158', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('174', '159', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('175', '160', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('176', '161', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('177', '162', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('178', '163', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('179', '164', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('180', '165', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('181', '166', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('182', '167', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('183', '168', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('184', '169', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('185', '170', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('186', '171', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('187', '172', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('188', '173', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('189', '174', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('190', '175', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('191', '176', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('192', '177', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('193', '178', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('194', '179', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('195', '180', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('196', '181', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('197', '182', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('198', '183', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('199', '184', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('200', '185', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('201', '186', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('202', '187', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('203', '188', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('204', '189', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('205', '190', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('206', '191', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('207', '192', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('218', '26', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('219', '27', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('220', '28', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('222', '30', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('224', '32', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('225', '33', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('227', '35', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('228', '36', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('229', '37', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('230', '38', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('231', '39', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('232', '40', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('233', '41', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('234', '42', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('235', '43', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('236', '44', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('239', '47', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('240', '48', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('241', '49', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('242', '50', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('243', '51', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('244', '52', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('245', '53', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('247', '55', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('248', '56', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `folder_package`
-- ----------------------------
DROP TABLE IF EXISTS `folder_package`;
CREATE TABLE `folder_package` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_id` int(10) unsigned NOT NULL,
  `folder_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `folder_package_package_id_foreign` (`package_id`),
  KEY `folder_package_folder_id_foreign` (`folder_id`),
  CONSTRAINT `folder_package_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folder_ids` (`id`) ON DELETE CASCADE,
  CONSTRAINT `folder_package_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folder_package`
-- ----------------------------
BEGIN;
INSERT INTO `folder_package` VALUES ('1', '1', '248', '2016-02-08 18:40:21', '2016-02-08 18:40:21'), ('2', '1', '227', '2016-02-08 18:40:21', '2016-02-08 18:40:21');
COMMIT;

-- ----------------------------
--  Table structure for `folder_struct`
-- ----------------------------
DROP TABLE IF EXISTS `folder_struct`;
CREATE TABLE `folder_struct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` int(10) unsigned NOT NULL,
  `child` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `folder_struct_parent_foreign` (`parent`),
  KEY `folder_struct_child_foreign` (`child`),
  CONSTRAINT `folder_struct_child_foreign` FOREIGN KEY (`child`) REFERENCES `folders` (`id`),
  CONSTRAINT `folder_struct_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `folders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folder_struct`
-- ----------------------------
BEGIN;
INSERT INTO `folder_struct` VALUES ('1', '1', '2', '2016-01-07 20:54:30', '2016-01-07 20:54:30'), ('2', '1', '3', '2016-01-07 20:54:30', '2016-01-07 20:54:30'), ('4', '2', '6', '2016-01-08 16:54:24', '2016-01-08 16:54:24'), ('6', '1', '8', '2016-01-08 20:53:32', '2016-01-08 20:53:32'), ('7', '6', '9', '2016-01-08 20:53:50', '2016-01-08 20:53:50'), ('8', '9', '10', '2016-01-08 21:49:07', '2016-01-08 21:49:07'), ('9', '9', '11', '2016-01-08 21:49:07', '2016-01-08 21:49:07'), ('22', '11', '26', '2016-01-08 23:05:35', '2016-01-08 23:05:35'), ('23', '11', '27', '2016-01-08 23:05:35', '2016-01-08 23:05:35'), ('24', '11', '28', '2016-01-08 23:05:35', '2016-01-08 23:05:35'), ('27', '3', '32', '2016-01-08 23:08:00', '2016-01-08 23:08:00'), ('28', '3', '33', '2016-01-08 23:08:00', '2016-01-08 23:08:00'), ('30', '27', '35', '2016-01-08 23:24:10', '2016-01-08 23:24:10'), ('31', '27', '36', '2016-01-08 23:24:10', '2016-01-08 23:24:10'), ('32', '27', '37', '2016-01-08 23:24:10', '2016-01-08 23:24:10'), ('33', '27', '38', '2016-01-08 23:24:10', '2016-01-08 23:24:10'), ('34', '27', '39', '2016-01-08 23:24:10', '2016-01-08 23:24:10'), ('35', '40', '41', '2016-01-11 18:14:40', '2016-01-11 18:14:40'), ('36', '40', '42', '2016-01-11 18:14:40', '2016-01-11 18:14:40'), ('37', '40', '43', '2016-01-11 18:14:40', '2016-01-11 18:14:40'), ('38', '43', '44', '2016-01-21 22:11:23', '2016-01-21 22:11:23'), ('41', '43', '47', '2016-01-21 22:11:23', '2016-01-21 22:11:23'), ('42', '47', '50', '2016-01-25 16:46:27', '2016-01-25 16:46:27'), ('43', '47', '51', '2016-01-25 16:46:27', '2016-01-25 16:46:27'), ('44', '47', '52', '2016-01-25 16:46:27', '2016-01-25 16:46:27'), ('45', '47', '53', '2016-01-25 16:46:28', '2016-01-25 16:46:28'), ('47', '50', '55', '2016-01-25 16:47:24', '2016-01-25 16:47:24');
COMMIT;

-- ----------------------------
--  Table structure for `folders`
-- ----------------------------
DROP TABLE IF EXISTS `folders`;
CREATE TABLE `folders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `has_child` tinyint(1) NOT NULL,
  `is_child` tinyint(1) NOT NULL,
  `has_weeks` tinyint(1) NOT NULL,
  `week_window_size` int(11) NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `last_activity_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `folders_banner_id_foreign` (`banner_id`),
  CONSTRAINT `folders_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folders`
-- ----------------------------
BEGIN;
INSERT INTO `folders` VALUES ('1', 'thing', '2016-01-07 20:49:55', '2016-01-07 20:54:30', '1', '0', '0', '0', '1', '2016-01-26 20:56:47'), ('2', 'somthine else', '2016-01-07 20:54:30', '2016-01-08 16:54:24', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('3', 'another', '2016-01-07 20:54:30', '2016-01-08 23:08:00', '1', '1', '0', '0', '1', '2016-01-08 23:08:00'), ('6', 'testing the modal', '2016-01-08 16:54:24', '2016-01-08 20:53:50', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('8', 'something', '2016-01-08 20:53:32', '2016-01-08 20:53:32', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('9', 'bird', '2016-01-08 20:53:50', '2016-01-11 18:13:56', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('10', '1', '2016-01-08 21:49:07', '2016-01-08 21:49:07', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('11', '2', '2016-01-08 21:49:07', '2016-01-08 23:05:35', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('26', 'this', '2016-01-08 23:05:35', '2016-01-08 23:05:35', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('27', 'something totally different', '2016-01-08 23:05:35', '2016-01-21 22:10:36', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('28', 'sub', '2016-01-08 23:05:35', '2016-01-08 23:05:35', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('30', 'jlljh', '2016-01-08 23:07:40', '2016-01-08 23:07:40', '0', '0', '0', '0', '1', '0000-00-00 00:00:00'), ('32', 'dsa', '2016-01-08 23:08:00', '2016-01-08 23:08:00', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('33', 'sadsdsad', '2016-01-08 23:08:00', '2016-01-08 23:08:00', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('35', 'hehksdflsdkf', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '2016-01-12 22:13:44'), ('36', 'klhsdaflkdsklfsd', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('37', 'k;ljfds;kjfds;l;', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('38', ';dasl', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('39', 'sfgfd', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('40', 'hadfhad', '2016-01-11 18:14:17', '2016-01-11 18:14:40', '1', '0', '0', '0', '1', '2016-01-25 23:24:08'), ('41', '1', '2016-01-11 18:14:40', '2016-01-11 18:14:40', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('42', '2', '2016-01-11 18:14:40', '2016-01-11 18:14:40', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('43', '3', '2016-01-11 18:14:40', '2016-01-21 22:11:23', '1', '1', '0', '0', '1', '2016-01-25 23:24:08'), ('44', 'adfadf', '2016-01-21 22:11:23', '2016-01-21 22:11:23', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('47', 'faaaf', '2016-01-21 22:11:23', '2016-01-25 16:46:28', '1', '1', '0', '0', '1', '2016-01-25 23:24:08'), ('48', 'sdfsd', '2016-01-21 22:12:56', '2016-01-21 22:12:56', '0', '0', '0', '0', '1', '0000-00-00 00:00:00'), ('49', 'zcasas', '2016-01-25 16:46:15', '2016-01-25 16:46:15', '0', '0', '0', '0', '1', '0000-00-00 00:00:00'), ('50', 'rename', '2016-01-25 16:46:27', '2016-01-25 16:47:24', '1', '1', '0', '0', '1', '2016-01-25 23:11:00'), ('51', 'dsf', '2016-01-25 16:46:27', '2016-01-25 16:46:27', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('52', 'dfs', '2016-01-25 16:46:27', '2016-01-25 16:46:27', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('53', 'aaf', '2016-01-25 16:46:27', '2016-01-25 16:46:27', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('55', 'sdfsdf', '2016-01-25 16:47:24', '2016-01-25 16:47:24', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('56', 'brent', '2016-01-25 23:42:03', '2016-01-25 23:42:03', '0', '0', '0', '0', '1', '2016-01-29 19:57:39');
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1'), ('2014_10_12_100000_create_password_resets_table', '1'), ('2015_09_02_150403_documents', '1'), ('2015_09_16_150414_folders', '1'), ('2015_09_16_150425_folder_struct', '1'), ('2015_09_16_150438_file_folder', '1'), ('2015_09_28_215143_create-fiscal-year-table', '1'), ('2015_09_28_215144_create-weeks-table', '1'), ('2015_09_30_213442_create-banners-table', '1'), ('2015_09_30_215422_update-folders-table', '1'), ('2015_10_27_145632_update_documents_table', '1'), ('2015_10_28_173427_create_folder_ids_table', '1'), ('2015_11_27_172830_create_package_table', '1'), ('2015_11_27_175201_create_document_package_pivot_table', '1'), ('2015_11_30_210139_create_event_types_table', '1'), ('2015_11_30_222337_create_events_table', '1'), ('2015_12_02_230415_update_packages_table', '1'), ('2015_12_03_214110_create_communication_importance_table', '1'), ('2015_12_03_214558_create_communications_table', '1'), ('2015_12_04_222108_create_communication_package_pivot_table', '1'), ('2015_12_04_222116_create_communication_document_pivot_table', '1'), ('2015_12_07_234421_create_tags_table', '1'), ('2015_12_09_200212_create_content_tag_pivot_table', '1'), ('2015_12_14_180605_update_weeks_table', '1'), ('2015_12_18_211214_CreateCommunicationsReadTable', '1'), ('2015_12_18_212934_CreateCommunicationTargetTable', '1'), ('2015_12_15_181406_create_user_group_table', '2'), ('2015_12_15_182533_update_users_table', '2'), ('2015_12_16_200336_create_banner_user_pivot_table', '2'), ('2015_12_17_231103_create_user_selected_banner_table', '2'), ('2016_01_26_223339_create_features_table', '3'), ('2016_01_27_174427_create_folder_package_pivot', '5'), ('2016_01_26_220505_create_quicklinks_type_table', '6'), ('2016_01_27_214111_create_quicklinks_table', '6'), ('2016_01_27_220050_create_dashboard_branding_table', '6'), ('2016_01_27_230216_update_dashboard_branding_table', '7'), ('2016_01_27_231623_update_quicklinks_types_table', '8'), ('2016_01_28_180958_update_quicklinks_table', '9'), ('2016_01_28_204112_update_banners_table', '10'), ('2016_01_29_233852_create_feature_package_pivot', '11'), ('2016_02_01_173157_create_feature_document_pivot_table', '11'), ('2016_02_01_174829_add_branding_to_banner_table', '11'), ('2016_01_20_201217_create_features_update_type_table', '12'), ('2016_01_29_201330_update_features_table', '13'), ('2016_02_04_230134_add_notifications_to_banner_table', '10'), ('2016_02_05_164949_update_banner_table_add_title', '14'), ('2016_02_09_164438_create_communication_types_table', '15'), ('2016_02_09_175504_add_types_to_communication_table', '16'), ('2016_02_09_194959_update_communication_type_table', '17'), ('2016_02_09_155416_create_urgent_notice_attachment_types_table', '18'), ('2016_02_09_155520_create_urgent_notices_table', '18'), ('2016_02_09_171819_create_urgent_notice_attachment_table', '18'), ('2016_02_09_200318_create_urgent_notice_target_table', '18'), ('2016_02_11_205551_create_alert_types_table', '19'), ('2016_02_11_205607_create_alerts_table', '19'), ('2016_02_11_205948_create_alerts_target_table', '19');
COMMIT;

-- ----------------------------
--  Table structure for `packages`
-- ----------------------------
DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `package_screen_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `is_hidden` tinyint(1) NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `packages_banner_id_foreign` (`banner_id`),
  CONSTRAINT `packages_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `packages`
-- ----------------------------
BEGIN;
INSERT INTO `packages` VALUES ('1', 'test package', 'test_package_c2b33b3741c2cbea6a0fd814798cf6f0f7b988f6', '0', '0', '0', '1', '2016-02-08 18:40:21', '2016-02-08 18:40:21', null), ('2', 'whatever', 'this_is_whatever', '0', '0', '0', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `quicklinks`
-- ----------------------------
DROP TABLE IF EXISTS `quicklinks`;
CREATE TABLE `quicklinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `link_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quicklinks_type_foreign` (`type`),
  KEY `quicklinks_banner_id_foreign` (`banner_id`),
  CONSTRAINT `quicklinks_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quicklinks_type_foreign` FOREIGN KEY (`type`) REFERENCES `quicklinks_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `quicklinks`
-- ----------------------------
BEGIN;
INSERT INTO `quicklinks` VALUES ('3', '1', '3', '3', 'item 3', 'https://www.thenorthface.com/en_ca/homepage.html', '0000-00-00 00:00:00', '2016-02-04 20:25:04', null), ('6', '1', '1', '3', 'dssdsdsd', '', '0000-00-00 00:00:00', '2016-02-04 20:25:04', null), ('12', '1', '2', '3', 'f656564', '', '0000-00-00 00:00:00', '2016-02-04 20:25:04', null), ('13', '1', '4', '3', '665465', '', '0000-00-00 00:00:00', '2016-02-04 20:25:04', null), ('14', '1', '5', '3', 'fefedfwfwe', '', '0000-00-00 00:00:00', '2016-02-04 20:25:05', null), ('18', '1', '0', '3', '4efwar', '', '0000-00-00 00:00:00', '2016-02-04 20:25:04', null);
COMMIT;

-- ----------------------------
--  Table structure for `quicklinks_types`
-- ----------------------------
DROP TABLE IF EXISTS `quicklinks_types`;
CREATE TABLE `quicklinks_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `quicklinks_types`
-- ----------------------------
BEGIN;
INSERT INTO `quicklinks_types` VALUES ('1', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('2', 'file', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('3', 'external', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
COMMIT;

-- ----------------------------
--  Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tags_banner_id_foreign` (`banner_id`),
  CONSTRAINT `tags_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `tags`
-- ----------------------------
BEGIN;
INSERT INTO `tags` VALUES ('1', 'Holiday FY16', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('2', 'Black Friday FY16', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
COMMIT;

-- ----------------------------
--  Table structure for `urgent_notice_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `urgent_notice_attachment`;
CREATE TABLE `urgent_notice_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `urgent_notice_id` int(10) unsigned NOT NULL,
  `attachment_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `urgent_notice_attachment_urgent_notice_id_foreign` (`urgent_notice_id`),
  CONSTRAINT `urgent_notice_attachment_urgent_notice_id_foreign` FOREIGN KEY (`urgent_notice_id`) REFERENCES `urgent_notices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `urgent_notice_attachment_types`
-- ----------------------------
DROP TABLE IF EXISTS `urgent_notice_attachment_types`;
CREATE TABLE `urgent_notice_attachment_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `urgent_notice_attachment_types`
-- ----------------------------
BEGIN;
INSERT INTO `urgent_notice_attachment_types` VALUES ('1', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'document', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `urgent_notice_target`
-- ----------------------------
DROP TABLE IF EXISTS `urgent_notice_target`;
CREATE TABLE `urgent_notice_target` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `urgent_notice_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `urgent_notice_target_urgent_notice_id_foreign` (`urgent_notice_id`),
  CONSTRAINT `urgent_notice_target_urgent_notice_id_foreign` FOREIGN KEY (`urgent_notice_id`) REFERENCES `urgent_notices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `urgent_notice_target`
-- ----------------------------
BEGIN;
INSERT INTO `urgent_notice_target` VALUES ('3', '2', '392', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `urgent_notices`
-- ----------------------------
DROP TABLE IF EXISTS `urgent_notices`;
CREATE TABLE `urgent_notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_id` int(10) unsigned NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attachment_type_id` int(10) unsigned NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `urgent_notices_banner_id_foreign` (`banner_id`),
  KEY `urgent_notices_attachment_type_id_foreign` (`attachment_type_id`),
  CONSTRAINT `urgent_notices_attachment_type_id_foreign` FOREIGN KEY (`attachment_type_id`) REFERENCES `urgent_notice_attachment_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `urgent_notices_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `urgent_notices`
-- ----------------------------
BEGIN;
INSERT INTO `urgent_notices` VALUES ('2', '1', 'this is urgetnt', 'kndfknadfk adfka ', '1', '2016-02-10', '2016-02-18', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `user_groups`
-- ----------------------------
DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `user_groups`
-- ----------------------------
BEGIN;
INSERT INTO `user_groups` VALUES ('1', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'users', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `user_selected_banner`
-- ----------------------------
DROP TABLE IF EXISTS `user_selected_banner`;
CREATE TABLE `user_selected_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `selected_banner_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `user_selected_banner`
-- ----------------------------
BEGIN;
INSERT INTO `user_selected_banner` VALUES ('50', '3', '1', '2016-02-04 20:32:23', '2016-02-04 20:32:23');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `activation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `approval_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_group_id_foreign` (`group_id`),
  CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('3', 'Brent', 'Garner', 'brent.garner@fglsports.com', '$2y$10$BGSXvZRXl9LCtcscaK288u9WpzzFv3O79lttw6/hDAf3n.y4l3B/m', '2', '', '1', '1', '1', '0000-00-00 00:00:00', 'W875N7GqXnRPOyuDf7yARZkelXis0n3eGBrDeBSP8gXIBsVDj5pMnleSZ9Mc', '0000-00-00 00:00:00', '2016-01-06 15:59:40');
COMMIT;

-- ----------------------------
--  Table structure for `weeks`
-- ----------------------------
DROP TABLE IF EXISTS `weeks`;
CREATE TABLE `weeks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `week_number` int(11) NOT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_activity_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `weeks`
-- ----------------------------
BEGIN;
INSERT INTO `weeks` VALUES ('49', '1', '2016-01-07', '2016-01-13', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('50', '2', '2016-01-14', '2016-01-20', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('51', '3', '2016-01-21', '2016-01-27', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('52', '4', '2016-01-28', '2016-02-03', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('53', '5', '2016-02-04', '2016-02-10', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('54', '6', '2016-02-11', '2016-02-17', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('55', '7', '2016-02-18', '2016-02-24', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('56', '8', '2016-02-25', '2016-03-02', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('57', '9', '2016-03-03', '2016-03-09', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('58', '10', '2016-03-10', '2016-03-16', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('59', '11', '2016-03-17', '2016-03-23', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('60', '12', '2016-03-24', '2016-03-30', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('61', '13', '2016-03-31', '2016-04-06', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('62', '14', '2016-04-07', '2016-04-13', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('63', '15', '2016-04-14', '2016-04-20', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('64', '16', '2016-04-21', '2016-04-27', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('65', '17', '2016-04-28', '2016-05-04', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('66', '18', '2016-05-05', '2016-05-11', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('67', '19', '2016-05-12', '2016-05-18', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('68', '20', '2016-05-19', '2016-05-25', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('69', '21', '2016-05-26', '2016-06-01', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('70', '22', '2016-06-02', '2016-06-08', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('71', '23', '2016-06-09', '2016-06-15', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('72', '24', '2016-06-16', '2016-06-22', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('73', '25', '2016-06-23', '2016-06-29', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('74', '26', '2016-06-30', '2016-07-06', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('75', '27', '2016-07-07', '2016-07-13', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('76', '28', '2016-07-14', '2016-07-20', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('77', '29', '2016-07-21', '2016-07-27', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('78', '30', '2016-07-28', '2016-08-03', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('79', '31', '2016-08-04', '2016-08-10', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('80', '32', '2016-08-11', '2016-08-17', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('81', '33', '2016-08-18', '2016-08-24', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('82', '34', '2016-08-25', '2016-08-31', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('83', '35', '2016-09-01', '2016-09-07', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('84', '36', '2016-09-08', '2016-09-14', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('85', '37', '2016-09-15', '2016-09-21', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('86', '38', '2016-09-22', '2016-09-28', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('87', '39', '2016-09-29', '2016-10-05', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('88', '40', '2016-10-06', '2016-10-12', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('89', '41', '2016-10-13', '2016-10-19', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('90', '42', '2016-10-20', '2016-10-26', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('91', '43', '2016-10-27', '2016-11-02', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('92', '44', '2016-11-03', '2016-11-09', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('93', '45', '2016-11-10', '2016-11-16', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('94', '46', '2016-11-17', '2016-11-23', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('95', '47', '2016-11-24', '2016-11-30', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('96', '48', '2016-12-01', '2016-12-07', '2016', '55', '2016-01-08 17:17:19', '2016-01-08 17:17:19', '0000-00-00 00:00:00'), ('97', '1', '2016-01-07', '2016-01-13', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('98', '2', '2016-01-14', '2016-01-20', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('99', '3', '2016-01-21', '2016-01-27', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('100', '4', '2016-01-28', '2016-02-03', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('101', '5', '2016-02-04', '2016-02-10', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('102', '6', '2016-02-11', '2016-02-17', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('103', '7', '2016-02-18', '2016-02-24', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('104', '8', '2016-02-25', '2016-03-02', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('105', '9', '2016-03-03', '2016-03-09', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('106', '10', '2016-03-10', '2016-03-16', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('107', '11', '2016-03-17', '2016-03-23', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('108', '12', '2016-03-24', '2016-03-30', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('109', '13', '2016-03-31', '2016-04-06', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('110', '14', '2016-04-07', '2016-04-13', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('111', '15', '2016-04-14', '2016-04-20', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('112', '16', '2016-04-21', '2016-04-27', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('113', '17', '2016-04-28', '2016-05-04', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('114', '18', '2016-05-05', '2016-05-11', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('115', '19', '2016-05-12', '2016-05-18', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('116', '20', '2016-05-19', '2016-05-25', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('117', '21', '2016-05-26', '2016-06-01', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('118', '22', '2016-06-02', '2016-06-08', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('119', '23', '2016-06-09', '2016-06-15', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('120', '24', '2016-06-16', '2016-06-22', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('121', '25', '2016-06-23', '2016-06-29', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('122', '26', '2016-06-30', '2016-07-06', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('123', '27', '2016-07-07', '2016-07-13', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('124', '28', '2016-07-14', '2016-07-20', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('125', '29', '2016-07-21', '2016-07-27', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('126', '30', '2016-07-28', '2016-08-03', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('127', '31', '2016-08-04', '2016-08-10', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('128', '32', '2016-08-11', '2016-08-17', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('129', '33', '2016-08-18', '2016-08-24', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('130', '34', '2016-08-25', '2016-08-31', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('131', '35', '2016-09-01', '2016-09-07', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('132', '36', '2016-09-08', '2016-09-14', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('133', '37', '2016-09-15', '2016-09-21', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('134', '38', '2016-09-22', '2016-09-28', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('135', '39', '2016-09-29', '2016-10-05', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('136', '40', '2016-10-06', '2016-10-12', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('137', '41', '2016-10-13', '2016-10-19', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('138', '42', '2016-10-20', '2016-10-26', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('139', '43', '2016-10-27', '2016-11-02', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('140', '44', '2016-11-03', '2016-11-09', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('141', '45', '2016-11-10', '2016-11-16', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('142', '46', '2016-11-17', '2016-11-23', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('143', '47', '2016-11-24', '2016-11-30', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('144', '48', '2016-12-01', '2016-12-07', '2016', '110', '2016-01-08 22:04:05', '2016-01-08 22:04:05', '0000-00-00 00:00:00'), ('145', '1', '2016-01-07', '2016-01-13', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('146', '2', '2016-01-14', '2016-01-20', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('147', '3', '2016-01-21', '2016-01-27', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('148', '4', '2016-01-28', '2016-02-03', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('149', '5', '2016-02-04', '2016-02-10', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('150', '6', '2016-02-11', '2016-02-17', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('151', '7', '2016-02-18', '2016-02-24', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('152', '8', '2016-02-25', '2016-03-02', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('153', '9', '2016-03-03', '2016-03-09', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('154', '10', '2016-03-10', '2016-03-16', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('155', '11', '2016-03-17', '2016-03-23', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('156', '12', '2016-03-24', '2016-03-30', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('157', '13', '2016-03-31', '2016-04-06', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('158', '14', '2016-04-07', '2016-04-13', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('159', '15', '2016-04-14', '2016-04-20', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('160', '16', '2016-04-21', '2016-04-27', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('161', '17', '2016-04-28', '2016-05-04', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('162', '18', '2016-05-05', '2016-05-11', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('163', '19', '2016-05-12', '2016-05-18', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('164', '20', '2016-05-19', '2016-05-25', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('165', '21', '2016-05-26', '2016-06-01', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('166', '22', '2016-06-02', '2016-06-08', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('167', '23', '2016-06-09', '2016-06-15', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('168', '24', '2016-06-16', '2016-06-22', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('169', '25', '2016-06-23', '2016-06-29', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('170', '26', '2016-06-30', '2016-07-06', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('171', '27', '2016-07-07', '2016-07-13', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('172', '28', '2016-07-14', '2016-07-20', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('173', '29', '2016-07-21', '2016-07-27', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('174', '30', '2016-07-28', '2016-08-03', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('175', '31', '2016-08-04', '2016-08-10', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('176', '32', '2016-08-11', '2016-08-17', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('177', '33', '2016-08-18', '2016-08-24', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('178', '34', '2016-08-25', '2016-08-31', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('179', '35', '2016-09-01', '2016-09-07', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('180', '36', '2016-09-08', '2016-09-14', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('181', '37', '2016-09-15', '2016-09-21', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('182', '38', '2016-09-22', '2016-09-28', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('183', '39', '2016-09-29', '2016-10-05', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('184', '40', '2016-10-06', '2016-10-12', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('185', '41', '2016-10-13', '2016-10-19', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('186', '42', '2016-10-20', '2016-10-26', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('187', '43', '2016-10-27', '2016-11-02', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('188', '44', '2016-11-03', '2016-11-09', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('189', '45', '2016-11-10', '2016-11-16', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('190', '46', '2016-11-17', '2016-11-23', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('191', '47', '2016-11-24', '2016-11-30', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00'), ('192', '48', '2016-12-01', '2016-12-07', '2016', '159', '2016-01-08 22:04:39', '2016-01-08 22:04:39', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `years`
-- ----------------------------
DROP TABLE IF EXISTS `years`;
CREATE TABLE `years` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `years`
-- ----------------------------
BEGIN;
INSERT INTO `years` VALUES ('1', '2016', '2016-01-07', '2016-12-07', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
