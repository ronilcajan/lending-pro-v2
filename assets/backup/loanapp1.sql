#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES (1, 'admin', 'Administrator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES (2, 'members', 'General User');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES (3, 'fgdf', 'gdfgfdg');


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (1, '::1', 'admin@admin.com', 1625722967);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (2, '::1', 'admin@admin.com', 1625724866);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (3, '::1', 'admin@admin.com', 1625724888);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (4, '::1', 'dasd', 1625724902);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (5, '::1', 'admin@admin.com', 1625724933);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (6, '::1', 'admin@admin.com', 1625725133);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (7, '::1', 'admin@admin.com', 1625725253);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (8, '::1', 'admin@admin.com', 1625725521);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (9, '::1', 'admin@admin.com', 1625726864);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (10, '::1', 'admin@admin.com', 1625728323);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (11, '::1', 'admin@admin.com', 1625728390);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (12, '::1', 'admin@admin.com', 1625728415);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (13, '::1', 'admin@admin.com', 1625728474);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (14, '::1', 'admin@admin.com', 1625728494);
INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES (15, '::1', 'admin@admin.com', 1625728502);


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES (1, '127.0.0.1', 'administrator', '$2y$10$TU2InehQv7R05Z.eJMuDdemcpPG8LWftXOGBbDh0OGamC86RP/e2C', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1625740230, 1, 'Admin', 'istrator', 'ADMIN', '0');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES (2, '::1', NULL, '$2y$10$JY1fzhnz87ncAZGvQ5PLp.mWnsJIrODQFJSWz5uvxLUJOoRo3t6HO', 'cajanr02@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625722279, NULL, 1, 'Ronil', 'M Cajan', 'Ron', '19512659595');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES (4, '::1', 'ron', '$2y$10$bpJSW4MSVHd9/LYO1gclQukL9CxK5lw2IbgUDqt9l5U.ElXUbvJja', 'jameronjame@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1625730850, 1625738975, 1, 'Ronil', 'M Cajan', 'SH Food Group 1', '091233545');


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (7, 1, 1);
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (3, 2, 2);
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES (8, 4, 2);


