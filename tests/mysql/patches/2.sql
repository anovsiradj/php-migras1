
ALTER TABLE `user` ADD IF NOT EXISTS `email` varchar(256) NULL;
ALTER TABLE `user` ADD IF NOT EXISTS `phone` varchar(16) NULL;
