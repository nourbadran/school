ALTER TABLE `resignation_log` CHANGE `conditions` `conditions` TEXT CHARACTER SET utf8 COLLATE utf8_german2_ci NULL DEFAULT NULL;
ALTER TABLE `resignation_log` CHANGE `resume_conditions` `resume_conditions` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `resignation_log` CHANGE `duties` `duties` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `resignation_log` CHANGE `rights` `rights` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;