ALTER TABLE `employees` ADD `stopped_at` DATETIME NULL DEFAULT NULL AFTER `created_at`;


CREATE TABLE `resignation_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `employee_id` int(11) NOT NULL,
 `conditions` text,
 `duties` text,
 `rights` text,
 `retired_at` datetime NOT NULL,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `modified_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

ALTER TABLE `employees` ADD `retired_at` DATETIME NULL DEFAULT NULL AFTER `created_at`;