DROP DATABASE IF EXISTS accounts;

CREATE DATABASE IF NOT EXISTS accounts;

USE accounts;

CREATE TABLE users (
    `user_id` int(11) AUTO_INCREMENT NOT NULL,
    `user_first` VARCHAR(100) NOT NULL,
    `user_last` VARCHAR(100) NOT NULL,
    `user_email` VARCHAR (100) NOT NULL,
    `user_username` VARCHAR (100) NOT NULL,
    `user_pwd` VARCHAR(1000) NOT NULL,
    `user_confirmed` INT(11) NOT NULL,
    `user_confirm_code` BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (`uid`)
);

CREATE TABLE uploads (
    `pid` INT(11) AUTO_INCREMENT NOT NULL,
    `userid` INT(11) NOT NULL,
    `file_name` VARCHAR(100) NOT NULL,
    PRIMARY KEY(`pid`)
);