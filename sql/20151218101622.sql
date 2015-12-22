/*
 Navicat MySQL Backup

 Source Server         : true-local
 Source Server Version : 50625
 Source Host           : localhost
 Source Database       : fglportal

 Target Server Version : 50625
 File Encoding         : utf-8

 Date: 12/18/2015 10:16:22 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `activities`
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `activity_levels`
-- ----------------------------
DROP TABLE IF EXISTS `activity_levels`;
CREATE TABLE `activity_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `banners`
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `banners`
-- ----------------------------
BEGIN;
INSERT INTO `banners` VALUES ('1', 'Sport Chek', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'Atmosphere', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', 'Marks', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `career_paths`
-- ----------------------------
DROP TABLE IF EXISTS `career_paths`;
CREATE TABLE `career_paths` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
INSERT INTO `communication_importance_levels` VALUES ('1', 'low', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'med', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', 'high', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
--  Table structure for `communications`
-- ----------------------------
DROP TABLE IF EXISTS `communications`;
CREATE TABLE `communications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `importance` int(10) unsigned NOT NULL,
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
  CONSTRAINT `communications_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE,
  CONSTRAINT `communications_importance_foreign` FOREIGN KEY (`importance`) REFERENCES `communication_importance_levels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communications`
-- ----------------------------
BEGIN;
INSERT INTO `communications` VALUES ('1', 'first message', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'me', '1', '2015-12-09 00:00:00', '2015-12-16 00:00:00', '0', '1', '2015-12-15 23:19:51', '2015-12-15 23:23:11', null), ('2', 'this is a message', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'me', '1', '2015-12-09 00:00:00', '2015-12-16 00:00:00', '0', '1', '2015-12-15 23:21:27', '2015-12-15 23:22:45', null), ('3', 'asdfadf ad daf adfad ', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'feq', '1', '2015-12-15 00:00:00', '2015-12-17 00:00:00', '0', '1', '2015-12-15 23:22:26', '2015-12-15 23:22:26', null);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `content_tag`
-- ----------------------------
BEGIN;
INSERT INTO `content_tag` VALUES ('1', '3', 'communication', '1', '2015-12-15 23:22:26', '2015-12-15 23:22:26', null), ('2', '3', 'communication', '4', '2015-12-15 23:22:26', '2015-12-15 23:22:26', null), ('3', '2', 'communication', '2', '2015-12-15 23:22:54', '2015-12-15 23:22:54', null), ('4', '1', 'communication', '1', '2015-12-15 23:23:11', '2015-12-15 23:23:11', null), ('5', '1', 'communication', '2', '2015-12-15 23:23:11', '2015-12-15 23:23:11', null), ('14', '2', 'document', '1', '2015-12-18 17:13:34', '2015-12-18 17:13:34', null), ('15', '2', 'document', '2', '2015-12-18 17:13:34', '2015-12-18 17:13:34', null), ('16', '3', 'document', '1', '2015-12-18 17:13:34', '2015-12-18 17:13:34', null), ('17', '3', 'document', '3', '2015-12-18 17:13:34', '2015-12-18 17:13:34', null);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `documents`
-- ----------------------------
BEGIN;
INSERT INTO `documents` VALUES ('1', 'dd2986dbecf2639ee8ec27e3ec8606c0b35172bd', 'HUDDLE SCRIPT_Code ADAM.pdf', 'pdf', 'HUDDLE_SCRIPT_Code_ADAM_pdf_870bd77bd1506c6128a5e4a9c023e006f5976254.pdf', 'HUDDLE SCRIPT_Code ADAM', '', '1', '2015-12-15 18:57:26', '2015-12-15 18:57:30', '2015-12-15 11:57:28', ''), ('2', 'a5e97d67353bcd6ded18ea5936c11d654ab4f68f', 'placeholder.pdf', 'pdf', 'placeholder_pdf_d94074b26659bb4e60c36c4d4c8664905710d10c.pdf', 'something', 'wrfwea df adf af adf ', '1', '2015-12-18 17:12:23', '2015-12-18 17:13:22', '2015-12-18 10:12:28', ''), ('3', 'a5e97d67353bcd6ded18ea5936c11d654ab4f68f', 'placeholder.pdf', 'pdf', 'placeholder_pdf_91a607ba3647ad3bac9402371358eed0aa546efb.pdf', 'different', 'fgwwrh dafd fdf ', '1', '2015-12-18 17:12:25', '2015-12-18 17:13:22', '2015-12-18 10:12:28', ''), ('4', 'a5e97d67353bcd6ded18ea5936c11d654ab4f68f', 'placeholder.pdf', 'pdf', 'placeholder_pdf_91a607ba3647ad3bac9402371358eed0aa546efb.pdf', 'yes even diffferneter ', 'fsbabhf qrg qwrwadf', '1', '2015-12-18 17:12:25', '2015-12-18 17:13:22', '2015-12-18 10:12:28', '');
COMMIT;

-- ----------------------------
--  Table structure for `education_levels`
-- ----------------------------
DROP TABLE IF EXISTS `education_levels`;
CREATE TABLE `education_levels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `file_folder`
-- ----------------------------
BEGIN;
INSERT INTO `file_folder` VALUES ('1', '1', '164', '2015-12-15 18:57:26', '2015-12-15 18:57:26'), ('2', '2', '166', '2015-12-18 17:12:23', '2015-12-18 17:12:23'), ('3', '3', '166', '2015-12-18 17:12:25', '2015-12-18 17:12:25'), ('4', '4', '166', '2015-12-18 17:12:25', '2015-12-18 17:12:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folder_ids`
-- ----------------------------
BEGIN;
INSERT INTO `folder_ids` VALUES ('1', '1', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', '2', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', '3', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('4', '4', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('5', '5', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('6', '1', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('7', '2', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('8', '3', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('9', '4', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('10', '5', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('11', '6', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('12', '7', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('13', '8', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('14', '9', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('15', '10', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('16', '11', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('17', '12', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('18', '13', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('19', '14', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('20', '15', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('21', '16', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('22', '17', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('23', '18', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('24', '19', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('25', '20', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('26', '21', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('27', '22', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('28', '23', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('29', '24', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('30', '25', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('31', '26', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('32', '27', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('33', '28', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('34', '29', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('35', '30', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('36', '31', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('37', '32', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('38', '33', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('39', '34', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('40', '35', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('41', '36', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('42', '37', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('43', '38', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('44', '39', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('45', '40', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('46', '41', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('47', '42', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('48', '43', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('49', '44', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('50', '45', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('51', '46', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('52', '47', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('53', '48', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('54', '49', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('55', '50', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('56', '51', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('57', '52', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('58', '53', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('59', '54', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('60', '55', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('61', '56', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('62', '57', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('63', '58', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('64', '59', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('65', '60', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('66', '61', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('67', '62', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('68', '63', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('69', '64', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('70', '65', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('71', '66', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('72', '67', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('73', '68', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('74', '69', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('75', '70', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('76', '71', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('77', '72', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('78', '73', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('79', '74', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('80', '75', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('81', '76', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('82', '77', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('83', '78', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('84', '79', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('85', '80', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('86', '81', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('87', '82', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('88', '83', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('89', '84', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('90', '85', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('91', '86', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('92', '87', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('93', '88', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('94', '89', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('95', '90', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('96', '91', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('97', '92', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('98', '93', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('99', '94', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('100', '95', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('101', '96', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('102', '97', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('103', '98', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('104', '99', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('105', '100', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('106', '101', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('107', '102', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('108', '103', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('109', '104', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('110', '105', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('111', '106', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('112', '107', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('113', '108', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('114', '109', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('115', '110', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('116', '111', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('117', '112', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('118', '113', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('119', '114', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('120', '115', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('121', '116', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('122', '117', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('123', '118', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('124', '119', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('125', '120', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('126', '121', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('127', '122', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('128', '123', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('129', '124', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('130', '125', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('131', '126', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('132', '127', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('133', '128', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('134', '129', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('135', '130', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('136', '131', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('137', '132', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('138', '133', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('139', '134', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('140', '135', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('141', '136', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('142', '137', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('143', '138', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('144', '139', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('145', '140', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('146', '141', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('147', '142', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('148', '143', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('149', '144', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('150', '145', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('151', '146', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('152', '147', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('153', '148', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('154', '149', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('155', '150', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('156', '151', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('157', '152', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('158', '153', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('159', '154', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('160', '155', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('161', '156', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('162', '6', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('163', '7', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('164', '8', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('165', '9', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('166', '10', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('167', '157', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('168', '158', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('169', '159', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('170', '160', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('171', '161', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('172', '162', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('173', '163', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('174', '164', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('175', '165', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('176', '166', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('177', '167', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('178', '168', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('179', '169', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('180', '170', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('181', '171', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('182', '172', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('183', '173', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('184', '174', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('185', '175', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('186', '176', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('187', '177', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('188', '178', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('189', '179', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('190', '180', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('191', '181', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('192', '182', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('193', '183', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('194', '184', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('195', '185', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('196', '186', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('197', '187', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('198', '188', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('199', '189', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('200', '190', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('201', '191', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('202', '192', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('203', '193', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('204', '194', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('205', '195', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('206', '196', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('207', '197', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('208', '198', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('209', '199', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('210', '200', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('211', '201', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('212', '202', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('213', '203', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('214', '204', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('215', '205', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('216', '206', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('217', '207', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('218', '208', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folder_struct`
-- ----------------------------
BEGIN;
INSERT INTO `folder_struct` VALUES ('1', '2', '3', '2015-12-15 18:53:22', '2015-12-15 18:53:22'), ('2', '2', '4', '2015-12-15 18:53:22', '2015-12-15 18:53:22'), ('3', '2', '5', '2015-12-15 18:53:22', '2015-12-15 18:53:22'), ('4', '1', '6', '2015-12-15 18:56:00', '2015-12-15 18:56:00'), ('5', '1', '7', '2015-12-15 18:56:00', '2015-12-15 18:56:00'), ('6', '1', '8', '2015-12-15 18:56:00', '2015-12-15 18:56:00'), ('7', '8', '9', '2015-12-18 17:11:09', '2015-12-18 17:11:09'), ('8', '9', '10', '2015-12-18 17:11:16', '2015-12-18 17:11:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folders`
-- ----------------------------
BEGIN;
INSERT INTO `folders` VALUES ('1', 'Training', '2015-12-15 18:52:58', '2015-12-15 18:56:00', '1', '0', '0', '0', '1', '2015-12-18 17:13:22'), ('2', 'Visual', '2015-12-15 18:53:05', '2015-12-15 18:53:22', '1', '0', '0', '0', '1', '2015-12-15 18:54:03'), ('3', 'Hardgoods', '2015-12-15 18:53:22', '2015-12-15 18:53:56', '1', '1', '1', '3', '1', '2015-12-15 18:53:56'), ('4', 'Softgoods', '2015-12-15 18:53:22', '2015-12-15 18:54:03', '1', '1', '1', '3', '1', '2015-12-15 18:54:03'), ('5', 'Footwear', '2015-12-15 18:53:22', '2015-12-15 18:53:42', '1', '1', '1', '3', '1', '2015-12-15 18:53:42'), ('6', 'Hargoods', '2015-12-15 18:56:00', '2015-12-15 18:56:00', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('7', 'Softgoods', '2015-12-15 18:56:00', '2015-12-18 17:11:36', '1', '1', '1', '6', '1', '2015-12-18 17:11:36'), ('8', 'Footwear', '2015-12-15 18:56:00', '2015-12-18 17:11:09', '1', '1', '0', '0', '1', '2015-12-18 17:13:22'), ('9', 'stuff', '2015-12-18 17:11:09', '2015-12-18 17:11:16', '1', '1', '0', '0', '1', '2015-12-18 17:13:22'), ('10', 'more stuff', '2015-12-18 17:11:16', '2015-12-18 17:11:16', '0', '1', '0', '0', '1', '2015-12-18 17:13:22');
COMMIT;

-- ----------------------------
--  Table structure for `hood_members`
-- ----------------------------
DROP TABLE IF EXISTS `hood_members`;
CREATE TABLE `hood_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hood_id` int(10) unsigned NOT NULL,
  `profile_id` int(10) unsigned NOT NULL,
  `hood_admin` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hood_members_hood_id_foreign` (`hood_id`),
  KEY `hood_members_profile_id_foreign` (`profile_id`),
  CONSTRAINT `hood_members_hood_id_foreign` FOREIGN KEY (`hood_id`) REFERENCES `hoods` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hood_members_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `hood_post_repsonses`
-- ----------------------------
DROP TABLE IF EXISTS `hood_post_repsonses`;
CREATE TABLE `hood_post_repsonses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hood_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `profile_id` int(10) unsigned NOT NULL,
  `response_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hood_post_repsonses_hood_id_foreign` (`hood_id`),
  KEY `hood_post_repsonses_post_id_foreign` (`post_id`),
  KEY `hood_post_repsonses_profile_id_foreign` (`profile_id`),
  CONSTRAINT `hood_post_repsonses_hood_id_foreign` FOREIGN KEY (`hood_id`) REFERENCES `hoods` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hood_post_repsonses_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `hood_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hood_post_repsonses_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `hood_posts`
-- ----------------------------
DROP TABLE IF EXISTS `hood_posts`;
CREATE TABLE `hood_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hood_id` int(10) unsigned NOT NULL,
  `profile_id` int(10) unsigned NOT NULL,
  `post_content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `has_media` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hood_posts_hood_id_foreign` (`hood_id`),
  KEY `hood_posts_profile_id_foreign` (`profile_id`),
  CONSTRAINT `hood_posts_hood_id_foreign` FOREIGN KEY (`hood_id`) REFERENCES `hoods` (`id`) ON DELETE CASCADE,
  CONSTRAINT `hood_posts_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `hoods`
-- ----------------------------
DROP TABLE IF EXISTS `hoods`;
CREATE TABLE `hoods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `open` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `media_types`
-- ----------------------------
DROP TABLE IF EXISTS `media_types`;
CREATE TABLE `media_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1'), ('2014_10_12_100000_create_password_resets_table', '1'), ('2015_09_02_150403_documents', '1'), ('2015_09_16_150414_folders', '1'), ('2015_09_16_150425_folder_struct', '1'), ('2015_09_16_150438_file_folder', '1'), ('2015_09_28_215143_create-fiscal-year-table', '1'), ('2015_09_28_215144_create-weeks-table', '1'), ('2015_09_30_213442_create-banners-table', '1'), ('2015_09_30_215422_update-folders-table', '1'), ('2015_10_27_145632_update_documents_table', '1'), ('2015_10_28_173427_create_folder_ids_table', '1'), ('2015_11_27_172830_create_package_table', '1'), ('2015_11_27_175201_create_document_package_pivot_table', '1'), ('2015_11_30_210139_create_event_types_table', '1'), ('2015_11_30_222337_create_events_table', '1'), ('2015_12_02_230415_update_packages_table', '1'), ('2015_12_03_214110_create_communication_importance_table', '1'), ('2015_12_03_214558_create_communications_table', '1'), ('2015_12_04_222108_create_communication_package_pivot_table', '1'), ('2015_12_04_222116_create_communication_document_pivot_table', '1'), ('2015_12_07_234421_create_tags_table', '1'), ('2015_12_09_200212_create_content_tag_pivot_table', '1'), ('2015_12_14_180605_update_weeks_table', '1'), ('2015_12_15_181406_create_user_group_table', '1'), ('2015_12_15_182533_update_users_table', '1');
COMMIT;

-- ----------------------------
--  Table structure for `moves`
-- ----------------------------
DROP TABLE IF EXISTS `moves`;
CREATE TABLE `moves` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `distance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
--  Table structure for `position_roles`
-- ----------------------------
DROP TABLE IF EXISTS `position_roles`;
CREATE TABLE `position_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `position_roles_position_id_foreign` (`position_id`),
  KEY `position_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `position_roles_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `position_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `positions`
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `profile_activities`
-- ----------------------------
DROP TABLE IF EXISTS `profile_activities`;
CREATE TABLE `profile_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned NOT NULL,
  `activity_id` int(10) unsigned NOT NULL,
  `level_id` int(10) unsigned NOT NULL,
  `start` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `finished` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_activities_profile_id_foreign` (`profile_id`),
  KEY `profile_activities_activity_id_foreign` (`activity_id`),
  KEY `profile_activities_level_id_foreign` (`level_id`),
  CONSTRAINT `profile_activities_activity_id_foreign` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profile_activities_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `activity_levels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profile_activities_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `profile_education`
-- ----------------------------
DROP TABLE IF EXISTS `profile_education`;
CREATE TABLE `profile_education` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned NOT NULL,
  `focus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `education_level_id` int(10) unsigned NOT NULL,
  `education_start` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `education_end` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `school_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `profile_education_profile_id_foreign` (`profile_id`),
  KEY `profile_education_education_level_id_foreign` (`education_level_id`),
  CONSTRAINT `profile_education_education_level_id_foreign` FOREIGN KEY (`education_level_id`) REFERENCES `education_levels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profile_education_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `profile_history`
-- ----------------------------
DROP TABLE IF EXISTS `profile_history`;
CREATE TABLE `profile_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned NOT NULL,
  `start_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `position_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_history_profile_id_foreign` (`profile_id`),
  KEY `profile_history_position_id_foreign` (`position_id`),
  CONSTRAINT `profile_history_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profile_history_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `profile_subscriptions`
-- ----------------------------
DROP TABLE IF EXISTS `profile_subscriptions`;
CREATE TABLE `profile_subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned NOT NULL,
  `subscription_group_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_subscriptions_profile_id_foreign` (`profile_id`),
  KEY `profile_subscriptions_subscription_group_id_foreign` (`subscription_group_id`),
  CONSTRAINT `profile_subscriptions_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profile_subscriptions_subscription_group_id_foreign` FOREIGN KEY (`subscription_group_id`) REFERENCES `subscription_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `profiles`
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `position_id` int(10) unsigned NOT NULL,
  `ulead` tinyint(1) NOT NULL,
  `five_factors` int(11) NOT NULL,
  `tribal_customs` int(11) NOT NULL,
  `leadership_brand` int(11) NOT NULL,
  `move_distance_id` int(10) unsigned NOT NULL,
  `career_path_id` int(10) unsigned NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  `manager_id` int(10) unsigned NOT NULL,
  `approved_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  KEY `profiles_position_id_foreign` (`position_id`),
  KEY `profiles_move_distance_id_foreign` (`move_distance_id`),
  KEY `profiles_career_path_id_foreign` (`career_path_id`),
  CONSTRAINT `profiles_career_path_id_foreign` FOREIGN KEY (`career_path_id`) REFERENCES `career_paths` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profiles_move_distance_id_foreign` FOREIGN KEY (`move_distance_id`) REFERENCES `moves` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profiles_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `subscription_groups`
-- ----------------------------
DROP TABLE IF EXISTS `subscription_groups`;
CREATE TABLE `subscription_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `tags`
-- ----------------------------
BEGIN;
INSERT INTO `tags` VALUES ('1', 'adf', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('2', 'bghg', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('3', 'sdg', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('4', 'sdfgw', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('5', 'ghg', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('6', 'gwgw4eg', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('7', 'ggqge', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
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
INSERT INTO `user_groups` VALUES ('1', 'Superadmin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'Admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_group_id_foreign` (`group_id`),
  CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `user_groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `weeks`
-- ----------------------------
BEGIN;
INSERT INTO `weeks` VALUES ('1', '1', '2015-02-02', '2015-02-08', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('2', '2', '2015-02-09', '2015-02-15', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('3', '3', '2015-02-16', '2015-02-22', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('4', '4', '2015-02-23', '2015-03-01', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('5', '5', '2015-03-02', '2015-03-08', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('6', '6', '2015-03-09', '2015-03-15', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('7', '7', '2015-03-16', '2015-03-22', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('8', '8', '2015-03-23', '2015-03-29', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('9', '9', '2015-03-30', '2015-04-05', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('10', '10', '2015-04-06', '2015-04-12', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('11', '11', '2015-04-13', '2015-04-19', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('12', '12', '2015-04-20', '2015-04-26', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('13', '13', '2015-04-27', '2015-05-03', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('14', '14', '2015-05-04', '2015-05-10', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('15', '15', '2015-05-11', '2015-05-17', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('16', '16', '2015-05-18', '2015-05-24', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('17', '17', '2015-05-25', '2015-05-31', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('18', '18', '2015-06-01', '2015-06-07', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('19', '19', '2015-06-08', '2015-06-14', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('20', '20', '2015-06-15', '2015-06-21', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('21', '21', '2015-06-22', '2015-06-28', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('22', '22', '2015-06-29', '2015-07-05', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('23', '23', '2015-07-06', '2015-07-12', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('24', '24', '2015-07-13', '2015-07-19', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('25', '25', '2015-07-20', '2015-07-26', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('26', '26', '2015-07-27', '2015-08-02', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('27', '27', '2015-08-03', '2015-08-09', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('28', '28', '2015-08-10', '2015-08-16', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('29', '29', '2015-08-17', '2015-08-23', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('30', '30', '2015-08-24', '2015-08-30', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('31', '31', '2015-08-31', '2015-09-06', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('32', '32', '2015-09-07', '2015-09-13', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('33', '33', '2015-09-14', '2015-09-20', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('34', '34', '2015-09-21', '2015-09-27', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('35', '35', '2015-09-28', '2015-10-04', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('36', '36', '2015-10-05', '2015-10-11', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('37', '37', '2015-10-12', '2015-10-18', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('38', '38', '2015-10-19', '2015-10-25', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('39', '39', '2015-10-26', '2015-11-01', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('40', '40', '2015-11-02', '2015-11-08', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('41', '41', '2015-11-09', '2015-11-15', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('42', '42', '2015-11-16', '2015-11-22', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('43', '43', '2015-11-23', '2015-11-29', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('44', '44', '2015-11-30', '2015-12-06', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('45', '45', '2015-12-07', '2015-12-13', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('46', '46', '2015-12-14', '2015-12-20', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('47', '47', '2015-12-21', '2015-12-27', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('48', '48', '2015-12-28', '2016-01-03', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('49', '49', '2016-01-04', '2016-01-10', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('50', '50', '2016-01-11', '2016-01-17', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('51', '51', '2016-01-18', '2016-01-24', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('52', '52', '2016-01-25', '2016-01-31', 'FY16', '5', '2015-12-15 18:53:42', '2015-12-15 18:53:42', '0000-00-00 00:00:00'), ('53', '1', '2015-02-02', '2015-02-08', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('54', '2', '2015-02-09', '2015-02-15', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('55', '3', '2015-02-16', '2015-02-22', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('56', '4', '2015-02-23', '2015-03-01', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('57', '5', '2015-03-02', '2015-03-08', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('58', '6', '2015-03-09', '2015-03-15', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('59', '7', '2015-03-16', '2015-03-22', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('60', '8', '2015-03-23', '2015-03-29', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('61', '9', '2015-03-30', '2015-04-05', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('62', '10', '2015-04-06', '2015-04-12', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('63', '11', '2015-04-13', '2015-04-19', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('64', '12', '2015-04-20', '2015-04-26', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('65', '13', '2015-04-27', '2015-05-03', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('66', '14', '2015-05-04', '2015-05-10', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('67', '15', '2015-05-11', '2015-05-17', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('68', '16', '2015-05-18', '2015-05-24', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('69', '17', '2015-05-25', '2015-05-31', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('70', '18', '2015-06-01', '2015-06-07', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('71', '19', '2015-06-08', '2015-06-14', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('72', '20', '2015-06-15', '2015-06-21', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('73', '21', '2015-06-22', '2015-06-28', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('74', '22', '2015-06-29', '2015-07-05', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('75', '23', '2015-07-06', '2015-07-12', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('76', '24', '2015-07-13', '2015-07-19', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('77', '25', '2015-07-20', '2015-07-26', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('78', '26', '2015-07-27', '2015-08-02', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('79', '27', '2015-08-03', '2015-08-09', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('80', '28', '2015-08-10', '2015-08-16', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('81', '29', '2015-08-17', '2015-08-23', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('82', '30', '2015-08-24', '2015-08-30', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('83', '31', '2015-08-31', '2015-09-06', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('84', '32', '2015-09-07', '2015-09-13', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('85', '33', '2015-09-14', '2015-09-20', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('86', '34', '2015-09-21', '2015-09-27', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('87', '35', '2015-09-28', '2015-10-04', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('88', '36', '2015-10-05', '2015-10-11', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('89', '37', '2015-10-12', '2015-10-18', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('90', '38', '2015-10-19', '2015-10-25', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('91', '39', '2015-10-26', '2015-11-01', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('92', '40', '2015-11-02', '2015-11-08', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('93', '41', '2015-11-09', '2015-11-15', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('94', '42', '2015-11-16', '2015-11-22', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('95', '43', '2015-11-23', '2015-11-29', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('96', '44', '2015-11-30', '2015-12-06', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('97', '45', '2015-12-07', '2015-12-13', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('98', '46', '2015-12-14', '2015-12-20', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('99', '47', '2015-12-21', '2015-12-27', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('100', '48', '2015-12-28', '2016-01-03', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('101', '49', '2016-01-04', '2016-01-10', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('102', '50', '2016-01-11', '2016-01-17', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('103', '51', '2016-01-18', '2016-01-24', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('104', '52', '2016-01-25', '2016-01-31', 'FY16', '3', '2015-12-15 18:53:56', '2015-12-15 18:53:56', '0000-00-00 00:00:00'), ('105', '1', '2015-02-02', '2015-02-08', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('106', '2', '2015-02-09', '2015-02-15', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('107', '3', '2015-02-16', '2015-02-22', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('108', '4', '2015-02-23', '2015-03-01', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('109', '5', '2015-03-02', '2015-03-08', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('110', '6', '2015-03-09', '2015-03-15', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('111', '7', '2015-03-16', '2015-03-22', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('112', '8', '2015-03-23', '2015-03-29', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('113', '9', '2015-03-30', '2015-04-05', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('114', '10', '2015-04-06', '2015-04-12', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('115', '11', '2015-04-13', '2015-04-19', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('116', '12', '2015-04-20', '2015-04-26', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('117', '13', '2015-04-27', '2015-05-03', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('118', '14', '2015-05-04', '2015-05-10', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('119', '15', '2015-05-11', '2015-05-17', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('120', '16', '2015-05-18', '2015-05-24', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('121', '17', '2015-05-25', '2015-05-31', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('122', '18', '2015-06-01', '2015-06-07', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('123', '19', '2015-06-08', '2015-06-14', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('124', '20', '2015-06-15', '2015-06-21', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('125', '21', '2015-06-22', '2015-06-28', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('126', '22', '2015-06-29', '2015-07-05', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('127', '23', '2015-07-06', '2015-07-12', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('128', '24', '2015-07-13', '2015-07-19', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('129', '25', '2015-07-20', '2015-07-26', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('130', '26', '2015-07-27', '2015-08-02', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('131', '27', '2015-08-03', '2015-08-09', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('132', '28', '2015-08-10', '2015-08-16', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('133', '29', '2015-08-17', '2015-08-23', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('134', '30', '2015-08-24', '2015-08-30', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('135', '31', '2015-08-31', '2015-09-06', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('136', '32', '2015-09-07', '2015-09-13', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('137', '33', '2015-09-14', '2015-09-20', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('138', '34', '2015-09-21', '2015-09-27', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('139', '35', '2015-09-28', '2015-10-04', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('140', '36', '2015-10-05', '2015-10-11', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('141', '37', '2015-10-12', '2015-10-18', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('142', '38', '2015-10-19', '2015-10-25', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('143', '39', '2015-10-26', '2015-11-01', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('144', '40', '2015-11-02', '2015-11-08', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('145', '41', '2015-11-09', '2015-11-15', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('146', '42', '2015-11-16', '2015-11-22', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('147', '43', '2015-11-23', '2015-11-29', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('148', '44', '2015-11-30', '2015-12-06', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('149', '45', '2015-12-07', '2015-12-13', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('150', '46', '2015-12-14', '2015-12-20', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('151', '47', '2015-12-21', '2015-12-27', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('152', '48', '2015-12-28', '2016-01-03', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('153', '49', '2016-01-04', '2016-01-10', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('154', '50', '2016-01-11', '2016-01-17', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('155', '51', '2016-01-18', '2016-01-24', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('156', '52', '2016-01-25', '2016-01-31', 'FY16', '4', '2015-12-15 18:54:03', '2015-12-15 18:54:03', '0000-00-00 00:00:00'), ('157', '1', '2015-02-02', '2015-02-08', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('158', '2', '2015-02-09', '2015-02-15', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('159', '3', '2015-02-16', '2015-02-22', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('160', '4', '2015-02-23', '2015-03-01', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('161', '5', '2015-03-02', '2015-03-08', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('162', '6', '2015-03-09', '2015-03-15', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('163', '7', '2015-03-16', '2015-03-22', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('164', '8', '2015-03-23', '2015-03-29', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('165', '9', '2015-03-30', '2015-04-05', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('166', '10', '2015-04-06', '2015-04-12', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('167', '11', '2015-04-13', '2015-04-19', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('168', '12', '2015-04-20', '2015-04-26', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('169', '13', '2015-04-27', '2015-05-03', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('170', '14', '2015-05-04', '2015-05-10', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('171', '15', '2015-05-11', '2015-05-17', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('172', '16', '2015-05-18', '2015-05-24', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('173', '17', '2015-05-25', '2015-05-31', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('174', '18', '2015-06-01', '2015-06-07', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('175', '19', '2015-06-08', '2015-06-14', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('176', '20', '2015-06-15', '2015-06-21', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('177', '21', '2015-06-22', '2015-06-28', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('178', '22', '2015-06-29', '2015-07-05', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('179', '23', '2015-07-06', '2015-07-12', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('180', '24', '2015-07-13', '2015-07-19', 'FY16', '163', '2015-12-18 17:11:36', '2015-12-18 17:11:36', '0000-00-00 00:00:00'), ('181', '25', '2015-07-20', '2015-07-26', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('182', '26', '2015-07-27', '2015-08-02', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('183', '27', '2015-08-03', '2015-08-09', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('184', '28', '2015-08-10', '2015-08-16', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('185', '29', '2015-08-17', '2015-08-23', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('186', '30', '2015-08-24', '2015-08-30', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('187', '31', '2015-08-31', '2015-09-06', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('188', '32', '2015-09-07', '2015-09-13', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('189', '33', '2015-09-14', '2015-09-20', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('190', '34', '2015-09-21', '2015-09-27', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('191', '35', '2015-09-28', '2015-10-04', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('192', '36', '2015-10-05', '2015-10-11', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('193', '37', '2015-10-12', '2015-10-18', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('194', '38', '2015-10-19', '2015-10-25', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('195', '39', '2015-10-26', '2015-11-01', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('196', '40', '2015-11-02', '2015-11-08', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('197', '41', '2015-11-09', '2015-11-15', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('198', '42', '2015-11-16', '2015-11-22', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('199', '43', '2015-11-23', '2015-11-29', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('200', '44', '2015-11-30', '2015-12-06', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('201', '45', '2015-12-07', '2015-12-13', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('202', '46', '2015-12-14', '2015-12-20', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('203', '47', '2015-12-21', '2015-12-27', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('204', '48', '2015-12-28', '2016-01-03', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('205', '49', '2016-01-04', '2016-01-10', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('206', '50', '2016-01-11', '2016-01-17', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('207', '51', '2016-01-18', '2016-01-24', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00'), ('208', '52', '2016-01-25', '2016-01-31', 'FY16', '163', '2015-12-18 17:11:37', '2015-12-18 17:11:37', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `years`
-- ----------------------------
BEGIN;
INSERT INTO `years` VALUES ('1', 'FY16', '2015-02-02', '2016-01-31', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
