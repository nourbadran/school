ALTER TABLE `resignation_log` ADD `resume_at` DATETIME NULL DEFAULT NULL AFTER `retired_at`;
ALTER TABLE `resignation_log` ADD `resume_conditions` text NULL DEFAULT NULL AFTER `conditions`;
ALTER TABLE `employees` ADD `monthly_leaves_credit` int NULL DEFAULT NULL AFTER `dob`;


CREATE TABLE `employee_rewards` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `employee_id` int(11) NOT NULL,
 `value` decimal(10,2),
 `date` datetime NOT NULL,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `modified_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;


ALTER TABLE `employees` ADD `start_work_time` varchar(20) NULL DEFAULT NULL AFTER `dob`;
ALTER TABLE `employees` ADD `end_work_time` varchar(20) NULL DEFAULT NULL AFTER `dob`;