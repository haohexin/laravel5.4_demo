/*
 Navicat MySQL Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50718
 Source Host           : localhost
 Source Database       : harmonicare

 Target Server Type    : MySQL
 Target Server Version : 50718
 File Encoding         : utf-8

 Date: 08/08/2017 10:11:29 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_account_unique` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `admin`
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES ('1', 'admin', '$2y$10$JKV3njKo4dM3WqtdF08dbO8YBONcJMrd5/B1SPohG71sW6AexNsRK', 'JsPIjvSpxSa1FjIkwAq5aXFCV9hyGe5z8dxdzdbPeYlKKwTk7w0gy8PBgRDX', '2016-07-27 17:20:35', '2017-08-08 01:49:18');
COMMIT;

-- ----------------------------
--  Table structure for `dictionaries`
-- ----------------------------
DROP TABLE IF EXISTS `dictionaries`;
CREATE TABLE `dictionaries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` bigint(20) NOT NULL COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `fid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `level` tinyint(4) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '跳转地址',
  `imgurl` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图片地址',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('2', '2017_08_07_014433_create_admin_table', '1'), ('3', '2017_08_07_015803_create_users_table', '2'), ('4', '2017_08_07_015616_entrust_setup_tables', '3'), ('5', '2017_08_07_021643_create_dictionaries_table', '4'), ('6', '2017_08_08_002020_create_navigations_table', '5'), ('7', '2017_08_08_011444_add_icon_nav_table', '6');
COMMIT;

-- ----------------------------
--  Table structure for `navigations`
-- ----------------------------
DROP TABLE IF EXISTS `navigations`;
CREATE TABLE `navigations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` bigint(20) NOT NULL COMMENT '编号',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `fid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `level` tinyint(4) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '跳转地址',
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '权限',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '图标',
  `rank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `navigations`
-- ----------------------------
BEGIN;
INSERT INTO `navigations` VALUES ('2', '10000', '类型管理', '0', '1', null, 'categoryList', '2017-08-08 00:55:10', '2017-08-08 01:28:50', 'fa-book', '20'), ('3', '10100', '类型列表', '10000', '2', '/admin/category/lists?nav=2-0', 'categoryList', '2017-08-08 00:56:33', '2017-08-08 00:56:33', null, null), ('4', '20000', '管理员管理', '0', '1', null, 'adminList', '2017-08-08 01:07:37', '2017-08-08 01:29:00', 'fa-user-secret', '30'), ('5', '20100', '管理员列表', '20000', '2', '/admin/admin/lists?nav=3-0', 'adminList', '2017-08-08 01:08:00', '2017-08-08 01:08:00', null, null), ('6', '30000', '权限管理', '0', '1', null, 'permissionList', '2017-08-08 01:09:37', '2017-08-08 01:29:07', 'fa-rocket', '40'), ('7', '30100', '权限列表', '30000', '2', '/admin/permission/permissionList?nav=4-0', 'permissionList', '2017-08-08 01:10:01', '2017-08-08 01:10:01', null, null), ('8', '30200', '角色列表', '30000', '2', '/admin/permission/roleList?nav=4-2', 'roleList', '2017-08-08 01:10:28', '2017-08-08 01:10:28', null, null), ('9', '40000', '导航管理', '0', '1', null, 'navLists', '2017-08-08 01:27:29', '2017-08-08 01:42:06', 'fa-reorder', '10'), ('10', '40100', '导航列表', '40000', '2', '/admin/nav/lists?nav=2-0', 'navLists', '2017-08-08 01:27:51', '2017-08-08 01:43:07', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `permission_role`
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `permission_role`
-- ----------------------------
BEGIN;
INSERT INTO `permission_role` VALUES ('11', '1'), ('12', '1'), ('13', '1'), ('14', '1'), ('15', '1'), ('16', '1'), ('17', '1'), ('18', '1'), ('19', '1'), ('20', '1'), ('21', '1'), ('22', '1'), ('23', '1'), ('24', '1'), ('25', '1'), ('26', '1'), ('112', '1'), ('114', '1'), ('115', '1'), ('116', '1'), ('117', '1');
COMMIT;

-- ----------------------------
--  Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `permissions`
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES ('11', 'categoryList', '类型列表', null, '2017-07-17 08:46:02', '2017-07-17 08:46:02'), ('12', 'categoryAdd', '类型添加', null, '2017-07-17 08:46:11', '2017-07-17 08:46:11'), ('13', 'categoryEdit', '类型修改', null, '2017-07-17 08:46:20', '2017-07-17 08:46:20'), ('14', 'categoryDelete', '类型删除', null, '2017-07-17 08:46:30', '2017-07-17 08:46:30'), ('15', 'adminList', '管理员列表', null, '2017-07-17 08:47:10', '2017-07-17 08:47:10'), ('16', 'adminAdd', '管理员添加', null, '2017-07-17 08:47:18', '2017-07-17 08:47:18'), ('17', 'adminEdit', '管理员修改', null, '2017-07-17 08:47:30', '2017-07-17 08:47:30'), ('18', 'adminDelete', '管理员删除', null, '2017-07-17 08:47:42', '2017-07-17 08:47:42'), ('19', 'permissionList', '权限列表', null, '2017-07-17 08:49:00', '2017-07-17 08:49:00'), ('20', 'permissionAdd', '权限添加', null, '2017-07-17 08:49:10', '2017-07-17 08:49:10'), ('21', 'permissionEdit', '权限修改', null, '2017-07-17 08:49:23', '2017-07-17 08:49:23'), ('22', 'permissionDelete', '权限删除', null, '2017-07-17 08:49:32', '2017-07-17 08:49:32'), ('23', 'roleList', '角色列表', null, '2017-07-17 08:49:58', '2017-07-17 08:49:58'), ('24', 'roleAdd', '角色添加', null, '2017-07-17 08:50:09', '2017-07-17 08:50:09'), ('25', 'roleEdit', '角色修改', null, '2017-07-17 08:50:20', '2017-07-17 08:50:20'), ('26', 'roleDelete', '角色删除', null, '2017-07-17 08:50:29', '2017-07-17 08:50:29'), ('112', 'roleEditPermission', '角色修改权限', null, '2017-07-17 08:51:03', '2017-08-07 09:06:15'), ('114', 'navLists', '导航列表', '导航列表', '2017-08-08 01:40:37', '2017-08-08 01:40:37'), ('115', 'navAdd', '新增导航', '新增导航', '2017-08-08 01:40:54', '2017-08-08 01:40:54'), ('116', 'navEdit', '修改导航', '修改导航', '2017-08-08 01:41:14', '2017-08-08 01:41:14'), ('117', 'navDelete', '删除导航', '删除导航', '2017-08-08 01:41:28', '2017-08-08 01:41:28');
COMMIT;

-- ----------------------------
--  Table structure for `role_user`
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `role_user`
-- ----------------------------
BEGIN;
INSERT INTO `role_user` VALUES ('1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `roles`
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES ('1', 'Admin', '超级管理员', '超级管理员', '2017-08-07 02:47:34', '2017-08-07 09:09:00');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `area` bigint(20) DEFAULT NULL COMMENT '区域ID',
  `department` bigint(20) DEFAULT NULL COMMENT '部门ID',
  `sex` tinyint(4) DEFAULT NULL COMMENT '性别',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL COMMENT '软删除',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
