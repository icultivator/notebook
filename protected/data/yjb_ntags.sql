/*
Navicat MySQL Data Transfer

Source Server         : linode
Source Server Version : 50538
Source Host           : 106.187.36.78:3306
Source Database       : yaojinbu

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2014-12-03 16:29:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yjb_ntags`
-- ----------------------------
DROP TABLE IF EXISTS `yjb_ntags`;
CREATE TABLE `yjb_ntags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yjb_ntags
-- ----------------------------
