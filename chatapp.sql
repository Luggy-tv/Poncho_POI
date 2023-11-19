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

Create Table if not exists `grupos`(
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
select *from `groups`;
select * from `groups_users`;
select *from `users`;

INSERT INTO `groups`(uniqueGroup_id,Group_name,img) VALUES (181061,'Tracalosa','Lmaolmao');

select * from `groups` where uniqueGroup_id = '1066404727';



drop table `groups`;
drop table `groups_users`;

truncate table `groups`;
truncate table `groups_users`;


select * from `users`;
select * from `groups`;
select * from `groups_users`;
select * from `messages`;

SELECT 
	concat(u.fname , ' ', u.lname ) as nombre_usuario,
    g.Group_name as nombre_grupo
FROM
    `users`AS u
LEFT JOIN
    `groups_users` AS gu ON u.unique_id = gu.uniqueUser_id
LEFT JOIN
    `groups` AS g ON gu.uniqueGroup_id = g.uniqueGroup_id
order by nombre_usuario;


SELECT * FROM users WHERE NOT unique_id = 1507459082 ORDER BY user_id DESC;

SELECT 
	g.group_id, 
	g.uniqueGroup_id as unique_id,
    g.Group_name as fname, 
    CASE 
		WHEN lname IS NULL THEN ' '
		ELSE ' '
		END as lname ,
    g.img,
    `status` 
FROM `groups` AS g
left join `groups_users` as gu on g.uniqueGroup_id = gu.uniqueGroup_id
left join `users` as u on gu.uniqueUser_id = u.unique_id
WHERE u.unique_id = 1507459082;

 SELECT * FROM messages 
 WHERE 
	(incoming_msg_id = 1507459082 OR outgoing_msg_id = 1507459082) 
 AND 
	(outgoing_msg_id = 1132285361 OR incoming_msg_id = 1132285361) 
 ORDER BY msg_id DESC LIMIT 1;
 
 INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES (1071050808,1507459082 , 'Mensaje de Brandon(?) para el grupo');