/*
 Navicat MySQL Backup

 Source Server         : true-local
 Source Server Version : 50625
 Source Host           : localhost
 Source Database       : fglportal

 Target Server Version : 50625
 File Encoding         : utf-8

 Date: 12/15/2015 16:16:38 PM
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
INSERT INTO `banners` VALUES ('1', 'Sport Chek', '2015-12-08 19:02:21', '2015-12-08 19:02:21'), ('2', 'Atmosphere', '2015-12-08 19:02:21', '2015-12-08 19:02:21'), ('3', 'Marks', '2015-12-08 19:02:21', '2015-12-08 19:02:21');
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
INSERT INTO `communication_importance_levels` VALUES ('1', 'low', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', 'medium', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', 'high', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
  CONSTRAINT `communications_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`),
  CONSTRAINT `communications_importance_foreign` FOREIGN KEY (`importance`) REFERENCES `communication_importance_levels` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `documents`
-- ----------------------------
BEGIN;
INSERT INTO `documents` VALUES ('49', '64a19714c46a31ed38c2b7cae9d88e3d0437b9ce', 'Screen Shot 2015-12-03 at 1.04.49 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_49_PM_png_5fb9e0aa4c25ea879ceea94a3815cbd958642661.png', 'Some title', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', '2015-12-09 00:15:17', '2015-12-09 00:17:32', '2015-12-08 00:00:00', ''), ('50', '64a19714c46a31ed38c2b7cae9d88e3d0437b9ce', 'Screen Shot 2015-12-03 at 1.04.20 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_20_PM_png_ea1129482df15962ced619f4094f4006e8ea9fa1.png', 'no title', 'no description', '1', '2015-12-09 00:15:19', '2015-12-09 00:15:19', '', ''), ('51', '64a19714c46a31ed38c2b7cae9d88e3d0437b9ce', 'Screen Shot 2015-12-03 at 1.04.33 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_33_PM_png_ea1129482df15962ced619f4094f4006e8ea9fa1.png', 'no title', 'no description', '1', '2015-12-09 00:15:19', '2015-12-09 00:15:19', '', ''), ('52', '64a19714c46a31ed38c2b7cae9d88e3d0437b9ce', 'Screen Shot 2015-12-03 at 1.03.04 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_03_04_PM_png_ea1129482df15962ced619f4094f4006e8ea9fa1.png', 'no title', 'no description', '1', '2015-12-09 00:15:19', '2015-12-09 00:15:19', '', ''), ('53', '64a19714c46a31ed38c2b7cae9d88e3d0437b9ce', 'Screen Shot 2015-12-04 at 1.34.07 PM.png', 'png', 'Screen_Shot_2015-12-04_at_1_34_07_PM_png_e58f200eb8143414df197e2931e087e6f86e3f21.png', 'no title', 'no description', '1', '2015-12-09 00:15:20', '2015-12-09 00:15:20', '', ''), ('54', 'b2b535aa587e1b2ba10cd242c578002bae951d87', 'Screen Shot 2015-12-03 at 1.04.49 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_49_PM_png_508c3571c344269ccd2cb95432c53887fe225838.png', 'Screen Shot 2015-12-03 at 1.04.49 PM', '', '1', '2015-12-09 20:56:34', '2015-12-09 20:56:40', '2015-12-09 13:56:37', ''), ('55', 'b2b535aa587e1b2ba10cd242c578002bae951d87', 'Screen Shot 2015-12-03 at 1.04.20 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_20_PM_png_73caf10b4c123a04c5dcea3f683a4f3e0243d395.png', 'Screen Shot 2015-12-03 at 1.04.20 PM', '', '1', '2015-12-09 20:56:35', '2015-12-09 20:56:40', '2015-12-09 13:56:37', ''), ('56', 'b2b535aa587e1b2ba10cd242c578002bae951d87', 'Screen Shot 2015-12-03 at 1.03.04 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_03_04_PM_png_73caf10b4c123a04c5dcea3f683a4f3e0243d395.png', 'Screen Shot 2015-12-03 at 1.03.04 PM', '', '1', '2015-12-09 20:56:35', '2015-12-09 20:56:40', '2015-12-09 13:56:37', ''), ('57', 'b2b535aa587e1b2ba10cd242c578002bae951d87', 'Screen Shot 2015-12-04 at 1.34.07 PM.png', 'png', 'Screen_Shot_2015-12-04_at_1_34_07_PM_png_73caf10b4c123a04c5dcea3f683a4f3e0243d395.png', 'Screen Shot 2015-12-04 at 1.34.07 PM', '', '1', '2015-12-09 20:56:35', '2015-12-09 20:56:40', '2015-12-09 13:56:37', ''), ('58', 'b2b535aa587e1b2ba10cd242c578002bae951d87', 'Screen Shot 2015-12-03 at 1.04.33 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_33_PM_png_73caf10b4c123a04c5dcea3f683a4f3e0243d395.png', 'Screen Shot 2015-12-03 at 1.04.33 PM', '', '1', '2015-12-09 20:56:35', '2015-12-09 20:56:40', '2015-12-09 13:56:37', ''), ('59', 'a041b168f69474f355d897608144355765e5342d', 'Screen Shot 2015-12-03 at 1.04.49 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_49_PM_png_02d8246bb610a2da9fdde5cb2cb03b29284d56d6.png', 'no title', 'no description', '1', '2015-12-09 23:27:12', '2015-12-09 23:27:12', '', ''), ('60', 'a041b168f69474f355d897608144355765e5342d', 'Screen Shot 2015-12-03 at 1.04.20 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_20_PM_png_02d8246bb610a2da9fdde5cb2cb03b29284d56d6.png', 'no title', 'no description', '1', '2015-12-09 23:27:12', '2015-12-09 23:27:12', '', ''), ('61', 'a041b168f69474f355d897608144355765e5342d', 'Screen Shot 2015-12-03 at 1.03.04 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_03_04_PM_png_47a7839fe418510f3e3b47e883d5eae08e80e57c.png', 'no title', 'no description', '1', '2015-12-09 23:27:13', '2015-12-09 23:27:13', '', ''), ('62', 'a041b168f69474f355d897608144355765e5342d', 'Screen Shot 2015-12-03 at 1.04.33 PM.png', 'png', 'Screen_Shot_2015-12-03_at_1_04_33_PM_png_47a7839fe418510f3e3b47e883d5eae08e80e57c.png', 'no title', 'no description', '1', '2015-12-09 23:27:13', '2015-12-09 23:27:13', '', ''), ('63', 'a041b168f69474f355d897608144355765e5342d', 'Screen Shot 2015-12-04 at 1.34.07 PM.png', 'png', 'Screen_Shot_2015-12-04_at_1_34_07_PM_png_47a7839fe418510f3e3b47e883d5eae08e80e57c.png', 'no title', 'no description', '1', '2015-12-09 23:27:13', '2015-12-09 23:27:13', '', ''), ('64', 'b235bb8a669dbd37bf30ad5d104ad4b1c51ea052', 'image003.jpg', 'jpg', 'image003_jpg_ea0148ea21d7ee29772b06d51253084ad76dc015.jpg', 'no title', 'no description', '1', '2015-12-10 00:04:23', '2015-12-10 00:04:23', '', ''), ('65', 'b235bb8a669dbd37bf30ad5d104ad4b1c51ea052', 'image005.gif', 'gif', 'image005_gif_ea0148ea21d7ee29772b06d51253084ad76dc015.gif', 'no title', 'no description', '1', '2015-12-10 00:04:23', '2015-12-10 00:04:23', '', ''), ('66', 'b235bb8a669dbd37bf30ad5d104ad4b1c51ea052', 'image002.jpg', 'jpg', 'image002_jpg_ea0148ea21d7ee29772b06d51253084ad76dc015.jpg', 'no title', 'no description', '1', '2015-12-10 00:04:23', '2015-12-10 00:04:23', '', ''), ('67', '492580eb912c45461126dff4abf8954a1cde4247', 'inspinia.js', 'js', 'inspinia_js_be86b3d1ca1c09eb8f46bfce440a08245e33b617.js', 'no title', 'no description', '1', '2015-12-10 00:09:36', '2015-12-10 00:09:36', '', ''), ('68', '17e0a6327aedcd71373399e18230cbf122542d35', 'inspinia.js', 'js', 'inspinia_js_12b1a4505235fe47e8a41898f01f289dcf8a4286.js', 'no title', 'no description', '1', '2015-12-10 00:09:49', '2015-12-10 00:09:49', '', ''), ('69', '5ea44c217e4aa800545039691c5bbd1bc3a6fc22', 'switch - JavaScript _ MDN.html', 'html', 'switch_-_JavaScript___MDN_html_c1ecf56475bdae677cf7aff9d0d18f1eaaf380be.html', 'switch - JavaScript _ MDN', '', '1', '2015-12-10 00:10:30', '2015-12-10 00:10:33', '2015-12-09 17:10:31', ''), ('70', 'c7f91f88f897ee3caa053f54fb6122b03125573c', 'robots.txt', 'txt', 'robots_txt_136cccf47c8f1c0811f77c7ccd061c0c599b03bc.txt', 'no title', 'no description', '1', '2015-12-10 00:12:08', '2015-12-10 00:12:08', '', ''), ('71', 'c7f91f88f897ee3caa053f54fb6122b03125573c', 'Visual District Alignment Q2 2015_Store Directory_April 24.pdf', 'pdf', 'Visual_District_Alignment_Q2_2015_Store_Directory_April_24_pdf_883f8fb1c96e0c48b257ad4584fbf5f66c04a3a8.pdf', 'no title', 'no description', '1', '2015-12-10 00:12:51', '2015-12-10 00:12:51', '', ''), ('72', '1bb6c4cfa5ec4a1fb54fae8238533d74fade28d4', 'Screen Shot 2015-12-01 at 1.42.26 PM.png', 'png', 'Screen_Shot_2015-12-01_at_1_42_26_PM_png_4e57df4df6ca7b5d35dbd383ad5f1d30fe0c6b8c.png', 'Screen Shot 2015-12-01 at 1.42.26 PM', '', '1', '2015-12-10 00:13:05', '2015-12-10 00:13:09', '2015-12-09 17:13:06', ''), ('73', 'f8e85572d4d854ec6f334376b535d9d0c4cd8e07', 'Visual District Alignment Q2 2015_Store Directory_April 24.pdf', 'pdf', 'Visual_District_Alignment_Q2_2015_Store_Directory_April_24_pdf_c7b66d9d11c04ad41975c3e6d35680d57a679792.pdf', 'no title', 'no description', '1', '2015-12-10 00:13:24', '2015-12-10 00:13:24', '', ''), ('74', '9f34a639b3cd7fd86acec7815f39c02e592be1a1', 'Visual District Alignment Q2 2015_Store Directory_April 24.pdf', 'pdf', 'Visual_District_Alignment_Q2_2015_Store_Directory_April_24_pdf_dbf80a4cafd3040d9d3a1496df0cb7bdc8e7fdef.pdf', 'no title', 'no description', '1', '2015-12-10 00:14:12', '2015-12-10 00:14:12', '', ''), ('76', 'f6f9170a4ed0bef2a90ccd25426d51b7391acc8f', 'Visual District Alignment Q2 2015_Store Directory_April 24.pdf', 'pdf', 'Visual_District_Alignment_Q2_2015_Store_Directory_April_24_pdf_44c8787baa24abf8d9a9cbad052577fddd136339.pdf', 'no title', 'no description', '1', '2015-12-10 00:21:19', '2015-12-10 00:21:19', '', ''), ('77', 'd23960a3fc064b0d07a484f2e21b832da6a41a10', 'Visual District Alignment Q2 2015_Store Directory_April 24.pdf', 'pdf', 'Visual_District_Alignment_Q2_2015_Store_Directory_April_24_pdf_00ca1151f0b5e26f9ca498c8488abf7143e96d51.pdf', 'no title', 'no description', '1', '2015-12-10 00:24:21', '2015-12-10 00:24:21', '', ''), ('78', 'bf89aa29c89afe44287de52f0f0f0de037e53488', 'Visual District Alignment Q2 2015_Store Directory_April 24.pdf', 'pdf', 'Visual_District_Alignment_Q2_2015_Store_Directory_April_24_pdf_71009e39dc40a59993b094f572338e54287336f4.pdf', 'no title', 'no description', '1', '2015-12-10 00:29:43', '2015-12-10 00:29:43', '', ''), ('79', '63ed6a228371ab1d7b9348a225f69af19a340797', 'error.html', 'html', 'error_html_495e05d3aaa8a21c44702ed75b31c10086914631.html', 'this is an html file', 'pretty sweet', '1', '2015-12-10 17:55:48', '2015-12-10 17:56:08', '2015-12-10 10:55:54', ''), ('80', 'ef74634eb154c568f119f6ea70b57ef5e7232a09', 'error.html', 'html', 'error_html_a90073ff5796c3990fd405bd2f349ee370c0640c.html', 'no title', 'no description', '1', '2015-12-10 17:57:14', '2015-12-10 17:57:14', '', ''), ('81', 'bc7c67fdbb80f6f54818bd27894aa2dfd7c0b5d4', 'error.html', 'html', 'error_html_c69a3698611b15f23add39accc28dfa8a7f39596.html', 'this is the error file', 'yest it is', '1', '2015-12-10 17:59:49', '2015-12-10 18:00:02', '2015-12-10 10:59:52', ''), ('84', '70f6b4da5db8f968c7131730acf9c7de389d0874', 'Visual District Alignment Q2 2015_Store Directory_April 24.pdf', 'pdf', 'Visual_District_Alignment_Q2_2015_Store_Directory_April_24_pdf_0369a8284218ad52bc19889ec56601b77243e951.pdf', 'Visual District Alignment Q2 2015_Store Directory_April 24', '', '1', '2015-12-10 18:03:17', '2015-12-10 18:03:31', '2015-12-10 11:03:27', '');
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
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `event_types`
-- ----------------------------
BEGIN;
INSERT INTO `event_types` VALUES ('1', 'Event Type 1', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20'), ('2', 'Event Type 2', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20'), ('3', 'Event Type 3', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20'), ('4', 'Event Type 4', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20'), ('5', 'Event Type 5', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20'), ('6', 'Event Type 6', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20'), ('7', 'Event Type 7', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20'), ('8', 'Event Type 8', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20'), ('9', 'Event Type 9', null, '2015-12-08 19:02:20', '2015-12-08 19:02:20');
COMMIT;

-- ----------------------------
--  Table structure for `events`
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner` int(11) NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `event_type` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `events`
-- ----------------------------
BEGIN;
INSERT INTO `events` VALUES ('1', '2', 'Sunt similique atque repudiandae ullam reprehenderit eligendi sunt enim.', 'testing new path to JS', '5', '2015-12-14', '0000-00-00', null, '0000-00-00 00:00:00', '2015-12-11 17:37:50'), ('2', '2', 'Consequatur doloribus deleniti provident amet sint illum consequuntur.', 'Eligendi molestiae numquam ea qui. Hic velit error delectus sit dolor. Qui omnis impedit accusantium blanditiis vel. Aut nobis beatae in et consectetur velit quae beatae.', '1', '2015-12-12', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', '1', 'Suscipit omnis quos est est quidem recusandae explicabo.', 'Voluptate nobis explicabo distinctio tempora et autem est. Laudantium assumenda id aut explicabo nisi quod aperiam et. Quia et vero pariatur repudiandae fugiat deleniti.', '1', '2015-12-03', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('4', '2', 'Occaecati culpa aut numquam dolorum voluptas est iste.', 'Voluptas autem ab dolor aspernatur ratione culpa enim. Dolore quo illum quaerat quaerat repellendus laudantium. Et recusandae sit omnis optio quis. Non voluptas illo aut iste non.', '9', '2015-12-29', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('5', '1', 'Reprehenderit odit a eos recusandae.', 'Non voluptatem quam consequatur recusandae voluptatem sapiente quidem. Alias et magni impedit similique velit quo. Dolores et tempora consequuntur ut rerum. Voluptate architecto error ut.', '2', '2015-12-11', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('6', '1', 'Voluptate accusamus explicabo impedit dolorem.', 'Aut et ut temporibus distinctio. Velit enim perferendis libero voluptate quidem reiciendis ullam. Voluptas dignissimos molestiae qui sunt commodi dolorum.', '5', '2015-12-03', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('7', '2', 'Nihil dolores blanditiis iure omnis sint qui deserunt rerum.', 'Voluptas provident maiores eos nemo enim. Corrupti et natus iste accusantium accusamus. Nobis deserunt occaecati maiores. Beatae nulla necessitatibus quasi aliquam sit. Vero accusantium possimus voluptas omnis cupiditate iure ab.', '8', '2015-12-23', '2015-12-27', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('8', '2', 'Eius sit in dolore cum.', 'Sunt voluptates voluptas quaerat commodi et perferendis porro. Aperiam dolorem deleniti officiis est minima reprehenderit incidunt. Non harum magni qui animi corporis.', '5', '2015-12-13', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('9', '2', 'Voluptatum nihil beatae corrupti et accusamus dolorem vero sapiente.', 'Beatae doloribus ut maiores ab. Fugit est eaque officia inventore. Modi odit sunt reprehenderit rerum dicta aliquam facilis quia. Ipsam quia architecto deserunt nihil qui sunt est.', '2', '2015-12-29', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('10', '3', 'Sequi quam et deleniti est consequatur amet laboriosam.', 'Illum nulla voluptatem optio sunt quia ad similique. Recusandae ipsam nobis quo consectetur voluptas architecto nobis. Aliquid voluptatum atque sequi porro ea. Architecto aut quia tenetur suscipit.', '2', '2015-12-09', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('11', '1', 'Aliquid eveniet dolores autem vitae.', 'Qui voluptas corporis nihil ad provident. Voluptatem quo modi optio beatae facilis minus aut est. Et amet minima vel.', '3', '2015-12-17', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('12', '3', 'Vel autem expedita quos fugiat facilis quisquam aut.', 'Modi non deleniti at dolorem voluptates corrupti quo. Eum natus quaerat neque sunt omnis eveniet rerum perspiciatis. Nulla et et alias magni nulla.', '9', '2015-12-01', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('13', '1', 'Ut maxime minima enim molestiae eveniet.', 'Voluptatem aspernatur vel impedit. Culpa ut molestiae eius voluptas error. Rerum voluptatibus et dolorum eos unde suscipit veniam. Enim beatae et assumenda enim. Ullam ab voluptas et non blanditiis.', '2', '2015-12-08', '2015-12-28', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('14', '1', 'Dicta maiores eos impedit ipsa.', 'Omnis distinctio dolorem at dolorem itaque quis. Nostrum optio placeat mollitia quaerat laborum. Totam vel dicta maxime et quas qui quis enim. Sunt similique possimus nisi. Est voluptatum eum dolore aut perspiciatis necessitatibus et.', '1', '2015-12-29', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('15', '3', 'Sed corrupti tempore dolorem deleniti.', 'Eum eaque eaque quo sed ea incidunt quas beatae. Rerum iste quo blanditiis. Ut occaecati aperiam cumque quod.', '5', '2015-12-21', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('16', '3', 'Consectetur aut et perspiciatis ut porro.', 'Enim hic voluptas sed maxime ea laboriosam iste ad. Non in fugit totam quos non. Et commodi atque omnis incidunt voluptas ad quae. Dolorem autem fugit repudiandae et magnam.', '4', '2015-12-06', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('17', '1', 'Recusandae nulla iusto et voluptatem deserunt facilis.', 'Animi harum aspernatur debitis enim. Enim consequatur eum quod deleniti et id aperiam. Ut qui aut laudantium alias omnis modi. Rerum vitae rerum facere nulla et enim.', '1', '2015-12-24', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('18', '1', 'Esse aperiam veniam autem eaque.', 'Omnis molestiae eos expedita velit ut voluptatem quis et. In laborum soluta rerum praesentium non explicabo atque recusandae. Culpa nam magnam voluptas in quo. Voluptatem ut dicta quia sequi.', '3', '2015-12-22', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('19', '3', 'At incidunt officiis totam est id esse.', 'Reprehenderit animi rerum sit rem est culpa. Et ea quaerat maxime repudiandae. Odit ea possimus a voluptatem minima ea sequi maxime.', '9', '2015-12-26', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('20', '1', 'Illo dolores adipisci odit possimus sint quam porro.', 'Illum enim voluptates nesciunt et maiores. Laudantium ut sapiente architecto sit. Libero libero incidunt quia ipsam impedit aut.', '1', '2015-12-31', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('21', '2', 'Quo eius eaque reprehenderit animi.', 'Nihil consectetur et nisi aliquam illo voluptas libero doloribus. Impedit eum a voluptatem aut. Quod delectus ea quia reiciendis.', '1', '2015-12-04', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('22', '3', 'Atque est natus quia.', 'Est et rem fugiat voluptatem magnam dolorem commodi. Praesentium totam nihil dicta dolores esse sed omnis.', '7', '2015-12-07', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('23', '3', 'Qui fuga cum quia nihil dignissimos deserunt.', 'Porro porro ipsam et ab. Nam harum omnis aliquid recusandae suscipit. Sit iure repellendus consequuntur est maxime quas et fugit. Error cum et omnis voluptatum.', '7', '2015-12-27', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('24', '1', 'Deserunt nihil provident exercitationem est maiores.', 'Ex hic id ullam voluptates et quia et. Temporibus vel dolorum repudiandae aliquid sit quo qui.', '6', '2015-12-26', '2015-12-27', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('25', '3', 'Repellat dolorum totam amet nostrum.', 'Dolores similique velit eveniet. Repellat nisi facilis nesciunt a quaerat natus nemo. Sint omnis quo quidem rem voluptas. Sunt corrupti fugiat accusamus aut.', '5', '2015-12-02', '2015-12-29', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('26', '2', 'Voluptas sunt accusamus minima.', 'Quidem eius ratione ipsam qui ex nesciunt dolore. Id laboriosam fuga in et ut ut praesentium. Saepe ullam vitae tenetur eos dolor aliquid sed.', '2', '2015-12-11', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('27', '1', 'Non ratione officia repellendus non unde laudantium labore.', 'Cupiditate officiis voluptas mollitia dolor ipsum magni. Accusantium numquam facere est laudantium ut vero et. Magnam suscipit blanditiis harum iste. Impedit enim quia voluptates blanditiis.', '1', '2015-12-02', '2015-12-26', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('28', '2', 'Est officiis voluptas sit inventore reiciendis.', 'Perspiciatis dicta accusantium sed id et minus. Sit soluta praesentium optio accusamus. Ipsum officiis ipsam molestiae et.', '9', '2015-12-10', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('29', '3', 'Delectus tempora nostrum delectus voluptas aut.', 'Laboriosam sed quibusdam aliquam accusantium ut nam. Et quia nisi quo aut dolorem nostrum. Vero nostrum est sunt autem incidunt illo. Suscipit commodi inventore enim quibusdam adipisci eum ea.', '3', '2015-12-22', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('30', '3', 'Consequatur quaerat eligendi voluptatem aut.', 'Quia voluptatem officiis veritatis et velit accusamus. Laboriosam velit eum veniam alias mollitia et sunt est. Sunt soluta quia velit quam.', '4', '2015-12-26', '2015-12-27', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('31', '2', 'Nemo et enim blanditiis nulla voluptatem.', 'Sunt reiciendis vero eos vitae. Dolor voluptatibus nemo sed dolores adipisci nesciunt qui nihil.', '2', '2015-12-28', '2015-12-29', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('32', '2', 'Aspernatur ut asperiores libero adipisci.', 'Voluptas nam quia autem maxime. Id doloremque totam eos.', '7', '2015-12-11', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('33', '2', 'Et nulla aut magnam exercitationem.', 'Ducimus eos dolor cum odit. Nam odit rerum eos rerum repudiandae voluptas. Reiciendis et veniam optio amet et. Sint blanditiis adipisci ad in corporis.', '7', '2015-12-17', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('34', '3', 'Temporibus explicabo libero doloremque officia quia quas illo vitae.', 'Rem optio nobis harum accusantium quas. Et commodi facere nobis atque est. Dolorum totam iste maiores tempore praesentium aut.', '5', '2015-12-18', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('35', '3', 'Illum asperiores quibusdam consequatur.', 'Ab consequatur et pariatur minima repellendus aliquid ut. Incidunt voluptatem maxime autem incidunt recusandae totam. Aut exercitationem sed aut aut.', '2', '2015-12-11', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('36', '2', 'Reiciendis corporis et eos aut totam et velit.', 'Rem aperiam itaque nulla est ipsum. Sed voluptatem modi inventore accusantium unde nam. Consequatur voluptatem dolore perferendis nemo.', '4', '2015-12-07', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('37', '2', 'Aut rerum iusto eos consectetur voluptas deserunt.', 'Quos optio laudantium magnam rerum cumque. Voluptatem doloremque dolor voluptas accusamus. Voluptatem molestias esse cum est. Vel accusamus laboriosam sed libero nostrum.', '8', '2015-12-09', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('38', '2', 'Aut eum sint rem sed autem.', 'Molestiae unde eius recusandae id ad. Sequi corrupti corporis dolor quam corporis commodi quibusdam. Magnam quod nobis et nisi.', '5', '2015-12-07', '2015-12-07', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('39', '1', 'Distinctio voluptatum et magnam est eveniet.', 'Repellat quisquam cupiditate vel commodi est ipsum aut. A impedit veritatis dolor ipsam. Nesciunt voluptas expedita eaque similique sequi enim et. Ut ad aliquid harum sint nihil nulla inventore.', '5', '2015-12-14', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('40', '1', 'Adipisci saepe fuga quam omnis maiores.', 'Debitis est ea et cumque tempore saepe. Rerum et laudantium dignissimos deserunt quos. Asperiores deleniti consectetur dicta voluptatem est illum perferendis. Est autem eum consequatur soluta nam.', '3', '2015-12-28', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('41', '1', 'Nesciunt laborum nobis ut.', 'Sed eaque qui quisquam est incidunt atque. Explicabo tempore quod minus sapiente consequuntur aut quos. Aut nihil sapiente et minima quam. Sequi consequatur sunt cupiditate nihil molestias.', '8', '2015-12-26', '2015-12-28', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('42', '3', 'Ea consectetur numquam quisquam qui aut.', 'Mollitia vitae nesciunt magni. Voluptate recusandae consequatur voluptatem autem. Corrupti dolores repellat similique mollitia. Molestiae omnis voluptatem ex qui sed saepe voluptas facere.', '4', '2015-12-25', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('43', '2', 'Assumenda qui nemo dolores earum minus.', 'Rerum similique in architecto rerum molestiae sed veritatis accusamus. Quisquam dolore aliquid et eum nesciunt odio.', '2', '2015-12-25', '2015-12-27', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('44', '1', 'Est optio sit sit non est ea enim.', 'Quae aut similique veritatis qui pariatur laborum tenetur. Velit odio neque impedit magni. Qui consectetur soluta nostrum ut. Sed magni optio voluptatem voluptas velit.', '8', '2015-12-03', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('45', '3', 'Vitae eos et est ullam.', 'Non hic quos maxime similique beatae id alias. Quaerat voluptatibus qui voluptas fugit. Ex quae aut non officiis laborum fugiat amet. Repellat asperiores sint rerum ipsum aut consequuntur id.', '2', '2015-12-19', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('46', '3', 'Minima repellat sed iusto.', 'Eos in exercitationem ipsum dignissimos. Soluta porro et veritatis praesentium occaecati. Consequatur magni ullam eligendi nobis.', '2', '2015-12-02', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('47', '2', 'Debitis quia cum similique est veniam.', 'Consequuntur inventore perferendis quia sit. Modi maiores delectus ea voluptatem commodi nobis qui. Molestiae esse reprehenderit voluptatem dolore nam eum.', '3', '2015-12-17', '2015-12-27', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('48', '1', 'Et quam quidem dolorum ducimus ut.', 'Distinctio dolorum maiores non sit. Numquam tempora quae alias. Est nihil qui et sed iste cum dicta.', '2', '2015-12-26', '2015-12-31', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('49', '2', 'Quo fugit iusto vitae quis praesentium dignissimos libero maiores.', 'In sed eos dolores. Est veritatis blanditiis labore omnis temporibus facere assumenda. Quas eveniet reiciendis minima dolor consectetur ut ut. Perspiciatis atque eveniet sed quam earum qui quo.', '5', '2015-12-20', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('50', '1', 'Sed ipsa ullam et velit distinctio ipsa vero quia.', 'Nobis blanditiis dolor eum est doloribus. Natus voluptatum repellendus in possimus cumque molestias.', '1', '2015-12-25', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('51', '3', 'Dolorem fugiat dolores quidem provident consequuntur.', 'Accusantium vel recusandae sapiente maxime enim officiis. Est consectetur amet sunt. Consequatur iure vero omnis enim aut commodi vero.', '2', '2015-12-08', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('52', '3', 'Doloribus consequatur et aspernatur.', 'Explicabo earum sed et debitis architecto eius magni. Atque dignissimos magni et est.', '8', '2015-12-05', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('53', '2', 'Eligendi asperiores dicta possimus sapiente quae.', 'Ut animi hic molestiae at est sit quia. Officia inventore magni et quam alias. Quae non aliquam alias temporibus quos adipisci.', '8', '2015-12-20', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('54', '1', 'Ullam est deserunt est laboriosam.', 'Sed qui nihil nulla. Amet qui et alias et voluptas omnis consequuntur aut. Facere blanditiis at aut impedit molestias. Accusamus porro beatae dolorem quis placeat sint fuga.', '5', '2015-12-20', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('55', '2', 'Ratione dolorem perferendis et sit pariatur quidem qui nesciunt.', 'Ut qui vero quas. Qui non ipsam aut error et. Consequatur consequatur aperiam odit quas enim.', '6', '2015-12-28', '2015-12-29', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('56', '1', 'Quis molestiae assumenda similique et delectus ea ratione.', 'Nisi doloremque qui deleniti consequuntur. Laborum adipisci repudiandae culpa inventore. Et facere accusamus in eaque iusto architecto. Laudantium occaecati provident laboriosam aperiam fugiat dolores nesciunt dignissimos.', '4', '2015-12-16', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('57', '2', 'Totam iste inventore quae minus.', 'Adipisci commodi est veritatis quibusdam. Beatae quaerat veniam voluptatem necessitatibus. Voluptatibus qui repudiandae dolor aut vitae consequatur magni laborum. Ut molestiae ut neque earum esse reprehenderit.', '2', '2015-12-24', '2015-12-31', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('58', '3', 'Qui cumque vel laudantium officia.', 'Voluptatem ducimus excepturi et veritatis. Illum tempora quae autem sit quas. Nesciunt nihil porro ut et accusamus velit. Eligendi natus deserunt porro eaque dolorum quam consequatur maiores.', '9', '2015-12-24', '2015-12-29', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('59', '3', 'Animi rerum impedit voluptas quia exercitationem assumenda omnis cumque.', 'Numquam ut aliquid laborum omnis dolorem debitis. Quasi reiciendis soluta iure non cumque dolore. Quae quas sunt expedita optio sunt ut. Aut ducimus aspernatur velit laudantium fuga dolor voluptas at.', '1', '2015-12-23', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('60', '3', 'Eos qui rerum voluptatum ratione commodi repudiandae qui.', 'Dolorem ut odit molestiae sequi dolor. Provident unde fuga excepturi voluptatibus molestias deserunt magnam. Qui non accusamus ut modi aut rerum.', '8', '2015-12-14', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('61', '2', 'Possimus impedit omnis non reprehenderit dolorem.', 'Tempora quasi architecto quia sed et harum. Id sit sapiente deleniti optio. Porro ipsa ad quidem sunt harum.', '7', '2015-12-22', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('62', '1', 'Aut ea fugit adipisci voluptas eaque vitae soluta.', 'Nihil rem omnis ut id ea nostrum. Deleniti maxime corrupti sed minus aut molestiae accusantium. Dignissimos libero quis aut vel.', '9', '2015-12-12', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('63', '1', 'Voluptatibus occaecati eum doloribus accusamus ipsa voluptatem.', 'Incidunt quos aperiam voluptatem dolorem nisi. Ipsa rerum nihil maxime quod corrupti non. Minus autem reprehenderit vel id veniam. Provident doloremque maiores aliquam incidunt et.', '7', '2015-12-25', '2015-12-26', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('64', '3', 'Omnis veniam impedit provident in dolores aut ut.', 'Velit sed neque possimus enim et. Voluptatem modi dolores accusamus quia. Voluptatem in cumque aut sed nihil minus. Tempore qui harum doloremque cum.', '6', '2015-12-17', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('65', '2', 'Eligendi occaecati cumque sed consequuntur ut sed.', 'Tempora praesentium vel quaerat at. Dolorem fugiat tempore explicabo corrupti vel esse doloribus. Reiciendis est deserunt sit veritatis minus.', '1', '2015-12-05', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('66', '2', 'Vel quasi quo molestiae.', 'Possimus vel rem deleniti omnis. Provident ex cupiditate ipsum est aliquid alias id. Enim voluptates repudiandae asperiores cupiditate sit consequuntur. Numquam impedit odit veritatis omnis hic.', '3', '2015-12-30', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('67', '2', 'Consequatur quidem dicta omnis inventore necessitatibus et.', 'Atque ipsum molestiae sunt eveniet exercitationem eum. Et aut saepe veniam minus dolores. Corrupti quo doloremque temporibus dolorem dignissimos voluptatibus odit. Perspiciatis sunt cumque sed ad tenetur.', '3', '2015-12-07', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('68', '2', 'Aut deleniti laboriosam ipsam qui.', 'Repellat vitae rerum ipsam labore adipisci et. Eum architecto dolorum occaecati est totam. Enim voluptates quo aut assumenda. Eius exercitationem vel quod voluptates odit autem sunt. Voluptas animi eum ut iure est aut quia.', '9', '2015-12-06', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('69', '2', 'Similique dolorum iure quisquam est ut ut quibusdam.', 'Placeat est et sequi aliquam. Consequatur rem veniam molestias. Ipsum et minima laborum fugit excepturi.', '8', '2015-12-02', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('70', '2', 'Voluptas voluptatem vitae id dolores.', 'Adipisci et debitis enim est omnis. Est ea quidem aliquid tenetur. Quia accusantium qui ad omnis excepturi. Ea natus distinctio dolores libero rerum.', '8', '2015-12-08', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('71', '2', 'Eos dignissimos ut molestiae quia dolorum qui.', 'Qui ut et est voluptates ut error. Sed dolores error voluptatum voluptatem sunt quidem nihil in. Veritatis soluta modi pariatur autem rem. Esse vel facilis adipisci.', '6', '2015-12-22', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('72', '1', 'Exercitationem quia expedita suscipit consequatur recusandae aut quisquam sapiente.', 'Iusto dignissimos animi modi velit saepe. Ea ducimus quos impedit quas quis. Tempora voluptas laudantium est omnis itaque eveniet.', '1', '2015-12-06', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('73', '3', 'Deleniti quia harum recusandae adipisci eos.', 'Vero ab quod doloremque. Dolor nulla fugit autem consequatur inventore est. Neque et quis doloremque consequuntur. Unde quasi sint consequuntur libero. Magni at repudiandae rerum totam asperiores voluptatem velit cupiditate.', '4', '2015-12-17', '2015-12-27', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('74', '3', 'Voluptatem assumenda ut qui.', 'Cum error porro accusantium aliquid voluptatem temporibus eligendi. Qui et distinctio ducimus nostrum magni et vero ab. Earum est esse rerum. Ut ut qui omnis.', '6', '2015-12-17', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('75', '2', 'Eius consequatur aut itaque voluptatem in totam velit.', 'Excepturi enim sequi nemo quasi a facilis sunt accusamus. Totam rerum vel et nemo ratione tempora. Esse quo quisquam aliquid nobis enim modi eligendi doloribus.', '9', '2015-12-09', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('76', '3', 'Neque est est ea unde qui assumenda ut.', 'Nobis consequatur voluptatem qui praesentium. Ut sit adipisci vel sit deserunt magnam. Ab optio sint voluptas quod et sunt animi. Ducimus molestiae autem ipsam similique voluptatem sint quam.', '7', '2015-12-11', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('77', '2', 'Et laudantium eaque ut.', 'Impedit deleniti dolor perferendis aut. Nulla natus accusantium saepe et qui ut aliquid. Qui minima enim eum praesentium nemo qui.', '9', '2015-12-26', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('78', '2', 'Soluta omnis quaerat velit.', 'Occaecati molestiae quia deleniti non. Dolore et aut nobis nam. Maiores aperiam corrupti et harum quisquam.', '4', '2015-12-07', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('79', '1', 'Corporis sunt rerum cum enim aut rerum.', 'Autem laboriosam libero ipsum. Amet laborum qui delectus quaerat ut non suscipit. Asperiores eos autem eos. Pariatur quae aperiam et omnis repudiandae. Similique similique est ut architecto vero tempora.', '8', '2015-12-10', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('80', '3', 'Dicta harum quaerat sunt sed.', 'Ut recusandae exercitationem veritatis autem mollitia nemo. Maxime eius ut deserunt cumque at rem sed. Nostrum dolorum fugiat minima aperiam rerum sit dolor minus.', '5', '2015-12-25', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('81', '1', 'Nesciunt magnam laborum officiis quasi eaque molestiae.', 'Libero minus eaque repellendus ea et veritatis sed. Dolores explicabo rerum delectus recusandae. Maxime recusandae reprehenderit odio quia. Omnis et nihil molestiae dignissimos qui.', '1', '2015-12-14', '2015-12-27', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('82', '1', 'Rerum ex sit recusandae praesentium quidem nemo.', 'Molestiae tempora molestias qui praesentium aperiam quaerat quis. Ut tempore eius rem odit nihil nisi.', '3', '2015-12-15', '2015-12-30', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('83', '2', 'Dolor magnam voluptatum consequatur rerum.', 'Corporis perspiciatis expedita et voluptatem. Quis velit id consequatur sint molestiae ex. Eum quam veniam nesciunt et. Debitis veniam asperiores id consequuntur accusamus.', '9', '2015-12-02', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('84', '3', 'Rerum laudantium et animi est earum consectetur placeat.', 'Alias voluptatibus quisquam et et doloremque. Sed soluta ex praesentium accusamus ad et. Et quas id dolorem aut aut expedita illo non. Dolorum fuga excepturi cum praesentium.', '5', '2015-12-26', '2015-12-31', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('85', '1', 'Expedita blanditiis qui omnis.', 'Totam qui in quae natus. Ad quasi quos inventore. Temporibus et soluta quos expedita qui perferendis.', '5', '2015-12-12', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('86', '3', 'Eaque et enim molestias minus.', 'Rerum nihil incidunt alias labore minus nemo sunt. Adipisci expedita qui quo perferendis est. Quisquam voluptatem quasi explicabo similique id.', '7', '2015-12-20', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('87', '1', 'Necessitatibus voluptatem eum eos dolorem.', 'Facere voluptatem quo consequatur maxime. Facilis perferendis aut quidem atque fugiat autem beatae. Voluptatum et omnis sint enim quae ut. Quidem molestiae molestiae maxime maxime autem rerum quia ea.', '6', '2015-12-03', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('88', '1', 'Non reprehenderit nam nihil.', 'Eos dolorum reiciendis tempora minima suscipit neque et. Qui vero delectus enim.', '8', '2015-12-15', '2015-12-25', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('89', '1', 'Vel maxime nam dolorem et nulla qui beatae ipsa.', 'Voluptatum repellat error maxime cumque eum iusto. Et beatae fugiat atque rerum qui exercitationem.', '1', '2015-12-18', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('90', '2', 'In dolor rem consectetur occaecati sit et beatae dolorem.', 'Possimus rerum adipisci earum velit suscipit natus. Tempore est est consequatur eos accusantium voluptate. Tempora eius et ratione.', '7', '2015-12-02', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('91', '2', 'Pariatur dolor corporis aperiam aut.', 'Ut illum omnis accusantium commodi excepturi eveniet. Odio amet mollitia nulla rem aut alias autem ipsum. Nihil omnis quod et assumenda et. Deleniti quae non labore.', '7', '2015-12-14', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('92', '1', 'Alias odio autem deleniti harum ut aspernatur.', 'Et mollitia quo quia et. Molestiae fugiat voluptatem mollitia in atque. Libero at cupiditate incidunt voluptas accusantium. Dolorem placeat vel repellat voluptatum.', '7', '2015-12-12', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('93', '2', 'Quia sequi nulla modi itaque.', 'Molestiae neque possimus dolorem nulla. Et minus reiciendis voluptatem ab quibusdam facere aut qui. Eligendi velit fugiat eos est et ut reiciendis aut. Debitis amet quae quibusdam suscipit ex. Labore natus saepe sed.', '2', '2015-12-07', '2015-12-24', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('94', '3', 'Natus voluptas suscipit delectus aut odio.', 'Nobis dolor rerum hic aut ut. Mollitia debitis omnis quasi nobis. Deserunt dolores qui accusamus eligendi nulla cupiditate eos. Enim sunt voluptatum sunt ea adipisci optio.', '9', '2015-12-24', '2015-12-28', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('95', '1', 'Eaque velit omnis qui.', 'Sit praesentium iure libero architecto. Esse velit nulla laboriosam nesciunt. Minima non minus ullam voluptatem. Sunt eligendi qui voluptates in.', '8', '2015-12-18', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('96', '3', 'Nulla rerum laboriosam ab vel.', 'Facere dolore veniam fugit. Et quos iusto nostrum asperiores nihil exercitationem similique. Iste voluptatum unde cum vel. Harum exercitationem est iure eum repudiandae. Assumenda ut saepe consequuntur.', '2', '2015-12-24', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('97', '3', 'Eum tenetur ut consequatur occaecati accusamus aut minima.', 'Amet assumenda blanditiis voluptatem voluptas ullam. Vitae tempore cupiditate consequuntur quos eos quod. Culpa quia reprehenderit ad aut modi.', '7', '2015-12-10', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('98', '3', 'Perferendis placeat laborum quaerat cum est unde facilis.', 'Modi libero qui totam repudiandae nihil quidem. Nihil et culpa ut laborum. Dolore nihil ut nisi sunt perspiciatis.', '6', '2015-12-14', '2015-12-15', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('99', '3', 'Et et rerum cum quia.', 'Pariatur quae libero velit. Doloribus voluptas dolorem voluptatem et at ut consequatur. Aliquam ut alias et nihil aut. Quae vero consequatur facilis hic et sit.', '5', '2015-12-10', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('100', '2', 'Ut at voluptatem distinctio inventore.', 'Sed reprehenderit totam ab minus consequuntur qui autem quas. Nobis itaque illum reiciendis eos. Sapiente atque corporis sequi voluptatem sed at dignissimos. Totam ut illo sapiente quia cumque vel.', '5', '2015-12-31', null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `file_folder`
-- ----------------------------
BEGIN;
INSERT INTO `file_folder` VALUES ('49', '49', '229', '2015-12-09 00:15:18', '2015-12-09 00:15:18'), ('50', '50', '225', '2015-12-09 00:15:19', '2015-12-09 00:15:19'), ('51', '51', '225', '2015-12-09 00:15:19', '2015-12-09 00:15:19'), ('52', '52', '225', '2015-12-09 00:15:20', '2015-12-09 00:15:20'), ('53', '53', '225', '2015-12-09 00:15:20', '2015-12-09 00:15:20'), ('54', '54', '221', '2015-12-09 20:56:34', '2015-12-09 20:56:34'), ('55', '55', '221', '2015-12-09 20:56:35', '2015-12-09 20:56:35'), ('56', '56', '221', '2015-12-09 20:56:35', '2015-12-09 20:56:35'), ('57', '57', '221', '2015-12-09 20:56:35', '2015-12-09 20:56:35'), ('58', '58', '221', '2015-12-09 20:56:36', '2015-12-09 20:56:36'), ('59', '59', '234', '2015-12-09 23:27:12', '2015-12-09 23:27:12'), ('60', '60', '234', '2015-12-09 23:27:13', '2015-12-09 23:27:13'), ('61', '61', '234', '2015-12-09 23:27:13', '2015-12-09 23:27:13'), ('62', '62', '234', '2015-12-09 23:27:13', '2015-12-09 23:27:13'), ('63', '63', '234', '2015-12-09 23:27:13', '2015-12-09 23:27:13'), ('64', '64', '221', '2015-12-10 00:04:23', '2015-12-10 00:04:23'), ('65', '65', '221', '2015-12-10 00:04:23', '2015-12-10 00:04:23'), ('66', '66', '221', '2015-12-10 00:04:23', '2015-12-10 00:04:23'), ('67', '72', '221', '2015-12-10 00:13:06', '2015-12-10 00:13:06'), ('69', '81', '221', '2015-12-10 17:59:49', '2015-12-10 17:59:49'), ('72', '84', '221', '2015-12-10 18:03:19', '2015-12-10 18:03:19');
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
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folder_ids`
-- ----------------------------
BEGIN;
INSERT INTO `folder_ids` VALUES ('1', '20', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', '21', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('3', '1', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('4', '2', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('5', '3', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('6', '4', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('7', '5', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('8', '6', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('9', '7', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('10', '8', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('11', '9', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('12', '10', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('13', '11', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('14', '12', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('15', '13', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('16', '14', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('17', '15', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('18', '16', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('19', '17', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('20', '18', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('21', '19', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('22', '20', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('23', '21', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('24', '22', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('25', '23', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('26', '24', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('27', '25', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('28', '26', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('29', '27', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('30', '28', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('31', '29', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('32', '30', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('33', '31', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('34', '32', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('35', '33', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('36', '34', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('37', '35', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('38', '36', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('39', '37', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('40', '38', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('41', '39', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('42', '40', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('43', '41', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('44', '42', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('45', '43', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('46', '44', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('47', '45', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('48', '46', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('49', '47', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('50', '48', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('51', '49', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('52', '50', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('53', '51', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('54', '52', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('55', '22', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('56', '53', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('57', '54', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('58', '55', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('59', '56', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('60', '57', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('61', '58', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('62', '59', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('63', '60', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('64', '61', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('65', '62', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('66', '63', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('67', '64', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('68', '65', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('69', '66', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('70', '67', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('71', '68', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('72', '69', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('73', '70', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('74', '71', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('75', '72', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('76', '73', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('77', '74', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('78', '75', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('79', '76', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('80', '77', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('81', '78', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('82', '79', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('83', '80', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('84', '81', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('85', '82', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('86', '83', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('87', '84', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('88', '85', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('89', '86', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('90', '87', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('91', '88', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('92', '89', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('93', '90', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('94', '91', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('95', '92', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('96', '93', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('97', '94', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('98', '95', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('99', '96', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('100', '97', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('101', '98', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('102', '99', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('103', '100', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('104', '101', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('105', '102', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('106', '103', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('107', '104', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('108', '23', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('109', '24', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('110', '25', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('111', '26', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('112', '105', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('113', '106', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('114', '107', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('115', '108', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('116', '109', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('117', '110', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('118', '111', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('119', '112', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('120', '113', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('121', '114', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('122', '115', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('123', '116', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('124', '117', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('125', '118', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('126', '119', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('127', '120', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('128', '121', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('129', '122', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('130', '123', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('131', '124', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('132', '125', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('133', '126', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('134', '127', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('135', '128', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('136', '129', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('137', '130', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('138', '131', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('139', '132', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('140', '133', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('141', '134', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('142', '135', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('143', '136', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('144', '137', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('145', '138', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('146', '139', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('147', '140', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('148', '141', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('149', '142', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('150', '143', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('151', '144', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('152', '145', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('153', '146', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('154', '147', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('155', '148', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('156', '149', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('157', '150', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('158', '151', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('159', '152', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('160', '153', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('161', '154', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('162', '155', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('163', '156', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('164', '27', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('165', '28', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('166', '29', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('167', '157', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('168', '158', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('169', '159', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('170', '160', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('171', '161', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('172', '162', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('173', '163', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('174', '164', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('175', '165', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('176', '166', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('177', '167', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('178', '168', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('179', '169', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('180', '170', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('181', '171', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('182', '172', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('183', '173', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('184', '174', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('185', '175', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('186', '176', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('187', '177', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('188', '178', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('189', '179', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('190', '180', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('191', '181', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('192', '182', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('193', '183', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('194', '184', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('195', '185', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('196', '186', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('197', '187', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('198', '188', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('199', '189', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('200', '190', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('201', '191', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('202', '192', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('203', '193', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('204', '194', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('205', '195', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('206', '196', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('207', '197', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('208', '198', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('209', '199', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('210', '200', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('211', '201', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('212', '202', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('213', '203', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('214', '204', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('215', '205', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('216', '206', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('217', '207', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('218', '208', 'week', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('219', '30', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('220', '31', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('221', '32', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('222', '33', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('223', '34', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('224', '35', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('225', '36', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('226', '37', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('227', '38', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('228', '39', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('229', '40', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('230', '41', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('231', '42', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('232', '43', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('233', '44', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('234', '45', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('235', '46', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('236', '47', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('237', '48', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('238', '49', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('239', '50', 'folder', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folder_struct`
-- ----------------------------
BEGIN;
INSERT INTO `folder_struct` VALUES ('17', '33', '34', '2015-12-08 23:51:36', '2015-12-08 23:51:36'), ('18', '33', '35', '2015-12-08 23:51:42', '2015-12-08 23:51:42'), ('19', '33', '36', '2015-12-08 23:51:55', '2015-12-08 23:51:55'), ('20', '33', '37', '2015-12-08 23:51:55', '2015-12-08 23:51:55'), ('21', '33', '38', '2015-12-08 23:51:55', '2015-12-08 23:51:55'), ('22', '33', '39', '2015-12-08 23:51:55', '2015-12-08 23:51:55'), ('23', '36', '40', '2015-12-09 21:15:49', '2015-12-09 21:15:49'), ('24', '40', '41', '2015-12-09 23:24:29', '2015-12-09 23:24:29'), ('25', '41', '42', '2015-12-09 23:24:36', '2015-12-09 23:24:36'), ('26', '42', '43', '2015-12-09 23:24:58', '2015-12-09 23:24:58'), ('27', '43', '44', '2015-12-09 23:25:03', '2015-12-09 23:25:03'), ('28', '44', '45', '2015-12-09 23:25:08', '2015-12-09 23:25:08'), ('29', '42', '46', '2015-12-09 23:33:40', '2015-12-09 23:33:40'), ('30', '42', '47', '2015-12-09 23:33:40', '2015-12-09 23:33:40'), ('31', '42', '48', '2015-12-09 23:33:40', '2015-12-09 23:33:40'), ('32', '42', '49', '2015-12-09 23:33:40', '2015-12-09 23:33:40'), ('33', '42', '50', '2015-12-09 23:33:40', '2015-12-09 23:33:40');
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
  PRIMARY KEY (`id`),
  KEY `folders_banner_id_foreign` (`banner_id`),
  CONSTRAINT `folders_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `folders`
-- ----------------------------
BEGIN;
INSERT INTO `folders` VALUES ('30', 'sdfaasdf', '2015-12-08 23:51:18', '2015-12-08 23:51:18', '0', '0', '0', '0', '1'), ('31', 'sfdafdafasd', '2015-12-08 23:51:25', '2015-12-08 23:51:25', '0', '0', '0', '0', '1'), ('32', 'something I can test', '2015-12-08 23:51:29', '2015-12-09 20:56:11', '0', '0', '0', '0', '1'), ('33', 'click me', '2015-12-08 23:51:31', '2015-12-09 00:15:43', '1', '0', '0', '0', '1'), ('34', 'sdfdfssdf', '2015-12-08 23:51:36', '2015-12-08 23:51:36', '0', '1', '0', '0', '1'), ('35', 'fsdfdsfdsfsdf', '2015-12-08 23:51:42', '2015-12-08 23:51:42', '0', '1', '0', '0', '1'), ('36', 'then click me', '2015-12-08 23:51:55', '2015-12-09 21:15:49', '1', '1', '0', '0', '1'), ('37', 'dsfsdfdsf', '2015-12-08 23:51:55', '2015-12-08 23:51:55', '0', '1', '0', '0', '1'), ('38', 'sdfdsf', '2015-12-08 23:51:55', '2015-12-08 23:51:55', '0', '1', '0', '0', '1'), ('39', 'faaffafaf', '2015-12-08 23:51:55', '2015-12-08 23:51:55', '0', '1', '0', '0', '1'), ('40', 'level3', '2015-12-09 21:15:49', '2015-12-09 23:24:29', '1', '1', '0', '0', '1'), ('41', 'another level', '2015-12-09 23:24:29', '2015-12-09 23:24:36', '1', '1', '0', '0', '1'), ('42', 'deep', '2015-12-09 23:24:36', '2015-12-09 23:24:58', '1', '1', '0', '0', '1'), ('43', 'sdfsdf', '2015-12-09 23:24:58', '2015-12-09 23:25:03', '1', '1', '0', '0', '1'), ('44', 'fsfs', '2015-12-09 23:25:02', '2015-12-09 23:25:08', '1', '1', '0', '0', '1'), ('45', 'cvbdfbdfbfdbfddfs', '2015-12-09 23:25:08', '2015-12-09 23:25:24', '0', '1', '0', '0', '1'), ('46', 'qfdqdfa', '2015-12-09 23:33:40', '2015-12-09 23:33:40', '0', '1', '0', '0', '1'), ('47', 'adffa', '2015-12-09 23:33:40', '2015-12-09 23:33:40', '0', '1', '0', '0', '1'), ('48', 'fa', '2015-12-09 23:33:40', '2015-12-09 23:33:40', '0', '1', '0', '0', '1'), ('49', 'af', '2015-12-09 23:33:40', '2015-12-09 23:33:40', '0', '1', '0', '0', '1'), ('50', 'th', '2015-12-09 23:33:40', '2015-12-09 23:33:40', '0', '1', '0', '0', '1');
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1'), ('2014_10_12_100000_create_password_resets_table', '1'), ('2015_08_05_203218_create_positions_table', '1'), ('2015_08_05_203634_create_activities_table', '1'), ('2015_08_05_210403_create_activity_levels_table', '1'), ('2015_08_05_210432_create_moves_table', '1'), ('2015_08_05_210456_create_career_paths_table', '1'), ('2015_08_05_210613_create_profiles_table', '1'), ('2015_08_05_211633_create_profile_activities_table', '1'), ('2015_08_05_211709_create_profile_history_table', '1'), ('2015_08_18_222608_create_subscription_groups_table', '1'), ('2015_08_19_172505_create_profile_subscriptions_table', '1'), ('2015_08_21_151222_create_education_level_table', '1'), ('2015_08_21_151326_create_profile_education_table', '1'), ('2015_09_02_150403_documents', '1'), ('2015_09_02_165002_create_document_package_table', '1'), ('2015_09_02_165003_create_document_package_items_table', '2'), ('2015_09_03_165000_create_hoods_table', '2'), ('2015_09_03_165001_create_hood_posts_table', '2'), ('2015_09_03_165002_create_hood_members_table', '2'), ('2015_09_03_165003_create_hood_post_repsonses_table', '2'), ('2015_09_09_201308_create_media_types', '2'), ('2015_09_09_205316_create_roles_table', '2'), ('2015_09_09_205512_create_position_roles_table', '2'), ('2015_09_16_150414_folders', '2'), ('2015_09_16_150425_folder_struct', '2'), ('2015_09_16_150438_file_folder', '2'), ('2015_09_28_215143_create-fiscal-year-table', '2'), ('2015_09_28_215144_create-weeks-table', '2'), ('2015_09_30_213442_create-banners-table', '2'), ('2015_09_30_215422_update-folders-table', '2'), ('2015_10_27_145632_update_documents_table', '2'), ('2015_10_28_173427_create_folder_ids_table', '2'), ('2015_11_27_172830_create_package_table', '3'), ('2015_11_27_175201_create_document_package_pivot_table', '3'), ('2015_11_30_210139_create_event_types_table', '3'), ('2015_12_02_230415_update_packages_table', '3'), ('2015_12_03_214110_create_communication_importance_table', '4'), ('2015_12_03_214558_create_communications_table', '4'), ('2015_12_04_222108_create_communication_package_pivot_table', '5'), ('2015_12_04_222116_create_communication_document_pivot_table', '5'), ('2015_12_07_234421_create_tags_table', '6'), ('2015_11_30_222337_create_events_table', '7');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `activation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `approval_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `weeks`
-- ----------------------------
BEGIN;
INSERT INTO `weeks` VALUES ('1', '1', '2015-02-02', '2015-02-08', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('2', '2', '2015-02-09', '2015-02-15', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('3', '3', '2015-02-16', '2015-02-22', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('4', '4', '2015-02-23', '2015-03-01', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('5', '5', '2015-03-02', '2015-03-08', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('6', '6', '2015-03-09', '2015-03-15', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('7', '7', '2015-03-16', '2015-03-22', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('8', '8', '2015-03-23', '2015-03-29', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('9', '9', '2015-03-30', '2015-04-05', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('10', '10', '2015-04-06', '2015-04-12', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('11', '11', '2015-04-13', '2015-04-19', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('12', '12', '2015-04-20', '2015-04-26', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('13', '13', '2015-04-27', '2015-05-03', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('14', '14', '2015-05-04', '2015-05-10', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('15', '15', '2015-05-11', '2015-05-17', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('16', '16', '2015-05-18', '2015-05-24', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('17', '17', '2015-05-25', '2015-05-31', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('18', '18', '2015-06-01', '2015-06-07', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('19', '19', '2015-06-08', '2015-06-14', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('20', '20', '2015-06-15', '2015-06-21', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('21', '21', '2015-06-22', '2015-06-28', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('22', '22', '2015-06-29', '2015-07-05', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('23', '23', '2015-07-06', '2015-07-12', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('24', '24', '2015-07-13', '2015-07-19', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('25', '25', '2015-07-20', '2015-07-26', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('26', '26', '2015-07-27', '2015-08-02', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('27', '27', '2015-08-03', '2015-08-09', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('28', '28', '2015-08-10', '2015-08-16', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('29', '29', '2015-08-17', '2015-08-23', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('30', '30', '2015-08-24', '2015-08-30', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('31', '31', '2015-08-31', '2015-09-06', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('32', '32', '2015-09-07', '2015-09-13', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('33', '33', '2015-09-14', '2015-09-20', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('34', '34', '2015-09-21', '2015-09-27', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('35', '35', '2015-09-28', '2015-10-04', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('36', '36', '2015-10-05', '2015-10-11', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('37', '37', '2015-10-12', '2015-10-18', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('38', '38', '2015-10-19', '2015-10-25', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('39', '39', '2015-10-26', '2015-11-01', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('40', '40', '2015-11-02', '2015-11-08', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('41', '41', '2015-11-09', '2015-11-15', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('42', '42', '2015-11-16', '2015-11-22', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('43', '43', '2015-11-23', '2015-11-29', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('44', '44', '2015-11-30', '2015-12-06', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('45', '45', '2015-12-07', '2015-12-13', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('46', '46', '2015-12-14', '2015-12-20', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('47', '47', '2015-12-21', '2015-12-27', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('48', '48', '2015-12-28', '2016-01-03', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('49', '49', '2016-01-04', '2016-01-10', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('50', '50', '2016-01-11', '2016-01-17', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('51', '51', '2016-01-18', '2016-01-24', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('52', '52', '2016-01-25', '2016-01-31', 'FY16', '1', '2015-12-01 22:20:03', '2015-12-01 22:20:03'), ('53', '1', '2015-02-02', '2015-02-08', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('54', '2', '2015-02-09', '2015-02-15', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('55', '3', '2015-02-16', '2015-02-22', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('56', '4', '2015-02-23', '2015-03-01', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('57', '5', '2015-03-02', '2015-03-08', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('58', '6', '2015-03-09', '2015-03-15', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('59', '7', '2015-03-16', '2015-03-22', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('60', '8', '2015-03-23', '2015-03-29', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('61', '9', '2015-03-30', '2015-04-05', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('62', '10', '2015-04-06', '2015-04-12', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('63', '11', '2015-04-13', '2015-04-19', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('64', '12', '2015-04-20', '2015-04-26', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('65', '13', '2015-04-27', '2015-05-03', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('66', '14', '2015-05-04', '2015-05-10', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('67', '15', '2015-05-11', '2015-05-17', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('68', '16', '2015-05-18', '2015-05-24', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('69', '17', '2015-05-25', '2015-05-31', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('70', '18', '2015-06-01', '2015-06-07', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('71', '19', '2015-06-08', '2015-06-14', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('72', '20', '2015-06-15', '2015-06-21', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('73', '21', '2015-06-22', '2015-06-28', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('74', '22', '2015-06-29', '2015-07-05', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('75', '23', '2015-07-06', '2015-07-12', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('76', '24', '2015-07-13', '2015-07-19', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('77', '25', '2015-07-20', '2015-07-26', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('78', '26', '2015-07-27', '2015-08-02', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('79', '27', '2015-08-03', '2015-08-09', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('80', '28', '2015-08-10', '2015-08-16', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('81', '29', '2015-08-17', '2015-08-23', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('82', '30', '2015-08-24', '2015-08-30', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('83', '31', '2015-08-31', '2015-09-06', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('84', '32', '2015-09-07', '2015-09-13', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('85', '33', '2015-09-14', '2015-09-20', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('86', '34', '2015-09-21', '2015-09-27', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('87', '35', '2015-09-28', '2015-10-04', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('88', '36', '2015-10-05', '2015-10-11', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('89', '37', '2015-10-12', '2015-10-18', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('90', '38', '2015-10-19', '2015-10-25', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('91', '39', '2015-10-26', '2015-11-01', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('92', '40', '2015-11-02', '2015-11-08', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('93', '41', '2015-11-09', '2015-11-15', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('94', '42', '2015-11-16', '2015-11-22', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('95', '43', '2015-11-23', '2015-11-29', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('96', '44', '2015-11-30', '2015-12-06', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('97', '45', '2015-12-07', '2015-12-13', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('98', '46', '2015-12-14', '2015-12-20', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('99', '47', '2015-12-21', '2015-12-27', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('100', '48', '2015-12-28', '2016-01-03', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('101', '49', '2016-01-04', '2016-01-10', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('102', '50', '2016-01-11', '2016-01-17', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('103', '51', '2016-01-18', '2016-01-24', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('104', '52', '2016-01-25', '2016-01-31', 'FY16', '55', '2015-12-01 22:20:15', '2015-12-01 22:20:15'), ('105', '1', '2015-02-02', '2015-02-08', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('106', '2', '2015-02-09', '2015-02-15', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('107', '3', '2015-02-16', '2015-02-22', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('108', '4', '2015-02-23', '2015-03-01', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('109', '5', '2015-03-02', '2015-03-08', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('110', '6', '2015-03-09', '2015-03-15', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('111', '7', '2015-03-16', '2015-03-22', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('112', '8', '2015-03-23', '2015-03-29', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('113', '9', '2015-03-30', '2015-04-05', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('114', '10', '2015-04-06', '2015-04-12', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('115', '11', '2015-04-13', '2015-04-19', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('116', '12', '2015-04-20', '2015-04-26', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('117', '13', '2015-04-27', '2015-05-03', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('118', '14', '2015-05-04', '2015-05-10', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('119', '15', '2015-05-11', '2015-05-17', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('120', '16', '2015-05-18', '2015-05-24', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('121', '17', '2015-05-25', '2015-05-31', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('122', '18', '2015-06-01', '2015-06-07', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('123', '19', '2015-06-08', '2015-06-14', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('124', '20', '2015-06-15', '2015-06-21', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('125', '21', '2015-06-22', '2015-06-28', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('126', '22', '2015-06-29', '2015-07-05', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('127', '23', '2015-07-06', '2015-07-12', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('128', '24', '2015-07-13', '2015-07-19', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('129', '25', '2015-07-20', '2015-07-26', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('130', '26', '2015-07-27', '2015-08-02', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('131', '27', '2015-08-03', '2015-08-09', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('132', '28', '2015-08-10', '2015-08-16', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('133', '29', '2015-08-17', '2015-08-23', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('134', '30', '2015-08-24', '2015-08-30', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('135', '31', '2015-08-31', '2015-09-06', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('136', '32', '2015-09-07', '2015-09-13', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('137', '33', '2015-09-14', '2015-09-20', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('138', '34', '2015-09-21', '2015-09-27', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('139', '35', '2015-09-28', '2015-10-04', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('140', '36', '2015-10-05', '2015-10-11', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('141', '37', '2015-10-12', '2015-10-18', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('142', '38', '2015-10-19', '2015-10-25', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('143', '39', '2015-10-26', '2015-11-01', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('144', '40', '2015-11-02', '2015-11-08', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('145', '41', '2015-11-09', '2015-11-15', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('146', '42', '2015-11-16', '2015-11-22', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('147', '43', '2015-11-23', '2015-11-29', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('148', '44', '2015-11-30', '2015-12-06', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('149', '45', '2015-12-07', '2015-12-13', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('150', '46', '2015-12-14', '2015-12-20', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('151', '47', '2015-12-21', '2015-12-27', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('152', '48', '2015-12-28', '2016-01-03', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('153', '49', '2016-01-04', '2016-01-10', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('154', '50', '2016-01-11', '2016-01-17', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('155', '51', '2016-01-18', '2016-01-24', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('156', '52', '2016-01-25', '2016-01-31', 'FY16', '111', '2015-12-02 16:52:15', '2015-12-02 16:52:15'), ('157', '1', '2015-02-02', '2015-02-08', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('158', '2', '2015-02-09', '2015-02-15', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('159', '3', '2015-02-16', '2015-02-22', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('160', '4', '2015-02-23', '2015-03-01', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('161', '5', '2015-03-02', '2015-03-08', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('162', '6', '2015-03-09', '2015-03-15', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('163', '7', '2015-03-16', '2015-03-22', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('164', '8', '2015-03-23', '2015-03-29', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('165', '9', '2015-03-30', '2015-04-05', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('166', '10', '2015-04-06', '2015-04-12', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('167', '11', '2015-04-13', '2015-04-19', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('168', '12', '2015-04-20', '2015-04-26', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('169', '13', '2015-04-27', '2015-05-03', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('170', '14', '2015-05-04', '2015-05-10', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('171', '15', '2015-05-11', '2015-05-17', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('172', '16', '2015-05-18', '2015-05-24', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('173', '17', '2015-05-25', '2015-05-31', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('174', '18', '2015-06-01', '2015-06-07', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('175', '19', '2015-06-08', '2015-06-14', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('176', '20', '2015-06-15', '2015-06-21', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('177', '21', '2015-06-22', '2015-06-28', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('178', '22', '2015-06-29', '2015-07-05', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('179', '23', '2015-07-06', '2015-07-12', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('180', '24', '2015-07-13', '2015-07-19', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('181', '25', '2015-07-20', '2015-07-26', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('182', '26', '2015-07-27', '2015-08-02', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('183', '27', '2015-08-03', '2015-08-09', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('184', '28', '2015-08-10', '2015-08-16', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('185', '29', '2015-08-17', '2015-08-23', 'FY16', '166', '2015-12-02 16:54:23', '2015-12-02 16:54:23'), ('186', '30', '2015-08-24', '2015-08-30', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('187', '31', '2015-08-31', '2015-09-06', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('188', '32', '2015-09-07', '2015-09-13', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('189', '33', '2015-09-14', '2015-09-20', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('190', '34', '2015-09-21', '2015-09-27', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('191', '35', '2015-09-28', '2015-10-04', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('192', '36', '2015-10-05', '2015-10-11', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('193', '37', '2015-10-12', '2015-10-18', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('194', '38', '2015-10-19', '2015-10-25', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('195', '39', '2015-10-26', '2015-11-01', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('196', '40', '2015-11-02', '2015-11-08', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('197', '41', '2015-11-09', '2015-11-15', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('198', '42', '2015-11-16', '2015-11-22', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('199', '43', '2015-11-23', '2015-11-29', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('200', '44', '2015-11-30', '2015-12-06', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('201', '45', '2015-12-07', '2015-12-13', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('202', '46', '2015-12-14', '2015-12-20', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('203', '47', '2015-12-21', '2015-12-27', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('204', '48', '2015-12-28', '2016-01-03', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('205', '49', '2016-01-04', '2016-01-10', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('206', '50', '2016-01-11', '2016-01-17', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('207', '51', '2016-01-18', '2016-01-24', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24'), ('208', '52', '2016-01-25', '2016-01-31', 'FY16', '166', '2015-12-02 16:54:24', '2015-12-02 16:54:24');
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
INSERT INTO `years` VALUES ('1', 'FY16', '2015-02-02', '2016-01-31', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
