/*
 Navicat MySQL Data Transfer

 Source Server         : true-local
 Source Server Version : 50625
 Source Host           : localhost
 Source Database       : fglportal

 Target Server Version : 50625
 File Encoding         : utf-8

 Date: 01/28/2016 15:13:59 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

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
  `background` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `banners`
-- ----------------------------
BEGIN;
INSERT INTO `banners` VALUES ('1', 'Sport Chek', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'Atmosphere', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communications`
-- ----------------------------
BEGIN;
INSERT INTO `communications` VALUES ('2', 'another test', '<p>this is a test message. but it&#39;s also the REAL message!</p>\r\n', 'someone else', '2', '2015-12-15 00:00:00', '2016-01-22 00:00:00', '0', '1', '0000-00-00 00:00:00', '2016-01-07 17:56:36', null);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `communications_target`
-- ----------------------------
BEGIN;
INSERT INTO `communications_target` VALUES ('10', '2', '0314', null, '2016-01-07 17:56:36', '2016-01-07 17:56:36', null), ('11', '2', '0392', 0x31, '2016-01-07 17:56:36', '2016-01-21 22:04:27', null);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `content_tag`
-- ----------------------------
BEGIN;
INSERT INTO `content_tag` VALUES ('4', '3', 'event', '2', '2016-01-06 20:32:26', '2016-01-06 20:32:26', null), ('5', '4', 'event', '1', '2016-01-06 23:17:26', '2016-01-06 23:17:26', null), ('6', '5', 'event', '2', '2016-01-06 23:19:25', '2016-01-06 23:19:25', null), ('7', '2', 'event', '2', '2016-01-06 23:21:47', '2016-01-06 23:21:47', null), ('8', '6', 'event', '1', '2016-01-07 00:10:13', '2016-01-07 00:10:13', null), ('11', '3', 'folder', '2', '2016-01-08 23:07:59', '2016-01-08 23:07:59', null), ('12', '2', 'document', '2', '2016-01-12 17:12:40', '2016-01-12 17:12:40', null), ('13', '242', 'folder', '1', '2016-01-25 16:47:24', '2016-01-25 16:47:24', null), ('14', '242', 'folder', '2', '2016-01-25 16:47:24', '2016-01-25 16:47:24', null);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `documents`
-- ----------------------------
BEGIN;
INSERT INTO `documents` VALUES ('1', 'f1f869f1e8a463fb320ddab581c1ccb5a4704148', 'Screen Shot 2016-01-11 at 10.46.11 AM.png', 'png', 'Screen_Shot_2016-01-11_at_10_46_11_AM_png_59beaa404fcb2183b0df3898070a56180ad6467c.png', 'no title', 'no description', '1', '2016-01-11 23:43:07', '2016-01-11 23:43:07', '', ''), ('2', 'f8d203ef782a2dcfc758bfe151c1dcd8c81a110d', 'Screen Shot 2016-01-05 at 1.36.35 PM.png', 'png', 'Screen_Shot_2016-01-05_at_1_36_35_PM_png_3643ec995a67581766b4a1ea5f30a51040db1452.png', 'Screen Shot 2016-01-05 at 1.36.35 PM', 'something I just added', '1', '2016-01-12 17:12:25', '2016-01-12 17:12:40', '2016-01-12 10:12:28', ''), ('3', '1b3602657eb3960c37442fe38b27d3cbf156441d', 'Screen Shot 2016-01-05 at 9.39.24 AM.png', 'png', 'Screen_Shot_2016-01-05_at_9_39_24_AM_png_034b329e2ae8808cb7a4decf907b221579c4ecfa.png', 'no title', 'no description', '1', '2016-01-12 22:13:44', '2016-01-12 22:13:44', '', ''), ('4', '8662eb2675765128dbe081015a2552a7425bf2ba', 'placeholder.pdf', 'pdf', 'placeholder_pdf_90a4d1cfd7dc14ad2cb9fc9c81dd44fb759ccf82.pdf', 'no title', 'no description', '1', '2016-01-25 22:32:56', '2016-01-25 22:32:56', '', ''), ('5', '8662eb2675765128dbe081015a2552a7425bf2ba', 'TCE_Behaviors Assessment_Cash 2013.pdf', 'pdf', 'TCE_Behaviors_Assessment_Cash_2013_pdf_960d411dad760f308f970bbf6d6cf3b8b1afe50f.pdf', 'no title', 'no description', '1', '2016-01-25 22:32:58', '2016-01-25 22:32:58', '', ''), ('6', 'c22ecd3149e31de84c0e8571e4ebcc95f494993e', 'placeholder.pdf', 'pdf', 'placeholder_pdf_e762fc4c7f8b7533c809abab23ee0ea9b2ba268a.pdf', 'no title', 'no description', '1', '2016-01-25 22:34:38', '2016-01-25 22:34:38', '', ''), ('7', 'b9237e6845c81ea7a0b9af3c5a8698cd49143ee1', 'placeholder.pdf', 'pdf', 'placeholder_pdf_734fc50971de8e5ff1fa6c8bf70f0f66d5009a52.pdf', 'no title', 'no description', '1', '2016-01-25 22:51:02', '2016-01-25 22:51:02', '', ''), ('8', '130fd46fb28aca0c49f3cf8e8b0969bb07a1e804', 'placeholder.pdf', 'pdf', 'placeholder_pdf_f166c60b4af55403cac8c3c01c6abaa2cfdd1bec.pdf', 'no title', 'no description', '1', '2016-01-25 22:52:28', '2016-01-25 22:52:28', '', ''), ('9', '130fd46fb28aca0c49f3cf8e8b0969bb07a1e804', 'placeholder.pdf', 'pdf', 'placeholder_pdf_6daa5efa905b384a4fb9ee176c8c1820e131eced.pdf', 'no title', 'no description', '1', '2016-01-25 22:56:29', '2016-01-25 22:56:29', '', ''), ('10', 'a75f08e2b89c01ac00737a4f49acaed1e64ceb79', 'placeholder.pdf', 'pdf', 'placeholder_pdf_f4d0e52ce0fe6674ed933f9e5e6caf1e6953d3d2.pdf', 'no title', 'no description', '1', '2016-01-25 22:57:44', '2016-01-25 22:57:44', '', ''), ('11', 'a5c33672d7d2f324b271ca2fe02a839599fd93d0', 'placeholder.pdf', 'pdf', 'placeholder_pdf_b79933e24fafe100da7339c069c74c9f94ee320d.pdf', 'no title', 'no description', '1', '2016-01-25 23:06:19', '2016-01-25 23:06:19', '', ''), ('12', 'c863bf3a66352d84f5037c20fa540657bcbfd084', 'placeholder.pdf', 'pdf', 'placeholder_pdf_6bc483689e018e69f37a069b57b03238f3bc93b5.pdf', 'no title', 'no description', '1', '2016-01-25 23:09:36', '2016-01-25 23:09:36', '', ''), ('13', '07362a51879355bc802dd7921d163f6fb667841b', 'placeholder.pdf', 'pdf', 'placeholder_pdf_abf629ef1b1c4fcf49f90040f102ca3c5c2f5f97.pdf', 'no title', 'no description', '1', '2016-01-25 23:11:00', '2016-01-25 23:11:00', '', ''), ('16', '428fc664627b18336864676159b95256c914dd6f', 'error.html', 'html', 'error_html_4bb2c9df17a39b760ac57e6c54ae151f659de59d.html', 'no title', 'no description', '1', '2016-01-25 23:24:06', '2016-01-25 23:24:06', '', ''), ('17', '428fc664627b18336864676159b95256c914dd6f', 'fglportal_2015-12-15.sql', 'sql', 'fglportal_2015-12-15_sql_4bb2c9df17a39b760ac57e6c54ae151f659de59d.sql', 'no title', 'no description', '1', '2016-01-25 23:24:06', '2016-01-25 23:24:06', '', ''), ('18', '428fc664627b18336864676159b95256c914dd6f', 'Screen Shot 2016-01-15 at 10.24.23 AM.png', 'png', 'Screen_Shot_2016-01-15_at_10_24_23_AM_png_4bb2c9df17a39b760ac57e6c54ae151f659de59d.png', 'no title', 'no description', '1', '2016-01-25 23:24:06', '2016-01-25 23:24:06', '', ''), ('19', '428fc664627b18336864676159b95256c914dd6f', 'BTS_webapp_2015-12-23.sql', 'sql', 'BTS_webapp_2015-12-23_sql_bbbc405f6cbce450a1866ca37d2da66963199f54.sql', 'no title', 'no description', '1', '2016-01-25 23:24:07', '2016-01-25 23:24:07', '', ''), ('20', '428fc664627b18336864676159b95256c914dd6f', 'placeholder.pdf', 'pdf', 'placeholder_pdf_bbbc405f6cbce450a1866ca37d2da66963199f54.pdf', 'no title', 'no description', '1', '2016-01-25 23:24:07', '2016-01-25 23:24:07', '', ''), ('21', '428fc664627b18336864676159b95256c914dd6f', 'TCE_Behaviors Assessment_Cash 2013.pdf', 'pdf', 'TCE_Behaviors_Assessment_Cash_2013_pdf_bbbc405f6cbce450a1866ca37d2da66963199f54.pdf', 'no title', 'no description', '1', '2016-01-25 23:24:07', '2016-01-25 23:24:07', '', ''), ('22', '428fc664627b18336864676159b95256c914dd6f', 'mountains.jpg', 'jpg', 'mountains_jpg_56e8981ea17497ba8b384ed06f9d5d364a04a09f.jpg', 'no title', 'no description', '1', '2016-01-25 23:24:08', '2016-01-25 23:24:08', '', ''), ('23', '98100b13b4b92e614f585f53406e2cef1f7a0bf8', 'placeholder.pdf', 'pdf', 'placeholder_pdf_1a75de24861e8b2128f58e1f0fec7cfdbdfbf69a.pdf', 'placeholder', 'aefsdgs', '1', '2016-01-26 16:27:31', '2016-01-26 16:59:34', '2016-01-26 09:59:23', ''), ('24', '18d6bd08a072a6151086d6c81d6e0ac2c84f1ea1', 'TCE_Behaviors Assessment_Cash 2013.pdf', 'pdf', 'TCE_Behaviors_Assessment_Cash_2013_pdf_9d09f9a503c1b135e0ffd4eabb151014aed95264.pdf', 'TCE_Behaviors Assessment_Cash 2013', 'this si sometinigsag wig', '1', '2016-01-26 17:01:23', '2016-01-26 17:02:13', '2016-12-25 10:01:27', '2017-01-01 00:00:00'), ('26', '6878d6193497c7f75d48a5a9084aa7f414f624f9', 'placeholder.pdf', 'pdf', 'placeholder_pdf_dbf7ec6b6248c07cdb586a297f312ed94d104af5.pdf', 'placeholder', '', '1', '2016-01-26 20:56:38', '2016-01-26 20:56:46', '2016-01-26 13:56:44', ''), ('27', '6878d6193497c7f75d48a5a9084aa7f414f624f9', 'ManagerWeb_Content_Overview.pdf', 'pdf', 'ManagerWeb_Content_Overview_pdf_db0b2b997759e2b46d0c0ae1a73bdd61db9569af.pdf', 'ManagerWeb_Content_Overview', '', '1', '2016-01-26 20:56:41', '2016-01-26 20:56:47', '2016-01-26 13:56:44', '');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `event_types`
-- ----------------------------
BEGIN;
INSERT INTO `event_types` VALUES ('10', 'sc some type of event', '1', '2016-01-07 17:16:37', '2016-01-06 20:30:54', '2016-01-07 17:16:37'), ('11', 'dfsdfasdf', '2', null, '2016-01-06 22:54:21', '2016-01-06 22:54:21'), ('12', 'sc wgrafsfagfsag', '1', '2016-01-07 00:07:39', '2016-01-06 22:54:31', '2016-01-07 00:07:39'), ('13', 'this is atmo only', '2', null, '2016-01-06 23:05:12', '2016-01-06 23:05:12'), ('14', 'hadhfladf', '1', null, '2016-01-07 17:16:44', '2016-01-07 17:16:44'), ('15', 'adasdas', '1', null, '2016-01-07 17:16:48', '2016-01-07 17:16:48'), ('16', 'sadasd', '1', null, '2016-01-07 17:16:51', '2016-01-07 17:16:51'), ('17', 'asdsad', '1', null, '2016-01-07 17:16:54', '2016-01-07 17:16:54');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `events`
-- ----------------------------
BEGIN;
INSERT INTO `events` VALUES ('2', '1', 'Colours', 'this is a better desc', '10', '2016-01-13', '2016-01-14', '2016-01-25 16:48:39', '2016-01-06 20:31:15', '2016-01-25 16:48:39'), ('3', '1', 'ad', 'ads asd sad as', '10', '2016-01-13', '2016-01-20', null, '2016-01-06 20:32:26', '2016-01-07 00:08:34'), ('4', '2', 'this is a test event atmo', 'adfadf', '13', '2016-01-28', '2016-01-05', null, '2016-01-06 23:17:26', '2016-01-06 23:17:26'), ('6', '1', 'sc event', 'this is something that’s happening', '10', '2016-01-14', '2016-01-20', null, '2016-01-07 00:10:12', '2016-01-07 17:11:33'), ('7', '1', 'vadcads', 'sda', '14', '2016-01-06', '2016-01-19', null, '2016-01-08 18:33:21', '2016-01-08 18:33:21');
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
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `background_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `features_banner_id_foreign` (`banner_id`),
  CONSTRAINT `features_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `features`
-- ----------------------------
BEGIN;
INSERT INTO `features` VALUES ('1', '1', '8', 'Hockey Plus', '', 'background.jpg', 'lorempixel-1.jpg', '0000-00-00', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', '1', '2', 'Back to School', '', 'maxresdefault.jpg', 'lorempixel-2.jpg', '0000-00-00', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', '1', '3', 'QMag', '', 'sports-hockey1.jpg', 'lorempixel-3.jpg', '0000-00-00', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('4', '1', '5', 'Jumpstart', '', 'Sports-Randy-Savoie-Bears-Football-2.jpg', 'lorempixel-4.jpg', '0000-00-00', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('5', '1', '4', 'Spring Changeover', '', 'Taking_Flight.jpg', 'lorempixel-5.jpg', '0000-00-00', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('6', '1', '6', 'Holiday 2015', '', 'Wallpapers-Hd-Sports-Basket.jpg', 'lorempixel-6.jpg', '0000-00-00', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('7', '1', '1', 'Boxing Day 2015', '', 'snowboarding-drift-winter-sport-snow-252258.jpg', 'lorempixel.jpg', '0000-00-00', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('8', '1', '7', 'SGM Conference', '', 'sports_upcoming1-1.jpg', 'lorempixel-7.jpg', '0000-00-00', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `file_folder`
-- ----------------------------
BEGIN;
INSERT INTO `file_folder` VALUES ('1', '1', '0', '2016-01-11 23:43:07', '2016-01-11 23:43:07'), ('2', '2', '227', '2016-01-12 17:12:25', '2016-01-12 17:12:25'), ('3', '3', '227', '2016-01-12 22:13:44', '2016-01-12 22:13:44'), ('4', '4', '0', '2016-01-25 22:32:56', '2016-01-25 22:32:56'), ('5', '5', '0', '2016-01-25 22:32:58', '2016-01-25 22:32:58'), ('6', '6', '0', '2016-01-25 22:34:38', '2016-01-25 22:34:38'), ('7', '7', '0', '2016-01-25 22:51:02', '2016-01-25 22:51:02'), ('8', '8', '0', '2016-01-25 22:52:28', '2016-01-25 22:52:28'), ('9', '9', '0', '2016-01-25 22:56:29', '2016-01-25 22:56:29'), ('10', '10', '0', '2016-01-25 22:57:44', '2016-01-25 22:57:44'), ('11', '11', '0', '2016-01-25 23:06:19', '2016-01-25 23:06:19'), ('12', '12', '242', '2016-01-25 23:09:36', '2016-01-25 23:09:36'), ('13', '13', '242', '2016-01-25 23:11:00', '2016-01-25 23:11:00'), ('16', '16', '239', '2016-01-25 23:24:06', '2016-01-25 23:24:06'), ('17', '17', '239', '2016-01-25 23:24:06', '2016-01-25 23:24:06'), ('18', '18', '239', '2016-01-25 23:24:07', '2016-01-25 23:24:07'), ('19', '19', '239', '2016-01-25 23:24:07', '2016-01-25 23:24:07'), ('20', '20', '239', '2016-01-25 23:24:07', '2016-01-25 23:24:07'), ('21', '21', '239', '2016-01-25 23:24:07', '2016-01-25 23:24:07'), ('22', '22', '239', '2016-01-25 23:24:08', '2016-01-25 23:24:08'), ('23', '23', '248', '2016-01-26 16:27:31', '2016-01-26 16:27:31'), ('24', '24', '248', '2016-01-26 17:01:23', '2016-01-26 17:01:23'), ('26', '26', '219', '2016-01-26 20:56:38', '2016-01-26 20:56:38'), ('27', '27', '219', '2016-01-26 20:56:41', '2016-01-26 20:56:41');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
INSERT INTO `folders` VALUES ('1', 'thing', '2016-01-07 20:49:55', '2016-01-07 20:54:30', '1', '0', '0', '0', '1', '2016-01-26 20:56:47'), ('2', 'somthine else', '2016-01-07 20:54:30', '2016-01-08 16:54:24', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('3', 'another', '2016-01-07 20:54:30', '2016-01-08 23:08:00', '1', '1', '0', '0', '1', '2016-01-08 23:08:00'), ('6', 'testing the modal', '2016-01-08 16:54:24', '2016-01-08 20:53:50', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('8', 'something', '2016-01-08 20:53:32', '2016-01-08 20:53:32', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('9', 'bird', '2016-01-08 20:53:50', '2016-01-11 18:13:56', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('10', '1', '2016-01-08 21:49:07', '2016-01-08 21:49:07', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('11', '2', '2016-01-08 21:49:07', '2016-01-08 23:05:35', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('26', 'this', '2016-01-08 23:05:35', '2016-01-08 23:05:35', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('27', 'something totally different', '2016-01-08 23:05:35', '2016-01-21 22:10:36', '1', '1', '0', '0', '1', '2016-01-26 20:56:47'), ('28', 'sub', '2016-01-08 23:05:35', '2016-01-08 23:05:35', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('30', 'jlljh', '2016-01-08 23:07:40', '2016-01-08 23:07:40', '0', '0', '0', '0', '1', '0000-00-00 00:00:00'), ('32', 'dsa', '2016-01-08 23:08:00', '2016-01-08 23:08:00', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('33', 'sadsdsad', '2016-01-08 23:08:00', '2016-01-08 23:08:00', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('35', 'hehksdflsdkf', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '2016-01-12 22:13:44'), ('36', 'klhsdaflkdsklfsd', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('37', 'k;ljfds;kjfds;l;', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('38', ';dasl', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('39', 'sfgfd', '2016-01-08 23:24:10', '2016-01-08 23:24:10', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('40', 'hadfhad', '2016-01-11 18:14:17', '2016-01-11 18:14:40', '1', '0', '0', '0', '1', '2016-01-25 23:24:08'), ('41', '1', '2016-01-11 18:14:40', '2016-01-11 18:14:40', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('42', '2', '2016-01-11 18:14:40', '2016-01-11 18:14:40', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('43', '3', '2016-01-11 18:14:40', '2016-01-21 22:11:23', '1', '1', '0', '0', '1', '2016-01-25 23:24:08'), ('44', 'adfadf', '2016-01-21 22:11:23', '2016-01-21 22:11:23', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('47', 'faaaf', '2016-01-21 22:11:23', '2016-01-25 16:46:28', '1', '1', '0', '0', '1', '2016-01-25 23:24:08'), ('48', 'sdfsd', '2016-01-21 22:12:56', '2016-01-21 22:12:56', '0', '0', '0', '0', '1', '0000-00-00 00:00:00'), ('49', 'zcasas', '2016-01-25 16:46:15', '2016-01-25 16:46:15', '0', '0', '0', '0', '1', '0000-00-00 00:00:00'), ('50', 'rename', '2016-01-25 16:46:27', '2016-01-25 16:47:24', '1', '1', '0', '0', '1', '2016-01-25 23:11:00'), ('51', 'dsf', '2016-01-25 16:46:27', '2016-01-25 16:46:27', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('52', 'dfs', '2016-01-25 16:46:27', '2016-01-25 16:46:27', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('53', 'aaf', '2016-01-25 16:46:27', '2016-01-25 16:46:27', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('55', 'sdfsdf', '2016-01-25 16:47:24', '2016-01-25 16:47:24', '0', '1', '0', '0', '1', '0000-00-00 00:00:00'), ('56', 'brent', '2016-01-25 23:42:03', '2016-01-25 23:42:03', '0', '0', '0', '0', '1', '2016-01-26 17:04:42');
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1'), ('2014_10_12_100000_create_password_resets_table', '1'), ('2015_09_02_150403_documents', '1'), ('2015_09_16_150414_folders', '1'), ('2015_09_16_150425_folder_struct', '1'), ('2015_09_16_150438_file_folder', '1'), ('2015_09_28_215143_create-fiscal-year-table', '1'), ('2015_09_28_215144_create-weeks-table', '1'), ('2015_09_30_213442_create-banners-table', '1'), ('2015_09_30_215422_update-folders-table', '1'), ('2015_10_27_145632_update_documents_table', '1'), ('2015_10_28_173427_create_folder_ids_table', '1'), ('2015_11_27_172830_create_package_table', '1'), ('2015_11_27_175201_create_document_package_pivot_table', '1'), ('2015_11_30_210139_create_event_types_table', '1'), ('2015_11_30_222337_create_events_table', '1'), ('2015_12_02_230415_update_packages_table', '1'), ('2015_12_03_214110_create_communication_importance_table', '1'), ('2015_12_03_214558_create_communications_table', '1'), ('2015_12_04_222108_create_communication_package_pivot_table', '1'), ('2015_12_04_222116_create_communication_document_pivot_table', '1'), ('2015_12_07_234421_create_tags_table', '1'), ('2015_12_09_200212_create_content_tag_pivot_table', '1'), ('2015_12_14_180605_update_weeks_table', '1'), ('2015_12_18_211214_CreateCommunicationsReadTable', '1'), ('2015_12_18_212934_CreateCommunicationTargetTable', '1'), ('2015_12_15_181406_create_user_group_table', '2'), ('2015_12_15_182533_update_users_table', '2'), ('2015_12_16_200336_create_banner_user_pivot_table', '2'), ('2015_12_17_231103_create_user_selected_banner_table', '2'), ('2016_01_26_223339_create_features_table', '3'), ('2016_01_26_231215_update_features_table', '4'), ('2016_01_27_174427_create_folder_package_pivot', '5'), ('2016_01_26_220505_create_quicklinks_type_table', '6'), ('2016_01_27_214111_create_quicklinks_table', '6'), ('2016_01_27_220050_create_dashboard_branding_table', '6'), ('2016_01_27_230216_update_dashboard_branding_table', '7'), ('2016_01_27_231623_update_quicklinks_types_table', '8'), ('2016_01_28_180958_update_quicklinks_table', '9'), ('2016_01_28_204112_update_banners_table', '10'), ('2016_01_28_205523_update_features_table', '11');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `quicklinks`
-- ----------------------------
BEGIN;
INSERT INTO `quicklinks` VALUES ('1', '1', '0', '1', 'item 1', '248', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('2', '1', '1', '2', 'item 2', '24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null), ('3', '1', '2', '3', 'item 3', 'https://www.thenorthface.com/en_ca/homepage.html', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null);
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `user_selected_banner`
-- ----------------------------
BEGIN;
INSERT INTO `user_selected_banner` VALUES ('48', '3', '1', '2016-01-27 21:59:18', '2016-01-27 21:59:18');
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
