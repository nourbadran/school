ALTER TABLE `sections` ADD `type` ENUM('arabic','cambridge') NULL DEFAULT 'arabic' AFTER `teacher_id`;

CREATE TABLE `stages` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `section_id` int(11) NOT NULL,
 `name` varchar(50) CHARACTER SET utf8 NOT NULL,
 `note` text CHARACTER SET utf8 NOT NULL,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `modified_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

CREATE TABLE `departments` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `school_id` int(11) NOT NULL,
 `name` varchar(50) CHARACTER SET utf8 NOT NULL,
 `note` text CHARACTER SET utf8 NOT NULL,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `modified_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

INSERT INTO `operations` (`id`, `module_id`, `operation_name`, `operation_slug`, `is_view_vissible`, `is_add_vissible`, `is_edit_vissible`, `is_delete_vissible`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES (NULL, '7', 'Department', 'department', '1', '1', '1', '1', '1', '2017-12-12 16:19:24', '2018-01-03 07:25:24', '1', '1');

ALTER TABLE `classes` ADD `department_id` INT(11) NULL DEFAULT NULL AFTER `school_id`;

ALTER TABLE `classes` ADD `type` ENUM('arabic','cambridge') NULL DEFAULT 'arabic' AFTER `department_id`;