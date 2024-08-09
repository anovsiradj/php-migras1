
ALTER TABLE `table3` ADD IF NOT EXISTS `created_at` datetime NULL;
ALTER TABLE `table3` ADD IF NOT EXISTS `updated_at` datetime NULL;

ALTER TABLE `table3` ADD IF NOT EXISTS `created_by` integer NULL;
ALTER TABLE `table3` ADD IF NOT EXISTS `updated_by` integer NULL;

ALTER TABLE `role` ADD UNIQUE `name_unq` (`name`);
