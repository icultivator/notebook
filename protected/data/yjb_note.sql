/*
Navicat MySQL Data Transfer

Source Server         : linode
Source Server Version : 50538
Source Host           : 106.187.36.78:3306
Source Database       : yaojinbu

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2014-12-03 16:30:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yjb_note`
-- ----------------------------
DROP TABLE IF EXISTS `yjb_note`;
CREATE TABLE `yjb_note` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `cover` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `votes` decimal(2,1) DEFAULT '0.0',
  `status` tinyint(1) unsigned DEFAULT '1',
  `user_id` int(10) unsigned NOT NULL,
  `create_time` int(10) unsigned DEFAULT NULL,
  `publish_time` int(10) unsigned DEFAULT NULL,
  `last_update` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yjb_note
-- ----------------------------
