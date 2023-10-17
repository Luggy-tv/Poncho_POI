create database if not exists chatapp;
use chatapp;

CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) NOT NULL,
  constraint PK_msg
	primary key (msg_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  constraint PK_user
	primary key (user_id)
) ENGINE=InnoDB;

Create Table if not exists `groups`(
`group_id` int not null auto_increment,
`uniqueGroup_id` int not null,
`Group_name` varchar(225) not null,
`img` varchar(255) Not null,
constraint pk_group
	primary key (group_id)
) engine=InnoDB;

create Table if not exists `groups_users`(
`relation_id` int not null auto_increment,
`uniqueUser_id` int not null,
`uniqueGroup_id` int not null,
constraint pk_groupUsers
	primary key (relation_id),
constraint fk_user
		foreign key (uniqueUser_id) references users(`user_id`),
        constraint fk_group
		foreign key (uniqueGroup_id) references `groups`(`group_id`)
);

/*
create table if not exists `task`(
`task_id` int not null auto_increment,
`uniqueTask_id `)
*/