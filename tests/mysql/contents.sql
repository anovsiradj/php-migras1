
/*
	this file MUST always contain safe commands
*/

INSERT IGNORE INTO user (username,password) values ('foo','password');
INSERT IGNORE INTO user (username,password) values ('bar','password');

INSERT IGNORE INTO role (id,name) values (1,'admin');
INSERT IGNORE INTO role (id,name) values (2,'member');
