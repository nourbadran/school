INSERT INTO `roles` (`id`, `slug`, `name`, `note`, `is_default`, `is_super_admin`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES (NULL, 'supervisor', 'Supervisor', 'Supervisor', '1', '0', '1', '2018-10-30 18:00:00', '2018-10-30 18:09:00', '1', '');

CREATE TABLE `supervisors` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `school_id` int(11) NOT NULL,
 `name` varchar(100) CHARACTER SET utf8 NOT NULL,
 `phone` varchar(20) CHARACTER SET utf8 NOT NULL,
 `present_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
 `permanent_address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
 `gender` varchar(10) CHARACTER SET utf8 NOT NULL,
 `dob` date NOT NULL,
 `joining_date` date NOT NULL,
 `photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
 `other_info` text,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `modified_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `user_id` (`user_id`),
 KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;


INSERT INTO `modules` (`id`, `module_name`, `module_slug`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES (NULL, 'Supervisor', 'supervisor', '1', '2018-10-30 08:00:00', '2018-10-30 10:00:00', '1', '');
SET @INC = (SELECT max(id) FROM modules LIMIT 1);
INSERT INTO `operations` (`id`, `module_id`, `operation_name`, `operation_slug`, `is_view_vissible`, `is_add_vissible`, `is_edit_vissible`, `is_delete_vissible`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES (NULL, @INC, 'Supervisor', 'supervisor', '1', '1', '1', '1', '1', '2017-12-12 16:19:24', '2018-01-03 07:25:24', '1', '1');
