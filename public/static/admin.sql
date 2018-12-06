/*
Navicat MySQL Data Transfer

Source Server         : loacl
Source Server Version : 50619
Source Host           : 127.0.0.1:3306
Source Database       : admin

Target Server Type    : MYSQL
Target Server Version : 50619
File Encoding         : 65001

Date: 2018-12-05 15:44:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_admin_group`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_group`;
CREATE TABLE `t_admin_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '群组ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '群组名',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '群组规则',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '状态（0-正常，－1-关闭）',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='后台群组';

-- ----------------------------
-- Records of t_admin_group
-- ----------------------------
INSERT INTO `t_admin_group` VALUES ('1', '管理组', '1,2,3,4,5,6,7,8,9,10', '0', '2018-12-05 15:30:05', '2018-12-05 15:43:06');
INSERT INTO `t_admin_group` VALUES ('2', '产品组', '1,7,8', '0', '2018-12-05 15:30:05', '2018-12-05 15:43:09');
INSERT INTO `t_admin_group` VALUES ('3', '测试组', '1,11', '0', '2018-12-05 15:30:05', '2018-12-05 15:43:11');
INSERT INTO `t_admin_group` VALUES ('4', '运营组', '1,8', '0', '2018-12-05 15:30:05', '2018-12-05 15:43:13');
INSERT INTO `t_admin_group` VALUES ('5', '客服组', '1,7', '0', '2018-12-05 15:30:05', '2018-12-05 15:43:18');

-- ----------------------------
-- Table structure for `t_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_log`;
CREATE TABLE `t_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员id',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '日志类型：1-禁用-启动，2-封号-解封',
  `type_type` int(11) NOT NULL DEFAULT '0' COMMENT '1可用，2不可用',
  `msg` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of t_admin_log
-- ----------------------------

-- ----------------------------
-- Table structure for `t_admin_rule`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_rule`;
CREATE TABLE `t_admin_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '规则ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '规则名',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '规则名称',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '层级',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID（0-顶级）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0-正常，－1-关闭）',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序规则',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8 COMMENT='权限规则';

-- ----------------------------
-- Records of t_admin_rule
-- ----------------------------
INSERT INTO `t_admin_rule` VALUES ('1', 'adminManage', '后台管理', '1', '0', '0', '1', '2018-12-05 15:29:35', '2018-12-05 15:43:33');
INSERT INTO `t_admin_rule` VALUES ('2', 'authManage', '后台账户', '2', '1', '0', '1', '2018-12-05 15:29:35', '2018-12-05 15:43:35');
INSERT INTO `t_admin_rule` VALUES ('3', 'groupManage', '后台群组', '2', '1', '0', '2', '2018-12-05 15:29:35', '2018-12-05 15:43:37');
INSERT INTO `t_admin_rule` VALUES ('4', 'menuManage', '菜单管理', '2', '1', '0', '3', '2018-12-05 15:29:35', '2018-12-05 15:43:39');
INSERT INTO `t_admin_rule` VALUES ('5', 'api/do_authedit', '修改', '3', '2', '0', '1', '2018-12-05 15:29:35', '2018-12-05 15:43:42');
INSERT INTO `t_admin_rule` VALUES ('6', 'api/do_authDel', '删除', '3', '2', '0', '2', '2018-12-05 15:29:35', '2018-12-05 15:43:44');
INSERT INTO `t_admin_rule` VALUES ('7', 'api/do_assignrule', '修改', '3', '3', '0', '1', '2018-12-05 15:29:35', '2018-12-05 15:43:46');
INSERT INTO `t_admin_rule` VALUES ('8', 'api/do_groupDel', '删除', '3', '3', '0', '2', '2018-12-05 15:29:35', '2018-12-05 15:43:48');
INSERT INTO `t_admin_rule` VALUES ('9', 'api/addmenu', '添加', '3', '4', '0', '1', '2018-12-05 15:29:35', '2018-12-05 15:43:50');
INSERT INTO `t_admin_rule` VALUES ('10', 'api/delmenu', '删除', '3', '4', '0', '2', '2018-12-05 15:29:35', '2018-12-05 15:43:58');

-- ----------------------------
-- Table structure for `t_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_user`;
CREATE TABLE `t_admin_user` (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台用户ID',
  `auth_name` varchar(50) NOT NULL DEFAULT '' COMMENT '后台用户名',
  `auth_pwd` varchar(50) NOT NULL DEFAULT '' COMMENT '后台密码',
  `pwd_code` int(4) NOT NULL COMMENT '密码加密CODE',
  `group_id` varchar(11) NOT NULL DEFAULT '0' COMMENT '群组ID（0-没有设置群组）',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态（0-正常，－1-关闭）',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='后台用户';

-- ----------------------------
-- Records of t_admin_user
-- ----------------------------
INSERT INTO `t_admin_user` VALUES ('2', 'admin', 'fb89879a760c48686f09ad8075986779', '9755', '1', '0', '2018-07-25 15:59:15', '2018-12-05 15:36:25');
INSERT INTO `t_admin_user` VALUES ('3', 'test', '0dcec2af73ef31fe2a1361388cf52220', '5060', '3', '0', '2018-08-06 14:48:22', '2018-12-05 15:38:36');
INSERT INTO `t_admin_user` VALUES ('32', 'service', '9a244eb2e91cc0f4ea4ef09be27e3b8a', '6527', '5', '0', '2018-12-05 15:39:07', '2018-12-05 15:39:07');
