/*
Navicat MySQL Data Transfer

Source Server         : linode
Source Server Version : 50538
Source Host           : 106.187.36.78:3306
Source Database       : yaojinbu

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2014-12-03 16:30:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yjb_ncat`
-- ----------------------------
DROP TABLE IF EXISTS `yjb_ncat`;
CREATE TABLE `yjb_ncat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yjb_ncat
-- ----------------------------
