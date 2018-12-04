CREATE TABLE `class_types` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` VARCHAR (255) NOT NULL,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `modified_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO `class_types` (`id`, `name`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES (NULL, 'arabic', '2018-12-03 12:00:00', '2018-12-03 12:00:00', '1', '1');
INSERT INTO `class_types` (`id`, `name`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES (NULL, 'cambridge', '2018-12-03 12:00:00', '2018-12-03 12:00:00', '1', '1')

INSERT INTO `operations` (`id`, `module_id`, `operation_name`, `operation_slug`, `is_view_vissible`, `is_add_vissible`, `is_edit_vissible`, `is_delete_vissible`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES (NULL, '7', 'Classtype', 'classtype', '1', '1', '1', '1', '1', '2017-12-12 16:19:24', '2018-01-03 07:25:24', '1', '1');
ALTER TABLE `classes` CHANGE `type` `class_type_id` INT(11) NULL DEFAULT NULL;