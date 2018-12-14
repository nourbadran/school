CREATE TABLE `attendance_info` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `employee_id` int(11) NOT NULL ,
 `info_month` datetime NOT NULL,
 `working_days` int(11) NOT NULL,
 `days_off` int(11) NOT NULL,
 `extra_days_off` int(11) DEFAULT 0,
 `total_discount` int(11) DEFAULT  0,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `modified_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

alter table `attendance_info` add key(`employee_id`);


ALTER TABLE `attendance_info` CHANGE `info_month` `info_month` TEXT NOT NULL;
INSERT INTO `operations` (`id`, `module_id`, `operation_name`, `operation_slug`, `is_view_vissible`, `is_add_vissible`, `is_edit_vissible`, `is_delete_vissible`, `status`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES (NULL, '26', 'Attendance Info', 'attinfo', '1', '1', '1', '1', '1', '2017-12-12 16:19:24', '2018-01-03 07:25:24', '1', '1');
