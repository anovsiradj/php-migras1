<?php

/**
 * @var \anovsiradj\sqlrun\drivers\Driver $driver
 */

$driver->query(<<<SQL
	ALTER TABLE `user` ADD UNIQUE `username_unq` (`username`);
SQL);

$driver->query(<<<SQL
	ALTER TABLE `user` ADD UNIQUE `email_unq` (`email`);
	ALTER TABLE `user` ADD UNIQUE `phone_unq` (`phone`);
SQL);
