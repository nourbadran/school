CREATE TABLE `stopping_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `employee_id` int(11) NOT NULL,
 `stopped_at` datetime NOT NULL,
 `resumed_at` datetime NULL DEFAULT NULL,
 `created_at` datetime NOT NULL,
 `modified_at` datetime NOT NULL,
 `created_by` int(11) NOT NULL,
 `modified_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;