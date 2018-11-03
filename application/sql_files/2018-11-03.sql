ALTER TABLE `classes` ADD `supervisor_id` INT NULL DEFAULT NULL AFTER `teacher_id`;

ALTER TABLE `marks` ADD `is_confirmed` INT NOT NULL DEFAULT '0' AFTER `grade_id`;