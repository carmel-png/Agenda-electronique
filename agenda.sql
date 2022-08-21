
create database agenda;

use agenda;

CREATE TABLE events (
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	description TEXT,
    start DATETIME NOT NULL,
    end DATETIME NOT NULL
);