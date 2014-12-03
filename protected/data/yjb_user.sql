/*
Navicat MySQL Data Transfer

Source Server         : linode
Source Server Version : 50538
Source Host           : 106.187.36.78:3306
Source Database       : yaojinbu

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2014-12-03 16:30:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yjb_user`
-- ----------------------------
DROP TABLE IF EXISTS `yjb_user`;
CREATE TABLE `yjb_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `contact` text NOT NULL,
  `register_time` int(10) unsigned NOT NULL DEFAULT '0',
  `register_ip` varchar(15) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yjb_user
-- ----------------------------
